<?php
/**
 * Nutrition template
 *
 * @package Delicious_Recipes
 */

global $recipe;
$nutrition_facts  = $recipe->nutrition;
$nutrition_fields = delicious_recipes_get_nutrition_facts();

$recipe_global                 = delicious_recipes_get_global_settings();
$nutri_title                   = isset( $recipe_global['nutritionFactsLabel'] ) ? $recipe_global['nutritionFactsLabel'] : '';
$show_serving_size             = isset( $recipe_global['showServingSize']['0'] ) && 'yes' === $recipe_global['showServingSize']['0'] ? true : false;
$daily_value_disclaimer        = isset( $recipe_global['dailyValueDisclaimer'] ) && '' !== $recipe_global['dailyValueDisclaimer'] ? $recipe_global['dailyValueDisclaimer'] : __( 'Percent Daily Values are based on a 2,000 calorie diet. Your daily value may be higher or lower depending on your calorie needs.', 'delicious-recipes' );
$enable_nutrition_facts        = isset( $recipe_global['showNutritionFacts']['0'] ) && 'yes' === $recipe_global['showNutritionFacts']['0'] ? true : false;
$display_nutrition_zero_values = isset( $recipe_global['displayNutritionZeroValues']['0'] ) && 'yes' === $recipe_global['displayNutritionZeroValues']['0'] ? true : false;
$additional_nutrition_elements = isset( $recipe_global['additionalNutritionElements'] ) ? $recipe_global['additionalNutritionElements'] : array();

// Get recipe meta.
$recipe_meta   = get_post_meta( $recipe->ID, 'delicious_recipes_metadata', true );
$is_powered_by = isset( $recipe_meta['isPoweredBy'] ) ? $recipe_meta['isPoweredBy'] : '';

$filtered_nutrition_facts = array_filter(
	$nutrition_facts,
	function ( $nut, $key ) {
		return ! empty( $nut ) && false !== $nut && 'servings' !== $key && 'servingSize' !== $key;
	},
	ARRAY_FILTER_USE_BOTH
);

// Early return if no nutrition facts to display.
if ( empty( $filtered_nutrition_facts ) || ! $enable_nutrition_facts || ! $nutrition_facts ) {
	return;
}

$is_edamam = false;
if ( 'edamam' === $is_powered_by ) {
	$is_edamam    = true;
	$edamam_badge = '<a href="https://www.edamam.com" title="Powered by Edamam" target="_blank" style="display: flex; justify-content: flex-end;"><img alt="Powered by Edamam" src="https://developer.edamam.com/images/white.png" /></a>';
}

$display_standard_mode = isset( $recipe_global['displayStandardMode']['0'] ) && 'yes' === $recipe_global['displayStandardMode']['0'] ? true : false;
$style                 = $display_standard_mode ? 'style=background:#000000;' : '';
$style_hr              = $display_standard_mode ? 'style=border-color:#000000;' : '';

// Collapsible Nutrition Chart.
$enable_collapsible_nutrition_chart = false;
if ( function_exists( 'DEL_RECIPE_PRO' ) ) {
	$enable_collapsible_nutrition_chart = isset( $recipe_global['enableCollapsibleNutritionChart']['0'] ) && 'yes' === $recipe_global['enableCollapsibleNutritionChart']['0'];
	$collapsible_nutrition_chart_label  = isset( $recipe_global['collapsibleNutritionChartLabel'] ) ? $recipe_global['collapsibleNutritionChartLabel'] : '';

	$calories = isset( $nutrition_facts['calories'] ) && ! empty( $nutrition_facts['calories'] ) ? $nutrition_facts['calories'] . 'kcal' : '';
	$protein  = isset( $nutrition_facts['protein'] ) ? $nutrition_facts['protein'] . 'g' : '';
	$carbs    = isset( $nutrition_facts['totalCarbohydrate'] ) ? $nutrition_facts['totalCarbohydrate'] . 'g' : '';
	$fat      = isset( $nutrition_facts['totalFat'] ) ? $nutrition_facts['totalFat'] . 'g' : '';
	$fiber    = isset( $nutrition_facts['dietaryFiber'] ) && ! empty( $nutrition_facts['dietaryFiber'] ) ? $nutrition_facts['dietaryFiber'] . 'g' : '';
	$sugar    = isset( $nutrition_facts['sugars'] ) ? $nutrition_facts['sugars'] . 'g' : '';
}

