<?php
/**
 * Recipe print button.
 *
 * @package Delicious_Recipes
 */

global $recipe;

$the_permalink       = get_the_permalink();
$recipe_servimgs     = isset( $recipe->no_of_servings ) && ! empty( $recipe->no_of_servings ) ? $recipe->no_of_servings : 1;
$the_print_permalink = add_query_arg(
	array(
		'print_recipe'    => 'true',
		'recipe_servings' => absint( $recipe_servimgs ),
	),
	$the_permalink
);

// Get global toggles.
$global_toggles  = delicious_recipes_get_global_toggles_and_labels();
$global_settings = delicious_recipes_get_global_settings();

?>
	<a
		target="<?php echo esc_attr( $global_settings['printPreviewStyle'] ); ?>"
		id="dr-single-recipe-print-<?php echo esc_attr( $recipe->ID ); ?>"
		href="<?php echo esc_url( $the_print_permalink ); ?>"
		class="dr-single-recipe-print-btn-<?php echo esc_attr( $recipe->ID ); ?> dr-print-trigger dr-btn-link dr-btn2">
		<?php echo esc_html( $global_toggles['print_recipe_lbl'] ); ?>
		<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M15 5.83341V4.33341C15 3.39999 15 2.93328 14.8183 2.57676C14.6585 2.26316 14.4035 2.00819 14.0899 1.8484C13.7334 1.66675 13.2667 1.66675 12.3333 1.66675H7.66663C6.73321 1.66675 6.2665 1.66675 5.90998 1.8484C5.59637 2.00819 5.3414 2.26316 5.18162 2.57676C4.99996 2.93328 4.99996 3.39999 4.99996 4.33341V5.83341M4.99996 15.0001C4.22498 15.0001 3.83749 15.0001 3.51958 14.9149C2.65685 14.6837 1.98298 14.0099 1.75181 13.1471C1.66663 12.8292 1.66663 12.4417 1.66663 11.6667V9.83342C1.66663 8.43328 1.66663 7.73322 1.93911 7.19844C2.17879 6.72803 2.56124 6.34558 3.03165 6.1059C3.56643 5.83342 4.26649 5.83341 5.66663 5.83341H14.3333C15.7334 5.83341 16.4335 5.83342 16.9683 6.1059C17.4387 6.34558 17.8211 6.72803 18.0608 7.19844C18.3333 7.73322 18.3333 8.43328 18.3333 9.83342V11.6667C18.3333 12.4417 18.3333 12.8292 18.2481 13.1471C18.0169 14.0099 17.3431 14.6837 16.4803 14.9149C16.1624 15.0001 15.7749 15.0001 15 15.0001M12.5 8.75008H15M7.66663 18.3334H12.3333C13.2667 18.3334 13.7334 18.3334 14.0899 18.1518C14.4035 17.992 14.6585 17.737 14.8183 17.4234C15 17.0669 15 16.6002 15 15.6667V14.3334C15 13.4 15 12.9333 14.8183 12.5768C14.6585 12.2632 14.4035 12.0082 14.0899 11.8484C13.7334 11.6667 13.2667 11.6667 12.3333 11.6667H7.66663C6.73321 11.6667 6.2665 11.6667 5.90998 11.8484C5.59637 12.0082 5.3414 12.2632 5.18162 12.5768C4.99996 12.9333 4.99996 13.4 4.99996 14.3334V15.6667C4.99996 16.6002 4.99996 17.0669 5.18162 17.4234C5.3414 17.737 5.59637 17.992 5.90998 18.1518C6.2665 18.3334 6.73321 18.3334 7.66663 18.3334Z" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
	</a>
<?php
