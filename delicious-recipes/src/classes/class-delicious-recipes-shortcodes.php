<?php
/**
 * WP Delicious Shortcodes.
 *
 * @package Delicious_Recipes
 * @since 1.0.0
 */
defined( 'ABSPATH' ) || exit;
/**
 * Shortcodes handler.
 */
class Delicious_Recipes_Shortcodes {

	/**
	 * Init shortcodes.
	 */
	public static function init() {
		$shortcodes = array(
			'recipe'              => __CLASS__ . '::recipe',
			'recipe_page'         => __CLASS__ . '::recipe_page',
			'recipes'             => __CLASS__ . '::recipes',
			'recipe_search'       => __CLASS__ . '::recipe_search',
			'dr_featured_recipes' => __CLASS__ . '::featured_recipes',
			'dr_popular_recipes'  => __CLASS__ . '::popular_recipes',
			'dr_recipes'          => __CLASS__ . '::recent_recipes',
			'print_recipe'        => __CLASS__ . '::print_recipe',
			'recipe_card'         => __CLASS__ . '::recipe_card',
			'dr_surprise_me'      => __CLASS__ . '::surprise_me',
			'dr_user_dashboard'   => __CLASS__ . '::user_dashboard',
			'dr_recipe_archives'  => __CLASS__ . '::recipe_archives',
		);

		foreach ( $shortcodes as $shortcode => $function ) {
			add_shortcode( apply_filters( "{$shortcode}_shortcode_tag", $shortcode ), $function );
		}
	}

	/**
	 * Show a single recipe page.
	 *
	 * @param array $atts Attributes.
	 * @return string
	 */
	public static function recipe_page( $atts ) {

		// If REST_REQUEST is defined (by WordPress) and is a TRUE, then it's a REST API request.
		$is_rest_route = ( defined( 'REST_REQUEST' ) && REST_REQUEST );
		if (
			( is_admin() && ! $is_rest_route ) || // admin and AJAX (via admin-ajax.php) requests
			( ! is_admin() && $is_rest_route )    // REST requests only
		) {
			return '';
		}

		if ( empty( $atts ) ) {
			return '';
		}

		if ( ! isset( $atts['id'] ) ) {
			return '';
		}

		$args = array(
			'posts_per_page'      => 1,
			'post_type'           => DELICIOUS_RECIPE_POST_TYPE,
			'post_status'         => ( ! empty( $atts['status'] ) ) ? $atts['status'] : 'any',
			'ignore_sticky_posts' => 1,
			'no_found_rows'       => 1,
		);

		if ( isset( $atts['id'] ) ) {
			$args['p'] = absint( $atts['id'] );
		}

		// Don't render titles if desired.
		if ( isset( $atts['show_title'] ) && ! $atts['show_title'] ) {
			remove_action( 'delicious_recipes_single_recipe_summary', 'delicious_recipes_template_single_title', 5 );
		}

		$single_recipe = new WP_Query( $args );

		$preselected_id = '0';

		// For "is_single" to always make load comments_template() for reviews.
		$single_recipe->is_single = true;

		ob_start();

		global $wp_query;

		// Backup query object so following loops think this is a recipe page.
		$previous_wp_query = $wp_query;
		// @codingStandardsIgnoreStart
		$wp_query          = $single_recipe;
		// @codingStandardsIgnoreEnd

		wp_enqueue_script( 'delicious-recipes-single' );

		while ( $single_recipe->have_posts() ) {
			$single_recipe->the_post()
			?>
			<div class="single-recipe" data-recipe-page-preselected-id="<?php echo esc_attr( $preselected_id ); ?>">
				<?php delicious_recipes_get_template_part( 'content', 'single-recipe' ); ?>
			</div>
			<?php
		}

		// Restore $previous_wp_query and reset post data.
		// @codingStandardsIgnoreStart
		$wp_query = $previous_wp_query;
		// @codingStandardsIgnoreEnd
		wp_reset_postdata();

		// Re-enable titles if they were removed.
		if ( isset( $atts['show_title'] ) && ! $atts['show_title'] ) {
			add_action( 'delicious_recipes_single_recipe_summary', 'delicious_recipes_template_single_title', 5 );
		}

		return '<div class="delicious-recipes single-recipe">' . ob_get_clean() . '</div>';
	}

