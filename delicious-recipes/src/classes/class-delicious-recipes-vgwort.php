<?php
/**
 * Responsible for making recipe post type compatible with prosodia plugin's character count
 * 
 * This is a client request, https://github.com/Codewing-Solutions/delicious-recipes/issues/330
 *
 * @package Delicious_Recipes
 * @since 1.8.2
 */

class Delicious_Recipes_VGWort {

    public function __construct() {
        // Hook into VG WORT's character count calculation
        add_action('wpvgw_calculate_character_count', array($this, 'calculate_recipe_character_count'), 10, 7);          
    }

    /**
     * Calculate character count for recipe posts
     */
    public function calculate_recipe_character_count($post_title, $post_content, $post_excerpt, $markers_manager, $post, $ajax_custom_object, &$return_custom_count) {
        /*
            $ajax_custom_object is the filtered recipe meta data set in recipe.js
        */
        $custom_recipe_meta_count = $this->recipe_meta_count($ajax_custom_object);
        $cleanedPostContent = $markers_manager->clean_word_press_text($post_content);

        $return_custom_count = mb_strlen($cleanedPostContent) + $custom_recipe_meta_count;
    }

    public function recipe_meta_count($recipe_meta_data) {

        $recipe_meta_char_count = 0;

        if ( ! $recipe_meta_data ) {
            return 0;
        }

        //for each recipe meta data, get the recipe content and count the characters
        foreach ( $recipe_meta_data as $index => $recipe_meta_data_item ) {

            if ( empty($recipe_meta_data_item) ) {
                continue;
            }

            if ( $index === 'recipeInstructions' ) {
                foreach ( $recipe_meta_data_item as $sections ) {
                    foreach ( $sections as $section ) {
                        foreach ( $section as $instruction ) {
                            $title_count = mb_strlen(preg_replace('/\s+/', '', $instruction['title']));
                            $instruction_count = mb_strlen(preg_replace('/\s+/', '', strip_tags($instruction['instruction'])));
                            $notes_count = mb_strlen(preg_replace('/\s+/', '', $instruction['instructionNotes']));
                            $recipe_meta_char_count += $title_count + $instruction_count + $notes_count;
                        }
                    }
                }
            }

            if (  $index === 'recipeDescription' || $index === 'recipeNotes' || $index === 'extendedContent' ) {
                $final_str = '';
                $content_blocks = parse_blocks($recipe_meta_data_item);
                foreach ( $content_blocks as $block ) {
                    $str = strip_tags($block['innerHTML']);
                    $str = preg_replace('/\s+/', '', $str);
                    $final_str .= $str;
                }
                $char_count = mb_strlen($final_str);
                $recipe_meta_char_count += $char_count;
            }

            if ( $index === 'recipeIngredients' ) {
                foreach ( $recipe_meta_data_item as $sections ) {
                    foreach ( $sections as $section ) {
                        foreach ( $section as $ingredient ) {
                            $quantity_count = mb_strlen(preg_replace('/\s+/', '', $ingredient['quantity']));
                            $unit_count = mb_strlen(preg_replace('/\s+/', '', $ingredient['unit']));
                            $ingredient_count = mb_strlen(preg_replace('/\s+/', '', $ingredient['ingredient']));
                            $notes_count = mb_strlen(preg_replace('/\s+/', '', $ingredient['notes']));
                            $recipe_meta_char_count += $quantity_count + $unit_count + $ingredient_count + $notes_count;
                        }
                    }
                }
            }

            if ( $index === 'recipeFAQs' ) {
                foreach ( $recipe_meta_data_item as $faq ) {
                    foreach ( $faq as $faq_item ) {
                        $recipe_meta_char_count += mb_strlen(preg_replace('/\s+/', '', strip_tags($faq_item)));
                    }
                }
            }

            if ( $index === 'recipeSubtitle' || $index === 'recipeKeywords' ) {
                $recipe_meta_char_count += mb_strlen(preg_replace('/\s+/', '', strip_tags($recipe_meta_data_item)));
            }

        }

        return $recipe_meta_char_count;
    }

}

new Delicious_Recipes_VGWort();

?>