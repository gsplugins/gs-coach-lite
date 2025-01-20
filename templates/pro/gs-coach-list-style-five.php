<?php

namespace GSCOACH;
/**
 * GS Coach - Layout One
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-default-1.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.2
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
			$ribon = get_post_meta( get_the_id(), '_gs_ribon', true );
			$cell = get_post_meta( get_the_id(), '_gscoach_contact', true );

			$classes = ['single-member-div', get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile ) ];

			if ( $gs_coach_link_type == 'popup' ) $classes[] = 'single-member-pop';
			if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';

			?>

			<!-- Start single member -->
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

				<!-- Start single member -->
				<div class="single-member" itemscope itemtype="http://schema.org/Organization">
					
					<!-- Sehema & Single member wrapper -->
					<div class="single-member--wrapper" itemscope itemtype="http://schema.org/Organization">

						<?php do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>
							
						<!-- Coach Image -->
						<div class="gs_coach_image__wrapper">
							<?php member_thumbnail( $gs_coach_thumbnail_sizes, true ); ?>
						</div>

						<div class="gs_coach_info">
							
							<!-- Member Name -->
							<?php member_name( $id, true, $gs_coach_name_is_linked == 'on', $gs_coach_link_type ); ?>
							<?php do_action( 'gs_coach_after_member_name' ); ?>

							<!-- Member Designation -->
							<div class="gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
							<?php do_action( 'gs_coach_after_member_designation' ); ?>

							<!-- Description -->
							<?php if ( 'on' ==  $gs_coach_details ) : ?>

								<?php if ( 'on' === $gs_desc_allow_html ) : ?>
									<div class="gs-member-desc" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
								<?php else : ?>
									<p class="gs-member-desc" itemprop="description"><?php member_description( $id, $gs_tm_details_contl, true, true, $gs_coach_name_is_linked == 'on', $gs_coach_link_type ); ?></p>
								<?php endif; ?>
								
								<?php do_action( 'gs_coach_after_member_details' ); ?>
							<?php endif; ?>

							<!-- Social Links -->
							<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>
							
						</div>

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
	<?php if ( 'on' == $gs_coach_pagination ) : ?>
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-pagination.php' ); ?>
	<?php endif; ?>

</div>

<!-- Panel -->
<?php include Template_Loader::locate_template( 'panels/gs-coach-layout-panel.php' ); ?>