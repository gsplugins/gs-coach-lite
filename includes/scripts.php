<?php

namespace GSCOACH;

/**
 * Protect direct access
 */
if (!defined('ABSPATH')) exit;

/**
 * Handle asset loading through out the plugin.
 * 
 * @since 1.0.0
 */
final class Scripts {

	/**
	 * Contains styles handlers and paths.
	 *
	 * @since 1.0.0
	 */
	public $styles = [];

	/**
	 * Contains scripts handlers and paths.
	 *
	 * @since 1.0.0
	 */
	public $scripts = [];

	/**
	 * Class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_script'], 9999);
		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts'], 9999);
		add_action('admin_head', [$this, 'admin_menu_css']);

		return $this;
	}

    
	/**
	 * Enqueue assets for the plugin based on all dep checks and only 
	 * if current page contains the shortcode.
	 * 
	 * @since  3.0.9
	 * @return void
	 */
	public function enqueue_scripts() {

		do_action('gs_coach_assets_loaded');
	}

	public function enqueue_admin_script($hook) {
		
		if( 'post-new.php' === $hook || 'post.php' === $hook ){
			$screen = get_current_screen();

			if( 'gs_coach' !== $screen->post_type ){
				return;
			}

			// Styles
			wp_enqueue_style( 'gs-select2', GSCOACH_PLUGIN_URI . '/assets/libs/select2/select2.min.css', [], GSCOACH_VERSION );
			wp_enqueue_style( 'gs-font-awesome-5', GSCOACH_PLUGIN_URI . '/assets/libs/font-awesome/css/font-awesome.min.css', [], GSCOACH_VERSION );
			wp_enqueue_style( 'gs-coach-sort', GSCOACH_PLUGIN_URI . '/assets/admin/css/sort.min.css', [], GSCOACH_VERSION );
			wp_enqueue_style( 'gs-coach-admin', GSCOACH_PLUGIN_URI . '/assets/admin/css/admin.min.css', [], GSCOACH_VERSION );
			wp_enqueue_style( 'gs-coach-rate-it', GSCOACH_PLUGIN_URI . '/assets/rateit-js/rateit.css', [], GSCOACH_VERSION );
	

			// Scripts
			wp_enqueue_script( 'gs-select2', GSCOACH_PLUGIN_URI . '/assets/libs/select2/select2.min.js', ['jquery'], GSCOACH_VERSION, true );
			wp_enqueue_script( 'gs-coach-sort', GSCOACH_PLUGIN_URI . '/assets/admin/js/sort.min.js', ['jquery', 'jquery-ui-sortable'], GSCOACH_VERSION, true );
			wp_enqueue_script( 'gs-coach-sort-group', GSCOACH_PLUGIN_URI . '/assets/admin/js/sort-group.min.js', ['jquery', 'jquery-ui-sortable'], GSCOACH_VERSION, true );
			wp_enqueue_script( 'gs-coach-admin', GSCOACH_PLUGIN_URI . '/assets/admin/js/admin.min.js', ['jquery', 'jquery-ui-sortable', 'gs-select2'], GSCOACH_VERSION, true );
			wp_enqueue_script( 'gs-coach-rate-it', GSCOACH_PLUGIN_URI . '/assets/rateit-js/jquery.rateit.min.js', ['jquery'], GSCOACH_VERSION, true );
		}


	}

	public function admin_menu_css() {
		?>
		<style>
			#menu-posts-gs_coach li {
				clear: both
			}
/* 
			#menu-posts-gs_coach li:has( a[href^="edit.php?post_type=gs_coach&page=gs-team-members-affiliation"] ),
			#menu-posts-gs_coach li:has( a[href^="edit.php?post_type=gs_coach&page=gs-team-shortcode#/taxonomies"] ), */
			#menu-posts-gs_coach li:nth-last-child(2) {
				position: relative;
				margin-top: 16px;
			}
			
			/* #menu-posts-gs_coach li:has( a[href^="edit.php?post_type=gs_coach&page=gs-team-members-affiliation"] ):before,
			#menu-posts-gs_coach li:has( a[href^="edit.php?post_type=gs_coach&page=gs-team-shortcode#/taxonomies"] ):before, */
			#menu-posts-gs_coach li:nth-last-child(2):before {
				content: "";
				position: absolute;
				background: hsla(0, 0%, 100%, .2);
				width: calc(100%);
				height: 1px;
				top: -8px;
			}
		</style>
		<?php
	}

}