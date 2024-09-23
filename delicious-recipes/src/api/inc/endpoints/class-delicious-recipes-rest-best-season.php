<?php
/**
 * Rest API: Delicious_Recipes_REST_Best_Season class
 *
 * @package DeliciousRecipes
 * @subpackage API Core
 * @since 1.6.2
 */

/**
 * Core base controller for managing and interacting with Recipe's Best Season via the REST API.
 *
 * @since 1.6.2
 */
class Delicious_Recipes_REST_Best_Season extends Delicious_Recipes_API_Controller {

	/**
	 * The namespace of this controller's route.
	 *
	 * @var string
	 */
	protected $namespace = 'deliciousrecipe/v1';

	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/best-season',
			array(
				array(
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_best_season' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
				),
				array(
					'methods'             => \WP_REST_Server::EDITABLE,
					'callback'            => array( $this, 'update_best_season' ),
					'permission_callback' => array( $this, 'update_settings_permissions_check' ),
				),
			)
		);
	}

	/**
	 * Grabs the best season stored in the database.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 */
	public function get_best_season( $request ) {
		$best_season_option = get_option( 'best_season_option', array() );

		$data = array(
			'success' => true,
			'data'    => $best_season_option,
		);
		return $data;
	}

	/**
	 * Updates the best season stored in the database.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 */
	public function update_best_season( $request ) {
		$formdata     = $request->get_json_params();
		$decoded_data = json_decode( $formdata, true );

		$best_season_option = get_option( 'best_season_option', array() );

		$best_season_option[ $decoded_data ] = $decoded_data;

		update_option( 'best_season_option', $best_season_option );

		$data = array(
			'success' => true,
			'data'    => $best_season_option,
		);

		return $data;
	}
}

/**
 * Register the Best Season REST API routes.
 */
function delicious_recipes_register_best_season_routes() {
	$controller = new Delicious_Recipes_REST_Best_Season( DELICIOUS_RECIPE_POST_TYPE );
	$controller->register_routes();
}

add_action( 'rest_api_init', 'delicious_recipes_register_best_season_routes' );
