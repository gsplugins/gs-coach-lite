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

if ( ! function_exists( 'gtm_fs' ) ) {
    // Create a helper function for easy SDK access.
    function gtm_fs() {
        global $gtm_fs;

        if ( ! isset( $gtm_fs ) ) {
            // Activate multisite network integration.
            if ( ! defined( 'WP_FS__PRODUCT_1851_MULTISITE' ) ) {
                define( 'WP_FS__PRODUCT_1851_MULTISITE', true );
            }

            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $gtm_fs = fs_dynamic_init( array(
                'id'                  => '1851',
                'slug'                => 'gs-coach-members',
                'type'                => 'plugin',
                'public_key'          => 'pk_e88759b9ba026403ad505a5877eac',
                'is_premium'          => false,
                'premium_slug'        => 'gs-coach-members-premium',
                'premium_suffix'      => '- Pro',
                // If your plugin is a serviceware, set this option to false.
                'has_premium_version' => true,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'trial'               => array(
                    'days'               => 14,
                    'is_require_payment' => true,
                ),
                'has_affiliation'     => 'selected',
                'menu'                => array(
                    'slug'           => 'edit.php?post_type=gs_coach',
                    'first-path'     => 'edit.php?post_type=gs_coach&page=gs-coach-plugins-help',
                    'support'        => false,
                ),
            ) );
        }

        return $gtm_fs;
    }

    // Init Freemius.
    gtm_fs();
    // Signal that SDK was initiated.
    do_action( 'gtm_fs_loaded' );
}

if ( ! gtm_fs()->is_paying_or_trial() ) {
    function gs_coach_free_vs_pro_page() {

        add_submenu_page(
            'edit.php?post_type=gs_coach',
            'Free Pro Trial',
            'Free Pro Trial',
            'delete_posts',
            gtm_fs()->get_trial_url()
        );
    
    }
    add_action( 'admin_menu', 'gs_coach_free_vs_pro_page', 20 );

}

require_once GSCOACH_PLUGIN_DIR . 'includes/autoloader.php';
require_once GSCOACH_PLUGIN_DIR . 'includes/functions.php';
require_once GSCOACH_PLUGIN_DIR . 'includes/plugin.php';