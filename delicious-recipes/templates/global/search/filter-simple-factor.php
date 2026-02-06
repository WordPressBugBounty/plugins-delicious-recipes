<?php
/**
 * Filter by Simple Factor.
 *
 * @package Delicious_Recipes
 */

$simple_factor = array(
	'10-ingredients-or-less' => __( '10 ingredients or less', 'delicious-recipes' ),
	'15-minutes-or-less'     => __( '15 minutes or less', 'delicious-recipes' ),
	'30-minutes-or-less'     => __( '30 minutes or less', 'delicious-recipes' ),
	'7-ingredients-or-less'  => __( '7 ingredients or less', 'delicious-recipes' ),
);
$show_count    = apply_filters( 'delicious_recipes_search_filters_show_count', true );

$args = array(
	'post_type'        => DELICIOUS_RECIPE_POST_TYPE,
	'posts_per_page'   => -1,
	'suppress_filters' => false,
	'post_status'      => 'publish',
	'fields'           => 'ids',
);
?>
<select class="js-select2" multiple="multiple"  name='simple_factor'>
	<?php foreach ( $simple_factor as $key => $value ) : ?>
		<option data-title="<?php echo esc_attr( $value ); ?>" value="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( sanitize_title( $value ) ); ?>" name='simple_factor'>
			<?php
			echo esc_html( $value );
			if ( $show_count ) :
				switch ( $key ) {
					case '10-ingredients-or-less':
						$args['meta_query'] = array(
							array(
								'key'     => '_dr_ingredient_count',
								'value'   => 10,
								'compare' => '<=',
								'type'    => 'NUMERIC', // Ensures comparison as a number.
							),
						);
						break;
					case '15-minutes-or-less':
						$args['meta_query'] = array(
							array(
								'key'     => '_dr_recipe_total_time',
								'value'   => 15,
								'compare' => '<=',
								'type'    => 'NUMERIC', // Ensures comparison as a number.
							),
						);
						break;
					case '30-minutes-or-less':
						$args['meta_query'] = array(
							array(
								'key'     => '_dr_recipe_total_time',
								'value'   => 30,
								'compare' => '<=',
								'type'    => 'NUMERIC', // Ensures comparison as a number.
							),
						);
						break;
					case '7-ingredients-or-less':
						$args['meta_query'] = array(
							array(
								'key'     => '_dr_ingredient_count',
								'value'   => 7,
								'compare' => '<=',
								'type'    => 'NUMERIC', // Ensures comparison as a number.
							),
						);
						break;
				}
				$results = get_posts( $args );
				$count   = count( $results );

				// Fallback: if time-based counts are zero, compute on the fly from recipe metadata to handle missing _dr_recipe_total_time.
				if ( $count === 0 && in_array( $key, array( '15-minutes-or-less', '30-minutes-or-less' ), true ) ) {
					$threshold = ( '15-minutes-or-less' === $key ) ? 15 : 30;
					// Fetch all published recipe IDs (ids only) and compute totals if meta missing.
					$fallback_ids   = get_posts(
						array(
							'post_type'      => DELICIOUS_RECIPE_POST_TYPE,
							'posts_per_page' => -1,
							'fields'         => 'ids',
							'post_status'    => 'publish',
						)
					);
					$fallback_count = 0;
					foreach ( $fallback_ids as $rid ) {
						$total_time = get_post_meta( $rid, '_dr_recipe_total_time', true );
						if ( '' === $total_time || null === $total_time ) {
							$meta       = get_post_meta( $rid, 'delicious_recipes_metadata', true );
							$prep_time  = isset( $meta['prepTime'] ) ? (int) $meta['prepTime'] : 0;
							$cook_time  = isset( $meta['cookTime'] ) ? (int) $meta['cookTime'] : 0;
							$rest_time  = isset( $meta['restTime'] ) ? (int) $meta['restTime'] : 0;
							$total_time = $prep_time + $cook_time + $rest_time;
						} else {
							$total_time = (int) $total_time;
						}
						if ( $total_time <= $threshold ) {
							++$fallback_count;
						}
					}
					$count = $fallback_count;
				}
				?>
					<span class='count'>(<?php echo esc_html( $count ); ?>)</span>
				<?php
				endif;
			?>
		</option>
	<?php endforeach; ?>
</select>
<?php
