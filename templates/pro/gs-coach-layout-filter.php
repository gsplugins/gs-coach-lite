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
					'gs-filter-single-item single-coach-div',
					$designation_slug,
					get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile ),
					get_coach_terms_slugs( 'gs_coach_group' ),
					get_coach_terms_slugs( 'gs_coach_location' ),
					get_coach_terms_slugs( 'gs_coach_language' ),
					get_coach_terms_slugs( 'gs_coach_gender' ),
					get_coach_terms_slugs( 'gs_coach_specialty' ),
					get_coach_terms_slugs( 'gs_coach_extra_one' ),
					get_coach_terms_slugs( 'gs_coach_extra_two' ),
					get_coach_terms_slugs( 'gs_coach_extra_three' ),
					get_coach_terms_slugs( 'gs_coach_extra_four' ),
					get_coach_terms_slugs( 'gs_coach_extra_five' ),
				];

				if ( $gs_coach_link_type == 'popup' ) $classes[] = 'single-coach-pop';
				if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';

			?>

			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-category="<?php echo get_coach_terms_slugs( 'gs_coach_group' ); ?>">
				
				<!-- Sehema & Single coach wrapper -->
				<div class="single-coach--wrapper" itemscope itemtype="http://schema.org/Organization">
					<div class="single-coach ccbp-so-side ccbp-so-side-left">

						<?php

						if ( $gs_coach_name_is_linked == 'on' ) {
							if ( $gs_coach_link_type == 'single_page' ) {
								printf( '<a href="%s">', get_the_permalink() );
							} else if ( $gs_coach_link_type == 'popup' ) {
								printf( '<a class="gs_coach_pop open-popup-link" data-mfp-src="#gs_coach_popup_%s_%s" href="javascript:void(0)">', get_the_ID(), $id );
							}
						}

							do_action( 'gs_coach_before_coach_content', $gs_coach_theme ); ?>

							<!-- Ribbon -->
							<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>
							
							<!-- Coach Image -->
							<div class="gs_coach_image__wrapper">
								<?php coach_thumbnail( $gs_coach_thumbnail_sizes, true ); ?>
							</div>
							<?php do_action( 'gs_coach_after_coach_thumbnail' ); ?>
							
							<!-- Indicator -->
							<?php if ( $gs_coach_name_is_linked == 'on' ) : ?>
								<div class="gs_coach_overlay"><i class="fas fa-external-link-alt"></i></div>
							<?php endif; ?>

							<div class="single-coach-name-desig cbp-so-side cbp-so-side-right">

								<!-- Single coach name -->
								<?php if ( 'on' ==  $gs_coach_name ): ?>
									<?php coach_name( $id, true, false ); ?>
									<?php do_action( 'gs_coach_after_coach_name' ); ?>
								<?php endif; ?>
								
								<!-- Single coach designation -->
								<?php if ( !empty( $designation ) && 'on' == $gs_coach_role ): ?>
									<div class="gs-coach-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
									<?php do_action( 'gs_coach_after_coach_designation' ); ?>
								<?php endif; ?>

							</div>

							<?php do_action( 'gs_coach_after_coach_content' ); ?>

						<?php if ( $gs_coach_name_is_linked == 'on' ) echo '</a>'; ?>
						
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

			<!--es not found - Load no-team-coach template -->
			<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-no-team-coach.php' ); ?>

		</div>

	<?php endif; ?>

	<!-- Pagination -->
	<?php if ( 'on' == $enable_pagination ) : ?>
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-pagination.php' ); ?>
	<?php endif; ?>

</div>