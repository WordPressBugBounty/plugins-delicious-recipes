<?php
/**
 * Filter by Season.
 *
 * @package Delicious_Recipes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$seasons            = array(
	'fall'                         => __( 'Fall', 'delicious-recipes' ),
	'winter'                       => __( 'Winter', 'delicious-recipes' ),
	'summer'                       => __( 'Summer', 'delicious-recipes' ),
	'spring'                       => __( 'Spring', 'delicious-recipes' ),
	'suitable throughout the year' => __( 'Suitable throughout the year', 'delicious-recipes' ),
);
$additional_seasons = get_option( 'best_season_option', array() );

// Exclude season if no recipe is assigned to it or assigned recipe is not published.
foreach ( $additional_seasons as $key => $value ) {
	$args    = array(
		'post_type'        => DELICIOUS_RECIPE_POST_TYPE,
		'posts_per_page'   => -1,
		'suppress_filters' => false,
		'post_status'      => 'publish',
		'fields'           => 'ids',
		'meta_query'       => array(
			array(
				'key'     => '_dr_best_season',
				'value'   => $value,
				'compare' => 'LIKE',
			),
		),
	);
	$results = get_posts( $args );
	$count   = count( $results );
	if ( $count === 0 ) {
		unset( $additional_seasons[ $key ] );
	}
}

if ( ! empty( $additional_seasons ) ) {
	$seasons = array_merge( $seasons, $additional_seasons );
}

$show_count = apply_filters( 'delicious_recipes_search_filters_show_count', true );

$args = array(
	'post_type'        => DELICIOUS_RECIPE_POST_TYPE,
	'posts_per_page'   => -1,
	'suppress_filters' => false,
	'post_status'      => 'publish',
	'fields'           => 'ids',
);
?>
<select class="js-select2" multiple="multiple"  name='seasons'>
	<?php foreach ( $seasons as $key => $value ) : ?>
		<option data-title="<?php echo esc_attr( $value ); ?>" value="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( sanitize_title( $value ) ); ?>" name='seasons'>
			<?php
			echo esc_html( $value );
			if ( $show_count ) :
				$args['meta_query'] = array(
					array(
						'key'     => '_dr_best_season',
						'value'   => $key,
						'compare' => 'LIKE',
					),
				);
				$results            = get_posts( $args );
				$count              = count( $results );
				?>
					(<?php echo esc_html( $count ); ?>)
				<?php
				endif;
			?>
		</option>
	<?php endforeach; ?>
</select>
<?php
