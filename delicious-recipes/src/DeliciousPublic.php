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

		// Load frontend scripts.
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

		// Add JavaScript file for Recipe Archive pages.
		add_action( 'wp_enqueue_scripts', array( $this, 'dr_cuisines_archive' ) );

		// For lazy loading.
		add_action( 'template_redirect', array( $this, 'start' ) );
		add_filter( 'delicious_recipes_output_buffer_template_redirect', array( $this, 'add_lazyload_attributes' ) );

		// For preloading featured image.
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
			add_filter( 'wp_lazy_loading_enabled', '__return_false' );
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

		$lazyload_enabled = get_theme_mod( 'has_lazy_load', false ); // The second parameter is the default value if not set
		$global_settings  = get_option( 'delicious_recipe_settings', true );

		// Check if the current page is a WP Travel Engine single post and lazy loading is enabled.
		if ( isset( $global_settings['enableLazyLoading'] ) && array( 'yes' ) !== $global_settings['enableLazyLoading'] ) {
			return $html;
		}

		// Check if lazy load is enabled from theme, if yes then return the HTML as it is.
		if ( $lazyload_enabled ) {
			return $html;
		}

		// Divi Visual Builder is active.
		if ( isset( $_GET['et_fb'] ) && '1' === $_GET['et_fb'] ) {
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
						$img_tag = preg_replace( '/class="([^"]*)"/i', 'class="$1 dr-lazy"', $img_tag );
					}
				} elseif ( ! is_null( $img_tag ) ) {
						$img_tag = str_replace( '<img', '<img class="dr-lazy"', $img_tag );
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

	/**
	 * Load dynamic CSS.
	 *
	 * @access public
	 *
	 * @param array $classes Body classes.
	 */
	public function wpdelicious_body_classes( $classes ) {
		if ( is_active_sidebar( 'delicious-recipe-sidebar' ) ) {
			$classes[] = 'wpdelicious-sidebar';
		}
		if ( is_recipe_search() ) {
			$classes[] = 'wpdelicious-recipe-search';
		}
		return $classes;
	}

	/**
	 * Load dynamic CSS.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function deactivate_lazyload_on_print() {
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
	 * @param array $items menu items.
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
						if ( ! $options['show_text_icon'] && $options['show_icon'] ) {
							$title = sprintf( '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 15L21 18M21 18L18 21M21 18H18.5689C17.6297 18 17.1601 18 16.7338 17.8705C16.3564 17.7559 16.0054 17.5681 15.7007 17.3176C15.3565 17.0348 15.096 16.644 14.575 15.8626L14.3333 15.5M18 3L21 6M21 6L18 9M21 6H18.5689C17.6297 6 17.1601 6 16.7338 6.12945C16.3564 6.24406 16.0054 6.43194 15.7007 6.68236C15.3565 6.96523 15.096 7.35597 14.575 8.13744L9.42496 15.8626C8.90398 16.644 8.64349 17.0348 8.29933 17.3176C7.99464 17.5681 7.64357 17.7559 7.2662 17.8705C6.83994 18 6.37033 18 5.43112 18H3M3 6H5.43112C6.37033 6 6.83994 6 7.2662 6.12945C7.64357 6.24406 7.99464 6.43194 8.29933 6.68236C8.64349 6.96523 8.90398 7.35597 9.42496 8.13744L9.66667 8.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>' );
						}
						if ( $options['show_text_icon'] || ( $options['show_icon'] && $options['show_text'] )
						|| ( $options['show_text_icon'] && $options['show_icon'] && $options['show_text'] )
						|| ( $options['show_text_icon'] && $options['show_icon'] ) ) {
							$title = sprintf( '%1$s<span style="margin-%2$s:0.3em;">%3$s</span>', '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 15L21 18M21 18L18 21M21 18H18.5689C17.6297 18 17.1601 18 16.7338 17.8705C16.3564 17.7559 16.0054 17.5681 15.7007 17.3176C15.3565 17.0348 15.096 16.644 14.575 15.8626L14.3333 15.5M18 3L21 6M21 6L18 9M21 6H18.5689C17.6297 6 17.1601 6 16.7338 6.12945C16.3564 6.24406 16.0054 6.43194 15.7007 6.68236C15.3565 6.96523 15.096 7.35597 14.575 8.13744L9.42496 15.8626C8.90398 16.644 8.64349 17.0348 8.29933 17.3176C7.99464 17.5681 7.64357 17.7559 7.2662 17.8705C6.83994 18 6.37033 18 5.43112 18H3M3 6H5.43112C6.37033 6 6.83994 6 7.2662 6.12945C7.64357 6.24406 7.99464 6.43194 8.29933 6.68236C8.64349 6.96523 8.90398 7.35597 9.42496 8.13744L9.66667 8.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>', is_rtl() ? 'right' : 'left', esc_html( $title ) );
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
		$global_settings = get_option( 'delicious_recipe_settings', true );

		$global_toggles = delicious_recipes_get_global_toggles_and_labels();

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

		$templates = array(
			'recipe-cooking-methods',
			'recipe-cuisines',
			'recipe-badges',
			'recipe-courses',
			'recipe-dietary',
			'recipe-keys',
			'recipe-tags',
		);

		$enable_autoload      = isset( $global_settings['autoloadRecipes']['0'] ) && 'yes' === $global_settings['autoloadRecipes']['0'] ? true : false;
		$infinite_scroll_deps = include_once plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/infiniteScroll.asset.php';
		if ( ( is_recipe() && isset( $global_settings['autoloadRecipes'] ) && array( 'yes' ) === $global_settings['autoloadRecipes'] ) || ( is_archive() && isset( $global_settings['archivePaginationStyle'] ) && 'infinite_scroll' === $global_settings['archivePaginationStyle'] ) ) {
			wp_enqueue_script( 'delicious-recipes-infiniteScroll', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/infiniteScroll.js', $infinite_scroll_deps['dependencies'], $infinite_scroll_deps['version'], true );
		}

		$license_validity = ( function_exists( 'DEL_RECIPE_PRO' ) && version_compare( DELICIOUS_RECIPES_PRO_VERSION, '2.2.2', '>=' ) ) ? delicious_recipe_pro_check_license_status() : true;
		$public_js_deps   = include_once plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdPublic.asset.php';

		if ( is_array( $public_js_deps ) && ! empty( $public_js_deps ) ) {
			$public_js_deps['dependencies'] = array_merge( $public_js_deps['dependencies'], array( 'jquery', 'wp-util' ) );
		} else {
			$public_js_deps = array( 'dependencies' => array( 'jquery', 'wp-util' ) );
		}
		$delicious_recipes = array(
			'ajax_url'             => admin_url( 'admin-ajax.php' ),
			'search_placeholder'   => __( 'Select filters', 'delicious-recipes' ),
			'edit_profile_pic_msg' => __( 'Click here or Drop new image to update your profile picture', 'delicious-recipes' ),
			'enable_autoload'      => $enable_autoload,
			'global_settings'      => $global_settings, // @since 1.4.7
			'nutritionFacts'       => delicious_recipes_get_nutrition_facts(),
			'proEnabled'           => function_exists( 'DEL_RECIPE_PRO' ),
			'license_validity'     => $license_validity,
			'isUserLoggedIn'       => is_user_logged_in(),
		);

		wp_register_script(
			'delicious-recipes-single',
			plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdPublic.js',
			$public_js_deps['dependencies'],
			filemtime( plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdPublic.js' ),
			true
		);
		wp_localize_script( 'delicious-recipes-single', 'delicious_recipes', $delicious_recipes );

		// Register Single Recipe Styles.
		wp_register_style(
			'delicious-recipe-single-styles',
			plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdSingleRecipe.css',
			array(),
			filemtime( plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdSingleRecipe.css' ),
			'all'
		);

		// Enqueue Global Styles.
		wp_enqueue_style(
			'delicious-recipe-global-styles',
			plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdGlobal.css',
			array(),
			filemtime( plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdGlobal.css' ),
			'all'
		);

		// Register Archive Styles.
		wp_register_style(
			'delicious-recipe-archive-styles',
			plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdArchive.css',
			array(),
			filemtime( plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdArchive.css' ),
			'all'
		);
		// Note: 'delicious-recipes-single' is added as a dependency to share the localized 'delicious_recipes' data.
		wp_register_script(
			'delicious-recipe-archive-styles-js',
			plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdArchiveJS.js',
			array( 'delicious-recipes-single' ),
			filemtime( plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdArchiveJS.js' ),
			'all'
		);

		// Splides JS, Reason to load css seperately is because css wasnt loading properly when imported in js file.
		wp_register_style(
			'delicious-recipe-splide-css',
			plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/splide/splide.min.css',
			array(),
			filemtime( plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/splide/splide.min.css' ),
			'all'
		);

		// Register Select2 JS and CSS.
		wp_register_script( 'select2', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/select2/select2.min.js', array( 'jquery' ), '4.0.13', true );
		wp_register_style( 'select2', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/select2/select2.min.css', array(), '4.0.13', 'all' );

		// Register Toastr CSS and JS.
		wp_register_style( 'toastr', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/toastr/toastr.min.css', array(), '2.1.3', 'all' );
		wp_register_script( 'toastr', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/toastr/toastr.min.js', array( 'jquery' ), '2.1.3', true );

		// Register Math JS.
		wp_register_script( 'math-min', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/public/js/math.min.js', array( 'jquery' ), '10.6.1', true );

		// Register Parsley JS.
		wp_register_script( 'parsley', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/parsley/parsley.min.js', array( 'jquery' ), '2.9.2', true );

		// Pintrest JS.
		wp_register_script( 'pintrest', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/pintrest/pintrest.min.js', array( 'jquery' ), '5.14.0', true );

		// Single Recipe JS.
		// Note: 'delicious-recipes-single' is added as a dependency to share the localized 'delicious_recipes' data
		// and prevent duplicate inline script blocks on single recipe pages.
		$single_recipe_js_deps = include_once plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/singleRecipe.asset.php';
		if ( is_array( $single_recipe_js_deps ) && ! empty( $single_recipe_js_deps ) ) {
			$single_recipe_js_deps['dependencies'] = array_merge( $single_recipe_js_deps['dependencies'], array( 'jquery', 'delicious-recipes-single' ) );
		} else {
			$single_recipe_js_deps = array( 'dependencies' => array( 'jquery', 'delicious-recipes-single' ) );
		}
		wp_register_script(
			'single-recipe',
			plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/singleRecipe.js',
			$single_recipe_js_deps['dependencies'],
			filemtime( plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/singleRecipe.js' ),
			true
		);

		// Enable/Disable FA Icons JS.
		$disable_fa_icons_js = isset( $global_settings['disableFAIconsJS']['0'] ) && 'yes' === $global_settings['disableFAIconsJS']['0'] ? true : false;
		if ( ! $disable_fa_icons_js ) {
			wp_enqueue_script( 'all', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/fontawesome/all.min.js', array( 'jquery' ), '5.14.0', true );
			wp_enqueue_script( 'v4-shims', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/fontawesome/v4-shims.min.js', array( 'jquery' ), '5.14.0', true );
		}

		// Enqueue Blocks Styles.
		$has_blocks = has_blocks( get_the_content() );
		if ( $has_blocks ) {
			$blocks = parse_blocks( get_the_content() );
			foreach ( $blocks as $block ) {
				if ( ! empty( $block['blockName'] ) && is_string( $block['blockName'] ) && strpos( $block['blockName'], 'delicious-recipes/' ) === 0 ) {
					wp_enqueue_style( 'delicious-recipe-block-styles', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/blockCSS.css', array(), DELICIOUS_RECIPES_VERSION, 'all' );
					wp_enqueue_style( 'delicious-recipe-single-styles' );
					wp_enqueue_style( 'delicious-recipe-archive-styles' );
					wp_enqueue_script( 'single-recipe' );
				}
			}
		}

		// Recipe Search and Dashboard.
		if ( ( is_recipe_dashboard() && isset( $_GET['tab'] ) && in_array( $_GET['tab'], array( 'browse', 'browse-recipes' ), true ) ) || is_recipe_search() || ( is_recipe_dashboard() && ! isset( $_GET['tab'] ) ) || has_shortcode( get_the_content(), 'dr_all_recipes' ) || has_shortcode( get_the_content(), 'recipe_search' ) ) {
			wp_enqueue_script( 'select2' );
			wp_enqueue_style( 'select2' );

			// Recipe Search CSS.
			wp_enqueue_style(
				'recipe-search-css',
				plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdRecipeSearch.css',
				array(),
				filemtime( plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/wpdRecipeSearch.css' ),
				'all'
			);

			// Recipe Search JS.
			// Note: 'delicious-recipes-single' is added as a dependency to share the localized 'delicious_recipes' data.
			$recipe_search_js_deps = include_once plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/recipeSearch.asset.php';
			if ( is_array( $recipe_search_js_deps ) && ! empty( $recipe_search_js_deps ) ) {
				$recipe_search_js_deps['dependencies'] = array_merge( $recipe_search_js_deps['dependencies'], array( 'jquery', 'select2', 'delicious-recipes-single' ) );
			} else {
				$recipe_search_js_deps = array( 'dependencies' => array( 'jquery', 'select2', 'delicious-recipes-single' ) );
			}
			wp_enqueue_script(
				'recipe-search-js',
				plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/recipeSearch.js',
				$recipe_search_js_deps['dependencies'],
				filemtime( plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/recipeSearch.js' ),
				true
			);

			// Enqueue Pinterest JS.
			if ( delicious_recipes_enable_pinit_btn() ) {
				wp_enqueue_script( 'pintrest' );
			}
		}

		if ( is_recipe() ) {
			wp_enqueue_style( 'delicious-recipe-single-styles' );
			wp_enqueue_script( 'single-recipe' );
		}

		if ( delicious_recipes_enable_pinit_btn() ) {
			if ( is_recipe()
				|| is_recipe_dashboard()
				|| is_recipe_taxonomy()
			) {
				wp_enqueue_script( 'pintrest', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/pintrest/pintrest.min.js', array( 'jquery' ), '5.14.0', true );
			}
		}

		if ( is_recipe_dashboard()
			|| has_shortcode( get_the_content(), 'dr_favorites_recipes' )
			|| has_shortcode( get_the_content(), 'dr_edit_profile' )
			|| has_shortcode( get_the_content(), 'dr_login' )
			|| has_shortcode( get_the_content(), 'dr_recipe_archives' )
		) {
			// Enqueue Toastr CSS and JS.
			wp_enqueue_style( 'toastr' );
			wp_enqueue_script( 'toastr' );

			// Enqueue Dropzone CSS and JS.
			wp_enqueue_style( 'dropzone', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/dropzone/dropzone.min.css', array(), '5.9.2', 'all' );
			wp_register_script( 'dropzone', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/lib/dropzone/dropzone.min.js', array(), '5.9.2', true );
			// Disable auto discover for Dropzone.
			wp_add_inline_script( 'dropzone', 'Dropzone.autoDiscover = false;' );

			// Enqueue User Dashboard CSS and JS.
			wp_enqueue_style(
				'delicious-recipes-user-dashboard',
				plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/user-dashboard.css',
				array(),
				filemtime( plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/user-dashboard.css' ),
				'all'
			);
			wp_enqueue_script(
				'delicious-recipes-user-dashboard',
				plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'src/dashboard/js/main.js',
				array( 'jquery', 'dropzone', 'parsley', 'wp-i18n' ),
				filemtime( plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'src/dashboard/js/main.js' ),
				true
			);

			// Set script translations.
			wp_set_script_translations( 'delicious-recipes-user-dashboard', 'delicious-recipes', plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'languages' );

			// Enqueue Archive Styles.
			wp_enqueue_style( 'delicious-recipe-archive-styles' );

			// Enqueue Archive JS.
			wp_enqueue_script( 'delicious-recipe-archive-styles-js' );

			// Set script translations.
			wp_set_script_translations( 'delicious-recipe-archive-styles-js', 'delicious-recipes', plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'languages' );
		}

		if ( is_tax() || array_reduce(
			$templates,
			function ( $carry, $template ) {
				return $carry || is_page_template( 'templates/pages/' . $template . '.php' );
			},
			false
		) ) {
			wp_enqueue_style( 'delicious-recipe-archive-styles' );
			wp_enqueue_script( 'delicious-recipe-archive-styles-js' );

			// Splide is not needed in individual taxonomy pages.
			if ( ! is_recipe_taxonomy() ) {
				wp_enqueue_style( 'delicious-recipe-splide-css' );
			}
		}

		$current_page = get_queried_object();
		if ( ( $current_page && 'recipe' === $current_page->name ) || has_shortcode( get_the_content(), 'dr_recipe_archives' ) ) {
			wp_enqueue_style( 'delicious-recipe-archive-styles' );
			wp_enqueue_script( 'delicious-recipe-archive-styles-js' );
			wp_enqueue_style( 'delicious-recipe-splide-css' );
			wp_enqueue_script( 'delicious-recipes-single' );
		}

		$active_theme = wp_get_theme();
		if ( 'Divi' === $active_theme->name ) {
			wp_enqueue_style(
				'delicious-recipe-divi-styles',
				plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/publicCSS_DIVI.css',
				array(),
				filemtime( plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/publicCSS_DIVI.css' ),
				'all'
			);
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

			// Check if pro is enabled.
			$pro_enabled = function_exists( 'DEL_RECIPE_PRO' );

			// Added condition to check if pro is activated but license is not valid.
			$license_validity_bool = true;
			if ( function_exists( 'DEL_RECIPE_PRO' ) && version_compare( DELICIOUS_RECIPES_PRO_VERSION, '2.2.2', '>=' ) ) {
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
	 * @param int $comment_id Comment ID.
	 *
	 * @return void
	 */
	public function dr_save_comment_rating( $comment_id ) {
		// phpcs:disable WordPress.Security.NonceVerification.Missing
		$comment_post_id = isset( $_POST['comment_post_ID'] ) ? intval( $_POST['comment_post_ID'] ) : 0;
		$comment_parent  = isset( $_POST['comment_parent'] ) ? intval( $_POST['comment_parent'] ) : 0;
		$rating          = isset( $_POST['rating'] ) ? floatval( $_POST['rating'] ) : '';

		if ( $comment_post_id && ( get_post_type( $comment_post_id ) == DELICIOUS_RECIPE_POST_TYPE ) ) {
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
	 * @param [type] $comment_text Comment Text.
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
	 * @param [type] $query Query.
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
	 * @param [type] $query Query.
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
				if ( '' === $post_type || 'post' === $post_type ) {
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
	 * @param [type] $query Query.
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
	 * @param [type] $title Title.
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
	 * @param [type] $description Description.
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
		// extract params (e.g. /?servings=4&prep-time=15).
		if ( isset( $print_url[2] ) && is_string( $print_url[2] ) ) {
			preg_match_all( '/[\?|\&]([^=]+)\=([^&]+)/', $print_url[2], $params );

			if ( isset( $params[1] ) ) {
				foreach ( $params[1] as $key => $value ) {

					if ( 'block-type' === $value ) {
						$block_type = isset( $params[2][ $key ] ) ? $params[2][ $key ] : 'recipe-card';
					} elseif ( 'servings' === $value ) {
						$servings = isset( $params[2][ $key ] ) ? $params[2][ $key ] : 0;
					} elseif ( 'block-id' === $value ) {
						$block_id = isset( $params[2][ $key ] ) ? $params[2][ $key ] : '';
					}
				}
			}
		}

		if ( $recipe_id && isset( $block_type ) ) {
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

			if ( 'publish' !== $recipe->post_status ) {
				wp_safe_redirect( home_url() );
				exit();
			}

			if ( has_blocks( $recipe->post_content ) ) {
				$blocks              = parse_blocks( $recipe->post_content );
				$dynamic_recipe_card = self::findDynamicRecipeCard( $blocks );
				if ( $dynamic_recipe_card ) {
					$has_delicious_recipes_block = true;
					$attributes                  = $dynamic_recipe_card['attrs'];
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
	 * Find the dynamic recipe card block within the array of blocks.
	 *
	 * @param array $blocks The array of blocks to search through.
	 * @return array|null The dynamic recipe card block or null if not found.
	 */
	public static function findDynamicRecipeCard( $blocks ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		foreach ( $blocks as $block ) {
			if ( isset( $block['blockName'] ) && 'delicious-recipes/dynamic-recipe-card' === $block['blockName'] ) {
				return $block; // Return the block when found.
			}
			if ( isset( $block['innerBlocks'] ) && is_array( $block['innerBlocks'] ) ) {
				$result = self::findDynamicRecipeCard( $block['innerBlocks'] );
				if ( $result ) {
					return $result; // Return the result if found in innerBlocks.
				}
			}
		}
		return null; // Return null if not found.
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

	/**
	 * Add the login/registration form for logged out users
	 */
	public function get_login_registration_form() {
		if ( isset( $_GET['print_recipe'] ) && 'true' === $_GET['print_recipe'] ) {
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
