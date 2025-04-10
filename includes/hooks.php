<?php

namespace GSCOACH;

if (!defined('ABSPATH')) exit;

class Hooks {

    public function __construct() {
        add_action( 'in_admin_header', [$this, 'disable_admin_notices'], PHP_INT_MAX );
        add_action( 'do_meta_boxes', [ $this, 'change_image_box' ] );        
        add_filter( 'admin_post_thumbnail_html', [ $this, 'img_size_note' ] );        
        add_filter( 'single_template', [ $this, 'single_template' ], -1 );
        add_filter( 'archive_template', [ $this, 'archive_template' ], -1 );
        add_filter( 'plugin_action_links_' . plugin_basename(GSCOACH_PLUGIN_FILE), [ $this, 'pro_link' ] );
        add_action( 'init', [ $this, 'plugin_update_version' ], 0 );
        add_action( 'plugins_loaded', [ $this, 'plugin_loaded' ] );
        add_action( 'init', [ $this, 'GS_flush_rewrite_rules' ] );
        add_filter( 'excerpt_length', [ $this, 'excerpt_length' ], 99999 );
        add_action( 'plugins_loaded', [ $this, 'i18n'] );
        add_filter( 'jetpack_content_options_featured_image_exclude_cpt', [$this, 'jetpack__featured_image_exclude_cpt']);
        add_action( 'admin_menu', array( $this, 'register_sub_menu') );

        add_filter( 'post_type_archive_link', [ $this, 'post_type_archive_link' ], 2, 10 );

        register_activation_hook( GSCOACH_PLUGIN_FILE, [ $this, 'plugin_activate' ] );

    }

    function register_sub_menu() {
        add_submenu_page(
            'edit.php?post_type=gs_coach', 'Taxonomies', 'Taxonomies', 'publish_pages', 'gs-coach-shortcode#/taxonomies', array( plugin()->builder, 'view' )
        );
    }

    function post_type_archive_link( $link, $post_type ) {
        if ( $post_type === 'gs_coach' && ! empty( $archive_page_slug = getoption('archive_page_slug') ) ) {
            $archive_page_slug = ltrim( $archive_page_slug, '/\\' );
            if ( esc_url_raw( $archive_page_slug ) === $archive_page_slug ) return $archive_page_slug;
            return home_url( sanitize_text_field( $archive_page_slug ) );
        }
        return $link;
    }

    function jetpack__featured_image_exclude_cpt( $excluded_post_types ) {
        return array_merge( $excluded_post_types, ['gs_coach'] );
    }

    function disable_admin_notices() {
        global $parent_file;
        if ( $parent_file != 'edit.php?post_type=gs_coach' ) return;
        remove_all_actions( 'network_admin_notices' );
        remove_all_actions( 'user_admin_notices' );
        remove_all_actions( 'admin_notices' );
        remove_all_actions( 'all_admin_notices' );
    }

    public function change_image_box() {
        remove_meta_box('postimagediv', 'gs_coach', 'side');
        add_meta_box('postimagediv', __('Coach coach Image'), 'post_thumbnail_meta_box', 'gs_coach', 'side', 'low');
    }
    
    public function img_size_note($content) {
        global $post_type, $post;
    
        if ($post_type == 'gs_coach') {
            if (!has_post_thumbnail($post->ID)) {
                $content .= '<p>' . __('Recommended image size 400px X 400px for perfect view on various devices.', 'gscoach') . '</p>';
            }
        }
        return $content;
    }
    
    public function display_acf_fields() {
        include Template_Loader::locate_template('partials/gs-coach-layout-acf-fields.php');
    }
    
    public function load_acf_fields($show = 'off', $position = 'after_skills') {
    
        if ($show != 'on') return;
    
        switch ($position) {
    
            case 'after_meta_details':
                $action = 'gs_coach_after_coach_details_popup';
                break;
    
            case 'after_description':
                $action = 'gs_coach_after_coach_details';
                break;
    
            default:
                $action = 'gs_coach_after_coach_skills';
        }
    
        add_action($action, [ $this, 'display_acf_fields' ]);
    }
    
    public function single_template($single_team_template) {
        global $post;

        if ($post->post_type == 'gs_coach') {
            $show_acf_fields         = getoption('show_acf_fields', 'off');
            $acf_fields_position     = getoption('acf_fields_position', 'after_skills');
            $this->load_acf_fields($show_acf_fields, $acf_fields_position);
            $single_team_template = Template_Loader::locate_template('gs-coach-template-single.php');
        }

        return $single_team_template;
    }
    
    public function archive_template($archive_template) {

        if (is_post_type_archive('gs_coach')) {
            $archive_template = Template_Loader::locate_template('gs-coach-template-archive.php');
        }

        if (is_tax(['gs_coach_group', 'gs_coach_tag', 'gs_coach_gender', 'gs_coach_location', 'gs_coach_language', 'gs_coach_specialty'])) {
            $archive_template = Template_Loader::locate_template('gs-coach-template-archive.php');
        }

        return $archive_template;
    }
    
    public function pro_link($gsCoach_links) {
        $gsCoach_links[] = '<a href="https://www.gsplugins.com/wordpress-plugins" target="_blank">GS Plugins</a>';
        return $gsCoach_links;
    }
    
    public function plugin_update_version() {
    
        $old_version = get_option('gs_coach_plugin_version');
    
        if (GSCOACH_VERSION === $old_version) return;
    
        update_option('gs_coach_plugin_version', GSCOACH_VERSION);
    
        plugin()->builder->maybe_upgrade_data($old_version);
        GS_Coach_Asset_Generator::getInstance()->assets_purge_all();
    }
    
    // Plugin On Activation
    public function plugin_activate() {
        plugin()->cpt->register();
        flush_rewrite_rules();
        GS_Coach_Asset_Generator::getInstance()->assets_purge_all();
    }    
    
    // Plugin On Loaded
    public function plugin_loaded() {
        Builder::maybe_create_shortcodes_table();
    }    
    
    // Reset Permalinks
    public function GS_flush_rewrite_rules() {
        if (!get_option('GS_Coach_plugin_permalinks_flushed')) {
            flush_rewrite_rules();
            update_option('GS_Coach_plugin_permalinks_flushed', 1);
        }
    }
    
    // Excerpt Length
    public function excerpt_length($length) {
    
        global $post;
        if ($post->post_type == 'gs_coach') $length = 150;
        return $length;
    }
    
    // Load translations
    public function i18n() {
        load_plugin_textdomain('gscoach', false, dirname(plugin_basename(GSCOACH_PLUGIN_FILE)) . '/languages');
    }
}
