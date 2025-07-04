<?php

/**
 * Recipe single page gallery images.
 *
 * @package     DeliciousRecipes
 */

global $recipe;

// Get global toggles.
$global_toggles           = delicious_recipes_get_global_toggles_and_labels();
$recipe_global            = delicious_recipes_get_global_settings();
$enable_elementor_support = isset( $recipe_global['enableElementorSupport'] ) && 'yes' === $recipe_global['enableElementorSupport'] ? true : false;

// Check for images.
if ( ! isset( $recipe->thumbnail_id ) || empty( $recipe->thumbnail_id ) || ! isset( $recipe->enable_image_gallery ) || ! $global_toggles['enable_recipe_featured_image'] ) {
	return;
}

// Image size.
$img_size = $global_toggles['enable_recipe_image_crop'] ? 'large' : 'full';

// Banner Layout Id.
$banner_layout_id = '';

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
			$banner_layout_id = $layout['id'];
		}
	}
}

?>
<figure class="dr-feature-image <?php echo esc_attr( $img_size ); ?>">
	<?php
	if (
		( $recipe->enable_image_gallery && ! empty( $recipe->image_gallery ) ) ||
		(
			$banner_layout_id !== 'layout-5' &&
			$banner_layout_id !== 'layout-2'
		)
	) {
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( $img_size, array( 'class' => 'avoid-lazy-load' ) );
		} else {
			echo wp_get_attachment_image( $recipe->thumbnail_id, $img_size, false, array( 'class' => 'avoid-lazy-load' ) );
		}
	}
	?>


	<?php if ( delicious_recipes_enable_pinit_btn() ) : ?>
		<span class="post-pinit-button">
			<a data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>/&media=<?php echo esc_url( $recipe->thumbnail ); ?>&description=So%20delicious!" data-pin-custom="true">
				<img src="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>assets/images/pinit-sm.png" alt="pinit">
			</a>
		</span>
	<?php endif; ?>

	<?php if ( isset( $recipe->enable_image_gallery ) && $recipe->enable_image_gallery && isset( $recipe->image_gallery ) && ! empty( $recipe->image_gallery ) ) : ?>
		<!-- Hidden links to trigger the lightbox, one per image -->
		<?php foreach ( $recipe->image_gallery as $image ) : ?>
			<a href="<?php echo esc_url( $image['previewURL'] ); ?>" data-fslightbox="gallery" style="display:none;"></a>
		<?php endforeach; ?>

		<!-- Visible button to open the lightbox -->
		<a type="button" class="view-gallery-btn">
			<b><?php echo esc_html__( 'View Gallery', 'delicious-recipes' ); ?></b>
			<span>
				<?php
				/* translators: %1$s: gallery images count */
				printf( esc_html( _nx( '%1$s photo', '%1$s photos', count( $recipe->image_gallery ), 'gallery images count', 'delicious-recipes' ) ), esc_html( number_format_i18n( count( $recipe->image_gallery ) ) ) );
				?>
			</span>
			<svg xmlns="http://www.w3.org/2000/svg" width="14.796" height="10.354" viewBox="0 0 14.796 10.354">
				<g transform="translate(0.75 1.061)">
					<path d="M7820.11-1126.021l4.117,4.116-4.117,4.116" transform="translate(-7811.241 1126.021)" fill="none" stroke="#374757" stroke-linecap="round" stroke-width="1.5" />
					<path d="M6555.283-354.415h-12.624" transform="translate(-6542.659 358.532)" fill="none" stroke="#374757" stroke-linecap="round" stroke-width="1.5" />
				</g>
			</svg>
		</a>
	<?php endif; ?>
</figure>
<?php
