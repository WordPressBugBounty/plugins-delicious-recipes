<?php
/**
 * Plugin Name:         WP Delicious
 * Plugin URI:          https://wpdelicious.com/docs/
 * Description:         A powerful recipe plugin to create and display recipes for bloggers. SEO optimized and Schema-friendly to rank recipes higher on search engines.
 * Author:              WP Delicious
 * Author URI:          https://wpdelicious.com
 * License:             GPLv3 or later
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:         delicious-recipes
 * Domain Path:         /languages
 * Version:             1.8.8
 * Requires at least:   5.1
 * Tested up to:        6.8
 * Requires PHP:        7.4
 *
 * @package         Delicious_Recipes
 */

use WP_Delicious\DeliciousRecipes;

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'delicious_recipes_fs' ) ) {
	/**
	 * Helper function to access the instance of Delicious Recipes SDK.
	 *
	 * @return DeliciousRecipes
	 */
	function delicious_recipes_fs() {
		global $delicious_recipes_fs;

		if ( ! isset( $delicious_recipes_fs ) ) {
			// Include Freemius SDK.
			require_once __DIR__ . '/src/lib/freemius/start.php';

			$first_time_activation_flag = get_option( 'delicious_recipes_first_time_activation_flag', false );

			$slug = false === $first_time_activation_flag ? 'delicious-recipes-onboard' : 'delicious_recipes_global_settings';

			$delicious_recipes_fs = fs_dynamic_init(
				array(
					'id'             => '7284',
					'slug'           => 'delicious-recipes',
					'type'           => 'plugin',
					'public_key'     => 'pk_85490c48c376203d6194ac3de232e',
					'is_premium'     => false,
					'has_addons'     => false,
					'has_paid_plans' => false,
					'menu'           => array(
						'slug'    => $slug,
						'account' => false,
						'contact' => false,
						'support' => false,
						'parent'  => array(
							'slug' => 'delicious-recipes',
						),
					),
				)
			);
		}

		return $delicious_recipes_fs;
	}

	// Init Freemius.
	delicious_recipes_fs();
	// Signal that parent SDK was initiated.
	do_action( '_loaded' );
	// Signal that SDK was initiated.
	do_action( 'delicious_recipes_fs_loaded' );
}

// Include the autoloader.
require_once __DIR__ . '/vendor/autoload.php';

if ( ! defined( 'DELICIOUS_RECIPES_PLUGIN_FILE' ) ) {
	define( 'DELICIOUS_RECIPES_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'DELICIOUS_RECIPES_VERSION' ) ) {
	define( 'DELICIOUS_RECIPES_VERSION', '1.8.8' );
}

/**
 * Return the main instance of DeliciousRecipes.
 *
 * @since 1.0.0
 * @return DeliciousRecipes
 */
function DEL_RECIPE() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	return DeliciousRecipes::instance();
}

DEL_RECIPE();
