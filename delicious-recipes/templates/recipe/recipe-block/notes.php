<?php
/**
 * Notes template
 *
 * @package Delicious_Recipes
 */

global $recipe;

// Get global toggles.
$global_toggles = delicious_recipes_get_global_toggles_and_labels();

if ( ! empty( $recipe->notes ) && $global_toggles['enable_notes'] ) :
	?>
			<div class="dr-note">
				<h2 class="dr-title"><?php echo esc_html( $global_toggles['notes_lbl'] ); ?></h2>
			<?php
				$blocks = parse_blocks( $recipe->notes );

				$output = '';
			foreach ( $blocks as $block ) {
				$output .= do_shortcode( render_block( $block ) );
			}
				echo wp_kses_post( $output );
			?>
			</div>
		<?php
	endif;

if ( ! empty( $recipe->keywords ) && $global_toggles['enable_keywords'] ) :
	?>
			<div class="dr-keywords">
				<span class="dr-meta-title"><?php echo esc_html( $global_toggles['keywords_lbl'] ); ?>:</span>
			<?php
			// Check if the keywords is an array.
			if ( is_array( $recipe->keywords ) ) {
				echo implode( ', ', $recipe->keywords );
			} else {
				echo wp_kses_post( $recipe->keywords );
			}
			?>
			</div>
		<?php
	endif;