<?php
/**
 * Recipe Summary tempalte.
 *
 * @package     DeliciousRecipes
 */

global $recipe, $wp;

// Get global toggles.
$global_toggles = delicious_recipes_get_global_toggles_and_labels();
$recipe_global  = delicious_recipes_get_global_settings();
// Image size.
$img_size        = $global_toggles['enable_recipe_image_crop'] ? 'large' : 'full';
$comment_id      = $recipe->is_pro_active ? '#comments-' . esc_attr( $recipe->ID ) : '#comments';
$enable_comments = isset( $recipe_global['enableComments'] ) && array( 'yes' ) === $recipe_global['enableComments'] ? true : false;
?>
<div class="dr-post-summary">
	<div class="dr-recipe-summary-inner">
		<div class="dr-image <?php echo esc_attr( $img_size ); ?>">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( $img_size );

				if ( delicious_recipes_enable_pinit_btn() ) :
					?>
					<span class="post-pinit-button">
						<a data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>/&media=<?php echo esc_url( $recipe->thumbnail ); ?>&description=So%20delicious!" data-pin-custom="true">
							<img src="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/pinit-sm.png" alt="pinit">
						</a>
					</span>
					<?php
				endif;
			} else {
				delicious_recipes_get_fallback_svg( $img_size );
			}
			if ( $global_toggles['enable_print_recipe'] ) :
				?>
				<div class="dr-buttons">
					<?php delicious_recipes_get_template_part( 'recipe/print', 'btn' ); ?>
				</div>
				<?php
			endif;
			?>

			<?php
			/**
			 * Recipe Wishlist button
			 */
			do_action( 'delicious_recipes_wishlist_button' );
			?>

			<?php
			/**
			 * Recipe Badges
			 */
			do_action( 'delicious_recipes_badges' );
			?>

		</div>
		<div class="dr-title-wrap">
			<?php if ( $recipe->rating_count && $global_toggles['enable_ratings'] && ( $enable_comments && comments_open( $recipe->ID ) ) ) : ?>
				<span class="dr-rating dr-star-ratings-wrapper">
					<div id="recipe-card-rating-container" class="wpd-rating-container" data-read-only="true" data-dynamic-rating="<?php echo $recipe->rating ? esc_attr( $recipe->rating ) : 0; ?>"></div>
					<?php
					$average_rating = $recipe->rating;

					if ( $average_rating ) {
						/* translators: %1$s: average rating */
						echo esc_html( sprintf( __( '%1$s from', 'delicious-recipes' ), $average_rating ) );
					}
					?>
					<span class="dr-text-red">
						<a>
							<?php
							/* translators: %s: number of comments count */
							printf( esc_html( _nx( '%s vote', '%s votes', absint( $recipe->rating_count ), 'number of comments', 'delicious-recipes' ) ), absint( $recipe->rating_count ) );
							?>
						</a>
					</span>
				</span>
			<?php endif; ?>
			<h2 class="dr-title"><?php echo esc_html( $recipe->name ); ?></h2>
			<div class="dr-entry-meta">
				<?php if ( $global_toggles['enable_author'] ) : ?>
					<span class="dr-byline">
						<span class="dr-meta-title">
							<svg class="icon">
								<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#author"></use>
							</svg>
							<?php echo esc_html( $global_toggles['author_lbl'] ); ?>:
						</span>
						<a href="<?php echo esc_url( get_author_posts_url( $recipe->author_id ) ); ?>" class="fn"><?php echo esc_html( $recipe->author ); ?></a>
					</span>
				<?php endif; ?>
				<?php
				if ( ! empty( $recipe->cooking_method ) && $global_toggles['enable_cooking_method'] ) :
					?>
					<span class="dr-method">
						<span class="dr-meta-title">
							<svg class="icon">
								<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#cooking-method"></use>
							</svg>
							<?php echo esc_html( $global_toggles['cooking_method_lbl'] ); ?>:
						</span>
						<?php the_terms( $recipe->ID, 'recipe-cooking-method', '', ', ', '' ); ?>
					</span>
					<?php
				endif;
				if ( ! empty( $recipe->recipe_cuisine ) && $global_toggles['enable_cuisine'] ) :
					?>
					<span class="dr-cuisine">
						<span class="dr-meta-title">
							<svg class="icon">
								<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#cuisine"></use>
							</svg>
							<?php echo esc_html( $global_toggles['cuisine_lbl'] ); ?>:
						</span>
						<?php the_terms( $recipe->ID, 'recipe-cuisine', '', ', ', '' ); ?>
					</span>
					<?php
				endif;
				if ( ! empty( $recipe->recipe_course ) && $global_toggles['enable_category'] ) :
					?>
					<span class="dr-category">
						<span class="dr-meta-title">
							<svg class="icon">
								<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#category"></use>
							</svg>
							<?php echo esc_html( $global_toggles['category_lbl'] ); ?>:
						</span>
						<?php the_terms( $recipe->ID, 'recipe-course', '', ', ', '' ); ?>
					</span>
					<?php
				endif;
				if ( ! empty( $recipe->recipe_keys ) && $global_toggles['enable_recipe_keys'] ) :
					?>
					<span class="dr-category dr-recipe-keys">
						<span class="dr-meta-title">
							<svg class="icon">
								<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#recipe-keys"></use>
							</svg>
							<?php echo esc_html( $global_toggles['recipe_keys_lbl'] ); ?>:
						</span>
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
		</div>
	</div>

	<div class="dr-extra-meta">
		<?php if ( ! empty( $recipe->difficulty_level ) && $global_toggles['enable_difficulty_level'] ) : ?>
			<span class="dr-sim-metaa dr-lavel">
				<span>
					<span class="dr-meta-title">
						<svg class="icon">
							<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#difficulty"></use>
						</svg>
						<?php echo esc_html( $global_toggles['difficulty_level_lbl'] ); ?>:
					</span>
					<b><?php echo esc_html( $recipe->difficulty_level ); ?></b>
				</span>
			</span>
			<?php
		endif;
		if ( ! empty( $recipe->total_time ) ) :
			?>
			<span class="dr-sim-metaa dr-cook-time">
				<span class="dr-meta-title">
					<svg class="icon">
						<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#time"></use>
					</svg>
				</span>
				<?php
				if ( ! empty( $recipe->prep_time ) && $global_toggles['enable_prep_time'] ) :
					?>
					<span class="dr-prep-time">
						<span class="dr-meta-title"><?php echo esc_html( $global_toggles['prep_time_lbl'] ); ?></span>
						<b><?php echo esc_html( $recipe->prep_time_unit ); ?></b>
					</span>
					<?php
				endif;
				if ( ! empty( $recipe->cook_time ) && $global_toggles['enable_cook_time'] ) :
					?>
					<span class="dr-cook-time">
						<span class="dr-meta-title"><?php echo esc_html( $global_toggles['cook_time_lbl'] ); ?></span>
						<b><?php echo esc_html( $recipe->cook_time_unit ); ?></b>
					</span>
					<?php
				endif;
				if ( ! empty( $recipe->rest_time ) && $global_toggles['enable_rest_time'] ) :
					?>
					<span class="dr-Rest-time">
						<span class="dr-meta-title"><?php echo esc_html( $global_toggles['rest_time_lbl'] ); ?></span>
						<b><?php echo esc_html( $recipe->rest_time_unit ); ?></b>
					</span>
					<?php
				endif;
				if ( ! empty( $recipe->total_time ) && $global_toggles['enable_total_time'] ) :
					?>
					<span class="dr-total-time">
						<span class="dr-meta-title"><?php echo esc_html( $global_toggles['total_time_lbl'] ); ?></span>
						<b><?php echo esc_html( $recipe->total_time ); ?></b>
					</span>
				<?php endif; ?>
			</span>
			<?php
		endif;
		?>
	</div>

	<div class="dr-extra-meta four-columns">
		<?php
		if ( ! empty( $recipe->cooking_temp ) && $global_toggles['enable_cooking_temp'] ) :
			?>
			<span class="dr-sim-metaa dr-cooking-temp">
				<span>
					<span class="dr-meta-title">
						<svg class="icon">
							<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#cooking-temp"></use>
						</svg>
						<?php echo esc_html( $global_toggles['cooking_temp_lbl'] ); ?>:
					</span>
					<b>
						<?php echo esc_html( $recipe->cooking_temp ); ?>&nbsp;
						<?php echo esc_html( $recipe->cooking_temp_unit ); ?>
					</b>
				</span>
			</span>
			<?php
		endif;
		if ( ! empty( $recipe->no_of_servings ) && $global_toggles['enable_servings'] ) :
			?>
			<span class="dr-sim-metaa dr-yields">
				<span>
					<span class="dr-meta-title">
						<svg class="icon">
							<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#yield"></use>
						</svg>
						<?php echo esc_html( $global_toggles['servings_lbl'] ); ?>:
					</span>
					<b><?php echo esc_html( $recipe->no_of_servings ); ?></b>
				</span>
			</span>
			<?php
		endif;
		if ( ! empty( $recipe->estimated_cost ) && $global_toggles['enable_estimated_cost'] ) :
			?>
			<span class="dr-sim-metaa dr-estimated-cost">
				<span>
					<span class="dr-meta-title">
						<svg class="icon">
							<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#estimated-cost"></use>
						</svg>
						<?php echo esc_html( $global_toggles['estimated_cost_lbl'] ); ?>:
					</span>
					<b>
						<?php
						if ( $recipe_global['globalEstimatedCostCurr'] ) {
							echo esc_html( $recipe_global['globalEstimatedCostCurr'] );
						} else {
							echo esc_html( '$' );
						}
						?>
						<?php echo esc_html( $recipe->estimated_cost ); ?>
					</b>
				</span>
			</span>
			<?php
		endif;
		if ( ! empty( $recipe->recipe_calories ) && $global_toggles['enable_calories'] ) :
			?>
			<span class="dr-sim-metaa dr-calorie">
				<span>
					<span class="dr-meta-title">
						<svg class="icon">
							<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#calories"></use>
						</svg>
						<?php echo esc_html( $global_toggles['calories_lbl'] ); ?>:
					</span>
					<b><?php echo esc_html( $recipe->recipe_calories ); ?></b>
				</span>
			</span>
			<?php
		endif;
		?>
	</div>

	<div class="dr-extra-meta two-columns">
		<?php
		if ( ! empty( $recipe->best_season ) && $global_toggles['enable_seasons'] ) :
			?>
			<span class="dr-sim-metaa dr-season">
				<span>
					<span class="dr-meta-title">
						<svg class="icon">
							<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#season"></use>
						</svg>
						<?php echo esc_html( $global_toggles['seasons_lbl'] ); ?>:
					</span>
					<b>
						<?php
						$best_season = $recipe->best_season;
						if ( ! is_array( $best_season ) ) {
							$best_season = explode( ',', $best_season );
						}
						foreach ( $best_season as $season ) {
							$comma = ( end( $best_season ) === $season ) ? '' : esc_html( ', ' );
							echo esc_html( $season . $comma );
						}
						?>
					</b>
				</span>
			</span>
		<?php endif; ?>

		<?php
		if ( ! empty( $recipe->dietary ) && $global_toggles['enable_dietary'] ) :
			?>
			<span class="dr-sim-metaa dr-category dr-dietary">
				<div>
					<span class="dr-meta-title">
						<svg class="icon">
							<use xlink:href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/sprite.svg#dietary"></use>
						</svg>
						<?php echo esc_html( $global_toggles['dietary_lbl'] ); ?>:
					</span>
					<div class="d-flex">
						<?php
						foreach ( $recipe->dietary as $dietary ) {
							$key     = get_term_by( 'name', $dietary, 'recipe-dietary' );
							$key_svg = delicious_recipes_get_tax_icon( $key, true );
							?>
							<a href="<?php echo esc_url( get_term_link( $key, 'recipe-dietary' ) ); ?>" title="<?php echo esc_attr( $dietary ); ?>">
								<?php if ( $key_svg ) { ?>
									<span class="dr-svg-icon">
										<?php echo $key_svg; ?>
									</span>
								<?php } ?>
								<span class="cat-name"><?php echo esc_html( $dietary ); ?></span>
							</a>
							<?php
						}
						?>
					</div>
				</div>
			</span>
		<?php endif; ?>
	</div>

	<?php if ( ! empty( $recipe->recipe_description ) && $global_toggles['enable_description'] ) : ?>
		<div class="dr-summary">
			<h2 class="dr-title"><?php echo esc_html( $global_toggles['description_lbl'] ); ?></h2>
			<?php
				$blocks = parse_blocks( $recipe->recipe_description );

				$output = '';
			foreach ( $blocks as $block ) {
				$output .= do_shortcode( render_block( $block ) );
			}
				echo wp_kses_post( $output );
			?>
		</div>
	<?php endif; ?>
</div>
<?php
