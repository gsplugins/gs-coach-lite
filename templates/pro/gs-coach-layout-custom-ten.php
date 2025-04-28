<?php

namespace GSCOACH;
/**
 * GS Coach - Layout 10
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-custom-ten.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.4
 */

global $gs_coach_loop;

?>

<!-- Container for Coaches -->
<div class="gs-containeer cbp-so-scroller">
	
	<div class="gs-roow gs-custom-layout-ten clearfix gs_coach">

		<?php if ( $gs_coach_loop->have_posts() ):

			do_action( 'gs_coach_before_coaches' );

			while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

			$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

			$classes = ['single-coach-div', 'gs-single-coach', get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile ) ];

			if ( $gs_coach_link_type == 'popup' ) $classes[] = 'single-coach-pop';
			if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';

			?>

			<!-- Start single coach -->
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

				<!-- Sehema & Single coach wrapper -->
				<div class="single-coach--wrapper" itemscope itemtype="http://schema.org/Organization">

					<!-- Single coach thumbnail and more -->
					<div class="single-coach cbp-so-side cbp-so-side-left">

						<?php do_action( 'gs_coach_before_coach_content', $gs_coach_theme ); ?>
						
						<!-- Coach Image -->
						<div class="gs_coach_image__wrapper">
							<?php coach_thumbnail( $gs_coach_thumbnail_sizes, true ); ?>

							 <!-- Ribbon -->
							 <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>

						</div>
						<?php do_action( 'gs_coach_after_coach_thumbnail' ); ?>
						
					</div>

					<!-- gs coach bottom -->
                    <div class="gs-coach-bottom" >

                        <!-- Single coach name -->
                        <?php if ( 'on' ==  $gs_coach_name ): ?>
                            <?php coach_name( $id, true, $gs_coach_name_is_linked == 'on', $gs_coach_link_type ); ?>
                            <?php do_action( 'gs_coach_after_coach_name' ); ?>
                        <?php endif; ?>
                        
                        <!-- Single coach designation -->
                        <?php if ( !empty( $designation ) && 'on' == $gs_coach_role ): ?>
                            <div class="gs-coach-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
                            <?php do_action( 'gs_coach_after_coach_designation' ); ?>
                        <?php endif; ?>

                    </div>

					<div class="gs-coach-ten-circle"></div>

				</div>
				
				<!-- Popup -->
				<?php include Template_Loader::locate_template( 'popups/gs-coach-layout-popup.php' ); ?>

			</div>

		<?php endwhile; ?>

		<?php do_action( 'gs_coach_after_coaches' ); ?>

		<?php else: ?>

			<!--es not found - Load no-team-coach template -->
			<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-no-team-coach.php' ); ?>

		<?php endif; ?>

	</div>

	<!-- Pagination -->
	<?php if ( 'on' == $gs_coach_pagination ) : ?>
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-pagination.php' ); ?>
	<?php endif; ?>

</div>