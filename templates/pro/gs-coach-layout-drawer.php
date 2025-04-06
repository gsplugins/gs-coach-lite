<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Drawer
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-drawer.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.4
 */

global $gs_coach_loop;

?>

<!-- Container for Coaches -->
<div class="gs-containeer cbp-so-scroller">
	
	<div class="gs-roow clearfix gs_coach gscoach-gridder gscoach-gridder-default">

		<?php if ( $gs_coach_loop->have_posts() ):

			do_action( 'gs_coach_before_coaches' ); ?>

			<div class="gridder">

				<?php while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

					$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

					$classes = ['gridder-list gs-filter-single-item single-member-div', get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile ) ];
					if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';

				?>
				
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-griddercontent="#gs-coach-drawer-<?php echo get_the_id(); ?>-<?php echo $id; ?>" itemscope itemtype="http://schema.org/Organization">
					
					<div class="single-member--wrapper cbp-so-side cbp-so-side-left">
						<div class="overlay-area single-member">

							<?php do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>
							
							<!-- Ribbon -->
							<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>

							<!-- Coach Image -->
							<div class="gs_coach_image__wrapper">
								<?php member_thumbnail( $gs_coach_thumbnail_sizes, true ); ?>
							</div>
							<?php do_action( 'gs_coach_after_member_thumbnail' ); ?>
							
							<!-- Overlay Contents -->
							<div class="overlay">
								<?php member_name( $id, true, false, '', 'h2', 'title', true ); ?>
								<?php do_action( 'gs_coach_after_member_name' ); ?>

								<p class="desig"><?php echo wp_kses_post($designation); ?></p>
								<?php do_action( 'gs_coach_after_member_designation' ); ?>
							</div>

							<?php do_action( 'gs_coach_after_member_content' ); ?>

						</div>
					</div>

				</div>
		
				<?php endwhile; ?>

			</div>

			<?php do_action( 'gs_coach_after_coaches' ); ?>

		<?php else: ?>

			<!--es not found - Load no-team-member template -->
			<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-no-team-member.php' ); ?>

		<?php endif; ?>

		<!-- Drawer Contents -->
		<?php $_drawer_enabled = true; ?>
		<?php include Template_Loader::locate_template( 'drawers/gs-coach-layout-drawer.php' ); ?>

	</div>

	<!-- Pagination -->
	<?php if ( 'on' == $gs_coach_pagination ) : ?>
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-pagination.php' ); ?>
	<?php endif; ?>

</div>