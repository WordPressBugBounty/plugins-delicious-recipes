<?php
/**
 * Search page template
 *
 * @package Delicious_Recipes
 */

/**
 * Get page header.
 */
get_header( 'recipe' );

?>
<div class="wpdelicious-outer-wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
				/**
				 * Recipe content template load.
				 */
				delicious_recipes_get_template( 'global/searchpage-content.php' );
			?>
		</main>
	</div>
<?php
/**
 * Get sidebar.
 */
do_action( 'delicious_recipes_sidebar' );
?>
</div>
<?php
/**
 * Get footer.
 */
get_footer( 'recipe' );
