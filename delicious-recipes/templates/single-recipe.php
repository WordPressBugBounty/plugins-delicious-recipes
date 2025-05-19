<?php

/**
 * The Template for displaying all single recipes
 *
 * This template can be overridden by copying it to yourtheme/delicious-recipe/single-product.php.
 *
 * HOWEVER, on occasion WP Delicious will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://wpdelicious.com/docs/template-structure/
 * @package     Delicious_Recipes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header( 'recipe' );

?>

<div class="wpdelicious-outer-wrapper">

	<?php
	/**
	 * A hook to run before the main content.
	 */
	do_action( 'delicious_recipes_before_main_content' );
	?>

	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>

		<?php delicious_recipes_get_template_part( 'content', 'single-recipe' ); ?>

		<?php
	endwhile; // end of the loop.
	?>

	<?php
	/**
	 * A hook to run after the main content.
	 */
	do_action( 'delicious_recipes_after_main_content' );
	?>

	<?php
	/**
	 * A hook to run the sidebar.
	 *
	 * @hooked delicious_recipes_get_sidebar - 10
	 */
	do_action( 'delicious_recipes_sidebar' );
	?>

</div>

<?php
get_footer( 'recipe' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */