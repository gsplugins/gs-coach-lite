<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Table Odd Even
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-table-odd-even.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.1
 */

global $gs_coach_loop;

?>

<!-- Container for Coach members -->
<div class="gs-containeer">
	
	<?php if ( $gs_coach_loop->have_posts() ): ?>
		
		<?php do_action( 'gs_coach_before_team_members' ); ?>
		
		<div class="gs_coach_table_oddeven">

			<div class="gs-coach-table">

				<div class="gs-coach-table-row gsc-table-head">

					<?php do_action( 'gs_coach_before_member_content_table_heads' ); ?>

					<div class="gs-coach-table-cell"><?php _e( 'Image', 'gscoach' ); ?></div>
					<div class="gs-coach-table-cell"><?php _e( 'Name', 'gscoach' ); ?></div>
					<div class="gs-coach-table-cell"><?php _e( 'Position', 'gscoach' ); ?></div>
					<div class="gs-coach-table-cell"><?php _e( 'Description', 'gscoach' ); ?></div>
					
					<?php if ( 'on' == $gs_member_connect ) : ?>
						<div class="gs-coach-table-cell"><?php _e( 'Social Links', 'gscoach' ); ?></div>
					<?php endif; ?>

					<?php do_action( 'gs_coach_after_member_content_table_heads' ); ?>

				</div>

				<?php while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

					$designation = get_post_meta( get_the_id(), '_gs_des', true );
					$ribon = get_post_meta( get_the_id(), '_gs_ribon', true );

					$classes = ['gs-coach-table-row single-member-div'];

					if ( $gs_member_link_type == 'popup' ) $classes[] = 'single-member-pop';

					?>

					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

						<?php do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>

						<!-- Coach Image -->
						<div class="gs-coach-table-cell gsc-image">
							<?php echo member_thumbnail_with_link( $id, $gs_member_thumbnail_sizes, $gs_member_name_is_linked == 'on', $gs_member_link_type, 'gs_coach_image__wrapper' ); ?>
							<?php do_action( 'gs_coach_after_member_thumbnail' ); ?>
						</div>

						<!-- Single member name -->
						<div class="gs-coach-table-cell gsc-name">
							<div class="gs-coach-table-cell-inner">
								<?php member_name( $id, true, $gs_member_name_is_linked == 'on', $gs_member_link_type ); ?>
								<?php do_action( 'gs_coach_after_member_name' ); ?>
							</div>
						</div>

						<!-- Single member designation -->
						<div class="gs-coach-table-cell gsc-desig">
							<div class="gs-coach-table-cell-inner">
								<div class="gs-member-profession" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
								<?php do_action( 'gs_coach_after_member_designation' ); ?>
							</div>
						</div>

						<!-- Description -->
						<div class="gs-coach-table-cell gsc-desc">
							<div class="gs-coach-table-cell-inner">
								
								<?php if ( 'on' === $gs_desc_allow_html ) : ?>
									<div class="gs-member-details justify" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
								<?php else : ?>
									<div class="gs-member-details justify" itemprop="description"><?php member_description( $id, $gs_tm_details_contl, true, true, $gs_member_name_is_linked == 'on', $gs_member_link_type ); ?></div>
								<?php endif; ?>

								<?php do_action( 'gs_coach_after_member_details' ); ?>
							</div>
						</div>

						<?php if ( 'on' == $gs_member_connect ) : ?>
							<!-- Social Links -->
							<div class="gs-coach-table-cell socialicon gs-tm-sicons">
								<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>
							</div>
						<?php endif; ?>

						<?php do_action( 'gs_coach_after_member_content' ); ?>

					</div>

					<!-- Popup -->
					<?php include Template_Loader::locate_template( 'popups/gs-coach-layout-popup.php' ); ?>
				
				<?php endwhile; ?>

			</div>

		</div>

		<?php do_action( 'gs_coach_after_team_members' ); ?>
			
	<?php else: ?>

		<div class="gs-roow clearfix gs_coach">

			<!-- Members not found - Load no-team-member template -->
			<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-no-team-member.php' ); ?>

		</div>

	<?php endif; ?>

	<!-- Pagination -->
	<?php if ( 'on' == $gs_member_pagination ) : ?>
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-pagination.php' ); ?>
	<?php endif; ?>

</div>