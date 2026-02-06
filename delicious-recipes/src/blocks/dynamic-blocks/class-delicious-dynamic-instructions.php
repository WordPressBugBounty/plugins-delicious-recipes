<?php
/**
 * Instructions Block
 *
 * @since   1.2.0
 * @package Delicious_Recipes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Delicious_Dynamic_Instructions Class.
 */
class Delicious_Dynamic_Instructions {
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
	 * Registers the instructions block as a server-side rendered block.
	 *
	 * @return void
	 */
	public function register_hooks() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		if ( delicious_recipes_block_is_registered( 'delicious-recipes/dynamic-instructions' ) ) {
			return;
		}

		$attributes = array(
			'id'                  => array(
				'type'    => 'string',
				'default' => 'dr-block-instructions',
			),
			'directionsTitle'     => array(
				'type'     => 'string',
				'selector' => '.directions-title',
				'default'  => 'Instructions',
			),
			'jsonDirectionsTitle' => array(
				'type' => 'string',
			),
			'steps'               => array(
				'type'    => 'array',
				'default' => array(),
				'items'   => array(
					'type' => 'object',
				),
			),
		);

		// Hook server side rendering into render callback.
		register_block_type(
			'delicious-recipes/dynamic-instructions',
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

		if ( ! isset( $attributes['steps'] ) ) {
			self::$is_rendering = false;
			return $content;
		}

		$attributes = self::$helpers->omit( $attributes, array() );
		// Import variables into the current symbol table from an array.
		extract( $attributes );

		// Store variables.
		self::$attributes = $attributes;

		$class = 'dr-summary-holder';

		$steps         = isset( $steps ) ? $steps : array();
		$steps_content = self::get_steps_content( $steps );

		$block_content = sprintf(
			'<div id="%1$s" class="%2$s">
					%3$s
				</div>',
			esc_attr( $id ),
			esc_attr( $class ),
			wp_kses_post( $steps_content )
		);

		// Remove filter if we added it
		if ( $filter_added ) {
			remove_filter( 'the_content', array( $this, 'filter_the_content' ) );
		}

		self::$is_rendering = false;

		return $block_content;
	}

	/**
	 * Get steps content.
	 *
	 * @param array $steps The steps.
	 * @return string
	 */
	public static function get_steps_content( array $steps ) {
		$direction_items = self::get_direction_items( $steps );

		$list_class_names = implode( ' ', array( 'directions-list', 'dr-ordered-list' ) );

		return sprintf(
			'<div class="dr-instructions"><div class="dr-instrc-title-wrap"><h3 class="directions-title dr-title">%s</h3></div><ol class="%s">%s</ol></div>',
			self::$attributes['directionsTitle'],
			$list_class_names,
			$direction_items
		);
	}

	/**
	 * Get direction items.
	 *
	 * @param array $steps The steps.
	 * @return string
	 */
	public static function get_direction_items( array $steps ) {
		$output = '';

		foreach ( $steps as $index => $step ) {
			$text     = '';
			$is_group = isset( $step['isGroup'] ) ? $step['isGroup'] : false;

			if ( ! $is_group ) {
				if ( ! empty( $step['text'] ) ) {
					$text    = self::wrap_direction_text( $step['text'] );
					$output .= sprintf(
						'<li>%s</li>',
						$text
					);
				}
				if ( ! empty( $step['notes'] ) ) {
					$notes_text = self::wrap_direction_text( $step['notes'] );
					$output    .= sprintf(
						'<p class="dr-notes dr-list-tips">%s</p>',
						$notes_text
					);
				}

				if ( ! empty( $step['video'] ) ) {
					$instruction_video_data = delicious_recipes_parse_videos( $step['video'] );
					$instruction_video_attr = isset( $instruction_video_data['0'] ) && ! empty( $instruction_video_data['0'] ) ? $instruction_video_data['0'] : array();
					$vid_url                = '';
					$image_url              = '';
					if ( ! empty( $instruction_video_attr ) ) :
						if ( 'youtube' === $instruction_video_attr['type'] ) {
							$vid_url   = 'https://www.youtube.com/embed/' . $instruction_video_attr['id'];
							$image_url = $instruction_video_attr['thumbnail'];
						} elseif ( 'vimeo' === $instruction_video_attr['type'] ) {
							$vid_url   = 'https://player.vimeo.com/video/' . $instruction_video_attr['id'];
							$image_url = $instruction_video_attr['thumbnail'];
						}
						ob_start();
						?>
							<div class="dr-instructions-video dr-instruction-video">
								<div class="dr-vdo-thumbnail">
								<?php
								if ( isset( $instruction_video_attr['url'] ) && $instruction_video_attr['url'] ) {
									?>
										<img src="<?php echo esc_url( $image_url ); ?>">
										<a data-fslightbox="<?php echo esc_url( $vid_url ); ?>" class="dr-instruction-videopop dr-lg-media-popup" href="<?php echo esc_url( $vid_url ); ?>" data-iframe="true">
											<svg xmlns="http://www.w3.org/2000/svg" width="18.095" height="20.894" viewBox="0 0 18.095 20.894">
												<path id="Path_26366" data-name="Path 26366" d="M107.992,76.108l18.095,10.447L107.992,97Z" transform="translate(-107.992 -76.108)" fill="#fff" />
											</svg>
										</a>
										<?php
								}
								?>
								</div>
							</div>
							<?php
							$output .= ob_get_clean();
						endif;
				}
			} elseif ( ! empty( $step['text'] ) ) {
					$text    = self::wrap_direction_text( $step['text'] );
					$output .= sprintf(
						'<h4 class="direction-step-group-title">%s</h4>',
						$text
					);
			}
		}
		return force_balance_tags( $output );
	}

