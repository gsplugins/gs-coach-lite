<?php

namespace GSCOACH;

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class Shortcode {

	public function __construct() {

		// Ajax Filter
		add_action('wp_ajax_gscoach_filter_coaches', [ $this, 'gscoach_filter_coaches' ]);
		add_action('wp_ajax_nopriv_gscoach_filter_coaches', [ $this, 'gscoach_filter_coaches' ]);

		// Load More Button and Infinite Scroll
		add_action('wp_ajax_gscoach_load_more_coach', [ $this, 'load_more_coach' ]);
		add_action('wp_ajax_nopriv_gscoach_load_more_coach', [ $this, 'load_more_coach' ]);

		// Ajax Pagination
		add_action('wp_ajax_gscoach_ajax_pagination', [ $this, 'ajax_pagination' ]);
		add_action('wp_ajax_nopriv_gscoach_ajax_pagination', [ $this, 'ajax_pagination' ]);

		add_filter( 'post_thumbnail_html', [ $this, 'gscoach_post_thumbnail_html' ], 999999 );
		add_shortcode( 'gscoach', [ $this, 'shortcode' ] );

		if ( is_pro_valid() ) {
			add_shortcode( 'gs_coach_sidebar', [ $this, 'sidebar_shortcode' ] );		
		}
	}

	public function gscoach_filter_coaches(){
		if( ! check_ajax_referer('gscoach_user_action') ) wp_send_json_error( __('Unauthorised Request', 'gscoach'), 401 );

		$shortcode_id = $_POST['shortcodeId'];
		$is_preview = is_numeric($shortcode_id) ? false : true;
		
		$filters = $_POST['filters'];
		
		$coaches = $this->shortcode( array( 'id'=> $shortcode_id, 'preview' => $is_preview ), array( 'filters' => $filters ) );

		wp_send_json_success(array( 'coaches' => $coaches ), 200 );
		wp_die();
	}

	public function load_more_coach(){
		if( ! check_ajax_referer('gscoach_user_action') ) wp_send_json_error( __('Unauthorised Request', 'gscoach'), 401 );

		$shortcode_id = $_POST['shortcodeId'];
		$is_preview = is_numeric($shortcode_id) ? false : true;

		$load_per_action = $_POST['loadPerAction'];
		$offset = $_POST['offset'];
		
		$coaches = $this->shortcode( array( 'id'=> $shortcode_id, 'preview' => $is_preview ), array( 'load_per_action' => $load_per_action, 'offset' => $offset ) );

		$found_coaches = $GLOBALS['gs_coach_loop']->found_posts;

		wp_send_json_success(array( 'coaches' => $coaches, 'foundCoaches' => $found_coaches ), 200 );
		wp_die();
	}

	public function ajax_pagination(){
		if( ! check_ajax_referer('gscoach_user_action') ) wp_send_json_error( __('Unauthorised Request', 'gscoach'), 401 );

		$shortcode_id = $_POST['shortcode_id'];
		$is_preview = is_numeric($shortcode_id) ? false : true;

		$posts_per_page = $_POST['posts_per_page'];
		$paged = $_POST['paged'];
		
		$coaches = $this->shortcode( array( 'id'=> $shortcode_id, 'preview' => $is_preview ), array( 'paged' => $paged, 'posts_per_page' => $posts_per_page ) );

		$pagination = get_ajax_pagination( $shortcode_id, $posts_per_page, $paged );

		wp_send_json_success(array( 'coaches' => $coaches, 'pagination' => $pagination ), 200 );
		wp_die();
	}

	function gscoach_post_thumbnail_html( $html ) {
		remove_all_filters( 'post_thumbnail_html' );
		return $html;
	}

	function add_zip_codes_search_element( $theme ) {
		if ( in_array( $theme, ['gs_tm_theme21_dense'] ) ) return;
		$tag = 'div';
		printf( '<%1$s class="gs-coach-coach--zip-codes" style="display:none!important">%2$s</%1$s>', $tag, get_post_meta( get_the_ID(), '_gs_zip_code', true ) );
	}

	function add_tags_search_element( $theme ) {
		if ( in_array( $theme, ['gs_tm_theme21_dense'] ) ) return;
		$tag = 'div';

        $terms = get_the_terms( get_the_ID(), 'gs_coach_tag' );
        $terms = join( ' ', wp_list_pluck($terms, 'name') );
		
		printf( '<%1$s class="gs-coach-coach--tags" style="display:none!important">%2$s</%1$s>', $tag, $terms );
	}
	
	function shortcode( $atts, $ajax_datas = array() ) {

		if ( empty($atts['id']) ) {
			return __( 'No shortcode ID found', 'gscoach' );
		}
	
		$is_preview = ! empty($atts['preview']);
	
		$settings = (array) $this->get_shortcode_settings( $atts['id'], $is_preview );
	
		// By default force mode
		$force_asset_load = true;
	
		if ( ! $is_preview ) {
		
			// For Asset Generator
			$main_post_id = gsCoachAssetGenerator()->get_current_page_id();
	
			$asset_data = gsCoachAssetGenerator()->get_assets_data( $main_post_id );
	
			if ( empty($asset_data) ) {
				// Saved assets not found
				// Force load the assets for first time load
				// Generate the assets for later use
				gsCoachAssetGenerator()->generate( $main_post_id, $settings );
			} else {
				// Saved assets found
				// Stop force loading the assets
				// Leave the job for Asset Loader
				$force_asset_load = false;
			}
	
		}
	
		$gs_coach_nxt_prev 			= getoption( 'gs_coach_nxt_prev', 'off' );
		$single_page_style 				= getoption( 'single_page_style', 'default' );
		$gs_coach_search_all_fields 	= getoption( 'gs_coach_search_all_fields', 'off' );
		$gs_coach_enable_multilingual 	= getoption( 'gs_coach_enable_multilingual', 'off' );
		$default_link_type 				= getoption( 'single_link_type', 'single_page' );
	
		$gs_coachfliter_designation 	= get_translation( 'gs_coachfliter_designation' );
		$gs_coachfliter_name 		= get_translation( 'gs_coachfliter_name' );
		$gs_coachfliter_company 		= get_translation( 'gs_coachfliter_company' );
		$gs_coachfliter_zip 			= get_translation( 'gs_coachfliter_zip' );
		$gs_coachfliter_tag 			= get_translation( 'gs_coachfliter_tag' );
		$gs_coachcom_meta 			= get_translation( 'gs_coachcom_meta' );
		$gs_coachadd_meta 			= get_translation( 'gs_coachadd_meta' );
		$gs_coachlandphone_meta 		= get_translation( 'gs_coachlandphone_meta' );
		$gs_coachcellPhone_meta 		= get_translation( 'gs_coachcellPhone_meta' );
		$gs_coachemail_meta 			= get_translation( 'gs_coachemail_meta' );
		$gs_coach_zipcode_meta 		= get_translation( 'gs_coach_zipcode_meta' );
		$gs_coach_follow_me_on 		= get_translation( 'gs_coach_follow_me_on' );
		
		$gs_coach_read_on 			= get_translation( 'gs_coach_read_on' );
		$gs_coach_more 				= get_translation( 'gs_coach_more' );
		$gs_coach_vcard_txt 			= get_translation( 'gs_coach_vcard_txt' );
	
		$gs_coach_reset_filters_txt 	= get_translation( 'gs_coach_reset_filters_txt' );
		$gs_coach_next_txt 			= get_translation( 'gs_coach_next_txt' );
		$gs_coach_prev_txt 			= get_translation( 'gs_coach_prev_txt' );
		
		if ( get_query_var('paged') ) {
			$gs_tm_paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
			$gs_tm_paged = get_query_var('page');
		} else {
			$gs_tm_paged = 1;
		}
	
		global $popup_style;
		global $gs_coach_ribbon_style;
	
		// Extracting shortcode attributes.
		extract( $settings );

		$hide_empty = $group_hide_empty === 'on';
	
		$_carousel_enabled 	= $carousel_enabled == 'on';
		$_filter_enabled 	= ! $_carousel_enabled && $filter_enabled == 'on';
		$_drawer_enabled 	= false;
		$_panel_enabled 	= false;
		$_popup_enabled 	= false;
	
		if ( $gs_coach_name_is_linked == 'on' ) {
		
			if ( $gs_coach_link_type == 'default' ) {
				if ( $default_link_type == 'none' ) $gs_coach_name_is_linked = 'off';
			}
	
			if ( ! is_pro_valid() ) {
				if ( $gs_coach_link_type == 'popup' ) $popup_style = 'default';
				if ( in_array($gs_coach_link_type, ['panel', 'drawer', 'custom']) ) $gs_coach_link_type = 'default';
			}
	
			$_drawer_enabled = ( ! $_carousel_enabled && ! $_filter_enabled && $gs_coach_link_type == 'drawer' );
			$_panel_enabled = $gs_coach_link_type == 'panel';
			$_popup_enabled = $gs_coach_link_type == 'popup';
		}
	
		if ( in_array( $gs_coach_theme, ['gs_tm_theme19'] ) ) {
			$_panel_enabled = true;
		}
	
		$carousel_navs_enabled = $carousel_navs_enabled == 'on';
		$carousel_dots_enabled = $carousel_dots_enabled == 'on';
	
		if ( empty($fitler_all_text) ) $fitler_all_text = 'All';
	
		if ( ! is_pro_valid() && $display_ribbon == 'on' ) $gs_coach_ribbon_style = 'default';

		if ( ! is_pro_valid() && $gs_coach_link_type == 'popup' ) $popup_style = 'default';
	
		$args = [
			'order'          => sanitize_text_field( $order ),
			'orderby'        => sanitize_text_field( $orderby ),
			'posts_per_page' => (int) $num,
			'paged'          => (int) $gs_tm_paged,
			'tax_query' 	=> [],
		];

		if( ! wp_doing_ajax() && ('off' !== $enable_pagination) ){
			if( 'load-more-button' === $pagination_type ){
				$args['posts_per_page'] = 6;
			} elseif( 'ajax-pagination' === $pagination_type ){
				$args['posts_per_page'] = $coach_per_page;
			} elseif( 'load-more-scroll' === $pagination_type ){
				$args['posts_per_page'] = 6;
			}
		}

		if( 'on' === $enable_pagination ){
			if( 'normal-pagination' === $pagination_type ){
				$shortcode_id = $id;
				$paged_var = 'paged' . $shortcode_id;
				$paged = max( 1, $_GET["$paged_var"] ?? 1 );
				$args["paged"] = $paged;
				$args['posts_per_page'] = $coach_per_page;
			} elseif( wp_doing_ajax() && ('ajax-pagination' === $pagination_type) ){
				$args["paged"] = $ajax_datas['paged'];
				$args['posts_per_page'] = $ajax_datas['posts_per_page'];
			} elseif( wp_doing_ajax() && ('load-more-button' === $pagination_type) ){
				$args['posts_per_page'] = (int) $ajax_datas['load_per_action'];
				$args['offset'] = (int) $ajax_datas['offset'];
			} elseif( wp_doing_ajax() && ('load-more-scroll' === $pagination_type) ){
				$args['posts_per_page'] = (int) $ajax_datas['load_per_action'];
				$args['offset'] = (int) $ajax_datas['offset'];
			}
		}
	
		if ( !empty($group) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_group',
				'field'    => 'term_id',
				'terms'    => explode( ',', $group ),
			];
		}
	
		if ( !empty($tag) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_tag',
				'field'    => 'term_id',
				'terms'    => explode( ',', $tag ),
			];
		}
	
		if ( !empty($location) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_location',
				'field'    => 'term_id',
				'terms'    => explode( ',', $location ),
			];
		}
	
		if ( !empty($specialty) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_specialty',
				'field'    => 'term_id',
				'terms'    => explode( ',', $specialty ),
			];
		}
	
		if ( !empty($language) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_language',
				'field'    => 'term_id',
				'terms'    => explode( ',', $language ),
			];
		}
	
		if ( !empty($gender) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_gender',
				'field'    => 'term_id',
				'terms'    => explode( ',', $gender ),
			];
		}
	
		if ( !empty($include_extra_one) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_extra_one',
				'field'    => 'term_id',
				'terms'    => explode( ',', $include_extra_one ),
			];
		}
	
		if ( !empty($include_extra_two) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_extra_two',
				'field'    => 'term_id',
				'terms'    => explode( ',', $include_extra_two ),
			];
		}
	
		if ( !empty($include_extra_three) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_extra_three',
				'field'    => 'term_id',
				'terms'    => explode( ',', $include_extra_three ),
			];
		}
	
		if ( !empty($include_extra_four) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_extra_four',
				'field'    => 'term_id',
				'terms'    => explode( ',', $include_extra_four ),
			];
		}
	
		if ( !empty($include_extra_five) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_extra_five',
				'field'    => 'term_id',
				'terms'    => explode( ',', $include_extra_five ),
			];
		}

			
		if ( !empty($exclude_group) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_group',
				'field'    => 'term_id',
				'terms'    => explode( ',', $exclude_group ),
				'operator' => 'NOT IN',
			];
		}
			
		if ( !empty($exclude_tags) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_tag',
				'field'    => 'term_id',
				'terms'    => explode( ',', $exclude_tags ),
				'operator' => 'NOT IN',
			];
		}
			
		if ( !empty($exclude_language) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_language',
				'field'    => 'term_id',
				'terms'    => explode( ',', $exclude_language ),
				'operator' => 'NOT IN',
			];
		}
			
		if ( !empty($exclude_location) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_location',
				'field'    => 'term_id',
				'terms'    => explode( ',', $exclude_location ),
				'operator' => 'NOT IN',
			];
		}
			
		if ( !empty($exclude_specialty) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_specialty',
				'field'    => 'term_id',
				'terms'    => explode( ',', $exclude_specialty ),
				'operator' => 'NOT IN',
			];
		}
			
		if ( !empty($exclude_gender) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_gender',
				'field'    => 'term_id',
				'terms'    => explode( ',', $exclude_gender ),
				'operator' => 'NOT IN',
			];
		}
			
		if ( !empty($exclude_extra_one) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_extra_one',
				'field'    => 'term_id',
				'terms'    => explode( ',', $exclude_extra_one ),
				'operator' => 'NOT IN',
			];
		}
			
		if ( !empty($exclude_extra_two) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_extra_two',
				'field'    => 'term_id',
				'terms'    => explode( ',', $exclude_extra_two ),
				'operator' => 'NOT IN',
			];
		}
			
		if ( !empty($exclude_extra_three) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_extra_three',
				'field'    => 'term_id',
				'terms'    => explode( ',', $exclude_extra_three ),
				'operator' => 'NOT IN',
			];
		}
			
		if ( !empty($exclude_extra_four) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_extra_four',
				'field'    => 'term_id',
				'terms'    => explode( ',', $exclude_extra_four ),
				'operator' => 'NOT IN',
			];
		}
			
		if ( !empty($exclude_extra_five) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'gs_coach_extra_five',
				'field'    => 'term_id',
				'terms'    => explode( ',', $exclude_extra_five ),
				'operator' => 'NOT IN',
			];
		}

		if( wp_doing_ajax() && ! empty($ajax_datas['filters']) ){
			$filters = $ajax_datas['filters'];
	
			if ( ! empty($filters) ) {
				
				if( ! empty($filters['search']) ) {
					// Search through title
					$args['s'] = $filters['search'];
				}

				if( ! empty($filters['tagSearch']) ) {
					// Search through tags

					$matched_terms = get_terms([
						'taxonomy'   => 'gs_coach_tag',
						'hide_empty' => false,
						'name__like' => $filters['tagSearch'],
					]);

					$term_ids = wp_list_pluck($matched_terms, 'term_id');

					if( ! empty($term_ids) ) {
						$args['tax_query'][] = [
							'taxonomy' => 'gs_coach_tag',
							'field'    => 'term_id',
							'terms'    => $term_ids
						];
					}
				}

				if( ! empty($filters['designation']) ) {
					// Search through designation
					$args['meta_query'][] = [
						'key'     => '_gscoach_profession',
						'value'   => $filters['designation']
					];
				}
								
				if( ! empty($filters['group']) ) {
					// Search through group
					$args['tax_query'][] = [
						'taxonomy' => 'gs_coach_group',
						'field'    => 'slug',
						'terms'    => $filters['group']
					];
				}

				if( ! empty($filters['language']) ) {
					// Search through language
					$args['tax_query'][] = [
						'taxonomy' => 'gs_coach_language',
						'field'    => 'slug',
						'terms'    => $filters['language']
					];
				}
				
				if( ! empty($filters['location']) ) {
					// Search through location
					$args['tax_query'][] = [
						'taxonomy' => 'gs_coach_location',
						'field'    => 'slug',
						'terms'    => $filters['location']
					];
				}

				if( ! empty($filters['gender']) ) {
					// Search through gender
					$args['tax_query'][] = [
						'taxonomy' => 'gs_coach_gender',
						'field'    => 'slug',
						'terms'    => $filters['gender']
					];
				}

				if( ! empty($filters['specialty']) ) {
					// Search through specialty
					$args['tax_query'][] = [
						'taxonomy' => 'gs_coach_specialty',
						'field'    => 'slug',
						'terms'    => $filters['specialty']
					];
				}

				if( ! empty($filters['extra_one']) ) {
					// Search through extra_one
					$args['tax_query'][] = [
						'taxonomy' => 'gs_coach_extra_one',
						'field'    => 'slug',
						'terms'    => $filters['extra_one']
					];
				}

				if( ! empty($filters['extra_two']) ) {
					// Search through extra_two
					$args['tax_query'][] = [
						'taxonomy' => 'gs_coach_extra_two',
						'field'    => 'slug',
						'terms'    => $filters['extra_two']
					];
				}

				if( ! empty($filters['extra_three']) ) {
					// Search through extra_three
					$args['tax_query'][] = [
						'taxonomy' => 'gs_coach_extra_three',
						'field'    => 'slug',
						'terms'    => $filters['extra_three']
					];
				}

				if( ! empty($filters['extra_four']) ) {
					// Search through extra_four
					$args['tax_query'][] = [
						'taxonomy' => 'gs_coach_extra_four',
						'field'    => 'slug',
						'terms'    => $filters['extra_four']
					];
				}

				if( ! empty($filters['extra_five']) ) {
					// Search through extra_five
					$args['tax_query'][] = [
						'taxonomy' => 'gs_coach_extra_five',
						'field'    => 'slug',
						'terms'    => $filters['extra_five']
					];
				}
			}

		}
	
		$GLOBALS['gs_coach_loop'] = get_query( $args );

		if( wp_doing_ajax() && ('load-more-button' === $pagination_type) && ! $GLOBALS['gs_coach_loop']->have_posts() ){
			wp_send_json_success( array(
				'projects_status' => 'end',
				'message' => __('End of the Coaches', 'gscoach')
			), 200 );
		}

		if( wp_doing_ajax() && ('load-more-scroll' === $pagination_type) && ! $GLOBALS['gs_coach_loop']->have_posts() ){
			wp_send_json_success( array(
				'projects_status' => 'end',
				'message' => __('End of the Coaches', 'gscoach')
			), 200 );
		}
	
		if ( ! is_pro_valid() ) {
			
			$free_themes = wp_list_pluck( Builder::get_free_themes() , 'value' );
			$initial_theme = $gs_coach_theme;
	
			if ( ! in_array( $initial_theme, $free_themes ) ) {
				$gs_coach_theme		             = 'gs-grid-style-five';
				$gs_coach_connect               = 'on';
				$gs_coach_name                  = 'on';
				$gs_coach_role                  = 'on';
				$gs_coach_details               = 'on';
			}
	
			$carousel_navs_style = 'default';
			$carousel_dots_style = 'default';
	
		}
	
		$data_options = [
			'search_through_all_fields' => $gs_coach_search_all_fields,
			'enable_clear_filters' => $gs_coach_enable_clear_filters,
			'reset_filters_text' => $gs_coach_reset_filters_txt,
			'enable_multi_select' => $gs_coach_enable_multi_select,
			'multi_select_ellipsis' => $gs_coach_multi_select_ellipsis,
			'next_txt' => $gs_coach_next_txt,
			'prev_txt' => $gs_coach_prev_txt,
		];

		if( 'ajax-pagination' === $pagination_type ){
			$data_options['coach_per_page'] = $coach_per_page;
		} elseif( 'load-more-button' === $pagination_type ){
			$data_options['load_per_click'] = $load_per_click;
		} elseif( 'load-more-scroll' === $pagination_type ){
			$data_options['per_load'] = $per_load;
		}
	
		$theme_class = $gs_coach_theme;
	
		if ( $gs_coach_theme == 'gs_tm_theme25' ) {
			$theme_class .= ' gs_tm_theme22';
		}
	
		
		$v_2_themes = get_themes_list( 2, 'both', 'value' );
	
		if ( in_array( $gs_coach_theme, $v_2_themes ) ) {
			$theme_class .= ' gs_tm_theme_v_2';
		} else {
			$theme_class .= ' gs_tm_theme_v_1';
		}
		
		// Load Template Hooks
		if ( 'on' ==  $gs_coach_srch_by_zip ) {
			add_action( 'gs_coach_before_coach_content', [ $this, 'add_zip_codes_search_element' ] );
		}
		if ( 'on' ==  $gs_coach_srch_by_tag ) {
			add_action( 'gs_coach_before_coach_content', [ $this, 'add_tags_search_element' ] );
		}

		$img_effect_class = '';

		if ( is_pro_valid() ) {
			$img_effect_class = "gs-coach--img-efect_$image_filter gs-coach--img-hover-efect_$hover_image_filter";
		}
	
		ob_start(); ?>
		
		<div id="gs_coach_area_<?php echo esc_attr($id); ?>" data-shortcode-id="<?php echo esc_attr($id); ?>" class="wrap gs_coach_area gs_coach_loading <?php echo esc_attr($theme_class); ?> <?php echo esc_attr($img_effect_class); ?>" data-options='<?php echo json_encode($data_options); ?>' style="visibility: hidden; opacity: 0;">
	
			<?php
	
			do_action( 'gs_coach_template_before__loaded', $gs_coach_theme );
	
			if ( ! is_pro_valid() ) {
				require_once GSCOACH_PLUGIN_DIR . 'includes/restrict-template.php';
			}
	
			if ( $gs_coach_theme == 'gs-grid-style-four') {
				
				if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
				if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
				include Template_Loader::locate_template( 'gs-grid-style-four.php' );
			}
	
			if ( $gs_coach_theme == 'gs-grid-style-five') {
				
				if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
				if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
				include Template_Loader::locate_template( 'gs-grid-style-five.php' );
			}
	
			if ( $gs_coach_theme == 'gs-coach-circle-one') {
				
				if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
				if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
				include Template_Loader::locate_template( 'gs-coach-circle-one.php' );
			}
	
			if ( $gs_coach_theme == 'gs_tm_theme1' || $gs_coach_theme == 'gs_tm_theme2' ) {
				
				if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
				if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
				include Template_Loader::locate_template( 'gs-coach-layout-default-1.php' );
			}
	
			if ( $gs_coach_theme == 'gs_tm_theme20' ) {
				
				if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
				if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
	
				include Template_Loader::locate_template( 'gs-coach-layout-grid.php' );
			}
			
			if ( $gs_coach_theme == 'gs_tm_theme8' ) {
				
				if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'popup';
				if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
	
				include Template_Loader::locate_template( 'gs-coach-layout-popup.php' );
			}
	
			if ( $gs_coach_theme == 'gs_tm_theme7' ) {
				
				if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
				if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
	
				include Template_Loader::locate_template( 'gs-coach-layout-slider.php' );
			}
	
			if ( $gs_coach_theme == 'gs_tm_grid2' ) {
				
				if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
				if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
	
				include Template_Loader::locate_template( 'gs-coach-layout-grid-2.php' );
			}
	
			if ( is_pro_valid() ) {

				if ( $gs_coach_theme == 'gs-grid-style-one') {
						
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-grid-style-one.php' );
				}
				
				if ( $gs_coach_theme == 'gs-grid-style-two') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-grid-style-two.php' );
				}
				
				if ( $gs_coach_theme == 'gs-grid-style-three') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-grid-style-three.php' );
				}
					
				if ( $gs_coach_theme == 'gs-grid-style-six') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-grid-style-six.php' );
				}
					
				if ( $gs_coach_theme == 'gs-grid-style-seven') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-grid-style-seven.php' );
				}
					
				if ( $gs_coach_theme == 'gs-grid-style-eight') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-grid-style-eight.php' );
				}
					
				if ( $gs_coach_theme == 'gs-grid-style-nine') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-grid-style-nine.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-circle-two') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-circle-two.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-circle-three') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-circle-three.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-circle-four') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-circle-four.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-circle-five') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-circle-five.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-circle-seven') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-circle-seven.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-circle-eight') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-circle-eight.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-circle-nine') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-circle-nine.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-circle-ten') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-circle-ten.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-horizontal-one') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-horizontal-one.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-horizontal-two') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-horizontal-two.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-horizontal-three') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-horizontal-three.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-horizontal-four') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-horizontal-four.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-horizontal-five') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-horizontal-five.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-horizontal-six') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-horizontal-six.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-horizontal-seven') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-horizontal-seven.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-horizontal-eight') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-horizontal-eight.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-horizontal-nine') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-horizontal-nine.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-horizontal-ten') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-horizontal-ten.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-flip-one') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-flip-one.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-flip-two') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-flip-two.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-flip-three') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-flip-three.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-flip-four') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-flip-four.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-flip-five') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-flip-five.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-table-one') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-table-one.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-table-two') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-table-two.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-table-three') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-table-three.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-table-four') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-table-four.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-table-five') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-table-five.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-list-style-one') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-list-style-one.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-list-style-two') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-list-style-two.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-list-style-three') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-list-style-three.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-list-style-four') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-list-style-four.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-list-style-five') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-list-style-five.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-list-style-six') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-list-style-six.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-list-style-seven') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-list-style-seven.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-list-style-eight') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-list-style-eight.php' );
				}
				
				if ( $gs_coach_theme == 'gs-coach-list-style-nine') {
					
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
					
					include Template_Loader::locate_template( 'pro/gs-coach-list-style-nine.php' );
				}

				if ( $gs_coach_theme == 'gs_tm_theme10' ) {
			
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
					include Template_Loader::locate_template( 'pro/gs-coach-layout-greyscale.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme_custom_10' ) {
							
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
					include Template_Loader::locate_template( 'pro/gs-coach-layout-custom-ten.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme11' ) {
				
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
					include Template_Loader::locate_template( 'pro/gs-coach-layout-popup-2.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme22' ) {
					include Template_Loader::locate_template( 'pro/gs-coach-layout-filter-3.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme9' ) {
				
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'popup';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
					include Template_Loader::locate_template( 'pro/gs-coach-layout-filter.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme12' ) {
				
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'popup';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
					include Template_Loader::locate_template( 'pro/gs-coach-layout-filter-2.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme24' ) {
				
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
					include Template_Loader::locate_template( 'pro/gs-coach-layout-filter-4.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme19' ) {
					include Template_Loader::locate_template( 'pro/gs-coach-layout-panelslide.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme13' || $gs_coach_theme == 'gs_tm_drawer2' ) {
				
					$gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
					include Template_Loader::locate_template( 'pro/gs-coach-layout-drawer.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme23' ) {
				
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
					include Template_Loader::locate_template( 'pro/gs-coach-layout-flip.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme14' ) {
				
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
					include Template_Loader::locate_template( 'pro/gs-coach-layout-table.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme15' ) {
				
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
					include Template_Loader::locate_template( 'pro/gs-coach-layout-table-box.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme16') {
				
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
					include Template_Loader::locate_template( 'pro/gs-coach-layout-table-odd-even.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme21' ) {
				
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
					include Template_Loader::locate_template( 'pro/gs-coach-layout-table-filter.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme21_dense' ) {
				
					if ( $gs_coach_link_type == 'default' ) $gs_coach_link_type = 'single_page';
					if ( $gs_coach_name_is_linked != 'on' ) $gs_coach_link_type = '';
				
					include Template_Loader::locate_template( 'pro/gs-coach-layout-table-filter-dense.php' );
				}
				
				if ( $gs_coach_theme == 'gs_tm_theme25' ) {
					include Template_Loader::locate_template( 'pro/gs-coach-layout-group-filter.php' );
				}

				if ( $gs_coach_theme == 'gs_tm_theme26' ) {
					include Template_Loader::locate_template( 'pro/gs-coach-layout-ticker.php' );
				}
	
			}
			
			do_action( 'gs_coach_template_after__loaded', $gs_coach_theme );
	
			wp_reset_postdata();
	
			?>
	
		</div>
		
		<?php

	
		// Fire force asset load when needed
		if ( plugin()->integrations->is_builder_preview() || $force_asset_load ) {

			gsCoachAssetGenerator()->force_enqueue_assets( $settings );
			wp_add_inline_script( 'gs-coach-public', "jQuery(document).trigger( 'gscoach:scripts:reprocess' );jQuery(function() { jQuery(document).trigger( 'gscoach:scripts:reprocess' ) })" );

			// Shortcode Custom CSS
			$css = gsCoachAssetGenerator()->get_shortcode_custom_css( $settings );
			if ( !empty($css) ) printf( "<style>%s</style>" , minimize_css_simple($css) );
			
			// Prefs Custom CSS
			$css = gsCoachAssetGenerator()->get_prefs_custom_css();
			if ( !empty($css) ) printf( "<style>%s</style>" , minimize_css_simple($css) );

		}

		return ob_get_clean();
	
	}

	public function get_shortcode_settings($id, $is_preview = false) {

		$default_settings = array_merge( ['id' => $id, 'is_preview' => $is_preview], plugin()->builder->get_shortcode_default_settings() );

		if ( $is_preview ) {
			$preview_settings = plugin()->builder->validate_shortcode_settings( get_transient($id) );
			return shortcode_atts( $default_settings, $preview_settings );
		}
	
		$shortcode = plugin()->builder->_get_shortcode($id);
		return shortcode_atts( $default_settings, (array) $shortcode['shortcode_settings'] );

	}
	
	// -- Shortcode for widget [gs_coach_sidebar]
	public function sidebar_shortcode( $atts ) {

		extract(shortcode_atts([
			'total_mem' => -1,
			'group_mem' => ''
		], $atts ));

		$GLOBALS['gs_coach_loop_side'] = get_query([
			'posts_per_page'	=> (int) $total_mem,
			'gs_coach_group'		=> sanitize_text_field( $group_mem )
		]);

		ob_start();

		include Template_Loader::locate_template( 'pro/gs-coach-layout-sidebar.php' );
		
		wp_reset_postdata();

		Scripts::add_dependency_styles( 'gs-coach-public', ['gs-font-awesome-5'] );
		wp_enqueue_style( 'gs-coach-public' );

		return ob_get_clean();

	}
}
