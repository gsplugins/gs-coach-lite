<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Filter Four
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-filter-4.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.7
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
				
				$vcard = get_post_meta( get_the_id(), '_gs_vcard', true );

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
					<div class="card">

						<?php do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>

						<div class="single-member cbp-so-side cbp-so-side-left">

							<!-- Coach Image -->
							<div class="gs_coach_image__wrapper">
								<?php echo member_thumbnail_with_link( $id, $gs_member_thumbnail_sizes, $gs_member_name_is_linked == 'on', $gs_member_link_type ); ?>
							</div>
							<?php do_action( 'gs_coach_after_member_thumbnail' ); ?>
							
						</div>
							
						<!-- Single member name -->
						<?php if ( 'on' ==  $gs_member_name ): ?>
							<?php member_name( $id, true, $gs_member_name_is_linked == 'on', $gs_member_link_type, 'h5' ); ?>
							<?php do_action( 'gs_coach_after_member_name' ); ?>
						<?php endif; ?>

						<!-- Single member designation -->
						<?php if ( !empty( $designation ) && 'on' == $gs_member_role ): ?>
							<p class="gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></p>
							<?php do_action( 'gs_coach_after_member_designation' ); ?>
						<?php endif; ?>

						<?php if ( !empty($cell) ) : ?>
							<div class="gs-member-cphon">

								<?php if ( is_rtl() ) : ?>
									<span class="level-info-cphon"><a href="tel:<?php echo esc_attr( $cell ); ?>"><?php echo esc_html( $cell ); ?></a></span>
									<span class="levels">:<?php echo esc_html($gs_coachcellPhone_meta); ?></span>
								<?php endif; ?>	
									
								<?php if ( ! is_rtl() ) : ?>
									<span class="levels"><?php echo esc_html($gs_coachcellPhone_meta); ?>:</span>
									<span class="level-info-cphon"><a href="tel:<?php echo esc_attr( $cell ); ?>"><?php echo esc_html( $cell ); ?></a></span>
								<?php endif; ?>

							</div>
						<?php endif; ?>

						<?php if ( !empty($email) ) : ?>
							<div class="gs-member-email">

								<?php if ( is_rtl() ) : ?>
									<span class="level-info-email"><a href="mailto:<?php echo sanitize_email( $email ); ?>"><?php echo sanitize_email( $email ); ?></a></span>
									<span class="levels">:<?php echo esc_html($gs_coachemail_meta); ?></span>
								<?php endif; ?>
									
								<?php if ( ! is_rtl() ) : ?>
									<span class="levels"><?php echo esc_html($gs_coachemail_meta); ?>:</span>
									<span class="level-info-email"><a href="mailto:<?php echo sanitize_email( $email ); ?>"><?php echo sanitize_email( $email ); ?></a></span>
								<?php endif; ?>

							</div>
						<?php endif; ?>

						<?php if ( !empty($vcard) && $gs_coach_vcard_txt ) : ?>
							<a class="gs_secondary_button" rel="noopener noreferrer nofollow" target="_blank" href="<?php echo esc_url($vcard); ?>">
								<?php echo esc_html($gs_coach_vcard_txt); ?>
							</a>
						<?php endif; ?>
							
						<?php do_action( 'gs_coach_after_member_content' ); ?>
					
					</div>
				</div>
			
				<!-- Popup -->
				<?php include Template_Loader::locate_template( 'popups/gs-coach-layout-popup.php' ); ?>

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