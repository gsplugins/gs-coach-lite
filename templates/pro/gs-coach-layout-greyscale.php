<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Grey Scale
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-greyscale.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.4
 */

global $gs_coach_loop;

?>

<!-- Container for Coaches -->
<div class="gs-containeer cbp-so-scroller">
	
	<div class="gs-roow clearfix gs_coach">

		<?php if ( $gs_coach_loop->have_posts() ):

			do_action( 'gs_coach_before_coaches' );

			while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

			$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

			$classes = ['single-coach-div', get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile ) ];

			if ( $gs_coach_link_type == 'popup' ) $classes[] = 'single-coach-pop';
			if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';

			?>
			
			<!-- Start single coach -->
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			    
				<!-- Sehema & Single coach wrapper -->
				<div class="single-coach--wrapper" itemscope itemtype="http://schema.org/Organization">
					<div class="single-coach cbp-so-side cbp-so-side-left">

						<?php do_action( 'gs_coach_before_coach_content', $gs_coach_theme ); ?>

						<div class="img-area gs-grey">

							<!-- Ribbon -->
							<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>
							
							<!-- Coach Image -->
							<?php echo coach_thumbnail_with_link( $id, $gs_coach_thumbnail_sizes, $gs_coach_name_is_linked == 'on', $gs_coach_link_type, $extra_link_class = 'gs_coach_image__wrapper' ); ?>

							<?php do_action( 'gs_coach_after_coach_thumbnail' ); ?>

						</div>

					</div>

					<div class="single-coach--details">
							
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
							
						<!-- Social Links -->
						<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>
						
						<!-- Description -->
						<?php if ( 'on' ==  $gs_coach_details ) : ?>

							<?php if ( 'on' === $gs_desc_allow_html ) : ?>
								<div class="gs-coach-desc" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
							<?php else : ?>
								<p class="gs-coach-desc" itemprop="description"><?php coach_description( $id, $gs_tm_details_contl, true, true, $gs_coach_name_is_linked == 'on', $gs_coach_link_type ); ?></p>
							<?php endif; ?>
							
							<?php do_action( 'gs_coach_after_coach_details' ); ?>
						<?php endif; ?>

						<?php do_action( 'gs_coach_after_coach_content' ); ?>
			        
			        </div>
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