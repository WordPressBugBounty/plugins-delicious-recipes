<?php
/**
 * Recipe FAQs template
 *
 * @package Delicious_Recipes
 */

global $recipe;

$recipe_faqs = isset( $recipe->faqs ) ? $recipe->faqs : array();
$faq_title   = isset( $recipe->faqs_title ) ? $recipe->faqs_title : __( 'Frequently Asked Questions', 'delicious-recipes' );

if ( ! empty( $recipe_faqs ) ) :
	?>
	<div class="dr-faqs-section">
		<div class="dr-section-title-wrap">
			<h2 class="dr-title"><?php echo esc_html( $faq_title ); ?></h2>
			<div class="dr-faq-toggle-area">
				<span class="toggle-title"><?php echo esc_html__( 'Expand All', 'delicious-recipes' ); ?>:</span>
				<button data-target="#dr-faqs-list-<?php echo esc_attr( $recipe->ID ); ?>" class="dr-switch-btn" data-switch="off" data-switch-on="<?php echo esc_attr__( 'ON', 'delicious-recipes' ); ?>" data-switch-off="<?php echo esc_attr__( 'OFF', 'delicious-recipes' ); ?>"><?php echo esc_html__( 'OFF', 'delicious-recipes' ); ?></button>
			</div>
		</div>

		<div id="dr-faqs-list-<?php echo esc_attr( $recipe->ID ); ?>" class="dr-faqs-list">
			<?php
			foreach ( $recipe_faqs as $key => $faq ) :
				$question = isset( $faq['question'] ) ? $faq['question'] : '';
				$answer   = isset( $faq['answer'] ) ? apply_filters( 'wp_delicious_single_faq', $faq['answer'] ) : '';
				if ( ! empty( $question ) && ! empty( $answer ) ) {
					?>
					<div class="dr-faq-item">
						<div class="dr-faq-title-wrap">
							<h3 class="dr-title">
								<?php echo esc_html( $question ); ?>
							</h3>
						</div>
						<div class="dr-faq-content-wrap">
							<p><?php echo do_shortcode( $answer ); ?></p>
						</div>
					</div>
					<?php
				}
			endforeach;
			?>
		</div>
	</div>
	<?php
endif;
