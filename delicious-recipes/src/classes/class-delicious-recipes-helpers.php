<?php
/**
 * Class Helpers functions
 *
 * @since   1.0.4
 * @package Delicious_Recipes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class for helper functions for structured data render.
 */
class Delicious_Recipes_Helpers {
	public function generateId( $prefix = '' ) {
		return $prefix !== '' ? uniqid( $prefix . '-' ) : uniqid();
	}

	public function render_attributes( $attributes ) {
		if ( empty( $attributes ) ) {
			return '';
		}

		$render = '';

		if ( is_array( $attributes ) ) {
			foreach ( $attributes as $property => $value ) {
				$render .= sprintf( '%s="%s" ', $property, esc_attr( $value ) );
			}
		} elseif ( is_string( $attributes ) ) {
			$render = $attributes;
		}
		return trim( $render );
	}

	public function render_styles_attributes( $styles ) {
		if ( empty( $styles ) ) {
			return '';
		}

		$render = '';

		if ( is_array( $styles ) ) {
			foreach ( $styles as $property => $value ) {
				$render .= sprintf( '%s: %s; ', $property, $value );
			}
		} elseif ( is_string( $styles ) ) {
			$render = $styles;
		}
		return trim( $render );
	}

	public function parse_block_settings( $attrs ) {
		// Default settings array with predefined values
		$default_settings = array(
			'displayPrepTime'      => true,
			'displayRestTime'      => true,
			'displayCookingTime'   => true,
			'displayTotalTime'     => true,
			'displayCookingTemp'   => true,
			'custom_author_name'   => '',
			'displayServings'      => true,
			'displayCourse'        => true,
			'displayCuisine'       => true,
			'displayCookingMethod' => true,
			'displayRecipeKey'     => true,
			'displayDifficulty'    => true,
			'displayAuthor'        => true,
			'displayCalories'      => true,
			'displayBestSeason'    => true,
			'print_btn'            => true,
			'pin_btn'              => true,
			'displayEstimatedCost' => true,
			'displayRecipeDietary' => true,
		);

		// Merge the incoming attributes with the default settings.
		$settings = array_merge( $default_settings, array_intersect_key( $attrs, $default_settings ) );

		return $settings;
	}


	public function parse_recipe_buttons_block_settings( $attrs ) {
		$settings = isset( $attrs['settings'][0] ) ? $attrs['settings'][0] : array();

		if ( ! isset( $settings['jump_to_recipe_btn'] ) ) {
			$settings['jump_to_recipe_btn'] = true;
		}
		if ( ! isset( $settings['jump_to_video_btn'] ) ) {
			$settings['jump_to_video_btn'] = true;
		}
		if ( ! isset( $settings['print_recipe_btn'] ) ) {
			$settings['print_recipe_btn'] = true;
		}

		return $settings;
	}

	public function omit( array $array, array $paths ) {
		foreach ( $array as $key => $value ) {
			if ( in_array( $key, $paths ) ) {
				unset( $array[ $key ] );
			}
		}

		return $array;
	}

	public function getNumberFromString( $string ) {
		if ( ! is_string( $string ) ) {
			return false;
		}
		preg_match( '/\d+/', $string, $matches );
		return $matches ? $matches[0] : 0;
	}

	public function convertMinutesToHours( $minutes, $returnArray = false ) {
		$output = '';
		$time   = $this->getNumberFromString( $minutes );

		if ( ! $time ) {
			return $minutes;
		}

		$hours = floor( $time / 60 );
		$mins  = ( $time % 60 );

		if ( $returnArray ) {
			if ( $hours ) {
				$array['hours']['value'] = $hours;
				$array['hours']['unit']  = _n( 'hour', 'hours', (int) $hours, 'delicious-recipes' );
			}
			if ( $mins ) {
				$array['minutes']['value'] = $mins;
				$array['minutes']['unit']  = _n( 'minute', 'minutes', (int) $mins, 'delicious-recipes' );
			}

			return $array;
		}

		if ( $hours ) {
			$output = $hours . ' ' . _n( 'hour', 'hours', (int) $hours, 'delicious-recipes' );
		}

		if ( $mins ) {
			$output .= ' ' . $mins . ' ' . _n( 'minute', 'minutes', (int) $mins, 'delicious-recipes' );
		}

		return $output;
	}

	public function convert_youtube_url_to_embed( $url ) {
		$embed_url = preg_replace( '/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i', 'https://www.youtube.com/embed/$1?feature=oembed', $url );
		return $embed_url;
	}

	public function convert_vimeo_url_to_embed( $url ) {
		$embed_url = preg_replace( '/\s*[a-zA-Z\/\/:\.]*vimeo.com\/([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i', 'https://player.vimeo.com/video/$1', $url );
		return $embed_url;
	}
}
