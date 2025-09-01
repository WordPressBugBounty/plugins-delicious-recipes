<?php
/**
 * Recipe page header.
 *
 * @package     DeliciousRecipes
 */

global $recipe;

// Get global toggles.
$global_toggles           = delicious_recipes_get_global_toggles_and_labels();
$recipe_global            = delicious_recipes_get_global_settings();
$comment_id               = $recipe->is_pro_active ? '#comments-' . esc_attr( $recipe->ID ) : '#comments';
$enable_comments          = isset( $recipe_global['enableComments'] ) && array( 'yes' ) === $recipe_global['enableComments'] ? true : false;
$enable_elementor_support = isset( $recipe_global['enableElementorSupport'] ) && array( 'yes' ) === $recipe_global['enableElementorSupport'] ? true : false;

$license_validity_bool  = false;
$banner_layout_id       = 'default';
$enable_breadcrumb      = false;
$enable_nutrition_value = false;
$enable_recipe_keys     = false;
$background_color       = '#f5f5f5';
$text_color             = '#000000';
$enable_recipe_info     = true;

if ( function_exists( 'DEL_RECIPE_PRO' ) ) {
	$license_validity_bool = delicious_recipe_pro_check_license_status();
	if ( $license_validity_bool && ! $enable_elementor_support ) {
		$banner_layouts         = isset( $recipe_global['bannerLayouts'] ) ? $recipe_global['bannerLayouts'] : array();
		$selected_banner_layout = isset( $recipe_global['selectedBannerLayout'] ) ? $recipe_global['selectedBannerLayout'] : array();
		$selected_banner_layout = array_filter(
			$banner_layouts,
			function ( $layout ) use ( $selected_banner_layout ) {
				return isset( $layout['id'] ) && isset( $selected_banner_layout['id'] ) && $layout['id'] === $selected_banner_layout['id'];
			}
		);
		foreach ( $selected_banner_layout as $layout ) {
			$banner_layout_id       = $layout['id'];
			$enable_breadcrumb      = isset( $layout['enableBannerBreadcrumb'] ) ? $layout['enableBannerBreadcrumb'] : $enable_breadcrumb;
			$enable_nutrition_value = isset( $layout['enableBannerNutritionalValues'] ) ? $layout['enableBannerNutritionalValues'] : $enable_nutrition_value;
			$enable_recipe_keys     = isset( $layout['enableBannerRecipeKeys'] ) ? $layout['enableBannerRecipeKeys'] : $enable_recipe_keys;
			$background_color       = isset( $layout['backgroundColor'] ) ? $layout['backgroundColor'] : '';
			$text_color             = isset( $layout['textColor'] ) ? $layout['textColor'] : '';
			$enable_recipe_info     = isset( $layout['enableBannerRecipeInfo'] ) ? $layout['enableBannerRecipeInfo'] : $enable_recipe_info;
		}
	}
}

