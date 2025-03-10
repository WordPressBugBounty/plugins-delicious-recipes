<?php
/**
 * Recipes Likes / wishlists Class
 *
 * @package Delicious_Recipes
 */
class Delicious_Recipes_Likes_Wishlists {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp_ajax_recipe_likes', array( $this, 'recipe_like_cb' ) );
		add_action( 'wp_ajax_nopriv_recipe_likes', array( $this, 'recipe_like_cb' ) );
		add_action( 'delicious_recipes_like_button', array( $this, 'recipe_like_button' ), 10 );

		// Recipe Wishlists.
		add_action( 'delicious_recipes_wishlist_button', array( $this, 'recipe_wishlist_button' ), 10, 1 );
		add_action( 'wp_ajax_delicious_recipes_wishlist', array( &$this, 'recipe_wishlist_cb' ) );
		add_action( 'delicious_recipes_badges', array( &$this, 'recipe_badges' ) );

		// AJAX fetch recipe liskes.
		add_action( 'wp_ajax_recipe_get_likes', array( $this, 'get_likes' ) );
		add_action( 'wp_ajax_nopriv_recipe_get_likes', array( $this, 'get_likes' ) );

		//AJAX check if non-logged in user have liked based on unique identifier we created.
		add_action( 'wp_ajax_nopriv_delicious_recipes_check_like_for_logged_out_users', array( $this, 'check_like' ) );
	}

	/**
	 * Get Real IP Address from client.
	 */
	public function get_real_ip_address() {
		if ( getenv( 'HTTP_CLIENT_IP' ) ) {
			$ip = getenv( 'HTTP_CLIENT_IP' );
		} elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
			$ip = getenv( 'HTTP_X_FORWARDED_FOR' );
		} elseif ( getenv( 'HTTP_X_FORWARDED' ) ) {
			$ip = getenv( 'HTTP_X_FORWARDED' );
		} elseif ( getenv( 'HTTP_FORWARDED_FOR' ) ) {
			$ip = getenv( 'HTTP_FORWARDED_FOR' );
		} elseif ( getenv( 'HTTP_FORWARDED' ) ) {
			$ip = getenv( 'HTTP_FORWARDED' );
		} else {
			$ip = isset( $_SERVER['REMOTE_ADDR'] );
		}

		return $ip;
	}

	/**
	 * Check if user can like the recipes post
	 *
	 * @param integer $id Post ID.
	 * @return boolean
	 */
	public function can_like( $id = 0 ) {
		// Return early if $id is not set.
		if ( ! $id ) {
			return false;
		}

		//if user is logged in, return true.
		if ( is_user_logged_in() ) {
			$recipe_likes_ip = get_post_meta( $id, '_recipe_likes_ip', true );
			$curr_user_id	 = get_current_user_id();
			if ( ! empty( $recipe_likes_ip ) && in_array( $curr_user_id, $recipe_likes_ip ) ) {
				return false;
			} 
		}
	
		return true; // Default case

		/**
		 * @deprecated code @since 1.8.0 since we changed checking likes from IP Address to Unique User ID we created and assigned for not logged in users.
		 */
		// $ip_list = ( $ip = get_post_meta( $id, '_recipe_likes_ip', true ) ) ? $ip : array();
		// if ( ( $ip_list == '' ) || ( is_array( $ip_list ) && ! in_array( $this->get_real_ip_address(), $ip_list ) ) ) {
		// 	return true;
		// }
	}

	/**
	 * Check if user has liked the recipe post
	 *
	 * @return void
	 */
	public function check_like() {
		if ( isset( $_POST['id'] ) && isset( $_POST['unique_user_id'] ) ) :
			$post_id = intval( $_POST['id'] );
			$ip_list = ( $ip = get_post_meta( $post_id, '_recipe_likes_ip', true ) ) ? $ip : array();
			$unique_user_id = sanitize_text_field( wp_unslash( $_POST['unique_user_id'] ) );
			if ( ( $ip_list == '' ) || ( is_array( $ip_list ) && ! in_array( $unique_user_id, $ip_list ) ) ) :
				wp_send_json_success( array( 'can_like' => true ) );
			else :
				wp_send_json_success( array( 'can_like' => false ) );
			endif;
		else :
			wp_send_json_error();
		endif;
		wp_die();
	}


	/**
	 * Like button template
	 *
	 * @return void
	 */
	public function recipe_like_button( $recipe_id = '' ) {
		if ( $recipe_id == '' ) {
			global $recipe;
			$recipe_id = $recipe->ID;
		}
		$like_count = $this->get_recipe_like_count( $recipe_id );

		delicious_recipes_get_template(
			'recipe/recipe-like.php',
			array(
				'like_count' => $like_count,
				'id'         => $recipe_id,
				'can_like'   => $this->can_like( $recipe_id ),
			)
		);
	}

	/**
	 * AJAX callback for recipe likes.
	 *
	 * @return void
	 */
	public function recipe_like_cb() {
		if ( isset( $_POST['id'] ) && isset( $_POST['add_remove'] ) ) :
	
			$post_id = intval( $_POST['id'] );
			$likes   = ( $count = get_post_meta( $post_id, '_recipe_likes', true ) ) ? absint( $count ) : 0;
			$ip_list = ( $ip = get_post_meta( $post_id, '_recipe_likes_ip', true ) ) ? $ip : array();
	
			$add_remove = sanitize_title( wp_unslash( $_POST['add_remove'] ) );
	
			// Check if the user is logged in and get the user ID
			$current_user_id = is_user_logged_in() ? get_current_user_id() : null;
	
			if ( $add_remove === 'add' && $this->can_like( $post_id ) ) :
				// Add the user ID if logged in, or the unique user ID if not logged in
				if ( $current_user_id ) {
					$ip_list[] = $current_user_id;
				} else {
					if ( isset( $_POST['unique_user_id'] ) ) {
						$unique_user_id = sanitize_text_field( wp_unslash( $_POST['unique_user_id'] ) );
						$ip_list[] = $unique_user_id;
					}
				}
				$likes++;
				update_post_meta( $post_id, '_recipe_likes', absint( $likes ) );
				update_post_meta( $post_id, '_recipe_likes_ip', $ip_list );
	
			elseif ( $add_remove === 'remove' ) :
				// Remove the user ID from the list if logged in
				if ( $current_user_id ) :
					$key = array_search( $current_user_id, $ip_list );
					if ( $key !== false ) :
						$likes--;
						if ( $likes <= 0 ) :
							$likes = 0;
						endif;
						unset( $ip_list[ $key ] );
						update_post_meta( $post_id, '_recipe_likes', absint( $likes ) );
						update_post_meta( $post_id, '_recipe_likes_ip', $ip_list );
					endif;
				else :
					// Remove the unique user ID from the list if not logged in
					if ( isset( $_POST['unique_user_id'] ) ) :
						$unique_user_id = sanitize_text_field( wp_unslash( $_POST['unique_user_id'] ) );
						$key = array_search( $unique_user_id, $ip_list );
						if ( $key !== false ) :
							$likes--;
							if ( $likes <= 0 ) :
								$likes = 0;
							endif;
							unset( $ip_list[ $key ] );
							update_post_meta( $post_id, '_recipe_likes', absint( $likes ) );
							update_post_meta( $post_id, '_recipe_likes_ip', $ip_list );
						endif;
					else :
						wp_send_json_error( array( 'message' => 'Invalid request.' ) );
					endif;
				endif;
	
			else :
				wp_send_json_error( array( 'message' => 'Invalid action.' ) );
			endif;
	
			$like_count = $this->get_recipe_like_count( $post_id );
			/* translators: %s: number of likes */
			wp_send_json_success(
				array(
					'likes'       => sprintf( _nx( '%s Like', '%s Likes', $like_count, 'number of likes', 'delicious-recipes' ), $like_count ),
					'likes_count' => $like_count,
				)
			);
	
		else :
			wp_send_json_error( array( 'message' => 'Invalid request.' ) );
		endif;
	
		wp_die();
	}

	/**
	 * Get recipe likes count
	 *
	 * @param [type] $post_id
	 * @return void
	 */
	public function get_recipe_like_count( $post_id ) {
		$count = get_post_meta( $post_id, '_recipe_likes', true );
		if ( $count ) {
			return $count;
		} else {
			return 0;
		}
	}

	/**
	 * Wishlist button template
	 *
	 * @return void
	 */
	public function recipe_wishlist_button( $disable_wishlist = false ) {

		if ( $disable_wishlist ) {
			return;
		}

		$global_toggles = delicious_recipes_get_global_toggles_and_labels();

		if ( $global_toggles['enable_add_to_wishlist'] ) {

			global $recipe, $wp;
			$current_user          = wp_get_current_user();
			$dashboard_page_exists = delicious_recipes_get_dashboard_page_id() > 0;

			$_user_meta             = get_user_meta( $current_user->ID, 'delicious_recipes_user_meta', true );
			$bookmarked             = isset( $_user_meta['wishlists'] ) && in_array( $recipe->ID, $_user_meta['wishlists'] ) ? 'dr-wishlist-is-bookmarked' : '';
			$recipe_wishlists_count = isset( $recipe->wishlists_count ) && $recipe->wishlists_count ? number_format( $recipe->wishlists_count, 0 ) : 0;
			$add_to_wishlist_lbl    = $bookmarked ? __( 'Added to Favorites', 'delicious-recipes' ) : $global_toggles['add_to_wishlist_lbl'];

			if ( $recipe && $dashboard_page_exists ) {

				delicious_recipes_get_template(
					'recipe/recipe-wishlist.php',
					array(
						'id'                  => $recipe->ID,
						'user_meta'           => $_user_meta,
						'bookmarked'          => $bookmarked,
						'wishlists_count'     => $recipe_wishlists_count,
						'logged_in'           => is_user_logged_in(),
						'recipe_single'       => is_recipe(),
						'add_to_wishlist_lbl' => $add_to_wishlist_lbl,
					)
				);

			}
		}

	}

	/**
	 * AJAX callback for recipe wishlist.
	 *
	 * @return void
	 */
	public function recipe_wishlist_cb() {

		global $wp;
		$current_user = wp_get_current_user();

		$_user_meta = get_user_meta( $current_user->ID, 'delicious_recipes_user_meta', true );
		if ( ! is_array( $_user_meta ) || empty( $_user_meta ) ) :
			$_user_meta = array();
		endif;

		if ( $current_user && isset( $_POST['recipe_id'] ) && isset( $_POST['add_remove'] ) ) :

			$add_remove    = sanitize_title( wp_unslash( $_POST['add_remove'] ) );
			$recipe_id     = absint( $_POST['recipe_id'] );
			$wishlists     = isset( $_user_meta['wishlists'] ) && ! empty( $_user_meta['wishlists'] ) ? $_user_meta['wishlists'] : array();
			$current_total = get_post_meta( $recipe_id, '_delicious_recipes_wishlists', true );

			if ( $add_remove === 'add' ) :
				$wishlists[] = $recipe_id;
				$current_total++;
			elseif ( $add_remove === 'remove' ) :
				if ( ( $key = array_search( $recipe_id, $wishlists ) ) !== false ) :
					$current_total--;
					if ( $current_total <= 0 ) :
						$current_total = '';
						update_post_meta( $recipe_id, '_delicious_recipes_wishlists', 0 );
endif;
					unset( $wishlists[ $key ] );
				endif;
			else :
				wp_send_json_error();
			endif;

			$wishlists               = array_unique( $wishlists );
			$wishlists               = array_map( 'sanitize_text_field', $wishlists );
			$_user_meta['wishlists'] = $wishlists;

			update_user_meta( $current_user->ID, 'delicious_recipes_user_meta', $_user_meta );
			update_post_meta( $recipe_id, '_delicious_recipes_wishlists', absint( $current_total ) );

            $global_toggles = delicious_recipes_get_global_toggles_and_labels();
            $message        = $add_remove === 'add' ? __( "Added to Favorites", 'delicious-recipes'  ) : $global_toggles['add_to_wishlist_lbl'];

			wp_send_json_success(
				array(
					'wishlists' => $current_total,
					'message'   => $message,
				)
			);

		else :
			wp_send_json_error();
		endif;
		wp_die();

	}

	/**
	 * Recipe Badge template
	 *
	 * @return void
	 */
	public function recipe_badges() {
		global $recipe;

		if ( ! empty( $recipe->badges ) ) : ?>
			<span class="dr-badge">
				<?php
					$badge       = get_term_by( 'name', $recipe->badges[0], 'recipe-badge' );
					$badge_metas = get_term_meta( $badge->term_id, 'dr_taxonomy_metas', true );
					$tax_color   = isset( $badge_metas['taxonomy_color'] ) && ! empty( $badge_metas['taxonomy_color'] ) ? $badge_metas['taxonomy_color'] : '#E84E3B';
				?>

				<a href="<?php echo esc_url( get_term_link( $badge, 'recipe-badge' ) ); ?>" title="<?php echo esc_attr( $recipe->badges[0] ); ?>" style="background-color: <?php echo esc_attr( $tax_color ); ?>">
					<?php echo esc_html( $recipe->badges[0] ); ?>
				</a>
			</span>
			<?php
		endif;
	}

	/**
	 * Callback function for "recipe_get_lists" AJAX.
	 *
	 * @return void
	 */
	public function get_likes() {
		if ( ! isset( $_POST['ids'] ) || ! is_array( $_POST['ids'] ) ) {
			wp_send_json_error();
		}

		$ids   = wp_unslash( $_POST['ids'] );
		$likes = array();
		foreach ( $ids as $id ) {
			$count        = get_post_meta( $id, '_recipe_likes', true );
			$like_count   = $count ? absint( $count ) : 0;
			$likes[ $id ] = array(
				'likes'       => sprintf( _nx( '%s Like', '%s Likes', $like_count, 'number of likes', 'delicious-recipes' ), $like_count ),
				'likes_count' => $like_count,
			);
		}

		wp_send_json_success( array( 'recipes' => $likes ) );
	}
}

new Delicious_Recipes_Likes_Wishlists();
