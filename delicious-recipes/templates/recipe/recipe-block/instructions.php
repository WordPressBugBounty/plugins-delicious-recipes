<?php
/**
 * Instructions template.
 *
 * @package Delicious_Recipes
 */

global $recipe;
$global_settings      = delicious_recipes_get_global_settings();
$recipe_instructions  = isset( $recipe->instructions ) ? $recipe->instructions : array();
$instruction_title    = isset( $recipe->instruction_title ) ? $recipe->instruction_title : __( 'Instructions', 'delicious-recipes' );
$enable_video_gallery = isset( $recipe->enable_video_gallery ) ? $recipe->enable_video_gallery : false;
$video_gallery_vids   = isset( $recipe->video_gallery ) ? $recipe->video_gallery : array();
$recipe_settings      = get_post_meta( $recipe->ID, 'delicious_recipes_metadata', true );

$license_validity_bool = false;
if ( function_exists( 'DEL_RECIPE_PRO' ) && version_compare( DELICIOUS_RECIPES_PRO_VERSION, '2.2.2', '>=' ) ) {
	$license_validity_bool = delicious_recipe_pro_check_license_status();
}

$enable_multiple_images = false;
$additional_images      = array();
if ( $license_validity_bool ) {
	$enable_multiple_images = isset( $global_settings['enableMultipleInstructionImages'] ) && is_array( $global_settings['enableMultipleInstructionImages'] ) && ! empty( $global_settings['enableMultipleInstructionImages'][0] ) && 'yes' === $global_settings['enableMultipleInstructionImages'][0];
}

// Get global toggles.
$global_toggles = delicious_recipes_get_global_toggles_and_labels();

