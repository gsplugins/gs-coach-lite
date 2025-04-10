<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Flip
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-flip.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.3
 */

global $gs_coach_loop;

?>

<!-- Container for Coaches -->
<div class="gs-containeer cbp-so-scroller">
	
	<div class="gs-roow clearfix gs_coach">
	
		<?php if ( $gs_coach_loop->have_posts() ):

			do_action( 'gs_coach_before_coaches' );

			while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

			$land_number = get_post_meta( get_the_id(), '_gs_land', true );
			$cell_number = get_post_meta( get_the_id(), '_gscoach_contact', true );
			$coach_email = get_post_meta( get_the_id(), '_gscoach_email', true );
			
			$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );
			if ( empty($designation) ) $designation = '';

			$designation_slug = sanitize_title( $designation );
			
			$classes = [
				'gs-filter-single-item single-coach-div',
				get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile ),
				get_coach_terms_slugs( 'gs_coach_group' ),
				$designation_slug
			];
		
			if ( $gs_coach_link_type == 'popup' ) $classes[] = 'single-coach-pop';
			if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';

			?>

			<!-- Start single coach -->
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-category="<?php echo get_coach_terms_slugs( 'gs_coach_group' ); ?>">

				<?php do_action( 'gs_coach_before_coach_content', $gs_coach_theme ); ?>
				
				<!-- Sehema & Single coach wrapper -->
				<div class="single-coach--wrapper flip-vertical cbp-so-side cbp-so-side-left" itemscope itemtype="http://schema.org/Organization">
				
					<div class="single-coach front">
						
						<!-- Coach Image -->
						<div class="gs_coach_image__wrapper">
							<?php coach_thumbnail( $gs_coach_thumbnail_sizes, true ); ?>
						</div>
						<?php do_action( 'gs_coach_after_coach_thumbnail' ); ?>
					
						<!-- Ribbon -->
						<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>

					</div>
					
					<div class="back">
						
						<!-- Coach Flip Image -->
						<div class="gs_coach_image__wrapper gs_coach_image__wrapper-secondary">
							<?php coach_secondary_thumbnail( $gs_coach_thumbnail_sizes, true ); ?>
						</div>
						<?php do_action( 'gs_coach_after_coach_secondary_thumbnail' ); ?>

						<!-- Ribbon -->
						<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>
						
						<!-- Other Information -->
						<div class="flip-info">

							<?php if ( !empty($coach_email) ) : ?>
								<div class="flip-info-email"><?php echo sanitize_email($coach_email); ?></div>
								<?php do_action( 'gs_coach_after_coach_email' ); ?>
							<?php endif; ?>

							<?php if ( !empty($land_number) ) : ?>
								<div><?php echo esc_html($land_number); ?></div>
								<?php do_action( 'gs_coach_after_coach_lang_number' ); ?>
							<?php endif; ?>

							<?php if ( !empty($cell_number) ) : ?>
								<div><?php echo esc_html($cell_number); ?></div>
								<?php do_action( 'gs_coach_after_coach_cell_number' ); ?>
							<?php endif; ?>
							
						</div>

					</div>
					
				</div>

				<!-- Single coach name -->
				<?php if ( 'on' ==  $gs_coach_name ): ?>
					<?php coach_name( $id, true, $gs_coach_name_is_linked == 'on', $gs_coach_link_type ); ?>
					<?php do_action( 'gs_coach_after_coach_name' ); ?>
				<?php endif; ?>
				
				<!-- Single coach designation -->
				<?php if ( !empty( $designation ) && 'on' == $gs_coach_role ): ?>
					<div class="gs-coach-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
					<?php do_action( 'gs_coach_after_coach_designation' ); ?>
				<?php endif; ?>

				<?php do_action( 'gs_coach_after_coach_content' ); ?>

			</div>
				
			<!-- Popup -->
			<?php include Template_Loader::locate_template( 'popups/gs-coach-layout-popup.php' ); ?>

		<?php endwhile; ?>

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