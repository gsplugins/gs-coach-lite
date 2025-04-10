<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Table Filter
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-table-filter.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.1
 */

global $gs_coach_loop;

?>

<!-- Container for Coaches -->
<div class="gs-containeer">

	<div class="gs-roow clearfix gs_coach">
	
		<?php if ( $gs_coach_loop->have_posts() ): ?>

			<?php do_action( 'gs_coach_before_coaches' ); ?>
			
			<div class="table-responsive gs-col-md-12">

				<table data-toggle="table" data-search="true" class="table table-striped table-hover">

					<thead class="thead-dark">

						<tr>
							<?php do_action( 'gs_coach_before_coach_content_table_heads' ); ?>

							<th data-sortable="true"><?php _e( 'Name', 'gscoach' ); ?></th>
							<th data-sortable="true"><?php _e( 'Department', 'gscoach' ); ?></th>
							<th data-sortable="true"><?php _e( 'Contact', 'gscoach' ); ?></th>

							<?php do_action( 'gs_coach_after_coach_content_table_heads' ); ?>
						</tr>

					</thead>

					<tbody>

						<?php while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

							$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );
							$email = get_post_meta( get_the_id(), '_gscoach_email', true );

							$cell = get_post_meta( get_the_id(), '_gscoach_contact', true );
							$cell = format_phone($cell);

							$classes = ['single-coach-div'];
				
							if ( $gs_coach_link_type == 'popup' ) $classes[] = 'single-coach-pop';

							?>

							<tr class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
								<?php do_action( 'gs_coach_before_coach_content', $gs_coach_theme ); ?>

								<?php coach_name( $id, true, $gs_coach_name_is_linked == 'on', $gs_coach_link_type, 'td', '', true ); ?>
								<td><?php echo wp_kses_post($designation); ?></td>
								<td><a href="tel:<?php echo esc_attr( $cell ); ?>"><?php echo esc_html( $cell ); ?></a> | <a href="mailto:<?php echo sanitize_email($email); ?>"><?php _e( 'SEND EMAIL', 'gscoach' ); ?></a></td>
								
								<?php do_action( 'gs_coach_after_coach_content' ); ?>
							</tr>

							<!-- Popup -->
							<?php include Template_Loader::locate_template( 'popups/gs-coach-layout-popup.php' ); ?>
						
						<?php endwhile; ?>

					</tbody>
				
				</table>

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