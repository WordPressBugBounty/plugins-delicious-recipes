<?php

/**
 * Frontend Template Hooks
 *
 * @package Delicious_Recipes
 */
class Delicious_Recipes_Template_Hooks {

	private static $_instance = null;

	private function __construct() {
		$this->init_hooks();
	}

	public static function get_instance() {
		if ( null === self::$_instance ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Initialization hooks.
	 *
	 * @return void
	 */
	private function init_hooks() {
		// Single recipe page hooks.
		$this->init_single_recipe_hooks();

		// Archive template hooks.
		$this->init_archive_recipe_hooks();

		// Recipe search page hooks.
		$this->init_recipe_search_hooks();
	}

	/**
	 * Recipe single page template hooks.
	 *
	 * @return void
	 */
	private function init_single_recipe_hooks() {
		add_action( 'delicious_recipes_before_main_content', array( $this, 'recipe_main_wrap_start' ) );
		add_action( 'delicious_recipes_primary_wrap_start', array( $this, 'recipe_primary_wrap_start' ) );
		add_action( 'delicious_recipes_primary_wrap_end', array( $this, 'recipe_primary_wrap_end' ) );
		add_action( 'delicious_recipes_after_main_content', array( $this, 'recipe_main_wrap_end' ) );
		add_action( 'delicious_recipes_sidebar', array( $this, 'delicious_recipes_get_sidebar' ) );

		// Recipe page section hooks.
		add_action( 'delicious_recipes_single_header', array( $this, 'recipe_get_single_header' ) );
		add_action( 'delicious_recipes_single_before_content_start', array( $this, 'recipe_get_gallery' ) );
		add_action( 'delicious_recipes_single_after_the_content', array( $this, 'recipe_main_card' ) );

		// Recipe Main Card hooks.
		add_action( 'delicious_recipes_main_summary', array( $this, 'recipe_main_summary' ) );
		add_action( 'delicious_recipes_ingredients', array( $this, 'recipe_main_ingredients' ) );
		add_action( 'delicious_recipes_instructions', array( $this, 'recipe_main_instructions' ) );
		add_action( 'delicious_recipes_nutrition', array( $this, 'recipe_main_nutrition' ) );
		add_action( 'delicious_recipes_notes', array( $this, 'recipe_main_notes' ) );
		add_action( 'delicious_recipes_single_after_content_end', array( $this, 'extended_content' ), 5 );
		add_action( 'delicious_recipes_single_after_content_end', array( $this, 'recipe_share' ), 10 );
		add_action( 'delicious_recipes_single_after_content_end', array( $this, 'recipe_tags' ), 30 );
		add_action( 'delicious_recipes_single_after_content_end', array( $this, 'recipe_powered_by' ), 40 );
		add_action( 'delicious_recipes_single_after_content_end', array( $this, 'recipe_faqs' ),40 );
		add_action( 'delicious_recipes_single_after_content_end', array( $this, 'call_to_action' ), 45 );
		add_action( 'delicious_recipes_single_after_content_end', array( $this, 'recipe_author' ), 50 );
		add_action( 'delicious_recipes_single_after_content_end', array( $this, 'recipe_navigation' ), 70 );
		add_action( 'delicious_recipes_single_after_content_end', array( $this, 'get_comments' ), 90 );
		add_action( 'delicious_recipes_single_after_content_end', array( $this, 'related_recipes' ), 90 );
	}

	/**
	 * Recipe archive template hooks.
	 *
	 * @return void
	 */
	private function init_archive_recipe_hooks() {
		// Recipe archive page section hooks.
		add_action( 'delicious_recipes_archive_header', array( $this, 'recipe_archive_header' ) );
		add_action( 'delicious_recipes_before_archive_recipe', array( $this, 'recipe_archive_wrap_start' ) );
		add_action( 'delicious_recipes_after_archive_recipe', array( $this, 'recipe_archive_pagination' ), 10 );
		add_action( 'delicious_recipes_after_archive_recipe', array( $this, 'recipe_archive_wrap_end' ), 20 );
		add_action( 'delicious_recipes_after_archive_recipe', array( $this, 'recipe_all_categories' ), 30 );
		add_action( 'delicious_recipes_after_archive_recipe', array( $this, 'recipes_by_ingredients' ), 40 );
	}

	/**
	 * Recipe Search page hooks.
	 *
	 * @return void
	 */
	private function init_recipe_search_hooks() {
		add_action( 'delicious_recipes_search_top_filters', array( $this, 'recipes_search_filters' ) );
	}

	/**
	 * Before recipe main content hook.
	 *
	 * @return void
	 */
	public function recipe_primary_wrap_start() {

		if ( is_post_type_archive( DELICIOUS_RECIPE_POST_TYPE ) ) : ?>
			<div id="primary" class="content-area">
			<?php
		endif;
	}

	/**
	 * Before recipe main content hook.
	 *
	 * @return void
	 */
	public function recipe_primary_wrap_end() {
		if ( is_post_type_archive( DELICIOUS_RECIPE_POST_TYPE ) ) :
			?>
			</div>
			<?php
		endif;
	}

	/**
	 * Before recipe main content hook.
	 *
	 * @return void
	 */
	public function recipe_main_wrap_start() {
		if ( is_singular( DELICIOUS_RECIPE_POST_TYPE ) ) :
			?>
			<div id="primary" class="content-area">
				<main class="site-main">
				<?php
			endif;

		if ( is_post_type_archive( DELICIOUS_RECIPE_POST_TYPE ) ) :
			?>
					<div class="recipe-archive">
				<?php
				endif;
	}

	/**
	 * Before recipe main content hook.
	 *
	 * @return void
	 */
	public function recipe_main_wrap_end() {
		if ( is_singular( DELICIOUS_RECIPE_POST_TYPE ) ) :
			?>
				</main>
			</div>
			<?php
		endif;

		if ( is_post_type_archive( DELICIOUS_RECIPE_POST_TYPE ) ) :
			?>
			</div>
			<?php
		endif;
	}

	/**
	 * Get recipe single header.
	 *
	 * @return void
	 */
	public function recipe_get_single_header() {
		$global_settings        = delicious_recipes_get_global_settings();
		$selected_banner_layout = array();
		$banner_layout_id       = 'default';
		if ( function_exists( 'DEL_RECIPE_PRO' ) ) {
			$license_validity_bool = delicious_recipe_pro_check_license_status();
			if ( $license_validity_bool ) {
				$selected_banner_layout = isset( $global_settings['selectedBannerLayout'] ) ? $global_settings['selectedBannerLayout'] : array();
				$banner_layout_id 	 = isset( $selected_banner_layout['id'] ) ? $selected_banner_layout['id'] : 'default';
			}
		}
		$enable_elementor_support = isset( $global_settings['enableElementorSupport'] ) ? $global_settings['enableElementorSupport'] : false;
		if ( isset( $selected_banner_layout ) && isset( $banner_layout_id ) && 'default' !== $banner_layout_id && ! $enable_elementor_support ) {
			return;
		} else {
			delicious_recipes_get_template( 'recipe/header.php' );
		}
	}

	/**
	 * Get recipe single gallery.
	 *
	 * @return void
	 */
	public function recipe_get_gallery() {
		global $recipe;
		if ( isset( $recipe->recipe_subtitle ) && ! empty( $recipe->recipe_subtitle ) ) :
			?>
			<div class="dr-info">
				<?php echo wp_kses_post( $recipe->recipe_subtitle ); ?>
			</div>
			<?php
		endif;
		delicious_recipes_get_template( 'recipe/gallery.php' );
	}

	/**
	 * Get Recipe page main card template.
	 *
	 * @return void
	 */
	public function recipe_main_card() {
		delicious_recipes_get_template( 'recipe/recipe-main.php' );
	}

	/**
	 * Get recipe summary template.
	 *
	 * @param string $card_layout Card layout.
	 */
	public function recipe_main_summary( $card_layout = '' ) {
		$global_settings    = delicious_recipes_get_global_settings();
		$global_card_layout = isset( $global_settings['defaultCardLayout'] ) && ! empty( $global_settings['defaultCardLayout'] ) ? $global_settings['defaultCardLayout'] : 'default';
		$card_layout        = $card_layout ? $card_layout : $global_card_layout;

		$free_layouts = array( 'default', 'layout-1', 'layout-2' );
		$card_layout  = in_array( $card_layout, $free_layouts, true ) ? $card_layout : ( delicious_recipes_is_pro_activated() ? $card_layout : 'default' );

		if ( ! in_array( $card_layout, $free_layouts, true ) && function_exists( 'delicious_recipes_pro_get_template_part' ) ) {
			delicious_recipes_pro_get_template_part( 'recipe/recipe-block/summary', $card_layout );
		} else {
			delicious_recipes_get_template_part( 'recipe/recipe-block/summary', $card_layout );
		}
	}

	/**
	 * Get recipe nutrition template.
	 *
	 * @return void
	 */
	public function recipe_main_nutrition() {
		delicious_nutrition_chart_layout();
	}

	/**
	 * Get recipe notes template.
	 *
	 * @return void
	 */
	public function recipe_main_notes() {
		delicious_recipes_get_template( 'recipe/recipe-block/notes.php' );
	}

	/**
	 * Get recipe instructions template.
	 *
	 * @return void
	 */
	public function recipe_main_instructions() {
		delicious_recipes_get_template( 'recipe/recipe-block/instructions.php' );
	}

	/**
	 * Get recipe ingredients template.
	 *
	 * @return void
	 */
	public function recipe_main_ingredients() {
		delicious_recipes_get_template( 'recipe/recipe-block/ingredients.php' );
	}

	/**
	 * Get Recipe FAQs template.
	 *
	 * @return void
	 */
	public function recipe_faqs() {
		delicious_recipes_get_template( 'recipe/recipe-faqs.php' );
	}

	/**
	 * Get Recipe page main card template.
	 *
	 * @return void
	 */
	public function recipe_powered_by() {
		delicious_recipes_get_template( 'recipe/powered-by.php' );
	}

	/**
	 * Get Recipe page main card template.
	 *
	 * @return void
	 */
	public function call_to_action() {
		do_action( 'delicious_recipes_cta_image' );
	}

	/**
	 * Get Recipe page main card template.
	 *
	 * @return void
	 */
	public function extended_content() {
		do_action( 'delicious_recipes_extended_content' );
	}

	/**
	 * Get Recipe page main card template.
	 *
	 * @return void
	 */
	public function recipe_share() {
		delicious_recipes_get_template( 'recipe/recipe-share.php' );
	}

	/**
	 * Get Recipe author profile template.
	 *
	 * @return void
	 */
	public function recipe_author() {
		delicious_recipes_get_template( 'recipe/author-profile.php' );
	}

	/**
	 * Get Recipe navigation template.
	 *
	 * @return void
	 */
	public function recipe_navigation() {
		delicious_recipes_get_template( 'recipe/navigation.php' );
	}

	/**
	 * Get Related recipes template.
	 *
	 * @return void
	 */
	public function related_recipes() {
		delicious_recipes_get_template( 'recipe/related-recipes.php' );
	}

	/**
	 * Get Recipe page main card template.
	 *
	 * @return void
	 */
	public function recipe_tags() {
		delicious_recipes_get_template( 'recipe/recipe-tags.php' );
	}

	/**
	 * Get Sidebar.
	 *
	 * @return void
	 */
	public function delicious_recipes_get_sidebar() {
		delicious_recipes_get_template( 'global/sidebar.php' );
	}

	/**
	 * Get Comments template.
	 *
	 * @return void
	 */
	public function get_comments() {
		global $recipe;
		$comment_status = get_post( $recipe->ID )->comment_status;
		if ( 'closed' !== $comment_status ) {
			$global_toggles = delicious_recipes_get_global_toggles_and_labels();
			if ( $global_toggles['enable_comments'] ) { // Removed current theme supports case.
				comments_template();
			}
		}
	}

	/**
	 * Get recipe archive header.
	 *
	 * @return void
	 */
	public function recipe_archive_header() {
		delicious_recipes_get_template( 'archive/header.php' );
	}

	/**
	 * Get recipe archive wrap start.
	 *
	 * @return void
	 */
	public function recipe_archive_wrap_start() {
		delicious_recipes_get_template( 'archive/wrap-start.php' );
	}

	/**
	 * Get recipe archive pagination.
	 *
	 * @return void
	 */
	public function recipe_archive_pagination() {
		delicious_recipes_get_template( 'archive/pagination.php' );
	}

	/**
	 * Get recipe archive wrap end.
	 *
	 * @return void
	 */
	public function recipe_archive_wrap_end() {
		delicious_recipes_get_template( 'archive/wrap-end.php' );
	}

	/**
	 * Get all recipe categories.
	 *
	 * @return void
	 */
	public function recipe_all_categories() {
		delicious_recipes_get_template( 'archive/all-categories.php' );
	}

	/**
	 * Get all recipe categories .
	 *
	 * @return void
	 */
	public function recipes_by_ingredients() {
		delicious_recipes_get_template( 'archive/recipes-by-ingredients.php' );
	}

	/**
	 * Search page top filters template.
	 *
	 * @return void
	 */
	public function recipes_search_filters() {
		delicious_recipes_get_template( 'global/search/top-filters.php' );
	}
}

Delicious_Recipes_Template_Hooks::get_instance();
