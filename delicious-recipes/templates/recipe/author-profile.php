<?php
/**
 * Recipe author block.
 *
 * @package Delicious_Recipes/Templates
 */

$global_settings = delicious_recipes_get_global_settings();

$author_profile = isset( $global_settings['enableAuthorProfile']['0'] ) && 'yes' === $global_settings['enableAuthorProfile']['0'] ? true : false;

if ( ! $author_profile ) {
	return;
}

$author_name        = isset( $global_settings['authorName'] ) && ! empty( $global_settings['authorName'] ) ? $global_settings['authorName'] : false;
$author_subtitle    = isset( $global_settings['authorSubtitle'] ) && ! empty( $global_settings['authorSubtitle'] ) ? $global_settings['authorSubtitle'] : false;
$author_description = isset( $global_settings['authorDescription'] ) && ! empty( $global_settings['authorDescription'] ) ? $global_settings['authorDescription'] : false;
$author_image       = isset( $global_settings['authorImage'] ) && ! empty( $global_settings['authorImage'] ) ? $global_settings['authorImage'] : false;

// Social Links.
$facebook_link  = isset( $global_settings['facebookLink'] ) && ! empty( $global_settings['facebookLink'] ) ? trim( $global_settings['facebookLink'], '/\\' ) : false;
$instagram_link = isset( $global_settings['instagramLink'] ) && ! empty( $global_settings['instagramLink'] ) ? trim( $global_settings['instagramLink'], '/\\' ) : false;
$pinterest_link = isset( $global_settings['pinterestLink'] ) && ! empty( $global_settings['pinterestLink'] ) ? trim( $global_settings['pinterestLink'], '/\\' ) : false;
$twitter_link   = isset( $global_settings['twitterLink'] ) && ! empty( $global_settings['twitterLink'] ) ? trim( $global_settings['twitterLink'], '/\\' ) : false;
$youtube_link   = isset( $global_settings['youtubeLink'] ) && ! empty( $global_settings['youtubeLink'] ) ? trim( $global_settings['youtubeLink'], '/\\' ) : false;
$snapchat_link  = isset( $global_settings['snapchatLink'] ) && ! empty( $global_settings['snapchatLink'] ) ? trim( $global_settings['snapchatLink'], '/\\' ) : false;
$linkedin_link  = isset( $global_settings['linkedinLink'] ) && ! empty( $global_settings['linkedinLink'] ) ? trim( $global_settings['linkedinLink'], '/\\' ) : false;

if ( empty( $author_name ) && empty( $author_image ) && empty( $author_description ) ) {
	return;
}
?>
<div class="author-block">
	<div class="author-img-wrap">
	<?php if ( $author_image ) : ?>
		<figure class="author-img">
			<?php echo wp_get_attachment_image( $author_image ); ?>
		</figure>
	<?php endif; ?>
			<?php
			if ( $author_name ) :
				?>
						<h3 class="author-name"><?php echo esc_html( $author_name ); ?></h3>
					<?php
				endif;
			?>
			<?php if ( $author_subtitle ) : ?>
				<span class="author-subtitle">
					<?php echo esc_html( $author_subtitle ); ?>
				</span>
			<?php endif; ?>
		<div class="author-social">
			<ul class="social-networks">
				<?php if ( $youtube_link ) : ?>
					<li class="youtube">
						<a target="_blank" href="<?php echo esc_url( $youtube_link ); ?>" rel="nofollow noopener"><i class="fab fa-youtube"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( $facebook_link ) : ?>
					<li class="facebook">
						<a target="_blank" href="<?php echo esc_url( $facebook_link ); ?>" rel="nofollow noopener"><i class="fab fa-facebook-f"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( $instagram_link ) : ?>
					<li class="instagram">
						<a target="_blank" href="<?php echo esc_url( $instagram_link ); ?>" rel="nofollow noopener"><i class="fab fa-instagram"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( $pinterest_link ) : ?>
					<li class="pinterest">
						<a target="_blank" href="<?php echo esc_url( $pinterest_link ); ?>" rel="nofollow noopener"><i class="fab fa-pinterest-p"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( $twitter_link ) : ?>
					<li class="twitter">
						<a target="_blank" href="<?php echo esc_url( $twitter_link ); ?>" rel="nofollow noopener"><i class="fab fa-twitter"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( $snapchat_link ) : ?>
					<li class="snapchat">
						<a target="_blank" href="<?php echo esc_url( $snapchat_link ); ?>" rel="nofollow noopener"><i class="fab fa-snapchat"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( $linkedin_link ) : ?>
					<li class="linkedin">
						<a target="_blank" href="<?php echo esc_url( $linkedin_link ); ?>" rel="nofollow noopener"><i class="fab fa-linkedin"></i></a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
	<?php if ( $author_description ) : ?>
		<div class="author-desc">
			<?php echo wp_kses_post( $author_description ); ?>
		</div>
	<?php endif; ?>
</div>

<?php
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */