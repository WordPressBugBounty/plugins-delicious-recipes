<?php
/**
 * Nutrition Block
 *
 * @since   1.2.0
 * @package Delicious_Recipes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Delicious_Dynamic_Nutrition Class.
 */
class Delicious_Dynamic_Nutrition {
	/**
	 * Class instance Helpers.
	 *
	 * @var Delicious_Recipes_Helpers
	 * @since 1.0.3
	 */
	public static $helpers;

	/**
	 * Block attributes.
	 *
	 * @since 1.1.0
	 *
	 * @var array
	 */
	public static $attributes;

	/**
	 * Block data.
	 *
	 * @since 2.3.2
	 *
	 * @var array
	 */
	public static $data;

	/**
	 * Nutrition facts labels
	 *
	 * @since 2.3.2
	 *
	 * @var array
	 */
	public static $labels;

	/**
	 * The Constructor.
	 */
	public function __construct() {
		self::$helpers = new Delicious_Recipes_Helpers();
		self::set_labels();
	}

	/**
	 * Registers the nutrition block as a server-side rendered block.
	 *
	 * @return void
	 */
	public function register_hooks() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		if ( delicious_recipes_block_is_registered( 'delicious-recipes/block-nutrition' ) ) {
			return;
		}

		$attributes = array(
			'id'   => array(
				'type'    => 'string',
				'default' => 'dr-block-nutrition',
			),
			'data' => array(
				'type' => 'object',
			),
		);

