<?php
/**
 * Related recipes block.
 *
 * @package Delicious_Recipes
 * @since 1.6.4
 */

$global_settings = delicious_recipes_get_global_settings();

$enable_related_recipes = isset( $global_settings['enableRelatedRecipes']['0'] ) && 'yes' === $global_settings['enableRelatedRecipes']['0'] ? true : false;
if ( ! $enable_related_recipes ) {
	return;
}

$related_recipes_title   = isset( $global_settings['relatedRecipesTitle'] ) ? $global_settings['relatedRecipesTitle'] : __( "You may also like...", 'delicious-recipes'  );
$no_of_related_recipes   = isset( $global_settings['noOfRelatedRecipes'] ) ? absint( $global_settings['noOfRelatedRecipes'] ) : 3;
$related_recipes_per_row = isset( $global_settings['relatedRecipesPerRow'] ) ? absint( $global_settings['relatedRecipesPerRow'] ) : 3;
$related_recipes_filter  = isset( $global_settings['relatedRecipesFilter'] ) ? $global_settings['relatedRecipesFilter'] : 'recipe-course';

$recipe_id = get_the_ID();
$terms     = wp_get_post_terms( $recipe_id, $related_recipes_filter );
$terms_id  = wp_list_pluck( $terms, 'term_id' );
?>
<div class="wpd-related-recipes">
	<?php
		$args = array(
			'posts_per_page' => $no_of_related_recipes,
			'post_type'      => DELICIOUS_RECIPE_POST_TYPE,
			'orderby'        => 'rand',
			'post__not_in'   => array( get_the_ID() ),
			'tax_query'      => array(
				array(
					'taxonomy' => $related_recipes_filter,
					'field'    => 'term_id',
					'terms'    => $terms_id,
				),
			),
		);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			?>
			<h2 class="dr-related-recipes__title"><?php echo esc_html( $related_recipes_title ); ?></h2>
			<div class="dr-archive-list-wrapper">
				<div class="dr-archive-list-gridwrap grid wpd-columns-<?php echo esc_attr( $related_recipes_per_row ); ?>">
					<?php
					while ( $loop->have_posts() ) {
						$loop->the_post();
						delicious_recipes_get_template_part( 'recipes', 'grid' );
					}
					?>
				</div>
			</div>
			<?php
		}
		wp_reset_postdata();
		?>
</div>

<?php

