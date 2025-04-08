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
			$recipe_key   = isset( $recipeKey ) ? $recipeKey : array();
			$recipe_dietary = isset( $recipeDietary ) ? $recipeDietary : array();

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

			Delicious_Dynamic_Recipe_Card::$attributes['summaryTitle']     = isset( $summary_title ) ? $summary_title : __( 'Description', 'delicious-recipes' );
			Delicious_Dynamic_Recipe_Card::$attributes['ingredientsTitle'] = isset( $ingredients_title ) ? $ingredients_title : __( 'Ingredients', 'delicious-recipes' );
			Delicious_Dynamic_Recipe_Card::$attributes['directionsTitle']  = isset( $directions_title ) ? $directions_title : __( 'Instructions', 'delicious-recipes' );
			Delicious_Dynamic_Recipe_Card::$attributes['videoTitle']       = isset( $video_title ) ? $video_title : __( 'Video', 'delicious-recipes' );
			Delicious_Dynamic_Recipe_Card::$attributes['difficultyTitle']  = isset( $difficulty_title ) ? $difficulty_title : __( 'Difficulty', 'delicious-recipes' );
			Delicious_Dynamic_Recipe_Card::$attributes['seasonTitle']      = isset( $season_title ) ? $season_title : __( 'Best Season', 'delicious-recipes' );
			Delicious_Dynamic_Recipe_Card::$attributes['notesTitle']       = isset( $notes_title ) ? $notes_title : __( 'Notes', 'delicious-recipes' );

			$class               = 'dr-summary-holder wp-block-delicious-recipes-block-recipe-card';
			$class              .= $has_image && isset( $image['url'] ) ? '' : ' recipe-card-noimage';
			$RecipeCardClassName = implode( ' ', array( $class, $class_name ) );

			$custom_author_name = $recipe_author_name;
			if ( ! empty( $settings['custom_author_name'] ) ) {
				$custom_author_name = $settings['custom_author_name'];
			}

			if ( $hasImage && isset( $image['url'] ) ) {
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

			// Store time content separately
			$time_content = '';
			if ( $settings['displayPrepTime'] && ! empty( $details[0]['value'] ) ) {
				$time_content .= sprintf(
					'<div class="dr-ingredient-meta dr-ingredient-time">
						<div class="meta-wrap">
							<div class="dr-prep-time">
								<span class="dr-ingredient-time-title">%s</span>
								<span>%s</span>
							</div>',
					$details[0]['label'],
					$details[0]['value'] . ' ' . $details[0]['unit']
				);
			}

			if ( $settings['displayCookingTime'] && ! empty( $details[1]['value'] ) ) {
				$time_content .= sprintf(
					'<div class="dr-cook-time">
						<span class="dr-ingredient-time-title">%s</span>
						<span>%s</span>
					</div>',
					$details[1]['label'],
					$details[1]['value'] . ' ' . $details[1]['unit']
				);
			}

			if ( $settings['displayRestTime'] && ! empty( $details[2]['value'] ) ) {
				$time_content .= sprintf(
					'<div class="dr-rest-time">
						<span class="dr-ingredient-time-title">%s</span>
						<span>%s</span>
					</div>',
					$details[2]['label'],
					$details[2]['value'] . ' ' . $details[2]['unit']
				);
			}

			if ( $settings['displayTotalTime'] && ! empty( $details[3]['value'] ) ) {
				$time_content .= sprintf(
					'<div class="dr-total-time">
						<span class="dr-ingredient-time-title">%s</span>
						<span>%s</span>
					</div>
						</div>
					</div>',
					$details[3]['label'],
					$details[3]['value'] . ' ' . $details[3]['unit']
				);
			}

			if ( $settings['displayCookingMethod'] && ! empty( $method ) ) {
				$label            = __( 'Cooking Method', 'delicious-recipes' );
				$svg              = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#cooking-method"></use></svg>';
				$details_content .= sprintf(
					'<div class="dr-ingredient-meta">
						<b>%s</b>
						<span>%s</span>
					</div>',
					$label,
					implode( ', ', $method )
				);
			}
			if ( $settings['displayCuisine'] && ! empty( $cuisine ) ) {
				$label            = __( 'Cuisine', 'delicious-recipes' );
				$svg              = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#cuisine"></use></svg>';
				$details_content .= sprintf(
					'<div class="dr-ingredient-meta">
						<b>%s</b>
						<span>%s</span>
					</div>',
					$label,
					implode( ', ', $cuisine )
				);
			}
			if ( $settings['displayCourse'] && ! empty( $course ) && 'Uncategorized' === $course ) {
				$label            = __( 'Courses', 'delicious-recipes' );
				$svg              = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#category"></use></svg>';
				$details_content .= sprintf(
					'<div class="dr-ingredient-meta">
						<b>%s:</b>
						<span>%s</span>
					</div>',
					$label,
					implode( ', ', $course )
				);
			}
			if ( $settings['displayRecipeKey'] && ! empty( $recipe_key ) ) {
				$label            = __( 'Recipe Keys', 'delicious-recipes' );
				$svg              = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#recipe-keys"></use></svg>';
				$details_content .= sprintf(
					'<div class="dr-ingredient-meta">
						<b>%s</b>
						<span>%s</span>
					</div>',
					$label,
					implode( ', ', $recipe_key )
				);
			}

			if ( $settings['displayRecipeDietary'] && ! empty( $recipe_dietary ) ) {
				$label            = __( 'Dietary', 'delicious-recipes' );
				$svg              = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#dietary"></use></svg>';
				$details_content .= sprintf(
					'<div class="dr-ingredient-meta">
						<b>%s</b>
						<span>%s</span>
					</div>',
					$label,
					implode( ', ', $recipe_dietary )
				);
			}

			$difficulty       = isset( $difficulty ) && $settings['displayDifficulty'] ? $difficulty : '';
			$difficulty_title = isset( $difficulty_title ) ? $difficulty_title : __( 'Difficulty', 'delicious-recipes' );
			if ( $difficulty ) {
				$svg              = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#difficulty"></use></svg>';
				$details_content .= sprintf(
					'<div class="dr-ingredient-meta">
						<b>%s</b>
						<span>%s</span>
					</div>',
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

				// Skip time-related details since they are handled separately
				if ( 0 === $index || 1 === $index || 2 === $index || 3 === $index ) {
					continue;
				} elseif ( 4 === $index && '1' != $settings['displayServings'] ) {
					continue;
				} elseif ( 5 === $index && '1' != $settings['displayCalories'] ) {
					continue;
				} elseif ( 6 === $index && '1' != $settings['displayEstimatedCost'] ) {
					continue;
				} elseif ( 7 === $index && '1' != $settings['displayCalories'] ) {
					continue;
				}

				$details_content .= sprintf(
					'<div class="dr-ingredient-meta">
						<b>%s</b>
						<span>%s</span>
					</div>',
					$label,
					$value . ' ' . $unit
				);
			}

			$season       = isset( $season ) && $settings['displayBestSeason'] ? $season : array();
			foreach ( $season as $index => $season_item ) {
				$season[$index] = ucfirst( $season_item );
			}
			$season_title = isset( $season_title ) ? $season_title : __( 'Best Season', 'delicious-recipes' );
			if ( $season ) {
				$svg              = '<svg class="icon"><use xlink:href="' . esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/images/sprite.svg#season"></use></svg>';
				$details_content .= sprintf(
					'<div class="dr-ingredient-meta">
						<b>%s</b>
						<span>%s</span>
					</div>',
					$season_title,
					implode( ', ', $season )
				);
			}

			// Wrap all meta content in dr-recipe-info-box
			if ( ! empty( $details_content ) ) {
				$details_content = '<div class="dr-recipe-info-box">' . $details_content . '</div>';
			}

			// $details_content     = Delicious_Dynamic_Recipe_Card::get_details_content( $details );
			$ingredients_content = Delicious_Dynamic_Recipe_Card::get_ingredients_content( $ingredients );
			$steps_content       = Delicious_Dynamic_Recipe_Card::get_steps_content( $steps );

			$summary_text  = '';
			$summary_title = isset( $summary_title ) ? $summary_title : __( 'Description', 'delicious-recipes' );
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
			$notes_title      = isset( $notes_title ) ? $notes_title : __( 'Notes', 'delicious-recipes' );
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
					<div class="wpd-print-button-wrap">
						<button class="dr-button" onclick="window.print();"><?php esc_html_e( 'Print', 'delicious-recipes' ); ?> 
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_4315_1351)">
								<path d="M15.0001 5.83332V4.33332C15.0001 3.3999 15.0001 2.93319 14.8184 2.57667C14.6586 2.26307 14.4037 2.0081 14.0901 1.84831C13.7335 1.66666 13.2668 1.66666 12.3334 1.66666H7.66675C6.73333 1.66666 6.26662 1.66666 5.9101 1.84831C5.59649 2.0081 5.34153 2.26307 5.18174 2.57667C5.00008 2.93319 5.00008 3.3999 5.00008 4.33332V5.83332M5.00008 15C4.22511 15 3.83762 15 3.5197 14.9148C2.65697 14.6836 1.9831 14.0098 1.75193 13.147C1.66675 12.8291 1.66675 12.4416 1.66675 11.6667V9.83332C1.66675 8.43319 1.66675 7.73313 1.93923 7.19835C2.17892 6.72794 2.56137 6.34549 3.03177 6.10581C3.56655 5.83332 4.26662 5.83332 5.66675 5.83332H14.3334C15.7335 5.83332 16.4336 5.83332 16.9684 6.10581C17.4388 6.34549 17.8212 6.72794 18.0609 7.19835C18.3334 7.73313 18.3334 8.43319 18.3334 9.83332V11.6667C18.3334 12.4416 18.3334 12.8291 18.2482 13.147C18.0171 14.0098 17.3432 14.6836 16.4805 14.9148C16.1625 15 15.7751 15 15.0001 15M12.5001 8.74999H15.0001M7.66675 18.3333H12.3334C13.2668 18.3333 13.7335 18.3333 14.0901 18.1517C14.4037 17.9919 14.6586 17.7369 14.8184 17.4233C15.0001 17.0668 15.0001 16.6001 15.0001 15.6667V14.3333C15.0001 13.3999 15.0001 12.9332 14.8184 12.5767C14.6586 12.2631 14.4037 12.0081 14.0901 11.8483C13.7335 11.6667 13.2668 11.6667 12.3334 11.6667H7.66675C6.73333 11.6667 6.26662 11.6667 5.9101 11.8483C5.59649 12.0081 5.34153 12.2631 5.18174 12.5767C5.00008 12.9332 5.00008 13.3999 5.00008 14.3333V15.6667C5.00008 16.6001 5.00008 17.0668 5.18174 17.4233C5.34153 17.7369 5.59649 17.9919 5.9101 18.1517C6.26662 18.3333 6.73333 18.3333 7.66675 18.3333Z" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
								</g>
								<defs>
								<clipPath id="clip0_4315_1351">
								<rect width="20" height="20" fill="currentColor"/>
								</clipPath>
								</defs>
							</svg>
						</button>
					</div>
					<div class="print-page">
						<div id="dr-page1" class="dr-print-header">
							<h1 id="dr-print-title" class="dr-print-title"><?php echo esc_html( $recipe->post_title ); ?></h1>
							<div class="dr-print-img">
								<?php echo wp_kses_post( $recipe_card_image ); ?>
							</div>
						</div><!-- #dr-page1 -->
						<div id="dr-page2" class="dr-print-page dr-print-ingredients">
							<div class="dr-ingredient-meta-wrap">
								<?php echo wp_kses_post( $time_content ); ?>
								<?php echo wp_kses_post( $details_content ); ?>
							</div>
							<div class="dr-print-block-wrap">
								<div class="dr-print-block dr-description-wrap">
									<?php echo wp_kses_post( $summary_text ); ?>
								</div>
								<div class="dr-print-block dr-ingredients-wrap">
									<?php echo wp_kses_post( $ingredients_content ); ?>
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
				</div>
				<?php
		}
		?>
	</body>
</html>
<?php