?>
<div class="wpdelicious-recipe-banner <?php echo esc_attr( $banner_layout_id ); ?>" style="--background-color: <?php echo esc_attr( $background_color ); ?>; --text-color: <?php echo esc_attr( $text_color ); ?>;">
	<div class="container">
		<div class="wpdelicious-recipe-banner-inner">
			<?php
			if ( 'layout-2' === $banner_layout_id || 'layout-5' === $banner_layout_id ) {
					$thumbnail_id = $recipe->thumbnail_id;
				if ( $thumbnail_id ) {
					$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
					?>
						<div class="wpdelicious-recipe-banner-image">
							<img src="<?php echo esc_url( $thumbnail[0] ); ?>" alt="<?php echo esc_attr( $recipe->name ); ?>">
						</div>
					<?php
				}
			}
			?>
			<div class="wpdelicious-recipe-banner-content">
				<?php
				if ( '' !== $enable_breadcrumb ) {
					get_breadcrumbs();
				}
				?>
				<?php
				$enable_recipe_single_head = isset( $recipe_global['enableRecipeSingleHead'][0] ) && 'yes' === $recipe_global['enableRecipeSingleHead'][0] ? true : false;
				if ( $enable_recipe_single_head ) :
					?>
					<div class="wpdelicious-category">
						<?php the_terms( $recipe->ID, 'recipe-course', '', '', '' ); ?>
					</div>
					<h1 class="dr-entry-title"><?php echo esc_html( $recipe->name ); ?></h1>
					<div class="dr-entry-meta">
						<?php if ( $global_toggles['enable_recipe_author'] ) : ?>
							<span class="dr-byline">
								<?php echo get_avatar( $recipe->author_id, 32 ); ?>
								<a href="<?php echo esc_url( get_author_posts_url( $recipe->author_id ) ); ?>" class="fn"><?php echo esc_html( $recipe->author ); ?></a>
							</span>
						<?php endif; ?>

						<?php if ( $global_toggles['enable_published_date'] ) : ?>
							<span class="dr-posted-on">
								<svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M17.5 8.33341H2.5M13.3333 1.66675V5.00008M6.66667 1.66675V5.00008M7.5 13.3334L9.16667 15.0001L12.9167 11.2501M6.5 18.3334H13.5C14.9001 18.3334 15.6002 18.3334 16.135 18.0609C16.6054 17.8212 16.9878 17.4388 17.2275 16.9684C17.5 16.4336 17.5 15.7335 17.5 14.3334V7.33341C17.5 5.93328 17.5 5.23322 17.2275 4.69844C16.9878 4.22803 16.6054 3.84558 16.135 3.6059C15.6002 3.33341 14.9001 3.33341 13.5 3.33341H6.5C5.09987 3.33341 4.3998 3.33341 3.86502 3.6059C3.39462 3.84558 3.01217 4.22803 2.77248 4.69844C2.5 5.23322 2.5 5.93328 2.5 7.33341V14.3334C2.5 15.7335 2.5 16.4336 2.77248 16.9684C3.01217 17.4388 3.39462 17.8212 3.86502 18.0609C4.3998 18.3334 5.09987 18.3334 6.5 18.3334Z" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
								<time>
									<?php
									if ( isset( $global_toggles['show_updated_date'] ) && $global_toggles['show_updated_date'] ) {
										echo esc_html( delicious_recipes_get_formated_date( $recipe->date_updated ) );
									} else {
										echo esc_html( delicious_recipes_get_formated_date( $recipe->date_published ) );
									}
									?>
								</time>
							</span>
						<?php endif; ?>

						<?php if ( $recipe->rating && $global_toggles['enable_ratings'] && comments_open( $recipe->ID ) && $enable_comments ) : ?>
							<div class="dr-star-ratings-wrapper">
								<div class="dr-star-ratings">
									<div id="header-rating-container" class="wpd-rating-container" data-read-only="true" data-dynamic-rating="<?php echo $recipe->rating ? esc_attr( $recipe->rating ) : 0; ?>"></div>
								</div>
								<span class="dr-rating">
									<?php
									echo esc_html( $recipe->rating );
									printf(
										/* translators: %$s: rating count*/
										esc_html( _nx( ' / %s Review', ' / %s Reviews', absint( $recipe->rating_count ), 'number of comments', 'delicious-recipes' ) ),
										absint( $recipe->rating_count )
									);
									?>
								</span>
							</div>
						<?php endif; ?>

						<?php if ( $global_toggles['enable_comments'] && ( comments_open( $recipe->ID ) ) ) : ?>
							<span class="dr-comment">
								<svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M5.83333 7.08333H10M5.83333 10H12.5M5.83333 15V16.9463C5.83333 17.3903 5.83333 17.6123 5.92436 17.7263C6.00352 17.8255 6.12356 17.8832 6.25045 17.8831C6.39636 17.8829 6.56973 17.7442 6.91646 17.4668L8.90434 15.8765C9.31043 15.5517 9.51347 15.3892 9.73957 15.2737C9.94017 15.1712 10.1537 15.0963 10.3743 15.051C10.6231 15 10.8831 15 11.4031 15H13.5C14.9001 15 15.6002 15 16.135 14.7275C16.6054 14.4878 16.9878 14.1054 17.2275 13.635C17.5 13.1002 17.5 12.4001 17.5 11V6.5C17.5 5.09987 17.5 4.3998 17.2275 3.86502C16.9878 3.39462 16.6054 3.01217 16.135 2.77248C15.6002 2.5 14.9001 2.5 13.5 2.5H6.5C5.09987 2.5 4.3998 2.5 3.86502 2.77248C3.39462 3.01217 3.01217 3.39462 2.77248 3.86502C2.5 4.3998 2.5 5.09987 2.5 6.5V11.6667C2.5 12.4416 2.5 12.8291 2.58519 13.147C2.81635 14.0098 3.49022 14.6836 4.35295 14.9148C4.67087 15 5.05836 15 5.83333 15Z" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
								<a class="dr-comment-popup">
									<?php
									/* translators: %s: total comments count */
									printf( esc_html( _nx( '%s Comment', '%s Comments', number_format_i18n( $recipe->comments_number ), 'number of comments', 'delicious-recipes' ) ), esc_html( number_format_i18n( $recipe->comments_number ) ) );
									?>
								</a>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="wpdelicious-recipe-info-metas">
					<!-- For Servings -->
					<?php
					if ( ! empty( $recipe->no_of_servings ) && $global_toggles['enable_servings'] && $enable_recipe_info ) :
						?>
						<span class="wpdelicious-meta dr-yields">
							<svg class="icon">
								<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#yield"></use>
							</svg>
							<span>
								<?php echo esc_html( $global_toggles['servings_lbl'] ); ?>:
								<b><?php echo esc_html( $recipe->no_of_servings ); ?></b>
							</span>
						</span>
						<?php
					endif;
					?>

					<!-- For Total time -->
					<?php
					if ( ! empty( $recipe->total_time ) && $enable_recipe_info ) :
						?>
						<span class="wpdelicious-meta dr-cook-time">
							<svg class="icon">
								<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#time"></use>
							</svg>
							<?php
							if ( ! empty( $recipe->total_time ) && $global_toggles['enable_total_time'] ) :
								?>
								<span>
									<?php echo esc_html( $global_toggles['total_time_lbl'] ); ?>: <b><?php echo esc_html( $recipe->total_time ); ?></b>
								</span>
							<?php endif; ?>
						</span>
						<?php
					endif;
					?>

					<!-- For Difficulty level -->
					<?php if ( ! empty( $recipe->difficulty_level ) && $global_toggles['enable_difficulty_level'] && $enable_recipe_info ) : ?>
						<span class="wpdelicious-meta dr-label">
							<svg class="icon">
								<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#difficulty"></use>
							</svg>
							<span>
								<?php echo esc_html( $global_toggles['difficulty_level_lbl'] ) . ': '; ?>
								<b><?php echo esc_html( $recipe->difficulty_level ); ?></b>
							</span>
						</span>
						<?php
					endif;
					?>

					<!-- For Recipe Keys -->
					<?php
					if ( ! empty( $recipe->recipe_keys ) && $global_toggles['enable_recipe_keys'] && $enable_recipe_keys ) :
						?>
						<span class="dr-category dr-recipe-keys">
							<?php
							foreach ( $recipe->recipe_keys as $recipe_key ) {
								$key              = get_term_by( 'name', $recipe_key, 'recipe-key' );
								$recipe_key_metas = get_term_meta( $key->term_id, 'dr_taxonomy_metas', true );
								$key_svg          = isset( $recipe_key_metas['taxonomy_svg'] ) ? $recipe_key_metas['taxonomy_svg'] : '';
								?>
								<a href="<?php echo esc_url( get_term_link( $key, 'recipe-key' ) ); ?>" title="<?php echo esc_attr( $recipe_key ); ?>">
									<span class="dr-svg-icon">
										<?php delicious_recipes_get_tax_icon( $key ); ?>
									</span>
									<span class="cat-name"><?php echo esc_html( $recipe_key ); ?></span>
								</a>
								<?php
							}
							?>
						</span>
					<?php endif; ?>
				</div>
				
				<?php if ( $enable_nutrition_value ) : ?>
					<div class="wpdelicious-recipe-facts">
						<!-- For Recipe Calories -->
						<?php
						if ( ! empty( $recipe->recipe_calories ) && $global_toggles['enable_calories'] ) :
							?>
							<span class="wpdelicious-fact dr-calorie">
								<span class="dr-meta-title">
									<?php echo esc_html( $global_toggles['calories_lbl'] ); ?>:
								</span>
								<b><?php echo esc_html( $recipe->recipe_calories ); ?></b>
							</span>
							<?php
						endif;
						?>
						<!-- For Protein -->
						<?php
						if ( ! empty( $recipe->nutrition['protein'] ) ) :
							?>
							<span class="wpdelicious-fact dr-calorie">
								<span class="dr-meta-title">
									<?php echo esc_html__( 'Protein', 'delicious-recipes' ); ?>:
								</span>
								<b><?php echo esc_html( __( $recipe->nutrition['protein'] . 'g', 'delicious-recipes' ) ); ?></b>
							</span>
							<?php
						endif;
						?>
						<!-- For Carbs -->
						<?php
						if ( ! empty( $recipe->nutrition['carbs'] ) ) :
							?>
							<span class="wpdelicious-fact dr-calorie">
								<span class="dr-meta-title">
									<?php echo esc_html__( 'Carbs', 'delicious-recipes' ); ?>:
								</span>
								<b><?php echo esc_html( __( $recipe->nutrition['carbs'] . 'g', 'delicious-recipes' ) ); ?></b>
							</span>
							<?php
						endif;
						?>
						<!-- For Fat -->
						<?php
						if ( ! empty( $recipe->nutrition['totalFat'] ) ) :
							?>
							<span class="wpdelicious-fact dr-calorie">
								<span class="dr-meta-title">
									<?php echo esc_html__( 'Fats', 'delicious-recipes' ); ?>:
								</span>
								<b><?php echo esc_html( __( $recipe->nutrition['totalFat'] . 'g', 'delicious-recipes' ) ); ?></b>
							</span>
							<?php
						endif;
						?>
						<!-- For Fiber -->
						<?php
						if ( ! empty( $recipe->nutrition['dietaryFiber'] ) ) :
							?>
							<span class="wpdelicious-fact dr-calorie">
								<span class="dr-meta-title">
									<?php echo esc_html__( 'Fiber', 'delicious-recipes' ); ?>:
								</span>
								<b><?php echo esc_html( __( $recipe->nutrition['dietaryFiber'] . 'g', 'delicious-recipes' ) ); ?></b>
							</span>
							<?php
						endif;
						?>
						<!-- For Sugar -->
						<?php
						if ( ! empty( $recipe->nutrition['sugars'] ) ) :
							?>
							<span class="wpdelicious-fact dr-calorie">
								<span class="dr-meta-title">
									<?php echo esc_html__( 'Sugar', 'delicious-recipes' ); ?>:
								</span>
								<b><?php echo esc_html( __( $recipe->nutrition['sugars'] . 'g', 'delicious-recipes' ) ); ?></b>
							</span>
							<?php
						endif;
						?>
					</div>
				<?php endif; ?>

				<div class="dr-buttons">
					<?php if ( $global_toggles['enable_jump_to_recipe'] ) : ?>
						<a href="#dr-recipe-meta-main-<?php echo esc_attr( $recipe->ID ); ?>" class="dr-btn-link dr-btn1 dr-smooth-scroll wpdelicious-btn-jump-to-recipe"><?php echo esc_html( $global_toggles['jump_to_recipe_lbl'] ); ?>
							<svg class="icon" fill="currentColor">
								<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#go-to"></use>
							</svg>
						</a>
					<?php endif; ?>

					<?php
					if ( $global_toggles['enable_print_recipe'] ) {
						delicious_recipes_get_template_part( 'recipe/print', 'btn' );
					}
					?>

					<?php if ( ! empty( $recipe->video_gallery ) && $global_toggles['enable_jump_to_video'] ) : ?>
						<a href="#dr-video-gallery-<?php echo esc_attr( $recipe->ID ); ?>" class="dr-btn-link dr-btn1 dr-smooth-scroll wpdelicious-btn-jump-to-video">
							<?php echo esc_html( $global_toggles['jump_to_video_lbl'] ); ?>
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.16663 4.15809C4.16663 3.34879 4.16663 2.94414 4.33537 2.72108C4.48237 2.52675 4.70706 2.4065 4.95029 2.39198C5.22949 2.37531 5.56618 2.59977 6.23956 3.04869L15.0025 8.89067C15.5589 9.2616 15.8371 9.44707 15.9341 9.68084C16.0188 9.88522 16.0188 10.1149 15.9341 10.3193C15.8371 10.5531 15.5589 10.7385 15.0025 11.1095L6.23956 16.9514C5.56618 17.4004 5.22949 17.6248 4.95029 17.6082C4.70706 17.5936 4.48237 17.4734 4.33537 17.2791C4.16663 17.056 4.16663 16.6513 4.16663 15.842V4.15809Z" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</a>
					<?php endif; ?>

					<?php
					/**
					 * Recipe Wishlist button
					 */
					do_action( 'delicious_recipes_wishlist_button' );
					?>

				</div>

				<!-- For Affiliate Disclosure -->
				<?php
				if ( $license_validity_bool ) {
					$enable_disclosure  = isset( $recipe_global['enableDisclosureSingle']['0'] ) && 'yes' === $recipe_global['enableDisclosureSingle']['0'] ? true : false;
					$location           = isset( $recipe_global['disclosureLocation'] ) && $recipe_global['disclosureLocation'] ? $recipe_global['disclosureLocation'] : 'top';
					$disclosure_content = isset( $recipe_global['affiliateDisclosure'] ) && $recipe_global['affiliateDisclosure'] ? $recipe_global['affiliateDisclosure'] : '';

					if ( $enable_disclosure && $disclosure_content && 'top' === $location ) {
						$data = array(
							'disclosure_content' => $disclosure_content,
						);

						delicious_recipes_pro_get_template( 'affiliate-disclosure.php', $data );
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php
