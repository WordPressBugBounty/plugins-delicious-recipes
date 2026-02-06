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
					'permission_callback' => array( $this, 'delete_recipes_permissions_check' ),
				),
			)
		);
		register_rest_route(
			$this->namespace,
			'/get_csv_data',
			array(
				array(
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_csv_data' ),
					'permission_callback' => array( $this, 'get_item_permissions_check' ),
				),
			)
		);
		register_rest_route(
			$this->namespace,
			'/delete_csv',
			array(
				array(
					'methods'             => \WP_REST_Server::EDITABLE,
					'callback'            => array( $this, 'delete_csv' ),
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
	 * Fetch and Process Recipes for Tasty Recipe Plugin.
	 */
	public function fetch_and_process_recipes_for_tasty_recipe() {
		$recipes = get_posts(
			array(
				'post_type'      => 'any',
				'posts_per_page' => -1,
				'post_status'    => 'any',
			)
		);
		$recipes = array_filter(
			$recipes,
			function ( $recipe ) {
				$blocks              = parse_blocks( $recipe->post_content );
				$hasTastyRecipeBlock = false;
				foreach ( $blocks as $block ) {
					if ( $block['blockName'] === 'wp-tasty/tasty-recipe' ) {
						$hasTastyRecipeBlock = true;
						break;
					}
				}
				return $hasTastyRecipeBlock;
			}
		);
		$recipes = array_values( $recipes );
		if ( ! empty( $recipes ) ) {
			foreach ( $recipes as $key => $recipe ) {
				$recipe->author        = get_the_author_meta( 'display_name', $recipe->post_author );
				$recipe->thumbnail_id  = get_post_meta( $recipe->ID, '_thumbnail_id', true );
				$recipe->thumbnail_url = wp_get_attachment_image_url( $recipes[ $key ]->thumbnail_id, 'full' );
				$recipe->post_date     = gmdate( 'M j, Y', strtotime( $recipe->post_date ) );
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
				wp_send_json_error(
					__(
						'Install and activate the plugin to start the import process',
						'delicious-recipes'
					)
				);
			} else {
				$recipes = $this->fetch_and_process_recipes( 'cp_recipe' );
			}
		}
		if ( 'wp-recipe-maker' === $selected_option ) {
			if ( ! class_exists( 'WP_Recipe_Maker' ) ) {
				wp_send_json_error(
					__(
						'Install and activate the plugin to start the import process',
						'delicious-recipes'
					)
				);
			} else {
				$recipes = $this->fetch_and_process_recipes( 'wprm_recipe' );
			}
		}
		if ( 'tasty-recipes' === $selected_option ) {
			if ( ! class_exists( 'Tasty_Recipes' ) ) {
				wp_send_json_error(
					__(
						'Install and activate the plugin to start the import process',
						'delicious-recipes'
					)
				);
			} else {
				$recipes = $this->fetch_and_process_recipes_for_tasty_recipe( 'tasty-recipe' );
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
		if ( 'tasty-recipes' === $selected_option ) {
			$recipe_terms = array(
				'keywords',
				'category',
				'method',
				'cuisine',
				'diet',
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
		$formdata        = $request->get_json_params();
		$recipe_fields   = json_decode( $formdata['recipe_fields'], true );
		$selected_option = json_decode( $formdata['selected_option'], true );
		$posts           = json_decode( $formdata['posts'], true );

		if ( $selected_option === 'tasty-recipes' ) {
			return $this->import_recipe_fields_for_tasty_recipes( $recipe_fields, $posts );
		}

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
			}
		}

		return array(
			'status'  => true,
			'message' => __( 'Terms imported successfully.', 'delicious-recipes' ),
			'data'    => $term_mapping,
		);
	}

	/**
	 * Import Recipe Fields from Tasty Recipes Plugin.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 */
	public function import_recipe_fields_for_tasty_recipes( $recipe_fields, $posts ) {
		$term_mapping = array();
		foreach ( $posts as $post ) {
			$recipe = get_post( $post['id'] );
			$blocks = parse_blocks( $recipe->post_content );
			foreach ( $blocks as $block ) {
				if ( $block['blockName'] === 'wp-tasty/tasty-recipe' ) {
					$attributes = $block['attrs'];
					$post_id    = $attributes['id'];
					foreach ( $recipe_fields as $field ) {
						$from     = $field['from'];
						$to       = $field['to'];
						$postmeta = get_post_meta( $post_id, $from, true );
						$terms    = explode( ',', $postmeta );

						// If $to is recipe_keywords then just add to term_mapping without importing and the ids.
						if ( 'recipe_keywords' === $to ) {
							$term_mapping[] = array(
								'old_term_id'   => 0,
								'new_term_id'   => 0,
								'taxonomy_to'   => $to,
								'taxonomy_from' => $from,
							);
							continue;
						}

						if ( ! empty( $terms ) ) {
							foreach ( $terms as $term ) {
								$term = strtolower( trim( $term ) );
								$term = ucwords( $term );

								// Check if term already exists.
								$term_exists = term_exists( $term, $to );
								if ( $term_exists ) {
									$term_mapping[] = array(
										'old_term_id'   => 0,
										'new_term_id'   => absint( $term_exists['term_id'] ),
										'taxonomy_to'   => $to,
										'taxonomy_from' => $from,
									);
									continue;
								}

								if ( $term ) {
									$term_data = array(
										'name'        => $term,
										'slug'        => strtolower( str_replace( ' ', '-', $term ) ),
										'description' => $term,
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
								}
								$term_mapping[] = array(
									'old_term_id'   => 0,
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
				}
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
		$selected_option = $request->get_param( 'selectedOption' );
		$formdata        = $request->get_json_params();
		// Format selected option name for its dynamic function creation.
		$selected_option = str_replace( '-', '_', $selected_option );
		$function_name   = 'import_' . $selected_option . '_recipe';
		$imported_recipe = 'Invalid Import Option';

		if ( 'csv' !== $selected_option ) {
			$recipe_to_import = json_decode( $formdata['recipe_id'], true );
			$imported_fields  = json_decode( $formdata['imported_fields'], true );
			if ( method_exists( $this, $function_name ) ) {
				$imported_recipe = $this->$function_name( $recipe_to_import, $imported_fields );
			}
		} else {
			$recipe           = json_decode( $formdata['recipe'], true );
			$csv_file_headers = json_decode( $formdata['CSVFileHeaders'], true );
			$csv_fields       = json_decode( $formdata['CSVFields'], true );
			$recipe_fields    = json_decode( $formdata['recipeFields'], true );
			$imported_recipe  = $this->$function_name( $recipe, $csv_file_headers, $csv_fields, $recipe_fields );
		}

		return $imported_recipe;
	}

	/**
	 * Import Cooked Recipe.
	 *
	 * @param int   $import_recipe_id Import Recipe ID.
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

		$recipe_keywords = array();
		// Get recipe keywords from $imported_fields.
		foreach ( $imported_fields[0] as $imported_field ) {
			if ( 'recipe_keywords' === $imported_field['taxonomy_to'] ) {
				$term = get_term( $imported_field['old_term_id'], $imported_field['taxonomy_from'] );
				if ( $term ) {
					$recipe_keywords[] = $term->name;
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
		$new_recipe_meta['recipeKeywords']    = implode( ', ', $recipe_keywords ); // Join the keywords array.
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
				} elseif ( - 1 !== $current_ingredient_section_index ) {
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
		$new_recipe_meta['enableImageGallery'] = array();
		$new_recipe_meta['imageGalleryImages'] = array();
		if ( isset( $recipe_settings['gallery'] ) && isset( $recipe_settings['gallery']['items'] ) ) {
			foreach ( $recipe_settings['gallery']['items'] as $gallery_item ) {
				$preview_image                           = wp_get_attachment_image_url( $gallery_item, 'full' );
				$new_recipe_meta['imageGalleryImages'][] = array(
					'imageID'    => $gallery_item,
					'previewURL' => $preview_image,
				);
			}
		}
		$new_recipe_meta['enableVideoGallery'] = array();
		$new_recipe_meta['videoGalleryVids']   = array();
		$video_url                             = isset( $recipe_settings['gallery']['video_url'] ) ? sanitize_text_field( $recipe_settings['gallery']['video_url'] ) : '';
		$video_url                             = explode( '&', $video_url );
		$video_url                             = $video_url[0];
		if ( '' !== $video_url ) {
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
		}

		// ? Might need to remove this from recipe-tabs-content.jsx.
		$new_recipe_meta['recipeDelicious'][] = array(
			'drImage' => '',
			'drLink'  => '',
		);

		// Nutrition Data.
		$new_recipe_meta['servings']          = isset( $recipe_settings['nutrition']['servings'] ) ? absint( $recipe_settings['nutrition']['servings'] ) : '';
		$new_recipe_meta['calories']          = isset( $recipe_settings['nutrition']['calories'] ) ? sanitize_text_field( $recipe_settings['nutrition']['calories'] ) : '';
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

		// Notes Data.
		$new_recipe_meta['recipeNotes'] = isset( $recipe_settings['notes'] ) ? wp_kses_post( $recipe_settings['notes'] ) : '';

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
	 * @param int   $import_recipe_id Import Recipe ID.
	 * @param array $imported_fields Imported Fields.
	 */
	public function import_wp_recipe_maker_recipe( $import_recipe_id, $imported_fields ) {
		$recipe_data = get_post( $import_recipe_id );
		if ( ! $recipe_data ) {
			return array(
				'status'  => false,
				'message' => __( 'Recipe not found.', 'delicious-recipes' ),
			);
		}

		$post_meta = get_post_custom( $import_recipe_id );

		$parent_post_id   = isset( $post_meta['wprm_parent_post_id'][0] ) ? absint( $post_meta['wprm_parent_post_id'][0] ) : 0;
		$filtered_content = '';
		if ( 0 !== $parent_post_id ) {
			$parent_post_content = get_post( $parent_post_id )->post_content;
			if ( $parent_post_content ) {
				$blocks          = parse_blocks( $parent_post_content );
				$filtered_blocks = array_filter(
					$blocks,
					function ( $block ) {
						return 'wp-recipe-maker/recipe' !== $block['blockName'];
					}
				);

				foreach ( $filtered_blocks as $block ) {
					$filtered_content .= render_block( $block );
				}
			}
		}

		$recipe_keywords = array();
		// Get recipe keywords from $imported_fields.
		foreach ( $imported_fields[0] as $imported_field ) {
			if ( 'recipe_keywords' === $imported_field['taxonomy_to'] ) {
				$term = get_term( $imported_field['old_term_id'], $imported_field['taxonomy_from'] );
				if ( $term ) {
					$recipe_keywords[] = $term->name;
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
		$new_recipe['post_content']    = $filtered_content;
		$new_recipe['post_status']     = 'draft';
		$new_recipe['post_author']     = isset( $recipe_data->post_author ) ? absint( $recipe_data->post_author ) : '';
		$new_recipe['post_excerpt']    = has_excerpt( $import_recipe_id ) ? get_the_excerpt( $import_recipe_id ) : '';
		$new_recipe['ping_status']     = isset( $recipe_data->ping_status ) ? sanitize_text_field( $recipe_data->ping_status ) : 'closed';
		$new_recipe['post_type']       = 'recipe';
		$new_recipe['commnets_status'] = isset( $recipe_data->comment_status ) ? sanitize_text_field( $recipe_data->comment_status ) : '';
		$new_recipe['comment_count']   = isset( $recipe_data->comment_count ) ? absint( $recipe_data->comment_count ) : '';

		// Insert new post meta data.
		$new_recipe_meta                      = array();
		$new_recipe_meta['recipeSubtitle']    = '';
		$new_recipe_meta['recipeDescription'] = isset( $recipe_data->post_content ) ? sanitize_text_field( $recipe_data->post_content ) : '';
		$new_recipe_meta['recipeKeywords']    = implode( ', ', $recipe_keywords ); // Join the keywords array.
		$new_recipe_meta['difficultyLevel']   = '';
		$new_recipe_meta['prepTime']          = isset( $post_meta['wprm_prep_time'][0] ) ? sanitize_text_field( $post_meta['wprm_prep_time'][0] ) : '';
		$new_recipe_meta['prepTimeUnit']      = 'min';
		$new_recipe_meta['cookTime']          = isset( $post_meta['wprm_cook_time'][0] ) ? sanitize_text_field( $post_meta['wprm_cook_time'][0] ) : '';
		$new_recipe_meta['cookTimeUnit']      = 'min';
		$new_recipe_meta['cokingTemp']        = '';
		$new_recipe_meta['cokingTempUnit']    = 'C';
		$custom_label                         = isset( $post_meta['wprm_custom_time_label'][0] ) ? sanitize_text_field( $post_meta['wprm_custom_time_label'][0] ) : '';
		if ( false !== strpos( $custom_label, 'rest' ) ) {
			$new_recipe_meta['restTime'] = isset( $post_meta['wprm_custom_time'][0] ) ? sanitize_text_field( $post_meta['wprm_custom_time'][0] ) : '';
		} else {
			$new_recipe_meta['restTime'] = '';
		}
		$new_recipe_meta['restTimeUnit']      = 'min';
		$new_recipe_meta['recipeCalories']    = isset( $post_meta['wprm_nutrition_calories'][0] ) ? sanitize_text_field( $post_meta['wprm_nutrition_calories'][0] ) : '';
		$new_recipe_meta['bestSeason']        = '';
		$recipe_cost                          = isset( $post_meta['wprm_cost'][0] ) ? sanitize_text_field( $post_meta['wprm_cost'][0] ) : '';
		$new_recipe_meta['estimatedCost']     = ! is_null( $recipe_cost ) ?? preg_replace( '/[^0-9.]/', '', $recipe_cost );
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
				} elseif ( isset( $ingredient['ingredients'] ) && 0 !== count( $ingredient['ingredients'] ) ) {
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
				} elseif ( isset( $instruction['instructions'] ) && 0 !== count( $instruction['instructions'] ) ) {
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
								if ( false === strpos( $video_url, 'youtube' ) && false === strpos(
									$video_url,
									'vimeo'
								) ) {
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

		// Notes Data.
		$new_recipe_meta['recipeNotes'] = isset( $post_meta['wprm_notes'][0] ) ? wp_kses_post( $post_meta['wprm_notes'][0] ) : '';

		if ( delicious_recipes_is_pro_activated() ) {
			// Equipment Data.
			if ( isset( $post_meta['wprm_equipment'][0] ) && '' !== $post_meta['wprm_equipment'][0] ) {
				$equipment = unserialize( $post_meta['wprm_equipment'][0] );
				foreach ( $equipment as $key => $equip ) {
					$term_meta       = get_term_meta( $equip['id'] );
					$term_meta       = array_map( 'maybe_unserialize', $term_meta );
					$equipment_meta  = array(
						'externalImgUrl'     => '',
						'equipmentLinkLabel' => 'Buy Now',
						'equipmentLink'      => isset( $term_meta['wprmp_equipment_link'][0] ) ? $term_meta['wprmp_equipment_link'][0] : '',
						'addRelNofollow'     => isset( $term_meta['wprmp_equipment_link_nofollow'][0] ) && strpos(
							$term_meta['wprmp_equipment_link_nofollow'][0],
							'nofollow'
						) !== false ? array( 'yes' ) : array(),
						'addRelSponsored'    => isset( $term_meta['wprmp_equipment_link_nofollow'][0] ) && strpos(
							$term_meta['wprmp_equipment_link_nofollow'][0],
							'sponsored'
						) !== false ? array( 'yes' ) : array(),
						'openInNewWindow'    => array(),
					);
					$args            = array(
						'name'        => $equip['name'],
						'post_type'   => 'equipment',
						'post_status' => 'any',
					);
					$equipment_query = new WP_Query( $args );
					if ( $equipment_query->have_posts() ) {
						while ( $equipment_query->have_posts() ) {
							$equipment_query->the_post();
							$equipment_post  = get_post();
							$equipment_image = wp_get_attachment_image_url(
								$term_meta['wprmp_equipment_image_id'][0],
								'full'
							);
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
						$equipment_image   = wp_get_attachment_image_url(
							$term_meta['wprmp_equipment_image_id'][0],
							'full'
						);
						if ( $equipment_image ) {
							$response = wp_remote_head( $equipment_image );
							if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
								$equipment_image = '';
							}
						}
						if ( ! is_wp_error( $equipment_post_id ) ) {
							update_post_meta(
								$equipment_post_id,
								'_thumbnail_id',
								$term_meta['wprmp_equipment_image_id'][0]
							);
							update_post_meta(
								$equipment_post_id,
								'delicious_recipes_equipment_metadata',
								$equipment_meta
							);
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
									if ( isset( $ing['link']['nofollow'] ) && in_array(
										$ing['link']['nofollow'],
										array( 'nofollow', 'sponsored' ),
										true
									) ) {
										$rel_attribute[] = $ing['link']['nofollow'];
									}
									$ingredient_links[] = array(
										'ingredientsKeywords' => array(
											isset( $ing['name'] ) ? strtolower( sanitize_text_field( $ing['name'] ) ) : '',
										),
										'ingredientLink' => isset( $ing['link']['url'] ) ? sanitize_text_field( $ing['link']['url'] ) : '',
										'openInNewTab'   => '1',
										'relAttribute'   => $rel_attribute,
										'totalClicks'    => '0',
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
	 * Check permissions for deleting recipes.
	 *
	 * @param WP_REST_Request $request Current request.
	 * @return bool|WP_Error
	 */
	public function delete_recipes_permissions_check( $request ) {
		// Check if user has delete_posts capability for recipe post type.
		$post_type = defined( 'DELICIOUS_RECIPE_POST_TYPE' ) ? DELICIOUS_RECIPE_POST_TYPE : 'recipe';
		$post_type_obj = get_post_type_object( $post_type );

		if ( ! $post_type_obj ) {
			return new \WP_Error(
				'rest_invalid_post_type',
				esc_html__( 'Invalid post type.', 'delicious-recipes' ),
				array( 'status' => 404 )
			);
		}

		// Check if user has delete_posts capability for this post type.
		if ( ! current_user_can( $post_type_obj->cap->delete_posts ) ) {
			return new \WP_Error(
				'rest_cannot_delete',
				esc_html__( 'Sorry, you are not allowed to delete recipes.', 'delicious-recipes' ),
				array( 'status' => $this->authorization_status_code() )
			);
		}

		return true;
	}

	/**
	 * Delete Recipes from the Recipe Plugin.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return array|WP_Error
	 */
	public function delete_recipes( $request ) {
		$formdata   = $request->get_json_params();
		
		// Validate input.
		if ( ! isset( $formdata['recipe_ids'] ) || empty( $formdata['recipe_ids'] ) ) {
			return new \WP_Error(
				'rest_invalid_param',
				esc_html__( 'Recipe IDs are required.', 'delicious-recipes' ),
				array( 'status' => 400 )
			);
		}

		$recipe_ids = json_decode( $formdata['recipe_ids'], true );

		// Validate JSON decoding.
		if ( json_last_error() !== JSON_ERROR_NONE || ! is_array( $recipe_ids ) ) {
			return new \WP_Error(
				'rest_invalid_param',
				esc_html__( 'Invalid recipe IDs format.', 'delicious-recipes' ),
				array( 'status' => 400 )
			);
		}

		$post_type = defined( 'DELICIOUS_RECIPE_POST_TYPE' ) ? DELICIOUS_RECIPE_POST_TYPE : 'recipe';
		$post_type_obj = get_post_type_object( $post_type );
		$deleted_count = 0;
		$errors = array();

		foreach ( $recipe_ids as $recipe_id ) {
			// Validate recipe ID.
			$recipe_id = absint( $recipe_id );
			if ( ! $recipe_id ) {
				$errors[] = sprintf( esc_html__( 'Invalid recipe ID: %s', 'delicious-recipes' ), $recipe_id );
				continue;
			}

			// Get the post.
			$post = get_post( $recipe_id );

			// Check if post exists.
			if ( ! $post ) {
				$errors[] = sprintf( esc_html__( 'Recipe with ID %d does not exist.', 'delicious-recipes' ), $recipe_id );
				continue;
			}

			// Check if post is of the correct type.
			if ( $post->post_type !== $post_type ) {
				$errors[] = sprintf( esc_html__( 'Post ID %d is not a recipe.', 'delicious-recipes' ), $recipe_id );
				continue;
			}

			// Check if user can delete this specific post.
			if ( ! current_user_can( $post_type_obj->cap->delete_post, $recipe_id ) ) {
				$errors[] = sprintf( esc_html__( 'You do not have permission to delete recipe ID %d.', 'delicious-recipes' ), $recipe_id );
				continue;
			}

			// Delete the post.
			$result = wp_delete_post( $recipe_id, true );
			if ( $result ) {
				$deleted_count++;
			} else {
				$errors[] = sprintf( esc_html__( 'Failed to delete recipe ID %d.', 'delicious-recipes' ), $recipe_id );
			}
		}

		// Return response with results.
		if ( ! empty( $errors ) && $deleted_count === 0 ) {
			return new \WP_Error(
				'rest_delete_failed',
				esc_html__( 'Failed to delete recipes.', 'delicious-recipes' ),
				array(
					'status' => 500,
					'errors' => $errors,
				)
			);
		}

		$message = sprintf(
			/* translators: %d: number of deleted recipes */
			_n( '%d recipe deleted successfully.', '%d recipes deleted successfully.', $deleted_count, 'delicious-recipes' ),
			$deleted_count
		);

		$response = array(
			'status'  => true,
			'message' => $message,
			'deleted' => $deleted_count,
		);

		if ( ! empty( $errors ) ) {
			$response['errors'] = $errors;
			$response['message'] .= ' ' . esc_html__( 'Some recipes could not be deleted.', 'delicious-recipes' );
		}

		return $response;
	}

	/**
	 * Get CSV Data.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @since 1.7.8
	 */
	public function get_csv_data( $request ) {
		$csv_data = array();
		$file_id  = $request->get_param( 'file' );

		// Get the file path and other details from the file id.
		$file_path = get_attached_file( $file_id );

		// Check if the file exists.
		if ( ! file_exists( $file_path ) ) {
			return array(
				'status'  => false,
				'message' => __( 'File not found.', 'delicious-recipes' ),
			);
		}

		// Get the file data.
		$csv_data = $this->get_csv_file_data( $file_path );

		wp_send_json_success( $csv_data );
	}

	/**
	 * Get CSV File Data.
	 *
	 * @param string $file_path File Path.
	 * @since 1.7.8
	 */
	public function get_csv_file_data( $file_path ) {
		$csv_data = array();
		$csv_file = fopen( $file_path, 'r' );

		if ( false === $csv_file ) {
			return array(
				'status'  => false,
				'message' => __( 'Error reading CSV file.', 'delicious-recipes' ),
			);
		}

		$total_recipes = 0;
		while ( ( $data = fgetcsv( $csv_file, null, ',' ) ) !== false ) {
			$csv_data[] = $data;
			++$total_recipes;
		}

		if ( ! feof( $csv_file ) ) {
			fclose( $csv_file );
			return array(
				'status'  => false,
				'message' => __( 'Error reading CSV file.', 'delicious-recipes' ),
			);
		}
		fclose( $csv_file );

		$csv_headers = array_shift( $csv_data );
		--$total_recipes;
		if ( empty( $csv_headers ) ) {
			return array(
				'status'  => false,
				'message' => __( 'No data found in CSV file.', 'delicious-recipes' ),
			);
		}

		if ( 0 === $total_recipes ) {
			return array(
				'status'  => false,
				'message' => __( 'No recipes found in CSV file.', 'delicious-recipes' ),
			);
		}

		return array(
			'status'        => true,
			'message'       => __( 'CSV file data fetched successfully.', 'delicious-recipes' ),
			'headers'       => $csv_headers,
			'recipes'       => $csv_data,
			'total_recipes' => $total_recipes,
		);
	}

	/**
	 * Import CSV Recipes.
	 *
	 * @param array $recipe Import Recipe Data.
	 * @param array $csv_file_headers CSV File Header Fields.
	 * @param array $csv_fields CSV Recipe Metadata Fields Data.
	 * @param array $recipe_fields CSV Recipe Taxonomu fields.
	 *
	 * @since 1.7.8
	 */
	public function import_csv_recipe( $recipe, $csv_file_headers, $csv_fields, $recipe_fields ) {
		// Get the index of the mapped fields.
		foreach ( $csv_fields as $field => $value ) {
			foreach ( $csv_file_headers as $index => $header ) {
				if ( $value === $header ) {
					$csv_fields[ $field ] = $index;
				}
			}
		}

		$recipe_keywords = null;
		$taxonomy_fields = $recipe_fields;
		foreach ( $taxonomy_fields as &$recipe_field ) {
			foreach ( $csv_file_headers as $index => $header ) {
				if ( $recipe_field['from'] === $header ) {
					if ( 'recipe_keywords' === $recipe_field['to'] ) {
						$recipe_keywords = $index;
					}
					$recipe_field['from'] = $index;
				}
			}
		}

		// Get all the best seasons.
		$best_seasons = new WP_Delicious\Delicious_Recipes_Recipe();
		$best_seasons = $best_seasons->best_seasons();
		$best_season  = isset( $csv_fields['bestSeason'] ) ? sanitize_text_field( $recipe[ $csv_fields['bestSeason'] ] ) : '';

		// Check if the best season is not empty and is in the best seasons array.
		if ( ! empty( $best_season ) && ! in_array( $best_season, $best_seasons, true ) ) {
			// Add the best season to the best seasons array.
			$custom_seasons                 = get_option( 'best_season_option' );
			$custom_seasons                 = $custom_seasons ? $custom_seasons : array();
			$custom_seasons[ $best_season ] = $best_season;
			update_option( 'best_season_option', $custom_seasons );
		}

		$global_settings         = get_option( 'delicious_recipe_settings' );
		$estimated_cost_currency = isset( $global_settings['globalEstimatedCostCurr'] ) ? sanitize_text_field( $global_settings['globalEstimatedCostCurr'] ) : '';
		$estimated_cost          = isset( $csv_fields['estimatedCost'] ) ? sanitize_text_field( $recipe[ $csv_fields['estimatedCost'] ] ) : '';
		$estimated_cost          = preg_replace( '/[^0-9.]/', '', $estimated_cost );

		// Create new recipe post.
		$new_recipe                   = array();
		$new_recipe['post_title']     = isset( $csv_fields['recipeTitle'] ) ? sanitize_text_field( $recipe[ $csv_fields['recipeTitle'] ] ) : '';
		$new_recipe['post_name']      = isset( $csv_fields['recipeName'] ) ? sanitize_title( $recipe[ $csv_fields['recipeName'] ] ) : ( isset( $csv_fields['recipeTitle'] ) ? sanitize_title( $recipe[ $csv_fields['recipeTitle'] ] ) : '' );
		$new_recipe['post_content']   = isset( $csv_fields['postContent'] ) && ! is_null( $recipe[ $csv_fields['postContent'] ] ) ? nl2br( sanitize_text_field( $recipe[ $csv_fields['postContent'] ] ) ) : '';
		$new_recipe['post_status']    = 'draft';
		$new_recipe['post_author']    = isset( $csv_fields['recipeAuthor'] ) ? sanitize_text_field( $recipe[ $csv_fields['recipeAuthor'] ] ) : '';
		$new_recipe['post_excerpt']   = isset( $csv_fields['postExcerpt'] ) ? sanitize_text_field( $recipe[ $csv_fields['postExcerpt'] ] ) : '';
		$new_recipe['ping_status']    = 'closed';
		$new_recipe['post_type']      = 'recipe';
		$new_recipe['comment_status'] = isset( $csv_fields['commentStatus'] ) ? sanitize_text_field( $recipe[ $csv_fields['commentStatus'] ] ) : 'open';
		$new_recipe['comment_count']  = 0;

		// Insert new post meta data.
		$new_recipe_meta                      = array();
		$new_recipe_meta['recipeSubtitle']    = isset( $csv_fields['recipeSubtitle'] ) ? sanitize_text_field( $recipe[ $csv_fields['recipeSubtitle'] ] ) : '';
		$new_recipe_meta['recipeDescription'] = isset( $csv_fields['recipeDescription'] ) ? nl2br( sanitize_text_field( $recipe[ $csv_fields['recipeDescription'] ] ) ) : '';
		$new_recipe_meta['recipeKeywords']    = isset( $recipe_keywords ) ? sanitize_text_field( $recipe[ $recipe_keywords ] ) : '';
		$new_recipe_meta['difficultyLevel']   = isset( $csv_fields['difficultyLevel'] ) ? sanitize_text_field( $recipe[ $csv_fields['difficultyLevel'] ] ) : '';
		$new_recipe_meta['prepTime']          = isset( $csv_fields['prepTime'] ) ? sanitize_text_field( $recipe[ $csv_fields['prepTime'] ] ) : '';
		$new_recipe_meta['prepTimeUnit']      = 'min';
		$new_recipe_meta['cookTime']          = isset( $csv_fields['cookTime'] ) ? sanitize_text_field( $recipe[ $csv_fields['cookTime'] ] ) : '';
		$new_recipe_meta['cookTimeUnit']      = 'min';
		$new_recipe_meta['restTime']          = isset( $csv_fields['restTime'] ) ? sanitize_text_field( $recipe[ $csv_fields['restTime'] ] ) : '';
		$new_recipe_meta['restTimeUnit']      = 'min';
		$new_recipe_meta['cookingTemp']       = isset( $csv_fields['cookingTemp'] ) ? sanitize_text_field( $recipe[ $csv_fields['cookingTemp'] ] ) : '';
		$new_recipe_meta['cookingTempUnit']   = 'C';
		$new_recipe_meta['recipeCalories']    = isset( $csv_fields['recipeCalories'] ) ? sanitize_text_field( $recipe[ $csv_fields['recipeCalories'] ] ) : '';
		$new_recipe_meta['bestSeason']        = $best_season;
		$new_recipe_meta['estimatedCost']     = $estimated_cost;
		$new_recipe_meta['estimatedCostCurr'] = $estimated_cost_currency;

		// Ingredients Data.
		$new_recipe_meta['noOfServings']    = isset( $csv_fields['noOfServings'] ) ? sanitize_text_field( $recipe[ $csv_fields['noOfServings'] ] ) : '';
		$new_recipe_meta['ingredientTitle'] = isset( $csv_fields['ingredientTitle'] ) ? sanitize_text_field( $recipe[ $csv_fields['ingredientTitle'] ] ) : '';
		$ingredients                        = array();
		if ( isset( $csv_fields['ingredients'] ) && '' !== $csv_fields['ingredients'] ) {
			$input_ingredients = $recipe[ $csv_fields['ingredients'] ];
			$input_ingredients = explode( ',', $input_ingredients );
			foreach ( $input_ingredients as $ingredient ) {
				$notes = '';
				if ( strpos( $ingredient, '(' ) !== false ) {
					// Extract notes from inside parentheses.
					preg_match( '/\((.*?)\)/', $ingredient, $matches );
					$ingredient = trim( preg_replace( '/\(.*?\)/', '', $ingredient ) );
					$notes      = $matches[1];
				} else {
					$notes = '';
				}

				$ingredient = explode( ' ', $ingredient );

				// Check if there are numbers in the ingredient array. If there are then join them with a space.
				$numeric_found      = false;
				$last_numeric_index = -1;

				// First find the first and last numeric values.
				foreach ( $ingredient as $index => $item ) {
					// Remove any extra spaces.
					$item = trim( $item );

					// Check for various numeric formats.
					// - Pure numbers (1, 12, etc).
					// - Fractions (1/2, 3/4, etc).
					// - Ranges with or without spaces (1-2, 1 - 2).
					// - Mixed numbers (1 1/2).
					if ( is_numeric( $item ) ||
					preg_match( '/^\d+\/\d+$/', $item ) ||
					preg_match( '/^\d+\s*\-\s*\d+$/', $item ) ||
					preg_match( '/^\d+\s+\d+\/\d+$/', $item ) ) {
						if ( ! $numeric_found ) {
							$numeric_found       = true;
							$first_numeric_index = $index;
						}
						$last_numeric_index = $index;
					}
				}

				// If we found numeric values.
				$qty = '';
				if ( $numeric_found ) {
					if ( $first_numeric_index === $last_numeric_index ) {
						// Just one numeric value.
						$qty = $ingredient[ $first_numeric_index ];
					} else {
						// Multiple numeric values - join everything between first and last.
						$qty = implode( ' ', array_slice( $ingredient, $first_numeric_index, $last_numeric_index - $first_numeric_index + 1 ) );
					}
				}
				$qty  = trim( $qty );
				$unit = $ingredient[ $last_numeric_index + 1 ];
				// Get all non-qty and non-unit content as ingredient.
				$ingredient_parts = array();
				foreach ( $ingredient as $index => $item ) {
					// Skip qty indexes.
					if ( $index >= $first_numeric_index && $index <= $last_numeric_index ) {
						continue;
					}
					// Skip unit index.
					if ( $index === $last_numeric_index + 1 ) {
						continue;
					}
					$ingredient_parts[] = $item;
				}
				$ingredient    = implode( ' ', $ingredient_parts );
				$ingredients[] = array(
					'quantity'   => $qty ? str_replace( '⁄', '/', $qty ) : '',
					'unit'       => $unit,
					'ingredient' => $ingredient,
					'notes'      => $notes ?? '',
				);
			}
		}
		$new_recipe_meta['recipeIngredients'][] = array(
			'sectionTitle' => '',
			'ingredients'  => $ingredients,
		);

		// Instructions Data.
		$new_recipe_meta['instructionTitle'] = isset( $csv_fields['instructionTitle'] ) ? sanitize_text_field( $recipe[ $csv_fields['instructionTitle'] ] ) : '';
		$instructions                        = array();
		if ( isset( $csv_fields['instructions'] ) && '' !== $csv_fields['instructions'] ) {
			$input_instructions = $recipe[ $csv_fields['instructions'] ];
			$notes              = '';

			// Split instructions by '.,'.
			$input_instructions = explode( '.,', $input_instructions );
			foreach ( $input_instructions as $instruction ) {
				if ( ! empty( $instruction && '' !== $instruction ) ) {
					$instruction = trim( $instruction );
					if ( array_key_last( $input_instructions ) !== $index ) {
						$instruction .= '.';
					}
					$instructions[] = array(
						'instructionTitle' => '',
						'instruction'      => nl2br( $instruction ),
						'instructionNotes' => $notes,
						'image'            => '',
						'videoURL'         => '',
						'chosen'           => '',
						'selected'         => '',
						'image_preview'    => '',
					);
				}
			}
		}
		$new_recipe_meta['recipeInstructions'][] = array(
			'sectionTitle' => '',
			'instruction'  => $instructions,
		);

		$featured_image_url = isset( $csv_fields['featuredImage'] ) ? esc_url_raw( $recipe[ $csv_fields['featuredImage'] ] ) : '';
		$featured_image_id  = '';
		if ( '' !== $featured_image_url ) {
			// Upload the image to the media library and get the attachment ID.
			$attachment_id = $this->upload_image_to_media_library( $featured_image_url );
			if ( $attachment_id ) {
				$featured_image_id = $attachment_id;
			}
		}

		// Gallery Data.
		$new_recipe_meta['enableImageGallery'] = array();
		$new_recipe_meta['imageGalleryImages'] = array();
		if ( isset( $csv_fields['imageGallery'] ) && '' !== $csv_fields['imageGallery'] ) {
			$input_image_gallery                     = $recipe[ $csv_fields['imageGallery'] ];
			$input_image_gallery                     = explode( ',', $input_image_gallery );
			$new_recipe_meta['enableImageGallery'][] = 'yes';
			foreach ( $input_image_gallery as $image_url ) {
				$image_url      = esc_url_raw( $image_url );
				$attachment_id  = $this->upload_image_to_media_library( $image_url );
				$attachment_url = wp_get_attachment_url( $attachment_id );
				if ( $attachment_id ) {
					$new_recipe_meta['imageGalleryImages'][] = array(
						'imageID'    => $attachment_id,
						'previewURL' => $attachment_url,
					);
				}
			}
		}
		$new_recipe_meta['enableVideoGallery'] = array();
		$new_recipe_meta['videoGalleryVids']   = array();
		$video_urls                            = isset( $csv_fields['videoGallery'] ) ? sanitize_text_field( $recipe[ $csv_fields['videoGallery'] ] ) : '';
		if ( '' !== $video_urls ) {
			$new_recipe_meta['enableVideoGallery'][] = 'yes';
			$video_urls                              = explode( ',', $video_urls );
			foreach ( $video_urls as $video_url ) {
				if ( false !== strpos( $video_url, 'youtube' ) || false !== strpos( $video_url, 'youtu.be' ) ) {
					$video_type = 'youtube';
					if ( strpos( $video_url, 'youtube' ) !== false ) {
						$video_id = explode( '?v=', $video_url );
					} else {
						$video_id = explode( '.be/', $video_url );
					}
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
			}
		}

		// Nutrition Data.
		$new_recipe_meta['servings']          = isset( $csv_fields['noOfServings'] ) ? sanitize_text_field( $recipe[ $csv_fields['noOfServings'] ] ) : '';
		$new_recipe_meta['servingSize']       = isset( $csv_fields['servingSize'] ) ? sanitize_text_field( $recipe[ $csv_fields['servingSize'] ] ) : '';
		$new_recipe_meta['calories']          = isset( $csv_fields['calories'] ) ? sanitize_text_field( $recipe[ $csv_fields['calories'] ] ) : '';
		$new_recipe_meta['totalFat']          = isset( $csv_fields['totalFat'] ) ? sanitize_text_field( $recipe[ $csv_fields['totalFat'] ] ) : '';
		$new_recipe_meta['saturatedFat']      = isset( $csv_fields['saturatedFat'] ) ? sanitize_text_field( $recipe[ $csv_fields['saturatedFat'] ] ) : '';
		$new_recipe_meta['transFat']          = isset( $csv_fields['transFat'] ) ? sanitize_text_field( $recipe[ $csv_fields['transFat'] ] ) : '';
		$new_recipe_meta['cholesterol']       = isset( $csv_fields['cholesterol'] ) ? sanitize_text_field( $recipe[ $csv_fields['cholesterol'] ] ) : '';
		$new_recipe_meta['sodium']            = isset( $csv_fields['sodium'] ) ? sanitize_text_field( $recipe[ $csv_fields['sodium'] ] ) : '';
		$new_recipe_meta['potassium']         = isset( $csv_fields['potassium'] ) ? sanitize_text_field( $recipe[ $csv_fields['potassium'] ] ) : '';
		$new_recipe_meta['totalCarbohydrate'] = isset( $csv_fields['totalCarbohydrate'] ) ? sanitize_text_field( $recipe[ $csv_fields['totalCarbohydrate'] ] ) : '';
		$new_recipe_meta['dietaryFiber']      = isset( $csv_fields['dietaryFiber'] ) ? sanitize_text_field( $recipe[ $csv_fields['dietaryFiber'] ] ) : '';
		$new_recipe_meta['sugars']            = isset( $csv_fields['sugars'] ) ? sanitize_text_field( $recipe[ $csv_fields['sugars'] ] ) : '';
		$new_recipe_meta['protein']           = isset( $csv_fields['protein'] ) ? sanitize_text_field( $recipe[ $csv_fields['protein'] ] ) : '';
		$new_recipe_meta['vitaminA']          = isset( $csv_fields['vitaminA'] ) ? sanitize_text_field( $recipe[ $csv_fields['vitaminA'] ] ) : '';
		$new_recipe_meta['vitaminC']          = isset( $csv_fields['vitaminC'] ) ? sanitize_text_field( $recipe[ $csv_fields['vitaminC'] ] ) : '';
		$new_recipe_meta['calcium']           = isset( $csv_fields['calcium'] ) ? sanitize_text_field( $recipe[ $csv_fields['calcium'] ] ) : '';
		$new_recipe_meta['iron']              = isset( $csv_fields['iron'] ) ? sanitize_text_field( $recipe[ $csv_fields['iron'] ] ) : '';
		$new_recipe_meta['vitaminD']          = isset( $csv_fields['vitaminD'] ) ? sanitize_text_field( $recipe[ $csv_fields['vitaminD'] ] ) : '';
		$new_recipe_meta['vitaminE']          = isset( $csv_fields['vitaminE'] ) ? sanitize_text_field( $recipe[ $csv_fields['vitaminE'] ] ) : '';
		$new_recipe_meta['vitaminK']          = isset( $csv_fields['vitaminK'] ) ? sanitize_text_field( $recipe[ $csv_fields['vitaminK'] ] ) : '';
		$new_recipe_meta['thiamin']           = isset( $csv_fields['thiamin'] ) ? sanitize_text_field( $recipe[ $csv_fields['thiamin'] ] ) : '';
		$new_recipe_meta['riboflavin']        = isset( $csv_fields['riboflavin'] ) ? sanitize_text_field( $recipe[ $csv_fields['riboflavin'] ] ) : '';
		$new_recipe_meta['niacin']            = isset( $csv_fields['niacin'] ) ? sanitize_text_field( $recipe[ $csv_fields['niacin'] ] ) : '';
		$new_recipe_meta['vitaminB6']         = isset( $csv_fields['vitaminB6'] ) ? sanitize_text_field( $recipe[ $csv_fields['vitaminB6'] ] ) : '';
		$new_recipe_meta['folate']            = isset( $csv_fields['folate'] ) ? sanitize_text_field( $recipe[ $csv_fields['folate'] ] ) : '';
		$new_recipe_meta['vitaminB12']        = isset( $csv_fields['vitaminB12'] ) ? sanitize_text_field( $recipe[ $csv_fields['vitaminB12'] ] ) : '';
		$new_recipe_meta['biotin']            = isset( $csv_fields['biotin'] ) ? sanitize_text_field( $recipe[ $csv_fields['biotin'] ] ) : '';
		$new_recipe_meta['pantothenicAcid']   = isset( $csv_fields['pantothenicAcid'] ) ? sanitize_text_field( $recipe[ $csv_fields['pantothenicAcid'] ] ) : '';
		$new_recipe_meta['phosphorus']        = isset( $csv_fields['phosphorus'] ) ? sanitize_text_field( $recipe[ $csv_fields['phosphorus'] ] ) : '';
		$new_recipe_meta['iodine']            = isset( $csv_fields['iodine'] ) ? sanitize_text_field( $recipe[ $csv_fields['iodine'] ] ) : '';
		$new_recipe_meta['magnesium']         = isset( $csv_fields['magnesium'] ) ? sanitize_text_field( $recipe[ $csv_fields['magnesium'] ] ) : '';
		$new_recipe_meta['zinc']              = isset( $csv_fields['zinc'] ) ? sanitize_text_field( $recipe[ $csv_fields['zinc'] ] ) : '';
		$new_recipe_meta['selenium']          = isset( $csv_fields['selenium'] ) ? sanitize_text_field( $recipe[ $csv_fields['selenium'] ] ) : '';
		$new_recipe_meta['copper']            = isset( $csv_fields['copper'] ) ? sanitize_text_field( $recipe[ $csv_fields['copper'] ] ) : '';
		$new_recipe_meta['manganese']         = isset( $csv_fields['manganese'] ) ? sanitize_text_field( $recipe[ $csv_fields['manganese'] ] ) : '';
		$new_recipe_meta['chromium']          = isset( $csv_fields['chromium'] ) ? sanitize_text_field( $recipe[ $csv_fields['chromium'] ] ) : '';
		$new_recipe_meta['molybdenum']        = isset( $csv_fields['molybdenum'] ) ? sanitize_text_field( $recipe[ $csv_fields['molybdenum'] ] ) : '';
		$new_recipe_meta['chloride']          = isset( $csv_fields['chloride'] ) ? sanitize_text_field( $recipe[ $csv_fields['chloride'] ] ) : '';

		// Notes Data.
		$new_recipe_meta['recipeNotes'] = isset( $csv_fields['recipeNotes'] ) ? nl2br( wp_kses_post( $recipe[ $csv_fields['recipeNotes'] ] ) ) : '';

		// FQA Data.
		$new_recipe_meta['faqTitle']   = isset( $csv_fields['faqTitle'] ) ? sanitize_text_field( $csv_fields['faqTitle'] ) : '';
		$new_recipe_meta['recipeFAQs'] = array();
		if ( isset( $csv_fields['recipeFAQs'] ) && '' !== $csv_fields['recipeFAQs'] ) {
			$recipe_faqs = $recipe[ $csv_fields['recipeFAQs'] ];
			$recipe_faqs = explode( '.,', $recipe_faqs );
			foreach ( $recipe_faqs as $faq ) {
				$faq_data = explode( '?,', $faq );
				$answer   = $faq_data[1];
				if ( end( $recipe_faqs ) !== $faq ) {
					$answer .= '.';
				}
				$new_recipe_meta['recipeFAQs'][] = array(
					'question' => $faq_data[0] . '?',
					'answer'   => $answer,
				);
			}
		}

		if ( delicious_recipes_is_pro_activated() ) {
			// Equipment Data.
			if ( isset( $csv_fields['recipeEquipments'] ) && '' !== $csv_fields['recipeEquipments'] ) {
				$new_recipe_meta['equipmentsTitle'] = isset( $csv_fields['equipmentsTitle'] ) ? sanitize_text_field( $recipe[ $csv_fields['equipmentsTitle'] ] ) : '';
				$equipment                          = $recipe[ $csv_fields['recipeEquipments'] ];
				$equipment                          = explode( ',', $equipment );
				if ( ! empty( $equipment ) ) {
					foreach ( $equipment as $equip ) {
						$equip = trim( $equip );
						// Extract equipment details using regex.
						preg_match( '/^(.*?)\s*(?:\[link:(.*?)\])?\s*(?:\[image:(.*?)\])?$/', $equip, $matches );
						$equip_name      = $matches[1];
						$equip_link      = isset( $matches[2] ) ? $matches[2] : '';
						$equip_image     = isset( $matches[3] ) ? $matches[3] : '';
						$equip_image_id  = '';
						$equip_image_url = '';

						// Get the image link.
						if ( '' !== $equip_image ) {
							$equip_image_id  = $this->upload_image_to_media_library( $equip_image );
							$equip_image_url = wp_get_attachment_url( $equip_image_id );
						}

						// Check if equipment already exists.
						$args            = array(
							'name'        => $equip_name,
							'post_type'   => 'equipment',
							'post_status' => 'published',
						);
						$equipment_query = new WP_Query( $args );
						if ( $equipment_query->have_posts() ) {
							while ( $equipment_query->have_posts() ) {
								$equipment_query->the_post();
								$equipment_post = get_post();

								// Check if the equipment is already assigned to the recipe.
								$already_assigned = false;
								foreach ( $new_recipe_meta['recipeEquipmentIds'] as $assigned_equipment ) {
									if ( $equipment_post->ID === $assigned_equipment['equipmentID'] ) {
										$already_assigned = true;
										break;
									}
								}
								if ( ! $already_assigned ) {
									$new_recipe_meta['recipeEquipmentIds'][] = array(
										'equipmentID'    => $equipment_post->ID,
										'equipmentTitle' => $equip_name,
										'equipmentImage' => $equip_image_url,
									);
									update_post_meta( $equipment_post->ID, '_thumbnail_id', $equip_image_id );
									$equipment_args                  = get_post_meta( $equipment_post->ID, 'delicious_recipes_equipment_metadata' );
									$equipment_args['equipmentLink'] = $equip_link;
									update_post_meta( $equipment_post->ID, 'delicious_recipes_equipment_metadata', $equipment_args );
								}
							}
							wp_reset_postdata();
						} else {
							$equipment_post_id                       = wp_insert_post(
								array(
									'post_title'  => $equip_name,
									'post_status' => 'publish',
									'post_type'   => 'equipment',
								)
							);
							$new_recipe_meta['recipeEquipmentIds'][] = array(
								'equipmentID'    => $equipment_post_id,
								'equipmentTitle' => $equip_name,
								'equipmentImage' => $equip_image_url,
							);
							$equipment_args                          = array(
								'externalImgUrl'     => '',
								'equipmentLinkLabel' => 'Buy now',
								'equipmentTagLabel'  => '',
								'equipmentLink'      => $equip_link,
								'addRelNofollow'     => array( array( 'yes' ) ),
								'addRelSponsored'    => array( array( 'yes' ) ),
								'openInNewWindow'    => array( array( 'yes' ) ),
							);
							update_post_meta( $equipment_post_id, '_thumbnail_id', $equip_image_id );
							update_post_meta( $equipment_post_id, 'delicious_recipes_equipment_metadata', $equipment_args );
						}
					}
				}
			}

			// Extended Content Data.
			$new_recipe_meta['extendedContent'] = isset( $csv_fields['extendedContent'] ) ? nl2br( wp_kses_post( $recipe[ $csv_fields['extendedContent'] ] ) ) : '';
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
		update_post_meta( $new_recipe_id, '_thumbnail_id', $featured_image_id );

		// Insert best season meta.
		update_post_meta( $new_recipe_id, '_dr_best_season', $new_recipe_meta['bestSeason'] );

		// Insert difficulty level meta.
		update_post_meta( $new_recipe_id, '_dr_difficulty_level', $new_recipe_meta['difficultyLevel'] );

		// Insert recipe ingredients meta.
		$ingredients = array();
		foreach ( $recipe[ $csv_fields['recipeIngredients'] ] as $key => $ingredient ) {
			if ( isset( $ingredient['name'] ) && ! empty( $ingredient['name'] ) ) {
				$ingredients[] = array( sanitize_text_field( $ingredient['name'] ) );
			}
		}
		update_post_meta( $new_recipe_id, '_dr_recipe_ingredients', $ingredients );
		update_post_meta( $new_recipe_id, '_dr_ingredient_count', count( $ingredients ) );

		// Insert taxonomies.
		$this->insert_taxonomies( $new_recipe_id, $recipe, $taxonomy_fields );

		return array(
			'status'  => true,
			'message' => __( 'Recipe imported successfully.', 'delicious-recipes' ),
			'recipe'  => $new_recipe['post_title'],
		);
	}

	/**
	 * Upload Image to Media Library.
	 *
	 * @param string $image_url Image URL.
	 * @since 1.7.8
	 */
	public function upload_image_to_media_library( $image_url ) {
		// Only allow http/https URLs.
		$scheme = wp_parse_url( $image_url, PHP_URL_SCHEME );
		if ( ! in_array( $scheme, array( 'http', 'https' ), true ) ) {
			return false;
		}

		// Attempt to download to a temporary file using core helper.
		$temporary_file = download_url( $image_url, 15 );
		if ( is_wp_error( $temporary_file ) ) {
			return false;
		}

		// Compute content hash and reuse existing attachment if already imported.
		$sha256_hash = @hash_file( 'sha256', $temporary_file );
		if ( $sha256_hash ) {
			$existing = get_posts(
				array(
					'post_type'      => 'attachment',
					'post_status'    => 'inherit',
					'posts_per_page' => 1,
					'fields'         => 'ids',
					'meta_query'     => array(
						array(
							'key'     => '_dr_file_hash',
							'value'   => $sha256_hash,
							'compare' => '=',
						),
					),
				)
			);
			if ( ! empty( $existing ) ) {
				@unlink( $temporary_file );
				return (int) $existing[0];
			}
		}

		// Prepare a safe filename and validate the file type using a strict allowlist.
		$original_filename = wp_basename( parse_url( $image_url, PHP_URL_PATH ) );
		$original_filename = sanitize_file_name( $original_filename );
		if ( empty( $original_filename ) ) {
			$original_filename = 'imported-image';
		}

		// Validate type and extension based on actual file contents.
		$check         = wp_check_filetype_and_ext( $temporary_file, $original_filename );
		$allowed_mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'png'          => 'image/png',
			'gif'          => 'image/gif',
			'webp'         => 'image/webp',
		);
		$allowed_types = array_values( $allowed_mimes );
		if ( empty( $check['type'] ) || ! in_array( $check['type'], $allowed_types, true ) ) {
			@unlink( $temporary_file );
			return false;
		}

		// Ensure the filename extension matches the detected type.
		$ext           = $check['ext'];
		$safe_basename = pathinfo( $original_filename, PATHINFO_FILENAME );
		$safe_filename = $safe_basename . '.' . $ext;

		// Build the sideload array for media_handle_sideload.
		$file_array = array(
			'name'     => $safe_filename,
			'tmp_name' => $temporary_file,
			'type'     => $check['type'],
			'size'     => filesize( $temporary_file ),
			'error'    => 0,
		);

		// Include required files for media handling if not already loaded.
		if ( ! function_exists( 'media_handle_sideload' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/media.php';
			require_once ABSPATH . 'wp-admin/includes/image.php';
		}

		// Sideload the file and let WordPress create the attachment.
		$attachment_id = media_handle_sideload( $file_array, 0 );

		if ( is_wp_error( $attachment_id ) ) {
			@unlink( $temporary_file );
			return false;
		}

		// Store content hash and source URL for future deduplication.
		if ( $sha256_hash ) {
			update_post_meta( $attachment_id, '_dr_file_hash', $sha256_hash );
		}
		update_post_meta( $attachment_id, '_dr_source_url', esc_url_raw( $image_url ) );

		return $attachment_id;
	}

	/**
	 * Insert taxonomies.
	 *
	 * @param int   $new_recipe_id New recipe ID.
	 * @param array $recipe Recipe.
	 * @param array $taxonomy_fields Taxonomy fields.
	 * @since 1.7.8
	 */
	public function insert_taxonomies( $new_recipe_id, $recipe, $taxonomy_fields ) {
		$recipe_id       = $new_recipe_id;
		$taxonomy_fields = $taxonomy_fields;

		foreach ( $taxonomy_fields as $field ) {
			$from = $recipe[ $field['from'] ];
			$to   = $field['to'];

			$from = explode( ',', $from );

			// If $to is recipe_keywords then leave it and continue.
			if ( 'recipe_keywords' === $to ) {
				continue;
			}

			// Check if term already exists.
			foreach ( $from as $term ) {
				$term_exists = term_exists( $term, $to );
				if ( ! $term_exists ) {
					$term_data = array(
						'name'        => $term,
						'slug'        => $term,
						'description' => '',
						'parent'      => 0,
						'filter'      => 'raw',
						'taxonomy'    => $to,
						'term_group'  => 0,
					);
					$term      = wp_insert_term( $term_data['name'], $to, $term_data );
					if ( is_wp_error( $term ) ) {
						return array(
							'status'  => false,
							'message' => __( 'Error importing terms.', 'delicious-recipes' ),
						);
					}
				}
				wp_set_object_terms( $recipe_id, $term, $to, true );
			}
		}
	}

	/**
	 * Delete CSV
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 *
	 * @since 1.7.8
	 */
	public function delete_csv( $request ) {
		$request_params = $request->get_params();
		$file_id        = $request_params['CSV_id'];

		// Get the file path from the file id.
		$file_path = get_attached_file( $file_id );

		// Check if the file exists.
		if ( ! file_exists( $file_path ) ) {
			return array(
				'status'  => false,
				'message' => __( 'File not found.', 'delicious-recipes' ),
			);
		}

		// Delete the file.
		if ( ! wp_delete_file( $file_path ) ) {
			return array(
				'status'  => false,
				'message' => __( 'Error deleting file.', 'delicious-recipes' ),
			);
		}

		// Delete the attachment post.
		wp_delete_attachment( $file_id, true );

		return array(
			'status'  => true,
			'message' => __( 'File deleted successfully.', 'delicious-recipes' ),
		);
	}

	/**
	 * Import from Tasty Recipes Plugin.
	 *
	 * @param int   $import_recipe_id Import Recipe ID.
	 * @param array $imported_fields Imported Fields.
	 */
	public function import_tasty_recipes_recipe( $import_recipe_id, $imported_fields ) {

		$recipe_data = get_post( $import_recipe_id );
		if ( ! $recipe_data ) {
			return array(
				'status'  => false,
				'message' => __( 'Recipe not found.', 'delicious-recipes' ),
			);
		}

		// Get the post content after filtering tasty recipe block out.
		$post_content = $recipe_data->post_content;
		if ( $post_content ) {
			$blocks           = parse_blocks( $post_content );
			$filtered_blocks  = array_filter(
				$blocks,
				function ( $block ) {
					return $block['blockName'] !== 'wp-tasty/tasty-recipe';
				}
			);
			$filtered_content = '';
			foreach ( $filtered_blocks as $block ) {
				$filtered_content .= render_block( $block );
			}
		}

		$blocks = parse_blocks( $recipe_data->post_content );
		foreach ( $blocks as $block ) {

			if ( $block['blockName'] !== 'wp-tasty/tasty-recipe' ) {
				continue;
			}

			$attributes = $block['attrs'];
			$post_id    = $attributes['id'];
			$post_meta  = get_post_custom( $post_id );

			// Handle No of servings.
			$yield_data     = isset( $post_meta['yield'][0] ) ? $post_meta['yield'][0] : '';
			$yield_data     = explode( ' ', $yield_data );
			$no_of_servings = '';
			foreach ( $yield_data as $key => $value ) {
				if ( is_numeric( $value ) ) {
					$no_of_servings = $value;
				}
			}

			// Handle Ingredients.
			$ingredients_meta  = isset( $post_meta['ingredients'][0] ) && '' !== $post_meta['ingredients'][0] ? $post_meta['ingredients'][0] : '';
			$recipeIngredients = array(
				array(
					'sectionTitle' => '',
					'ingredients'  => array(),
				),
			);
			if ( ! empty( $ingredients_meta ) ) {
				$ingredient_lines = preg_split( "/(\r\n|\r|\n|<br\s*\/?>)/", $ingredients_meta );
				foreach ( $ingredient_lines as $ingredient ) {
					$ingredient = trim( $ingredient );
					$ingredient = strip_tags( $ingredient );
					$ingredient = str_replace( "\u{00A0}", ' ', $ingredient );

					if ( empty( $ingredient ) ) {
						continue;
					}

					$notes = '';
					if ( strpos( $ingredient, '(' ) !== false ) {
						// Extract notes from inside parentheses.
						preg_match( '/\((.*?)\)/', $ingredient, $matches );
						$ingredient = trim( preg_replace( '/\(.*?\)/', '', $ingredient ) );
						$notes      = $matches[1];
						$notes      = str_replace( '|', ', ', $notes );
					} else {
						$notes = '';
					}
					// Remove extra space created by removing notes.
					$ingredient = str_replace( '  ', ' ', $ingredient );
					$ingredient = explode( ' ', $ingredient );

					// Check if there are numbers in the ingredient array. If there are then join them with a space.
					$numeric_found      = false;
					$last_numeric_index = -1;

					// First find the first and last numeric values.
					foreach ( $ingredient as $index => $item ) {
						// Remove any extra spaces.
						$item = trim( $item );

						// Check for various numeric formats.
						// - Pure numbers (1, 12, etc).
						// - Fractions (1/2, 3/4, etc).
						// - Ranges with or without spaces (1-2, 1 - 2).
						// - Mixed numbers (1 1/2).
						if ( is_numeric( $item ) ||
						preg_match( '/^\d+\/\d+$/', $item ) ||
						preg_match( '/^\d+\s*\-\s*\d+$/', $item ) ||
						preg_match( '/^\d+\s+\d+\/\d+$/', $item ) ) {
							if ( ! $numeric_found ) {
								$numeric_found       = true;
								$first_numeric_index = $index;
							}
							$last_numeric_index = $index;
						}
					}

					// If we found numeric values.
					$qty = '';
					if ( $numeric_found ) {
						if ( $first_numeric_index === $last_numeric_index ) {
							// Just one numeric value.
							$qty = $ingredient[ $first_numeric_index ];
						} else {
							// Multiple numeric values - join everything between first and last.
							$qty = implode( ' ', array_slice( $ingredient, $first_numeric_index, $last_numeric_index - $first_numeric_index + 1 ) );
						}
					}
					$qty  = trim( $qty );
					$unit = $ingredient[ $last_numeric_index + 1 ];
					// Get all non-qty and non-unit content as ingredient.
					$ingredient_parts = array();
					foreach ( $ingredient as $index => $item ) {
						// Skip qty indexes.
						if ( $index >= $first_numeric_index && $index <= $last_numeric_index ) {
							continue;
						}
						// Skip unit index.
						if ( $index === $last_numeric_index + 1 ) {
							continue;
						}
						$ingredient_parts[] = $item;
					}

					$ingredient                            = implode( ' ', $ingredient_parts );
					$recipeIngredients[0]['ingredients'][] = array(
						'quantity'   => $qty ? str_replace( '⁄', '/', $qty ) : '',
						'unit'       => $unit ?? '',
						'ingredient' => $ingredient ?? '',
						'notes'      => $notes ?? '',
						'chosen'     => '',
						'selected'   => '',
					);

				}
			}

			// Handle Instructions.
			$instructions_meta = isset( $post_meta['instructions'][0] ) ? $post_meta['instructions'][0] : '';
			if ( ! empty( $instructions_meta ) ) {
				$instruction_lines       = preg_split( "/(\r\n|\r|\n|<br\s*\/?>)/", $instructions_meta );
				$instructions_with_media = array();
				foreach ( $instruction_lines as $key => $line ) {
					$line             = trim( $line );
					$instruction_data = array(
						'text'          => '',
						'image'         => '',
						'image_preview' => '',
						'videoURL'      => '',
					);

					if ( preg_match( '/https.*(youtube|vimeo)/', $line, $url_match ) ) {
						$instruction_data['videoURL'] = strip_tags( $line );
					} else {
						$instruction_data['text'] = strip_tags( $line );
					}

					if ( ! empty( $instruction_data['text'] ) || ! empty( $instruction_data['image_preview'] ) || ! empty( $instruction_data['videoURL'] ) ) {
						$instructions_with_media[] = $instruction_data;
					}
				}

				// Prepare final mapped array for recipe instructions.
				$recipe_instructions = array();
				foreach ( $instructions_with_media as $instruction ) {
					$instruct[] = array(
						'instructionTitle' => '',
						'instruction'      => ! empty( $instruction['text'] ) ? wp_kses_post( $instruction['text'] ) : '',
						'instructionNotes' => '',
						'image'            => $instruction['image'],
						'image_preview'    => $instruction['image_preview'],
						'videoURL'         => $instruction['videoURL'],
						'chosen'           => '',
						'selected'         => '',
					);
				}
				$recipe_instructions[] = array(
					'sectionTitle' => '',
					'instruction'  => $instruct,
				);
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
			$new_recipe_meta['recipeDescription'] = isset( $post_meta['description'] ) ? sanitize_text_field( $post_meta['description'][0] ) : '';
			$new_recipe_meta['recipeKeywords']    = isset( $post_meta['keywords'] ) ? implode( ',', $post_meta['keywords'] ) : '';
			$new_recipe_meta['difficultyLevel']   = '';
			$new_recipe_meta['prepTime']          = isset( $post_meta['prep_time'][0] ) ? sanitize_text_field( $post_meta['prep_time'][0] ) : '';
			$new_recipe_meta['prepTimeUnit']      = 'min';
			$prep_time_data                       = $this->handle_time_unit( isset( $post_meta['prep_time'][0] ) ? $post_meta['prep_time'][0] : '' );
			$new_recipe_meta['prepTime']          = $prep_time_data['time'];
			$new_recipe_meta['prepTimeUnit']      = $prep_time_data['unit'];
			$cook_time_data                       = $this->handle_time_unit( isset( $post_meta['cook_time'][0] ) ? $post_meta['cook_time'][0] : '' );
			$new_recipe_meta['cookTime']          = $cook_time_data['time'];
			$new_recipe_meta['cookTimeUnit']      = $cook_time_data['unit'];
			$new_recipe_meta['cokingTemp']        = '';
			$new_recipe_meta['cokingTempUnit']    = 'C';
			$custom_label                         = isset( $post_meta['additional_time_label'][0] ) ? sanitize_text_field( $post_meta['additional_time_label'][0] ) : '';
			if ( false != strpos( $custom_label, 'rest' ) ) {
				$rest_time_data                  = $this->handle_time_unit( isset( $post_meta['additional_time'][0] ) ? $post_meta['additional_time'][0] : '' );
				$new_recipe_meta['restTime']     = $rest_time_data['time'];
				$new_recipe_meta['restTimeUnit'] = $rest_time_data['unit'];
			} else {
				$new_recipe_meta['restTime']     = '';
				$new_recipe_meta['restTimeUnit'] = 'min';
			}
			$new_recipe_meta['recipeCalories']    = isset( $post_meta['calories'][0] ) ? sanitize_text_field( $post_meta['calories'][0] ) : '';
			$new_recipe_meta['bestSeason']        = '';
			$recipe_cost                          = '';
			$new_recipe_meta['estimatedCost']     = '';
			$new_recipe_meta['estimatedCostCurr'] = preg_replace( '/\d+/', '', $recipe_cost );
			$new_recipe_meta['noOfServings']      = $no_of_servings;

			// Ingredients.
			$new_recipe_meta['ingredientTitle']   = '';
			$new_recipe_meta['recipeIngredients'] = $recipeIngredients ?? array();

			// Instructions.
			$new_recipe_meta['instructionTitle']   = '';
			$new_recipe_meta['recipeInstructions'] = $recipe_instructions ?? array();

			// Gallery Data.
			$new_recipe_meta['enableImageGallery']   = array();
			$new_recipe_meta['imageGalleryImages']   = array();
			$new_recipe_meta['enableVideoGallery'][] = isset( $post_meta['video_url'][0] ) ? 'yes' : '';
			$video_url                               = isset( $post_meta['video_url'][0] ) ? sanitize_text_field( $post_meta['video_url'][0] ) : '';
			$video_type                              = '';
			if ( '' !== $video_url ) {
				if ( false !== strpos( $video_url, 'youtube' ) ) {
					preg_match( '/[\\?\\&]v=([^\\?\\&]+)/', $video_url, $matches );
					$video_type      = 'youtube';
					$video_id        = $matches[0];
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
			$new_recipe_meta['servings']          = isset( $post_meta['serving_size'][0] ) ? absint( $post_meta['serving_size'][0] ) : '';
			$new_recipe_meta['calories']          = isset( $post_meta['calories'][0] ) ? sanitize_text_field( $this->extract_numeric_value( $post_meta['calories'][0] ) ) : '';
			$new_recipe_meta['caloriesFromFat']   = '';
			$new_recipe_meta['totalFat']          = isset( $post_meta['fat'][0] ) ? sanitize_text_field( $this->extract_numeric_value( $post_meta['fat'][0] ) ) : '';
			$new_recipe_meta['saturatedFat']      = isset( $post_meta['saturated_fat'][0] ) ? sanitize_text_field( $this->extract_numeric_value( $post_meta['saturated_fat'][0] ) ) : '';
			$new_recipe_meta['transFat']          = isset( $post_meta['trans_fat'][0] ) ? sanitize_text_field( $this->extract_numeric_value( $post_meta['trans_fat'][0] ) ) : '';
			$new_recipe_meta['cholesterol']       = isset( $post_meta['cholesterol'][0] ) ? sanitize_text_field( $this->extract_numeric_value( $post_meta['cholesterol'][0] ) ) : '';
			$new_recipe_meta['sodium']            = isset( $post_meta['sodium'][0] ) ? sanitize_text_field( $this->extract_numeric_value( $post_meta['sodium'][0] ) ) : '';
			$new_recipe_meta['potassium']         = '';
			$new_recipe_meta['totalCarbohydrate'] = isset( $post_meta['carbohydrates'][0] ) ? sanitize_text_field( $this->extract_numeric_value( $post_meta['carbohydrates'][0] ) ) : '';
			$new_recipe_meta['dietaryFiber']      = isset( $post_meta['fiber'][0] ) ? sanitize_text_field( $this->extract_numeric_value( $post_meta['fiber'][0] ) ) : '';
			$new_recipe_meta['sugars']            = isset( $post_meta['sugar'][0] ) ? sanitize_text_field( $this->extract_numeric_value( $post_meta['sugar'][0] ) ) : '';
			$new_recipe_meta['protein']           = isset( $post_meta['protein'][0] ) ? sanitize_text_field( $this->extract_numeric_value( $post_meta['protein'][0] ) ) : '';
			$new_recipe_meta['vitaminA']          = '';
			$new_recipe_meta['vitaminC']          = '';
			$new_recipe_meta['calcium']           = '';
			$new_recipe_meta['iron']              = '';
			$new_recipe_meta['vitaminD']          = '';
			$new_recipe_meta['vitaminE']          = '';
			$new_recipe_meta['vitaminK']          = '';
			$new_recipe_meta['thiamin']           = '';
			$new_recipe_meta['riboflavin']        = '';
			$new_recipe_meta['niacin']            = '';
			$new_recipe_meta['vitaminB6']         = '';
			$new_recipe_meta['folate']            = '';
			$new_recipe_meta['vitaminB12']        = '';
			$new_recipe_meta['biotin']            = '';
			$new_recipe_meta['pantothenicAcid']   = '';
			$new_recipe_meta['phosphorus']        = '';
			$new_recipe_meta['iodine']            = '';
			$new_recipe_meta['magnesium']         = '';
			$new_recipe_meta['zinc']              = '';
			$new_recipe_meta['selenium']          = '';
			$new_recipe_meta['copper']            = '';
			$new_recipe_meta['manganese']         = '';
			$new_recipe_meta['chromium']          = '';
			$new_recipe_meta['molybdenum']        = '';
			$new_recipe_meta['chloride']          = '';

			// Recipe Notes.
			$new_recipe_meta['recipeNotes'] = isset( $post_meta['notes'][0] ) ? wp_kses_post( $post_meta['notes'][0] ) : '';

			// FAQs.
			$new_recipe_meta['faqTitle']   = '';
			$new_recipe_meta['recipeFAQs'] = array();

			if ( delicious_recipes_is_pro_activated() ) {

				// Equipment fields.
				$new_recipe_meta['equipmentsTitle']      = '';
				$new_recipe_meta['recipeEquipmentIds']   = array();
				$new_recipe_meta['recipeUnitConversion'] = array();

				// Recipe CTA.
				$new_recipe_meta['recipeCTAImage']        = array(
					array(
						'imageId'   => '',
						'imageAlt'  => '',
						'imageLink' => '',
					),
				);
				$new_recipe_meta['recipeCTALink']         = '';
				$new_recipe_meta['recipeCTAOpenInNewTab'] = array();
				$new_recipe_meta['recipeCTAAttributes']   = array();
				$new_recipe_meta['overrideGlobalCTA']     = array();

				// Extended Content.
				$new_recipe_meta['extendedContent'] = array();
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
			$_dr_recipe_ingredients = array();
			foreach ( $recipeIngredients as $key => $ingredient ) {
				$_dr_recipe_ingredients[] = $ingredient['ingredient']['ingredient'];
			}
			update_post_meta( $new_recipe_id, '_dr_recipe_ingredients', $_dr_recipe_ingredients );
			update_post_meta( $new_recipe_id, '_dr_ingredient_count', count( $_dr_recipe_ingredients ) );

			// Comments and Ratings.
			$comments = get_comments(
				array(
					'post_id' => $import_recipe_id,
				)
			);
			if ( ! empty( $comments ) ) {
				foreach ( $comments as $comment ) {
					$old_comment_rating = get_comment_meta( $comment->comment_ID, 'ERRating', true );
					$updated_comment    = array(
						'comment_ID'      => $comment->comment_ID,
						'comment_post_ID' => $new_recipe_id,
					);
					if ( ! empty( $old_comment_rating ) ) {
						update_comment_meta( $comment->comment_ID, 'rating', $old_comment_rating );
					}
					wp_update_comment( $updated_comment );
				}
			}

			foreach ( $imported_fields[0] as $imported_field ) {
				$postmeta = $post_meta[ $imported_field['taxonomy_from'] ];
				if ( $imported_field['taxonomy_to'] !== 'recipe_keywords' && ! empty( $postmeta[0] ) ) {
					$terms = explode( ',', $postmeta[0] );
					if ( ! empty( $terms ) ) {
						foreach ( $terms as $term ) {
							$term     = strtolower( trim( $term ) );
							$term     = ucfirst( $term );
							$term     = get_term_by( 'name', $term, $imported_field['taxonomy_to'] );
							$terms_id = $term->term_id;
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
	 * Handle time and its unit.
	 *
	 * @param string $time_postmeta Time string (e.g., "2 hours", "30 minutes").
	 * @return array Processed time and unit (e.g., ['time' => 2, 'unit' => 'hour']).
	 */
	private function handle_time_unit( $time_postmeta ) {
		$time_postmeta = explode( ' ', $time_postmeta );
		$time          = 0; // Default to 0.
		$time_unit     = 'min'; // Default unit is minutes.

		foreach ( $time_postmeta as $key => $value ) {
			if ( is_numeric( $value ) ) {
				$time = (int) $value;
			} elseif ( strtolower( $value ) === 'hour' || strtolower( $value ) === 'hours' ) {
					$time_unit = 'hour';
			} elseif ( strtolower( $value ) === 'minute' || strtolower( $value ) === 'minutes' ) {
				$time_unit = 'min';
			} elseif ( strtolower( $value ) === 'day' || strtolower( $value ) === 'days' ) {
				$time     *= 24; // Convert days to hours.
				$time_unit = 'hour';
			}
		}

		return array(
			'time' => $time,
			'unit' => $time_unit,
		);
	}

	/**
	 * Extracts the first whole number from a given string.
	 *
	 * @param string $input The input string to process.
	 * @return string The extracted whole number or an empty string if no numbers are found.
	 */
	private function extract_numeric_value( $input ) {
		// Match whole numbers only (integers).
		preg_match( '/\d+/', $input, $matches );
		return isset( $matches[0] ) ? $matches[0] : '';
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
