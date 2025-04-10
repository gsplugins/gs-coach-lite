<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Table
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-table.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.2
 */

global $gs_coach_loop;

?>

<!-- Container for Coaches -->
<div class="gs-containeer">
	
	<div class="gs_coach">
		
		<?php if ( $gs_coach_loop->have_posts() ): ?>
			
			<?php do_action( 'gs_coach_before_coaches' ); ?>

			<div class="gs-coach-table">

				<div class="gs-coach-table-row gsc-table-head">

					<?php do_action( 'gs_coach_before_coach_content_table_heads' ); ?>

					<div class="gs-coach-table-cell"><?php _e( 'Image', 'gscoach' ); ?></div>
					<div class="gs-coach-table-cell"><?php _e( 'Name', 'gscoach' ); ?></div>
					<div class="gs-coach-table-cell"><?php _e( 'Position', 'gscoach' ); ?></div>
					<div class="gs-coach-table-cell"><?php _e( 'Description', 'gscoach' ); ?></div>

					<?php if ( 'on' == $gs_coach_connect ) : ?>
						<div class="gs-coach-table-cell"><?php _e( 'Social Links', 'gscoach' ); ?></div>
					<?php endif; ?>

					<?php do_action( 'gs_coach_after_coach_content_table_heads' ); ?>

				</div>

				<?php while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

					$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );
					$ribon = get_post_meta( get_the_id(), '_gs_ribon', true );

					$classes = ['gs-coach-table-row single-coach-div'];

					if ( $gs_coach_link_type == 'popup' ) $classes[] = 'single-coach-pop';

					?>

					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

						<?php do_action( 'gs_coach_before_coach_content', $gs_coach_theme ); ?>

						<!-- Coach Image -->
						<div class="gs-coach-table-cell gsc-image">
							<?php echo coach_thumbnail_with_link( $id, $gs_coach_thumbnail_sizes, $gs_coach_name_is_linked == 'on', $gs_coach_link_type, 'gs_coach_image__wrapper' ); ?>
							<?php do_action( 'gs_coach_after_coach_thumbnail' ); ?>
						</div>

						<!-- Single coach name -->
						<div class="gs-coach-table-cell gsc-name">
							<div class="gs-coach-table-cell-inner">
								<?php coach_name( $id, true, $gs_coach_name_is_linked == 'on', $gs_coach_link_type ); ?>
								<?php do_action( 'gs_coach_after_coach_name' ); ?>
							</div>
						</div>

						<!-- Single coach designation -->
						<div class="gs-coach-table-cell gsc-desig">
							<div class="gs-coach-table-cell-inner">
								<div class="gs-coach-profession" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
								<?php do_action( 'gs_coach_after_coach_designation' ); ?>
							</div>
						</div>

						<!-- Description -->
						<div class="gs-coach-table-cell gsc-desc">
							<div class="gs-coach-table-cell-inner">
								
								<?php if ( 'on' === $gs_desc_allow_html ) : ?>
									<div class="gs-coach-details justify" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
								<?php else : ?>
									<div class="gs-coach-details justify" itemprop="description"><?php coach_description( $id, $gs_tm_details_contl, true, true, $gs_coach_name_is_linked == 'on', $gs_coach_link_type ); ?></div>
								<?php endif; ?>

								<?php do_action( 'gs_coach_after_coach_details' ); ?>
							</div>
						</div>

						<?php if ( 'on' == $gs_coach_connect ) : ?>
							<!-- Social Links -->
							<div class="gs-coach-table-cell socialicon gs-tm-sicons">
								<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>
							</div>
						<?php endif; ?>

						<?php do_action( 'gs_coach_after_coach_content' ); ?>

					</div>

					<!-- Popup -->
					<?php include Template_Loader::locate_template( 'popups/gs-coach-layout-popup.php' ); ?>
				
				<?php endwhile; ?>

			</div>

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