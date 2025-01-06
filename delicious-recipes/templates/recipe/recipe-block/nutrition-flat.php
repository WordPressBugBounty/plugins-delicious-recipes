<?php

/**
 * Nutrition facts flat template.
 *
 * @package Delicious_Recipes
 */

global $recipe;
$nutrition_facts = $recipe->nutrition;
$_nf_fields      = delicious_recipes_get_nutrition_facts();

$recipe_global                 = delicious_recipes_get_global_settings();
$nutri_title                   = isset( $recipe_global['nutritionFactsLabel'] ) ? $recipe_global['nutritionFactsLabel'] : '';
$show_serving_size             = isset( $recipe_global['showServingSize']['0'] ) && 'yes' === $recipe_global['showServingSize']['0'] ? true : false;
$enable_nutrition_facts        = isset( $recipe_global['showNutritionFacts']['0'] ) && 'yes' === $recipe_global['showNutritionFacts']['0'] ? true : false;
$display_nutrition_zero_values = isset( $recipe_global['displayNutritionZeroValues']['0'] ) && 'yes' === $recipe_global['displayNutritionZeroValues']['0'] ? true : false;
$additional_nutrition_elements = isset( $recipe_global['additionalNutritionElements'] ) ? $recipe_global['additionalNutritionElements'] : array();

$nutri_filtered = array_filter(
	$nutrition_facts,
	function ( $nut, $key ) {
		return ! empty( $nut ) && false !== $nut && 'servings' !== $key && 'servingSize' !== $key;
	},
	ARRAY_FILTER_USE_BOTH
);

if ( empty( $nutri_filtered ) ) {
	return;
}

if ( ! $enable_nutrition_facts ) {
	return;
}

if ( function_exists( 'DEL_RECIPE_PRO' ) ) {
	// Collapsible Nutrition Chart.
	$enable_collapsible_nutrition_chart = false;
	if ( isset( $recipe_global['enableCollapsibleNutritionChart']['0'] ) && 'yes' === $recipe_global['enableCollapsibleNutritionChart']['0'] ) {
		$enable_collapsible_nutrition_chart = true;
	} else {
		$enable_collapsible_nutrition_chart = false;
	}
	$collapsible_nutrition_chart_label = isset( $recipe_global['collapsibleNutritionChartLabel'] ) ? $recipe_global['collapsibleNutritionChartLabel'] : '';

	$calories = isset( $nutrition_facts['calories'] ) && ! empty( $nutrition_facts['calories'] ) ? $nutrition_facts['calories'] . 'kcal' : '';
	$protein  = isset( $nutrition_facts['protein'] ) ? $nutrition_facts['protein'] . 'g' : '';
	$carbs    = isset( $nutrition_facts['totalCarbohydrate'] ) ? $nutrition_facts['totalCarbohydrate'] . 'g' : '';
	$fat      = isset( $nutrition_facts['totalFat'] ) ? $nutrition_facts['totalFat'] . 'g' : '';
	$fiber    = isset( $nutrition_facts['dietaryFiber'] ) && ! empty( $nutrition_facts['dietaryFiber'] ) ? $nutrition_facts['dietaryFiber'] . 'g' : '';
	$sugar    = isset( $nutrition_facts['sugars'] ) ? $nutrition_facts['sugars'] . 'g' : '';
}
?>

<style>
	.dr-nutrition-facts.chart-layout-flat .dr-nutrition-list .dr-nutrition-fact-lists .dr-nutrition-fact-value,
	.dr-nutrition-facts.chart-layout-flat .dr-nutrition-list .dr-nutrition-fact-lists .dr-nut-measurement {
		font-weight: bold;
	}
</style>

<?php if ( $enable_collapsible_nutrition_chart && ! isset( $_GET['print_recipe'] ) ) : ?>
	<div class="dr-nutrition-facts-collapsible">
		<div class="dr-title">
			<b><?php echo esc_html( $nutri_title ); ?></b>
		</div>
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
		<!-- Two unclosed divs are at the bottom of this file and closed only if collapsible nutrition chart is enabled. -->
		<!-- </div> -->
	<!-- </div> -->
