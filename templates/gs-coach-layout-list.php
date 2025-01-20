<?php

namespace GSCOACH;
/**
 * GS Coach - Layout List
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-list.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.4
 */

global $gs_coach_loop;

plugin()->hooks->load_acf_fields( $show_acf_fields, $acf_fields_position );

?>

<!-- Container for Coaches -->
<div class="gs-containeer cbp-so-scroller">
	
	<div class="gs-roow clearfix gs_coach">
	
		<?php if ( $gs_coach_loop->have_posts() ):

			do_action( 'gs_coach_before_coaches' );

			while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

			$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

			$classes = ['gs-col-xs-12 single-member-div'];

			if ( $gs_coach_link_type == 'popup' ) $classes[] = 'single-member-pop';
			if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';

			?>

			<!-- Start single member -->
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				
				<!-- Sehema & Single member wrapper -->
				<div class="single-member--wrapper" itemscope itemtype="http://schema.org/Organization">
					<div class="single-member fullcolumn">

						<div class="gs-roow">

							<?php do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>
							
							<div class="gs-col-md-4 gs-col-sm-4 gs-col-xs-12 cbp-so-side cbp-so-side-left gstm-img-div">

								<!-- Coach Image -->
								<div class="zoomin image">

									<!-- Ribbon -->
									<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>

									<?php echo member_thumbnail_with_link( $id, $gs_coach_thumbnail_sizes, $gs_coach_name_is_linked == 'on', $gs_coach_link_type, 'gs_coach_image__wrapper' ); ?>

								</div>
								<?php do_action( 'gs_coach_after_member_thumbnail' ); ?>

							</div>

							<div class="gs-col-md-8 gs-col-sm-8 gs-col-xs-12 cbp-so-side cbp-so-side-right gstm-img-div">
								<div class="single-team-rightinfo">
									<div class="gs-coach-info gs-tm-sicons">

										<!-- Single member name -->
										<?php member_name( $id, true, $gs_coach_name_is_linked == 'on', $gs_coach_link_type, 'div', 'gs-coach-name' ); ?>
										<?php do_action( 'gs_coach_after_member_name' ); ?>

										<!-- Single member designation -->
										<span class="gs-coach-profession" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></span>
										<?php do_action( 'gs_coach_after_member_designation' ); ?>

										<!-- Description -->
										<?php if ( 'on' === $gs_desc_allow_html ) : ?>
											<div class="gs-coach-details justify" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
										<?php else : ?>
											<div class="gs-coach-details justify" itemprop="description"><?php member_description( $id, $gs_tm_details_contl, true, false ); ?></div>
										<?php endif; ?>

										<?php do_action( 'gs_coach_after_member_details' ); ?>

										<!-- Social Links -->
										<div class="socialicon">
											<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>
										</div>

									</div>
								</div>
							</div>

							<?php do_action( 'gs_coach_after_member_content' ); ?>

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