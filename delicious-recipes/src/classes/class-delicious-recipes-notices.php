<?php
/**
 * WP Delicious Global Notices.
 *
 * @package Delicious_Recipes.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Delicious_Recipes_Notices class
 *
 * Handle custom notices display.
 */
class Delicious_Recipes_Notices {

	/**
	 * Errors array
	 *
	 * @var array
	 */
	private $errors = array();

	/**
	 * Success messages.
	 *
	 * @var array
	 */
	private $success = array();

	/**
	 * Class Constructor.
	 */
	public function __construct() {
	}

	/**
	 * Add notices
	 *
	 * @param string $value Notice message.
	 * @param string $type Notice type.
	 * @return void
	 */
	public function add( $value, $type = 'error' ) {

		if ( empty( $value ) ) {
			return;
		}

		if ( 'error' === $type ) {

			$this->errors = wp_parse_args( array( $value ), $this->errors );

			if ( DEL_RECIPE()->session ) {
				DEL_RECIPE()->session->set( 'delicious_recipes_errors', $this->errors );
			}
		} elseif ( 'success' === $type ) {

			$this->success = wp_parse_args( array( $value ), $this->success );

			if ( DEL_RECIPE()->session ) {
				DEL_RECIPE()->session->set( 'delicious_recipes_success', $this->success );
			}
		}
	}

	/**
	 * Get notices
	 *
	 * @param string  $type Notice type.
	 * @param boolean $destroy Destroy notice after getting.
	 * @return array
	 */
	public function get( $type = 'error', $destroy = true ) {

		if ( 'error' === $type ) {

			$errors = array();
			if ( DEL_RECIPE()->session ) {
				$errors = DEL_RECIPE()->session->get( 'delicious_recipes_errors' );
			}

			if ( $destroy ) {

				$this->destroy( $type );

			}

			return $errors;

		} elseif ( 'success' === $type ) {

			$success = array();
			if ( DEL_RECIPE()->session ) {
				$success = DEL_RECIPE()->session->get( 'delicious_recipes_success' );
			}

			if ( $destroy ) {
				$this->destroy( $type );
			}

			return $success;
		}
	}

	/**
	 * Destroy message.
	 *
	 * @param string $type Notice type.
	 * @return void
	 */
	public function destroy( $type ) {

		if ( 'error' === $type ) {

			$this->errors = array();

			if ( DEL_RECIPE()->session ) {
				DEL_RECIPE()->session->set( 'delicious_recipes_errors', $this->errors );
			}
		} elseif ( 'success' === $type ) {

			$this->success = array();

			if ( DEL_RECIPE()->session ) {
				DEL_RECIPE()->session->set( 'delicious_recipes_success', $this->success );
			}
		}
	}

	/**
	 * Print notices.
	 *
	 * @param string  $type Notice type.
	 * @param boolean $destroy Destroy notice after getting.
	 * @return void
	 */
	public function print_notices( $type, $destroy = true ) {
		$notices = $this->get( $type, $destroy );

		if ( empty( $notices ) ) {
			return;
		}

		if ( $notices && 'error' === $type ) {
			foreach ( $notices as $key => $notice ) {
				if ( 'error ' === $notice ) {
					return;
				}
				echo '<div class="delicious-recipes-error-msg">' . esc_html( $notice ) . '</div>';
			}
			return;
		} elseif ( $notices && 'success' === $type ) {
			foreach ( $notices as $key => $notice ) {
				echo '<div class="delicious-recipes-success-msg">' . esc_html( $notice ) . '</div>';
			}
			return;
		}
		return false;
	}
}
