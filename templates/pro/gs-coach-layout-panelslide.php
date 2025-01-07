<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Panel Slide
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-panelslide.php
 *
 * @author GS Plugins <hello@gsplugins.com>
 * @package GS_Coach/Templates
 * @version 1.0.4
 */

global $gs_coach_loop;

$panel_enabled = 'on';

?>

<!-- Container for Coach members -->
<div class="gs-containeer cbp-so-scroller">

	<?php if ( $gs_coach_loop->have_posts() ): ?>

		<!-- Search by Name Filter -->
		<div class="search-filter">
			<div class="gs-roow justify-content-center">

				<?php if ( 'on' ==  $gs_member_srch_by_name ) : ?>

					<?php do_action( 'gs_coach_before_search_filter' ); ?>

					<div class="gs-col-lg-4 gs-col-md-6 search-fil-nbox">
						<input type="text" class="search-by-name" placeholder="<?php echo esc_attr( $gs_coachfliter_name ); ?>" />
					</div>

				<?php endif; ?>

				<?php if ( 'on' ==  $gs_member_srch_by_company ) : ?>

					<?php do_action( 'gs_coach_before_company_search_filter' ); ?>

					<div class="gs-col-lg-4 gs-col-md-6 search-fil-nbox">
						<input type="text" class="search-by-company" placeholder="<?php echo esc_attr( $gs_coachfliter_company ); ?>" />
					</div>

				<?php endif; ?>

				<?php if ( 'on' ==  $gs_member_srch_by_zip ) : ?>

					<?php do_action( 'gs_coach_before_zip_search_filter' ); ?>

					<div class="gs-col-lg-4 gs-col-md-6 search-fil-nbox">
						<input type="text" class="search-by-zip" placeholder="<?php echo esc_attr( $gs_coachfliter_zip ); ?>" />
					</div>

				<?php endif; ?>

				<?php if ( 'on' ==  $gs_member_srch_by_tag ) : ?>

					<?php do_action( 'gs_coach_before_tag_search_filter' ); ?>

					<div class="gs-col-lg-4 gs-col-md-6 search-fil-nbox">
						<input type="text" class="search-by-tag" placeholder="<?php echo esc_attr( $gs_coachfliter_tag ); ?>" />
					</div>

				<?php endif; ?>

			</div>
		</div>

		<?php do_action( 'gs_coach_before_team_members' ); ?>

		<div class="gs-roow clearfix gs_coach gs-all-items-filter-wrapper" id="gs_coach<?php echo get_the_id(); ?>">

			<?php while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();
			
			$designation = get_post_meta( get_the_id(), '_gs_des', true );

			$classes = ['gs-filter-single-item single-member-div gs-filter-single-item', get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile ) ];
			if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';

			?>

			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				
				<!-- Sehema & Single member wrapper -->
				<div class="single-member--wrapper" itemscope itemtype="http://schema.org/Organization">
					<div class="single-member cbp-so-side cbp-so-side-left">

						<a class="gs_coach_pop gs_coach_panelslide_link" id="gscoachlink_<?php echo esc_attr(get_the_id()); ?>_<?php echo esc_attr($id); ?>" href="#gscoach_<?php echo esc_attr(get_the_id()); ?>_<?php echo esc_attr($id); ?>">

							<?php do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>

							<!-- Ribbon -->
							<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>

							<!-- Coach Image -->
							<div class="gs_coach_image__wrapper">
								<?php member_thumbnail( $gs_member_thumbnail_sizes, true ); ?>
							</div>
							<?php do_action( 'gs_coach_after_member_thumbnail' ); ?>

							<!-- Indicator -->
							<div class="gs_coach_overlay"><i class="fas fa-bolt"></i></div>

							<div class="single-member-name-desig">

								<!-- Single member name -->
								<?php if ( 'on' ==  $gs_member_name ): ?>
									<?php member_name( $id, true, false ); ?>
									<?php do_action( 'gs_coach_after_member_name' ); ?>
								<?php endif; ?>
								
								<!-- Single member designation -->
								<?php if ( !empty( $designation ) && 'on' == $gs_member_role ): ?>
									<div class="gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
									<?php do_action( 'gs_coach_after_member_designation' ); ?>
								<?php endif; ?>

							</div>

							<?php do_action( 'gs_coach_after_member_content' ); ?>

						</a>
					
					</div>
				</div>

			</div>

			<?php endwhile; ?>
		
		</div>

		<?php do_action( 'gs_coach_after_team_members' ); ?>
		
	<?php else: ?>

		<!-- Members not found - Load no-team-member template -->
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-no-team-member.php' ); ?>

	<?php endif; ?>

	<!-- Pagination -->
	<?php if ( 'on' == $gs_member_pagination ) : ?>
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-pagination.php' ); ?>
	<?php endif; ?>

</div>

<!-- Panel -->
<?php include Template_Loader::locate_template( 'panels/gs-coach-layout-panel.php' ); ?>