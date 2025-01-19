<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Filter
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-filter.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.4
 */

global $gs_coach_loop;

?>

<!-- Container for Coaches -->
<div class="gs-containeer cbp-so-scroller">

	<!-- Cat Filters Template -->
	<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-cat-filters.php' ); ?>

	<!-- Filters Template -->
	<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-filters.php' ); ?>

	<?php if ( $gs_coach_loop->have_posts() ): ?>

		<?php do_action( 'gs_coach_before_coaches' ); ?>

		<div class="gs-all-items-filter-wrapper gs-roow">

			<?php while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();
				
				$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );
				if ( empty($designation) ) $designation = '';

				$designation_slug = sanitize_title( $designation );

				$classes = [
					'gs-filter-single-item single-member-div',
					$designation_slug,
					get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile ),
					get_member_terms_slugs( 'gs_coach_group' ),
					get_member_terms_slugs( 'gs_coach_location' ),
					get_member_terms_slugs( 'gs_coach_language' ),
					get_member_terms_slugs( 'gs_coach_gender' ),
					get_member_terms_slugs( 'gs_coach_specialty' )
				];

				if ( $gs_member_link_type == 'popup' ) $classes[] = 'single-member-pop';
				if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';

			?>

			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-category="<?php echo get_member_terms_slugs( 'gs_coach_group' ); ?>">
				
				<!-- Sehema & Single member wrapper -->
				<div class="single-member--wrapper" itemscope itemtype="http://schema.org/Organization">
					<div class="single-member ccbp-so-side ccbp-so-side-left">

						<?php

						if ( $gs_member_name_is_linked == 'on' ) {
							if ( $gs_member_link_type == 'single_page' ) {
								printf( '<a href="%s">', get_the_permalink() );
							} else if ( $gs_member_link_type == 'popup' ) {
								printf( '<a class="gs_coach_pop open-popup-link" data-mfp-src="#gs_coach_popup_%s_%s" href="javascript:void(0)">', get_the_ID(), $id );
							}
						}

							do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>

							<!-- Ribbon -->
							<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>
							
							<!-- Coach Image -->
							<div class="gs_coach_image__wrapper">
								<?php member_thumbnail( $gs_member_thumbnail_sizes, true ); ?>
							</div>
							<?php do_action( 'gs_coach_after_member_thumbnail' ); ?>
							
							<!-- Indicator -->
							<?php if ( $gs_member_name_is_linked == 'on' ) : ?>
								<div class="gs_coach_overlay"><i class="fas fa-external-link-alt"></i></div>
							<?php endif; ?>

							<div class="single-member-name-desig cbp-so-side cbp-so-side-right">

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

						<?php if ( $gs_member_name_is_linked == 'on' ) echo '</a>'; ?>
						
						<!-- Popup -->
						<?php $_popup_enabled = true; ?>
						<?php include Template_Loader::locate_template( 'popups/gs-coach-layout-popup.php' ); ?>
					
					</div>
				</div>

			</div>

			<?php endwhile; ?>

		</div>

		<?php do_action( 'gs_coach_after_coaches' ); ?>
	
	<?php else: ?>

		<div class="gs-roow clearfix gs_coach">

			<!--es not found - Load no-team-member template -->
			<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-no-team-member.php' ); ?>

		</div>

	<?php endif; ?>

	<!-- Pagination -->
	<?php if ( 'on' == $gs_member_pagination ) : ?>
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-pagination.php' ); ?>
	<?php endif; ?>

</div>