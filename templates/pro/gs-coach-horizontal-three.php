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

$gs_row_classes = ['gs-roow clearfix gs_coach'];
$carousel_params = '';

// Force reset columns size for this theme
if ( $gs_coach_cols == '2_4' || $gs_coach_cols < 6 ) $gs_coach_cols = 6;
if ( $gs_coach_cols_tablet == '2_4' || $gs_coach_cols_tablet < 6 ) $gs_coach_cols_tablet = 6;
$gs_coach_cols_mobile_portrait = 12;
$gs_coach_cols_mobile = 12;

if ( $_carousel_enabled ) {
	$gs_row_classes[] = 'slider owl-carousel owl-theme';
	$carousel_params = get_carousel_data( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile, false );
	if ( $carousel_navs_enabled ) {
		$gs_row_classes[] = 'carousel-has-navs';
		$gs_row_classes[] = 'carousel-navs--' . $carousel_navs_style;
	}
	if ( $carousel_dots_enabled ) {
		$gs_row_classes[] = 'carousel-has-dots';
		$gs_row_classes[] = 'carousel-dots--' . $carousel_dots_style;
	}
}

if ( $_drawer_enabled ) $gs_row_classes[] = 'gstm-gridder gstm-gridder-' . $drawer_style;
if ( $_filter_enabled ) $gs_row_classes[] = 'gs-all-items-filter-wrapper';

?>

<!-- Container for Coaches -->
<div class="gs-containeer cbp-so-scroller">

	<?php if ( $_filter_enabled ) : ?>

		<!-- Cat Filters Template -->
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-cat-filters.php' ); ?>

		<!-- Filters Template -->
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-filters.php' ); ?>

	<?php endif; ?>
	
	<div class="<?php echo esc_attr( implode(' ', $gs_row_classes) ); ?>" <?php if ( !empty($carousel_params) ) echo wp_kses_post( $carousel_params ); ?>>
	
		<?php if ( $gs_coach_loop->have_posts() ):

			if ( $_drawer_enabled ) echo '<div class="gridder">';

			do_action( 'gs_coach_before_coaches' );

			while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

			$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );
			$address = get_post_meta( get_the_id(), '_gscoach_address', true );

			$classes = ['single-member-div', get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile ) ];

			if ( $gs_member_link_type == 'popup' ) $classes[] = 'single-member-pop';
			if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';
			if ( $_drawer_enabled ) $classes[] = 'gridder-list';
			if ( $_filter_enabled ) {
				$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );
				if ( empty($designation) ) $designation = '';
				
				$classes[] = 'gs-filter-single-item';
				$classes[] = sanitize_title( $designation );
				$classes[] = get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile );
				$classes[] = get_member_terms_slugs( 'gs_coach_group' );
				$classes[] = get_member_terms_slugs( 'gs_coach_location' );
				$classes[] = get_member_terms_slugs( 'gs_coach_language' );
				$classes[] = get_member_terms_slugs( 'gs_coach_gender' );
				$classes[] = get_member_terms_slugs( 'gs_coach_specialty' );
				$classes[] = get_member_terms_slugs( 'gs_coach_extra_one' );
				$classes[] = get_member_terms_slugs( 'gs_coach_extra_two' );
				$classes[] = get_member_terms_slugs( 'gs_coach_extra_three' );
				$classes[] = get_member_terms_slugs( 'gs_coach_extra_four' );
				$classes[] = get_member_terms_slugs( 'gs_coach_extra_five' );
			}
			$single_item_attr = '';
			if ( $_drawer_enabled ) $single_item_attr = sprintf( 'data-griddercontent="#gs-coach-drawer-%s-%s"', get_the_ID(), $id );

			?>

			<!-- Start single member -->
			<div class="<?php echo esc_attr( implode(' ', $classes) ); ?>" <?php echo wp_kses_post( $single_item_attr ); ?>>
				
				<!-- Sehema & Single member wrapper -->
				<div class="single-member--wrapper" itemscope itemtype="http://schema.org/Organization">

					<?php do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>

					<div class="single-member">

						<!-- Coach Image -->
						<div class="gs_coach_image__wrapper">

							<!-- Image -->
							<?php member_thumbnail( $gs_member_thumbnail_sizes, true ); ?>

							<!-- Ribbon -->
							<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>
						</div>
	
						<!-- Member Name -->
						<div class="gs_member_info">
							
							<!-- Member Name -->
							<?php member_name( $id, true, $gs_member_name_is_linked == 'on', $gs_member_link_type ); ?>
							<?php do_action( 'gs_coach_after_member_name' ); ?>
	
							<!-- Member Designation -->
							<div class="gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
							<?php do_action( 'gs_coach_after_member_designation' ); ?>
	
							<!-- Description -->
							<?php if ( 'on' ==  $gs_member_details ) : ?>
								
								<?php if ( 'on' === $gs_desc_allow_html ) : ?>
									<div class="gs-member-desc" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
								<?php else : ?>
									<p class="gs-member-desc" itemprop="description"><?php member_description( $id, $gs_tm_details_contl, true, true, $gs_member_name_is_linked == 'on', $gs_member_link_type ); ?></p>
								<?php endif; ?>

								<?php do_action( 'gs_coach_after_member_details' ); ?>
							<?php endif; ?>
	
							<?php if ( !empty($address) ) : ?>
								<div class="gs-member-address">
									<i class="fas fa-map-marker"></i>
									<?php echo wp_kses_post( $address ); ?>
								</div>
								<?php do_action( 'gs_coach_after_member_address' ); ?>
							<?php endif; ?>
							
						</div>

					</div>

				</div>

				<!-- Popup -->
				<?php include Template_Loader::locate_template( 'popups/gs-coach-layout-popup.php' ); ?>

			</div>

		<?php endwhile; ?>

			<?php do_action( 'gs_coach_after_coaches' );

			if ( $_drawer_enabled ) echo '</div>'; ?>

		<?php else: ?>

			<!--es not found - Load no-team-member template -->
			<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-no-team-member.php' ); ?>

		<?php endif; ?>

		<!-- Drawer Contents -->
		<?php include Template_Loader::locate_template( 'drawers/gs-coach-layout-drawer.php' ); ?>

	</div>

	<!-- Pagination -->
	<?php if ( 'on' == $gs_member_pagination ) : ?>
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-pagination.php' ); ?>
	<?php endif; ?>

</div>

<!-- Panel -->
<?php include Template_Loader::locate_template( 'panels/gs-coach-layout-panel.php' ); ?>