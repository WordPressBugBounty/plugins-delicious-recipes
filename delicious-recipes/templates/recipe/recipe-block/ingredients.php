<?php
/**
 * Recipe main ingredients section.
 *
 * @package Delicious_Recipes
 */

global $recipe;
$global_settings         = delicious_recipes_get_global_settings();
$show_adjustable_serving = ! empty( $global_settings['showAdjustableServing'][0] ) && 'yes' === $global_settings['showAdjustableServing'][0];
$ingredient_title        = isset( $recipe->ingredient_title ) ? $recipe->ingredient_title : __( "Ingredients", 'delicious-recipes'  );
$ingredient_links        = get_option( 'delicious_recipes_auto_link_ingredients', array() );

$cookmode              = false;
$unit_conversion       = false;
$default_unit_system   = 'usCustomary';
$ingredient_images     = array();
$show_ingredient_image = false;
$ingredient_found      = false;
$ingredient_image_url  = '';

$enable_ingredients_checkbox = isset( $global_settings['enableIngredientsCheckbox'] ) && ! empty( $global_settings['enableIngredientsCheckbox'] ) && 'yes' === $global_settings['enableIngredientsCheckbox'][0];
$ingredients_column          = isset( $global_settings['ingredientsColumn'] ) && ! empty( $global_settings['ingredientsColumn'] ) ? $global_settings['ingredientsColumn'] : '1';
$affiliate = '';

$license_validity_bool = false;
if ( function_exists( 'DEL_RECIPE_PRO' ) ){
	$license_validity_bool = delicious_recipe_pro_check_license_status();
}

if ( $license_validity_bool ) {
	$enable_affiliate_links_indicator = isset( $global_settings['enableAffiliateLinkIndicator'] ) && ! empty( $global_settings['enableAffiliateLinkIndicator'] ) && 'yes' === $global_settings['enableAffiliateLinkIndicator'][0];
	if ( $enable_affiliate_links_indicator ) {
		$affiliate = '*';
	}
	$cookmode = isset( $global_settings['enableCookMode'] ) ? $global_settings['enableCookMode'] : false;
	$cookmode && require_once plugin_dir_path( DELICIOUS_RECIPES_PRO_PLUGIN_FILE ) . 'templates/recipe/cook-mode.php';
	$ingredient_images     = get_option( 'ingredients_image_option', array() );
	$show_ingredient_image = isset( $global_settings['showIngredientsImage'] ) && is_array( $global_settings['showIngredientsImage'] ) && ! empty( $global_settings['showIngredientsImage'][0] ) && 'yes' === $global_settings['showIngredientsImage'][0];
	$unit_conversion       = isset( $global_settings['displayUnitConversion'] ) && ! empty( $global_settings['displayUnitConversion'] ) && ! empty( $global_settings['displayUnitConversion'][0] ) && 'yes' === $global_settings['displayUnitConversion'][0];
	$default_unit_system   = isset( $global_settings['defaultUnitSystem'] ) && ! empty( $global_settings['defaultUnitSystem'] ) ? $global_settings['defaultUnitSystem'] : 'usCustomary';
}



$recipe_post_meta = get_post_meta( $recipe->ID, 'delicious_recipes_metadata', true );

