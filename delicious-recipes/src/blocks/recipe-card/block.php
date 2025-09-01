<?php
/**
 * Recipe Card Block
 *
 * @package Delicious_Recipes
 */

/**
 * Rendering the block in the frontend.
 */
function delicious_recipes_recipe_card_block() {
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
		register_block_type(
			'delicious-recipes/recipe-card',
			array(
				'attributes'      => array(
					'title'   => array(
						'type'    => 'string',
						'default' => __( 'Recipe Card', 'delicious-recipes' ),
					),
					'heading' => array(
						'type'    => 'string',
						'default' => 'h2',
					),
					'Recipe'  => array(
						'type' => 'number',
					),
					'layout'  => array(
						'type'    => 'string',
						'default' => 'default',
					),
				),
				'render_callback' => 'delicious_recipes_recipe_card_block_render',
			)
		);
}
add_action( 'init', 'delicious_recipes_recipe_card_block' );

/**
 * Call back function for frontend rendering
 */
if ( ! function_exists( 'delicious_recipes_recipe_card_block_render' ) ) {
	/**
	 * Render the block in the frontend.
	 *
	 * @param array $attributes The block attributes.
	 * @return string The block HTML.
	 */
	function delicious_recipes_recipe_card_block_render( $attributes ) {

		// phpcs:disable
		extract( $attributes );

		$latest_recipe = get_posts( 'post_type=recipe&numberposts=1' );
		$post_id       = $latest_recipe[0]->ID;

		if ( isset( $attributes['Recipe'] ) && '' != $attributes['Recipe'] ) {
			$post_id = $attributes['Recipe'];
		}

		$layout = isset( $attributes['layout'] ) && $attributes['layout'] ? $attributes['layout'] : '';

		if ( ! isset( $className ) ) {
			$className = '';
		}

		ob_start();

		json_ld( $attributes );

		echo '<div class="dr-recipes-card-block ' . esc_attr( $className ) . '">';
		// phpcs:enable
		if ( $title ) {
			// Sanitize heading to prevent XSS - only allow valid HTML tags.
			$allowed_headings = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'div' );
			$safe_heading     = in_array( $heading, $allowed_headings, true ) ? $heading : 'h2';
			printf( '<%1$s class="dr-entry-title">%2$s</%1$s>', esc_html( $safe_heading ), esc_html( $title ) );
		}

		if ( absint( $post_id ) ) {

			echo do_shortcode( '[recipe_card id="' . $post_id . '" show_title=0 layout="' . $layout . '"]' );
		} else {
			?>
				<p class="recipe-none"><?php esc_html_e( 'Recipe Card not found.', 'delicious-recipes' ); ?></p>
			<?php
		}

		echo '</div>';

		return ob_get_clean();
	}
}

/**
 * Ajax from Backend Trip Type Terms for the block.
 */
function delicious_recipes_recipe_card_ajax() {
	$recipe_select = new Wp_Query(
		array(
			'post_type'      => DELICIOUS_RECIPE_POST_TYPE,
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		)
	);

	if ( $recipe_select->have_posts() ) {
		while ( $recipe_select->have_posts() ) {

			$recipe_select->the_post();

			$recipe_options[] = array(
				'value' => get_the_ID(),
				'label' => get_the_title(),
			);
		}
		wp_reset_postdata();
	}

	wp_send_json( array( 'RecipeOptions' => $recipe_options ) );
	exit;
}
add_action( 'wp_ajax_delicious_recipes_recipe_card_ajax', 'delicious_recipes_recipe_card_ajax' );

/**
 * Ajax from Backend for the block.
 */
