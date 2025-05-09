<?php
namespace GSCOACH;
use GSPLUGINS\GS_Asset_Generator_Base;

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class GS_Coach_Asset_Generator extends GS_Asset_Generator_Base {

	private static $instance = null;

	public static function getInstance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function get_assets_key() {
		return 'gs-coach-coachs';
	}

	public function generateStyle( $selector, $selector_divi, $targets, $prop, $value ) {
		
		$selectors = [];

		if ( empty($targets) ) return;

		if ( gettype($targets) !== 'array' ) $targets = [$targets];

		if ( !empty($selector_divi) && ( is_divi_active() || is_divi_editor() ) ) {
			foreach ( $targets as $target ) $selectors[] = $selector_divi . $target;
		}

		foreach ( $targets as $target ) $selectors[] = $selector . $target;

		echo wp_strip_all_tags( sprintf( '%s{%s:%s}', join(',', $selectors), $prop, $value ) );

	}

	public function generateCustomCss( $settings, $shortcodeID ) {

		ob_start();

		$selector = '#gs_coach_area_' . $shortcodeID;
		$selector_divi = '#et-boc .et-l div ' . $selector;

		if ( !empty($settings['gs_tm_m_fz']) ) {
			$this->generateStyle( $selector, $selector_divi, [' .gs-coach-name', ' .gs-coach-name a'], 'font-size', $settings['gs_tm_m_fz'] . 'px' );
		}

		if ( !empty($settings['gs_tm_m_fntw']) ) {
			$this->generateStyle( $selector, $selector_divi, [' .gs-coach-name', ' .gs-coach-name a'], 'font-weight', $settings['gs_tm_m_fntw'] );
		}

		if ( !empty($settings['gs_tm_m_fnstyl']) ) {
			$this->generateStyle( $selector, $selector_divi, [' .gs-coach-name', ' .gs-coach-name a'], 'font-style', $settings['gs_tm_m_fnstyl'] );
		}

		if ( !empty($settings['gs_tm_mname_color']) ) {
			$this->generateStyle( $selector, $selector_divi, [' .gs-coach-name', ' .gs-coach-name a'], 'color', $settings['gs_tm_mname_color'] );
		}

		if ( !empty($settings['tm_bg_color']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .single-coach-div .single-coach', 'background', $settings['tm_bg_color'] );
		}
		
		if ( !empty($settings['tm_bg_color_hover']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .single-coach-div .single-coach:hover', 'background', $settings['tm_bg_color_hover'] );
		}

		if ( !empty($settings['gs_tm_ribon_color']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .gs_coach_ribbon', 'background', $settings['gs_tm_ribon_color'] );
		}
		
		if ( !empty($settings['gs_tm_info_background']) ) {
			$targets = [' .info-card', ' .single-coach-div .gs_coach_info', ' .gridder .overlay-area .overlay', '.gs_tm_theme22 .tittle_container', '.gs_tm_theme1 .single-mem-desc-social', '.gs_tm_theme2 .single-mem-desc-social', '.gs_tm_theme7 .single-mem-desc-social', '.gs_tm_theme8 .gs_coach_overlay', '.gs_tm_theme9 .gs_coach_overlay', '.gs_tm_theme11 .gs_coach_overlay', '.gs_tm_theme12 .gs_coach_overlay', '.gs_tm_theme19 .gs_coach_overlay', '.gs-coach-circle-four .single-coach-div .gs_coach_image__overlay'];
			$this->generateStyle( $selector, $selector_divi, $targets, 'background', $settings['gs_tm_info_background'] );

			$targets = [' .single-coach-div .gs_coach_info > svg path', ' .single-coach-div .single-mem-desc-social svg path'];
			$this->generateStyle( $selector, '', $targets, 'fill', $settings['gs_tm_info_background'] );
		}

		if ( !empty($settings['gs_tm_tooltip_background']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .staff-meta', 'background', $settings['gs_tm_tooltip_background'] );
			$this->generateStyle( $selector, $selector_divi, ' .staff-meta:after', 'border-top-color', $settings['gs_tm_tooltip_background'] );
		}
		
		if ( !empty($settings['gs_tm_mname_background']) ) {
			$targets = ['.gs_tm_theme8 .gs-coach-name', '.gs_tm_theme9 .gs-coach-name', '.gs_tm_theme11 .gs-coach-name', '.gs_tm_theme12 .gs-coach-name', '.gs_tm_theme19 .gs-coach-name', ' .gscoach-panel-title'];
			$this->generateStyle( $selector, $selector_divi, $targets, 'background-color', $settings['gs_tm_mname_background'] );
		}

		if ( !empty($settings['description_color']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .single-coach-div .gs_coach_info .gs-coach-desc', 'color', $settings['description_color'] );
		}

		if ( !empty($settings['description_link_color']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .single-coach-div .gs_coach_info .gs-coach-desc a', 'color', $settings['description_link_color'] );
		}

		if ( !empty($settings['info_color']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .single-coach-div .gs_coach_info .gs-coach-contact', 'color', $settings['info_color'] );
		}

		if ( !empty($settings['info_icon_color']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .single-coach-div .gs_coach_info .gs-coach-contact i', 'color', $settings['info_icon_color'] );
		}

		if ( !empty($settings['gs_tm_hover_icon_background']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .single-coach .gs_coach_overlay i', 'background-color', $settings['gs_tm_hover_icon_background'] );
		}

		if ( !empty($settings['gs_tm_role_fz']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .gs-coach-desig', 'font-size', $settings['gs_tm_role_fz'] . 'px' );
		}

		if ( !empty($settings['gs_tm_role_fntw']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .gs-coach-desig', 'font-weight', $settings['gs_tm_role_fntw'] );
		}

		if ( !empty($settings['gs_tm_role_fnstyl']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .gs-coach-desig', 'font-style', $settings['gs_tm_role_fnstyl'] );
		}

		if ( !empty($settings['gs_tm_role_color']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .gs-coach-desig', 'color', $settings['gs_tm_role_color'] );
		}
		
		if ( !empty($settings['gs_slider_nav_color']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .owl-carousel .owl-nav [class*=owl-]', 'color', $settings['gs_slider_nav_color'] );
			$this->generateStyle( $selector, $selector_divi, ' .owl-carousel .owl-nav [class*=owl-] svg path', 'fill', $settings['gs_slider_nav_color'] );
		}
		
		if ( !empty($settings['gs_slider_nav_bg_color']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .owl-carousel .owl-nav [class*=owl-]', 'background', $settings['gs_slider_nav_bg_color'] );
		}
		
		if ( !empty($settings['gs_slider_nav_hover_color']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .owl-carousel .owl-nav [class*=owl-]:hover', 'color', $settings['gs_slider_nav_hover_color'] );
			$this->generateStyle( $selector, $selector_divi, ' .owl-carousel .owl-nav [class*=owl-]:hover svg path', 'fill', $settings['gs_slider_nav_hover_color'] );
		}
		
		if ( !empty($settings['gs_slider_nav_hover_bg_color']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .owl-carousel .owl-nav [class*=owl-]:hover', 'background', $settings['gs_slider_nav_hover_bg_color'] );
		}
		
		if ( !empty($settings['gs_slider_dot_color']) ) {
			
			$this->generateStyle( $selector, $selector_divi, ' .carousel-dots--style-one .owl-dots .owl-dot span', 'background', $settings['gs_slider_dot_color'] );

			$this->generateStyle( $selector, $selector_divi, ' .carousel-dots--style-two .owl-dots .owl-dot span', 'border-color', $settings['gs_slider_dot_color'] );
			$this->generateStyle( $selector, $selector_divi, ' .carousel-dots--style-two .owl-dots .owl-dot.active span', 'background', $settings['gs_slider_dot_color'] );

			$this->generateStyle( $selector, $selector_divi, ' .carousel-dots--style-three .owl-dots .owl-dot span', 'border-color', $settings['gs_slider_dot_color'] );
			$this->generateStyle( $selector, $selector_divi, ' .carousel-dots--style-three .owl-dots .owl-dot.active span', 'background', $settings['gs_slider_dot_color'] );

		}
		
		if ( !empty($settings['gs_slider_dot_hover_color']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .carousel-dots--style-one .owl-dots .owl-dot.active span', 'background', $settings['gs_slider_dot_hover_color'] );
		}


		if ( !empty($settings['gs_tm_filter_cat_pos']) ) {
			$this->generateStyle( $selector, $selector_divi, ' .gs-coach-filter-cats', 'text-align', $settings['gs_tm_filter_cat_pos'] );
		}

		if ( !empty($settings['gs_tm_arrow_color']) ) {
			$targets = ['.mfp-gscoach .mfp-container .mfp-arrow', '.mfp-gscoach .mfp-container .mfp-arrow:hover'];
			$this->generateStyle( '', '', $targets, 'background-color', $settings['gs_tm_arrow_color'] . '!important' );
		}

		if ( !empty($settings['gs_desc_scroll_contrl']) && $settings['gs_desc_scroll_contrl'] && !empty($settings['gs_max_scroll_height']) ) {
			$gs_max_scroll_height = (int) $settings['gs_max_scroll_height'];
			if ( $gs_max_scroll_height ) {
				$targets = [
					sprintf( '.gs_coach_popup_shortcode_%s .gs-coach--scrollbar', $shortcodeID ),
					sprintf( '#gs_coach_area_%s .gridder .gridder-show .gs-coach--scrollbar', $shortcodeID )
				];
				$this->generateStyle( '', '', $targets, 'max-height', $gs_max_scroll_height . 'px !important' );
			}
		}

		if ( !empty($filter_style = $settings['filter_style']) ) {

			if ( !empty($settings['filter_text_color']) ) {
				$this->generateStyle( $selector, $selector_divi, ' .gs-coach-filter-cats li:not(.active) a', 'color', $settings['filter_text_color'] . '!important' );
			}
	
			if ( !empty($settings['filter_active_text_color']) ) {
				$this->generateStyle( $selector, $selector_divi, ' .gs-coach-filter-cats li.active a', 'color', $settings['filter_active_text_color'] . '!important' );
			}
	
			if ( !empty($settings['filter_bg_color']) && in_array($filter_style, ['style-four', 'style-five']) ) {
				$this->generateStyle( $selector, $selector_divi, ' .gs-coach-filter-cats li:not(.active) a', 'background-color', $settings['filter_bg_color'] . '!important' );
			}
	
			if ( !empty($settings['filter_active_bg_color']) && $filter_style !== 'style-one' ) {
				$this->generateStyle( $selector, $selector_divi, ' .gs-coach-filter-cats li.active a', 'background-color', $settings['filter_active_bg_color'] . '!important' );
			}
	
			if ( !empty($settings['filter_border_color']) && in_array($filter_style, ['default', 'style-three']) ) {
				$this->generateStyle( $selector, $selector_divi, ' .gs-coach-filter-cats li:not(.active) a', 'border-color', $settings['filter_border_color'] . '!important' );
			}
	
			if ( !empty($settings['filter_active_border_color']) && in_array($filter_style, ['default', 'style-three']) ) {
				$this->generateStyle( $selector, $selector_divi, ' .gs-coach-filter-cats li.active a', 'border-color', $settings['filter_active_border_color'] . '!important' );
			}

		}

		return ob_get_clean();
	}

	public function generate_assets_data( Array $settings ) {

		if ( empty($settings) || !empty($settings['is_preview']) ) return;

		$theme 						= $settings['gs_coach_theme'];
		$link_type 					= $settings['gs_coach_link_type'];
		$coach_name_linked 		= $settings['gs_coach_name_is_linked'];
		$enable_scroll_animation 	= $settings['enable_scroll_animation'];

		$carousel_enabled 	= $settings['carousel_enabled'];
		$filter_enabled 	= $settings['filter_enabled'];

		$_carousel_enabled 	= $carousel_enabled == 'on';
		$_filter_enabled 	= $filter_enabled == 'on';

		$_filter_enabled 	= ! $_carousel_enabled && $_filter_enabled;
		$_drawer_enabled 	= false;
		$_panel_enabled 	= false;

		if ( in_array( $theme, ['gs_tm_theme7'] ) ) {
			$_filter_enabled = false;
			$_carousel_enabled = true;
		}

		if ( in_array( $theme, ['gs_tm_theme9', 'gs_tm_theme12', 'gs_tm_theme21_dense', 'gs_tm_theme22', 'gs_tm_theme24', 'gs_tm_theme25'] ) ) {
			$_carousel_enabled = false;
			$_filter_enabled = true;
		}

		if ( $coach_name_linked == 'on' ) {
			$_drawer_enabled = ( ! $_carousel_enabled && ! $_filter_enabled && $link_type == 'drawer' );
			$_panel_enabled = $link_type == 'panel';
		}
		
		if ( in_array( $theme, ['gs_tm_theme13', 'gs_tm_drawer2'] ) ) {
			$_drawer_enabled = true;
		}
		
		if ( in_array( $theme, ['gs_tm_theme19'] ) ) {
			$_panel_enabled = true;
			$_filter_enabled = true;
		}

		if ( ! is_pro_valid() && in_array($link_type, ['panel', 'drawer']) ) {
			$link_type = 'default';
		}

		if ( $link_type == 'default' ) $link_type = 'single_page';
		if ( $coach_name_linked != 'on' ) $link_type = '';

		$_popup_enabled = $link_type == 'popup';

		$scroll_animation = false;
		$load_font_awesome = false;

		$this->add_item_in_asset_list( 'styles', 'gs-coach-public' );
		$this->add_item_in_asset_list( 'scripts', 'gs-coach-public', ['jquery'] );
		
		$themes = ['gs-grid-style-', 'gs-coach-circle-', 'gs-coach-horizontal-', 'gs-coach-flip-', 'gs-coach-table-', 'gs-coach-list-style-'];

		if ( str_contains( json_encode($themes), substr( $theme, 0, strrpos( $theme, '-' ) + 1 ) ) ) {
			$load_font_awesome = true;
		}

		if ( in_array( $theme, ['gs_tm_theme8', 'gs_tm_theme9', 'gs_tm_theme12'] ) ) {
			$_popup_enabled = true;
		}
		
		if ( $_popup_enabled ) {
			$load_font_awesome = true;
			$this->add_item_in_asset_list( 'scripts', 'gs-coach-public', ['gs-magnific-popup'] );
			$this->add_item_in_asset_list( 'styles', 'gs-coach-public', ['gs-magnific-popup'] );
		}
		
		if ( $scroll_animation && $enable_scroll_animation == 'on' ) {
			$this->add_item_in_asset_list( 'scripts', 'gs-coach-public', ['gs-cpb-scroller'] );
		}
		
		if ( $load_font_awesome ) {
			$this->add_item_in_asset_list( 'styles', 'gs-coach-public', ['gs-font-awesome-5'] );
		}
		
		if ( $_carousel_enabled ) {
			$this->add_item_in_asset_list( 'styles', 'gs-coach-public', ['gs-owl-carousel'] );
			$this->add_item_in_asset_list( 'scripts', 'gs-coach-public', ['gs-owl-carousel'] );
		}
		
		if ( $_drawer_enabled ) {
			$this->add_item_in_asset_list( 'scripts', 'gs-coach-public', ['gs-gridder'] );
		}
		
		if ( $_filter_enabled ) {
			$this->add_item_in_asset_list( 'scripts', 'gs-coach-public', ['gs-isotope'] );
		}
		
		if ( $_panel_enabled ) {
			$this->add_item_in_asset_list( 'scripts', 'gs-coach-public', ['gs-jquery-panelslider'] );
		}
		
		if ( $theme == 'gs_tm_theme23' ) {
			$this->add_item_in_asset_list( 'scripts', 'gs-coach-public', ['gs-jquery-flip'] );
		}
		
		if ( $theme == 'gs_tm_theme21' || $theme == 'gs_tm_theme21_dense' ) {
			$this->add_item_in_asset_list( 'styles', 'gs-coach-public', ['gs-bootstrap-table'] );
			$this->add_item_in_asset_list( 'scripts', 'gs-coach-public', ['gs-bootstrap-table'] );
		}

		// Hooked for Pro if availabel
		// do_action( 'gs_coach_assets_data_generated', $settings );

		if ( is_divi_active() ) {
			$this->add_item_in_asset_list( 'styles', 'gs-coach-divi-public', ['gs-coach-public'] );
		}

		$css = $this->get_shortcode_custom_css( $settings );

		if ( !empty($css) ) {
			$this->add_item_in_asset_list( 'styles', 'inline', minimize_css_simple($css) );
		}

	}

	public function is_builder_preview() {
		return plugin()->integrations->is_builder_preview();
	}

	public function enqueue_builder_preview_assets() {
		plugin()->scripts->wp_enqueue_style_all( 'public', ['gs-coach-divi-public'] );
		plugin()->scripts->wp_enqueue_script_all( 'public' );
		$this->enqueue_prefs_custom_css();
	}

	public function enqueue_localize_script(){
		$ajax_url = admin_url('admin-ajax.php');
		$nonce = wp_create_nonce('gscoach_user_action');
		wp_localize_script( 'gs-coach-public', 'GSCoachData', array( 'ajaxUrl' => $ajax_url, 'nonce' => $nonce ) );
	}

	public function maybe_force_enqueue_assets( Array $settings ) {

		$exclude = ['gs-coach-divi-public'];
		if ( is_divi_active() ) $exclude = [];
		
		plugin()->scripts->wp_enqueue_style_all( 'public', $exclude );
		plugin()->scripts->wp_enqueue_script_all( 'public' );

		$this->enqueue_localize_script();

		add_fs_script( 'gs-coach-public' );
		
		$this->print_google_fonts();

		// Shortcode Generated CSS
		$css = $this->get_shortcode_custom_css( $settings );
		$this->wp_add_inline_style( $css );
		
		// Prefs Custom CSS
		$this->enqueue_prefs_custom_css();

	}

	public function get_shortcode_custom_css( $settings ) {
		return $this->generateCustomCss( $settings, $settings['id'] );
	}

	public function get_prefs_custom_css() {
		$prefs = plugin()->builder->_get_shortcode_pref( false );
		if ( empty($prefs['gs_coach_custom_css']) ) return '';
		return $prefs['gs_coach_custom_css'];
	}

	public function enqueue_prefs_custom_css() {
		$this->wp_add_inline_style( $this->get_prefs_custom_css() );
	}

	public function wp_add_inline_style( $css ) {
		if ( !empty($css) ) $css = minimize_css_simple($css);
		if ( !empty($css) ) wp_add_inline_style( 'gs-coach-public', wp_strip_all_tags($css) );
	}

	public function enqueue_plugin_assets( $main_post_id, $assets = [] ) {

		if ( empty($assets) || empty($assets['styles']) || empty($assets['scripts']) ) return;

		foreach ( $assets['styles'] as $asset => $data ) {
			if ( $asset == 'inline' ) {
				$this->wp_add_inline_style( $data );
			} else {
				Scripts::add_dependency_styles( $asset, $data );
			}
		}

		foreach ( $assets['scripts'] as $asset => $data ) {
			if ( $asset == 'inline' ) {
				if ( !empty($data) ) wp_add_inline_script( 'gs-coach-public', $data );
			} else {
				Scripts::add_dependency_scripts( $asset, $data );
			}
		}

		wp_enqueue_style( 'gs-coach-public' );
		wp_enqueue_script( 'gs-coach-public' );

		$this->enqueue_localize_script();
		
		add_fs_script( 'gs-coach-public' );

		$this->print_google_fonts();

		if ( is_divi_active() ) {
			wp_enqueue_style( 'gs-coach-divi-public' );
		}

		$this->enqueue_prefs_custom_css();

	}

	public function print_google_fonts() {

		$disable_google_fonts = getoption( 'disable_google_fonts', 'off' );

		if ( $disable_google_fonts === 'on' ) return;

		wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Spartan:wght@100;200;300;400;500;600;700;800;900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Comforter&display=swap', [], null );

	}

}

if ( ! function_exists( 'gsCoachAssetGenerator' ) ) {
	function gsCoachAssetGenerator() {
		return GS_Coach_Asset_Generator::getInstance(); 
	}
}

// Must inilialized for the hooks
gsCoachAssetGenerator();