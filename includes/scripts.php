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
		$this->add_assets();

		add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_script'], 9999);
		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts'], 9999);
		// add_action('admin_head', [$this, 'print_plugin_icon_css']);

		return $this;
	}

    	/**
	 * Adding assets on the $this->styles[] array.
	 *
	 * @since 1.0.0
	 */
	public function add_assets() {
        // Styles
		$this->add_style('gs-select2', GSCOACH_PLUGIN_URI . '/assets/libs/select2/select2.min.css', [], GSCOACH_VERSION, 'all');
		$this->add_style('gs-font-awesome-5', GSCOACH_PLUGIN_URI . '/assets/libs/font-awesome/css/font-awesome.min.css', [], GSCOACH_VERSION, 'all');
		// $this->add_style('gs-team-sort', GSTEAM_PLUGIN_URI . '/assets/admin/css/sort.min.css', ['gs-font-awesome-5'], GSTEAM_VERSION, 'all');
		$this->add_style('gs-coach-admin', GSCOACH_PLUGIN_URI . '/assets/admin/css/admin.css', [], GSCOACH_VERSION, 'all');
		// $this->add_style('gs-bootstrap-grid', GSTEAM_PLUGIN_URI . '/assets/libs/bootstrap-grid/bootstrap-grid.min.css', [], GSTEAM_VERSION, 'all');
		// $this->add_style('gs-bootstrap-table', GSTEAM_PLUGIN_URI . '/assets/libs/bootstrap-table/bootstrap-table.min.css', [], GSTEAM_VERSION, 'all');
		// $this->add_style('gs-magnific-popup', GSTEAM_PLUGIN_URI . '/assets/libs/magnific-popup/magnific-popup.min.css', [], GSTEAM_VERSION, 'all');
		// $this->add_style('gs-owl-carousel', GSTEAM_PLUGIN_URI . '/assets/libs/owl-carousel/owl-carousel.min.css', [], GSTEAM_VERSION, 'all');
		// $this->add_style('gs-team-public', GSTEAM_PLUGIN_URI . '/assets/css/gs-team.min.css', ['gs-bootstrap-grid'], GSTEAM_VERSION, 'all');

		// // Scripts
		$this->add_script('gs-select2', GSCOACH_PLUGIN_URI . '/assets/libs/select2/select2.min.js', ['jquery'], GSCOACH_VERSION, true);
		// $this->add_script('gs-team-sort', GSTEAM_PLUGIN_URI . '/assets/admin/js/sort.min.js', ['jquery', 'jquery-ui-sortable'], GSTEAM_VERSION, true);
		// $this->add_script('gs-team-sort-group', GSTEAM_PLUGIN_URI . '/assets/admin/js/sort-group.min.js', ['jquery', 'jquery-ui-sortable'], GSTEAM_VERSION, true);
		$this->add_script('gs-coach-admin', GSCOACH_PLUGIN_URI . '/assets/admin/js/admin.js', ['jquery'], GSCOACH_VERSION, true);
		// $this->add_script('gs-bootstrap-table', GSTEAM_PLUGIN_URI . '/assets/libs/bootstrap-table/bootstrap-table.min.js', ['jquery'], GSTEAM_VERSION, true);
		// $this->add_script('gs-cpb-scroller', GSTEAM_PLUGIN_URI . '/assets/libs/cpb-scroller/cpb-scroller.min.js', ['jquery'], GSTEAM_VERSION, true);
		// $this->add_script('gs-gridder', GSTEAM_PLUGIN_URI . '/assets/libs/gridder/gridder.min.js', ['jquery'], GSTEAM_VERSION, true);
		// $this->add_script('gs-isotope', GSTEAM_PLUGIN_URI . '/assets/libs/isotope/isotope.min.js', ['jquery'], GSTEAM_VERSION, true);
		// $this->add_script('gs-jquery-flip', GSTEAM_PLUGIN_URI . '/assets/libs/jquery-flip/jquery-flip.min.js', ['jquery'], GSTEAM_VERSION, true);
		// $this->add_script('gs-jquery-panelslider', GSTEAM_PLUGIN_URI . '/assets/libs/jquery-panelslider/jquery-panelslider.min.js', ['jquery'], GSTEAM_VERSION, true);
		// $this->add_script('gs-magnific-popup', GSTEAM_PLUGIN_URI . '/assets/libs/magnific-popup/magnific-popup.min.js', ['jquery'], GSTEAM_VERSION, true);
		// $this->add_script('gs-owl-carousel', GSTEAM_PLUGIN_URI . '/assets/libs/owl-carousel/owl-carousel.min.js', ['jquery'], GSTEAM_VERSION, true);
		// $this->add_script('gs-team-public', GSTEAM_PLUGIN_URI . '/assets/js/gs-team.min.js', ['jquery'], GSTEAM_VERSION, true);

        do_action('gs_coach__add_assets', $this);
    }

    /**
	 * Store styles on the $this->styles[] queue.
	 * 
	 * @since 1.0.0
	 * 
	 * @param  string  $handler Name of the stylesheet.
	 * @param  string  $src     Full URL of the stylesheet
	 * @param  array   $deps    Array of registered stylesheet handles this stylesheet depends on.
	 * @param  boolean $ver     Specifying stylesheet version number
	 * @param  string  $media   The media for which this stylesheet has been defined.
	 * @return void
	 */
	public function add_style($handler, $src, $deps = [], $ver = false, $media = 'all') {
		$this->styles[$handler] = [
			'src' => $src,
			'deps' => $deps,
			'ver' => $ver,
			'media' => $media
		];
	}

    /**
	 * Store scripts on the $this->scripts[] queue.
	 * 
	 * @since 1.0.0
	 * 
	 * @param  string  $handler  Name of the script.
	 * @param  string  $src      Full URL of the script
	 * @param  array   $deps      Array of registered script handles this script depends on.
	 * @param  boolean $ver       Specifying script version number
	 * @param  boolean $in_footer Whether to enqueue the script before </body> instead of in the <head>
	 * @return void
	 */
	public function add_script($handler, $src, $deps = [], $ver = false, $in_footer = false) {
		$this->scripts[$handler] = [
			'src' => $src,
			'deps' => $deps,
			'ver' => $ver,
			'in_footer' => $in_footer
		];
	}

    	/**
	 * Return style if exits on the $this->styles[] list.
	 * 
	 * @since 3.0.9
	 * @param string $handler The style name.
	 */
	public function get_style($handler) {
		if (empty($style = $this->styles[$handler])) {
			return false;
		}

		return $style;
	}

	/**
	 * Return the script if exits on the $this->scripts[] list.
	 * 
	 * @since 3.0.9
	 * @param string $handler The script name.
	 */
	public function get_script($handler) {
		if (empty($script = $this->scripts[$handler])) {
			return false;
		}

		return $script;
	}

    	/**
	 * A wrapper for registering styles.
	 * 
	 * @since 1.0.0
	 * 
	 * @param  string       $handler The name of the stylesheet.
	 * @return boolean|void          If it gets the stylesheet then register it or false.
	 */
	public function wp_register_style($handler) {
		$style = $this->get_style($handler);

		if (!$style) {
			return;
		}

		$deps = (array) apply_filters($handler . '--style', $style['deps']);
		wp_register_style(
			$handler,
			$style['src'],
			$deps,
			$style['ver'],
			$style['media']
		);
	}

	/**
	 * A wrapper for registering scripts.
	 * 
	 * @since 1.0.0
	 * 
	 * @param  string       $handler The name of the script.
	 * @return boolean|void          If it gets the script then register it or false.
	 */
	public function wp_register_script($handler) {
		$script = $this->get_script($handler);

		if (!$script) {
			return;
		}

		$deps = (array) apply_filters($handler . '--script', $script['deps']);
		wp_register_script(
			$handler,
			$script['src'],
			$deps,
			$script['ver'],
			$script['in_footer']
		);
	}

    // 	/**
	//  * Returns all publicly enqueuable stylesheets.
	//  * 
	//  * @since  1.0.0
	//  * @return array List of publicly enqueuable stylesheets.
	//  */
	// public function _get_public_style_all() {
	// 	return (array) apply_filters('gs_team_get_public_style_all', [
	// 		'gs-bootstrap-grid',
	// 		'gs-bootstrap-table',
	// 		'gs-font-awesome-5',
	// 		'gs-magnific-popup',
	// 		'gs-owl-carousel',
	// 		'gs-team-public',
	// 		'gs-team-divi-public'
	// 	]);
	// }

    
	// /**
	//  * Returns all publicly enqueuable scripts.
	//  * 
	//  * @since  1.0.0
	//  * @return array List of publicly enqueuable scripts.
	//  */
	// public function _get_public_script_all() {
	// 	return (array) apply_filters('gs_team_get_public_script_all', [
	// 		'gs-bootstrap-table',
	// 		'gs-cpb-scroller',
	// 		'gs-gridder',
	// 		'gs-isotope',
	// 		'gs-jquery-flip',
	// 		'gs-jquery-panelslider',
	// 		'gs-magnific-popup',
	// 		'gs-owl-carousel',
	// 		'gs-team-public'
	// 	]);
	// }

	/**
	 * Returns all admin enqueuable stylesheets.
	 * 
	 * @since  1.0.0
	 * @return array List of admin enqueuable stylesheets.
	 */
	public function _get_admin_style_all() {
		return (array) apply_filters('gs_coach_get_admin_style_all', [
			'gs-select2',
			'gs-font-awesome-5',
			'gs-coach-admin'
		]);
	}

	/**
	 * Returns all admin enqueuable scripts.
	 * 
	 * @since  1.0.0
	 * @return array List of admin enqueuable scripts.
	 */
	public function _get_admin_script_all() {
		return (array) apply_filters('gs_coach_get_admin_script_all', [
			'gs-select2',
			'gs-coach-admin'
		]);
	}

    
	public function _get_assets_all($asset_type, $group, $excludes = []) {

		if (!in_array($asset_type, ['style', 'script']) || !in_array($group, ['public', 'admin'])) {
			return;
		}

		$get_assets = sprintf('_get_%s_%s_all', $group, $asset_type);
		$assets     = $this->$get_assets();

		if (!empty($excludes)) {
			$assets = array_diff($assets, $excludes);
		}

		return (array) apply_filters(sprintf('gs_coach_%s__%s_all', $group, $asset_type), $assets);
	}

	public function _wp_load_assets_all($function, $asset_type, $group, $excludes = []) {
		if (!in_array($function, ['enqueue', 'register']) || !in_array($asset_type, ['style', 'script'])) {
			return;
		}

		$assets   = $this->_get_assets_all($asset_type, $group, $excludes);
		$function = sprintf('wp_%s_%s', $function, $asset_type);

		foreach ($assets as $asset) {
			$this->$function($asset);
		}
	}

    
	public function wp_register_style_all($group, $excludes = []) {
		$this->_wp_load_assets_all('register', 'style', $group, $excludes);
	}

	public function wp_enqueue_style_all($group, $excludes = []) {
		$this->_wp_load_assets_all('enqueue', 'style', $group, $excludes);
	}

	public function wp_register_script_all($group, $excludes = []) {
		$this->_wp_load_assets_all('register', 'script', $group, $excludes);
	}

	public function wp_enqueue_script_all($group, $excludes = []) {
		$this->_wp_load_assets_all('enqueue', 'script', $group, $excludes);
	}

    
	// Use to direct enqueue
	public function wp_enqueue_style($handler) {
		$style = $this->get_style($handler);

		if (!$style) {
			return;
		}

		$deps = (array) apply_filters($handler . '--style-enqueue', $style['deps']);
		wp_enqueue_style(
			$handler,
			$style['src'],
			$deps,
			$style['ver'],
			$style['media']
		);
	}

	public function wp_enqueue_script($handler) {
		$script = $this->get_script($handler);

		if (!$script) {
			return;
		}

		$deps = (array) apply_filters($handler . '--script-enqueue', $script['deps']);

		wp_enqueue_script(
			$handler,
			$script['src'],
			$deps,
			$script['ver'],
			$script['in_footer']
		);
	}

    
	/**
	 * Enqueue assets for the plugin based on all dep checks and only 
	 * if current page contains the shortcode.
	 * 
	 * @since  3.0.9
	 * @return void
	 */
	public function enqueue_scripts() {

		// Register Styles
		$this->wp_register_style_all('public');

		// Register Scripts
		$this->wp_register_script_all('public');

		// Enqueue for Single & Archive Pages
		if (is_singular('gs_coach') || is_post_type_archive('gs_coach') || is_tax(['gs_coach_group', 'gs_coach_tag'])) {
			$this->add_dependency_styles('gs-coach-public', ['gs-font-awesome-5']);
			wp_enqueue_style('gs-coach-public');
		}

		// Maybe enqueue assets
		// gsTeamAssetGenerator()->enqueue(gsTeamAssetGenerator()->get_current_page_id());

		do_action('gs_coach_assets_loaded');
	}

	public function enqueue_admin_script($hook) {

		global $post;

		$load_script = false;

		// Register Styles
		$this->wp_register_style_all('admin');

		// Register Scripts
		$this->wp_register_script_all('admin');

		// Allow scripts loading in new gs_coach member page
		if ($hook == 'post-new.php' && $_GET['post_type'] == 'gs_coach') $load_script = true;

		// Allow scripts loading in gs_coach member edit page
		if ($hook == 'post.php' && $post->post_type == 'gs_coach') $load_script = true;

		// Allow scripts loading in gs_coach member edit page
		if ($hook == 'edit-tags.php' && $_GET['post_type'] == 'gs_coach') $load_script = true;
		if ($hook == 'term.php' && $_GET['post_type'] == 'gs_coach') $load_script = true;

		// Abort load script if not allowed
		if (!$load_script) return;

		// Enqueue Styles
		wp_enqueue_style('gs-coach-admin');

		// Enqueue Scripts
		wp_enqueue_script('gs-coach-admin');

		// add_fs_script('gs-team-admin');
	}

	public static function add_dependency_scripts($handle, $scripts) {

		add_action('wp_footer', function () use ($handle, $scripts) {

			global $wp_scripts;

			if (empty($scripts) || empty($handle)) return;
			if (!isset($wp_scripts->registered[$handle])) return;

			$wp_scripts->registered[$handle]->deps = array_unique(array_merge($wp_scripts->registered[$handle]->deps, $scripts));
		});
	}

	public static function add_dependency_styles($handle, $styles) {

		global $wp_styles;

		if (empty($styles) || empty($handle)) return;
		if (!isset($wp_styles->registered[$handle])) return;

		$wp_styles->registered[$handle]->deps = array_unique(array_merge($wp_styles->registered[$handle]->deps, $styles));
	}

}