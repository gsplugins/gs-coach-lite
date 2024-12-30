<?php

/**
 *
 * @package   GS_COACH
 * @author    GS Plugins <hello@gsplugins.com>
 * @license   GPL-2.0+
 * @link      https://www.gsplugins.com
 * @copyright 2016 GS Plugins
 *
 * @wordpress-plugin
 * Plugin Name:		GS Coach
 * Plugin URI:		https://www.gsplugins.com/wordpress-plugins
 * Description:     Best Responsive Coach plugin for Wordpress
 * Version:         2.0.0
 * Author:       	GS Plugins
 * Author URI:      https://www.gsplugins.com
 * Text Domain:     gscoach
 * Domain Path:     /languages
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * Protect direct access
 */
if ( !defined( 'ABSPATH' ) ) exit;


/**
 * Defining constants
 */
if ( ! defined( 'GSCOACH_VERSION' ) ) define( 'GSCOACH_VERSION', '2.0.0' );
if ( ! defined( 'GSCOACH_PLUGIN_DIR' ) ) define( 'GSCOACH_PLUGIN_DIR', plugin_dir_path(__FILE__ ) );
if ( ! defined( 'GSCOACH_PLUGIN_URI' ) ) define( 'GSCOACH_PLUGIN_URI', plugins_url('', __FILE__ ) );
if ( ! defined( 'GSCOACH_PLUGIN_FILE' ) ) define( 'GSCOACH_PLUGIN_FILE', __FILE__ );


require_once GSCOACH_PLUGIN_DIR . 'includes/autoloader.php';
require_once GSCOACH_PLUGIN_DIR . 'includes/functions.php';
require_once GSCOACH_PLUGIN_DIR . 'includes/plugin.php';