		// Hook server side rendering into render callback.
		register_block_type(
			'delicious-recipes/block-nutrition',
			array(
				'attributes'      => $attributes,
				'render_callback' => array( $this, 'render' ),
			)
		);
	}

	/**
	 * Renders the block.
	 *
	 * @param array  $attributes The attributes of the block.
	 * @param string $content    The HTML content of the block.
	 *
	 * @return string The block preceded by its JSON-LD script.
	 */
	public function render( $attributes, $content ) {
		if ( ! is_array( $attributes ) ) {
			return $content;
		}

		if ( ! isset( $attributes['data'] ) ) {
			return $content;
		}

		// Import variables into the current symbol table from an array.
		extract( $attributes );

		// Store variables.
		self::$data       = $data;
		self::$attributes = $attributes;

		$class = 'dr-nutrition-facts';

		$recipe_global         = delicious_recipes_get_global_settings();
		$nutri_title           = isset( $recipe_global['nutritionFactsLabel'] ) ? $recipe_global['nutritionFactsLabel'] : __( 'Nutrition Facts', 'delicious-recipes' );
		$display_standard_mode = isset( $recipe_global['displayStandardMode']['0'] ) && 'yes' === $recipe_global['displayStandardMode']['0'] ? true : false;
		$style                 = $display_standard_mode ? 'style=background:#000000;' : '';

		$fetched_nutrition_facts = self::get_nutrition_facts();

		$block_content = sprintf(
			'<div id="%1$s" class="%2$s">
				<div class="dr-title-wrap" %3$s>
					<div class="dr-title dr-print-block-title">
						<h3 class="dr-title">%4$s</h3>
					</div>
				</div>
				<div class="dr-nutrition-list">
					%5$s
				</div>
			</div>',
			esc_attr( $id ),
			esc_attr( $class ),
			esc_attr( $style ),
			esc_html( $nutri_title ),
			wp_kses_post( $fetched_nutrition_facts )
		);

		return $block_content;
	}

	/**
	 * Get nutrition facts.
	 *
	 * @return string
	 */
	public static function get_nutrition_facts() {
		$nutrition_facts = self::$data;
		$_nf_fields      = delicious_recipes_get_nutrition_facts();

		$recipe_global          = delicious_recipes_get_global_settings();
		$daily_value_disclaimer = isset( $recipe_global['dailyValueDisclaimer'] ) && '' !== $recipe_global['dailyValueDisclaimer'] ? $recipe_global['dailyValueDisclaimer'] : __( 'Percent Daily Values are based on a 2,000 calorie diet. Your daily value may be higher or lower depending on your calorie needs.', 'delicious-recipes' );
		$enable_nutrition_facts = isset( $recipe_global['showNutritionFacts']['0'] ) && 'yes' === $recipe_global['showNutritionFacts']['0'] ? true : false;

		$display_nutrition_zero_values = isset( $recipe_global['displayNutritionZeroValues']['0'] ) && 'yes' === $recipe_global['displayNutritionZeroValues']['0'] ? true : false;

		$nutri_filtered = array_filter(
			$nutrition_facts,
			function ( $nut ) {
				return ! empty( $nut ) && false !== $nut;
			}
		);

		if ( empty( $nutri_filtered ) ) {
			return;
		}

		if ( ! $enable_nutrition_facts ) {
			return;
		}

		$display_standard_mode = isset( $recipe_global['displayStandardMode']['0'] ) && 'yes' === $recipe_global['displayStandardMode']['0'] ? true : false;
		$style                 = $display_standard_mode ? 'style=background:#000000;' : '';
		$style_hr              = $display_standard_mode ? 'style=border-color:#000000;' : '';

		ob_start();
		if ( $nutrition_facts ) :
			$top_facts = $_nf_fields['top'];
			if ( ! empty( $top_facts ) ) :

				// Start output buffer for top facts.
				ob_start();

				foreach ( $top_facts as $slug => $nf ) :
					$nutri_zero_condition = $display_nutrition_zero_values ? ( isset( $nutrition_facts[ $slug ] ) && 0 === $nutrition_facts[ $slug ] ) : false;
					if ( isset( $nutrition_facts[ $slug ] ) && ( $nutrition_facts[ $slug ] || $nutri_zero_condition ) ) :
						echo '<p>' . esc_html( $nf['name'] ) . ' <strong class="dr-nut-label" data-labeltype="' . esc_attr( $slug ) . '">' . esc_attr( $nutrition_facts[ $slug ] ) . '</strong></p>';
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
					$nutri_zero_condition = $display_nutrition_zero_values ? ( isset( $nutrition_facts[ $slug ] ) && 0 === $nutrition_facts[ $slug ] ) : false;
					if ( ( isset( $nutrition_facts[ $slug ] ) && $nutrition_facts[ $slug ] ) || $nutri_zero_condition ) :
						if ( 'calories_fat' !== $slug ) :
							echo '<dt class="dr-nut-no-border text-large">';
							echo '<strong>' . esc_html( $nf['name'] ) . '</strong> <span class="dr-nut-right" style="display:block;"><strong>' . esc_html( $nutrition_facts[ $slug ] ) . '</strong>' . ( isset( $nf['measurement'] ) ? '<strong>' . esc_html( $nf['measurement'] ) . '</strong></span>' : '' );

							if ( isset( $nutrition_facts['calories_fat'] ) && $nutrition_facts['calories_fat'] ) :
								echo '<span class="dr-calories-fat dr-right">' . esc_attr( $mid_facts['calories_fat']['name'] ) . ' ' . esc_attr( $nutrition_facts['calories_fat'] ) . '</span>';
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
					$nutri_zero_condition = $display_nutrition_zero_values ? ( isset( $nutrition_facts[ $slug ] ) && 0 === $nutrition_facts[ $slug ] ) : false;
					if ( ( isset( $nutrition_facts[ $slug ] ) && $nutrition_facts[ $slug ] ) || $nutri_zero_condition ) :

						echo '<dt>';
						echo '<strong>' . esc_html( $nf['name'] ) . '</strong> <strong class="dr-nut-label">' . esc_attr( $nutrition_facts[ $slug ] ) . '</strong>' . ( isset( $nf['measurement'] ) ? '<strong class="dr-nut-label dr-nut-measurement">' . esc_attr( $nf['measurement'] ) . '</strong>' : '' );
						echo ( isset( $nf['pdv'] ) && $nutrition_facts[ $slug ] ? '<strong class="dr-nut-right"><span class="dr-nut-percent">' . ceil( ( esc_attr( $nutrition_facts[ $slug ] ) / $nf['pdv'] ) * 100 ) . '</span>%</strong>' : '' );

						if ( isset( $nf['subs'] ) ) :
							foreach ( $nf['subs'] as $sub_slug => $sub_nf ) :
								$nutri_zero_condition = $display_nutrition_zero_values ? ( isset( $nutrition_facts[ $sub_slug ] ) && 0 === $nutrition_facts[ $sub_slug ] ) : false;
								if ( isset( $nutrition_facts[ $sub_slug ] ) && ( $nutrition_facts[ $sub_slug ] || $nutri_zero_condition ) ) :
									echo '<dl><dt>';
									echo '<strong>' . esc_html( $sub_nf['name'] ) . '</strong> <strong class="dr-nut-label">' . $nutrition_facts[ $sub_slug ] . '</strong>' . ( isset( $sub_nf['measurement'] ) ? '<strong class="dr-nut-label dr-nut-measurement">' . $sub_nf['measurement'] . '</strong>' : '' );
									echo ( isset( $sub_nf['pdv'] ) && $nutrition_facts[ $sub_slug ] ? '<strong class="dr-nut-right"><span class="dr-nut-percent">' . ceil( ( esc_attr( $nutrition_facts[ $sub_slug ] ) / $sub_nf['pdv'] ) * 100 ) . '</span>%</strong>' : '' );
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
					$nutri_zero_condition = $display_nutrition_zero_values ? ( isset( $nutrition_facts[ $slug ] ) && 0 === $nutrition_facts[ $slug ] ) : false;
					if ( ( isset( $nutrition_facts[ $slug ] ) && $nutrition_facts[ $slug ] ) || $nutri_zero_condition ) :
						echo '<dt>';
							echo '<strong>' . esc_html( $nf['name'] ) . ' <span class="dr-nut-percent dr-nut-label">' . esc_attr( $nutrition_facts[ $slug ] ) . '</span> ' . esc_html( $nf['measurement'] ) . '</strong>';
						echo '</dt>';
					endif;
				endforeach;

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

					echo '<dt><strong class="dr-nut-heading">' . esc_html__( 'Amount Per Serving', 'delicious-recipes' ) . '</strong></dt>';

				if ( isset( $mid_facts_content ) && $mid_facts_content ) :
					echo '<section class="dr-clearfix">';
					echo wp_kses_post( $mid_facts_content );
					echo '</section>';
				endif;

				if ( isset( $main_facts_content ) && $main_facts_content ) :
					echo '<dt class="dr-nut-spacer" ' . esc_attr( $style ) . '></dt>';
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

		endif;
		$content = ob_get_clean();
		return $content;
	}

	/**
	 * Get nutrition labels.
	 *
	 * @return array
	 */
	public static function get_labels() {
		$labels = array(
			array(
				'id'    => 'servings',
				'label' => 'Servings',
			),
			array(
				'id'    => 'servingSize',
				'label' => 'Serving Size',
			),
			array(
				'id'    => 'calories',
				'label' => 'Calories',
			),
			array(
				'id'    => 'caloriesFromFat',
				'label' => 'Calories from Fat',
			),
			array(
				'id'    => 'totalFat',
				'label' => 'Total Fat',
				'pdv'   => 65,
			),
			array(
				'id'    => 'saturatedFat',
				'label' => 'Saturated Fat',
				'pdv'   => 20,
			),
			array(
				'id'    => 'transFat',
				'label' => 'Trans Fat',
			),
			array(
				'id'    => 'cholesterol',
				'label' => 'Cholesterol',
				'pdv'   => 300,
			),
			array(
				'id'    => 'sodium',
				'label' => 'Sodium',
				'pdv'   => 2400,
			),
			array(
				'id'    => 'potassium',
				'label' => 'Potassium',
				'pdv'   => 3500,
			),
			array(
				'id'    => 'totalCarbohydrate',
				'label' => 'Total Carbohydrate',
				'pdv'   => 300,
			),
			array(
				'id'    => 'dietaryFiber',
				'label' => 'Dietary Fiber',
				'pdv'   => 25,
			),
			array(
				'id'    => 'sugars',
				'label' => 'Sugars',
			),
			array(
				'id'    => 'protein',
				'label' => 'Protein',
				'pdv'   => 50,
			),
			array(
				'id'    => 'vitaminA',
				'label' => 'Vitamin A',
			),
			array(
				'id'    => 'vitaminC',
				'label' => 'Vitamin C',
			),
			array(
				'id'    => 'calcium',
				'label' => 'Calcium',
			),
			array(
				'id'    => 'iron',
				'label' => 'Iron',
			),
			array(
				'id'    => 'vitaminD',
				'label' => 'Vitamin D',
			),
			array(
				'id'    => 'vitaminE',
				'label' => 'Vitamin E',
			),
			array(
				'id'    => 'vitaminK',
				'label' => 'Vitamin K',
			),
			array(
				'id'    => 'thiamin',
				'label' => 'Thiamin',
			),
			array(
				'id'    => 'riboflavin',
				'label' => 'Riboflavin',
			),
			array(
				'id'    => 'niacin',
				'label' => 'Niacin',
			),
			array(
				'id'    => 'vitaminB6',
				'label' => 'Vitamin B6',
			),
			array(
				'id'    => 'vitaminB12',
				'label' => 'Vitamin B12',
			),
			array(
				'id'    => 'folate',
				'label' => 'Folate',
			),
			array(
				'id'    => 'biotin',
				'label' => 'Biotin',
			),
			array(
				'id'    => 'pantothenicAcid',
				'label' => 'Pantothenic Acid',
			),
			array(
				'id'    => 'phosphorus',
				'label' => 'Phosphorus',
			),
			array(
				'id'    => 'iodine',
				'label' => 'Iodine',
			),
			array(
				'id'    => 'magnesium',
				'label' => 'Magnesium',
			),
			array(
				'id'    => 'zinc',
				'label' => 'Zinc',
			),
			array(
				'id'    => 'selenium',
				'label' => 'Selenium',
			),
			array(
				'id'    => 'copper',
				'label' => 'Copper',
			),
			array(
				'id'    => 'manganese',
				'label' => 'Manganese',
			),
			array(
				'id'    => 'chromium',
				'label' => 'Chromium',
			),
			array(
				'id'    => 'molybdenum',
				'label' => 'Molybdenum',
			),
			array(
				'id'    => 'chloride',
				'label' => 'Chloride',
			),
		);

		return $labels;
	}

	/**
	 * Set labels.
	 *
	 * @return void
	 */
	public static function set_labels() {
		self::$labels = self::get_labels();
	}

	/**
	 * Get label title.
	 *
	 * @param string $label The label ID.
	 *
	 * @return string
	 */
	public static function get_label_title( $label ) {
		$key = array_search( $label, array_column( self::$labels, 'id' ), true );

		return self::$labels[ $key ]['label'];
	}

	/**
	 * Get label pdv.
	 *
	 * @param string $label The label ID.
	 *
	 * @return string
	 */
	public static function get_label_pdv( $label ) {
		$key = array_search( $label, array_column( self::$labels, 'id' ), true );

		return self::$labels[ $key ]['pdv'];
	}
}
