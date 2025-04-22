<?php
/**
 * Print Recipe Screen file.
 *
 * @package Delicious_Recipes/Templates
 */

global $recipe;
$recipe_global                  = delicious_recipes_get_global_settings();
$recipe_meta                    = get_post_meta( $recipe->ID, 'delicious_recipes_metadata', true );
$allow_print_customization      = isset( $recipe_global['allowPrintCustomization']['0'] ) && 'yes' === $recipe_global['allowPrintCustomization']['0'] ? true : false;
$embed_recipe_link              = isset( $recipe_global['embedRecipeLink']['0'] ) && 'yes' === $recipe_global['embedRecipeLink']['0'] ? true : false;
$display_social_sharing_info    = isset( $recipe_global['displaySocialSharingInfo']['0'] ) && 'yes' === $recipe_global['displaySocialSharingInfo']['0'] ? true : false;
$embed_author_info              = isset( $recipe_global['embedAuthorInfo']['0'] ) && 'yes' === $recipe_global['embedAuthorInfo']['0'] ? true : false;
$socials_enabled                = ( isset( $recipe_global['socialShare']['0']['enable']['0'] ) && 'yes' === $recipe_global['socialShare']['0']['enable']['0'] ) || ( isset( $recipe_global['socialShare']['1']['enable']['0'] ) && 'yes' === $recipe_global['socialShare']['1']['enable']['0'] ) ? true : false;
$estimated_cost_currency_symbol = isset( $recipe_global['globalEstimatedCostCurr'] ) ? $recipe_global['globalEstimatedCostCurr'] : '$';
// Get global toggles.
$global_toggles = delicious_recipes_get_global_toggles_and_labels();

$asset_script_path = '/min/';
$min_prefix        = '.min';

if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
	$asset_script_path = '/';
	$min_prefix        = '';
}

$default_print_options = array(
	'title'            => 'yes',
	'recipe_content'   => 'yes',
	'info'             => 'yes',
	'description'      => 'yes',
	'images'           => 'yes',
	'ingredients'      => 'yes',
	'instructions'     => 'yes',
	'nutrition'        => 'yes',
	'notes'            => 'yes',
	'keywords'         => 'yes',
	'extended_content' => 'yes',
	'social_share'     => 'yes',
	'author_bio'       => 'yes',
	'thank_you_note'   => 'yes',
);

$all_no = true;

?>
<!DOCTYPE html>
<html>

<head>
	<title><?php the_title(); ?></title>
	<link rel="stylesheet"
		href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . 'assets/public/css' . $asset_script_path . 'recipe-print' . $min_prefix . '.css'; ?>"
		media="screen,print">
	<?php delicious_recipes_get_template( 'global/dynamic-css.php' ); ?>
	<meta name="robots" content="noindex">
</head>

