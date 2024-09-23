<?php
/**
 * Responsible for handling the import of recipes from other sources.
 *
 * @package Delicious_Recipes
 * @since 1.0.0
 */

class Delicious_Recipes_Import {
	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'add_submenu_page' ), 20 );

		/**
		 * Enqueue assets for the import page.
		 *
		 * @since 1.6.2
		 */
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Add the import submenu to the WP Delicious menu.
	 *
	 * @since    1.0.0
	 */
	public function add_submenu_page() {

		add_submenu_page(
			'delicious-recipes',
			__( "Import Recipes", 'delicious-recipes' ),
			__( "Import Recipes", 'delicious-recipes' ),
			'manage_options',
			'delicious_recipes_import_recipes',
			array( $this, 'display_import_menu_page' ),
			10
		);
	}

	/**
	 * Display import page template
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function display_import_menu_page() {
		echo '<div id="delicious-recipe-import" class="delicious-recipe-outer"></div>';
	}

	/**
	 * Enqueue assets.
	 *
	 * @since 1.6.2
	 */
	public function enqueue_scripts() {
		$screen = get_current_screen();

		if ( isset( $screen->id ) && strpos( $screen->id, '_page_delicious_recipes_import_recipes' ) > 0 ) {
			$import_deps = include_once plugin_dir_path( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/import.asset.php';

			wp_register_script( 'delicious-recipes-import', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/import.js', $import_deps['dependencies'], $import_deps['version'], true );

			wp_localize_script(
				'delicious-recipes-import',
				'dr_import',
				array(
					'ajaxURL'   => esc_url( admin_url( 'admin-ajax.php' ) ),
					'siteURL'   => esc_url( home_url( '/' ) ),
					'adminURL'  => esc_url( admin_url() ),
					'pluginUrl' => esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ),
				)
			);

			wp_enqueue_script( 'delicious-recipes-import' );
		}
	}
}

new Delicious_Recipes_Import();