if ( ! empty( $recipe_instructions ) ) :
	?>
	<div class="dr-instructions">
		<div class="dr-instrc-title-wrap">
			<h2 class="dr-title"><?php echo esc_html( $instruction_title ); ?></h2>
			<?php if ( ! empty( $video_gallery_vids ) && $global_toggles['enable_video'] ) : ?>
			<div class="dr-instructions-toggle">
				<span class="dr-inst-label"><?php echo esc_html( $global_toggles['video_lbl'] ); ?></span>
				<button data-target=".dr-instruction-video-<?php echo esc_attr( $recipe->ID ); ?>" class="dr-switch-btn dr-video-toggle" data-switch="on" data-switch-on="<?php echo esc_attr__( 'ON', 'delicious-recipes' ); ?>" data-switch-off="<?php echo esc_attr__( 'OFF', 'delicious-recipes' ); ?>"><?php echo esc_html__( 'ON', 'delicious-recipes' ); ?></button>
			</div>
			<?php endif; ?>
		</div>
		<?php
		foreach ( $recipe_instructions as $sec_key => $intruct_section ) :
			if ( $intruct_section['sectionTitle'] ) {
				echo '<h3>' . esc_html( $intruct_section['sectionTitle'] ) . '</h3>';
			}
			if ( isset( $intruct_section['instruction'] ) && ! empty( $intruct_section['instruction'] ) ) :
				?>
				<ol class="dr-ordered-list">
					<?php
					foreach ( $intruct_section['instruction'] as $inst_key => $instruct ) :
						$rand_key          = rand( 10000, 100000 );
						$instruction_title = isset( $instruct['instructionTitle'] ) ? $instruct['instructionTitle'] : '';
						$instruction       = isset( $instruct['instruction'] ) ? apply_filters( 'wp_delicious_single_instruction', $instruct['instruction'] ) : '';
						$instruction_notes = isset( $instruct['instructionNotes'] ) ? $instruct['instructionNotes'] : '';
						$instruction_image = isset( $instruct['image'] ) && ! empty( $instruct['image'] ) ? $instruct['image'] : false;
						$instruction_video = isset( $instruct['videoURL'] ) && ! empty( $instruct['videoURL'] ) ? $instruct['videoURL'] : false;
						?>
						<li>
							<?php if ( $instruction_title ) : ?>
								<h4>
									<?php echo esc_html( $instruction_title ); ?>
								</h4>
							<?php endif; ?>
							<div class="dr-instruction">
								<?php echo wp_kses_post( do_shortcode( $instruction ) ); ?>
							</div>
							<?php
							$all_images = array();

							// Add the main instruction image to the array.
							if ( $instruction_image ) {
								$all_images[] = array(
									'id'  => $instruction_image,
									'url' => wp_get_attachment_url( $instruction_image, 'full' ),
								);
							}

							// Add additional images to the array.
							if ( $license_validity_bool && $enable_multiple_images ) {
								$additional_images = isset( $instruct['additionalImages'] ) ? $instruct['additionalImages'] : array();
								if ( ! empty( $additional_images ) ) {
									foreach ( $additional_images as $key => $value ) {
										if ( $value['instructionIndex'] === $sec_key && $value['instructionId'] === $inst_key ) {
											if ( ! empty( $value['additionalImages'] ) ) {
												foreach ( $value['additionalImages'] as $image ) {
													$all_images[] = array(
														'id' => $image['id'],
														'url' => wp_get_attachment_url( $image['id'], 'full' ),
													);
												}
											}
										}
									}
								}
							}
							if ( ! empty( $all_images ) ) :
								?>
							<div class="additional-images">
								<?php
								// Display the images.
								$total_images = count( $all_images );
								for ( $i = 0; $i < min( 3, $total_images ); $i++ ) {
									$image                = $all_images[ $i ];
									$instruct_image_small = esc_url( $image['url'] );
									echo '<a data-fslightbox="gallery-' . esc_attr( $sec_key ) . '-' . esc_attr( $inst_key ) . '" class="dr-lg-media-popup" href="' . esc_url( $instruct_image_small ) . '">
											<img src="' . esc_url( $instruct_image_small ) . '" />
										</a>';
								}

								// Add hidden images for fslightbox for images after the first 3.
								if ( $total_images > 3 ) {
									for ( $i = 3; $i < $total_images; $i++ ) {
										$image                = $all_images[ $i ];
										$instruct_image_small = esc_url( $image['url'] );
										echo '<a data-fslightbox="gallery-' . esc_attr( $sec_key ) . '-' . esc_attr( $inst_key ) . '" href="' . esc_url( $instruct_image_small ) . '" style="display:none;"></a>';
									}

									// Display the remaining images count box without an href.
									$remaining_images = $total_images - 3;
									echo '<div class="wpd-fslightbox-images-box" id="remaining-images-' . esc_attr( $sec_key ) . '-' . esc_attr( $inst_key ) . '" data-sec-key="' . esc_attr( $sec_key ) . '">
											+' . esc_html( $remaining_images ) . ' photos
										</div>';
								}
								?>
							</div>
							<?php endif; ?>
							<?php if ( ! empty( $instruction_notes ) ) : ?>
								<div class="dr-list-tips">
									<?php echo esc_html( $instruction_notes ); ?>
								</div>
							<?php endif; ?>
							<?php
							if ( $instruction_video && $global_toggles['enable_video'] ) :
								$instruction_video_data = delicious_recipes_parse_videos( $instruction_video );
								$instruction_video_attr = isset( $instruction_video_data['0'] ) && ! empty( $instruction_video_data['0'] ) ? $instruction_video_data['0'] : array();
								$vid_url                = '';
								$image_url              = '';
								if ( ! empty( $instruction_video_attr ) ) :
									if ( 'youtube' === $instruction_video_attr['type'] ) {
										$vid_url   = 'https://www.youtube.com/embed/' . $instruction_video_attr['id'];
										$image_url = $instruction_video_attr['thumbnail'];
									} elseif ( 'vimeo' === $instruction_video_attr['type'] ) {
										$vid_url   = 'https://player.vimeo.com/video/' . $instruction_video_attr['id'];
										$image_url = $instruction_video_attr['fullsize'];
									}
									?>
									<div class="dr-instructions-video dr-instruction-video-<?php echo esc_attr( $recipe->ID ); ?>">
										<div class="dr-vdo-thumbnail">
											<?php
											if ( isset( $instruction_video_attr['url'] ) && $instruction_video_attr['url'] ) {
												?>
												<img class="avoid-lazy-load" src="<?php echo esc_url( $image_url ); ?>">
												<?php if ( 'vimeo' === $instruction_video_attr['type'] ) : ?>
													<a data-fslightbox="custom-video" class="dr-instruction-videopop dr-lg-media-popup" href="#<?php echo esc_attr( $instruction_video_attr['id'] ); ?>" data-iframe="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="18.095" height="20.894" viewBox="0 0 18.095 20.894">
															<path id="Path 26366" data-name="Path 26366" d="M107.992,76.108l18.095,10.447L107.992,97Z" transform="translate(-107.992 -76.108)" fill="#fff" />
														</svg>
													</a>
												<?php else : ?>
													<a data-fslightbox="<?php echo esc_url( $vid_url ); ?>" class="dr-instruction-videopop dr-lg-media-popup" href="<?php echo esc_url( $vid_url ); ?>" data-iframe="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="18.095" height="20.894" viewBox="0 0 18.095 20.894">
															<path id="Path 26366" data-name="Path 26366" d="M107.992,76.108l18.095,10.447L107.992,97Z" transform="translate(-107.992 -76.108)" fill="#fff" />
														</svg>
													</a>
												<?php endif; ?>
												<?php
											}
											?>
										</div>
										<?php if ( 'vimeo' === $instruction_video_attr['type'] ) : ?>
											<iframe
												src="<?php echo esc_url( $vid_url ); ?>"
												id="<?php echo esc_attr( $instruction_video_attr['id'] ); ?>"
												frameBorder="0"
												width="1920px"
												height="1080px"
												class="fslightbox-source"
												allow="autoplay; fullscreen"
												allowFullScreen
											></iframe>
										<?php endif; ?>
									</div>

									<?php
								endif;
							endif;
							?>
							<?php if ( $global_toggles['enable_mark_as_complete'] ) : ?>
								<div class="dr-inst-mark-read">
									<input type="checkbox" id="dr-instruct-<?php echo esc_attr( $inst_key ); ?>-<?php echo esc_attr( $rand_key ); ?>">
									<label for="dr-instruct-<?php echo esc_attr( $inst_key ); ?>-<?php echo esc_attr( $rand_key ); ?>"><?php echo esc_html( $global_toggles['mark_as_complete_lbl'] ); ?></label>
								</div>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ol>
				<?php
			endif;
		endforeach;

		?>
	</div>
	<?php
