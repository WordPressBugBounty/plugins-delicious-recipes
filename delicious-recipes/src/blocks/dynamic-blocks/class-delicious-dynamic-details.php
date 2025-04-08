<?php
/**
 * Details Block
 *
 * @since   1.2.0
 * @package Delicious_Recipes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Delicious_Dynamic_Details Class.
 */
class Delicious_Dynamic_Details {
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
	 * @var array
	 */
	public static $attributes;

	/**
	 * Block settings.
	 *
	 * @since 1.1.0
	 * @var array
	 */
	public static $settings;

	/**
	 * The Constructor.
	 */
	public function __construct() {
		self::$helpers = new Delicious_Recipes_Helpers();
	}

	/**
	 * Registers the details block as a server-side rendered block.
	 *
	 * @return void
	 */
	public function register_hooks() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		if ( delicious_recipes_block_is_registered( 'delicious-recipes/dynamic-details' ) ) {
			return;
		}

		$attributes = array(
			'id'              => array(
				'type'    => 'string',
				'default' => 'dr-block-details',
			),
			'course'          => array(
				'type'  => 'array',
				'items' => array(
					'type' => 'string',
				),
			),
			'cuisine'         => array(
				'type'  => 'array',
				'items' => array(
					'type' => 'string',
				),
			),
			'method'          => array(
				'type'  => 'array',
				'items' => array(
					'type' => 'string',
				),
			),
			'recipeKey'       => array(
				'type'  => 'array',
				'items' => array(
					'type' => 'string',
				),
			),
			'difficulty'      => array(
				'type'    => 'string',
				'default' => 'beginner',
			),
			'difficultyTitle' => array(
				'type'     => 'string',
				'selector' => '.difficulty-label',
				'default'  => 'Difficulty',
			),
			'season'      => array(
				'type'    => 'array',
				'default' => array('summer'),
			),
			'seasonTitle'     => array(
				'type'     => 'string',
				'selector' => '.season-label',
				'default'  => 'Best Season',
			),
			'seasonOptions' => array(
				'type'    => 'array',
				'default' => array(
					array(
						'label' => 'Fall',
						'value' => 'fall',
					),
					array(
						'label' => 'Winter',
						'value' => 'winter',
					),
					array(
						'label' => 'Summer',
						'value' => 'summer',
					),
					array(
						'label' => 'Spring',
						'value' => 'spring',
					),
					array(
						'label' => 'Suitable throughout the year',
						'value' => 'available',
					),
				),
			),			
			'keywords'        => array(
				'type'  => 'array',
				'items' => array(
					'type' => 'string',
				),
			),
			'displayDifficulty' => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'displayPrepTime' => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'displayCookingTime' => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'displayRestTime' => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'displayTotalTime' => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'displayCookingTemp' => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'displayServings' => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'displayEstimatedCost' => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'displayCalories' => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'displayBestSeason' => array(
				'type'    => 'boolean',
				'default' => true,
			),
			'details'         => array(
				'type'    => 'array',
				'default' => self::get_details_default(),
				'items'   => array(
					'type' => 'object',
				),
			),
		);

		// Hook server side rendering into render callback.
		register_block_type(
			'delicious-recipes/dynamic-details',
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

		if ( is_singular() ) {
			add_filter( 'the_content', array( $this, 'filter_the_content' ) );
		}

		if ( ! isset( $attributes['details'] ) ) {
			return $content;
		}

		$attributes = self::$helpers->omit( $attributes, array( 'toInsert', 'activeIconSet', 'showModal', 'searchIcon', 'icons' ) );
		// Import variables into the current symbol table from an array.
		extract( $attributes );

		// Store variables.
		self::$attributes = $attributes;
		self::$settings   = self::$helpers->parse_block_settings( $attributes );

		self::$attributes['difficultyTitle'] = isset( $difficulty_title ) ? $difficulty_title : __( 'Difficulty', 'delicious-recipes' );
		self::$attributes['seasonTitle']     = isset( $season_title ) ? $season_title : __( 'Best Season', 'delicious-recipes' );

		$class = 'dr-summary-holder';

		$details         = isset( $details ) ? $details : array();
		$details_content = $this->get_details_content( $details );

		$block_content = sprintf(
			'<div id="%1$s" class="%2$s">
				<div class="dr-post-summary">
					%3$s
				</div>
			</div>',
			esc_attr( $id ),
			esc_attr( $class ),
			$details_content
		);

		return $block_content;
	}

	/**
	 * Get details default.
	 *
	 * @return array
	 */
	public static function get_details_default() {
		return array(
			array(
				'id'    => self::$helpers->generateId( 'detail-item' ),
				'icon'  => 'time',
				'label' => 'Prep time',
				'unit'  => 'minutes',
				'value' => '30',
			),
			array(
				'id'    => self::$helpers->generateId( 'detail-item' ),
				'icon'  => 'time',
				'label' => 'Cook time',
				'unit'  => 'minutes',
				'value' => '40',
			),
			array(
				'id'    => self::$helpers->generateId( 'detail-item' ),
				'icon'  => 'time',
				'label' => 'Rest time',
				'unit'  => 'minutes',
				'value' => '40',
			),
			array(
				'id'    => self::$helpers->generateId( 'detail-item' ),
				'icon'  => 'time',
				'label' => 'Total time',
				'unit'  => 'minutes',
				'value' => '110',
			),
			array(
				'id'    => self::$helpers->generateId( 'detail-item' ),
				'icon'  => 'cookingtemp',
				'label' => 'Cooking Temp',
				'unit'  => 'C',
				'value' => '100',
			),
			array(
				'id'    => self::$helpers->generateId( 'detail-item' ),
				'icon'  => 'yield',
				'label' => 'Servings',
				'unit'  => 'servings',
				'value' => '4',
			),
			array(
				'id'    => self::$helpers->generateId( 'detail-item' ),
				'icon'  => 'estimatedcost',
				'label' => 'Estimated Cost',
				'unit'  => '$',
				'value' => '22',
			),
			array(
				'id'    => self::$helpers->generateId( 'detail-item' ),
				'icon'  => 'calories',
				'label' => 'Calories',
				'unit'  => 'kcal',
				'value' => '300',
			),
		);
	}