?>
<?php if ( $enable_collapsible_nutrition_chart && ! isset( $_GET['print_recipe'] ) ) : ?>
	<div class="dr-nutrition-facts-collapsible">
		<h2 class="dr-title">
			<?php echo esc_html( $nutri_title ); ?>
		</h2>
		<div class="dr-nutrition-summary">
			<?php
			$summary_items = array(
				'calories' => 'Calories',
				'protein'  => 'Protein',
				'carbs'    => 'Carbs',
				'fat'      => 'Fat',
				'fiber'    => 'Fiber',
				'sugar'    => 'Sugar',
			);

			foreach ( $summary_items as $key => $label ) {
				$value = isset( $$key ) ? $$key : '';
				if ( ! empty( $value ) ) {
					?>
					<div class="dr-nutrition-summary-item">
						<div class="dr-nutrition-summary-item-value"><?php echo esc_html( $value ); ?></div>
						<div class="dr-nutrition-summary-item-title"><?php echo esc_html( $label ); ?></div>
					</div>
					<?php
				}
			}
			?>
		</div>
		<div class="dr-nutrition-collapse-section">
			<label id="collapsible-nutrition-chart-label">
				<?php echo esc_html( $collapsible_nutrition_chart_label ); ?>
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M5 7.5L10 12.5L15 7.5" stroke="#2DB68D" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</label>
			<?php endif; ?>
			<div class="dr-nutrition-collapse-section-content">
				<div class="dr-nutrition-facts " id="nutrition-facts">
					<div class="dr-title-wrap" <?php echo esc_attr( $style ); ?>>
						<div class="dr-title dr-print-block-title">
							<h2 class="dr-title"><?php echo esc_html( $nutri_title ); ?></h2>
						</div>
					</div>
					<div class="dr-nutrition-list">
						<?php
						ob_start();
						if ( $nutrition_facts ) :
							$top_facts = $nutrition_fields['top'];
							if ( ! empty( $top_facts ) ) :
								// Start output buffer for top facts.
								ob_start();
								foreach ( $top_facts as $slug => $nf ) :
									if ( 'servingSize' === $slug && ! $show_serving_size ) {
										continue;
									}
									$has_value     = isset( $nutrition_facts[ $slug ] ) && $nutrition_facts[ $slug ];
									$is_zero_value = $display_nutrition_zero_values && isset( $nutrition_facts[ $slug ] ) && 0 === $nutrition_facts[ $slug ];

									if ( $has_value || $is_zero_value ) :
										echo '<p>' . esc_html( $nf['name'] ) . ' <strong class="dr-nut-label" data-labeltype="' . esc_attr( $slug ) . '">' . ( esc_html( $nutrition_facts[ $slug ] ) ) . '</strong></p>';
									endif;
								endforeach;

								// Get top facts content from buffer.
								$top_facts_content = ob_get_clean();
							endif;

							$mid_facts = $nutrition_fields['mid'];
							if ( ! empty( $mid_facts ) ) :
								// Start output buffer for mid-facts.
								ob_start();
								foreach ( $mid_facts as $slug => $nf ) :
									$has_value     = isset( $nutrition_facts[ $slug ] ) && $nutrition_facts[ $slug ];
									$is_zero_value = $display_nutrition_zero_values && isset( $nutrition_facts[ $slug ] ) && 0 === $nutrition_facts[ $slug ];

									if ( ( $has_value || $is_zero_value ) && 'calories_fat' !== $slug ) :
										echo '<dt class="dr-nut-no-border text-large">';
										echo '<strong>' . esc_html( $nf['name'] ) . '</strong> <span class="dr-nut-right" style="display:block;"><strong>' . esc_html( $nutrition_facts[ $slug ] ) . '</strong>' . ( isset( $nf['measurement'] ) ? '<strong>' . esc_html( $nf['measurement'] ) . '</strong></span>' : '' );

										if ( isset( $nutrition_facts['calories_fat'] ) && $nutrition_facts['calories_fat'] ) :
											echo '<span class="dr-calories-fat dr-right">' . esc_html( $mid_facts['calories_fat']['name'] ) . ' ' . esc_html( $nutrition_facts['calories_fat'] ) . '</span>';
										endif;

										echo '</dt>';
									endif;
								endforeach;

								// Get mid facts content from buffer.
								$mid_facts_content = ob_get_clean();
							endif;

							$main_facts = $nutrition_fields['main'];

							if ( ! empty( $main_facts ) ) :
								// Start output buffer for main facts.
								ob_start();

								foreach ( $main_facts as $slug => $nf ) :
									$has_value     = isset( $nutrition_facts[ $slug ] ) && $nutrition_facts[ $slug ];
									$is_zero_value = $display_nutrition_zero_values && isset( $nutrition_facts[ $slug ] ) && 0 === $nutrition_facts[ $slug ];

									if ( $has_value || $is_zero_value ) :
										echo '<dt>';
										echo '<strong>' . esc_html( $nf['name'] ) . '</strong> <strong class="dr-nut-label">' . esc_html( $nutrition_facts[ $slug ] ) . '</strong>' . ( isset( $nf['measurement'] ) ? '<strong class="dr-nut-label dr-nut-measurement">' . esc_html( $nf['measurement'] ) . '</strong>' : '' );
										echo ( isset( $nf['pdv'] ) && $nutrition_facts[ $slug ] ? '<strong class="dr-nut-right"><span class="dr-nut-percent">' . esc_attr( ceil( ( esc_attr( $nutrition_facts[ $slug ] ) / $nf['pdv'] ) * 100 ) ) . '</span>%</strong>' : '' );

										if ( isset( $nf['subs'] ) ) :
											foreach ( $nf['subs'] as $sub_slug => $sub_nf ) :
												$sub_has_value     = isset( $nutrition_facts[ $sub_slug ] ) && $nutrition_facts[ $sub_slug ];
												$sub_is_zero_value = $display_nutrition_zero_values && isset( $nutrition_facts[ $sub_slug ] ) && 0 === $nutrition_facts[ $sub_slug ];

												if ( $sub_has_value || $sub_is_zero_value ) :
													echo '<dl><dt>';
													echo '<strong>' . esc_html( $sub_nf['name'] ) . '</strong> <strong class="dr-nut-label">' . esc_html( $nutrition_facts[ $sub_slug ] ) . '</strong>' . ( isset( $sub_nf['measurement'] ) ? '<strong class="dr-nut-label dr-nut-measurement">' . esc_html( $sub_nf['measurement'] ) . '</strong>' : '' );
													echo ( isset( $sub_nf['pdv'] ) && $nutrition_facts[ $sub_slug ] ? '<strong class="dr-nut-right"><span class="dr-nut-percent">' . esc_attr( ceil( ( esc_attr( $nutrition_facts[ $sub_slug ] ) / $sub_nf['pdv'] ) * 100 ) ) . '</span>%</strong>' : '' );
													echo '</dt></dl>';
												endif;
											endforeach;
										endif;
										echo '</dt>';
									endif;
								endforeach;

								// Get main facts content from buffer.
								$main_facts_content = ob_get_clean();
							endif;

							$bottom_facts = $nutrition_fields['bottom'];

							if ( ! empty( $bottom_facts ) ) :
								// Start output buffer for bottom facts.
								ob_start();
								foreach ( $bottom_facts as $slug => $nf ) :
									$has_value     = isset( $nutrition_facts[ $slug ] ) && $nutrition_facts[ $slug ];
									$is_zero_value = $display_nutrition_zero_values && isset( $nutrition_facts[ $slug ] ) && 0 === $nutrition_facts[ $slug ];
									
									if ( $has_value || $is_zero_value ) :
										if ( 'vitaminA' === $slug || 'vitaminD' === $slug || 'vitaminE' === $slug ) :
											$vitamin_unit = isset( $recipe_meta[ $slug . 'Unit' ] ) ? $recipe_meta[ $slug . 'Unit' ] : 'IU';
											echo '<dt>';
											echo '<strong>' . esc_html( $nf['name'] ) . ' <span class="dr-nut-percent dr-nut-label">' . esc_html( $nutrition_facts[ $slug ] ) . '</span> ' . esc_html( $vitamin_unit ? $vitamin_unit : $nf['measurement'] ) . '</strong>';
											echo '</dt>';
										else :
											echo '<dt>';
											echo '<strong>' . esc_html( $nf['name'] ) . ' <span class="dr-nut-percent dr-nut-label">' . esc_html( $nutrition_facts[ $slug ] ) . '</span> ' . esc_html( $nf['measurement'] ) . '</strong>';
											echo '</dt>';
										endif;
									endif;
								endforeach;

								if ( ! empty( $nutrition_facts['additionalNutritionalElements'] ) && is_array( $additional_nutrition_elements ) && ! empty( $additional_nutrition_elements ) ) {
									$additional_elements = $nutrition_facts['additionalNutritionalElements'];
									foreach ( $additional_nutrition_elements as $element_key => $element_value ) {
										$has_value     = isset( $additional_elements[ $element_key ] ) && ! empty( trim( $additional_elements[ $element_key ] ) );
										$is_zero_value = $display_nutrition_zero_values && isset( $additional_elements[ $element_key ] ) && '' === trim( $additional_elements[ $element_key ] );
										if ( $has_value || $is_zero_value ) {
											echo '<dt>';
											echo '<strong>' . esc_html( $element_value['name'] ) . ' <span class="dr-nut-percent dr-nut-label">' . esc_html( $additional_elements[ $element_key ] ) . '</span>' . esc_html( $element_value['measurement'] ) . '</strong>';
											echo '</dt>';
										}
									}
								}

								// Get bottom facts content from buffer.
								$bottom_facts_content = ob_get_clean();
							endif;

							// Start a buffer for all nutrition facts content.
							ob_start();
							if ( isset( $top_facts_content ) && $top_facts_content ) :
								echo wp_kses_post( $top_facts_content );
							endif;

							if ( ( isset( $mid_facts_content ) && $mid_facts_content ) || ( isset( $main_facts_content ) && $main_facts_content ) ) :
								echo '<hr class="dr-nut-hr" ' . esc_attr( $style_hr ) . ' />';
								echo '<dl>';
								echo '<dt style="line-height:1.2;"><strong class="dr-nut-heading">' . esc_html__( 'Amount Per Serving', 'delicious-recipes' ) . '</strong></dt>';
								if ( isset( $mid_facts_content ) && $mid_facts_content ) :
									echo '<section class="dr-clearfix">';
									echo wp_kses_post( $mid_facts_content );
									echo '</section>';
								endif;

								if ( isset( $main_facts_content ) && $main_facts_content ) :
									echo '<dt class="dr-nut-spacer" ' . esc_html( $style ) . '></dt>';
									echo '<dt class="dr-nut-no-border"><strong class="dr-nut-heading dr-nut-right">' . esc_html__( '% Daily Value *', 'delicious-recipes' ) . '</strong></dt>';
									echo '<section class="dr-clearfix">';
									echo wp_kses_post( $main_facts_content );
									echo '</section>';
								endif;

								echo '</dl>';
								echo '<hr class="dr-nut-hr" ' . esc_attr( $style_hr ) . ' />';
							endif;

							if ( isset( $bottom_facts_content ) && $bottom_facts_content ) :
								echo '<dl class="dr-nut-bottom dr-clearfix">';
								echo wp_kses_post( $bottom_facts_content );
								echo '</dl>';
							endif;

							$nutrition_facts_content = ob_get_clean();

							if ( isset( $nutrition_facts_content ) && $nutrition_facts_content ) :
								echo '<div class="dr-nutrition-label">';
								echo wp_kses_post( $nutrition_facts_content );
								if ( ( isset( $main_facts_content ) && $main_facts_content ) || ( isset( $bottom_facts_content ) && $bottom_facts_content ) ) :
									echo '<p class="dr-daily-value-text">* ' . esc_html( $daily_value_disclaimer ) . '</p>';
								endif;
								echo '</div>';
							endif;
							if ( $is_edamam ) :
								echo wp_kses_post( $edamam_badge );
							endif;

						endif;
						$content = ob_get_clean();
						echo wp_kses_post( $content );
						?>
					</div>
				</div>
			</div>
			<?php if ( $enable_collapsible_nutrition_chart ) : ?>
		</div>
	</div>
<?php endif; ?>

<script>
	document.getElementById('collapsible-nutrition-chart-label')?.addEventListener('click', function() {
		document.querySelector('.dr-nutrition-collapse-section').classList.toggle('show');
	});
</script>