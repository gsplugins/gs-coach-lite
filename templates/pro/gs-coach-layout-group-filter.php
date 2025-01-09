<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Group Filter
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-group-filter.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.4
 */

global $gs_coach_loop;

?>

<!-- Container for Coach members -->
<div class="gs-containeer cbp-so-scroller">

	<!-- Filters Template -->
	<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-filters.php' ); ?>
	
	<?php do_action( 'gs_coach_before_team_members' ); ?>

	<?php if ( $gs_coach_loop->have_posts() ) : ?>

		<?php do_action( 'gs_coach_before_team_members' ); ?>

		<div class="gs-all-items-filter-wrapper gs-roow">

			<?php

			setup_group_to_posts( $gs_coach_loop );

			$_posts = $gs_coach_loop->posts;

			$groups = gs_coach_get_terms( 'gs_coach_group' );

			foreach ( $groups as $group_slug => $group_title ) {

				$gs_coach_loop->posts = filter_posts_by_term( $group_slug, $_posts );

				if ( empty($gs_coach_loop->posts) ) continue;

				?>
				
				<div class="gs-filter-single-item gs-filter--group-title gs-col-sm-12 gs-col-xs-12">
					<div class="gs-filter--group-title--inner"><?php echo esc_html($group_title); ?></div>
				</div>

				<?php

				foreach ( $gs_coach_loop->posts as $post) :
					
					$GLOBALS['post'] = $post;
					$gs_coach_loop->setup_postdata( $post );

					$email = get_post_meta( get_the_id(), '_gs_email', true );
					$cell = get_post_meta( get_the_id(), '_gs_cell', true );

					$designation = get_post_meta( get_the_id(), '_gs_des', true );
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

					if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';

					?>
				
					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-category="<?php echo get_member_terms_slugs( 'gs_coach_group' ); ?>">
						
						<!-- Sehema & Single member wrapper -->
						<div class="single-member--wrapper" itemscope itemtype="http://schema.org/Organization">
							<div class="single-member cbp-so-side cbp-so-side-left">

								<div class="card">

									<?php do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>

									<div class="banner">

										<!-- Coach Image -->
										<div class="gs_coach_image__wrapper">
											<?php member_thumbnail( $gs_member_thumbnail_sizes, true ); ?>
										</div>
										<?php do_action( 'gs_coach_after_member_thumbnail' ); ?>
										
										<div class="tittle_container">

											<!-- Single member name -->
											<?php if ( 'on' ==  $gs_member_name ): ?>
												<?php member_name( $id, true, true, 'single_page', 'h5', 'card-title' ); ?>
												<?php do_action( 'gs_coach_after_member_name' ); ?>
											<?php endif; ?>
											
											<!-- Single member designation -->
											<?php if ( !empty( $designation ) && 'on' == $gs_member_role ): ?>
												<p class="card-text gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></p>
												<?php do_action( 'gs_coach_after_member_designation' ); ?>
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
									
									<?php do_action( 'gs_coach_after_member_content' ); ?>

								</div>
							
							</div>
						</div>

					</div>
			
				<?php endforeach; ?>

				<div class="gs-filter-single-item gs-filter--group-divider gs-col-sm-12 gs-col-xs-12"><div class="gs-filter--group-divider--inner"></div></div>

				<?php
			}

			$gs_coach_loop->posts = $_posts;

			unset($_posts);

			?>

		</div>

		<?php do_action( 'gs_coach_after_team_members' ); ?>
	
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