	/**
	 * Show a single recipe card.
	 *
	 * @param array $atts Attributes.
	 * @return string
	 */
	public static function recipe_card( $atts ) {

		// If REST_REQUEST is defined (by WordPress) and is a TRUE, then it's a REST API request.
		$is_rest_route = ( defined( 'REST_REQUEST' ) && REST_REQUEST );
		if (
			( is_admin() && ! $is_rest_route ) || // admin and AJAX (via admin-ajax.php) requests
			( ! is_admin() && $is_rest_route )    // REST requests only
		) {
			return '';
		}

		if ( empty( $atts ) ) {
			return '';
		}

		if ( ! isset( $atts['id'] ) ) {
			return '';
		}

		$args = array(
			'posts_per_page'      => 1,
			'post_type'           => DELICIOUS_RECIPE_POST_TYPE,
			'post_status'         => ( ! empty( $atts['status'] ) ) ? $atts['status'] : 'any',
			'ignore_sticky_posts' => 1,
			'no_found_rows'       => 1,
		);

		if ( isset( $atts['id'] ) ) {
			$args['p'] = absint( $atts['id'] );
		}

		// Don't render titles if desired.
		if ( isset( $atts['show_title'] ) && ! $atts['show_title'] ) {
			remove_action( 'delicious_recipes_single_recipe_summary', 'delicious_recipes_template_single_title', 5 );
		}

		$single_recipe = new WP_Query( $args );

		$preselected_id = '0';

		// For "is_single" to always make load comments_template() for reviews.
		$single_recipe->is_single = true;

		ob_start();

		global $wp_query;

		// Backup query object so following loops think this is a recipe page.
		$previous_wp_query = $wp_query;
		// @codingStandardsIgnoreStart
		$wp_query          = $single_recipe;
		// @codingStandardsIgnoreEnd

		wp_enqueue_script( 'delicious-recipes-single' );

		$layout = isset( $atts['layout'] ) && $atts['layout'] ? $atts['layout'] : '';

		while ( $single_recipe->have_posts() ) {
			$single_recipe->the_post()
			?>
			<div class="single-recipe" data-recipe-page-preselected-id="<?php echo esc_attr( $preselected_id ); ?>">
				<?php
					$data = array(
						'layout' => $layout,
					);
					delicious_recipes_get_template( 'recipe/recipe-main.php', $data );
					?>
			</div>
			<?php
		}

		// Restore $previous_wp_query and reset post data.
		// @codingStandardsIgnoreStart
		$wp_query = $previous_wp_query;
		// @codingStandardsIgnoreEnd
		wp_reset_postdata();

		// Re-enable titles if they were removed.
		if ( isset( $atts['show_title'] ) && ! $atts['show_title'] ) {
			add_action( 'delicious_recipes_single_recipe_summary', 'delicious_recipes_template_single_title', 5 );
		}

		return '<div class="delicious-recipes single-recipe">' . ob_get_clean() . '</div>';
	}

	/**
	 * Recipe search page.
	 *
	 * @return void
	 */
	public static function recipe_search() {
		ob_start();

		delicious_recipes_get_template( 'global/searchpage-content.php' );

		$search_content = ob_get_clean();

		return $search_content;
	}

	/**
	 * Show featured recipes.
	 *
	 * @param array $atts Attributes.
	 * @return string
	 */
	public static function featured_recipes( $atts ) {

		$atts = shortcode_atts(
			array(
				'num_posts' => '3',
				'layout'    => 'grid',
			),
			$atts,
			'dr_featured_recipes'
		);

		// If REST_REQUEST is defined (by WordPress) and is a TRUE, then it's a REST API request.
		$is_rest_route = ( defined( 'REST_REQUEST' ) && REST_REQUEST );
		if (
			( is_admin() && ! $is_rest_route ) || // admin and AJAX (via admin-ajax.php) requests
			( ! is_admin() && $is_rest_route )    // REST requests only
		) {
			return '';
		}

		$layout = isset( $atts['layout'] ) && 'list' === $atts['layout'] ? 'list' : 'grid';

		$cat = get_theme_mod( 'exclude_categories' );
		if ( $cat ) {
			$cat = array_diff( array_unique( $cat ), array( '' ) );
		}

		$args = array(
			'post_type'           => DELICIOUS_RECIPE_POST_TYPE,
			'post_status'         => 'publish',
			'posts_per_page'      => absint( $atts['num_posts'] ),
			'meta_query'          => array(
				array(
					'key'   => 'wp_delicious_featured_recipe',
					'value' => 'yes',
				),
			),
			'ignore_sticky_posts' => true,
			'category__not_in'    => $cat,
		);

		$featured_recipes = new WP_Query( $args );

		if ( empty( $featured_recipes ) ) {
			return '';
		}

		ob_start();

		wp_enqueue_script( 'delicious-recipes-single' );

		while ( $featured_recipes->have_posts() ) {
			$featured_recipes->the_post();
				delicious_recipes_get_template_part( 'recipes', $layout );
		}

		wp_reset_postdata();

		return '<div class="dr-archive-list-gridwrap featured ' . $layout . '">' . ob_get_clean() . '</div>';
	}

