<?php
/**
 * Ingredients Block
 *
 * @since   1.2.0
 * @package Delicious_Recipes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Collects schema data from standalone ingredient/instruction blocks and
 * outputs a minimal Recipe JSON-LD on wp_footer when no Recipe Card block
 * is present on the same page.
 */
class Delicious_Recipes_Standalone_Schema {

	private static $ingredients = array();
	private static $steps       = array();
	private static $post_id     = 0;
	private static $hooked      = false;

	public static function add_ingredients( array $ingredients, $post_id ) {
		self::$ingredients = $ingredients;
		self::$post_id     = $post_id;
		self::maybe_hook_footer();
	}

	public static function add_steps( array $steps, $post_id ) {
		self::$steps   = $steps;
		self::$post_id = $post_id;
		self::maybe_hook_footer();
	}

	private static function maybe_hook_footer() {
		if ( ! self::$hooked ) {
			add_action( 'wp_footer', array( __CLASS__, 'output' ) );
			self::$hooked = true;
		}
	}

	public static function output() {
		if ( empty( self::$ingredients ) && empty( self::$steps ) ) {
			return;
		}

		$post = get_post( self::$post_id );
		if ( ! $post ) {
			return;
		}

		$helpers = new Delicious_Recipes_Structured_Data_Helpers();

		$json_ld = array(
			'@context'      => 'https://schema.org',
			'@type'         => 'Recipe',
			'name'          => get_the_title( $post ),
			'author'        => array(
				'@type' => 'Person',
				'name'  => get_the_author_meta( 'display_name', $post->post_author ),
			),
			'datePublished' => get_the_date( 'c', $post ),
		);

		$thumbnail_url = get_the_post_thumbnail_url( $post, 'full' );
		if ( $thumbnail_url ) {
			$json_ld['image'] = $thumbnail_url;
		}

		if ( ! empty( self::$ingredients ) ) {
			$recipe_ingredient = array();
			foreach ( self::$ingredients as $ingredient ) {
				if ( is_array( $ingredient ) && empty( $ingredient['isGroup'] ) ) {
					$recipe_ingredient[] = $helpers->get_ingredient_json_ld( $ingredient );
				}
			}
			if ( ! empty( $recipe_ingredient ) ) {
				$json_ld['recipeIngredient'] = $recipe_ingredient;
			}
		}

		if ( ! empty( self::$steps ) ) {
			$parent_permalink = get_the_permalink( $post );
			$groups_section   = array();
			$instructions     = array();

			foreach ( self::$steps as $key => $step ) {
				if ( ! is_array( $step ) ) {
					continue;
				}
				$is_group = ! empty( $step['isGroup'] );

				if ( $is_group ) {
					$groups_section[ $key ] = array(
						'@type'           => 'HowToSection',
						'name'            => ! empty( $step['jsonText'] ) ? $step['jsonText'] : $helpers->step_text_to_JSON( $step['text'] ?? '' ),
						'itemListElement' => array(),
					);
				} elseif ( ! empty( $groups_section ) ) {
					end( $groups_section );
					$last_key = key( $groups_section );
					if ( $key > $last_key ) {
						$groups_section[ $last_key ]['itemListElement'][] = $helpers->get_step_json_ld( $step, $parent_permalink );
					}
				} else {
					$instructions[] = $helpers->get_step_json_ld( $step, $parent_permalink );
				}
			}

			$json_ld['recipeInstructions'] = array_merge( $instructions, array_values( $groups_section ) );
		}

		echo '<script type="application/ld+json">' . wp_json_encode( $json_ld ) . "</script>\n";
	}
}

/**
 * Main Delicious_Dynamic_Ingredients Class.
 */
class Delicious_Dynamic_Ingredients {
	/**
	 * Class instance Helpers.
	 *
	 * @var Delicious_Recipes_Helpers
	 * @since 1.0.3
	 */
	public static $helpers;

	/**
	 * Block attributes.
	 *
	 * @since 1.1.0
	 */
	public static $attributes;

	/**
	 * Flag to prevent recursive rendering.
	 *
	 * @since 1.0.0
	 * @var bool $is_rendering Whether the block is currently rendering.
	 */
	private static $is_rendering = false;

	/**
	 * The Constructor.
	 */
	public function __construct() {
		self::$helpers = new Delicious_Recipes_Helpers();
	}

