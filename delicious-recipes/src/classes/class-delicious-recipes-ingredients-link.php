<?php
/**
 * Ingredients Link page to display ingredient links.
 */
class Delicious_Recipes_Ingredients_Link {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_ingredients_link_menu' ), 30 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Add menu for Ingredients Link
	 */
	public function add_ingredients_link_menu() {
		if ( ! function_exists( 'DEL_RECIPE_PRO' ) ) {
			add_submenu_page(
				'delicious-recipes',
				__( "Ingredients Link", 'delicious-recipes' ),
				__( "Ingredients Link", 'delicious-recipes' ),
				'manage_options',
				'delicious_recipes_auto_link_ingredients',
				array( $this, 'display_ingredients_link_menu_page' ),
				30
			);
		}
	}

	/**
	 * Callback page.
	 *
	 * @return void
	 */
	public function display_ingredients_link_menu_page() {
		echo '<div id="dr_ingredients_link_screen_page" class="delicious-recipe-outer"></div>';
	}

	/**
	 * Enqueue Assets.
	 */
	public function enqueue_scripts() {

		$screen = get_current_screen();
		if ( isset( $screen->id ) && strpos( $screen->id, '_page_delicious_recipes_auto_link_ingredients' ) > 0 ) {

			$ingredients_link_deps = include_once plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/ingredientsLink.asset.php';

			wp_register_script( 'delicious-recipes-ingredientsLink', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/ingredientsLink.js', $ingredients_link_deps['dependencies'], $ingredients_link_deps['version'], true );
			wp_localize_script(
				'delicious-recipes-ingredientsLink',
				'DeliciousRecipes',
				array(
					'ajaxURL'   => esc_url( admin_url( 'admin-ajax.php' ) ),
					'siteURL'   => esc_url( home_url( '/' ) ),
					'adminURL'  => esc_url( admin_url() ),
					'pluginUrl' => esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ),
				)
			);
			wp_enqueue_script( 'delicious-recipes-ingredientsLink' );
		}
	}
}
new Delicious_Recipes_Ingredients_Link();
