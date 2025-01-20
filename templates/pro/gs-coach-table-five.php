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
	
		<table class="">

			<thead>
				<tr>
					<th class="gs-coach--cl-image">Image</th>
					<th class="gs-coach--cl-name">Name</th>
					<th class="gs-coach--cl-position">Position</th>
					<th class="gs-coach--cl-des">Description</th>
					<th class="gs-coach--cl-social">Social Links</th>
				</tr>
			</thead>

			<tbody>
				<?php if ( $gs_coach_loop->have_posts() ):

					$classes = ['single-member single-member-div'];
									
					if ( $gs_coach_link_type == 'popup' ) $classes[] = 'single-member-pop';

					do_action( 'gs_coach_before_coaches' );

					while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

					$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

					?>

					<tr class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

						<?php do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>

						<td class="gs_coach_image__td"> 
							<div class="gs_coach_image__wrapper"><?php member_thumbnail( $gs_coach_thumbnail_sizes, true ); ?></div>
						</td>

						<td class="gs_coach_name__td">
							<?php member_name( $id, true, $gs_coach_name_is_linked == 'on', $gs_coach_link_type ); ?>
							<?php do_action( 'gs_coach_after_member_name' ); ?>
						</td>

						<td class="gs_coach_desig__td">
							<div class="gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
							<?php do_action( 'gs_coach_after_member_designation' ); ?>
						</td>

						<td class="gs_coach_desc__td">
							<!-- Description -->
							<?php if ( 'on' ==  $gs_coach_details ) : ?>
								
								<?php if ( 'on' === $gs_desc_allow_html ) : ?>
									<div class="gs-member-desc" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
								<?php else : ?>
									<p class="gs-member-desc" itemprop="description"><?php member_description( $id, $gs_tm_details_contl, true, true, $gs_coach_name_is_linked == 'on', $gs_coach_link_type ); ?></p>
								<?php endif; ?>

								<?php do_action( 'gs_coach_after_member_details' ); ?>
							<?php endif; ?>
						</td>

						<td class="gs_coach_social__td">
							<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>
						</td>

					</tr>

					<!-- Popup -->
					<?php include Template_Loader::locate_template( 'popups/gs-coach-layout-popup.php' ); ?>

				<?php endwhile; ?>

					<?php do_action( 'gs_coach_after_coaches' ); ?>

				<?php else: ?>

					<tr>
						<td colspan="5">
							<!--es not found - Load no-team-member template -->
							<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-no-team-member.php' ); ?>
						</td>
					</tr>

				<?php endif; ?>
			</tbody>

		</table>

	</div>

	<!-- Pagination -->
	<?php if ( 'on' == $gs_coach_pagination ) : ?>
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-pagination.php' ); ?>
	<?php endif; ?>

</div>

<!-- Panel -->
<?php include Template_Loader::locate_template( 'panels/gs-coach-layout-panel.php' ); ?>