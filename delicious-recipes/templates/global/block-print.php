<?php
/**
 * Template to be used for the recipe print page.
 *
 * @since       1.0.8
 *
 * @package     WP Delicious
 */

$asset_script_path = '/min/';
$min_prefix        = '.min';

if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
	$asset_script_path = '/';
	$min_prefix        = '';
}
$recipe_card_image = '';
?>
<!DOCTYPE html>
<html <?php echo esc_html( get_language_attributes() ); ?>>
	<head>
		<title><?php echo esc_html( $recipe->post_title ); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta name="robots" content="noindex">
		<?php wp_site_icon(); ?>
		<link rel="stylesheet" href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/public/css' . $asset_script_path . 'recipe-print' . $min_prefix . '.css'; ?>" media="screen,print">
		<?php delicious_recipes_get_template( 'global/dynamic-css.php' ); ?>
	</head>
	<body class="delrecipes-block-print" data-recipe-id="<?php echo esc_attr( $recipe_id ); ?>">
		<?php
		if ( ! is_array( $attributes ) ) {
			echo wp_kses_post( $content );
		} else {
			extract( $attributes );

			// Recipe post variables.
			$recipe_id            = $recipe->ID;
			$recipe_title         = get_the_title( $recipe );
			$recipe_thumbnail_url = get_the_post_thumbnail_url( $recipe );
			$recipe_thumbnail_id  = get_post_thumbnail_id( $recipe );
			$recipe_permalink     = get_the_permalink( $recipe );
			$recipe_author_name   = get_the_author_meta( 'display_name', $recipe->post_author );
			$attachment_id        = isset( $image['id'] ) ? $image['id'] : $recipe_thumbnail_id;

			// Variables from attributes add default value if not exists.
			$recipe_title = isset( $recipe_title ) ? $recipe_title : '';
			$summary      = isset( $summary ) ? $summary : '';
			$class_name   = isset( $class_name ) ? $class_name : '';
			$has_image    = isset( $has_image ) ? $has_image : false;
			$course       = isset( $course ) ? $course : array();
			$cuisine      = isset( $cuisine ) ? $cuisine : array();
			$method       = isset( $method ) ? $method : array();
			$recipe_key   = isset( $recipe_key ) ? $recipe_key : array();
			$difficulty   = isset( $difficulty ) ? $difficulty : array();
			$keywords     = isset( $keywords ) ? $keywords : array();
			$details      = isset( $details ) ? $details : array();
			$ingredients  = isset( $ingredients ) ? $ingredients : array();
			$steps        = isset( $steps ) ? $steps : array();

			// Store variables.
			$helpers  = new Delicious_Recipes_Helpers();
			$settings = $helpers->parse_block_settings( $attributes );

			Delicious_Dynamic_Recipe_Card::$recipeBlockID = isset( $id ) ? esc_attr( $id ) : 'dr-dynamic-recipe-card';
			Delicious_Dynamic_Recipe_Card::$attributes    = $attributes;
			Delicious_Dynamic_Recipe_Card::$settings      = $settings;

			Delicious_Dynamic_Recipe_Card::$attributes['summaryTitle']     = isset( $summary_title ) ? $summary_title : __( "Description", 'delicious-recipes' );
			Delicious_Dynamic_Recipe_Card::$attributes['ingredientsTitle'] = isset( $ingredients_title ) ? $ingredients_title : __( "Ingredients", 'delicious-recipes' );
			Delicious_Dynamic_Recipe_Card::$attributes['directionsTitle']  = isset( $directions_title ) ? $directions_title : __( "Instructions", 'delicious-recipes' );
			Delicious_Dynamic_Recipe_Card::$attributes['videoTitle']       = isset( $video_title ) ? $video_title : __( "Video", 'delicious-recipes' );
			Delicious_Dynamic_Recipe_Card::$attributes['difficultyTitle']  = isset( $difficulty_title ) ? $difficulty_title : __( "Difficulty", 'delicious-recipes' );
			Delicious_Dynamic_Recipe_Card::$attributes['seasonTitle']      = isset( $season_title ) ? $season_title : __( "Best Season", 'delicious-recipes' );
			Delicious_Dynamic_Recipe_Card::$attributes['notesTitle']       = isset( $notes_title ) ? $notes_title : __( "Notes", 'delicious-recipes' );

			$class               = 'dr-summary-holder wp-block-delicious-recipes-block-recipe-card';
			$class              .= $has_image && isset( $image['url'] ) ? '' : ' recipe-card-noimage';
			$RecipeCardClassName = implode( ' ', array( $class, $class_name ) );

			$custom_author_name = $recipe_author_name;
			if ( ! empty( $settings['custom_author_name'] ) ) {
				$custom_author_name = $settings['custom_author_name'];
			}

			if ( $has_image && isset( $image['url'] ) ) {
				$img_id    = $image['id'];
				$src       = $image['url'];
				$alt       = ( $recipe_title ? strip_tags( $recipe_title ) : strip_tags( $recipe_title ) );
				$img_class = ' delicious-recipes-card-image';

				// Check if attachment image is from imported content in this case we don't have attachment in our upload directory.
				$upl_dir = wp_upload_dir();
				$findpos = strpos( $src, $upl_dir['baseurl'] );

				if ( false === $findpos ) {
					$attachment = sprintf(
						'<img src="%s" alt="%s" class="%s"/>',
						$src,
						$alt,
						trim( $img_class )
					);
				} else {
					$attachment = wp_get_attachment_image(
						$img_id,
						'large',
						false,
						array(
							'alt'   => $alt,
							'id'    => $img_id,
							'class' => trim( $img_class ),
						)
					);
				}

				$recipe_card_image = $attachment;
			} elseif ( ! $has_image && ! empty( $recipe_thumbnail_url ) ) {
				$img_id    = $recipe_thumbnail_id;
				$src       = $recipe_thumbnail_url;
				$alt       = ( $recipe_title ? strip_tags( $recipe_title ) : strip_tags( $recipe_title ) );
				$img_class = ' delicious-recipes-card-image';

				// Check if attachment image is from imported content in this case we don't have attachment in our upload directory.
				$upl_dir = wp_upload_dir();
				$findpos = strpos( $src, $upl_dir['baseurl'] );

				if ( false === $findpos ) {
					$attachment = sprintf(
						'<img src="%s" alt="%s" class="%s"/>',
						$src,
						$alt,
						trim( $img_class )
					);
				} else {
					$attachment = wp_get_attachment_image(
						$img_id,
						'large',
						false,
						array(
							'alt'   => $alt,
							'id'    => $img_id,
							'class' => trim( $img_class ),
						)
					);
				}

				$recipe_card_image = $attachment;
			}

			$details_content = '';

			if ( $settings['displayCookingMethod'] && ! empty( $method ) ) {
				$label            = __( 'Cooking Method', 'delicious-recipes' );
				$svg              = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#cooking-method"></use></svg>';
				$details_content .= sprintf(
					'<div class="%1$s">%2$s<b>%3$s</b><span>%4$s</span></div>',
					'dr-ingredient-meta',
					$svg,
					$label,
					implode( ', ', $method )
				);
			}
			if ( $settings['displayCuisine'] && ! empty( $cuisine ) ) {
				$label            = __( 'Cuisine', 'delicious-recipes' );
				$svg              = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#cuisine"></use></svg>';
				$details_content .= sprintf(
					'<div class="%1$s">%2$s<b>%3$s</b><span>%4$s</span></div>',
					'dr-ingredient-meta',
					$svg,
					$label,
					implode( ', ', $cuisine )
				);
			}
			if ( $settings['displayCourse'] && ! empty( $course ) ) {
				$label            = __( 'Courses', 'delicious-recipes' );
				$svg              = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#category"></use></svg>';
				$details_content .= sprintf(
					'<div class="%1$s">%2$s<b>%3$s</b><span>%4$s</span></div>',
					'dr-ingredient-meta',
					$svg,
					$label,
					implode( ', ', $course )
				);
			}
			if ( $settings['displayRecipeKey'] && ! empty( $recipe_key ) ) {
				$label            = __( 'Recipe Keys', 'delicious-recipes' );
				$svg              = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#recipe-keys"></use></svg>';
				$details_content .= sprintf(
					'<div class="%1$s">%2$s<b>%3$s</b><span>%4$s</span></div>',
					'dr-ingredient-meta',
					$svg,
					$label,
					implode( ', ', $recipe_key )
				);
			}

			$difficulty       = isset( $difficulty ) && $settings['displayDifficulty'] ? $difficulty : '';
			$difficulty_title = isset( $difficulty_title ) ? $difficulty_title : __( "Difficulty", 'delicious-recipes' );
			if ( $difficulty ) {
				$svg              = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#difficulty"></use></svg>';
				$details_content .= sprintf(
					'<div class="%1$s">%2$s<b>%3$s</b><span>%4$s</span></div>',
					'dr-ingredient-meta',
					$svg,
					$difficulty_title,
					ucfirst( $difficulty )
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
				}

				if ( ! empty( $detail['value'] ) ) {
					if ( ! is_array( $detail['value'] ) ) {
						$value = $detail['value'];
					} elseif ( isset( $detail['jsonValue'] ) ) {
						$value = $detail['jsonValue'];
					}
				}

				if ( 0 === $index && '1' !== $settings['displayPrepTime'] ) {
					continue;
				} elseif ( 1 === $index && '1' !== $settings['displayCookingTime'] ) {
					continue;
				} elseif ( 2 === $index && '1' !== $settings['displayRestTime'] ) {
					continue;
				} elseif ( 3 === $index && '1' !== $settings['displayTotalTime'] ) {
					continue;
				} elseif ( 4 === $index && '1' !== $settings['displayServings'] ) {
					continue;
				} elseif ( 5 === $index && '1' !== $settings['displayCalories'] ) {
					continue;
				}

				// convert minutes to hours for 'prep time', 'cook time' and 'total time'.
				if ( 0 === $index || 1 === $index || 2 === $index || 3 === $index ) {
					if ( ! empty( $detail['value'] ) ) {
						$converts = $helpers->convertMinutesToHours( $detail['value'], true );
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

				$details_content .= sprintf(
					'<div class="%1$s">%2$s<b>%3$s</b><span>%4$s</span></div>',
					'dr-ingredient-meta',
					$icon_svg,
					$label,
					$value . ' ' . $unit
				);

			}

			$season       = isset( $season ) && $settings['displayBestSeason'] ? $season : '';
			$season_title = isset( $season_title ) ? $season_title : __( "Best Season", 'delicious-recipes' );
			if ( $season ) {
				$svg              = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#season"></use></svg>';
				$details_content .= sprintf(
					'<div class="%1$s">%2$s<b>%3$s</b><span>%4$s</span></div>',
					'dr-ingredient-meta',
					$svg,
					$season_title,
					ucfirst( $season )
				);
			}

			// $details_content     = Delicious_Dynamic_Recipe_Card::get_details_content( $details );
			$ingredients_content = Delicious_Dynamic_Recipe_Card::get_ingredients_content( $ingredients );
			$steps_content       = Delicious_Dynamic_Recipe_Card::get_steps_content( $steps );

			$summary_text  = '';
			$summary_title = isset( $summary_title ) ? $summary_title : __( "Description", 'delicious-recipes' );
			if ( ! empty( $summary ) ) {
				$summary_class = 'dr-pring-block-header';
				$summary_text  = sprintf(
					'<div class="%s"><div class="%s"><span>%s</span></div></div>
                        <div class="dr-pring-block-content">%s</div>',
					esc_attr( $summary_class ),
					'dr-print-block-title',
					$summary_title,
					$summary
				);
			}

			$strip_tags_notes = isset( $notes ) ? strip_tags( $notes ) : '';
			$notes            = isset( $notes ) ? str_replace( '<li></li>', '', $notes ) : '';     // remove empty list item
			$notes_title      = isset( $notes_title ) ? $notes_title : __( "Notes", 'delicious-recipes' );
			$notes_content    = ! empty( $strip_tags_notes ) ?
				sprintf(
					'<div class="dr-note">
                            <div class="dr-print-block-title"><span>%s</span></div>
                            %s
                        </div>',
					$notes_title,
					$notes
				) : '';

			$keywords_text = '';
			if ( ! empty( $keywords ) ) {
				$keywords_class = 'dr-keywords dr-keywords-block';
				$keywords_text  = sprintf(
					'<div class="%s"><span class="%s">%s</span>%s</div>',
					esc_attr( $keywords_class ),
					'dr-meta-title',
					__( 'Keywords: ', 'delicious-recipes' ),
					implode( ', ', $keywords )
				);
			}

			?>
				<div class="dr-print-outer-wrap">
					<div id="dr-page1" class="dr-print-header">
						<h1 id="dr-print-title" class="dr-print-title"><?php echo esc_html( $recipe->post_title ); ?></h1>
						<div class="dr-print-img">
						<?php echo wp_kses_post( $recipe_card_image ); ?>
						</div>
					</div><!-- #dr-page1 -->
					<div id="dr-page2" class="dr-print-page dr-print-ingredients">
						<div class="dr-ingredient-meta-wrap">
						<?php echo wp_kses_post( $details_content ); ?>
						</div>
						<div class="dr-print-block-wrap">
							<div class="dr-print-block dr-ingredients-wrap">
							<?php echo wp_kses_post( $ingredients_content ); ?>
							</div>
							<div class="dr-print-block dr-description-wrap">
							<?php echo wp_kses_post( $summary_text ); ?>
							</div>
						</div>
					</div><!-- #dr-page2 -->
					<div id="dr-page3" class="dr-print-page dr-print-instructions">
						<div class="dr-print-block">
						<?php echo wp_kses_post( $steps_content ); ?>
						</div>
					</div><!-- #dr-page3 -->
					<div id="dr-page5" class="dr-print-page dr-print-nutrition">
						<div class="dr-print-block dr-wrap-notes-keywords">
						<?php echo wp_kses_post( $notes_content ); ?>
						<?php echo wp_kses_post( $keywords_text ); ?>
						</div>
					</div><!-- #dr-page5 -->
				</div>
				<?php
		}
		?>
	</body>
</html>
<?php
