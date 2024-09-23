<?php
/**
 * Nutrition template
 *
 * @package Delicious_Recipes
 */

global $recipe;
$nutrition_facts = $recipe->nutrition;
$_nf_fields      = delicious_recipes_get_nutrition_facts();

$recipe_global                 = delicious_recipes_get_global_settings();
$nutri_title                   = isset( $recipe_global['nutritionFactsLabel'] ) ? $recipe_global['nutritionFactsLabel'] : '';
$show_serving_size             = isset( $recipe_global['showServingSize']['0'] ) && 'yes' === $recipe_global['showServingSize']['0'] ? true : false;
$daily_value_disclaimer        = isset( $recipe_global['dailyValueDisclaimer'] ) && '' !== $recipe_global['dailyValueDisclaimer'] ? $recipe_global['dailyValueDisclaimer'] : __( "Percent Daily Values are based on a 2,000 calorie diet. Your daily value may be higher or lower depending on your calorie needs.", 'delicious-recipes'  );
$enable_nutrition_facts        = isset( $recipe_global['showNutritionFacts']['0'] ) && 'yes' === $recipe_global['showNutritionFacts']['0'] ? true : false;
$display_nutrition_zero_values = isset( $recipe_global['displayNutritionZeroValues']['0'] ) && 'yes' === $recipe_global['displayNutritionZeroValues']['0'] ? true : false;
$additional_nutrition_elements = isset( $recipe_global['additionalNutritionElements'] ) ? $recipe_global['additionalNutritionElements'] : array();