function delicious_recipes_recipe_card_block_ajax() {

	$post__in = filter_input( INPUT_GET, 'posts_in' );

	$args = array(
		'offset'           => 0,
		'post_type'        => DELICIOUS_RECIPE_POST_TYPE,
		'post_status'      => 'publish',
		'suppress_filters' => true,
	);

	if ( $post__in && ! empty( $post__in ) ) {
		$args['p'] = absint( $post__in );
	} else {
		$args['posts_per_page'] = 1;
	}

	$recipes_query = new WP_Query( $args );

	$recipes = array();
	// Get global toggles.
	$global_toggles = delicious_recipes_get_global_toggles_and_labels();
	$img_size       = $global_toggles['enable_recipe_image_crop'] ? 'large' : 'full';

	if ( $recipes_query->have_posts() ) {

		while ( $recipes_query->have_posts() ) {
			$recipes_query->the_post();

			$recipe          = get_post( get_the_ID() );
			$recipe_metas    = delicious_recipes_get_recipe( $recipe );
			$global_settings = delicious_recipes_get_global_settings();

			$thumbnail_id = has_post_thumbnail( $recipe_metas->ID ) ? get_post_thumbnail_id( $recipe_metas->ID ) : '';
			$thumbnail    = $thumbnail_id ? get_the_post_thumbnail( $recipe_metas->ID, $img_size ) : '';
			$fallback_svg = delicious_recipes_get_fallback_svg( 'large', true );

			$recipe_keys     = array();
			$recipe_courses  = array();
			$cooking_methods = array();
			$cuisine         = array();
			$ingredients     = array();
			$instructions    = array();
			$recipe_badges   = array();

			if ( ! empty( $recipe_metas->recipe_cuisine ) ) {
				foreach ( $recipe_metas->recipe_cuisine as $recipe_cus ) {
					$key       = get_term_by( 'name', $recipe_cus, 'recipe-cuisine' );
					$link      = get_term_link( $key, 'recipe-cuisine' );
					$icon      = delicious_recipes_get_tax_icon( $key, true );
					$cuisine[] = array(
						'key'  => $recipe_cus,
						'link' => $link,
						'icon' => $icon,
					);
				}
			}

			if ( ! empty( $recipe_metas->recipe_keys ) ) {
				foreach ( $recipe_metas->recipe_keys as $recipe_key ) {
					$key           = get_term_by( 'name', $recipe_key, 'recipe-key' );
					$link          = get_term_link( $key, 'recipe-key' );
					$icon          = delicious_recipes_get_tax_icon( $key, true );
					$recipe_keys[] = array(
						'key'  => $recipe_key,
						'link' => $link,
						'icon' => $icon,
					);
				}
			}

			if ( ! empty( $recipe_metas->recipe_course ) ) {
				foreach ( $recipe_metas->recipe_course as $course ) {
					$ky               = get_term_by( 'name', $course, 'recipe-course' );
					$link             = get_term_link( $ky, 'recipe-course' );
					$icon             = delicious_recipes_get_tax_icon( $ky, true );
					$recipe_courses[] = array(
						'key'  => $course,
						'link' => $link,
						'icon' => $icon,
					);
				}
			}

			if ( ! empty( $recipe_metas->cooking_method ) ) {
				foreach ( $recipe_metas->cooking_method as $method ) {
					$ky                = get_term_by( 'name', $method, 'recipe-cooking-method' );
					$link              = get_term_link( $ky, 'recipe-cooking-method' );
					$icon              = delicious_recipes_get_tax_icon( $ky, true );
					$cooking_methods[] = array(
						'key'  => $method,
						'link' => $link,
						'icon' => $icon,
					);
				}
			}

			if ( ! empty( $recipe_metas->badges ) ) {
				$badge       = get_term_by( 'name', $recipe_metas->badges[0], 'recipe-badge' );
				$link        = get_term_link( $badge, 'recipe-badge' );
				$badge_metas = get_term_meta( $badge->term_id, 'dr_taxonomy_metas', true );
				$tax_color   = isset( $badge_metas['taxonomy_color'] ) && ! empty( $badge_metas['taxonomy_color'] ) ? $badge_metas['taxonomy_color'] : '#E84E3B';

				$recipe_badges = array(
					'badge' => $recipe_metas->badges[0],
					'link'  => $link,
					'color' => $tax_color,
				);
			}

			if ( ! empty( $recipe_metas->ingredients ) ) {
				$ingredient_string_format = isset( $global_settings['ingredientStringFormat'] ) ? $global_settings['ingredientStringFormat'] : '{qty} {unit} {ingredient} {notes}';
				foreach ( $recipe_metas->ingredients as $key => $ingre_section ) :
					$ingre = isset( $ingre_section['ingredients'] ) ? $ingre_section['ingredients'] : array();
					if ( $ingre_section['sectionTitle'] ) {
						$ingredients[] = array(
							'ingre_string' => $ingre_section['sectionTitle'],
						);
					}
					foreach ( $ingre as $ingre_key => $ingredient ) :

						$ingredient_qty  = isset( $ingredient['quantity'] ) ? $ingredient['quantity'] : 0;
						$ingredient_unit = isset( $ingredient['unit'] ) ? $ingredient['unit'] : '';
						$unit_text       = ! empty( $ingredient_unit ) ? delicious_recipes_get_unit_text( $ingredient_unit, $ingredient_qty ) : '';

						$ingredient_keys = array(
							'{qty}'        => isset( $ingredient['quantity'] ) ? '<span class="ingredient_quantity" data-original="' . $ingredient['quantity'] . '" data-recipe="' . $recipe->ID . '">' . $ingredient['quantity'] . '</span>' : '',
							'{unit}'       => '<span class="ingredient_unit">' . $unit_text . '</span>',
							'{ingredient}' => isset( $ingredient['ingredient'] ) ? $ingredient['ingredient'] : '',
							'{notes}'      => isset( $ingredient['notes'] ) && ! empty( $ingredient['notes'] ) ? '<span class="ingredient-notes" >(' . $ingredient['notes'] . ')</span>' : '',
						);
						$ingre_string    = str_replace( array_keys( $ingredient_keys ), $ingredient_keys, $ingredient_string_format );
						$ingredients[]   = array(
							'ingre_string' => $ingre_string,
						);
					endforeach;
				endforeach;
			}

			if ( ! empty( $recipe_metas->instructions ) ) {
				foreach ( $recipe_metas->instructions as $sec_key => $intruct_section ) :
					foreach ( $intruct_section['instruction'] as $inst_key => $instruct ) :
						$instruction_title = isset( $instruct['instructionTitle'] ) ? $instruct['instructionTitle'] : '';
						$instruction       = isset( $instruct['instruction'] ) ? $instruct['instruction'] : '';
						$instruction_notes = isset( $instruct['instructionNotes'] ) ? $instruct['instructionNotes'] : '';
						$instruction_image = isset( $instruct['image'] ) && ! empty( $instruct['image'] ) ? wp_get_attachment_image( $instruct['image'], 'full' ) : false;
						$instruction_video = isset( $instruct['videoURL'] ) && ! empty( $instruct['videoURL'] ) ? $instruct['videoURL'] : false;
						$instructions[]    = array(
							'title'       => $instruction_title,
							'instruction' => $instruction,
							'notes'       => $instruction_notes,
							'image'       => $instruction_image,
							'video'       => delicious_recipes_parse_videos( $instruction_video ),
						);
					endforeach;
				endforeach;
			}

			$recipes[] = array(
				'recipe_id'        => $recipe_metas->ID,
				'title'            => $recipe_metas->name,
				'permalink'        => $recipe_metas->permalink,
				'thumbnail_id'     => $recipe_metas->thumbnail_id,
				'thumbnail_url'    => $recipe_metas->thumbnail,
				'thumbnail'        => $thumbnail,
				'fallback_svg'     => $fallback_svg,
				'recipe_keys'      => $recipe_keys,
				'recipe_course'    => $recipe_courses,
				'cooking_methods'  => $cooking_methods,
				'cuisine'          => $cuisine,
				'date_published'   => $recipe_metas->date_published,
				'comments_number'  => $recipe_metas->comments_number,
				'rating'           => $recipe_metas->rating,
				'author'           => $recipe_metas->author,
				'author_avatar'    => get_avatar_url( $recipe_metas->author_id ),
				'description'      => $recipe_metas->recipe_description,
				'prep_time'        => $recipe_metas->prep_time,
				'prep_time_unit'   => $recipe_metas->prep_time_unit,
				'cook_time'        => $recipe_metas->cook_time,
				'cook_time_unit'   => $recipe_metas->cook_time_unit,
				'rest_time'        => $recipe_metas->rest_time,
				'rest_time_unit'   => $recipe_metas->rest_time_unit,
				'total_time'       => $recipe_metas->total_time,
				'no_of_servings'   => $recipe_metas->no_of_servings,
				'calories'         => $recipe_metas->recipe_calories,
				'difficulty_level' => $recipe_metas->difficulty_level,
				'best_season'      => $recipe_metas->best_season,
				'notes'            => $recipe_metas->notes,
				'ingredients'      => $ingredients,
				'instructions'     => $instructions,
				'recipe_badges'    => $recipe_badges,
				'video_gallery'    => $recipe_metas->video_gallery ? $recipe_metas->video_gallery : array(),
			);
		}

		wp_reset_postdata();
		wp_send_json(
			array(
				'found'   => true,
				'recipes' => $recipes,
			)
		);
	}

	wp_send_json(
		array(
			'found'   => false,
			'recipes' => array(),
		)
	);

	die();
}
add_action( 'wp_ajax_delicious_recipes_recipe_card_block_ajax', 'delicious_recipes_recipe_card_block_ajax' );