	/**
	 * Get details content.
	 *
	 * @param array $details The details.
	 * @return string
	 */
	public static function get_details_content( array $details ) {
		$detail_items  = self::get_detail_items( $details );
		$details_class = 'dr-extra-meta';

		if ( ! empty( $detail_items ) ) {
			return sprintf(
				'<div class="%s">%s</div>',
				esc_attr( $details_class ),
				$detail_items
				
			);
		} else {
			return '';
		}
	}

	/**
	 * Get detail items.
	 *
	 * @param array $details The details.
	 * @return string
	 */
	public static function get_detail_items( array $details ) {
		$output = '';

		$attributes = self::$attributes;
		extract( $attributes );

		$difficulty = isset( $difficulty ) && self::$attributes['displayDifficulty'] ? ucfirst( $difficulty ) : '';
		$difficulty_title = isset( $difficulty_title ) ? $difficulty_title : __( 'Difficulty', 'delicious-recipes' );
		$svg = '';

		if ( $difficulty ) {
			$svg     = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#difficulty"></use></svg>';
			$output .= sprintf(
				'<span class="%1$s"><span class="%2$s">%3$s %4$s:</span><b>%5$s</b></span>',
				'dr-sim-metaa dr-lavel',
				'dr-meta-title',
				$svg,
				$difficulty_title,
				$difficulty
			);
		}

		foreach ( $details as $index => $detail ) {
			$value    = '';
			$icon_svg = '';
			$icon     = ! empty( $detail['icon'] ) ? $detail['icon'] : '';
			$label    = ! empty( $detail['label'] ) ? $detail['label'] : '';
			$unit     = ! empty( $detail['unit'] ) ? $detail['unit'] : '';

			if ( ! empty( $icon ) ) {
				$icon_svg = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#' . $icon . '"></use></svg>';

				if ( 'estimatedcost' === $icon ) {
					$icon_svg = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#estimated-cost"></use></svg>';
				}

				if ( 'cookingtemp' === $icon ) {
					$icon_svg = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#cooking-temp"></use></svg>';
				}
			}

			if ( ! empty( $detail['value'] ) ) {
				if ( ! is_array( $detail['value'] ) ) {
					$value = $detail['value'];
				} elseif ( isset( $detail['jsonValue'] ) ) {
					$value = $detail['jsonValue'];
				}
			}

			if ( 0 === $index && !self::$attributes['displayPrepTime'] ) {
				continue;
			} elseif ( 1 === $index && !self::$attributes['displayCookingTime'] ) {
				continue;
			} elseif ( 2 === $index && !self::$attributes['displayRestTime'] ) {
				continue;
			} elseif ( 3 === $index && !self::$attributes['displayTotalTime'] ) {
				continue;
			} elseif ( 4 === $index && !self::$attributes['displayCookingTemp'] ) {
				continue;
			} elseif ( 5 === $index && !self::$attributes['displayServings'] ) {
				continue;
			} elseif ( 6 === $index && !self::$attributes['displayEstimatedCost'] ) {
				continue;
			} elseif ( 7 === $index && !self::$attributes['displayCalories'] ) {
				continue;
			}

			// convert minutes to hours for 'prep time', 'cook time' and 'total time'.
			if ( 0 === $index || 1 === $index || 2 === $index || 3 === $index ) {
				if ( ! empty( $detail['value'] ) ) {
					$converts = self::$helpers->convertMinutesToHours( $detail['value'], true );
					if ( ! empty( $converts ) ) {
						$value = $unit = '';
						if ( isset( $converts['hours'] ) ) {
							$value .= $converts['hours']['value'];
							$value .= ' ' . $converts['hours']['unit'];
						}
						if ( isset( $converts['minutes'] ) ) {
							$unit .= $converts['minutes']['value'];
							$unit .= ' ' . $converts['minutes']['unit'];
						}
					}
				}
			}

			$output .= sprintf(
				'<span class="%1$s"><span class="dr-meta-title">%2$s:</span><b>%3$s</b></span>',
				'dr-sim-metaa',
				$icon_svg . $label,
				$value . ' ' . $unit
			);
		}

		$season = isset( $season ) && self::$attributes['displayBestSeason'] ? $season : '';
		$seasonitle = isset( $season_title ) ? $season_title : __( 'Best Season', 'delicious-recipes' );

		if ( $season ) {
			$svg     = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#season"></use></svg>';
			$output .= sprintf(
				'<span class="%1$s"><span class="%2$s">%3$s %4$s:</span><b>%5$s</b></span>',
				'dr-sim-metaa dr-season',
				'dr-meta-title',
				$svg,
				$seasonitle,
				implode( ', ', array_map( 'ucfirst', $season ) )
			);
		}

		return force_balance_tags( $output );
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