$nutri_filtered = array_filter(
	$nutrition_facts,
	function( $nut, $key ) {
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

// check if $nutrition_facts has any value, if not return
if ( ! $nutrition_facts ) {
	return;
}

$display_standard_mode = isset( $recipe_global['displayStandardMode']['0'] ) && 'yes' === $recipe_global['displayStandardMode']['0'] ? true : false;
$style                 = $display_standard_mode ? 'style=background:#000000;' : '';
$style_hr              = $display_standard_mode ? 'style=border-color:#000000;' : '';
?>
<div class="dr-nutrition-facts">
	<div class="dr-title-wrap" <?php echo esc_attr( $style ); ?> >
		<div class="dr-title dr-print-block-title">
			<b><?php echo esc_html( $nutri_title ); ?></b>
		</div>
	</div>
	<div class="dr-nutrition-list">
		<?php
			ob_start();
		if ( $nutrition_facts ) :
			$top_facts = $_nf_fields['top'];
			if ( ! empty( $top_facts ) ) :

				// Start output buffer for top facts.
				ob_start();

				foreach ( $top_facts as $slug => $nf ) :
					if ( 'servingSize' === $slug && ! $show_serving_size ) {
						continue;
					}
					$nutri_zero_condition = $display_nutrition_zero_values ? isset( $nutrition_facts[ $slug ] ) && 0 === $nutrition_facts[ $slug ] : false;
					if ( isset( $nutrition_facts[ $slug ] ) && $nutrition_facts[ $slug ] || $nutri_zero_condition ) :
						echo '<p>' . esc_html( $nf['name'] ) . ' <strong class="dr-nut-label" data-labeltype="' . esc_attr( $slug ) . '">' . ( esc_html( $nutrition_facts[ $slug ] ) ) . '</strong></p>';
					endif;
				endforeach;

				// Get top facts content from buffer.
				$top_facts_content = ob_get_clean();

				endif;

			$mid_facts = $_nf_fields['mid'];
			if ( ! empty( $mid_facts ) ) :

				// Start output buffer for mid-facts.
				ob_start();

				foreach ( $mid_facts as $slug => $nf ) :
					$nutri_zero_condition = $display_nutrition_zero_values ? isset( $nutrition_facts[ $slug ] ) && 0 === $nutrition_facts[ $slug ] : false;
					if ( isset( $nutrition_facts[ $slug ] ) && $nutrition_facts[ $slug ] || $nutri_zero_condition ) :
						if ( 'calories_fat' !== $slug ) :
							echo '<dt>';
							echo '<strong>' . esc_html( $nf['name'] ) . '</strong> <strong class="dr-nut-label">' . esc_html( $nutrition_facts[ $slug ] ) . '</strong>' . ( isset( $nf['measurement'] ) ? '<strong class="dr-nut-label dr-nut-measurement">' . esc_html( $nf['measurement'] ) . '</strong>' : '' );

							if ( isset( $nutrition_facts['calories_fat'] ) && $nutrition_facts['calories_fat'] ) :
								echo '<span class="dr-calories-fat dr-right">' . esc_html( $mid_facts['calories_fat']['name'] ) . ' ' . esc_html( $nutrition_facts['calories_fat'] ) . '</span>';
							endif;

							echo '</dt>';
						endif;
					endif;
				endforeach;

				// Get mid facts content from buffer.
				$mid_facts_content = ob_get_clean();

				endif;

			$main_facts = $_nf_fields['main'];
			$nut_loops  = 0;

			if ( ! empty( $main_facts ) ) :

				// Start output buffer for main facts.
				ob_start();

				foreach ( $main_facts as $slug => $nf ) :
					$nutri_zero_condition = $display_nutrition_zero_values ? isset( $nutrition_facts[ $slug ] ) && 0 === $nutrition_facts[ $slug ] : false;
					if ( isset( $nutrition_facts[ $slug ] ) && $nutrition_facts[ $slug ] || $nutri_zero_condition ) :

						echo '<dt>';
						echo '<strong>' . esc_html( $nf['name'] ) . '</strong> <strong class="dr-nut-label">' . esc_html( $nutrition_facts[ $slug ] ) . '</strong>' . ( isset( $nf['measurement'] ) ? '<strong class="dr-nut-label dr-nut-measurement">' . esc_html( $nf['measurement'] ) . '</strong>' : '' );
						echo ( isset( $nf['pdv'] ) && $nutrition_facts[ $slug ] ? '<strong class="dr-nut-right"><span class="dr-nut-percent">' . esc_attr( ceil( ( esc_attr( $nutrition_facts[ $slug ] ) / $nf['pdv'] ) * 100 ) ) . '</span>%</strong>' : '' );

						if ( isset( $nf['subs'] ) ) :
							foreach ( $nf['subs'] as $sub_slug => $sub_nf ) :
								$nutri_zero_condition = $display_nutrition_zero_values ? isset( $nutrition_facts[ $sub_slug ] ) && 0 === $nutrition_facts[ $sub_slug ] : false;
								if ( isset( $nutrition_facts[ $sub_slug ] ) && $nutrition_facts[ $sub_slug ] || $nutri_zero_condition ) :
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

			$bottom_facts = $_nf_fields['bottom'];

			if ( ! empty( $bottom_facts ) ) :

				// Start output buffer for bottom facts.
				ob_start();

				foreach ( $bottom_facts as $slug => $nf ) :
					$nutri_zero_condition = $display_nutrition_zero_values ? isset( $nutrition_facts[ $slug ] ) && 0 === $nutrition_facts[ $slug ] : false;
					if ( isset( $nutrition_facts[ $slug ] ) && $nutrition_facts[ $slug ] || $nutri_zero_condition ) :
						echo '<dt>';
							echo '<strong>' . esc_html( $nf['name'] ) . ' <span class="dr-nut-percent dr-nut-label">' . esc_html( $nutrition_facts[ $slug ] ) . '</span> ' . esc_html( $nf['measurement'] ) . '</strong>';
						echo '</dt>';
					endif;
				endforeach;

				if ( ! empty( $nutrition_facts['additionalNutritionalElements'] ) && is_array( $additional_nutrition_elements ) && ! empty( $additional_nutrition_elements ) ) {
					$nutri_additional_nutritional_elements = $nutrition_facts['additionalNutritionalElements'];
					foreach ( $additional_nutrition_elements as $additional_nutrition_element_key => $additional_nutrition_element_value ) {
						if ( $display_nutrition_zero_values ) {
							if ( ! isset( $nutri_additional_nutritional_elements[ $additional_nutrition_element_key ] ) || '' === ( trim( $nutri_additional_nutritional_elements[ $additional_nutrition_element_key ] ) ) ) {
								continue;
							}
						} else {
							if ( ! isset( $nutri_additional_nutritional_elements[ $additional_nutrition_element_key ] ) || empty( trim( $nutri_additional_nutritional_elements[ $additional_nutrition_element_key ] ) ) ) {
								continue;
							}
						}
						echo '<dt>';
							echo '<strong>' . esc_html( $additional_nutrition_element_value['name'] ) . ' <span class="dr-nut-percent dr-nut-label">' . esc_html( $nutri_additional_nutritional_elements[ $additional_nutrition_element_key ] ) . '</span>' . esc_html( $additional_nutrition_element_value['measurement'] ) . '</strong>';
						echo '</dt>';
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

			if ( isset( $mid_facts_content ) && $mid_facts_content || isset( $main_facts_content ) && $main_facts_content ) :

				echo '<hr class="dr-nut-hr" ' . esc_attr( $style_hr ) . ' />';
				echo '<dl>';

					echo '<dt><strong class="dr-nut-heading">' . esc_html__( "Amount Per Serving", 'delicious-recipes' ) . '</strong></dt>';

				if ( isset( $mid_facts_content ) && $mid_facts_content ) :
					echo '<section class="dr-clearfix">';
						echo wp_kses_post( $mid_facts_content );
					echo '</section>';
					endif;

				if ( isset( $main_facts_content ) && $main_facts_content ) :
					echo '<dt class="dr-nut-spacer" ' . esc_html( $style ) . '></dt>';
					echo '<dt class="dr-nut-no-border"><strong class="dr-nut-heading dr-nut-right">' . esc_html__( "% Daily Value *", 'delicious-recipes' ) . '</strong></dt>';
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
				if ( isset( $main_facts_content ) && $main_facts_content || isset( $bottom_facts_content ) && $bottom_facts_content ) :
					echo '<p class="dr-daily-value-text">* ' . esc_html( $daily_value_disclaimer ) . '</p>';
					endif;
					echo '</div>';

				endif;

			endif;
			$content = ob_get_clean();
			echo wp_kses_post( $content );
		?>
	</div>
</div>