	/**
	 * Wrap direction text.
	 *
	 * @param array  $nodes The nodes.
	 * @param string $type  The type.
	 * @return string
	 */
	public static function wrap_direction_text( $nodes, $type = '' ) {
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

				if ( 'img' === $type ) {
					$src = isset( $node['props']['src'] ) ? $node['props']['src'] : false;
					if ( $src ) {
						$attachment_id = isset( $node['key'] ) ? $node['key'] : 0;
						$alt           = isset( $node['props']['alt'] ) ? $node['props']['alt'] : '';
						$title         = isset( $node['props']['title'] ) ? $node['props']['title'] : ( isset( $attributes['recipeTitle'] ) ? $attributes['recipeTitle'] : self::$recipe->post_title );
						$class         = ' direction-step-image';
						$img_style     = isset( $node['props']['style'] ) ? $node['props']['style'] : '';

						// Try to get attachment ID by image url if attribute `key` is not found in $node array.
						if ( ! $attachment_id ) {
							$new_src = $src;

							$re = '/-\d+[Xx]\d+\./m';
							preg_match_all( $re, $src, $matches );

							// Remove image size from url to be able to get attachment id.
							// e.g. .../wp-content/uploads/sites/30/2019/10/image-example-1-500x375.jpg.
							// => .../wp-content/uploads/sites/30/2019/10/image-example-1.jpg.
							if ( isset( $matches[0][0] ) ) {
								$new_src = str_replace( $matches[0][0], '.', $new_src );
							}

							// The found post ID, or 0 on failure.
							$attachment_id = attachment_url_to_postid( $new_src );

							if ( $attachment_id ) {
								$attachment = wp_get_attachment_image(
									$attachment_id,
									'full',
									false,
									array(
										'title' => $title,
										'alt'   => $alt,
										'class' => trim( $class ),
										'style' => self::parse_tag_style( $img_style ),
									)
								);
							}
						} else {
							$attachment = wp_get_attachment_image(
								$attachment_id,
								'full',
								false,
								array(
									'title' => $title,
									'alt'   => $alt,
									'class' => trim( $class ),
									'style' => self::parse_tag_style( $img_style ),
								)
							);
						}

						if ( $attachment ) {
							$start_tag = $attachment;
						} else {
							$start_tag = sprintf(
								'<%s src="%s" title="%s" alt="%s" class="%s" style="%s"/>',
								$type,
								$src,
								$title,
								$alt,
								trim( $class ),
								self::parse_tag_style( $img_style )
							);
						}
					} else {
						$start_tag = '';
					}
					$start_tag = sprintf( '<a data-fslightbox href="%s">%s</a>', $src, $start_tag );
					$end_tag   = '';
				} elseif ( 'a' === $type ) {
					$rel        = isset( $node['props']['rel'] ) ? $node['props']['rel'] : '';
					$aria_label = isset( $node['props']['aria-label'] ) ? $node['props']['aria-label'] : '';
					$href       = isset( $node['props']['href'] ) ? $node['props']['href'] : '#';
					$target     = isset( $node['props']['target'] ) ? $node['props']['target'] : '_blank';

					$start_tag = sprintf( '<%s rel="%s" aria-label="%s" href="%s" target="%s">', $type, $rel, $aria_label, $href, $target );
				} elseif ( 'br' === $type ) {
					$end_tag = '';
				}

				$output .= $start_tag . self::wrap_direction_text( $children, $type ) . $end_tag;
			}
		}

		return $output;
	}

	/**
	 * Filter content when rendering recipe card block
	 * Add snippets at the top of post content.
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

	/**
	 * Parse HTML tag styles
	 *
	 * @since 2.1.0
	 * @param string|array $styles Tag styles to parse.
	 * @return string             CSS styles
	 */
	public static function parse_tag_style( $styles ) {
		$css = '';
		if ( is_array( $styles ) ) {
			foreach ( $styles as $property => $value ) {
				$css .= $property . ': ' . $value . ';';
			}
		} elseif ( is_string( $styles ) ) {
			$css = $styles;
		}
		return $css;
	}
}