	/**
	 * Registers the ingredients block as a server-side rendered block.
	 *
	 * @return void
	 */
	public function register_hooks() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		if ( delicious_recipes_block_is_registered( 'delicious-recipes/dynamic-ingredients' ) ) {
			return;
		}

		$attributes = array(
			'id'                   => array(
				'type'    => 'string',
				'default' => 'dr-block-ingredients',
			),
			'ingredientsTitle'     => array(
				'type'     => 'string',
				'selector' => '.ingredients-title',
				'default'  => 'Ingredients',
			),
			'jsoningredientsTitle' => array(
				'type' => 'string',
			),
			'ingredients'          => array(
				'type'    => 'array',
				'default' => array(),
				'items'   => array(
					'type' => 'object',
				),
			),
			'noOfServings'         => array(
				'type'    => 'string',
				'default' => '',
			),
		);

		// Hook server side rendering into render callback.
		register_block_type(
			'delicious-recipes/dynamic-ingredients',
			array(
				'attributes'      => $attributes,
				'render_callback' => array( $this, 'render' ),
			)
		);
	}

	/**
	 * Renders the block.
	 *
	 * @param array  $attributes The attributes of the block.
	 * @param string $content    The HTML content of the block.
	 *
	 * @return string The block preceded by its JSON-LD script.
	 */
	public function render( $attributes, $content ) {
		if ( ! is_array( $attributes ) ) {
			return $content;
		}

		// Prevent recursive rendering
		if ( self::$is_rendering ) {
			return $content;
		}

		self::$is_rendering = true;

		// Add filter only if not already added
		$filter_added = false;
		if ( is_singular() && ! has_filter( 'the_content', array( $this, 'filter_the_content' ) ) ) {
			add_filter( 'the_content', array( $this, 'filter_the_content' ) );
			$filter_added = true;
		}

		if ( ! isset( $attributes['ingredients'] ) ) {
			self::$is_rendering = false;
			return $content;
		}

		$attributes = self::$helpers->omit( $attributes, array() );

		// Store variables.
		self::$attributes = $attributes;

		$ingredients         = isset( $attributes['ingredients'] ) ? $attributes['ingredients'] : array();
		$ingredients_content = self::get_ingredients_content( $ingredients );

		if ( is_singular() && ! has_block( 'delicious-recipes/dynamic-recipe-card', get_the_ID() ) ) {
			Delicious_Recipes_Standalone_Schema::add_ingredients( $ingredients, get_the_ID() );
		}

		// Remove filter if we added it
		if ( $filter_added ) {
			remove_filter( 'the_content', array( $this, 'filter_the_content' ) );
		}

		self::$is_rendering = false;

		return $ingredients_content;
	}

	/**
	 * Get ingredients content.
	 *
	 * @param array $ingredients The ingredients.
	 * @return string
	 */
	public static function get_ingredients_content( array $ingredients ) {
		$global_settings    = delicious_recipes_get_global_settings();
		$ingredients_column = isset( $global_settings['ingredientsColumn'] ) && ! empty( $global_settings['ingredientsColumn'] ) ? $global_settings['ingredientsColumn'] : '1';
		$ingredient_column  = '1' === $ingredients_column ? '' : 'double';

		$ingredient_links = function_exists( 'DEL_RECIPE_PRO' ) && function_exists( 'delicious_recipe_pro_check_license_status' ) && delicious_recipe_pro_check_license_status() ? get_option( 'delicious_recipes_auto_link_ingredients', array() ) : array();

		$ingredient_items = self::get_ingredient_items( $ingredients );

		$html_output  = '<div class="dr-summary-holder"><div class="dr-ingredients-list"><div class="dr-ingrd-title-wrap wpg-gap-1"><h3 class="ingredients-title dr-title">';
		$html_output .= self::$attributes['ingredientsTitle'];
		$html_output .= '</h3></div>';

		$list_class_names = implode( ' ', array( 'ingredients-list', 'dr-unordered-list ' . $ingredient_column ) );

		$sections = preg_split( '/(<h4>.*?<\/h4>)/', $ingredient_items, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY );

		$html_output .= "<ul class='{$list_class_names}'>";

		foreach ( $sections as $section ) {
			if ( preg_match( '/<h4>(.*?)<\/h4>/', $section, $matches ) ) {
				// Start new section with title.
				$html_output .= "</ul><h4>{$matches[1]}</h4><ul class='{$list_class_names}'>";
			} else {
				// Process individual ingredient items.
				$ingredients = explode( '</li>', $section );
				foreach ( $ingredients as $ingredient ) {
					foreach ( $ingredient_links as $ingredient_link ) {
						foreach ( $ingredient_link['ingredientsKeywords'] as $keyword ) {
							$pattern = '/\b' . preg_quote( $keyword, '/' ) . '\b/ui';
							if ( preg_match( $pattern, $ingredient ) ) {
								$link_attributes = 'href="' . esc_url( $ingredient_link['ingredientLink'] ) . '" target="' . esc_attr( $ingredient_link['openInNewTab'] ? '_blank' : '_self' ) . '" rel="' . esc_attr( implode( ' ', $ingredient_link['relAttribute'] ) ) . '"';
								$ingredient      = preg_replace( $pattern, '<a class=ingredient-link ' . $link_attributes . '>$0</a>', $ingredient );
							}
						}
					}
					$html_output .= $ingredient;
				}
			}
		}

		$html_output .= '</ul></div></div>';
		return $html_output;
	}

	/**
	 * Get ingredient items.
	 *
	 * @param array $ingredients The ingredients.
	 * @return string
	 */
	public static function get_ingredient_items( array $ingredients ) {
		$output = '';

		foreach ( $ingredients as $index => $ingredient ) {
			$name          = '';
			$is_group      = isset( $ingredient['isGroup'] ) ? $ingredient['isGroup'] : false;
			$ingredient_id = isset( $ingredient['id'] ) ? 'dr-ing-' . $ingredient['id'] : '';

			if ( ! $is_group ) {
				if ( ! empty( $ingredient['name'] ) ) {
					$name = sprintf( '<span class="dr-ingredient-name">%s</span>', self::wrap_ingredient_name( $ingredient['name'] ) );

					$name    = sprintf(
						'<input type="checkbox" id="%s"><label for ="%s">%s</label>',
						esc_attr( $ingredient_id ),
						esc_attr( $ingredient_id ),
						$name
					);
					$output .= sprintf(
						'<li>%s</li>',
						$name
					);
				}
			} elseif ( ! empty( $ingredient['name'] ) ) {
					$name    = self::wrap_ingredient_name( $ingredient['name'] );
					$output .= sprintf(
						'<h4>%s</h4>',
						$name
					);
			}
		}

		return force_balance_tags( $output );
	}

	/**
	 * Wrap ingredient name.
	 *
	 * @param array  $nodes The nodes.
	 * @param string $type The type.
	 * @return string
	 */
	public static function wrap_ingredient_name( $nodes, $type = '' ) {
		$attributes = self::$attributes;

		if ( ! is_array( $nodes ) ) {
			return $nodes;
		}

		$output = '';
		foreach ( $nodes as $node ) {
			if ( ! is_array( $node ) ) {
				$output .= $node;
			} else {
				$type     = isset( $node['type'] ) ? $node['type'] : null;
				$children = isset( $node['props']['children'] ) ? $node['props']['children'] : null;

				$start_tag = $type ? "<$type>" : '';
				$end_tag   = $type ? "</$type>" : '';

				if ( 'a' === $type ) {
					$rel        = isset( $node['props']['rel'] ) ? $node['props']['rel'] : '';
					$aria_label = isset( $node['props']['aria-label'] ) ? $node['props']['aria-label'] : '';
					$href       = isset( $node['props']['href'] ) ? $node['props']['href'] : '#';
					$target     = isset( $node['props']['target'] ) ? $node['props']['target'] : '_blank';

					$start_tag = sprintf( '<%s rel="%s" aria-label="%s" href="%s" target="%s">', $type, esc_attr( $rel ), esc_attr( $aria_label ), esc_url( $href ), esc_attr( $target ) );
				} elseif ( 'br' === $type ) {
					$end_tag = '';
				}

				$output .= $start_tag . self::wrap_ingredient_name( $children, $type ) . $end_tag;
			}
		}

		return $output;
	}

	/**
	 * Filter content when rendering recipe card block
	 * Add snippets at the top of post content
	 *
	 * @since 1.2.0
	 * @param string $content Main post content.
	 * @return string HTML of post content.
	 */
	public function filter_the_content( $content ) {
		if ( ! in_the_loop() ) {
			return $content;
		}

		$output = '';

		return $output . $content;
	}
}
