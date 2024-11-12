<?php
/**
 * Recipe Archive Pagination
 *
 * This template can be overridden by copying it to yourtheme/delicious-recipe/archive/pagination.php.
 *
 * HOWEVER, on occasion WP Delicious will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://wpdelicious.com/docs/template-structure/
 * @package     Delicious_Recipes/Templates
 * @version     1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_post_type_archive( DELICIOUS_RECIPE_POST_TYPE ) ) {
	echo '</div>';
}
?>
<div class="dr-archive-pagination">
	<?php
	// get pagination type from global settings
	$global_settings = delicious_recipes_get_global_settings();
	$pagination_type = isset( $global_settings['archivePaginationStyle'] ) && ! empty( $global_settings['archivePaginationStyle'] ) ? $global_settings['archivePaginationStyle'] : 'simple';

	echo wp_kses_post( delicious_recipes_display_recipes_pagination( array( 'pagination_type' => $pagination_type ) ) );
	?>
</div>

<?php
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