/**
 * JSON-LD for recipe-card block.
 *
 * @param array $attributes The block attributes.
 * @return void
 */
function json_ld( $attributes ) {
	$schema_values_json = wp_json_encode( schema_values( $attributes ) );
	$schema_html        = '<script type="application/ld+json">';
	$schema_html       .= $schema_values_json;
	$schema_html       .= '</script>';
	echo $schema_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Get schema values.
 *
 * @param array $attributes The block attributes.
 * @return string The JSON-LD HTML.
 */
function schema_values( $attributes ) {
	// Get the recipe ID, fallback to latest recipe if not set.
	$recipe_id = isset( $attributes['Recipe'] ) && ! empty( $attributes['Recipe'] ) ? $attributes['Recipe'] : null;

	if ( ! $recipe_id ) {
		$latest_recipe = get_posts( 'post_type=' . DELICIOUS_RECIPE_POST_TYPE . '&numberposts=1' );
		$recipe_id     = ! empty( $latest_recipe ) ? $latest_recipe[0]->ID : null;
	}

	if ( ! $recipe_id ) {
		return array(); // Return empty array if no recipe found.
	}

	$result = get_posts(
		array(
			'post_type'      => DELICIOUS_RECIPE_POST_TYPE,
			'p'              => $recipe_id, // Fetch post based on post ID.
			'posts_per_page' => 1,
		)
	);

	foreach ( $result as $key => $value ) {
		$recipe = delicious_recipes_get_recipe( $value );

		$preptime_unit = isset( $recipe->prep_time_unit ) ? $recipe->prep_time_unit : '';
		$cooktime_unit = isset( $recipe->cook_time_unit ) ? $recipe->cook_time_unit : '';
		$resttime_unit = isset( $recipe->rest_time_unit ) ? $recipe->rest_time_unit : '';

		$prep_time_mins = 'min' === $preptime_unit ? $recipe->prep_time : $recipe->prep_time * 60;
		$cook_time_mins = 'min' === $cooktime_unit ? $recipe->cook_time : $recipe->cook_time * 60;
		$rest_time_mins = 'min' === $resttime_unit ? $recipe->rest_time : $recipe->rest_time * 60;

		$total_time = $prep_time_mins + $cook_time_mins + $rest_time_mins;

		$cook_time           = delicious_recipes_time_format( $cook_time_mins, 'iso' );
		$prep_time           = delicious_recipes_time_format( $prep_time_mins, 'iso' );
		$total_time          = delicious_recipes_time_format( $total_time, 'iso' );
		$description         = ! empty( $recipe->recipe_description ) ? wp_strip_all_tags( $recipe->recipe_description, true ) : $recipe->name;
		$recipe_instructions = array();
		$recipe_ingredients  = array();
		$images              = array();

		if ( has_post_thumbnail( $recipe->ID ) ) :
			$size1  = get_the_post_thumbnail_url( $recipe->ID, 'delrecpe-structured-data-1_1' );
			$size2  = get_the_post_thumbnail_url( $recipe->ID, 'delrecpe-structured-data-4_3' );
			$size3  = get_the_post_thumbnail_url( $recipe->ID, 'delrecpe-structured-data-16_9' );
			$images = array( $size1, $size2, $size3 );
		endif;

		if ( isset( $recipe->ingredients ) && ! empty( $recipe->ingredients ) ) :
			foreach ( $recipe->ingredients as $ingredients ) :
				if ( isset( $ingredients['ingredients'] ) && ! empty( $ingredients['ingredients'] ) ) :
					foreach ( $ingredients['ingredients'] as $ing ) :
						if ( isset( $ing['ingredient'] ) && ! empty( $ing['ingredient'] ) ) :
							unset( $ing['notes'] );
							$ingredient_qty       = isset( $ing['quantity'] ) ? $ing['quantity'] : 0;
							$ing['unit']          = ! empty( $ing['unit'] ) ? delicious_recipes_get_unit_text( $ing['unit'], $ingredient_qty ) : '';
							$ingredient           = implode( ' ', $ing );
							$ingredient           = wp_strip_all_tags( preg_replace( '~(?:\[/?)[^/\]]+/?\]~s', '', $ingredient ) );
							$recipe_ingredients[] = $ingredient;
						endif;
					endforeach;
				endif;
			endforeach;
		endif;

		if ( isset( $recipe->instructions ) && ! empty( $recipe->instructions ) ) :
			foreach ( $recipe->instructions as $section ) :
				foreach ( $section['instruction'] as $dir ) :
					if ( isset( $dir['instruction'] ) && ! empty( $dir['instruction'] ) ) :
						$direction             = wp_strip_all_tags( preg_replace( '~(?:\[/?)[^/\]]+/?\]~s', '', $dir['instruction'] ) );
						$name                  = isset( $dir['instructionTitle'] ) ? wp_strip_all_tags( preg_replace( '~(?:\[/?)[^/\]]+/?\]~s', '', $dir['instructionTitle'] ) ) : '';
						$image                 = isset( $dir['image_preview'] ) && '' !== $dir['image_preview'] ? $dir['image_preview'] : '';
						$recipe_instructions[] = array(
							'@type' => 'HowToStep',
							'name'  => esc_html( $name ),
							'text'  => $direction,
							'image' => $image,
						);
					endif;
				endforeach;
			endforeach;
		endif;

		if ( 0 !== $recipe->rating ) :
			$aggregate_rating = array(
				'@type'       => 'AggregateRating',
				'ratingValue' => $recipe->rating,
				'ratingCount' => $recipe->rating_count,
			);
		else :
			$aggregate_rating = null;
		endif;

		$nutrition              = array();
		$nutrition_facts        = $recipe->nutrition;
		$nutri_filtered         = array_filter(
			$nutrition_facts,
			function ( $nut ) {
				return ! empty( $nut ) && false !== $nut;
			}
		);
		$enable_nutrition_facts = isset( $recipe_global['showNutritionFacts']['0'] ) && 'yes' === $recipe_global['showNutritionFacts']['0'] ? true : false;

		if ( $enable_nutrition_facts && ! empty( $nutri_filtered ) ) {
			$calories           = $recipe->nutrition['calories'] ? $recipe->nutrition['calories'] . ' calories' : '';
			$total_carbohydrate = $recipe->nutrition['totalCarbohydrate'] ? $recipe->nutrition['totalCarbohydrate'] . ' grams' : '';
			$cholesterol        = $recipe->nutrition['cholesterol'] ? $recipe->nutrition['cholesterol'] . ' milligrams' : '';
			$total_fat          = $recipe->nutrition['totalFat'] ? $recipe->nutrition['totalFat'] . ' grams' : '';
			$dietary_fiber      = $recipe->nutrition['dietaryFiber'] ? $recipe->nutrition['dietaryFiber'] . ' grams' : '';
			$protein            = $recipe->nutrition['protein'] ? $recipe->nutrition['protein'] . ' grams' : '';
			$saturated_fat      = $recipe->nutrition['saturatedFat'] ? $recipe->nutrition['saturatedFat'] . ' grams' : '';
			$serving_size       = $recipe->nutrition['servingSize'] ? $recipe->nutrition['servingSize'] : '';
			$sodium             = $recipe->nutrition['sodium'] ? $recipe->nutrition['sodium'] . ' milligrams' : '';
			$sugars             = $recipe->nutrition['sugars'] ? $recipe->nutrition['sugars'] . ' grams' : '';
			$trans_fat          = $recipe->nutrition['transFat'] ? $recipe->nutrition['transFat'] . ' grams' : '';

			$nutrition = array(
				'@type'               => 'NutritionInformation',
				'calories'            => $calories,
				'carbohydrateContent' => $total_carbohydrate,
				'cholesterolContent'  => $cholesterol,
				'fatContent'          => $total_fat,
				'fiberContent'        => $dietary_fiber,
				'proteinContent'      => $protein,
				'saturatedFatContent' => $saturated_fat,
				'servingSize'         => $serving_size,
				'sodiumContent'       => $sodium,
				'sugarContent'        => $sugars,
				'transFatContent'     => $trans_fat,
			);
		} elseif ( ! empty( $recipe->recipe_calories ) ) {
			$nutrition = array(
				'@type'    => 'NutritionInformation',
				'calories' => $recipe->recipe_calories,
			);
		}

		$video = array();

		if ( $recipe->enable_video_gallery && isset( $recipe->video_gallery['0'] ) ) :
			$video_obj = $recipe->video_gallery['0'];

			if ( 'youtube' === $video_obj['vidType'] ) {
				$vid_url   = 'https://www.youtube.com/watch?v=' . $video_obj['vidID'];
				$image_url = "https://i3.ytimg.com/vi/{$video_obj['vidID']}/maxresdefault.jpg";
			} elseif ( 'vimeo' === $video_obj['vidType'] ) {
				$vid_url   = 'https://vimeo.com/moogaloop.swf?clip_id=' . $video_obj['vidID'];
				$image_url = $video_obj['vidThumb'];
			}

			$video = array(
				'@type'        => 'VideoObject',
				'name'         => $recipe->name,
				'description'  => $description,
				'thumbnailUrl' => $image_url,
				'contentUrl'   => $vid_url,
				'uploadDate'   => gmdate( 'c' ),
			);
		endif;

		$schema_array = false;

		$schema_array = apply_filters(
			'wp_delicious_guided_recipe_schema_array',
			array(
				'@context'           => 'https://schema.org',
				'@type'              => 'Recipe',
				'name'               => $recipe->name,
				'url'                => $recipe->permalink,
				'image'              => $images,
				'author'             => array(
					'@type' => 'Person',
					'name'  => $recipe->author,
				),
				'datePublished'      => $recipe->date_published,
				'description'        => $description,
				'prepTime'           => $prep_time,
				'cookTime'           => $cook_time,
				'totalTime'          => $total_time,
				'recipeYield'        => $recipe->no_of_servings,
				'recipeCategory'     => $recipe->recipe_course,
				'recipeCuisine'      => $recipe->recipe_cuisine,
				'cookingMethod'      => $recipe->cooking_method,
				'keywords'           => $recipe->keywords,
				'recipeIngredient'   => $recipe_ingredients,
				'recipeInstructions' => $recipe_instructions,
				'aggregateRating'    => $aggregate_rating,
				'nutrition'          => $nutrition,
				'video'              => $video,
				'@id'                => $recipe->permalink . '#recipe',
				'isPartOf'           => array(
					'@id' => $recipe->permalink . '#webpage',
				),
				'mainEntityOfPage'   => array(
					'@type' => 'WebPage',
					'@id'   => $recipe->permalink . '#webpage',
				),
			),
			$recipe
		);
		return $schema_array;
	}
}
