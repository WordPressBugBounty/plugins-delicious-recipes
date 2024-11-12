<?php
/**
 * Delecious recipes public functions handler class.
 *
 * @package Delicious_Recipes
 */
namespace WP_Delicious;

defined( 'ABSPATH' ) || exit;

/**
 * Handle the public functions for frontend of Delicious_Recipes plugin
 *
 * @since 1.0.0
 */
class DeliciousPublic {
	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Initialization.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function init() {

		// Initialize hooks.
		$this->init_hooks();
		$this->includes();
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function init_hooks() {
		add_action( 'init', array( 'Delicious_Recipes_Shortcodes', 'init' ), 99999999 );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_frontend_scripts' ) );

		// Comments section.
		add_filter( 'comment_form_defaults', array( $this, 'comment_form_defaults' ) );
		add_filter( 'comment_form_fields', array( $this, 'reorder_comment_fields' ) );
		add_action( 'comment_post', array( $this, 'dr_save_comment_rating' ) );
		add_filter( 'comment_text', array( $this, 'dr_add_comment_review_after_text' ) );
		// register comment meta.
		add_action( 'init', array( $this, 'register_comment_metas' ) );

		// Posts per page value for recipe archives.
		add_filter( 'pre_get_posts', array( $this, 'recipe_archive_posts_per_page' ) );

		// Display Recipe posts on Home Page.
		add_action( 'pre_get_posts', array( $this, 'recipe_posts_on_homepage' ) );

		// Display Recipe posts on author archive.
		add_action( 'pre_get_posts', array( $this, 'recipe_posts_on_archive' ) );

		// Display Archive title.
		add_filter( 'get_the_archive_title', array( $this, 'recipe_archive_title' ), 99 );

		// Display Archive Description.
		add_filter( 'get_the_archive_description', array( $this, 'recipe_archive_description' ), 99 );
		// Add dynamic CSS.
		add_action( 'wp_head', array( $this, 'load_dynamic_css' ), 99 );

		// Add random links for surprise me nav menu.
		add_filter( 'wp_nav_menu_objects', array( $this, 'surprise_me_nav_menu_objects' ) );

		// Handle the Dynamic Recipe Card block printing.
		add_action( 'init', array( $this, 'print_block_page' ) );

		// Adds the post type information in the search form.
		add_filter( 'get_search_form', array( $this, 'get_search_form' ), 99 );

		// Prevent lazy image loading on print page.
		add_action( 'wp', array( $this, 'deactivate_lazyload_on_print' ) );

		// Adds the login/registration form for popup display.
		add_action( 'wp_footer', array( $this, 'get_login_registration_form' ) );

		add_action(
			'plugins_loaded',
			function () {
				// Allow 3rd party to remove hooks.
				do_action( 'wp_delicious_public_unhook', $this );
			},
			999
		);

		add_filter( 'body_class', array( $this, 'wpdelicious_body_classes' ) );

		/**
		 * Chicory Intergration
		 *
		 * @since 1.6.2
		 */
		add_action( 'wp_footer', array( $this, 'chicory_integration' ) );

		// Add JavaScript file for Recipe Archive pages
		// add_action( 'wp_enqueue_scripts', array( $this, 'add_js_for_recipe_archive' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'dr_cuisines_archive' ) );

		// For lazy loading
		add_action( 'template_redirect', array( $this, 'start' ) );
		add_filter( 'delicious_recipes_output_buffer_template_redirect', array( $this, 'add_lazyload_attributes' ) );

		// for preloading featured image
		add_action( 'wp_head', array( $this, 'add_preload_featured_image' ) );
	}

	/**
	 * Reorder comment fields to place rating stars before the comment textarea.
	 *
	 * @param array $fields The comment form fields.
	 * @return array The reordered comment form fields.
	 */
	public function reorder_comment_fields( $fields ) {
		// Get the rating stars field.
		$rating_field = array( 'rating' => $this->dr_comment_form_rating_fields() );

		// Remove the rating field if it exists.
		unset( $fields['rating'] );

		// Insert the rating field before the comment textarea.
		$fields = array_merge( array_slice( $fields, 0, 1 ), $rating_field, array_slice( $fields, 1 ) );

		return $fields;
	}

	/**
	 * Initializes the output buffering for processing HTML content.
	 */
	public static function start() {
		if ( is_singular( DELICIOUS_RECIPE_POST_TYPE ) && isset( $_GET['print_recipe'] ) ) {
			return;
		}
		ob_start(
			function ( $html ) {
				return apply_filters( 'delicious_recipes_output_buffer_template_redirect', $html );
			}
		);
	}

	/**
	 * Processes the HTML to add lazy loading attributes to image tags.
	 *
	 * @param string $html The HTML content.
	 *
	 * @return string Modified HTML content with lazy loading attributes.
	 */
	public static function add_lazyload_attributes( string $html ): string {

		$global_settings = get_option( 'delicious_recipe_settings', true );
		// Check if the current page is a WP Travel Engine single post and lazy loading is enabled.
		if ( isset( $global_settings['enableLazyLoading'] ) && array( 'yes' ) !== $global_settings['enableLazyLoading'] ) {
			return $html;
		}

		return preg_replace_callback(
			'/<img\s+([^>]+)>/i',
			function ( $matches ) {

				$img_tag = $matches[0];

				// Check if the image tag has 'avoid-lazy-load' class.
				if ( strpos( $img_tag, 'avoid-lazy-load' ) !== false ) {
					return $img_tag;
				}

				// Add 'lazy' class if not present.
				if ( strpos( $img_tag, 'class=' ) !== false ) {
					if ( ! is_null( $img_tag ) ) {
						$img_tag = preg_replace( '/class="([^"]*)"/i', 'class="$1 lazy"', $img_tag );
					}
				} elseif ( ! is_null( $img_tag ) ) {
						$img_tag = str_replace( '<img', '<img class="lazy"', $img_tag );
				}

				// Replace src with data-src.
				if ( ! is_null( $img_tag ) ) {
					return preg_replace( '/src="([^"]*)"/i', 'src="$1" data-src="$1"', $img_tag );
				}
			},
			$html
		);
	}

	/**
	 * Preload Feature Images
	 *
	 * Since 1.7.1
	 */
	public static function add_preload_featured_image() {
		$global_settings = get_option( 'delicious_recipe_settings', true );
		$global_toggles  = delicious_recipes_get_global_toggles_and_labels();
		$img_size        = $global_toggles['enable_recipe_image_crop'] ? 'large' : 'full';

		if ( isset( $global_settings['enablePreloadFeaturedImage'] ) && array( 'yes' ) !== $global_settings['enablePreloadFeaturedImage'] && ! is_singular( DELICIOUS_RECIPE_POST_TYPE ) ) {
			return;
		}
		$recipe_meta = get_post_meta( get_the_ID() );
		if ( ! isset( $recipe_meta['_thumbnail_id'] ) && empty( $recipe_meta['_thumbnail_id'] ) ) {
			return;
		}
		if ( has_post_thumbnail() ) {
			echo '<link rel="preload" href="' . esc_url( get_the_post_thumbnail_url( null, $img_size ) ) . '" as="image">';
		} else {
			echo '<link rel="preload" href="' . esc_url( wp_get_attachment_image_url( $recipe_meta['_thumbnail_id'][0], $img_size ) ) . '" as="image">';
		}
	}

	function wpdelicious_body_classes( $classes ) {
		if ( is_active_sidebar( 'delicious-recipe-sidebar' ) ) {
			$classes[] = 'wpdelicious-sidebar';
		}
		if ( is_recipe_search() ) {
			$classes[] = 'wpdelicious-recipe-search';
		}
		return $classes;
	}

	function deactivate_lazyload_on_print() {
		if ( is_singular( DELICIOUS_RECIPE_POST_TYPE ) && isset( $_GET['print_recipe'] ) ) {
			// Prevent WP Rocket lazy image loading on print page.
			add_filter( 'do_rocket_lazyload', '__return_false' );

			// Prevent Avada lazy image loading on print page.
			if ( class_exists( 'Fusion_Images' ) && property_exists( 'Fusion_Images', 'lazy_load' ) ) {
				Fusion_Images::$lazy_load = false;
			}
		}
	}

	/**
	 * Modifies the random recipe link for Surprise Me nav menu
	 *
	 * @since 1.1.1
	 *
	 * @param array $items
	 * @return array modified menu items
	 */
	public function surprise_me_nav_menu_objects( $items ) {

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

		if ( ! empty( $items ) && is_array( $items ) ) {
			foreach ( $items as $item ) {
				if ( '#dr_surprise_me' === $item->url ) {
					if ( $options = get_post_meta( $item->ID, '_dr_menu_item', true ) ) {
						$title = $item->post_title;
						$icon  = 'fas fa-random';
						if ( ! $options['show_text_icon'] && $options['show_icon'] ) {
							$title = sprintf( '<i class="%1$s"></i>', $icon );
						}
						if ( $options['show_text_icon'] || ( $options['show_icon'] && $options['show_text'] )
						|| ( $options['show_text_icon'] && $options['show_icon'] && $options['show_text'] )
						|| ( $options['show_text_icon'] && $options['show_icon'] ) ) {
							$title = sprintf( '%1$s<span style="margin-%2$s:0.3em;">%3$s</span>', '<i class="' . $icon . '"></i>', is_rtl() ? 'right' : 'left', esc_html( $title ) );
						}

						if ( $options['show_posts'] ) {
							$args['post_type'] = array( DELICIOUS_RECIPE_POST_TYPE, 'post' );
						}

						$random_recipes = get_posts( $args );

						if ( ! empty( $random_recipes ) ) {
							$item->title = $title;
							$item->url   = get_permalink( $random_recipes[0]->ID );
						}
					}
				}
			}
		}

		return $items;
	}

	/**
	 * Includes
	 *
	 * @return void
	 */
	private function includes() {
		if ( $this->is_request( 'frontend' ) ) {
			require plugin_dir_path( __FILE__ ) . '/classes/class-delicious-recipes-templates-loader.php';
			require plugin_dir_path( __FILE__ ) . '/classes/class-delicious-recipes-shortcodes.php';
			require plugin_dir_path( __FILE__ ) . '/classes/class-delicious-recipes-template-hooks.php';
			require plugin_dir_path( __FILE__ ) . '/dashboard/class-delicious-recipes-user-account.php';
			require plugin_dir_path( __FILE__ ) . '/dashboard/delicious-recipes-user-dashboard-functions.php';
			require plugin_dir_path( __FILE__ ) . '/dashboard/class-delicious-recipes-form-handler.php';
			require plugin_dir_path( __FILE__ ) . '/dashboard/class-delicious-recipes-query.php';
		}
	}

	/**
	 * Load Frontend Scripts
	 *
	 * @return void
	 */
	public function load_frontend_scripts() {
		$global_settings   = get_option( 'delicious_recipe_settings', true );
		$asset_script_path = '/min/';
		$min_prefix        = '.min';

		$global_toggles = delicious_recipes_get_global_toggles_and_labels();

		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			$asset_script_path = '/';
			$min_prefix        = '';
		}

		if ( $global_toggles['disable_percentage_values'] ) {
			// Hot-fix: DR#58 .
			?>
			<style>
				.dr-nut-right{
					display: none;
				}
			</style>
			<?php
		}

		$enable_autoload     = isset( $global_settings['autoloadRecipes']['0'] ) && 'yes' === $global_settings['autoloadRecipes']['0'] ? true : false;
		$infiniteScroll_deps = include_once plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/infiniteScroll.asset.php';
		if ( ( isset( $global_settings['autoloadRecipes'] ) && 'yes' === $global_settings['autoloadRecipes'] ) || is_front_page()
		|| ( isset( $global_settings['archivePaginationStyle'] ) && 'infinite_scroll' === $global_settings['archivePaginationStyle'] ) ) {
			wp_enqueue_script( 'delicious-recipes-infiniteScroll', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/infiniteScroll.js', $infiniteScroll_deps['dependencies'], $infiniteScroll_deps['version'], true );
		}

		$license_validity              = function_exists( 'DEL_RECIPE_PRO' ) ? delicious_recipe_pro_check_license_status() : true;
		$publicJS_deps                 = include_once plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/publicJS.asset.php';
		$publicJS_deps['dependencies'] = array_merge( $publicJS_deps['dependencies'], array( 'jquery', 'wp-util', 'select2', 'parsley' ) );
		$delicious_recipes             = array(
			'ajax_url'             => admin_url( 'admin-ajax.php' ),
			'search_placeholder'   => __( 'Select filters', 'delicious-recipes' ),
			'edit_profile_pic_msg' => __( 'Click here or Drop new image to update your profile picture', 'delicious-recipes' ),
			'enable_autoload'      => $enable_autoload,
			'global_settings'      => $global_settings, // @since 1.4.7
			'nutritionFacts'       => delicious_recipes_get_nutrition_facts(),
			'proEnabled'           => function_exists( 'DEL_RECIPE_PRO' ),
			'license_validity'     => $license_validity,
		);

		wp_enqueue_style( 'delicious-recipes-single', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/public/css' . $asset_script_path . 'delicious-recipes-public' . $min_prefix . '.css', array(), DELICIOUS_RECIPES_VERSION, 'all' );
		wp_enqueue_script( 'delicious-recipes-single', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/publicJS.js', $publicJS_deps['dependencies'], $publicJS_deps['version'], true );
		wp_localize_script( 'delicious-recipes-single', 'delicious_recipes', $delicious_recipes );
		wp_register_script( 'math-min', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/public/js/math.min.js', array( 'jquery' ), '10.6.1', true );
		wp_register_script( 'parsley', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/parsley/parsley.min.js', array( 'jquery' ), '2.9.2', true );

		wp_register_script( 'select2', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/select2/select2.min.js', array( 'jquery' ), '4.0.13', true );
		wp_register_style( 'select2', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/select2/select2.min.css', array(), '4.0.13', 'all' );
		if ( is_recipe_search() || is_recipe_dashboard() ) {
			wp_enqueue_script( 'select2' );
			wp_enqueue_style( 'select2' );
		}

		wp_enqueue_style( 'delicious-recipe-styles', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/publicCSS.css', array(), DELICIOUS_RECIPES_VERSION, 'all' );

		// Enable/Disable FA Icons JS
		$disable_fa_icons_js = isset( $global_settings['disableFAIconsJS']['0'] ) && 'yes' === $global_settings['disableFAIconsJS']['0'] ? true : false;
		if ( ! $disable_fa_icons_js ) {
			wp_enqueue_script( 'all', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/fontawesome/all.min.js', array( 'jquery' ), '5.14.0', true );
			wp_enqueue_script( 'v4-shims', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/fontawesome/v4-shims.min.js', array( 'jquery' ), '5.14.0', true );
		}

		if ( delicious_recipes_enable_pinit_btn() ) {
			wp_enqueue_script( 'pintrest', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/pintrest/pintrest.min.js', array( 'jquery' ), '5.14.0', true );
		}

		if ( is_recipe_dashboard() ) {
			wp_enqueue_style( 'toastr', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/toastr/toastr.min.css', array(), '2.1.3', 'all' );
			wp_enqueue_script( 'toastr', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/toastr/toastr.min.js', array( 'jquery' ), '2.1.3', true );
			wp_enqueue_style( 'dropzone', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/dropzone/dropzone.min.css', array(), '5.9.2', 'all' );
			wp_register_script( 'dropzone', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/dropzone/dropzone.min.js', array(), '5.9.2', true );
			wp_add_inline_script( 'dropzone', 'Dropzone.autoDiscover = false;' );
			wp_enqueue_style( 'delicious-recipes-user-dashboard', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'src/dashboard/css/main.css', array(), DELICIOUS_RECIPES_VERSION, 'all' );
			wp_enqueue_script( 'delicious-recipes-user-dashboard', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'src/dashboard/js/main.js', array( 'jquery', 'dropzone', 'parsley', 'wp-i18n' ), DELICIOUS_RECIPES_VERSION, true );
			wp_set_script_translations( 'delicious-recipes-user-dashboard', 'delicious-recipes', plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'languages' );
		}

		$active_theme = wp_get_theme();
		if ( 'Divi' == $active_theme->name ) {
			wp_enqueue_style( 'delicious-recipe-divi-styles', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/publicCSS_DIVI.css' );
		}
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined( 'DOING_AJAX' );
			case 'cron':
				return defined( 'DOING_CRON' );
			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	/**
	 * Set defaults.
	 *
	 * @param array $defaults Comment form defaults.
	 * @return array
	 */
	public function comment_form_defaults( $defaults ) {

		if ( 'recipe' !== get_post_type() ) {
			return $defaults;
		}

		$defaults['title_reply'] = __( 'Leave a Comment', 'delicious-recipes' );

		/* translators: %s is username. */
		$defaults['title_reply_to'] = __( 'Leave a Comment to %s', 'delicious-recipes' );
		return $defaults;
	}

	/**
	 * Add rating field to comment form;
	 *
	 * @return void
	 */
	public function dr_comment_form_rating_fields() {
		if ( is_singular( DELICIOUS_RECIPE_POST_TYPE ) ) {
			$global_toggles = delicious_recipes_get_global_toggles_and_labels();
			// check if pro is enabled
			$pro_enabled = function_exists( 'DEL_RECIPE_PRO' );
			// added condition to check if pro is activated but license is not valid
			$license_validity_bool = true;
			if ( function_exists( 'DEL_RECIPE_PRO' ) ) {
				$license_validity_bool = delicious_recipe_pro_check_license_status();
			}
			if ( ( ! $pro_enabled || ! $license_validity_bool ) && $global_toggles['enable_ratings'] ) :
				?>
			<div class="comment-form-rating">
				<label for="rating"><?php echo esc_html( $global_toggles['ratings_lbl'] ); ?></label>
				<fieldset id="dr-comment-rating-field" class="dr-comment-rating">
					<div id="comment-form-rating-container" data-read-only="false" data-dynamic-rating class="wpd-rating-container">
						<svg class="star" data-rating="1" width="18" height="19" viewBox="0 0 18 19" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
							<path d="M9 0.94043L11.751 6.61643L18 7.47968L13.452 11.8507L14.562 18.0599L9 15.0847L3.43725 18.0599L4.548 11.8507L0 7.47968L6.249 6.61643L9 0.94043Z" />
						</svg>
						<svg class="star" data-rating="2" width="18" height="19" viewBox="0 0 18 19" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
							<path d="M9 0.94043L11.751 6.61643L18 7.47968L13.452 11.8507L14.562 18.0599L9 15.0847L3.43725 18.0599L4.548 11.8507L0 7.47968L6.249 6.61643L9 0.94043Z" />
						</svg>
						<svg class="star" data-rating="3" width="18" height="19" viewBox="0 0 18 19" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
							<path d="M9 0.94043L11.751 6.61643L18 7.47968L13.452 11.8507L14.562 18.0599L9 15.0847L3.43725 18.0599L4.548 11.8507L0 7.47968L6.249 6.61643L9 0.94043Z" />
						</svg>
						<svg class="star" data-rating="4" width="18" height="19" viewBox="0 0 18 19" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
							<path d="M9 0.94043L11.751 6.61643L18 7.47968L13.452 11.8507L14.562 18.0599L9 15.0847L3.43725 18.0599L4.548 11.8507L0 7.47968L6.249 6.61643L9 0.94043Z" />
						</svg>
						<svg class="star" data-rating="5" width="18" height="19" viewBox="0 0 18 19" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
							<path d="M9 0.94043L11.751 6.61643L18 7.47968L13.452 11.8507L14.562 18.0599L9 15.0847L3.43725 18.0599L4.548 11.8507L0 7.47968L6.249 6.61643L9 0.94043Z" />
						</svg>
					</div>
				</fieldset>
			</div>
				<?php
			endif;
		}
	}

	/**
	 * Save comment form.
	 *
	 * @return void
	 */
	public function dr_save_comment_rating( $comment_id ) {
		$comment_post_ID = isset( $_POST['comment_post_ID'] ) ? intval( $_POST['comment_post_ID'] ) : 0;
		$comment_parent  = isset( $_POST['comment_parent'] ) ? intval( $_POST['comment_parent'] ) : 0;
		$rating          = isset( $_POST['rating'] ) ? floatval( $_POST['rating'] ) : '';

		if ( $comment_post_ID && ( get_post_type( $comment_post_ID ) == DELICIOUS_RECIPE_POST_TYPE ) ) {
			if ( ! empty( $comment_parent ) ) {
				// Bail early if we have rating and we are under parent comment, i.e replying to a thread.
				return;
			}
			$global_toggles = delicious_recipes_get_global_toggles_and_labels();
			if ( $global_toggles['enable_ratings'] ) {
				if ( '' !== $rating ) {
					if ( $rating < 1 || $rating > 5 ) {
						wp_delete_comment( $comment_id, true );
						wp_die( esc_html__( 'Please rate the recipe.', 'delicious-recipes' ) );
						return;
					}
					add_comment_meta( $comment_id, 'rating', $rating );
				}
			}
		}
	}

	/**
	 * Comment Text.
	 *
	 * @param [type] $comment_text
	 * @return void
	 */
	public function dr_add_comment_review_after_text( $comment_text ) {
		if ( ! is_singular( DELICIOUS_RECIPE_POST_TYPE ) ) {
			return $comment_text;
		}
		$global_toggles = delicious_recipes_get_global_toggles_and_labels();
		$rating         = get_comment_meta( get_comment_ID(), 'rating', true );
		if ( $rating && $global_toggles['enable_ratings'] ) {
			$stars        = '<p class="dr-star-rating">';
			$stars       .= '
				<div id="review-rating-container-' . get_comment_ID() . '"
					data-read-only="true"
					data-dynamic-rating="' . esc_attr( $rating ) . '"
					data-input-rating="' . esc_attr( $rating ) . '"
					class="wpd-rating-container">
					<svg class="star" data-rating="1" width="18" height="19" viewBox="0 0 18 19" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 0.94043L11.751 6.61643L18 7.47968L13.452 11.8507L14.562 18.0599L9 15.0847L3.43725 18.0599L4.548 11.8507L0 7.47968L6.249 6.61643L9 0.94043Z" />
					</svg>
					<svg class="star" data-rating="2" width="18" height="19" viewBox="0 0 18 19" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 0.94043L11.751 6.61643L18 7.47968L13.452 11.8507L14.562 18.0599L9 15.0847L3.43725 18.0599L4.548 11.8507L0 7.47968L6.249 6.61643L9 0.94043Z" />
					</svg>
					<svg class="star" data-rating="3" width="18" height="19" viewBox="0 0 18 19" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 0.94043L11.751 6.61643L18 7.47968L13.452 11.8507L14.562 18.0599L9 15.0847L3.43725 18.0599L4.548 11.8507L0 7.47968L6.249 6.61643L9 0.94043Z" />
					</svg>
					<svg class="star" data-rating="4" width="18" height="19" viewBox="0 0 18 19" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 0.94043L11.751 6.61643L18 7.47968L13.452 11.8507L14.562 18.0599L9 15.0847L3.43725 18.0599L4.548 11.8507L0 7.47968L6.249 6.61643L9 0.94043Z" />
					</svg>
					<svg class="star" data-rating="5" width="18" height="19" viewBox="0 0 18 19" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 0.94043L11.751 6.61643L18 7.47968L13.452 11.8507L14.562 18.0599L9 15.0847L3.43725 18.0599L4.548 11.8507L0 7.47968L6.249 6.61643L9 0.94043Z" />
					</svg>
				</div>';
			$stars       .= '</p>';
			$comment_text = $comment_text . $stars;
			return $comment_text;
		} else {
			return $comment_text;
		}
	}

	/**
	 * Register comment metas.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_comment_metas() {
		register_meta(
			'comment',
			'rating',
			array(
				'type'         => 'number',
				'description'  => __( 'Rating', 'delicious-recipes' ),
				'single'       => true,
				'show_in_rest' => true,
			)
		);
	}

	/**
	 * Filter posts per page value for recipe.
	 *
	 * @param [type] $query
	 * @return void
	 */
	public function recipe_archive_posts_per_page( $query ) {
		if ( ! is_admin() && ( is_post_type_archive( DELICIOUS_RECIPE_POST_TYPE ) || is_recipe_taxonomy() ) ) {
			$options                = delicious_recipes_get_global_settings();
			$default_posts_per_page = ( isset( $options['recipePerPage'] ) && ( ! empty( $options['recipePerPage'] ) ) ) ? $options['recipePerPage'] : get_option( 'posts_per_page' );

			if ( $query->is_main_query() ) {
				$query->set( 'posts_per_page', $default_posts_per_page );
				return $query;
			}
		}
	}

	/**
	 * Display recipe posts as post on Homepage.
	 *
	 * @param [type] $query
	 * @return void
	 */
	public function recipe_posts_on_homepage( $query ) {
		if ( ! is_admin() && $query->is_main_query() ) {
			if ( $query->is_home() ) {

				// Get global toggles.
				$global_toggles = delicious_recipes_get_global_toggles_and_labels();

				if ( ! $global_toggles['display_recipes_on_home_page'] ) {
					return;
				}

				$post_type = $query->get( 'post_type' );
				if ( $post_type == '' || $post_type == 'post' ) {
					$post_type = array( 'post', DELICIOUS_RECIPE_POST_TYPE );
				} elseif ( is_array( $post_type ) ) {
					if ( in_array( 'post', $post_type ) && ! in_array( DELICIOUS_RECIPE_POST_TYPE, $post_type ) ) {
						$post_type[] = DELICIOUS_RECIPE_POST_TYPE;
					}
				}

				$query->set( 'post_type', $post_type );

			}
			remove_action( 'pre_get_posts', 'recipe_posts_on_homepage' );
		}
	}

	/**
	 * Recipe posts only in archive.
	 *
	 * @param [type] $query
	 * @return void
	 */
	public function recipe_posts_on_archive( $query ) {
		$global_settings = delicious_recipes_get_global_settings();
		$recipe_author   = isset( $global_settings['recipeAuthor'] ) && ! empty( $global_settings['recipeAuthor'] ) ? $global_settings['recipeAuthor'] : false;

		if ( $recipe_author && is_author() && empty( $query->query_vars['suppress_filters'] ) ) {
			$query->set(
				'post_type',
				array(
					'post',
					DELICIOUS_RECIPE_POST_TYPE,
				)
			);
			return $query;
		}
	}

	/**
	 * Recipe archive title.
	 *
	 * @param [type] $title
	 * @return void
	 */
	public function recipe_archive_title( $title ) {
		$global_settings = delicious_recipes_get_global_settings();
		$archive_title   = isset( $global_settings['archiveTitle'] ) && ! empty( $global_settings['archiveTitle'] ) ? $global_settings['archiveTitle'] : __( 'Recipe Index', 'delicious-recipes' );

		if ( is_post_type_archive( DELICIOUS_RECIPE_POST_TYPE ) ) {
			$title = sprintf( esc_html( $archive_title ), post_type_archive_title( '', false ) );
		}
		return $title;
	}

	/**
	 * Recipe archive description.
	 *
	 * @param [type] $title
	 * @return void
	 */
	public function recipe_archive_description( $description ) {
		$global_settings     = delicious_recipes_get_global_settings();
		$archive_description = isset( $global_settings['archiveDescription'] ) && ! empty( $global_settings['archiveDescription'] ) ? $global_settings['archiveDescription'] : '';

		if ( is_post_type_archive( DELICIOUS_RECIPE_POST_TYPE ) ) {
			$description = $archive_description;
		}
		return wpautop( wp_kses_post( $description ) );
	}

	/**
	 * Load Dynamic CSS values.
	 *
	 * @return void
	 */
	public function load_dynamic_css() {
		$recipe_templates = array(
			'templates/pages/recipe-courses.php',
			'templates/pages/recipe-cooking-methods.php',
			'templates/pages/recipe-cuisines.php',
			'templates/pages/recipe-keys.php',
			'templates/pages/recipe-tags.php',
			'templates/pages/recipe-dietary.php',
		);

		$post_id = get_the_ID();

		if ( is_recipe() || is_recipe_taxonomy() || is_archive( DELICIOUS_RECIPE_POST_TYPE )
		|| is_page_template( $recipe_templates ) || is_recipe_search() || is_recipe_block() || is_recipe_shortcode()
		|| ( function_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::instance()->documents->get( $post_id )->is_built_with_elementor() ) ) {
			delicious_recipes_get_template( 'global/dynamic-css.php' );
		}
	}

	/**
	 * Load JS Files for archive pages.
	 *
	 * @return void
	 */
	public function dr_cuisines_archive() {
		$recipe_templates = array(
			'templates/pages/recipe-courses.php',
			'templates/pages/recipe-cooking-methods.php',
			'templates/pages/recipe-cuisines.php',
			'templates/pages/recipe-keys.php',
			'templates/pages/recipe-tags.php',
			'templates/pages/recipe-dietary.php',
			'templates/pages/recipe-badges.php',
		);

		if ( is_page_template( $recipe_templates ) ) {
			wp_enqueue_script( 'delicious-recipes-cuisines', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/cuisinesJS.js' );
			wp_enqueue_style( 'delicious-recipes-cuisines', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/cuisinesJS.css' );
			wp_enqueue_style( 'delicious-recipes-cuisines-css', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/taxonomyCSS.css' );

		}
	}

	/**
	 * Handle the recipe printing.
	 *
	 * @return void
	 */
	public static function print_block_page() {
		preg_match( '/[\/\?]delrecipes_block_print[\/=](\d+)([\/\?\&].*)?$/', $_SERVER['REQUEST_URI'], $print_url );
		$recipe_id = isset( $print_url[1] ) ? $print_url[1] : false;

		// We have some params, let's check
		// extract params (e.g. /?servings=4&prep-time=15)
		if ( isset( $print_url[2] ) && is_string( $print_url[2] ) ) {
			preg_match_all( '/[\?|\&]([^=]+)\=([^&]+)/', $print_url[2], $params );

			if ( isset( $params[1] ) ) {
				foreach ( $params[1] as $key => $value ) {

					if ( 'block-type' === $value ) {
						$blockType = isset( $params[2][ $key ] ) ? $params[2][ $key ] : 'recipe-card';
					} elseif ( 'servings' === $value ) {
						$servings = isset( $params[2][ $key ] ) ? $params[2][ $key ] : 0;
					} elseif ( 'block-id' === $value ) {
						$blockId = isset( $params[2][ $key ] ) ? $params[2][ $key ] : '';
					}
				}
			}
		}

		if ( $recipe_id && isset( $blockType ) ) {
			// Prevent WP Rocket lazy image loading on print page.
			add_filter( 'do_rocket_lazyload', '__return_false' );

			// Prevent Avada lazy image loading on print page.
			if ( class_exists( 'Fusion_Images' ) && property_exists( 'Fusion_Images', 'lazy_load' ) ) {
				Fusion_Images::$lazy_load = false;
			}

			$recipe_id = intval( $recipe_id );
			$recipe    = get_post( $recipe_id );

			$has_delicious_recipes_block = false;
			$attributes                  = array();
			$content                     = $recipe->post_content;

			$whitelistBlocks = array(
				'recipe-card' => 'delicious-recipes/dynamic-recipe-card',
			);

			if ( 'publish' !== $recipe->post_status ) {
				wp_redirect( home_url() );
				exit();
			}

			if ( has_blocks( $recipe->post_content ) ) {
				$blocks = parse_blocks( $recipe->post_content );

				foreach ( $blocks as $key => $block ) {
					$is_block_in_list = isset( $whitelistBlocks[ $blockType ] );
					$needle_block_id  = isset( $block['attrs']['id'] ) ? $block['attrs']['id'] : 'dr-dynamic-recipe-card';
					$needle_block     = $is_block_in_list && $block['blockName'] === $whitelistBlocks[ $blockType ];
					$block_needed     = $blockId == $needle_block_id && $needle_block;

					if ( $block_needed ) {
						$has_delicious_recipes_block = true;
						$attributes                  = $block['attrs'];
					}
				}
			}

			if ( $has_delicious_recipes_block ) {
				header( 'HTTP/1.1 200 OK' );
				require plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/templates/global/block-print.php';
				flush();
				exit;
			}
		}
	}

	/**
	 * Adds the post type information in the search form.
	 *
	 * @param string $form The search form HTML.
	 * @return string Modified search form.
	 */
	public function get_search_form( $form ) {
		if ( is_recipe_search() && $form ) {
			$form = str_replace( '</form>', '<input type="hidden" name="post_type" value="' . esc_attr( DELICIOUS_RECIPE_POST_TYPE ) . '" /></form>', $form );
		}

		return $form;
	}

	/*
	 * Add the login/registration form for logged out users
	 */
	function get_login_registration_form() {

		if ( isset( $_GET['print_recipe'] ) && 'true' == $_GET['print_recipe'] ) {
			return;
		}

		$global_toggles = delicious_recipes_get_global_toggles_and_labels();

		if ( $global_toggles['enable_add_to_wishlist'] && ! is_user_logged_in() ) {

			ob_start();

			?>
				<div id="dr-user__registration-login-popup" class="dr-popup-user__registration-open" style="display:none;">
					<div class="dr-popup-container">
						<span class="dr-user__registration-login-popup-close">&times;</span>
						<?php
							$data = array(
								'popup' => true,
							);
							delicious_recipes_get_template( 'account/form-login.php', $data );
							?>
					</div>
				</div>
			<?php
			echo ob_get_clean();
		}
	}

	/**
	 * Chicory Integration
	 *
	 * @since 1.6.2
	 */
	public static function chicory_integration() {
		// check if the current page is a recipe post.
		if ( ! is_singular( DELICIOUS_RECIPE_POST_TYPE ) ) {
			return;
		}
		$global_settings = delicious_recipes_get_global_settings();

		$chicory_integration = $global_settings['enableChicoryIntegration'];
		if ( is_array( $chicory_integration ) && isset( $chicory_integration['0'] ) && 'yes' === $chicory_integration['0'] ) {
			$ads_enabled = $global_settings['enableChicoryInRecipeAds'];
			if ( is_array( $ads_enabled ) && isset( $ads_enabled['0'] ) && 'yes' === $ads_enabled['0'] ) {
				$ads_enabled = true;
			} else {
				$ads_enabled = false;
			}
			$chicory_config = array(
				'desktop' => array(
					'pairingAdsEnabled' => $ads_enabled,
					'inlineAdsEnabled'  => $ads_enabled,
					'inlineAdsRefresh'  => $ads_enabled,
					'pairingAdsRefresh' => $ads_enabled,
				),
				'mobile'  => array(
					'pairingAdsEnabled' => $ads_enabled,
					'inlineAdsEnabled'  => $ads_enabled,
					'inlineAdsRefresh'  => $ads_enabled,
					'pairingAdsRefresh' => $ads_enabled,
				),
			);

			if ( is_array( $global_settings['enableChicoryButton'] ) && isset( $global_settings['enableChicoryButton']['0'] ) && 'yes' === $global_settings['enableChicoryButton']['0'] ) {
				echo '<script>var CHICORY_NO_BUTTON=false</script>';
			} else {
				echo '<script>var CHICORY_NO_BUTTON=true</script>';
			}
			echo '<script>window.ChicoryConfig = ' . json_encode( $chicory_config ) . ';</script>';
			echo '<script defer src="https://www.chicoryapp.com/widget_v2/"></script>';
		}
	}
}
