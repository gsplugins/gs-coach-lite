<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Slider
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-slider.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.3
 */

global $gs_coach_loop;

?>

<!-- Container for Coaches -->
<div class="gs-containeer">
	
	<div class="gs-roow clearfix">

		<?php if ( $gs_coach_loop->have_posts() ):

			do_action( 'gs_coach_before_coaches' );

			$gs_row_classes = ['gs_coach slider gs-col-md-12 owl-carousel owl-theme'];
			$carousel_params = get_carousel_data( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile, false );
			
			if ( $carousel_navs_enabled ) {
				$gs_row_classes[] = 'carousel-has-navs';
				$gs_row_classes[] = 'carousel-navs--' . $carousel_navs_style;
			}
			if ( $carousel_dots_enabled ) {
				$gs_row_classes[] = 'carousel-has-dots';
				$gs_row_classes[] = 'carousel-dots--' . $carousel_dots_style;
			}

			?>

			<div class="<?php echo esc_attr( implode(' ', $gs_row_classes) ); ?>" <?php if ( !empty($carousel_params) ) echo wp_kses_post( $carousel_params ); ?>>

				<?php while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

					$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

					$classes = ['single-member--wrapper single-member-div'];
		
					if ( $gs_member_link_type == 'popup' ) $classes[] = 'single-member-pop';

					?>
					
					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" itemscope itemtype="http://schema.org/Organization">

						<?php do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>

						<div class="single-member">

							<!-- Ribbon -->
							<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>

							<!-- Coach Image -->
							<div class="gs_coach_image__wrapper">
								<?php member_thumbnail( $gs_member_thumbnail_sizes, true ); ?>
							</div>
							<?php do_action( 'gs_coach_after_member_thumbnail' ); ?>

							<div class="single-mem-desc-social flex-align-justify-center">

								<div class="single-mem-desc-social--inner gs_member_info">

									<!-- Description -->
									<?php if ( 'on' ==  $gs_member_details ) : ?>

										<?php if ( 'on' === $gs_desc_allow_html ) : ?>
											<div class="gs-member-desc" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
										<?php else : ?>
											<p class="gs-member-desc" itemprop="description"><?php member_description( $id, $gs_tm_details_contl, true, true, $gs_member_name_is_linked == 'on', $gs_member_link_type ); ?></p>
										<?php endif; ?>
										
										<?php do_action( 'gs_coach_after_member_details' ); ?>
									<?php endif; ?>
	
									<!-- Social Links -->
									<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>

								</div>

							</div>

						</div>

						<!-- Single member name -->
						<?php if ( 'on' ==  $gs_member_name ): ?>
							<?php member_name( $id, true, $gs_member_name_is_linked == 'on', $gs_member_link_type ); ?>
							<?php do_action( 'gs_coach_after_member_name' ); ?>
						<?php endif; ?>

						<!-- Single member designation -->
						<?php if ( !empty( $designation ) && 'on' == $gs_member_role ): ?>
							<div class="gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
							<?php do_action( 'gs_coach_after_member_designation' ); ?>
						<?php endif; ?>

						<?php do_action( 'gs_coach_after_member_content' ); ?>

						<!-- Popup -->
						<?php include Template_Loader::locate_template( 'popups/gs-coach-layout-popup.php' ); ?>

					</div>

				<?php endwhile; ?>

			</div>

			<?php do_action( 'gs_coach_after_coaches' ); ?>

		<?php else: ?>

			<!--es not found - Load no-team-member template -->
			<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-no-team-member.php' ); ?>

		<?php endif; ?>

	</div>

</div>