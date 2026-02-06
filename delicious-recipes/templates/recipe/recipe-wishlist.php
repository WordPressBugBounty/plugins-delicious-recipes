<?php
/**
 * Recipe Like button.
 *
 * @package Delicious_Recipes
 */

$classes = array( 'dr_wishlist__recipe' );

if ( $bookmarked ) :
	$classes[] = $bookmarked;
endif;
if ( $logged_in ) :
	$classes[] = 'dr-bookmark-wishlist';
else :
	$classes[] = 'dr-popup-user__registration';
endif;

$wishlist_classes = implode( ' ', $classes );

if ( $recipe_single ) :
	echo '<div class="dr-add-to-wishlist-single">';
endif;
?>
	<div class="dr-recipe-wishlist">
		<span id="dr-wishlist-id-<?php echo esc_attr( $id ); ?>" data-recipe-id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $wishlist_classes ); ?>" data-manage-labels="1" data-label-default="<?php echo esc_attr( $add_to_wishlist_lbl ); ?>" data-label-added="<?php echo esc_attr( __( 'Added to Favorites', 'delicious-recipes' ) ); ?>">
			<span class="dr-wishlist-total"><?php echo esc_html( $wishlists_count ); ?></span>
			<span class="dr-wishlist-info"><?php echo esc_html( $add_to_wishlist_lbl ); ?></span>
			<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4.16663 6.5C4.16663 5.09987 4.16663 4.3998 4.43911 3.86502C4.67879 3.39462 5.06124 3.01217 5.53165 2.77248C6.06643 2.5 6.76649 2.5 8.16663 2.5H11.8333C13.2334 2.5 13.9335 2.5 14.4683 2.77248C14.9387 3.01217 15.3211 3.39462 15.5608 3.86502C15.8333 4.3998 15.8333 5.09987 15.8333 6.5V17.5L9.99996 14.1667L4.16663 17.5V6.5Z" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</span>
	</div>
<?php
if ( $recipe_single ) :
	echo '</div>';
endif;