if ( isset( $recipe->ingredients ) && ! empty( $recipe->ingredients ) ) :
	$servings_value = ! empty( $recipe->no_of_servings ) ? esc_attr( $recipe->no_of_servings ) : 1;

	?>
	<div class="dr-ingredients-list">
		<div class="dr-ingrd-title-wrap wpd-gap-1">
			<h3 class="dr-title"><?php echo esc_html( $ingredient_title ); ?></h3>

			<?php
			if ( $license_validity_bool && $unit_conversion && isset( $recipe_post_meta['recipeUnitConversion'] ) && ! empty( $recipe_post_meta['recipeUnitConversion'] ) && is_array( $recipe_post_meta['recipeUnitConversion'] ) ) {
				?>
				<div class="dr-unit-conversion-wrapper">
					<label for="usCustomary">
						<input id="usCustomary" type="radio" name="unit-conversion" value="usCustomary" <?php echo esc_attr( 'usCustomary' === $default_unit_system ? 'checked' : '' ); ?>>
						<span><?php echo esc_html__( "US Customary", 'delicious-recipes' ); ?></span>
					</label>
					<label for="metric">
						<input id="metric" type="radio" name="unit-conversion" value="metric" <?php echo esc_attr( 'metric' === $default_unit_system ? 'checked' : '' ); ?>>
						<span><?php echo esc_html__( "Metric", 'delicious-recipes' ); ?></span>
					</label>
				</div>
				<?php
			}
			?>

			<?php ( $cookmode && $license_validity_bool ) && cookmode(); ?>

			<?php if ( $show_adjustable_serving ) { ?>
				<div class="dr-ingredients-scale" data-serving-value="<?php echo esc_attr( $servings_value ); ?>">
					<?php if ( ! empty( $global_settings['adjustableServingType'] ) && 'increment' === $global_settings['adjustableServingType'] ) { ?>
						<label for="select"><?php esc_html_e( "Servings", 'delicious-recipes' ); ?></label>
						<input type="number" data-original="<?php echo esc_attr( $servings_value ); ?>" data-recipe="<?php echo esc_attr( $recipe->ID ); ?>" value="<?php echo esc_attr( $servings_value ); ?>" step="1" min="1" class="dr-scale-ingredients">
					<?php } else { ?>
						<label for="select"><?php esc_html_e( "Scale", 'delicious-recipes' ); ?></label>
						<div class="scale-btn-wrapper">

							<button class="" data-scale="0.5" data-recipe="<?php echo esc_attr( $recipe->ID ); ?>" type="button">1/2x</button>
							<?php
							for ( $i = 1; $i < 4; $i++ ) {
								?>
								<button class="<?php echo 1 === $i ? 'active' : ''; ?>" data-scale="<?php echo esc_attr( $i ); ?>" data-recipe="<?php echo esc_attr( $recipe->ID ); ?>" type="button"><?php echo esc_html( "{$i}x" ); ?></button>
								<?php
							}
							?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>

		<div class="recipe-ingredients">
			<?php
			$ingredient_string_format = isset( $global_settings['ingredientStringFormat'] ) ? $global_settings['ingredientStringFormat'] : '{qty} {unit} {ingredient} {notes}';
			foreach ( $recipe->ingredients as $key => $ingre_section ) :
				$section_title = isset( $ingre_section['sectionTitle'] ) ? $ingre_section['sectionTitle'] : '';
				$ingre         = isset( $ingre_section['ingredients'] ) ? $ingre_section['ingredients'] : array();
				?>
				<?php if ( $section_title) { ?> <h4 class="dr-title"><?php echo esc_html( $section_title ); ?></h4><?php } ?>
				<?php if ( ! $ingre ) {
					continue;
				}
				?>
				<ul
					class="dr-unordered-list<?php echo '2' === $ingredients_column ? ' double' : ''; ?>"
					<?php echo ( ! $show_ingredient_image && ! $enable_ingredients_checkbox ) ? 'style="padding: 0 0 0 18px !important;"' : ''; ?>
				>
					<?php
					foreach ( $ingre as $ingre_key => $ingredient ) :
						if ( $license_validity_bool && $show_ingredient_image ) {
							foreach ( $ingredient_images as $ingredient_image ) {
								foreach ( $ingredient_image['keywords'] as $keyword ) {
									if ( strtolower( $ingredient['ingredient'] ) === strtolower( $keyword ) ) {
										$ingredient_found     = true;
										$ingredient_image_url = $ingredient_image['image']['imageLink'];
									}
								}
							}
						}

						$rand_key        = wp_rand( 10, 10000 );
						$ingredient_qty  = isset( $ingredient['quantity'] ) ? $ingredient['quantity'] : 0;
						$ingredient_qty  = is_numeric( $ingredient_qty ) ? round( $ingredient_qty, 2 ) : $ingredient_qty;
						$ingredient_unit = isset( $ingredient['unit'] ) ? $ingredient['unit'] : '';
						$unit_text       = ! empty( $ingredient_unit ) ? $ingredient_unit : '';

						if ( $license_validity_bool && ! empty( $ingredient_links ) ) {
							foreach ( $ingredient_links as $key => $ingredient_link ) {
								if ( is_array( $ingredient_link ) && isset( $ingredient_link['ingredientsKeywords'] ) && is_array( $ingredient_link['ingredientsKeywords'] ) ) {
									$ingredient_keywords = $ingredient_link['ingredientsKeywords'];
									foreach ( $ingredient_keywords as $keyword ) {
										if ( strtolower( $ingredient['ingredient'] ) === strtolower( $keyword ) ) {
											$open_in_new_tab = isset( $ingredient_link['openInNewTab'] ) && ! empty( $ingredient_link['openInNewTab'] ) ? 'target="_blank"' : '';
											$rel_attribute   = '';
											if ( isset( $ingredient_link['relAttribute'] ) && is_array( $ingredient_link['relAttribute'] ) ) {
												$rel_attribute = implode( ' ', $ingredient_link['relAttribute'] );
											}
											$total_clicks             = isset( $ingredient_link['totalClicks'] ) ? $ingredient_link['totalClicks'] : 0;
											$ingredient['ingredient'] = '<a class="ingredient-link" data-ingredient-link-id="' . $key . '" data-clicks="' . $total_clicks . '" href="' . esc_url( $ingredient_link['ingredientLink'] ) . '" ' . $open_in_new_tab . ' rel="' . esc_attr( $rel_attribute ) . '">' . $ingredient['ingredient']  . esc_html( $affiliate ) . '</a>';
										}
									}
								}
							}
						}

						$ingredient_keys = array(
							'{qty}'        => isset( $ingredient['quantity'] ) ? '<span class="ingredient_quantity" data-original="' . $ingredient_qty . '" data-recipe="' . $recipe->ID . '">' . delicious_recipes_decorate_fraction( $ingredient_qty ) . '</span>' : '',
							'{unit}'       => '<span class="ingredient_unit">' . $unit_text . '</span>',
							'{ingredient}' => $ingredient['ingredient'],
							'{notes}'      => isset( $ingredient['notes'] ) && ! empty( $ingredient['notes'] ) ? '<span class="ingredient-notes" >(' . $ingredient['notes'] . ')</span>' : '',
						);
						$ingre_string    = str_replace( array_keys( $ingredient_keys ), $ingredient_keys, $ingredient_string_format );
						?>
						<?php if ( $show_ingredient_image && $license_validity_bool && $ingredient_found ) { ?>
							<li class="recipe-ingredient<?php echo $show_ingredient_image && $ingredient_found ? ' dr-ingredients-image-list-item' : ''; ?>">
								<div class="wpdelicious-gallery-item small">
									<img class="wpdelicious-gallery-image" src="<?php echo esc_url( $ingredient_image_url ); ?>" alt="<?php echo esc_attr( $ingredient['ingredient'] ); ?>">
								</div>
								<label for="dr-ing-<?php echo esc_attr( $ingre_key ); ?>-<?php echo esc_attr( $rand_key ); ?>"><?php echo wp_kses_post( $ingre_string ); ?></label>
								<?php $ingredient_found = false; ?>
							</li>
						<?php } elseif ( $show_ingredient_image && $license_validity_bool && ! $ingredient_found ) { ?>
							<li class="recipe-ingredient<?php echo $show_ingredient_image && ! $ingredient_found ? ' dr-ingredients-image-list-item' : ''; ?>">
								<div class="wpdelicious-gallery-item small">
									<img src="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/images/ingredient-placeholder.png' ); ?>" alt="placeholder-ingredient" class="wpdelicious-gallery-image">
								</div>
								<label for="dr-ing-<?php echo esc_attr( $ingre_key ); ?>-<?php echo esc_attr( $rand_key ); ?>"><?php echo wp_kses_post( $ingre_string ); ?></label>
							</li>
						<?php } elseif ( $enable_ingredients_checkbox ) { ?>
							<li class="recipe-ingredient">
								<input type="checkbox" name="" value="" id="dr-ing-<?php echo esc_attr( $ingre_key ); ?>-<?php echo esc_attr( $rand_key ); ?>">
								<label for="dr-ing-<?php echo esc_attr( $ingre_key ); ?>-<?php echo esc_attr( $rand_key ); ?>"><?php echo wp_kses_post( $ingre_string ); ?></label>
							</li>
						<?php } else { ?>
							<li class="recipe-ingredient" style="list-style: disc; padding: 0px !important;">
								<label for="dr-ing-<?php echo esc_attr( $ingre_key ); ?>-<?php echo esc_attr( $rand_key ); ?>"><?php echo wp_kses_post( $ingre_string ); ?></label>
							</li>
						<?php } ?>
					<?php endforeach; ?>
				</ul>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

<?php
if ( $license_validity_bool && ! empty( $ingredient_links ) ) {
	?>
	<script>
		document.addEventListener(
			'DOMContentLoaded',
			function() {
				var ingredients = document.querySelectorAll( '.ingredient-link' );
				ingredients.forEach( function( ingredient ) {
					ingredient.addEventListener(
						'click',
						function() {
							var clicks = parseInt( this.getAttribute( 'data-clicks' ) ) || 0;
							this.setAttribute( 'data-clicks', clicks + 1 );
						}
					);
				} );
			}
		);
	</script>
	<?php
}
