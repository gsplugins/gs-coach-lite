<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Filter Three
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-filter-3.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.5
 */

global $gs_coach_loop;

?>

<!-- Container for Coaches -->
<div class="gs-containeer cbp-so-scroller">

	<!-- Filters Template -->
	<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-filters.php' ); ?>
	
	<?php do_action( 'gs_coach_before_coaches' ); ?>

	<?php if ( $gs_coach_loop->have_posts() ): ?>

		<?php do_action( 'gs_coach_before_coaches' ); ?>

		<div class="gs-all-items-filter-wrapper gs-roow">

			<?php while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

				$email = get_post_meta( get_the_id(), '_gscoach_email', true );
				$cell = get_post_meta( get_the_id(), '_gscoach_contact', true );

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

				if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';

			?>
			
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-category="<?php echo get_coach_terms_slugs( 'gs_coach_group' ); ?>">
				
				<!-- Sehema & Single coach wrapper -->
				<div class="single-coach--wrapper" itemscope itemtype="http://schema.org/Organization">
					<div class="single-coach cbp-so-side cbp-so-side-left">
						<div class="card">

							<?php do_action( 'gs_coach_before_coach_content', $gs_coach_theme ); ?>

							<div class="banner">

								<!-- Ribbon -->
								<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>

								<!-- Coach Image -->
								<div class="gs_coach_image__wrapper">
									<?php coach_thumbnail( $gs_coach_thumbnail_sizes, true ); ?>
								</div>
								<?php do_action( 'gs_coach_after_coach_thumbnail' ); ?>
								
								<div class="tittle_container">

									<!-- Single coach name -->
									<?php if ( 'on' ==  $gs_coach_name ): ?>
										<?php coach_name( $id, true, true, 'single_page', 'h5', 'card-title' ); ?>
										<?php do_action( 'gs_coach_after_coach_name' ); ?>
									<?php endif; ?>
									
									<!-- Single coach designation -->
									<?php if ( !empty( $designation ) && 'on' == $gs_coach_role ): ?>
										<p class="card-text gs-coach-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></p>
										<?php do_action( 'gs_coach_after_coach_designation' ); ?>
									<?php endif; ?>

								</div>

							</div>


							<div class="card-body social_cont">
									
								<?php if ( !empty($email) ) : ?>
									<a class="social_contact" href="mailto:<?php echo sanitize_email( $email ); ?>">
										<i class="fas fa-envelope"></i>
										<?php echo sanitize_email( $email ); ?>
									</a>
								<?php endif; ?>

								<?php if ( !empty($cell) ) : ?>
									<a class="social_contact" href="tel:<?php echo esc_attr( $cell ); ?>">
										<i class="fas fa-phone-square"></i>
										<?php echo esc_html( $cell ); ?>
									</a>
								<?php endif; ?>

								<a class="social_contact social_contact_mt gs_read_more_button" href="<?php the_permalink(); ?>">
									<i class="fas fa-arrow-right"></i>
									<?php echo esc_html($gs_coach_read_on); ?>
								</a>

							</div>
								
							<?php do_action( 'gs_coach_after_coach_content' ); ?>

						</div>
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