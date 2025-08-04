<?php

/**
 * Terms carousal template.
 * 
 * @package Delicious_Recipes
 */
$recipe_tax_terms = isset($args['terms']) ? $args['terms'] : array();
if (!empty($recipe_tax_terms)) :
    $term_has_posts = array();
?>
    <div class="dr-block-wrapper">
        <?php foreach ($recipe_tax_terms as $key => $term) :
            $term_link = get_term_link($term);

            $term_recipes = new WP_Query([
                'post_type' => DELICIOUS_RECIPE_POST_TYPE,
                'tax_query' => [
                    [
                        'taxonomy' => sanitize_title($term->taxonomy),
                        'field'    => 'term_id',
                        'terms'    => absint($term->term_id),
                    ],
                ]
            ]);

            if ($term_recipes->have_posts()) :
        ?>
                <div class="dr-block">
                    <header class="dr-block-header">
                        <h2 class="dr-block-title"><?php echo esc_html($term->name); ?></h2>
                        <div class="dr-button-holder">
                            <a href="<?php echo esc_url($term_link); ?>">
                                <?php esc_html_e("View All", 'delicious-recipes'); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18.479" height="12.689" viewBox="0 0 18.479 12.689">
                                    <g transform="translate(0.75 1.061)">
                                        <path d="M7820.11-1126.021l5.284,5.284-5.284,5.284" transform="translate(-7808.726 1126.021)" fill="none" stroke="#232323" stroke-linecap="round" stroke-width="1.5" />
                                        <path d="M6558.865-354.415H6542.66" transform="translate(-6542.66 359.699)" fill="none" stroke="#232323" stroke-linecap="round" stroke-width="1.5" />
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </header>

                    <section class="dr-recipe-archive splide" data-splide-count="<?php echo esc_html($term->count) ?>">
                        <div class="splide__arrows">
		                    <button class="splide__arrow splide__arrow--prev">
                                <svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 7.60645H17M17 7.60645L11 1.60645M17 7.60645L11 13.6064" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
		                    </button>
                            <button class="splide__arrow splide__arrow--next">
                                <svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 7.60645H17M17 7.60645L11 1.60645M17 7.60645L11 13.6064" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>

                        <div class="dr-recipe-archive__track splide__track">
                            <ul class="dr-recipe-archive__list splide__list">
                                <?php while ($term_recipes->have_posts()) : $term_recipes->the_post(); ?>
                                    <li class="dr-recipe-archive__slide splide__slide">

                                        <?php
                                        /**
                                         * Get grid block - recipe.
                                         */
                                        $data = array(
                                            'tax_page' => true
                                        );
                                        delicious_recipes_get_template( 'recipes-grid.php', $data );
                                        ?>

                                    <?php endwhile;
                                wp_reset_postdata();
                                    ?>
                                    </li>

                            </ul>
                        </div>
                    </section>
                </div>
        <?php
                $term_has_posts[$term->term_id] = true;
            endif;
        endforeach;
        if (empty($term_has_posts)) {
            esc_html_e("Recipes not found.", 'delicious-recipes');
        }
        ?>
    </div>
<?php
endif;
