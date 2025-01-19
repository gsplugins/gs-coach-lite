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
<div class="gs-containeer cbp-so-scroller gst-social-delayed gst-social-zoom-effect">

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

			$colors = ['#FF6FB5', '#0CECDD', '#FF8474', '#764AF1'];
			$post_index = 0;

			while ( $gs_coach_loop->have_posts() ): $gs_coach_loop->the_post();

			$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );
			$ribon = get_post_meta( get_the_id(), '_gs_ribon', true );
			$cell = get_post_meta( get_the_id(), '_gscoach_contact', true );

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

			$color_index = $post_index % count($colors);
			$color = $colors[ $color_index ];
			$post_index++;

			?>

			<!-- Start single member -->
			<div class="<?php echo esc_attr( implode(' ', $classes) ); ?>" <?php echo wp_kses_post( $single_item_attr ); ?>>
				
				<!-- Sehema & Single member wrapper -->
				<div class="single-member--wrapper" itemscope itemtype="http://schema.org/Organization">

					<!-- Single member thumbnail and more -->
					<div class="single-member">

						<?php do_action( 'gs_coach_before_member_content', $gs_coach_theme ); ?>
						
						<!-- Coach Image -->
						<div class="single-member--inner">

							<?php printf('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 270 276" style="enable-background:new 0 0 270 276;" xml:space="preserve"><path opacity="0.3" fill="%1$s" d="M262,115.8c0,57.6-46.8,104.4-104.5,104.4C99.8,220.2,53,173.5,53,115.8S99.8,11.5,157.5,11.5C215.2,11.5,262,58.2,262,115.8z"/><path opacity="0.3" fill="%1$s" d="M262,171.6c0,57.6-46.8,104.4-104.5,104.4C99.8,276,53,229.3,53,171.6S99.8,67.2,157.5,67.2C215.2,67.2,262,114,262,171.6z"/><path opacity="0.3" fill="%1$s" d="M270,133.4c0,57.6-46.8,104.4-104.5,104.4S61,191.1,61,133.4S107.8,29,165.5,29S270,75.8,270,133.4z"/><path opacity="0.3" fill="%1$s" d="M222.5,115.8c0,57.6-46.8,104.4-104.5,104.4S13.5,173.5,13.5,115.8S60.3,11.5,118,11.5S222.5,58.2,222.5,115.8z"/><path opacity="0.3" fill="%1$s" d="M209,166.2c0,57.6-46.8,104.4-104.5,104.4S0,223.8,0,166.2S46.8,61.8,104.5,61.8S209,108.5,209,166.2z"/><path opacity="0.3" fill="%1$s" d="M38,211.4C-2.8,170.6-2.8,104.5,38,63.7c40.8-40.8,107-40.8,147.8,0c40.8,40.8,40.8,106.9,0,147.6C144.9,252.1,78.8,252.1,38,211.4z"/><path opacity="0.3" fill="%1$s" d="M59.1,232.8C18.3,192,18.3,126,59.1,85.2c40.8-40.8,107-40.8,147.8,0c40.8,40.8,40.8,106.9,0,147.6C166.1,273.6,99.9,273.6,59.1,232.8z"/><path opacity="0.3" fill="%1$s" d="M73.9,217.8c-40.8-40.8-40.8-106.9,0-147.6c40.8-40.8,107-40.8,147.8,0c40.8,40.8,40.8,106.9,0,147.6C180.8,258.6,114.7,258.6,73.9,217.8z"/><path opacity="0.3" fill="%1$s" d="M215.7,202c0,0,78.2-72.9-7.8-168.8c-86-95.9-147.7,53-146.8,104.4C61.9,189,65.4,289.7,215.7,202z"/><path opacity="0.3" fill="%1$s" d="M226.1,190.7c0,0,71.2-86.8-47.8-167.5c0,0-154.2-48.2-145.3,114.3L226.1,190.7z"/><path opacity="0.3" fill="%1$s" d="M43.3,97.8c0,0-66.5,69.1,28.2,138.7c94.7,69.6,140.3,25.4,154.6-45.8C240.4,119.5,133,73.5,133,73.5L43.3,97.8z"/><path opacity="0.3" fill="%1$s" d="M85.8,46.8c0,0-103.9,37.2-50,143.9C89.7,297.5,215.7,202,215.7,202l-108.6-98.4L85.8,46.8z"/><path opacity="0.3" fill="%1$s" d="M126.9,227.4c0,0,57.5,23.4,100,0s30.4-186.6-50-155.4C96.5,103.3,126.9,227.4,126.9,227.4z"/><path opacity="0.3" fill="%1$s" d="M50,159c0,0-43.1-77.2-6.7-104.4C79.6,27.4,78.6-8.1,118,1.7s130,2.6,119.4,114.2C226.9,227.4,50,159,50,159z"/></svg>', esc_attr($color) ); ?>

							<div class="gs_coach_image__wrapper">
								
								<?php member_thumbnail( $gs_member_thumbnail_sizes, true ); ?>
								<div class="gs_coach_image__overlay"></div>
	
								<!-- Social Links -->
								<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>
	
							</div>

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

							<?php if ( !empty($cell) ) : ?>
								<div class="gs-member-contact">
									<i class="fas fa-phone"></i>
									<?php echo esc_html( $cell ); ?>
								</div>
								<?php do_action( 'gs_coach_after_member_cell_number' ); ?>
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