	/**
	 * Show popular recipes.
	 *
	 * @param array $atts Attributes.
	 * @return string
	 */
	public static function popular_recipes( $atts ) {

		$atts = shortcode_atts(
			array(
				'num_posts' => '3',
				'based_on'  => 'views',
				'layout'    => 'grid',
			),
			$atts,
			'dr_popular_recipes'
		);

		// If REST_REQUEST is defined (by WordPress) and is a TRUE, then it's a REST API request.
		$is_rest_route = ( defined( 'REST_REQUEST' ) && REST_REQUEST );
		if (
			( is_admin() && ! $is_rest_route ) || // admin and AJAX (via admin-ajax.php) requests
			( ! is_admin() && $is_rest_route )    // REST requests only
		) {
			return '';
		}

		$layout = isset( $atts['layout'] ) && 'list' === $atts['layout'] ? 'list' : 'grid';

		$cat = get_theme_mod( 'exclude_categories' );
		if ( $cat ) {
			$cat = array_diff( array_unique( $cat ), array( '' ) );
		}

		$args = array(
			'post_type'           => DELICIOUS_RECIPE_POST_TYPE,
			'post_status'         => 'publish',
			'posts_per_page'      => absint( $atts['num_posts'] ),
			'ignore_sticky_posts' => true,
			'category__not_in'    => $cat,
		);

		if ( isset( $atts['based_on'] ) && $atts['based_on'] == 'views' ) {
			$args['orderby']  = 'meta_value_num';
			$args['meta_key'] = '_delicious_recipes_view_count';

		} elseif ( $atts['based_on'] == 'comments' ) {
			$args['orderby'] = 'comment_count';
		}

		$popular_recipes = new WP_Query( $args );

		ob_start();

		wp_enqueue_script( 'delicious-recipes-single' );

		while ( $popular_recipes->have_posts() ) {
			$popular_recipes->the_post();
				delicious_recipes_get_template_part( 'recipes', $layout );
		}

		wp_reset_postdata();

		return '<div class="dr-archive-list-gridwrap popular ' . $layout . '">' . ob_get_clean() . '</div>';
	}

	/**
	 * Show recent recipes.
	 *
	 * @param array $atts Attributes.
	 * @return string
	 */
	public static function recent_recipes( $atts ) {

		$atts = shortcode_atts(
			array(
				'num_posts' => '3',
				'layout'    => 'grid',
			),
			$atts,
			'dr_recipes'
		);

		// If REST_REQUEST is defined (by WordPress) and is a TRUE, then it's a REST API request.
		$is_rest_route = ( defined( 'REST_REQUEST' ) && REST_REQUEST );
		if (
			( is_admin() && ! $is_rest_route ) || // admin and AJAX (via admin-ajax.php) requests
			( ! is_admin() && $is_rest_route )    // REST requests only
		) {
			return '';
		}

		$layout = isset( $atts['layout'] ) && 'list' === $atts['layout'] ? 'list' : 'grid';

		$cat = get_theme_mod( 'exclude_categories' );
		if ( $cat ) {
			$cat = array_diff( array_unique( $cat ), array( '' ) );
		}

		$args = array(
			'post_type'           => DELICIOUS_RECIPE_POST_TYPE,
			'post_status'         => 'publish',
			'posts_per_page'      => absint( $atts['num_posts'] ),
			'ignore_sticky_posts' => true,
			'category__not_in'    => $cat,
		);

		$recent_recipes = new WP_Query( $args );

		ob_start();

		wp_enqueue_script( 'delicious-recipes-single' );

		while ( $recent_recipes->have_posts() ) {
			$recent_recipes->the_post();
				delicious_recipes_get_template_part( 'recipes', $layout );
		}

		wp_reset_postdata();

		return '<div class="dr-archive-list-gridwrap recent ' . $layout . '">' . ob_get_clean() . '</div>';
	}

	/**
	 * Show print recipe and Jump to Recipe block.
	 *
	 * @param array $atts Attributes.
	 * @return string
	 */
	public static function print_recipe( $atts ) {

		// If REST_REQUEST is defined (by WordPress) and is a TRUE, then it's a REST API request.
		$is_rest_route = ( defined( 'REST_REQUEST' ) && REST_REQUEST );
		if (
			( is_admin() && ! $is_rest_route ) || // admin and AJAX (via admin-ajax.php) requests
			( ! is_admin() && $is_rest_route )    // REST requests only
		) {
			return '';
		}

		ob_start();

		wp_enqueue_script( 'delicious-recipes-single' );

		delicious_recipes_get_template( 'shortcodes/print-jump-btns.php' );

		return '<div class="delicious-recipes print">' . ob_get_clean() . '</div>';
	}

