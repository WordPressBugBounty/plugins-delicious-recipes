<?php
/**
 * Delicious Recipes REST API Authentication.
 *
 * @package Delicious_Recipes
 */

/**
 * JSON basic auth handler.
 *
 * @param int|false $user User ID if authenticated, false otherwise.
 * @return int|false User ID if authenticated, false otherwise.
 */
function delicious_recipes_json_basic_auth_handler( $user ) {
	global $wp_json_basic_auth_error;

	$wp_json_basic_auth_error = null;

	// Don't authenticate twice.
	if ( ! empty( $user ) ) {
		return $user;
	}

	// Only handle authentication for delicious-recipes REST API endpoints.
	if ( ! defined( 'REST_REQUEST' ) || ! REST_REQUEST ) {
		return $user;
	}

	// Check if this is a delicious-recipes API endpoint.
	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
	if ( strpos( $request_uri, '/wp-json/deliciousrecipe/' ) === false ) {
		return $user; // Exit early if NOT our endpoint - let other plugins handle their own auth.
	}

	// Check that we're trying to authenticate.
	if ( ! isset( $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'] ) ) {
		return $user;
	}

	$username = sanitize_user( wp_unslash( $_SERVER['PHP_AUTH_USER'] ) );
	$password = sanitize_text_field( wp_unslash( $_SERVER['PHP_AUTH_PW'] ) );

	/**
	 * In multi-site, wp_authenticate_spam_check filter is run on authentication. This filter calls
	 * get_currentuserinfo which in turn calls the determine_current_user filter. This leads to infinite
	 * recursion and a stack overflow unless the current function is removed from the determine_current_user
	 * filter during authentication.
	 */
	remove_filter( 'determine_current_user', 'delicious_recipes_json_basic_auth_handler', 20 );

	$user = wp_authenticate( $username, $password );

	add_filter( 'determine_current_user', 'delicious_recipes_json_basic_auth_handler', 20 );

	if ( is_wp_error( $user ) ) {
		$wp_json_basic_auth_error = $user;
		return false; // Return false to allow other auth handlers or Formidable's API key validation to run.
	}

	$wp_json_basic_auth_error = false; // Set to false instead of true when authentication succeeds.

	return $user->ID;
}
add_filter( 'determine_current_user', 'delicious_recipes_json_basic_auth_handler', 20 );

/**
 * JSON basic auth error display.
 *
 * @param WP_Error|null $error The authentication error.
 * @return WP_Error|null The authentication error or null.
 */
function delicious_recipe_json_basic_auth_error( $error ) {
	// Passthrough other errors.
	if ( ! empty( $error ) ) {
		return $error;
	}

	global $wp_json_basic_auth_error;

	// Only return authentication errors for delicious-recipes endpoints.
	if ( ! defined( 'REST_REQUEST' ) || ! REST_REQUEST ) {
		return $error;
	}

	// Check if this is a delicious-recipes API endpoint.
	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
	if ( strpos( $request_uri, '/wp-json/deliciousrecipe/' ) === false ) {
		return $error;
	}

	// Only return the error if it's actually an error (WP_Error object or null).
	// Don't return boolean true as an error.
	if ( is_wp_error( $wp_json_basic_auth_error ) ) {
		return $wp_json_basic_auth_error;
	}

	return $error;
}
add_filter( 'rest_authentication_errors', 'delicious_recipe_json_basic_auth_error' );
