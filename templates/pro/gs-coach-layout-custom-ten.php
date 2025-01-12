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

<!-- Container for Coach members -->
<div class="gs-containeer cbp-so-scroller">
	
	<div class="gs-roow gs-custom-layout-ten clearfix gs_coach">

		<?php if ( $gs_coach_loop->have_posts() ):

			do_action( 'gs_coach_before_coaches' );

			while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

			$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

			$classes = ['single-member-div', 'gs-single-member', get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile ) ];

			if ( $gs_member_link_type == 'popup' ) $classes[] = 'single-member-pop';
			if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';

			?>

			<!-- Start single member -->
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

				<!-- Sehema & Single member wrapper -->
				<div class="single-member--wrapper" itemscope itemtype="http://schema.org/Organization">

					<!-- Single member thumbnail and more -->
					<div class="single-member cbp-so-side cbp-so-side-left">

						<?php do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>
						
						<!-- Coach Image -->
						<div class="gs_coach_image__wrapper">
							<?php member_thumbnail( $gs_member_thumbnail_sizes, true ); ?>
						</div>
						<?php do_action( 'gs_coach_after_member_thumbnail' ); ?>
						
					</div>

                    <div class="gs-coach-bottom" >

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

                    </div>

					

				</div>
				
				<!-- Popup -->
				<?php include Template_Loader::locate_template( 'popups/gs-coach-layout-popup.php' ); ?>

			</div>

		<?php endwhile; ?>

		<?php do_action( 'gs_coach_after_coaches' ); ?>

		<?php else: ?>

			<!--es not found - Load no-team-member template -->
			<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-no-team-member.php' ); ?>

		<?php endif; ?>

	</div>

	<!-- Pagination -->
	<?php if ( 'on' == $gs_member_pagination ) : ?>
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-pagination.php' ); ?>
	<?php endif; ?>

</div>