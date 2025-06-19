<?php

/**
 *
 * @package   GS_Coach
 * @author    GS Plugins <hello@gsplugins.com>
 * @license   GPL-2.0+
 * @link      https://www.gsplugins.com
 * @copyright 2016 GS Plugins
 *
 * @wordpress-plugin
 * Plugin Name:		GS Coach
 * Plugin URI:		https://www.gsplugins.com/wordpress-plugins
 * Description:     Best Responsive Coach plugin for Wordpress to showcase coach Image, Name, Designation, Social connectivity links. Display anywhere at your site using generated shortcode like [gscoach id=1] & widgets. Check more shortcode examples and documentation at <a href="https://coach.gsplugins.com">GS Coach PRO Demos & Docs</a>
 * Version:         2.0.0
 * Author:       	GS Plugins
 * Author URI:      https://www.gsplugins.com
 * Text Domain:     gscoach
 * Domain Path:     /languages
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * 
 * @fs_premium_only /templates/pro/
 */

/**
 * Protect direct access
 */
if (!defined('ABSPATH')) exit;

/**
 * Defining constants
 */
if (!defined('GSCOACH_VERSION')) define('GSCOACH_VERSION', '2.5.8');
if (!defined('GSCOACH_MENU_POSITION')) define('GSCOACH_MENU_POSITION', 39);
if (!defined('GSCOACH_PLUGIN_DIR')) define('GSCOACH_PLUGIN_DIR', plugin_dir_path(__FILE__));
if (!defined('GSCOACH_PLUGIN_URI')) define('GSCOACH_PLUGIN_URI', plugins_url('', __FILE__));
if (!defined('GSCOACH_PLUGIN_FILE')) define('GSCOACH_PLUGIN_FILE', __FILE__);

if( ! function_exists( 'is_pro_valid' ) ){
    function is_pro_valid(){
        return true;
    }
}


if ( ! is_pro_valid() ) {
    function gs_coach_free_vs_pro_page() {

        add_submenu_page(
            'edit.php?post_type=gs_coaches',
            'Free Pro Trial',
            'Free Pro Trial',
            'delete_posts',
            'free-pro-trial',
        );
    
    }
    add_action( 'admin_menu', 'gs_coach_free_vs_pro_page', 20 );

}

require_once GSCOACH_PLUGIN_DIR . 'includes/autoloader.php';
require_once GSCOACH_PLUGIN_DIR . 'includes/functions.php';
require_once GSCOACH_PLUGIN_DIR . 'includes/plugin.php';