<?php
namespace GSCOACH;

/**
 * GS Coach - Ticker Layout 1
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-ticker.php
 * 
 * @package GS_Coach/Templates
 * @version 2.0.0
 */

$gs_row_classes = ['gs-roow clearfix gs_coach'];
$carousel_params = '';

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

if ( $_drawer_enabled ) $gs_row_classes[] = 'gscoach-gridder gscoach-gridder-' . $drawer_style;
if ( $_filter_enabled ) $gs_row_classes[] = 'gs-all-items-filter-wrapper';

$options = array(
	'mode' 				=> 'horizontal',
	'speed' 			=> 500,
	'pauseOnHover' 		=> 1,
	'slideSpace' 		=> 10,
	'desktopLogos'      => 5,
	'tabletLogos'      	=> 3,
	'mobileLogos'      	=> 2,
	'reverseDirection'  => 0,
);

$options = json_encode($options, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

global $gs_coach_loop;

?>

<!-- Container for Coaches -->
<div class="gs-containeer cbp-so-scroller">

	<?php if ( $_filter_enabled ) : ?>

		<!-- Cat Filters Template -->
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-cat-filters.php' ); ?>

		<!-- Filters Template -->
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-filters.php' ); ?>

	<?php endif; ?>
	
	<div class="gs_ticker <?php echo esc_attr( implode(' ', $gs_row_classes) ); ?>" <?php if ( !empty($carousel_params) ) echo wp_kses_post( $carousel_params );  ?>  data-carousel-config='<?php echo $options; ?>' >
	
		<?php if ( $gs_coach_loop->have_posts() ):

			if ( $_drawer_enabled ) echo '<div class="gridder">';

			do_action( 'gs_coach_before_coaches' );

			while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

			$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

			$classes = ['single-coach-div', get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile ) ];

			if ( $gs_coach_link_type == 'popup' ) $classes[] = 'single-coach-pop';
			if ( $enable_scroll_animation == 'on' ) $classes[] = 'cbp-so-section';
			if ( $_drawer_enabled ) $classes[] = 'gridder-list';
			if ( $_filter_enabled ) {
				$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );
				if ( empty($designation) ) $designation = '';
				
				$classes[] = 'gs-filter-single-item';
				$classes[] = sanitize_title( $designation );
				$classes[] = get_col_classes( $gs_coach_cols, $gs_coach_cols_tablet, $gs_coach_cols_mobile_portrait, $gs_coach_cols_mobile );
				$classes[] = get_coach_terms_slugs( 'gs_coach_group' );
				$classes[] = get_coach_terms_slugs( 'gs_coach_location' );
				$classes[] = get_coach_terms_slugs( 'gs_coach_language' );
				$classes[] = get_coach_terms_slugs( 'gs_coach_gender' );
				$classes[] = get_coach_terms_slugs( 'gs_coach_specialty' );
				$classes[] = get_coach_terms_slugs( 'gs_coach_extra_one' );
				$classes[] = get_coach_terms_slugs( 'gs_coach_extra_two' );
				$classes[] = get_coach_terms_slugs( 'gs_coach_extra_three' );
				$classes[] = get_coach_terms_slugs( 'gs_coach_extra_four' );
				$classes[] = get_coach_terms_slugs( 'gs_coach_extra_five' );
			}
			$single_item_attr = '';
			if ( $_drawer_enabled ) $single_item_attr = sprintf( 'data-griddercontent="#gs-coach-drawer-%s-%s"', get_the_ID(), $id );

			?>

			<!-- Start single coach -->
			<div class="gs_coach_single--wrapper <?php echo esc_attr( implode(' ', $classes) ); ?>" <?php echo wp_kses_post( $single_item_attr ); ?>>
				
				<!-- Sehema & Single coach wrapper -->
				<div class="gs_coach_single single-coach" itemscope itemtype="http://schema.org/Organization">

					<?php do_action( 'gs_coach_before_coach_content', $gs_coach_theme ); ?>
						
					<!-- Coach Image -->
					<div class="gs_coach_image__wrapper">

						<!-- Image -->
						<?php echo coach_thumbnail_with_link( $id, $gs_coach_thumbnail_sizes, $gs_coach_name_is_linked == 'on', $gs_coach_link_type, $link_preview_image == 'on' ); ?>
						
						<!-- Overlay -->
						<?php if( $link_preview_image == 'off' ) { ?>
							<div class="gs_coach_image__overlay"></div>
						<?php } ?>

						<!-- Ribbon -->
						<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>
						
					</div>

					<!-- coach Name -->
					<div class="gs_coach_info">

						<!-- coach Name -->
						<?php coach_name( $id, true, $gs_coach_name_is_linked == 'on', $gs_coach_link_type ); ?>
						<?php do_action( 'gs_coach_after_coach_name' ); ?>

						<!-- coach Designation -->
						<div class="gs-coach-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
						<?php do_action( 'gs_coach_after_coach_designation' ); ?>

						<!-- Social Links -->
						<div class="single-mem-desc-social">
							<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>
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

			<!--es not found - Load no-team-coach template -->
			<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-no-team-coach.php' ); ?>

		<?php endif; ?>

		<!-- Drawer Contents -->
		<?php include Template_Loader::locate_template( 'drawers/gs-coach-layout-drawer.php' ); ?>

	</div>

	<!-- Pagination -->
	<?php if ( 'on' == $enable_pagination ) : ?>
		<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-pagination.php' ); ?>
	<?php endif; ?>

</div>

<!-- Panel -->
<?php include Template_Loader::locate_template( 'panels/gs-coach-layout-panel.php' ); ?>