endif;
if ( ! empty( $video_gallery_vids ) && $global_toggles['enable_video'] ) :
	$vid_url   = '';
	$image_url = '';
	?>
	<div id="dr-video-gallery-<?php echo esc_attr( $recipe->ID ); ?>" class="dr-video-gallery">
		<!-- <div class="dr-instrc-title-wrap"> -->
			<?php if ( ! empty( $video_gallery_vids ) && $global_toggles['enable_video'] && empty( $recipe_instructions ) ) : ?>
			<div class="dr-instructions-toggle">
				<span class="dr-inst-label"><?php echo esc_html( $global_toggles['video_lbl'] ); ?></span>
				<button data-target=".dr-instruction-video-<?php echo esc_attr( $recipe->ID ); ?>" class="dr-switch-btn dr-video-toggle" data-switch="on" data-switch-on="<?php echo esc_attr__( 'ON', 'delicious-recipes' ); ?>" data-switch-off="<?php echo esc_attr__( 'OFF', 'delicious-recipes' ); ?>"><?php echo esc_html__( 'ON', 'delicious-recipes' ); ?></button>
			</div>
			<?php endif; ?>
		<!-- </div> -->
		<?php
		foreach ( $video_gallery_vids as $key => $video ) :
			if ( 'youtube' === $video['vidType'] ) {
				$vid_url   = 'https://www.youtube.com/embed/' . $video['vidID'];
				$image_url = 'https:' . $video['vidThumb'];
			} elseif ( 'vimeo' === $video['vidType'] ) {
				$vid_src   = 'https://player.vimeo.com/video/' . $video['vidID'];
				$vid_url   = '#' . $video['vidID'];
				$image_url = $video['vidThumb'];
			}
			?>
			<div class="dr-instructions-video dr-instruction-video-<?php echo esc_attr( $recipe->ID ); ?>">
				<div class="dr-vdo-thumbnail">
					<img class="avoid-lazy-load" src="<?php echo esc_url( $image_url ); ?>">
					<a data-fslightbox="custom-video" class="dr-instruction-videopop dr-lg-media-popup" href="<?php echo esc_url( $vid_url ); ?>" data-iframe="true">
						<svg xmlns="http://www.w3.org/2000/svg" width="18.095" height="20.894" viewBox="0 0 18.095 20.894">
							<path id="Path_26366" data-name="Path 26366" d="M107.992,76.108l18.095,10.447L107.992,97Z" transform="translate(-107.992 -76.108)" fill="#fff" />
						</svg>
					</a>
				</div>
			</div>
			<?php
		endforeach;
		foreach ( $video_gallery_vids as $key => $video ) :
			if ( 'vimeo' === $video['vidType'] ) {
				$vid_src = 'https://player.vimeo.com/video/' . $video['vidID'];
				$vid_url = $video['vidID'];
				// get vimeo video thumbnail.
				$hash  = unserialize( file_get_contents( "https://vimeo.com/api/v2/video/{$vid_url}.php" ) );
				$thumb = $hash[0]['thumbnail_large'];
				?>
				<iframe
					src="<?php echo esc_url( $vid_src ); ?>"
					id="<?php echo esc_attr( $vid_url ); ?>"
					frameBorder="0"
					width="1920px"
					height="1080px"
					class="fslightbox-source"
					allow="autoplay; fullscreen"
					allowFullScreen
				></iframe>
				<?php
			}
		endforeach;
		?>
	</div>
	<?php
endif;
