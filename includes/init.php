<?php
namespace GSCOACH;

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action('plugins_loaded', function() {
    
    /**
     * Compatibility check with Pro plugin
     */
    if ( is_pro_compatible() ) {

        /**
         * Load Main Plugin
         */
        require_once GSCOACH_PLUGIN_DIR . 'includes/plugin.php';
    }
    
    /**
     * Plugins action links
     */
    add_filter( 'plugin_action_links_' . plugin_basename( GSCOACH_PLUGIN_FILE ), 'GSCOACH\add_pro_link' );
    
    /**
     * Plugins Load Text Domain
     */
    add_action( 'init', 'GSCOACH\gs_load_textdomain' );

}, -20 );