	/**
	 * Show random recipe.
	 *
	 * @param array $atts Attributes.
	 * @return string
	 */
	public static function surprise_me( $atts ) {

		$atts = shortcode_atts(
			array(
				'title'       => __( 'Surprise Me', 'delicious-recipes' ),
				'enable_icon' => true,
				'icon'        => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 15L21 18M21 18L18 21M21 18H18.5689C17.6297 18 17.1601 18 16.7338 17.8705C16.3564 17.7559 16.0054 17.5681 15.7007 17.3176C15.3565 17.0348 15.096 16.644 14.575 15.8626L14.3333 15.5M18 3L21 6M21 6L18 9M21 6H18.5689C17.6297 6 17.1601 6 16.7338 6.12945C16.3564 6.24406 16.0054 6.43194 15.7007 6.68236C15.3565 6.96523 15.096 7.35597 14.575 8.13744L9.42496 15.8626C8.90398 16.644 8.64349 17.0348 8.29933 17.3176C7.99464 17.5681 7.64357 17.7559 7.2662 17.8705C6.83994 18 6.37033 18 5.43112 18H3M3 6H5.43112C6.37033 6 6.83994 6 7.2662 6.12945C7.64357 6.24406 7.99464 6.43194 8.29933 6.68236C8.64349 6.96523 8.90398 7.35597 9.42496 8.13744L9.66667 8.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			),
			$atts,
			'dr_surprise_me'
		);

		// If REST_REQUEST is defined (by WordPress) and is a TRUE, then it's a REST API request.
		$is_rest_route = ( defined( 'REST_REQUEST' ) && REST_REQUEST );
		if (
			( is_admin() && ! $is_rest_route ) || // admin and AJAX (via admin-ajax.php) requests.
			( ! is_admin() && $is_rest_route )    // REST requests only.
		) {
			return '';
		}

		$title = isset( $atts['title'] ) && '' !== $atts['title'] ? $atts['title'] : __( 'Surprise Me', 'delicious-recipes' );
		$icon  = isset( $atts['enable_icon'] ) && ( 1 === $atts['enable_icon'] || 'true' === $atts['enable_icon'] )
		&& isset( $atts['icon'] ) && '' !== $atts['icon'] ? $atts['icon'] : '';

		// get icon.
		if ( $atts['enable_icon'] && ( 1 === $atts['enable_icon'] || 'true' === $atts['enable_icon'] ) ) {
			$icon_val = '<i class="' . esc_attr( $icon ) . '"></i>';
		} else {
			$icon_val = '';
		}

		$cat = get_theme_mod( 'exclude_categories' );
		if ( $cat ) {
			$cat = array_diff( array_unique( $cat ), array( '' ) );
		}

		$args = array(
			'post_type'           => DELICIOUS_RECIPE_POST_TYPE,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'category__not_in'    => $cat,
			'orderby'             => 'rand',
			'posts_per_page'      => '1',
		);

		$random_recipes = get_posts( $args );

		ob_start();

		wp_enqueue_script( 'delicious-recipes-single' );

		if ( $random_recipes ) {
			foreach ( $random_recipes as $recipe ) {
				echo esc_html( $icon_val );
				echo ( "\r\n" );
				echo '<a href="' . esc_url( get_permalink( $recipe->ID ) ) . '">' . esc_html( $title ) . '</a>';
			}
		}

		return '<button class="dr-surprise-me">' . ob_get_clean() . '</button>';
	}

	/**
	 * Add user Account shortcode.
	 *
	 * @return string
	 */
	public static function user_dashboard() {

		// If REST_REQUEST is defined (by WordPress) and is a TRUE, then it's a REST API request.
		$is_rest_route = ( defined( 'REST_REQUEST' ) && REST_REQUEST );
		if (
			( is_admin() && ! $is_rest_route ) || // admin and AJAX (via admin-ajax.php) requests
			( ! is_admin() && $is_rest_route )    // REST requests only
		) {
			return '';
		}

		ob_start();

		call_user_func( array( 'Delicious_Recipes_User_Account', 'output' ) );

		return '<div class="delicious-recipes user-dashboard">' . ob_get_clean() . '</div>';
	}

