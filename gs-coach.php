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
 * Version:         3.0.0
 * Author:       	GS Plugins
 * Author URI:      https://www.gsplugins.com
 * Text Domain:     gscoach
 * Domain Path:     /languages
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * 
 */

/**
 * Protect direct access
 */
if (!defined('ABSPATH')) exit;

/**
 * Defining constants
 */
if (!defined('GSCOACH_VERSION')) define('GSCOACH_VERSION', '3.0.0');
if (!defined('GSCOACH_MIN_PRO_VERSION')) define('GSCOACH_MIN_PRO_VERSION', '3.0.0');
if (!defined('GSCOACH_MENU_POSITION')) define('GSCOACH_MENU_POSITION', 39);
if (!defined('GSCOACH_PLUGIN_FILE')) define('GSCOACH_PLUGIN_FILE', __FILE__);
if (!defined('GSCOACH_PLUGIN_DIR')) define('GSCOACH_PLUGIN_DIR', plugin_dir_path(__FILE__));
if (!defined('GSCOACH_PLUGIN_URI')) define('GSCOACH_PLUGIN_URI', plugins_url('', __FILE__));
if (!defined('GSCOACH_PRO_PLUGIN')) define('GSCOACH_PRO_PLUGIN', 'gs-coach-pro/gs-coach-pro.php');

require_once GSCOACH_PLUGIN_DIR . 'includes/autoloader.php';
require_once GSCOACH_PLUGIN_DIR . 'includes/functions.php';
require_once GSCOACH_PLUGIN_DIR . 'includes/plugin.php';