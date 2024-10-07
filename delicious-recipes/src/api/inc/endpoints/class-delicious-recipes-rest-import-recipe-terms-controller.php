<?php
/**
 * Rest API: Delicious_Recipes_REST_Import_Recipe_Terms_Controller class
 *
 * @package DeliciousRecipes
 * @subpackage API Core
 * @since 1.6.5
 */

/**
 * Core base controller for managing and interacting with Recipe's Import Recipe Terms via the REST API.
 *
 * @since 1.6.5
 */
class Delicious_Recipes_REST_Import_Recipe_Terms_Controller extends Delicious_Recipes_API_Controller {
	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/get_import_recipes',
			array(
				array(
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_import_recipes' ),
					'permission_callback' => array( $this, 'get_item_permissions_check' ),
				),
			)
		);
		register_rest_route(
			$this->namespace,
			'/get_import_plugin_terms',
			array(
				array(
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_import_plugin_terms' ),
					'permission_callback' => array( $this, 'get_item_permissions_check' ),
				),
			)
		);
		register_rest_route(
			$this->namespace,
			'/import_recipes',
			array(
				array(
					'methods'             => \WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'import_recipes' ),
					'permission_callback' => array( $this, 'post_item_permissions_check' ),
				),
			)
		);
		register_rest_route(
			$this->namespace,
			'/import_recipe_fields',
			array(
				array(
					'methods'             => \WP_REST_Server::EDITABLE,
					'callback'            => array( $this, 'import_recipe_fields' ),
					'permission_callback' => array( $this, 'post_item_permissions_check' ),
				),
			)
		);
		register_rest_route(
			$this->namespace,
			'/delete_recipes',
			array(
				array(
					'methods'             => \WP_REST_Server::EDITABLE,
					'callback'            => array( $this, 'delete_recipes' ),
					'permission_callback' => array( $this, 'post_item_permissions_check' ),
				),
			)
		);
	}

	/**
	 * Fetch and Process Recipes.
	 *
	 * @param string $post_type Post Type.
	 */
	public function fetch_and_process_recipes( $post_type ) {
		$recipes = get_posts(
			array(
				'post_type'      => $post_type,
				'posts_per_page' => - 1,
				'post_status'    => 'any',
			)
		);
		if ( ! empty( $recipes ) ) {
			foreach ( $recipes as $key => $recipe ) {
				$recipes[ $key ]->author        = get_the_author_meta( 'display_name', $recipe->post_author );
				$recipes[ $key ]->thumbnail_id  = get_post_meta( $recipe->ID, '_thumbnail_id', true );
				$recipes[ $key ]->thumbnail_url = wp_get_attachment_image_url( $recipes[ $key ]->thumbnail_id, 'full' );
				$recipes[ $key ]->post_date     = gmdate( 'M j, Y', strtotime( $recipe->post_date ) );
			}
		} else {
			wp_send_json_error( __( 'There are no recipes available for import.', 'delicious-recipes' ) );
		}

		return $recipes;
	}

	/**
	 * Get Import Recipes from the Recipe Plugin.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 */
	public function get_import_recipes( $request ) {
		$selected_option = $request->get_param( 'selectedOption' );
		if ( 'cooked' === $selected_option ) {
			if ( ! class_exists( 'Cooked_Plugin' ) ) {
				wp_send_json_error( __( 'Install and activate the plugin to start the import process',
					'delicious-recipes' ) );
			} else {
				$recipes = $this->fetch_and_process_recipes( 'cp_recipe' );
			}
		}
		if ( 'wp-recipe-maker' === $selected_option ) {
			if ( ! class_exists( 'WP_Recipe_Maker' ) ) {
				wp_send_json_error( __( 'Install and activate the plugin to start the import process',
					'delicious-recipes' ) );
			} else {
				$recipes = $this->fetch_and_process_recipes( 'wprm_recipe' );
			}
		}
		wp_send_json_success( $recipes );
	}

	/**
	 * Get Import Recipe Terms from the Recipe Plugin.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 */
	public function get_import_plugin_terms( $request ) {
		$selected_option = $request->get_param( 'selectedOption' );
		if ( 'cooked' === $selected_option ) {
			$recipe_terms = get_option( 'cooked_settings', array() );
			$recipe_terms = $recipe_terms['recipe_taxonomies'];
		}
		if ( 'wp-recipe-maker' === $selected_option ) {
			$recipe_terms = array(
				'wprm_course',
				'wprm_cuisine',
				'wprm_keyword',
			);
		}
		wp_send_json_success( $recipe_terms );
	}

	/**
	 * Import Recipe Fields from the Recipe Plugin.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 */
	public function import_recipe_fields( $request ) {
		$formdata      = $request->get_json_params();
		$recipe_fields = json_decode( $formdata['recipe_fields'], true );

		$term_mapping = array();
		foreach ( $recipe_fields as $field ) {
			$from = $field['from'];
			$to   = $field['to'];

			$terms = get_terms(
				array(
					'taxonomy'   => $from,
					'hide_empty' => false,
				)
			);

			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					// If $to is recipe_keywords then just add to term_mapping without importing and the ids.
					if ( 'recipe_keywords' === $to ) {
						$term_mapping[] = array(
							'old_term_id'   => $term->term_id,
							'new_term_id'   => 0,
							'taxonomy_to'   => $to,
							'taxonomy_from' => $from,
						);
						continue;
					}

					// Check if term already exists.
					$term_exists = term_exists( $term->name, $to );
					if ( $term_exists ) {
						$term_mapping[] = array(
							'old_term_id'   => $term->term_id,
							'new_term_id'   => absint( $term_exists['term_id'] ),
							'taxonomy_to'   => $to,
							'taxonomy_from' => $from,
						);
						continue;
					}
					$term_data = array(
						'name'        => $term->name,
						'slug'        => $term->slug,
						'description' => $term->description,
						'parent'      => 0,
						'filter'      => 'raw',
						'taxonomy'    => $to,
						'term_group'  => 0,
					);
					$new_term  = wp_insert_term( $term_data['name'], $to, $term_data );
					if ( is_wp_error( $new_term ) ) {
						return array(
							'status'  => false,
							'message' => __( 'Error importing terms.', 'delicious-recipes' ),
						);
					}
					$term_mapping[] = array(
						'old_term_id'   => $term->term_id,
						'new_term_id'   => absint( $new_term['term_id'] ),
						'taxonomy_to'   => $to,
						'taxonomy_from' => $from,
					);
				}
			} else {
				error_log( 'No terms found for taxonomy: ' . $from );
				continue;
			}
		}

		return array(
			'status'  => true,
			'message' => __( 'Terms imported successfully.', 'delicious-recipes' ),
			'data'    => $term_mapping,
		);
	}

	/**
	 * Import Recipes from the Recipe Plugin.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 */
	public function import_recipes( $request ) {
		$selected_option  = $request->get_param( 'selectedOption' );
		$formdata         = $request->get_json_params();
		$recipe_to_import = json_decode( $formdata['recipe_id'], true );
		$imported_fields  = json_decode( $formdata['imported_fields'], true );
		$selected_option  = str_replace( '-', '_', $selected_option );

		$function_name = 'import_' . $selected_option . '_recipe';
		if ( method_exists( $this, $function_name ) ) {
			$imported_recipe = $this->$function_name( $recipe_to_import, $imported_fields );
		} else {
			$imported_recipe = 'Invalid Import Option';
		}

		return $imported_recipe;
	}

	/**
	 * Import Cooked Recipe.
	 *
	 * @param int $import_recipe_id Import Recipe ID.
	 * @param array $imported_fields Imported Fields.
	 */
	public function import_cooked_recipe( $import_recipe_id, $imported_fields ) {
		$recipe_data = get_post( $import_recipe_id );
		if ( ! $recipe_data ) {
			return array(
				'status'  => false,
				'message' => __( 'Recipe not found.', 'delicious-recipes' ),
			);
		}
		$recipe_settings = get_post_meta( $import_recipe_id, '_recipe_settings', true );
		if ( ! $recipe_settings ) {
			return array(
				'status'  => false,
				'message' => __( 'Recipe settings not found.', 'delicious-recipes' ),
			);
		}

		$difficulty_levels = array(
			1 => 'beginner',
			2 => 'intermediate',
			3 => 'advanced',
		);

		$recipeKeywords = array();
		// Get recipe keywords from $imported_fields.
		foreach ( $imported_fields[0] as $imported_field ) {
			if ( 'recipe_keywords' === $imported_field['taxonomy_to'] ) {
				$term = get_term( $imported_field['old_term_id'], $imported_field['taxonomy_from'] );
				if ( $term ) {
					$recipeKeywords[] = $term->name;
				}
			}
		}

		// Create new recipe post.
		$new_recipe                    = array();
		$new_recipe['post_title']      = isset( $recipe_data->post_title ) ? sanitize_text_field( $recipe_data->post_title ) : '';
		$new_recipe['post_name']       = isset( $recipe_data->post_name ) ? sanitize_title( $recipe_data->post_name ) : '';
		$new_recipe['post_content']    = '';
		$new_recipe['post_status']     = 'draft';
		$new_recipe['post_author']     = isset( $recipe_data->post_author ) ? absint( $recipe_data->post_author ) : '';
		$new_recipe['post_excerpt']    = isset( $recipe_data->post_excerpt ) ? sanitize_text_field( $recipe_data->post_excerpt ) : '';
		$new_recipe['ping_status']     = isset( $recipe_data->ping_status ) ? sanitize_text_field( $recipe_data->ping_status ) : '';
		$new_recipe['post_type']       = 'recipe';
		$new_recipe['commnets_status'] = isset( $recipe_data->comment_status ) ? sanitize_text_field( $recipe_data->comment_status ) : '';
		$new_recipe['comment_count']   = isset( $recipe_data->comment_count ) ? absint( $recipe_data->comment_count ) : '';

		// Insert new post meta data.
		$new_recipe_meta                      = array();
		$new_recipe_meta['recipeSubtitle']    = '';
		$new_recipe_meta['recipeDescription'] = isset( $recipe_settings['seo_description'] ) ? sanitize_text_field( $recipe_settings['seo_description'] ) : '';
		$new_recipe_meta['recipeKeywords']    = implode( ', ', $recipeKeywords ); // Join the keywords array.
		$new_recipe_meta['difficultyLevel']   = isset( $recipe_settings['difficulty_level'] ) ? $difficulty_levels[ absint( $recipe_settings['difficulty_level'] ) ] : '';
		$new_recipe_meta['prepTime']          = isset( $recipe_settings['prep_time'] ) ? sanitize_text_field( $recipe_settings['prep_time'] ) : '';
		$new_recipe_meta['prepTimeUnit']      = 'min';
		$new_recipe_meta['cookTime']          = isset( $recipe_settings['cook_time'] ) ? sanitize_text_field( $recipe_settings['cook_time'] ) : '';
		$new_recipe_meta['cookTimeUnit']      = 'min';
		$new_recipe_meta['cokingTemp']        = '';
		$new_recipe_meta['cokingTempUnit']    = 'C';
		$new_recipe_meta['restTime']          = '';
		$new_recipe_meta['restTimeUnit']      = 'min';
		$new_recipe_meta['recipeCalories']    = '';
		$new_recipe_meta['bestSeason']        = '';
		$new_recipe_meta['estimatedCost']     = '';
		$new_recipe_meta['estimatedCostCurr'] = '';
		$new_recipe_meta['noOfServings']      = isset( $recipe_settings['nutrition']['servings'] ) ? absint( $recipe_settings['nutrition']['servings'] ) : '';

		// Ingredients Data.
		$new_recipe_meta['ingredientTitle'] = '';
		$current_ingredient_section_index   = - 1;
		if ( isset( $recipe_settings['ingredients'] ) ) {
			foreach ( $recipe_settings['ingredients'] as $key => $ingredient ) {
				if ( isset( $ingredient['section_heading_name'] ) ) {
					$new_recipe_meta['recipeIngredients'][] = array(
						'sectionTitle' => isset( $ingredient['section_heading_name'] ) ? sanitize_text_field( $ingredient['section_heading_name'] ) : '',
						'ingredients'  => array(),
					);
					$current_ingredient_section_index       = count( $new_recipe_meta['recipeIngredients'] ) - 1;
				} else {
					if ( - 1 !== $current_ingredient_section_index ) {
						$new_recipe_meta['recipeIngredients'][ $current_ingredient_section_index ]['ingredients'][] = array(
							'quantity'   => isset( $ingredient['amount'] ) ? sanitize_text_field( $ingredient['amount'] ) : '',
							'unit'       => isset( $ingredient['measurement'] ) ? sanitize_text_field( $ingredient['measurement'] ) : '',
							'ingredient' => isset( $ingredient['name'] ) ? sanitize_text_field( $ingredient['name'] ) : '',
							'notes'      => isset( $ingredient['description'] ) ? sanitize_text_field( $ingredient['description'] ) : '',
						);
					} else {
						$new_recipe_meta['recipeIngredients'][] = array(
							'sectionTitle' => '',
							'ingredients'  => array(
								array(
									'quantity'   => isset( $ingredient['amount'] ) ? sanitize_text_field( $ingredient['amount'] ) : '',
									'unit'       => isset( $ingredient['measurement'] ) ? sanitize_text_field( $ingredient['measurement'] ) : '',
									'ingredient' => isset( $ingredient['name'] ) ? sanitize_text_field( $ingredient['name'] ) : '',
									'notes'      => isset( $ingredient['description'] ) ? sanitize_text_field( $ingredient['description'] ) : '',
								),
							),
						);
						$current_ingredient_section_index       = count( $new_recipe_meta['recipeIngredients'] ) - 1;
					}
				}
			}
		}

		// Instructions Data.
		$new_recipe_meta['instructionTitle'] = '';
		$current_instruction_section_index   = - 1;
		if ( isset( $recipe_settings['directions'] ) ) {
			foreach ( $recipe_settings['directions'] as $key => $direction ) {
				if ( isset( $direction['section_heading_name'] ) ) {
					$new_recipe_meta['recipeInstructions'][] = array(
						'sectionTitle' => isset( $direction['section_heading_name'] ) ? sanitize_text_field( $direction['section_heading_name'] ) : '',
						'instruction'  => array(),
					);
					$current_instruction_section_index       = count( $new_recipe_meta['recipeInstructions'] ) - 1;
				} else {
					$image_url = '';
					if ( isset( $direction['image'] ) && '' !== $direction['image'] ) {
						$image_url = wp_get_attachment_image_url( $direction['image'], 'full' );
					}
					if ( - 1 !== $current_instruction_section_index ) {
						$new_recipe_meta['recipeInstructions'][ $current_instruction_section_index ]['instruction'][] = array(
							'instructionTitle' => '',
							'instruction'      => isset( $direction['content'] ) ? wp_kses_post( $direction['content'] ) : '',
							'instructionNotes' => '',
							'image'            => ( isset( $direction['image'] ) && '' !== $direction['image'] ) ? absint( $direction['image'] ) : '',
							'videoURL'         => '',
							'chosen'           => '',
							'selected'         => '',
							'image_preview'    => isset( $image_url ) ? esc_url( $image_url ) : '',
						);
					} else {
						$new_recipe_meta['recipeInstructions'][] = array(
							'sectionTitle' => '',
							'instruction'  => array(
								array(
									'instructionTitle' => '',
									'instruction'      => isset( $direction['content'] ) ? wp_kses_post( $direction['content'] ) : '',
									'instructionNotes' => '',
									'image'            => isset( $direction['image'] ) ? absint( $direction['image'] ) : '',
									'videoURL'         => '',
									'chosen'           => '',
									'selected'         => '',
									'image_preview'    => isset( $image_url ) ? esc_url( $image_url ) : '',
								),
							),
						);
						$current_instruction_section_index       = count( $new_recipe_meta['recipeInstructions'] ) - 1;
					}
				}
			}
		}

		// Gallery Data.
		$new_recipe_meta['enableImageGallery'][] = ( isset( $recipe_settings['gallery'] ) && isset( $recipe_settings['gallery']['items'] ) && 0 !== count( $recipe_settings['gallery']['items'] ) ) ? 'yes' : '';
		if ( isset( $recipe_settings['gallery'] ) && isset( $recipe_settings['gallery']['items'] ) ) {
			foreach ( $recipe_settings['gallery']['items'] as $gallery_item ) {
				$preview_image                           = wp_get_attachment_image_url( $gallery_item, 'full' );
				$new_recipe_meta['imageGalleryImages'][] = array(
					'imageID'    => $gallery_item,
					'previewURL' => $preview_image,
				);
			}
		}
		$new_recipe_meta['enableVideoGallery'][] = ( isset( $recipe_settings['gallery'] ) && isset( $recipe_settings['gallery']['video_url'] ) && '' !== $recipe_settings['gallery']['video_url'] ) ? 'yes' : '';
		$video_url                               = isset( $recipe_settings['gallery']['video_url'] ) ? sanitize_text_field( $recipe_settings['gallery']['video_url'] ) : '';
		$video_type                              = '';
		$video_id                                = '';
		$video_thumbnail                         = '';
		if ( false !== strpos( $video_url, 'youtube' ) ) {
			$video_type      = 'youtube';
			$video_id        = explode( '?v=', $video_url );
			$video_id        = end( $video_id );
			$video_thumbnail = 'https://img.youtube.com/vi/' . $video_id . '/hqdefault.jpg';
		} elseif ( false !== strpos( $video_url, 'vimeo' ) ) {
			$video_type      = 'vimeo';
			$video_id        = explode( '/', $video_url );
			$video_id        = end( $video_id );
			$video_thumbnail = unserialize( file_get_contents( 'http://vimeo.com/api/v2/video/' . $video_id . '.php' ) );
			$video_thumbnail = $video_thumbnail[0]['thumbnail_large'];
		}
		$new_recipe_meta['videoGalleryVids'][] = array(
			'vidID'    => $video_id,
			'vidType'  => $video_type,
			'vidThumb' => $video_thumbnail,
		);

		// ? Might need to remove this from recipe-tabs-content.jsx.
		$new_recipe_meta['recipeDelicious'][] = array(
			'drImage' => '',
			'drLink'  => '',
		);

		// Nutrition Data.
		$new_recipe_meta['servings']          = isset( $recipe_settings['nutrition']['servings'] ) ? absint( $recipe_settings['nutrition']['servings'] ) : '';
		$new_recipe_meta['calories']          = isset( $recipe_settings['nutrition']['calories'] ) ? sanitize_text_field( $recipe_settings['nutrition']['calories'] ) : '';
		$new_recipe_meta['caloriesFromFat']   = isset( $recipe_settings['nutrition']['calories_fat'] ) ? sanitize_text_field( $recipe_settings['nutrition']['calories_fat'] ) : '';
		$new_recipe_meta['totalFat']          = isset( $recipe_settings['nutrition']['fat'] ) ? sanitize_text_field( $recipe_settings['nutrition']['fat'] ) : '';
		$new_recipe_meta['saturatedFat']      = isset( $recipe_settings['nutrition']['sat_fat'] ) ? sanitize_text_field( $recipe_settings['nutrition']['sat_fat'] ) : '';
		$new_recipe_meta['transFat']          = isset( $recipe_settings['nutrition']['trans_fat'] ) ? sanitize_text_field( $recipe_settings['nutrition']['trans_fat'] ) : '';
		$new_recipe_meta['cholesterol']       = isset( $recipe_settings['nutrition']['cholesterol'] ) ? sanitize_text_field( $recipe_settings['nutrition']['cholesterol'] ) : '';
		$new_recipe_meta['sodium']            = isset( $recipe_settings['nutrition']['sodium'] ) ? sanitize_text_field( $recipe_settings['nutrition']['sodium'] ) : '';
		$new_recipe_meta['potassium']         = isset( $recipe_settings['nutrition']['potassium'] ) ? sanitize_text_field( $recipe_settings['nutrition']['potassium'] ) : '';
		$new_recipe_meta['totalCarbohydrate'] = isset( $recipe_settings['nutrition']['carbs'] ) ? sanitize_text_field( $recipe_settings['nutrition']['carbs'] ) : '';
		$new_recipe_meta['dietaryFiber']      = isset( $recipe_settings['nutrition']['fiber'] ) ? sanitize_text_field( $recipe_settings['nutrition']['fiber'] ) : '';
		$new_recipe_meta['sugars']            = isset( $recipe_settings['nutrition']['sugars'] ) ? sanitize_text_field( $recipe_settings['nutrition']['sugars'] ) : '';
		$new_recipe_meta['protein']           = isset( $recipe_settings['nutrition']['protein'] ) ? sanitize_text_field( $recipe_settings['nutrition']['protein'] ) : '';
		$new_recipe_meta['vitaminA']          = isset( $recipe_settings['nutrition']['vitamin_a'] ) ? sanitize_text_field( $recipe_settings['nutrition']['vitamin_a'] ) : '';
		$new_recipe_meta['vitaminC']          = isset( $recipe_settings['nutrition']['vitamin_c'] ) ? sanitize_text_field( $recipe_settings['nutrition']['vitamin_c'] ) : '';
		$new_recipe_meta['calcium']           = isset( $recipe_settings['nutrition']['calcium'] ) ? sanitize_text_field( $recipe_settings['nutrition']['calcium'] ) : '';
		$new_recipe_meta['iron']              = isset( $recipe_settings['nutrition']['iron'] ) ? sanitize_text_field( $recipe_settings['nutrition']['iron'] ) : '';
		$new_recipe_meta['vitaminD']          = isset( $recipe_settings['nutrition']['vitamin_d'] ) ? sanitize_text_field( $recipe_settings['nutrition']['vitamin_d'] ) : '';
		$new_recipe_meta['vitaminE']          = isset( $recipe_settings['nutrition']['vitamin_e'] ) ? sanitize_text_field( $recipe_settings['nutrition']['vitamin_e'] ) : '';
		$new_recipe_meta['vitaminK']          = isset( $recipe_settings['nutrition']['vitamin_k'] ) ? sanitize_text_field( $recipe_settings['nutrition']['vitamin_k'] ) : '';
		$new_recipe_meta['thiamin']           = isset( $recipe_settings['nutrition']['thiamin'] ) ? sanitize_text_field( $recipe_settings['nutrition']['thiamin'] ) : '';
		$new_recipe_meta['riboflavin']        = isset( $recipe_settings['nutrition']['riboflavin'] ) ? sanitize_text_field( $recipe_settings['nutrition']['riboflavin'] ) : '';
		$new_recipe_meta['niacin']            = isset( $recipe_settings['nutrition']['niacin'] ) ? sanitize_text_field( $recipe_settings['nutrition']['niacin'] ) : '';
		$new_recipe_meta['vitaminB6']         = isset( $recipe_settings['nutrition']['vitamin_b6'] ) ? sanitize_text_field( $recipe_settings['nutrition']['vitamin_b6'] ) : '';
		$new_recipe_meta['folate']            = isset( $recipe_settings['nutrition']['folate'] ) ? sanitize_text_field( $recipe_settings['nutrition']['folate'] ) : '';
		$new_recipe_meta['vitaminB12']        = isset( $recipe_settings['nutrition']['vitamin_b12'] ) ? sanitize_text_field( $recipe_settings['nutrition']['vitamin_b12'] ) : '';
		$new_recipe_meta['biotin']            = isset( $recipe_settings['nutrition']['biotin'] ) ? sanitize_text_field( $recipe_settings['nutrition']['biotin'] ) : '';
		$new_recipe_meta['pantothenicAcid']   = isset( $recipe_settings['nutrition']['pantothenic_acid'] ) ? sanitize_text_field( $recipe_settings['nutrition']['pantothenic_acid'] ) : '';
		$new_recipe_meta['phosphorus']        = isset( $recipe_settings['nutrition']['phosphorus'] ) ? sanitize_text_field( $recipe_settings['nutrition']['phosphorus'] ) : '';
		$new_recipe_meta['iodine']            = isset( $recipe_settings['nutrition']['iodine'] ) ? sanitize_text_field( $recipe_settings['nutrition']['iodine'] ) : '';
		$new_recipe_meta['magnesium']         = isset( $recipe_settings['nutrition']['magnesium'] ) ? sanitize_text_field( $recipe_settings['nutrition']['magnesium'] ) : '';
		$new_recipe_meta['zinc']              = isset( $recipe_settings['nutrition']['zinc'] ) ? sanitize_text_field( $recipe_settings['nutrition']['zinc'] ) : '';
		$new_recipe_meta['selenium']          = isset( $recipe_settings['nutrition']['selenium'] ) ? sanitize_text_field( $recipe_settings['nutrition']['selenium'] ) : '';
		$new_recipe_meta['copper']            = isset( $recipe_settings['nutrition']['copper'] ) ? sanitize_text_field( $recipe_settings['nutrition']['copper'] ) : '';
		$new_recipe_meta['manganese']         = isset( $recipe_settings['nutrition']['manganese'] ) ? sanitize_text_field( $recipe_settings['nutrition']['manganese'] ) : '';
		$new_recipe_meta['chromium']          = isset( $recipe_settings['nutrition']['chromium'] ) ? sanitize_text_field( $recipe_settings['nutrition']['chromium'] ) : '';
		$new_recipe_meta['molybdenum']        = isset( $recipe_settings['nutrition']['molybdenum'] ) ? sanitize_text_field( $recipe_settings['nutrition']['molybdenum'] ) : '';
		$new_recipe_meta['chloride']          = isset( $recipe_settings['nutrition']['chloride'] ) ? sanitize_text_field( $recipe_settings['nutrition']['chloride'] ) : '';
		$new_recipe_meta['recipeNotes']       = '';

		$new_recipe_id = wp_insert_post( $new_recipe );
		if ( is_wp_error( $new_recipe_id ) ) {
			return array(
				'status'  => false,
				'message' => __( 'Error importing recipe.', 'delicious-recipes' ),
			);
		}

		// Insert new post meta data.
		update_post_meta( $new_recipe_id, 'delicious_recipes_metadata', $new_recipe_meta );

		// Update the _thumbnail_id meta.
		$thumbnail_id = get_post_meta( $import_recipe_id, '_thumbnail_id', true );
		update_post_meta( $new_recipe_id, '_thumbnail_id', $thumbnail_id );

		// Insert best season meta.
		update_post_meta( $new_recipe_id, '_dr_best_season', $new_recipe_meta['bestSeason'] );

		// Insert difficulty level meta.
		update_post_meta( $new_recipe_id, '_dr_difficulty_level', $new_recipe_meta['difficultyLevel'] );

		// Insert recipe ingredients meta.
		$ingredients = array();
		foreach ( $recipe_settings['ingredients'] as $key => $ingredient ) {
			if ( ! empty( $ingredient['name'] ) ) {
				$ingredients[] = array( sanitize_text_field( $ingredient['name'] ) );
			}
		}
		update_post_meta( $new_recipe_id, '_dr_recipe_ingredients', $ingredients );
		update_post_meta( $new_recipe_id, '_dr_ingredient_count', count( $ingredients ) );

		// Update recipe comments id to new recipe id.
		$comments = get_comments(
			array(
				'post_id' => $import_recipe_id,
			)
		);
		if ( ! empty( $comments ) ) {
			foreach ( $comments as $comment ) {
				$updated_comment = array(
					'comment_ID'      => $comment->comment_ID,
					'comment_post_ID' => $new_recipe_id,
				);
				wp_update_comment( $updated_comment );
			}
		}

		// Insert recipe likes and wishlist meta data.
		$likes = get_post_meta( $import_recipe_id, '_recipe_favorites', true );
		update_post_meta( $new_recipe_id, '_recipe_likes', $likes );

		$taxonomies = get_object_taxonomies( 'cp_recipe' );
		foreach ( $taxonomies as $taxonomy ) {
			$terms = wp_get_object_terms( $import_recipe_id, $taxonomy );
			foreach ( $imported_fields[0] as $imported_field ) {
				if ( $taxonomy === $imported_field['taxonomy_from'] ) {
					foreach ( $terms as $term ) {
						if ( $term->term_id === $imported_field['old_term_id'] ) {
							$terms_id = $imported_field['new_term_id'];
							wp_set_object_terms( $new_recipe_id, $terms_id, $imported_field['taxonomy_to'], true );
						}
					}
				}
			}
		}

		return array(
			'status'  => true,
			'message' => __( 'Recipe imported successfully.', 'delicious-recipes' ),
		);
	}

	/**
	 * Import WP Recipe Maker Recipe.
	 *
	 * @param int $import_recipe_id Import Recipe ID.
	 * @param array $imported_fields Imported Fields.
	 */
	public function import_wp_recipe_maker_recipe( $import_recipe_id, $imported_fields ) {
		global $wpdb;
		$recipe_data = get_post( $import_recipe_id );
		if ( ! $recipe_data ) {
			return array(
				'status'  => false,
				'message' => __( 'Recipe not found.', 'delicious-recipes' ),
			);
		}

		$post_meta = get_post_custom( $import_recipe_id );

		$parent_post_id = isset( $post_meta['wprm_parent_post_id'][0] ) ? absint( $post_meta['wprm_parent_post_id'][0] ) : 0;
		if ( 0 !== $parent_post_id ) {
			$parent_post_content = get_post( $parent_post_id )->post_content;
			if ( $parent_post_content ) {
				$blocks          = parse_blocks( $parent_post_content );
				$filtered_blocks = array_filter(
					$blocks,
					function ( $block ) {
						return $block['blockName'] !== 'wp-recipe-maker/recipe';
					}
				);

				$filtered_content = '';
				foreach ( $filtered_blocks as $block ) {
					$filtered_content .= render_block( $block );
				}
			}
		}

		$recipeKeywords = array();
		// Get recipe keywords from $imported_fields.
		foreach ( $imported_fields[0] as $imported_field ) {
			if ( 'recipe_keywords' === $imported_field['taxonomy_to'] ) {
				$term = get_term( $imported_field['old_term_id'], $imported_field['taxonomy_from'] );
				if ( $term ) {
					$recipeKeywords[] = $term->name;
				}
			}
		}

		// Create new recipe post.
		$new_recipe                    = array();
		$new_recipe['post_title']      = isset( $recipe_data->post_title ) ? sanitize_text_field( $recipe_data->post_title ) : '';
		$new_recipe['post_name']       = isset( $recipe_data->post_name )
			? ( ( '' !== $recipe_data->post_name )
				? sanitize_title( str_replace( 'wprm-', '', $recipe_data->post_name ) )
				: sanitize_title( $recipe_data->post_title ) )
			: '';
		$new_recipe['post_content']    = $filtered_content ? $filtered_content : '';
		$new_recipe['post_status']     = 'draft';
		$new_recipe['post_author']     = isset( $recipe_data->post_author ) ? absint( $recipe_data->post_author ) : '';
		$new_recipe['post_excerpt']    = has_excerpt( $import_recipe_id ) ? get_the_excerpt( $import_recipe_id ) : '';
		$new_recipe['ping_status']     = isset( $recipe_data->ping_status ) ? sanitize_text_field( $recipe_data->ping_status ) : '';
		$new_recipe['post_type']       = 'recipe';
		$new_recipe['commnets_status'] = isset( $recipe_data->comment_status ) ? sanitize_text_field( $recipe_data->comment_status ) : '';
		$new_recipe['comment_count']   = isset( $recipe_data->comment_count ) ? absint( $recipe_data->comment_count ) : '';

		// Insert new post meta data.
		$new_recipe_meta                      = array();
		$new_recipe_meta['recipeSubtitle']    = '';
		$new_recipe_meta['recipeDescription'] = isset( $recipe_data->post_content ) ? sanitize_text_field( $recipe_data->post_content ) : '';
		$new_recipe_meta['recipeKeywords']    = implode( ', ', $recipeKeywords ); // Join the keywords array.
		$new_recipe_meta['difficultyLevel']   = '';
		$new_recipe_meta['prepTime']          = isset( $post_meta['wprm_prep_time'][0] ) ? sanitize_text_field( $post_meta['wprm_prep_time'][0] ) : '';
		$new_recipe_meta['prepTimeUnit']      = 'min';
		$new_recipe_meta['cookTime']          = isset( $post_meta['wprm_cook_time'][0] ) ? sanitize_text_field( $post_meta['wprm_cook_time'][0] ) : '';
		$new_recipe_meta['cookTimeUnit']      = 'min';
		$new_recipe_meta['cokingTemp']        = '';
		$new_recipe_meta['cokingTempUnit']    = 'C';
		$custom_label                         = isset( $post_meta['wprm_custom_time_label'][0] ) ? sanitize_text_field( $post_meta['wprm_custom_time_label'][0] ) : '';
		if ( false != strpos( $custom_label, 'rest' ) ) {
			$new_recipe_meta['restTime'] = isset( $post_meta['wprm_custom_time'][0] ) ? sanitize_text_field( $post_meta['wprm_custom_time'][0] ) : '';
		} else {
			$new_recipe_meta['restTime'] = '';
		}
		$new_recipe_meta['restTimeUnit']      = 'min';
		$new_recipe_meta['recipeCalories']    = isset( $post_meta['wprm_nutrition_calories'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_calories'][0] ) : '';
		$new_recipe_meta['bestSeason']        = '';
		$recipe_cost                          = isset( $post_meta['wprm_cost'][0] ) ? sanitize_text_field( $post_meta['wprm_cost'][0] ) : '';
		$new_recipe_meta['estimatedCost']     = preg_replace( '/[^0-9.]/', '', $recipe_cost );
		$new_recipe_meta['estimatedCostCurr'] = preg_replace( '/\d+/', '', $recipe_cost );
		$new_recipe_meta['noOfServings']      = isset( $post_meta['wprm_servings'][0] ) ? absint( $post_meta['wprm_servings'][0] ) : '';

		// Ingredients Data.
		$new_recipe_meta['ingredientTitle'] = '';
		if ( isset( $post_meta['wprm_ingredients'][0] ) && '' !== $post_meta['wprm_ingredients'][0] ) {
			$ingredients = unserialize( $post_meta['wprm_ingredients'][0] );
			foreach ( $ingredients as $key => $ingredient ) {
				$current_section_ingredients = array();
				if ( isset( $ingredient['name'] ) && ! empty( $ingredient['name'] ) ) {
					if ( isset( $ingredient['ingredients'] ) && 0 !== count( $ingredient['ingredients'] ) ) {
						foreach ( $ingredient['ingredients'] as $ing ) {
							$current_section_ingredients[] = array(
								'quantity'   => isset( $ing['amount'] ) ? sanitize_text_field( $ing['amount'] ) : '',
								'unit'       => isset( $ing['unit'] ) ? sanitize_text_field( $ing['unit'] ) : '',
								'ingredient' => isset( $ing['name'] ) ? sanitize_text_field( $ing['name'] ) : '',
								'notes'      => isset( $ing['notes'] ) ? sanitize_text_field( $ing['notes'] ) : '',
							);
						}
					}
					$new_recipe_meta['recipeIngredients'][] = array(
						'sectionTitle' => isset( $ingredient['name'] ) ? sanitize_text_field( $ingredient['name'] ) : '',
						'ingredients'  => $current_section_ingredients,
					);
				} else {
					if ( isset( $ingredient['ingredients'] ) && 0 !== count( $ingredient['ingredients'] ) ) {
						foreach ( $ingredient['ingredients'] as $ing ) {
							$current_section_ingredients[] = array(
								'quantity'   => isset( $ing['amount'] ) ? sanitize_text_field( $ing['amount'] ) : '',
								'unit'       => isset( $ing['unit'] ) ? sanitize_text_field( $ing['unit'] ) : '',
								'ingredient' => isset( $ing['name'] ) ? sanitize_text_field( $ing['name'] ) : '',
								'notes'      => isset( $ing['notes'] ) ? sanitize_text_field( $ing['notes'] ) : '',
							);
						}
						$new_recipe_meta['recipeIngredients'][] = array(
							'sectionTitle' => '',
							'ingredients'  => $current_section_ingredients,
						);
					}
				}
			}
		}

		// Instructions Data.
		$new_recipe_meta['instructionTitle'] = '';
		if ( isset( $post_meta['wprm_instructions'][0] ) ) {
			$instructions = unserialize( $post_meta['wprm_instructions'][0] );
			foreach ( $instructions as $key => $instruction ) {
				$current_section_instructions = array();
				if ( isset( $instruction['name'] ) && ! empty( $instruction['name'] ) ) {
					if ( isset( $instruction['instructions'] ) && 0 !== count( $instruction['instructions'] ) ) {
						foreach ( $instruction['instructions'] as $ins ) {
							$image_url = '';
							if ( isset( $ins['image'] ) && '0' != $ins['image'] ) {
								$image_url = wp_get_attachment_image_url( $ins['image'], 'full' );
								if ( $image_url ) {
									$response = wp_remote_head( $image_url );
									if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
										$image_url = '';
									}
								}
							}
							$current_section_instructions[] = array(
								'instructionTitle' => '',
								'instruction'      => isset( $ins['text'] ) ? wp_kses_post( $ins['text'] ) : '',
								'instructionNotes' => '',
								'image'            => ( isset( $ins['image'] ) && '0' != $ins['image'] ) ? absint( $ins['image'] ) : '',
								'videoURL'         => '',
								'chosen'           => '',
								'selected'         => '',
								'image_preview'    => isset( $image_url ) ? esc_url( $image_url ) : '',
							);
						}
					}
					$new_recipe_meta['recipeInstructions'][] = array(
						'sectionTitle' => isset( $instruction['name'] ) ? sanitize_text_field( $instruction['name'] ) : '',
						'instruction'  => $current_section_instructions,
					);
				} else {
					if ( isset( $instruction['instructions'] ) && 0 !== count( $instruction['instructions'] ) ) {
						foreach ( $instruction['instructions'] as $ins ) {
							$image_url = '';
							if ( isset( $ins['image'] ) && '0' != $ins['image'] ) {
								$image_url = wp_get_attachment_image_url( $ins['image'], 'full' );
								if ( $image_url ) {
									$response = wp_remote_head( $image_url );
									if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
										$image_url = '';
									}
								}
							}
							$video_url = '';
							if ( isset( $ins['video'] ) && 0 !== count( $ins['video'] ) ) {
								if ( 'embed' === $ins['video']['type'] ) {
									$video_url = $ins['video']['embed'];
									if ( false === strpos( $video_url, 'youtube' ) && false === strpos( $video_url,
											'vimeo' ) ) {
										$video_url = '';
									}
								}
							}
							$current_section_instructions[] = array(
								'instructionTitle' => '',
								'instruction'      => isset( $ins['text'] ) ? wp_kses_post( $ins['text'] ) : '',
								'instructionNotes' => '',
								'image'            => ( isset( $ins['image'] ) && '0' != $ins['image'] ) ? absint( $ins['image'] ) : '',
								'videoURL'         => isset( $video_url ) ? sanitize_text_field( $video_url ) : '',
								'chosen'           => '',
								'selected'         => '',
								'image_preview'    => isset( $image_url ) ? esc_url( $image_url ) : '',
							);
						}
						$new_recipe_meta['recipeInstructions'][] = array(
							'sectionTitle' => '',
							'instruction'  => $current_section_instructions,
						);
					}
				}
			}
		}

		// Gallery Data.
		$new_recipe_meta['enableImageGallery']   = array();
		$new_recipe_meta['imageGalleryImages']   = array();
		$new_recipe_meta['enableVideoGallery'][] = isset( $post_meta['wprm_video_embed'][0] ) ? 'yes' : '';
		$video_url                               = isset( $post_meta['wprm_video_embed'][0] ) ? sanitize_text_field( $post_meta['wprm_video_embed'][0] ) : '';
		$video_type                              = '';
		if ( '' !== $video_url ) {
			if ( false !== strpos( $video_url, 'youtube' ) ) {
				$video_type      = 'youtube';
				$video_id        = '';
				$video_thumbnail = '';
				$video_id        = explode( '?v=', $video_url );
				$video_id        = end( $video_id );
				$video_thumbnail = 'https://img.youtube.com/vi/' . $video_id . '/hqdefault.jpg';
			} elseif ( false !== strpos( $video_url, 'vimeo' ) ) {
				$video_type      = 'vimeo';
				$video_id        = '';
				$video_thumbnail = '';
				$video_id        = explode( '/', $video_url );
				$video_id        = end( $video_id );
				$video_thumbnail = unserialize( file_get_contents( 'http://vimeo.com/api/v2/video/' . $video_id . '.php' ) );
				$video_thumbnail = $video_thumbnail[0]['thumbnail_large'];
			}
			$new_recipe_meta['videoGalleryVids'][] = array(
				'vidID'    => $video_id,
				'vidType'  => $video_type,
				'vidThumb' => $video_thumbnail,
			);
		}

		// ? Might need to remove this from recipe-tabs-content.jsx.
		$new_recipe_meta['recipeDelicious'][] = array(
			'drImage' => '',
			'drLink'  => '',
		);

		// Nutrition Data.
		$new_recipe_meta['servings']          = isset( $post_meta['wprm_servings'][0] ) ? absint( $post_meta['wprm_servings'][0] ) : '';
		$new_recipe_meta['calories']          = isset( $post_meta['wprm_nutrition_calories'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_calories'][0] ) : '';
		$new_recipe_meta['caloriesFromFat']   = '';
		$new_recipe_meta['totalFat']          = isset( $post_meta['wprm_nutrition_fat'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_fat'][0] ) : '';
		$new_recipe_meta['saturatedFat']      = isset( $post_meta['wprm_nutrition_saturated_fat'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_saturated_fat'][0] ) : '';
		$new_recipe_meta['transFat']          = isset( $post_meta['wprm_nutrition_trans_fat'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_trans_fat'][0] ) : '';
		$new_recipe_meta['cholesterol']       = isset( $post_meta['wprm_nutrition_cholesterol'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_cholesterol'][0] ) : '';
		$new_recipe_meta['sodium']            = isset( $post_meta['wprm_nutrition_sodium'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_sodium'][0] ) : '';
		$new_recipe_meta['potassium']         = isset( $post_meta['wprm_nutrition_potassium'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_potassium'][0] ) : '';
		$new_recipe_meta['totalCarbohydrate'] = isset( $post_meta['wprm_nutrition_carbohydrates'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_carbohydrates'][0] ) : '';
		$new_recipe_meta['dietaryFiber']      = isset( $post_meta['wprm_nutrition_fiber'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_fiber'][0] ) : '';
		$new_recipe_meta['sugars']            = isset( $post_meta['wprm_nutrition_sugar'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_sugar'][0] ) : '';
		$new_recipe_meta['protein']           = isset( $post_meta['wprm_nutrition_protein'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_protein'][0] ) : '';
		$new_recipe_meta['vitaminA']          = isset( $post_meta['wprm_nutrition_vitamin_a'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_vitamin_a'][0] ) : '';
		$new_recipe_meta['vitaminC']          = isset( $post_meta['wprm_nutrition_vitamin_c'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_vitamin_c'][0] ) : '';
		$new_recipe_meta['calcium']           = isset( $post_meta['wprm_nutrition_calcium'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_calcium'][0] ) : '';
		$new_recipe_meta['iron']              = isset( $post_meta['wprm_nutrition_iron'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_iron'][0] ) : '';
		$new_recipe_meta['vitaminD']          = isset( $post_meta['wprm_nutrition_vitamin_d'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_vitamin_d'][0] ) : '';
		$new_recipe_meta['vitaminE']          = isset( $post_meta['wprm_nutrition_vitamin_e'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_vitamin_e'][0] ) : '';
		$new_recipe_meta['vitaminK']          = isset( $post_meta['wprm_nutrition_vitamin_k'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_vitamin_k'][0] ) : '';
		$new_recipe_meta['thiamin']           = '';
		$new_recipe_meta['riboflavin']        = '';
		$new_recipe_meta['niacin']            = '';
		$new_recipe_meta['vitaminB6']         = isset( $post_meta['wprm_nutrition_vitamin_b6'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_vitamin_b6'][0] ) : '';
		$new_recipe_meta['folate']            = isset( $post_meta['wprm_nutrition_folate'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_folate'][0] ) : '';
		$new_recipe_meta['vitaminB12']        = isset( $post_meta['wprm_nutrition_vitamin_b12'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_vitamin_b12'][0] ) : '';
		$new_recipe_meta['biotin']            = '';
		$new_recipe_meta['pantothenicAcid']   = '';
		$new_recipe_meta['phosphorus']        = isset( $post_meta['wprm_nutrition_phosphorus'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_phosphorus'][0] ) : '';
		$new_recipe_meta['iodine']            = '';
		$new_recipe_meta['magnesium']         = isset( $post_meta['wprm_nutrition_magnesium'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_magnesium'][0] ) : '';
		$new_recipe_meta['zinc']              = isset( $post_meta['wprm_nutrition_zinc'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_zinc'][0] ) : '';
		$new_recipe_meta['selenium']          = isset( $post_meta['wprm_nutrition_selenium'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_selenium'][0] ) : '';
		$new_recipe_meta['copper']            = isset( $post_meta['wprm_nutrition_copper'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_copper'][0] ) : '';
		$new_recipe_meta['manganese']         = isset( $post_meta['wprm_nutrition_manganese'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_manganese'][0] ) : '';
		$new_recipe_meta['chromium']          = '';
		$new_recipe_meta['molybdenum']        = '';
		$new_recipe_meta['chloride']          = '';
		$new_recipe_meta['recipeNotes']       = isset( $post_meta['wprm_notes'][0] ) ? wp_kses_post( $post_meta['wprm_notes'][0] ) : '';

		if ( delicious_recipes_is_pro_activated() ) {
			// Equipment Data.
			if ( isset( $post_meta['wprm_equipment'][0] ) && '' !== $post_meta['wprm_equipment'][0] ) {
				$equipment = unserialize( $post_meta['wprm_equipment'][0] );
				foreach ( $equipment as $key => $equip ) {
					$term_meta       = get_term_meta( $equip['id'] );
					$term_meta       = array_map( 'maybe_unserialize', $term_meta );
					$equipment_meta  = array(
						'equipmentLinkLabel' => 'Buy Now',
						'equipmentLink'      => isset( $term_meta['wprmp_equipment_link'][0] ) ? $term_meta['wprmp_equipment_link'][0] : '',
						'addRelNofollow'     => isset( $term_meta['wprmp_equipment_link_nofollow'][0] ) && strpos( $term_meta['wprmp_equipment_link_nofollow'][0],
							'nofollow' ) !== false ? array( 'yes' ) : array(),
						'addRelSponsored'    => isset( $term_meta['wprmp_equipment_link_nofollow'][0] ) && strpos( $term_meta['wprmp_equipment_link_nofollow'][0],
							'sponsored' ) !== false ? array( 'yes' ) : array(),
						'openInNewWindow'    => array(),
					);
					$args            = array(
						'name'        => $equip['name'],
						'post_type'   => 'equipment',
						'post_status' => 'publish',
					);
					$equipment_query = new WP_Query( $args );
					if ( $equipment_query->have_posts() ) {
						while ( $equipment_query->have_posts() ) {
							$equipment_query->the_post();
							$equipment_post  = get_post();
							$equipment_image = wp_get_attachment_image_url( $term_meta['wprmp_equipment_image_id'][0],
								'full' );
							if ( $equipment_image ) {
								$response = wp_remote_head( $equipment_image );
								if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
									$equipment_image = '';
								}
							}
							$new_recipe_meta['recipeEquipmentIds'][] = array(
								'equipmentID'    => $equipment_post->ID,
								'equipmentTitle' => $equip['name'],
								'equipmentImage' => $equipment_image,
							);
						}
						wp_reset_postdata();
					} else {
						$equipment_post_id = wp_insert_post(
							array(
								'post_title'  => $equip['name'],
								'post_status' => 'publish',
								'post_type'   => 'equipment',
							)
						);
						$equipment_image   = wp_get_attachment_image_url( $term_meta['wprmp_equipment_image_id'][0],
							'full' );
						if ( $equipment_image ) {
							$response = wp_remote_head( $equipment_image );
							if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
								$equipment_image = '';
							}
						}
						if ( ! is_wp_error( $equipment_post_id ) ) {
							update_post_meta( $equipment_post_id,
								'_thumbnail_id',
								$term_meta['wprmp_equipment_image_id'][0] );
							update_post_meta( $equipment_post_id,
								'delicious_recipes_equipment_metadata',
								$equipment_meta );
						}
						$new_recipe_meta['recipeEquipmentIds'][] = array(
							'equipmentID'    => $equipment_post_id,
							'equipmentTitle' => $equip['name'],
							'equipmentImage' => $equipment_image,
						);
					}
				}
			}

			// Ingredient Links Data.
			if ( isset( $post_meta['wprm_ingredients'][0] ) && '' !== $post_meta['wprm_ingredients'][0] ) {
				$ingredients                        = unserialize( $post_meta['wprm_ingredients'][0] );
				$ingredient_links                   = array();
				$delicious_recipes_ingredient_links = get_option( 'delicious_recipes_auto_link_ingredients', array() );
				foreach ( $ingredients as $key => $ingredient ) {
					if ( isset( $ingredient['ingredients'] ) && 0 !== count( $ingredient['ingredients'] ) ) {
						foreach ( $ingredient['ingredients'] as $ing ) {
							$ingredient_name = isset( $ing['name'] ) ? strtolower( sanitize_text_field( $ing['name'] ) ) : '';
							$already_linked  = false;
							foreach ( $delicious_recipes_ingredient_links as $ingredient_link ) {
								if ( in_array( $ingredient_name, $ingredient_link['ingredientsKeywords'], true ) ) {
									$already_linked = true;
									break;
								}
							}
							if ( ! $already_linked ) {
								if ( isset( $ing['link'] ) && isset( $ing['link']['url'] ) && '' !== $ing['link']['url'] ) {
									$rel_attribute = array();
									if ( isset( $ing['link']['nofollow'] ) && in_array( $ing['link']['nofollow'],
											[ 'nofollow', 'sponsored' ],
											true ) ) {
										$rel_attribute[] = $ing['link']['nofollow'];
									}
									$ingredient_links[] = array(
										'ingredientsKeywords' => array(
											isset( $ing['name'] ) ? strtolower( sanitize_text_field( $ing['name'] ) ) : '',
										),
										'ingredientLink'      => isset( $ing['link']['url'] ) ? sanitize_text_field( $ing['link']['url'] ) : '',
										'openInNewTab'        => '1',
										'relAttribute'        => $rel_attribute,
										'totalClicks'         => '0',
									);
								}
							}
						}
					}
				}
				$ingredient_links = array_merge( $delicious_recipes_ingredient_links, $ingredient_links );
				update_option( 'delicious_recipes_auto_link_ingredients', $ingredient_links );
			}
		}

		$new_recipe_id = wp_insert_post( $new_recipe );
		if ( is_wp_error( $new_recipe_id ) ) {
			return array(
				'status'  => false,
				'message' => __( 'Error importing recipe.', 'delicious-recipes' ),
			);
		}

		// Insert new post meta data.
		update_post_meta( $new_recipe_id, 'delicious_recipes_metadata', $new_recipe_meta );

		// Update the _thumbnail_id meta.
		$thumbnail_id  = get_post_meta( $import_recipe_id, '_thumbnail_id', true );
		$thumbnail_url = wp_get_attachment_image_url( $thumbnail_id, 'full' );
		if ( $thumbnail_url ) {
			$response = wp_remote_head( $thumbnail_url );
			if ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) {
				update_post_meta( $new_recipe_id, '_thumbnail_id', $thumbnail_id );
			}
		}

		// Insert best season meta.
		update_post_meta( $new_recipe_id, '_dr_best_season', $new_recipe_meta['bestSeason'] );

		// Insert difficulty level meta.
		update_post_meta( $new_recipe_id, '_dr_difficulty_level', $new_recipe_meta['difficultyLevel'] );

		// Insert recipe ingredients meta.
		$ingredients = array();
		foreach ( $post_meta['wprm_ingredients'][0] as $key => $ingredient ) {
			if ( isset( $ingredient['name'] ) && ! empty( $ingredient['name'] ) ) {
				$ingredients[] = array( sanitize_text_field( $ingredient['name'] ) );
			}
		}
		update_post_meta( $new_recipe_id, '_dr_recipe_ingredients', $ingredients );
		update_post_meta( $new_recipe_id, '_dr_ingredient_count', count( $ingredients ) );

		// Update recipe comments id to new recipe id.
		$parent_post_id = isset( $post_meta['wprm_parent_post_id'][0] ) ? absint( $post_meta['wprm_parent_post_id'][0] ) : $import_recipe_id;
		$comments       = get_comments(
			array(
				'post_id' => $parent_post_id,
			)
		);
		if ( ! empty( $comments ) ) {
			foreach ( $comments as $comment ) {
				$updated_comment = array(
					'comment_ID'      => $comment->comment_ID,
					'comment_post_ID' => $new_recipe_id,
				);
				wp_update_comment( $updated_comment );
			}
		}

		$taxonomies = get_object_taxonomies( 'wprm_recipe' );
		foreach ( $taxonomies as $taxonomy ) {
			$terms = wp_get_object_terms( $import_recipe_id, $taxonomy );
			foreach ( $imported_fields[0] as $imported_field ) {
				if ( $taxonomy === $imported_field['taxonomy_from'] ) {
					foreach ( $terms as $term ) {
						if ( $term->term_id === $imported_field['old_term_id'] ) {
							$terms_id = $imported_field['new_term_id'];
							wp_set_object_terms( $new_recipe_id, $terms_id, $imported_field['taxonomy_to'], true );
						}
					}
				}
			}
		}

		return array(
			'status'  => true,
			'message' => __( 'Recipe imported successfully.', 'delicious-recipes' ),
		);
	}

	/**
	 * Delete Recipes from the Recipe Plugin.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 */
	public function delete_recipes( $request ) {
		$formdata   = $request->get_json_params();
		$recipe_ids = json_decode( $formdata['recipe_ids'], true );

		foreach ( $recipe_ids as $recipe_id ) {
			wp_delete_post( $recipe_id, true );
		}
		$taxonomies = get_object_taxonomies( 'cp_recipe' );
		foreach ( $taxonomies as $taxonomy ) {
			$terms = wp_get_object_terms( $recipe_id, $taxonomy );
			foreach ( $terms as $term ) {
				wp_remove_object_terms( $recipe_id, $term->term_id, $taxonomy );
			}
		}

		return array(
			'status'  => true,
			'message' => __( 'Recipes deleted successfully.', 'delicious-recipes' ),
		);
	}
}

/**
 * Register the REST API routes.
 */
function delicious_recipes_rest_import_recipe_terms_controller() {
	$controller = new Delicious_Recipes_REST_Import_Recipe_Terms_Controller();
	$controller->register_routes();
}

add_action( 'rest_api_init', 'delicious_recipes_rest_import_recipe_terms_controller' );