<?php endif; ?>
		<div class="dr-nutrition-collapse-section-content">
			<div class="dr-nutrition-facts chart-layout-flat">
				<div class="dr-title-wrap">
					<div class="dr-title dr-print-block-title nutrition">
						<b><?php echo esc_html( $nutri_title ); ?></b>
					</div>
				</div>

				<div class="dr-nutrition-list">
					<?php
					if ( $nutrition_facts ) {
						echo '<p class="dr-nutrition-fact-lists">';
						if ( ! empty( $_nf_fields['top'] ) ) {
							if ( isset( $nutrition_facts['servings'] ) && $nutrition_facts['servings'] ) {
								echo '<span class="dr-nut-label">' . esc_html__( 'Servings', 'delicious-recipes' ) . ':<span class="dr-nutrition-fact-value"> ' . esc_html( $nutrition_facts['servings'] ) . ' ' . esc_html__( 'Serving', 'delicious-recipes' ) . '</span></span>';
							}
							if ( $show_serving_size && isset( $nutrition_facts['servingSize'] ) && $nutrition_facts['servingSize'] ) {
								echo '<span class="dr-nut-label">' . esc_html__( 'Serving Size', 'delicious-recipes' ) . ': <span class="dr-nutrition-fact-value"> ' . esc_html( $nutrition_facts['servingSize'] ) . '</span></span>';
							}
						}

						if ( ! empty( $_nf_fields['mid'] ) ) {
							foreach ( $_nf_fields['mid'] as $slug => $nf ) {
								$value = '';
								if ( isset( $nutrition_facts[ $slug ] ) ) {
									$value = $nutrition_facts[ $slug ];
								}

								if ( $display_nutrition_zero_values ) {
									$hide = '' === $value;
								} else {
									$hide = '' === $value || 0 === $value;
								}

								if ( $hide ) {
									continue;
								}

								if ( 'calories_fat' !== $slug ) {
									echo '<span>' . esc_html( $nf['name'] ) . ':<span class="dr-nutrition-fact-value">' . esc_html( $nutrition_facts[ $slug ] ) . '</span>' . ( isset( $nf['measurement'] ) ? '<span class="dr-nut-measurement">' . esc_html( $nf['measurement'] ) . '</span></span>' : '</span>' );
									if ( isset( $nutrition_facts['calories_fat'] ) && $nutrition_facts['calories_fat'] ) {
										echo '<span>' . esc_html( $_nf_fields['mid']['calories_fat']['name'] ) . '<span class="dr-nutrition-fact-value">' . esc_html( $nutrition_facts['calories_fat'] ) . '</span></span>';
									}
								}
							}
						}

						if ( ! empty( $_nf_fields['main'] ) ) {
							foreach ( $_nf_fields['main'] as $slug => $nf ) {
								$value = '';
								if ( isset( $nutrition_facts[ $slug ] ) ) {
									$value = $nutrition_facts[ $slug ];
								}
								if ( $display_nutrition_zero_values ) {
									$hide = '' === $value;
								} else {
									$hide = '' === $value || 0 === $value;
								}
								if ( ! $hide ) {
									echo '<span>' . esc_html( $nf['name'] ) . ':<span class="dr-nutrition-fact-value">' . esc_html( $nutrition_facts[ $slug ] ) . '</span>' . ( isset( $nf['measurement'] ) ? '<span class="dr-nut-measurement">' . esc_html( $nf['measurement'] ) . '</span></span>' : '</span>' );
								}

								if ( isset( $nf['subs'] ) ) {
									foreach ( $nf['subs'] as $sub_slug => $sub_nf ) {
										$value = '';
										if ( isset( $nutrition_facts[ $sub_slug ] ) ) {
											$value = $nutrition_facts[ $sub_slug ];
										}
										if ( $display_nutrition_zero_values ) {
											$hide = '' === $value;
										} else {
											$hide = '' === $value || 0 === $value;
										}
										if ( $hide ) {
											continue;
										}
										echo '<span>' . esc_html( $sub_nf['name'] ) . ': <span class="dr-nutrition-fact-value">' . esc_html( $nutrition_facts[ $sub_slug ] ) . '</span>' . ( isset( $sub_nf['measurement'] ) ? '<span class="dr-nut-measurement">' . esc_html( $sub_nf['measurement'] ) . '</span></span>' : '</span>' );
									}
								}
							}
						}

						if ( ! empty( $_nf_fields['bottom'] ) ) {
							foreach ( $_nf_fields['bottom'] as $slug => $nf ) {
								$value = '';
								if ( isset( $nutrition_facts[ $slug ] ) ) {
									$value = $nutrition_facts[ $slug ];
								}
								if ( $display_nutrition_zero_values ) {
									$hide = '' === $value;
								} else {
									$hide = '' === $value || 0 === $value;
								}
								if ( $hide ) {
									continue;
								}
								echo '<span>' . esc_html( $nf['name'] ) . ': <span class="dr-nutrition-fact-value">' . esc_html( $nutrition_facts[ $slug ] ) . '</span>' . ( isset( $nf['measurement'] ) ? '<span class="dr-nut-measurement">' . esc_html( $nf['measurement'] ) . '</span></span>' : '</span>' );
							}
						}

						if ( ! empty( $nutrition_facts['additionalNutritionalElements'] ) && is_array( $additional_nutrition_elements ) && ! empty( $additional_nutrition_elements ) ) {
							$nutri_additional_nutritional_elements = $nutrition_facts['additionalNutritionalElements'];
							foreach ( $additional_nutrition_elements as $additional_nutrition_element_key => $additional_nutrition_element_value ) {
								if ( $display_nutrition_zero_values ) {
									if ( ! isset( $nutri_additional_nutritional_elements[ $additional_nutrition_element_key ] ) || '' === ( trim( $nutri_additional_nutritional_elements[ $additional_nutrition_element_key ] ) ) ) {
										continue;
									}
								} elseif ( ! isset( $nutri_additional_nutritional_elements[ $additional_nutrition_element_key ] ) || empty( trim( $nutri_additional_nutritional_elements[ $additional_nutrition_element_key ] ) ) ) {
										continue;
								}
								echo '<span>' . esc_html( $additional_nutrition_element_value['name'] ) . ': <span class="dr-nutrition-fact-value">' . esc_html( $nutri_additional_nutritional_elements[ $additional_nutrition_element_key ] ) . '</span>' . ( isset( $additional_nutrition_element_value['measurement'] ) ? '<span class="dr-nut-measurement">' . esc_html( $additional_nutrition_element_value['measurement'] ) . '</span></span>' : '</span>' );
							}
						}
						echo '</p>';
					}
					?>
				</div>
			</div>
		</div>
		<?php if ( $enable_collapsible_nutrition_chart ) : ?>
		<!-- Unclosed divs are closed here -->
		</div>
	</div>
<?php endif; ?>

<script>
	document.getElementById('collapsible-nutrition-chart-label')?.addEventListener('click', function() {
		document.querySelector('.dr-nutrition-collapse-section').classList.toggle('show');
	});
</script>