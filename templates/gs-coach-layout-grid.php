<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Grid
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-grid.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.3
 */

global $gs_coach_loop;

$gs_row_classes = ['gs-roow clearfix gs_coach'];

if ( $_drawer_enabled ) $gs_row_classes[] = 'gstm-gridder gstm-gridder-' . $drawer_style;

?>

<!-- Container for Coaches -->
<div class="gs-containeer cbp-so-scroller">
	
	<div class="<?php echo esc_attr( implode(' ', $gs_row_classes) ); ?>">
	
		<?php if ( $gs_coach_loop->have_posts() ):

			if ( $_drawer_enabled ) echo '<div class="gridder">';

			do_action( 'gs_coach_before_coaches' );

			while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

			$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

			$classes = ['single-member-div', get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile ) ];

			if ( $gs_coach_link_type == 'popup' ) $classes[] = 'single-member-pop';
			if ( $_drawer_enabled ) $classes[] = 'gridder-list';
			if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';

			$single_item_attr = '';
			if ( $_drawer_enabled ) $single_item_attr = sprintf( 'data-griddercontent="#gs-coach-drawer-%s-%s"', get_the_ID(), $id );

			?>

			<!-- Start single member -->
			<div class="<?php echo esc_attr( implode(' ', $classes) ); ?>" <?php echo wp_kses_post( $single_item_attr ); ?>>
				
				<!-- Sehema & Single member wrapper -->
				<div class="single-member--wrapper" itemscope itemtype="http://schema.org/Organization">

					<!-- Single member thumbnail and more -->
					<div class="single-member cbp-so-side cbp-so-side-left">

						<?php do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>

						<div class="gs-grey">

							<!-- Ribbon -->
							<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>

							<!-- Coach Image -->
							<?php echo member_thumbnail_with_link( $id, $gs_coach_thumbnail_sizes, $gs_coach_name_is_linked == 'on', $gs_coach_link_type, 'gs_coach_image__wrapper' ); ?>
							<?php do_action( 'gs_coach_after_member_thumbnail' ); ?>

						</div>

						<div class="info-card">

							<!-- Single member name -->
							<?php if ( 'on' ==  $gs_coach_name ): ?>
								<?php member_name( $id, true, $gs_coach_name_is_linked == 'on', $gs_coach_link_type ); ?>
								<?php do_action( 'gs_coach_after_member_name' ); ?>
							<?php endif; ?>
							
							<!-- Single member designation -->
							<?php if ( !empty( $designation ) && 'on' == $gs_coach_role ): ?>
								<div class="gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
								<?php do_action( 'gs_coach_after_member_designation' ); ?>
							<?php endif; ?>

						</div>

						<?php do_action( 'gs_coach_after_member_content' ); ?>
						
					</div>

				</div>

				<!-- Popup -->
				<?php include Template_Loader::locate_template( 'popups/gs-coach-layout-popup.php' ); ?>

			</div>

		<?php endwhile; ?>

		<?php do_action( 'gs_coach_after_coaches' );

		if ( $_drawer_enabled ) echo '</div>'; ?>

		<?php else: ?>

			<!--es not found - Load no-team-member template -->
			<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-no-coach-member.php' ); ?>

		<?php endif; ?>

		<!-- Drawer Contents -->
		<?php include Template_Loader::locate_template( 'drawers/gs-coach-layout-drawer.php' ); ?>

	</div>

	<!-- Pagination -->
	<?php if ( 'on' == $gs_coach_pagination ) : ?>
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-pagination.php' ); ?>
	<?php endif; ?>

</div>

<!-- Panel -->
<?php include Template_Loader::locate_template( 'panels/gs-coach-layout-panel.php' ); ?>