<body>
	<?php
	if ( $allow_print_customization ) {
		$print_options = isset( $recipe_global['printOptions'] ) ? $recipe_global['printOptions'] : array();
		if ( ! empty( $print_options ) ) {
			$all_no = false;
			?>
	<div id="dr-print-options" class="dr-clearfix">
		<div class="wpd-logo">
			<img class="dr-print-page-image" src="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>/assets/images/Delicious-Recipes.png" alt="WP Delicious">	
		</div>
		<span class="wpd-print-options-title"><?php esc_html_e( 'Include in Print View:', 'delicious-recipes' ); ?></span>
		<div class="wpd-print-options-wrap">
			<?php
			foreach ( $print_options as $key => $print_opt ) :

				// Display the "Recipe Content" checkbox option after the "Title" option.
				if ( 1 === $key && isset( $print_options['11'] ) ) {
					$name   = isset( $print_options['11']['key'] ) ? $print_options['11']['key'] : '';
					$enable = isset( $print_options['11']['enable']['0'] ) && 'yes' === $print_options['11']['enable']['0'] ? true : false;
					?>
				<div class="dr-print-block">
					<input id="print_options_11" type="checkbox" name="print_options" value="1"
							<?php checked( $enable, true ); ?> />
					<label for="print_options_11"><?php esc_html_e( $name, 'delicious-recipes' ); ?></label>
				</div>
							<?php
				}

				// Skip printing option 11 since we handled it above.
				if ( 11 === $key ) {
					continue;
				}

				// Display Extended Content (12) after Notes (7).
				if ( 8 === $key && isset( $print_options['12'] ) && function_exists( 'DEL_RECIPE_PRO' ) ) {
					$name   = isset( $print_options['12']['key'] ) ? $print_options['12']['key'] : '';
					$enable = isset( $print_options['12']['enable']['0'] ) && 'yes' === $print_options['12']['enable']['0'] ? true : false;
					?>
					<div class="dr-print-block">
						<input id="print_options_12" type="checkbox" name="print_options" value="1"
								<?php checked( $enable, true ); ?> />
						<label for="print_options_12"><?php esc_html_e( $name, 'delicious-recipes' ); ?></label>
					</div>
					<?php
				}

				// Skip printing option 12 since we handled it above.
				if ( 12 === $key ) {
					continue;
				}

				$name   = isset( $print_opt['key'] ) ? $print_opt['key'] : '';
				$enable = isset( $print_opt['enable']['0'] ) && 'yes' === $print_opt['enable']['0'] ? true : false;
				?>
				<div class="dr-print-block">
					<input id="print_options_<?php echo esc_attr( sanitize_title( $key ) ); ?>" type="checkbox"
						name="print_options" value="1" <?php checked( $enable, true ); ?> />
					<label
						for="print_options_<?php echo esc_attr( sanitize_title( $key ) ); ?>"><?php esc_html_e( $name, 'delicious-recipes' ); ?></label>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
			<?php
		}
	} else {
		$print_options = isset( $recipe_global['printOptions'] ) ? $recipe_global['printOptions'] : array();
		foreach ( $print_options as $print_opt ) {
			$name   = isset( $print_opt['key'] ) ? $print_opt['key'] : '';
			$enable = isset( $print_opt['enable']['0'] ) && 'yes' === $print_opt['enable']['0'] ? true : false;
			foreach ( $default_print_options as $key => $value ) {
				$name = isset( $print_opt['key'] ) ? $print_opt['key'] : '';
				$name = strtolower( str_replace( ' ', '_', $name ) );
				if ( $key === $name ) {
					$default_print_options[ $key ] = $enable ? 'yes' : 'no';
					if ( $enable ) {
						$all_no = false;
					}
				}
			}
		}
	}
	if ( $all_no && ! $embed_recipe_link ) {
		echo esc_html__( 'All print options are disabled.', 'delicious-recipes' );
		return;
	}
	?>
	<div class="dr-print-outer-wrap">
		<div class="wpd-print-button-wrap">
			<button class="dr-button" onclick="window.print();"><?php esc_html_e( 'Print', 'delicious-recipes' ); ?> 
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(#clip0_4315_1351)">
					<path d="M15.0001 5.83332V4.33332C15.0001 3.3999 15.0001 2.93319 14.8184 2.57667C14.6586 2.26307 14.4037 2.0081 14.0901 1.84831C13.7335 1.66666 13.2668 1.66666 12.3334 1.66666H7.66675C6.73333 1.66666 6.26662 1.66666 5.9101 1.84831C5.59649 2.0081 5.34153 2.26307 5.18174 2.57667C5.00008 2.93319 5.00008 3.3999 5.00008 4.33332V5.83332M5.00008 15C4.22511 15 3.83762 15 3.5197 14.9148C2.65697 14.6836 1.9831 14.0098 1.75193 13.147C1.66675 12.8291 1.66675 12.4416 1.66675 11.6667V9.83332C1.66675 8.43319 1.66675 7.73313 1.93923 7.19835C2.17892 6.72794 2.56137 6.34549 3.03177 6.10581C3.56655 5.83332 4.26662 5.83332 5.66675 5.83332H14.3334C15.7335 5.83332 16.4336 5.83332 16.9684 6.10581C17.4388 6.34549 17.8212 6.72794 18.0609 7.19835C18.3334 7.73313 18.3334 8.43319 18.3334 9.83332V11.6667C18.3334 12.4416 18.3334 12.8291 18.2482 13.147C18.0171 14.0098 17.3432 14.6836 16.4805 14.9148C16.1625 15 15.7751 15 15.0001 15M12.5001 8.74999H15.0001M7.66675 18.3333H12.3334C13.2668 18.3333 13.7335 18.3333 14.0901 18.1517C14.4037 17.9919 14.6586 17.7369 14.8184 17.4233C15.0001 17.0668 15.0001 16.6001 15.0001 15.6667V14.3333C15.0001 13.3999 15.0001 12.9332 14.8184 12.5767C14.6586 12.2631 14.4037 12.0081 14.0901 11.8483C13.7335 11.6667 13.2668 11.6667 12.3334 11.6667H7.66675C6.73333 11.6667 6.26662 11.6667 5.9101 11.8483C5.59649 12.0081 5.34153 12.2631 5.18174 12.5767C5.00008 12.9332 5.00008 13.3999 5.00008 14.3333V15.6667C5.00008 16.6001 5.00008 17.0668 5.18174 17.4233C5.34153 17.7369 5.59649 17.9919 5.9101 18.1517C6.26662 18.3333 6.73333 18.3333 7.66675 18.3333Z" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
					</g>
					<defs>
					<clipPath id="clip0_4315_1351">
					<rect width="20" height="20" fill="currentColor"/>
					</clipPath>
					</defs>
				</svg>
			</button>
			<button class="dr-increase-font-size" id="dr-increase-font-size">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.97495 15.25C7.73388 15.25 6.52067 14.882 5.48875 14.1925C4.45683 13.503 3.65255 12.5229 3.17761 11.3763C2.70267 10.2297 2.5784 8.96802 2.82053 7.75079C3.06265 6.53356 3.66028 5.41546 4.53786 4.53789C5.41543 3.66032 6.53353 3.06268 7.75076 2.82056C8.96799 2.57843 10.2297 2.7027 11.3763 3.17764C12.5229 3.65258 13.5029 4.45686 14.1924 5.48878C14.8819 6.5207 15.25 7.73391 15.25 8.97499C15.25 9.79903 15.0876 10.615 14.7723 11.3763C14.4569 12.1376 13.9947 12.8294 13.4121 13.4121C12.8294 13.9948 12.1376 14.457 11.3763 14.7723C10.615 15.0877 9.799 15.25 8.97495 15.25ZM8.97495 3.95832C7.98605 3.95832 7.01935 4.25156 6.1971 4.80097C5.37486 5.35038 4.73399 6.13127 4.35556 7.0449C3.97712 7.95853 3.8781 8.96386 4.07103 9.93377C4.26395 10.9037 4.74016 11.7946 5.43942 12.4939C6.13868 13.1931 7.0296 13.6693 7.9995 13.8622C8.96941 14.0552 9.97474 13.9562 10.8884 13.5777C11.802 13.1993 12.5829 12.5584 13.1323 11.7362C13.6817 10.9139 13.975 9.94722 13.975 8.95832C13.975 7.63224 13.4482 6.36047 12.5105 5.42278C11.5728 4.4851 10.301 3.95832 8.97495 3.95832Z" fill="#566267"/>
					<path d="M16.6666 17.2917C16.5845 17.2921 16.5031 17.276 16.4273 17.2446C16.3514 17.2131 16.2826 17.1668 16.2249 17.1083L12.7833 13.6667C12.6729 13.5482 12.6128 13.3915 12.6156 13.2296C12.6185 13.0676 12.6841 12.9132 12.7986 12.7986C12.9131 12.6841 13.0676 12.6185 13.2295 12.6157C13.3914 12.6128 13.5481 12.6729 13.6666 12.7833L17.1083 16.225C17.2253 16.3422 17.291 16.501 17.291 16.6667C17.291 16.8323 17.2253 16.9911 17.1083 17.1083C17.0505 17.1668 16.9818 17.2131 16.9059 17.2446C16.8301 17.276 16.7487 17.2921 16.6666 17.2917ZM8.95825 11.6667C8.79316 11.6645 8.63544 11.598 8.5187 11.4812C8.40195 11.3645 8.33541 11.2068 8.33325 11.0417V6.875C8.33325 6.70924 8.3991 6.55027 8.51631 6.43306C8.63352 6.31585 8.79249 6.25 8.95825 6.25C9.12401 6.25 9.28298 6.31585 9.40019 6.43306C9.5174 6.55027 9.58325 6.70924 9.58325 6.875V11.0417C9.58109 11.2068 9.51455 11.3645 9.39781 11.4812C9.28106 11.598 9.12334 11.6645 8.95825 11.6667Z" fill="#566267"/>
					<path d="M11.0417 9.58334H6.875C6.70924 9.58334 6.55027 9.5175 6.43306 9.40028C6.31585 9.28307 6.25 9.1241 6.25 8.95834C6.25 8.79258 6.31585 8.63361 6.43306 8.5164C6.55027 8.39919 6.70924 8.33334 6.875 8.33334H11.0417C11.2074 8.33334 11.3664 8.39919 11.4836 8.5164C11.6008 8.63361 11.6667 8.79258 11.6667 8.95834C11.6667 9.1241 11.6008 9.28307 11.4836 9.40028C11.3664 9.5175 11.2074 9.58334 11.0417 9.58334Z" fill="#566267"/>
				</svg>
				<span>
					<?php esc_html_e( 'Increase Text', 'delicious-recipes' ); ?>
				</span>
			</button>
			<button class="dr-decrease-font-size" id="dr-decrease-font-size">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.97495 15.25C7.73388 15.25 6.52067 14.882 5.48875 14.1925C4.45683 13.503 3.65255 12.5229 3.17761 11.3763C2.70267 10.2297 2.5784 8.96802 2.82053 7.75079C3.06265 6.53356 3.66028 5.41546 4.53786 4.53789C5.41543 3.66032 6.53353 3.06268 7.75076 2.82056C8.96799 2.57843 10.2297 2.7027 11.3763 3.17764C12.5229 3.65258 13.5029 4.45686 14.1924 5.48878C14.8819 6.5207 15.25 7.73391 15.25 8.97499C15.25 9.79903 15.0876 10.615 14.7723 11.3763C14.4569 12.1376 13.9947 12.8294 13.4121 13.4121C12.8294 13.9948 12.1376 14.457 11.3763 14.7723C10.615 15.0877 9.799 15.25 8.97495 15.25ZM8.97495 3.95832C7.98605 3.95832 7.01935 4.25156 6.1971 4.80097C5.37486 5.35038 4.73399 6.13127 4.35556 7.0449C3.97712 7.95853 3.8781 8.96386 4.07103 9.93377C4.26395 10.9037 4.74016 11.7946 5.43942 12.4939C6.13868 13.1931 7.0296 13.6693 7.9995 13.8622C8.96941 14.0552 9.97474 13.9562 10.8884 13.5777C11.802 13.1993 12.5829 12.5584 13.1323 11.7362C13.6817 10.9139 13.975 9.94722 13.975 8.95832C13.975 7.63224 13.4482 6.36047 12.5105 5.42278C11.5728 4.4851 10.301 3.95832 8.97495 3.95832Z" fill="#566267"/>
					<path d="M16.6666 17.2917C16.5845 17.2921 16.5031 17.276 16.4273 17.2446C16.3514 17.2131 16.2826 17.1668 16.2249 17.1083L12.7833 13.6667C12.6729 13.5482 12.6128 13.3915 12.6156 13.2296C12.6185 13.0676 12.6841 12.9132 12.7986 12.7986C12.9131 12.6841 13.0676 12.6185 13.2295 12.6157C13.3914 12.6128 13.5481 12.6729 13.6666 12.7833L17.1083 16.225C17.2253 16.3422 17.291 16.501 17.291 16.6667C17.291 16.8323 17.2253 16.9911 17.1083 17.1083C17.0505 17.1668 16.9818 17.2131 16.9059 17.2446C16.8301 17.276 16.7487 17.2921 16.6666 17.2917ZM8.95825 11.6667C8.79316 11.6645 8.63544 11.598 8.5187 11.4812C8.40195 11.3645 8.33541 11.2068 8.33325 11.0417V6.875C8.33325 6.70924 8.3991 6.55027 8.51631 6.43306C8.63352 6.31585 8.79249 6.25 8.95825 6.25C9.12401 6.25 9.28298 6.31585 9.40019 6.43306C9.5174 6.55027 9.58325 6.70924 9.58325 6.875V11.0417C9.58109 11.2068 9.51455 11.3645 9.39781 11.4812C9.28106 11.598 9.12334 11.6645 8.95825 11.6667Z" fill="#566267"/>
					<path d="M11.0417 9.58334H6.875C6.70924 9.58334 6.55027 9.5175 6.43306 9.40028C6.31585 9.28307 6.25 9.1241 6.25 8.95834C6.25 8.79258 6.31585 8.63361 6.43306 8.5164C6.55027 8.39919 6.70924 8.33334 6.875 8.33334H11.0417C11.2074 8.33334 11.3664 8.39919 11.4836 8.5164C11.6008 8.63361 11.6667 8.79258 11.6667 8.95834C11.6667 9.1241 11.6008 9.28307 11.4836 9.40028C11.3664 9.5175 11.2074 9.58334 11.0417 9.58334Z" fill="#566267"/>
				</svg>
				<span>
					<?php esc_html_e( 'Decrease Text', 'delicious-recipes' ); ?>
				</span>
			</button>
		</div>
		<div class="print-page">
			<!-- Title, Logo and Image -->
			<?php if ( 'yes' === $default_print_options['images'] && 'yes' === $default_print_options['title'] ) : ?>
			<div id="dr-page1" class="dr-print-header">
				<?php
				$print_logo_image = isset( $recipe_global['printLogoImage'] ) && ! empty( $recipe_global['printLogoImage'] ) ? $recipe_global['printLogoImage'] : false;
				if ( $print_logo_image && 'yes' === $default_print_options['images'] ) :
					?>
				<div class="dr-logo">
					<?php echo wp_get_attachment_image( $print_logo_image, 'full' ); ?>
				</div>
					<?php
				endif;
				?>
				<?php if ( 'yes' === $default_print_options['title'] ) : ?>
				<h1 id="dr-print-title" class="dr-print-title"><?php echo esc_html( $recipe->name ); ?></h1>
				<?php endif; ?>
				<?php if ( 'yes' === $default_print_options['images'] ) : ?>
				<figure
					class="dr-print-img <?php echo esc_attr( $global_toggles['enable_recipe_image_crop'] ? 'large' : 'full' ); ?>">
					<?php the_post_thumbnail( 'large', array( 'class' => 'dr-print-page-image' ) ); ?>
				</figure>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<!-- #dr-page1 -->
	
			<!-- Recipe Content, Info, Description, Ingredients -->
			<?php if ( 'yes' === $default_print_options['recipe_content'] || 'yes' === $default_print_options['info'] || 'yes' === $default_print_options['description'] || 'yes' === $default_print_options['ingredients'] ) : ?>
			<div id="dr-page2" class="dr-print-page dr-print-ingredients">
				<?php if ( 'yes' === $default_print_options['recipe_content'] ) : ?>
				<div class="dr-print-block-wrap">
					<?php if ( $recipe->description ) : ?>
					<div class="dr-print-block dr-content-wrap">
						<div class="dr-pring-block-content">
							<?php echo wp_kses_post( $recipe->description ); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
	
				<?php if ( 'yes' === $default_print_options['info'] ) : ?>
				<div class="dr-ingredient-meta-wrap">
					<div class="dr-ingredient-meta dr-ingredient-time">
						<div class="meta-wrap">
							<?php if ( ! empty( $recipe->prep_time ) && '0' !== $recipe->prep_time && $global_toggles['enable_prep_time'] ) : ?>
								<div class="dr-prep-time">
									<span class="dr-ingredient-time-title"><?php echo esc_html( $global_toggles['prep_time_lbl'] ); ?></span>
									<span><?php echo esc_html( $recipe->prep_time_unit ); ?></span>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->cook_time ) && '0' !== $recipe->cook_time && $global_toggles['enable_cook_time'] ) : ?>
								<div class="dr-cook-time">
									<span class="dr-ingredient-time-title"><?php echo esc_html( $global_toggles['cook_time_lbl'] ); ?></span>
									<span><?php echo esc_html( $recipe->cook_time_unit ); ?></span>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->rest_time ) && '0' !== $recipe->rest_time && $global_toggles['enable_rest_time'] ) : ?>
								<div class="dr-rest-time">
									<span class="dr-ingredient-time-title"><?php echo esc_html( $global_toggles['rest_time_lbl'] ); ?></span>
									<span><?php echo esc_html( $recipe->rest_time_unit ); ?></span>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->total_time ) && '0' !== $recipe->total_time && $global_toggles['enable_total_time'] ) : ?>
								<div class="dr-total-time">
									<span class="dr-ingredient-time-title"><?php echo esc_html( $global_toggles['total_time_lbl'] ); ?></span>
									<span><?php echo esc_html( $recipe->total_time ); ?></span>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="dr-recipe-info-box">
						<?php if ( $recipe->rating_count ) : ?>
							<div class="dr-ingredient-meta">
								<b><?php esc_html_e( 'Ratings', 'delicious-recipes' ); ?>:</b>
								<span>
									<?php
											/* translators: %1$s: rating %2$s: total ratings count */
											echo esc_html( sprintf( __( '%1$s from %2$s votes', 'delicious-recipes' ), $recipe->rating, $recipe->rating_count ) );
									?>
								</span>
							</div>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->cooking_method ) && $global_toggles['enable_cooking_method'] ) : ?>
							<div class="dr-ingredient-meta">
								<b><?php echo esc_html( $global_toggles['cooking_method_lbl'] ); ?>:</b>
								<?php the_terms( $recipe->ID, 'recipe-cooking-method', '<span>', ', ', '</span>' ); ?>
							</div>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->recipe_cuisine ) && $global_toggles['enable_cuisine'] ) : ?>
							<div class="dr-ingredient-meta">
								<b><?php echo esc_html( $global_toggles['cuisine_lbl'] ); ?>:</b>
								<?php the_terms( $recipe->ID, 'recipe-cuisine', '<span>', ', ', '</span>' ); ?>
							</div>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->recipe_course ) && $global_toggles['enable_category'] ) : ?>
							<div class="dr-ingredient-meta">
								<b><?php echo esc_html( $global_toggles['category_lbl'] ); ?>:</b>
								<?php the_terms( $recipe->ID, 'recipe-course', '<span>', ', ', '</span>' ); ?>
							</div>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->difficulty_level ) && $global_toggles['enable_difficulty_level'] ) : ?>
							<div class="dr-ingredient-meta">
								<b><?php echo esc_html( $global_toggles['difficulty_level_lbl'] ); ?>:</b>
								<?php echo esc_html( $recipe->difficulty_level ); ?>
							</div>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->prep_time ) || ! empty( $recipe->cook_time ) || ! empty( $recipe->rest_time ) ) : ?>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->cooking_temp ) && $global_toggles['enable_cooking_temp'] ) : ?>
							<div class="dr-ingredient-meta">
								<b><?php echo esc_html( $global_toggles['cooking_temp_lbl'] ); ?>:</b>
								<span id="dr-cooking-temp">
									<?php echo esc_html( $recipe->cooking_temp ); ?>&nbsp;
									<?php echo esc_html( $recipe->cooking_temp_unit ); ?>
								</span>
							</div>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->no_of_servings ) && $global_toggles['enable_servings'] ) : ?>
							<div class="dr-ingredient-meta">
								<b><?php echo esc_html( $global_toggles['servings_lbl'] ); ?>:</b>
								<span id="dr-servings"><?php echo esc_html( $recipe->no_of_servings ); ?></span>
							</div>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->estimated_cost ) && $global_toggles['enable_estimated_cost'] ) : ?>
							<div class="dr-ingredient-meta">
								<b><?php echo esc_html( $global_toggles['estimated_cost_lbl'] ); ?>:</b>
								<span id="dr-estimated-cost">
									<?php
									if ( $estimated_cost_currency_symbol ) {
										echo esc_html( $estimated_cost_currency_symbol ) . '&nbsp;';
									}
									?>
									<?php echo esc_html( $recipe->estimated_cost ); ?>
								</span>
							</div>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->recipe_calories ) && $global_toggles['enable_calories'] ) : ?>
							<div class="dr-ingredient-meta">
								<b><?php echo esc_html( $global_toggles['calories_lbl'] ); ?>:</b>
								<span><?php echo esc_html( $recipe->recipe_calories ); ?></span>
							</div>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->best_season ) && $global_toggles['enable_seasons'] ) : ?>
							<div class="dr-ingredient-meta">
								<b><?php echo esc_html( $global_toggles['seasons_lbl'] ); ?>:</b>
								<span>
									<?php
											$best_season = $recipe->best_season;
									if ( ! is_array( $best_season ) ) {
										$best_season = explode( ',', $best_season );
									}
									foreach ( $best_season as $season ) {
										$comma = ( end( $best_season ) === $season ) ? '' : esc_html( ', ' );
										echo esc_html( $season . $comma );
									}
									?>
								</span>
							</div>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->dietary ) && $global_toggles['enable_dietary'] ) : ?>
							<div class="dr-ingredient-meta">
								<b><?php echo esc_html( $global_toggles['dietary_lbl'] ); ?>:</b>
								<span>
									<?php echo esc_html( implode( ', ', $recipe->dietary ) ); ?>
								</span>
							</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>	
				</div>
				<?php if ( 'yes' === $default_print_options['description'] || 'yes' === $default_print_options['ingredients'] ) : ?>
				<div class="dr-print-block-wrap">
					<?php if ( $recipe->recipe_description && 'yes' === $default_print_options['description'] ) : ?>
					<div class="dr-print-block dr-description-wrap">
						<div class="dr-pring-block-header">
							<div class="dr-print-block-title">
								<span><?php esc_html_e( 'Description', 'delicious-recipes' ); ?></span>
							</div>
						</div>
						<div class="dr-pring-block-content">
							<?php echo wp_kses_post( $recipe->recipe_description ); ?>
						</div>
					</div>
					<?php endif; ?>
					<?php if ( isset( $recipe->ingredients ) && ! empty( $recipe->ingredients ) && 'yes' === $default_print_options['ingredients'] ) : ?>
					<div class="dr-print-block dr-ingredients-wrap">
						<div class="dr-pring-block-header">
							<div class="dr-print-block-title">
								<span><?php echo esc_html( $recipe->ingredient_title ); ?></span>
							</div>
						</div>
						<div class="dr-pring-block-content">
							<?php
							echo '<ul>';
							$ingredient_string_format = isset( $global_settings['ingredientStringFormat'] ) ? $global_settings['ingredientStringFormat'] : '{qty} {unit} {ingredient} {notes}';

							foreach ( $recipe->ingredients as $key => $ingre_section ) {
								$section_title = isset( $ingre_section['sectionTitle'] ) ? $ingre_section['sectionTitle'] : '';
								$ingre         = isset( $ingre_section['ingredients'] ) ? $ingre_section['ingredients'] : array();

								if ( $section_title ) {
									echo '<div class="dr-subtitle">' . esc_html( $section_title ) . '</div>';
								}
								if ( empty( $ingre ) ) {
									continue;
								}
								foreach ( $ingre as $ingre_key => $ingredient ) {
									$ingredient_qty  = isset( $ingredient['quantity'] ) ? $ingredient['quantity'] : 0;
									$ingredient_qty  = is_numeric( $ingredient_qty ) ? round( $ingredient_qty, 2 ) : $ingredient_qty;
									$ingredient_unit = isset( $ingredient['unit'] ) ? $ingredient['unit'] : '';
									$unit_text       = ! empty( $ingredient_unit ) ? $ingredient_unit : '';

									$ingredient_keys = array(
										'{qty}'        => isset( $ingredient['quantity'] ) ? '<span class="ingredient_quantity" data-original="' . $ingredient['quantity'] . '" data-recipe="' . $recipe->ID . '">' . $ingredient['quantity'] . '</span>' : '',
										'{unit}'       => '<span class="ingredient_unit">' . $unit_text . '</span>',
										'{ingredient}' => isset( $ingredient['ingredient'] ) ? $ingredient['ingredient'] : '',
										'{notes}'      => isset( $ingredient['notes'] ) && ! empty( $ingredient['notes'] ) ? '<span class="ingredient-notes" >(' . $ingredient['notes'] . ')</span>' : '',
									);
									$ingre_string    = str_replace( array_keys( $ingredient_keys ), $ingredient_keys, $ingredient_string_format );

									echo '<li>';
										echo wp_kses_post( $ingre_string );
									echo '</li>';
								}
							}
							echo '</ul>';
							?>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<!-- #dr-page2 -->
	
			<!-- Instructions -->
			<?php if ( isset( $recipe->instructions ) && ! empty( $recipe->instructions ) && 'yes' === $default_print_options['instructions'] ) : ?>
			<div id="dr-page3" class="dr-print-page dr-print-instructions">
				<div class="dr-print-block">
					<div class="dr-pring-block-header">
						<div class="dr-print-block-title">
							<span><?php echo esc_html( $recipe->instruction_title ); ?></span>
						</div>
					</div>
					<?php
					$instruction_count = 1;
							echo '<div class="dr-pring-block-content">';
								echo '<ol>';
					foreach ( $recipe->instructions as $key => $instruct_section ) {

						if ( isset( $instruct_section['sectionTitle'] ) && $instruct_section['sectionTitle'] ) {
								echo '<div class="dr-subtitle">' . esc_html( $instruct_section['sectionTitle'] ) . '</div>';
						}
						if ( isset( $instruct_section['instruction'] ) && ! empty( $instruct_section['instruction'] ) ) {
							foreach ( $instruct_section['instruction'] as $instruct ) {
								$instruction_title = isset( $instruct['instructionTitle'] ) ? $instruct['instructionTitle'] : '';
								$instruction       = isset( $instruct['instruction'] ) ? $instruct['instruction'] : '';
								$instruction_notes = isset( $instruct['instructionNotes'] ) ? $instruct['instructionNotes'] : '';
								$instruction_image = isset( $instruct['image'] ) && ! empty( $instruct['image'] ) ? $instruct['image'] : false;

								echo '<li><span class="instruction-number">' . ( $instruction_count ) . '</span> <div class="dr-instruction">';

								echo esc_html( $instruction_title );
								if ( $instruction_image ) {
									$instruct_image = wp_get_attachment_image( $instruction_image, 'full', false, array( 'class' => 'dr-print-page-image' ) );
									echo wp_kses_post( $instruct_image );
								}
								echo wp_kses_post( $instruction );
								if ( ! empty( $instruction_notes ) ) {
									echo '<div class="dr-list-tips">';
										echo esc_html( $instruction_notes );
									echo '</div></div>';
								}
								echo '</li>';
								++$instruction_count;
							}
						}
					}
								echo '</ol>';
							echo '</div>';
					?>
				</div>
			</div>
			<?php endif; ?>
			<!-- #dr-page3 -->
	
			<!-- Nutrition, Notes and Keywords -->
			<?php if ( 'yes' === $default_print_options['nutrition'] || 'yes' === $default_print_options['notes'] || 'yes' === $default_print_options['keywords'] || $embed_recipe_link ) : ?>
			<div id="dr-page5" class="dr-print-page dr-print-nutrition">
				<?php if ( 'yes' === $default_print_options['nutrition'] ) : ?>
				<div class="dr-print-block dr-wrp-only-nut">
					<?php delicious_nutrition_chart_layout(); ?>
				</div>
				<?php endif; ?>
				<!-- Notes and Keywords -->
				<?php if ( 'yes' === $default_print_options['notes'] || 'yes' === $default_print_options['keywords'] ) : ?>
				<div class="dr-print-block dr-wrap-notes-keywords">
					<?php
					if ( ! empty( $recipe->notes ) && $global_toggles['enable_notes'] && 'yes' === $default_print_options['notes'] ) :
						?>
					<div class="dr-note">
						<div class="dr-print-block-title">
							<span><?php echo esc_html( $global_toggles['notes_lbl'] ); ?></span>
						</div>
						<?php echo wp_kses_post( $recipe->notes ); ?>
					</div>
						<?php
					endif;
					if ( isset( $recipe->keywords ) && ! empty( $recipe->keywords ) && $global_toggles['enable_keywords'] && 'yes' === $default_print_options['keywords'] ) :
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
					?>
				</div>
				<?php endif; ?>

				<!-- Extended Content -->
				<?php
				$recipe_extended_content = isset( $recipe_meta['extendedContent'] ) && $recipe_meta['extendedContent'] ? $recipe_meta['extendedContent'] : '';
				if ( function_exists( 'DEL_RECIPE_PRO' ) && $recipe_extended_content && 'yes' === $default_print_options['extended_content'] ) {
					$blocks = parse_blocks( $recipe_extended_content );

					$output = '';
					foreach ( $blocks as $block ) {
						$output .= do_shortcode( render_block( $block ) );
					}
					echo '<div class="dr-extended-content-content">' . $output . '</div>';
				}
				?>

				<!-- Social Share -->
				<?php
				if ( $display_social_sharing_info && $socials_enabled ) :
					$recipe_share_title = isset( $recipe_global['recipeShareTitle'] ) ? $recipe_global['recipeShareTitle'] : '';
					?>
				<div class="dr-print-cta dr-wrap-social-share">
					<div class="dr-cta-title"><?php echo esc_html( $recipe_share_title ); ?></div>
					<?php if ( isset( $recipe_global['socialShare'] ) && ! empty( $recipe_global['socialShare'] ) && 'yes' === $default_print_options['social_share'] ) : ?>
						<?php
						foreach ( $recipe_global['socialShare'] as $key => $share ) :
							if ( ! isset( $share['enable']['0'] ) || 'yes' !== $share['enable']['0'] ) {
								continue;
							}
							?>
							<?php if ( isset( $share['content'] ) && ! empty( $share['content'] ) ) : ?>
					<div class="dr-share-content">
								<?php echo wp_kses_post( $share['content'] ); ?>
					</div>
					<?php endif; ?>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<?php endif; ?>
	
				<!-- Recipe Link -->
				<?php
				if ( $embed_recipe_link ) :
					$recipe_link_label = isset( $recipe_global['recipeLinkLabel'] ) ? $recipe_global['recipeLinkLabel'] : '';
					?>
				<div class="dr-print-block-footer">
					<b><?php echo esc_html( $recipe_link_label ); ?></b>
					<span>
						<a href="<?php the_permalink(); ?>" target="_blank"><?php the_permalink(); ?></a>
					</span>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<!-- #dr-page5 -->
	
			<div id="dr-page6" class="dr-print-page dr-print-author">
				<?php
					$author_image       = isset( $recipe_global['authorImage'] ) ? $recipe_global['authorImage'] : false;
					$author_name        = isset( $recipe_global['authorName'] ) ? $recipe_global['authorName'] : '';
					$author_subtitle    = isset( $recipe_global['authorSubtitle'] ) ? $recipe_global['authorSubtitle'] : '';
					$author_description = isset( $recipe_global['authorDescription'] ) ? $recipe_global['authorDescription'] : '';

					// Social Profiles.
					$author_social_links = apply_filters( 'delicious_recipes_author_social_links', array( 'facebook', 'instagram', 'pinterest', 'twitter', 'youtube', 'snapchat', 'linkedin' ) );

				?>
	
				<?php
				if ( $embed_author_info && $author_name && 'yes' === $default_print_options['author_bio'] ) :
					?>
				<div class="dr-print-block">
					<div class="dr-wrap-author-profile">
						<div class="dr-pring-block-img-wrap">
							<?php if ( $author_image ) : ?>
							<div class="dr-print-block-img">
								<?php echo wp_kses_post( wp_get_attachment_image( $author_image, 'large', false, array( 'class' => 'dr-print-page-image' ) ) ); ?>
							</div>
							<?php endif; ?>
							<div class="dr-print-block-header">
								<div class="dr-print-block-title">
									<span><?php echo esc_html( $author_name ); ?></span>
								</div>
								<span class="dr-print-block-subtitle"><?php echo esc_html( $author_subtitle ); ?></span>
								<div class="dr-print-block-desc">
									<p><?php echo wp_kses_post( $author_description ); ?></p>
								</div>
							</div>
						</div>
						<ul class="dr-author-social">
							<?php
							foreach ( $author_social_links as $social ) :
								$social_link = isset( $recipe_global[ $social . 'Link' ] ) ? trim( $recipe_global[ $social . 'Link' ], '/\\' ) : false;

								if ( $social_link ) :
									?>
							<li>
								<a href="<?php echo esc_url( $social_link ); ?>" target="_blank" rel="nofollow noopener">
									<img class="dr-print-page-image" src="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ); ?>/assets/images/print-img/<?php echo esc_html( $social ); ?>.png"
										alt="">
									<span class="social-name"><?php echo esc_url( $social_link ); ?>/</span>
								</a>
							</li>
									<?php
									endif;
								endforeach;
							?>
						</ul>
					</div>
				</div>
					<?php
				endif;

				$thankyoumessage = isset( $recipe_global['thankyouMessage'] ) ? $recipe_global['thankyouMessage'] : false;

				if ( $thankyoumessage ) :
					?>
				<div class="dr-print-block-content dr-wrap-thankyou">
					<?php echo wp_kses_post( $thankyoumessage ); ?>
				</div>
					<?php
				endif;

				/**
				 * Action hook for additionals.
				 */
				do_action( 'delicious_recipes_print_additionals' );
				?>
			</div>
		</div>
	</div>
	<?php
	// Enqueue jQuery
	wp_enqueue_script('jquery');
	
	// Enqueue and localize print script
	wp_enqueue_script(
		'delicious-recipes-print', 
		plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/build/printJS.js',
		array('jquery'),
		DELICIOUS_RECIPES_VERSION,
		true
	);

	// Localize script with recipe data
	wp_localize_script(
		'delicious-recipes-print',
		'deliciousRecipesPrint',
		array(
			'recipeId' => $recipe->ID,
			'defaultServings' => $recipe->no_of_servings,
		)
	);

	wp_print_scripts();
	?>
</body>

</html>