	/**
	 * Show recipe taxonomy archives.
	 *
	 * @param array $atts Attributes.
	 * @return string
	 */
	public static function recipe_archives( $atts ) {

		$atts = shortcode_atts(
			array(
				'num_posts' => '9',
				'layout'    => 'grid',
				'taxonomy'  => '',
				'terms'     => '',
				'carousel'  => false,
			),
			$atts,
			'dr_recipe_archives'
		);

		if ( delicious_recipes_post_content_has_shortcode( 'dr_recipe_archives' ) ) {
			// Register Archive Styles.
			wp_register_style(
				'delicious-recipe-archive-styles',
				plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdArchive.css',
				array(),
				filemtime( plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdArchive.css' ),
				'all'
			);

			// Enqueue Archive Styles.
			wp_enqueue_style( 'delicious-recipe-archive-styles' );
		}

		// If REST_REQUEST is defined (by WordPress) and is a TRUE, then it's a REST API request.
		$is_rest_route = ( defined( 'REST_REQUEST' ) && REST_REQUEST );
		if (
			( is_admin() && ! $is_rest_route ) || // admin and AJAX (via admin-ajax.php) requests
			( ! is_admin() && $is_rest_route )    // REST requests only
		) {
			return '';
		}

		$carousel = ( isset( $atts['carousel'] ) && 'true' == $atts['carousel'] ) ? true : false;
		$layout   = $carousel ? 'grid' : ( isset( $atts['layout'] ) && 'list' === $atts['layout'] ? 'list' : 'grid' );
		$classes  = $carousel ? array( 'dr-recipe-archive', 'splide' ) : array( 'dr-archive-list-gridwrap', $layout );
		$classes  = implode( ' ', $classes );

		$cat = get_theme_mod( 'exclude_categories' );
		if ( $cat ) {
			$cat = array_diff( array_unique( $cat ), array( '' ) );
		}

		$args = array(
			'post_type'           => DELICIOUS_RECIPE_POST_TYPE,
			'post_status'         => 'publish',
			'posts_per_page'      => absint( $atts['num_posts'] ),
			'ignore_sticky_posts' => true,
			'category__not_in'    => $cat,
		);

		$taxonomy = isset( $atts['taxonomy'] ) && '' != $atts['taxonomy'] ? $atts['taxonomy'] : false;
		$terms    = isset( $atts['terms'] ) && '' != $atts['terms'] ? $atts['terms'] : false;

		if ( $taxonomy && $terms ) {
			$terms = explode( ',', $terms );
			$terms = array_map(
				function ( $term ) use ( $taxonomy ) {
					$term = is_numeric( $term ) ? get_term_by( 'id', $term, $taxonomy ) : get_term_by( 'slug', $term, $taxonomy );
					return $term ? $term->term_id : false;
				},
				$terms
			);

			if ( $terms ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $taxonomy,
						'terms'    => $terms,
					),
				);
			} else {
				$args['taxonomy'] = $taxonomy;
			}
		} elseif ( $taxonomy ) {
			$args['taxonomy'] = $taxonomy;
		}

		$recipes = new WP_Query( $args );

		ob_start();

		wp_enqueue_script( 'delicious-recipes-single' );

		echo '<div class="' . esc_attr( $classes ) . '" data-splide-count="' . esc_html( $recipes->post_count ) . '">';

		if ( $carousel ) {
			// Splide Carousel Structure.
			echo '<div class="dr-recipe-archive__track splide__track">';
			echo '<ul class="dr-recipe-archive__list splide__list">';
			while ( $recipes->have_posts() ) :
				$recipes->the_post();
				echo '<li class="dr-recipe-archive__slide splide__slide">';
				$data = array(
					'tax_page' => true,
				);
				delicious_recipes_get_template( 'recipes-grid.php', $data );
				echo '</li>';
			endwhile;
			wp_reset_postdata();
			echo '</ul></div>';

			// Add arrow navigation.
			echo '<div class="splide__arrows">';
			echo '<button class="splide__arrow splide__arrow--prev">';
			echo '<svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">';
			echo '<path d="M1 7.60645H17M17 7.60645L11 1.60645M17 7.60645L11 13.6064" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>';
			echo '</svg>';
			echo '</button>';
			echo '<button class="splide__arrow splide__arrow--next">';
			echo '<svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">';
			echo '<path d="M1 7.60645H17M17 7.60645L11 1.60645M17 7.60645L11 13.6064" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>';
			echo '</svg>';
			echo '</button>';
			echo '</div>';
		} else {
			// Non-Carousel Structure.
			while ( $recipes->have_posts() ) {
				$recipes->the_post();
				delicious_recipes_get_template_part( 'recipes', $layout );
			}
			wp_reset_postdata();
			echo '</div>';

			return ob_get_clean();
		}

		echo '</div>';

		return ob_get_clean();
	}
}
