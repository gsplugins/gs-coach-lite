<?php

namespace GSCOACH;

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class Integration_Gutenberg {

	private static $_instance = null;
        
    public static function get_instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
        
    }

    public function __construct() {

        add_action( 'init', [ $this, 'load_block_script' ] );

        add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_assets' ] );
        
    }

    public function enqueue_block_editor_assets() {
		
		// Register Styles
		plugin()->scripts->wp_enqueue_style_all( 'public', ['gs-coach-divi-public'] );
		
		// Register Scripts
        plugin()->scripts->wp_enqueue_script_all( 'public', ['gs-cpb-scroller'] );

        add_fs_script( 'gs-coach-public' );

    }

    public function load_block_script() {

        wp_add_inline_style( 'wp-block-editor', $this->get_block_css() );

        wp_register_script( 'gs-coach-block', GSCOACH_PLUGIN_URI . '/includes/integrations/assets/gutenberg/gutenberg-widget.min.js', ['wp-blocks', 'wp-editor'], GSCOACH_VERSION );

        $gs_coach_block = array(
            'select_shortcode' => __( 'GS Coach Shortcode', 'gscoach' ),
            'edit_description_text' => __( 'Edit this shortcode', 'gscoach' ),
            'edit_link_text' => __( 'Edit', 'gscoach' ),
            'create_description_text' => __( 'Create new shortcode', 'gscoach' ),
            'create_link_text' => __( 'Create', 'gscoach' ),
            'edit_link' => admin_url( "edit.php?post_type=gs_coach&page=gs-coach-shortcode#/shortcode/" ),
            'create_link' => admin_url( 'edit.php?post_type=gs_coach&page=gs-coach-shortcode#/shortcode' ),
            'gs_coach_shortcodes' => $this->get_shortcode_list()
		);
		wp_localize_script( 'gs-coach-block', 'gs_coach_block', $gs_coach_block );

        register_block_type( 'gscoach/shortcodes', array(
            'editor_script' => 'gs-coach-block',
            'attributes' => [
                'shortcode' => [
                    'type'    => 'string',
                    'default' => $this->get_default_item()
                ],
                'align' => [
                    'type'=> 'string',
                    'default'=> 'wide'
                ]
            ],
            'render_callback' => [$this, 'shortcodes_dynamic_render_callback']
        ));

        register_block_type( 'gscoach/single-team-block', array(
            'editor_script' => 'gs-coach-single-block',
            'render_callback' => [$this, 'single_page_render_callback']
        ));

    }

    public function shortcodes_dynamic_render_callback( $block_attributes ) {

        $shortcode_id = ( ! empty($block_attributes) && ! empty($block_attributes['shortcode']) ) ? absint( $block_attributes['shortcode'] ) : $this->get_default_item();

        return do_shortcode( sprintf( '[gscoach id="%u"]', esc_attr($shortcode_id) ) );

    }

    public function single_page_render_callback() {

        global $post;
        
        ob_start();

        if ( empty($post) ) {
            ?>
            <div class="container gs-single-container" style="padding:3em 2em;background: rgba(126, 126, 126, 0.35);">
                <h4><?php echo __( 'GS Single Coach coach Page', 'gscoach' ) ?></h4>
            </div>
            <?php
        } else {
            include Template_Loader::locate_template( 'partials/gs-coach-layout-single.php' );
        }

        return ob_get_clean();

    }

    public function get_block_css() {

        ob_start(); ?>
    
        .gscoach-coachs--toolbar {
            padding: 20px;
            border: 1px solid #1f1f1f;
            border-radius: 2px;
        }

        .gscoach-coachs--toolbar label {
            display: block;
            margin-bottom: 6px;
            margin-top: -6px;
        }

        .gscoach-coachs--toolbar select {
            width: 250px;
            max-width: 100% !important;
            line-height: 42px !important;
        }

        .gscoach-coachs--toolbar .gs-coach-block--des {
            margin: 10px 0 0;
            font-size: 16px;
        }

        .gscoach-coachs--toolbar .gs-coach-block--des span {
            display: block;
        }

        .gscoach-coachs--toolbar p.gs-coach-block--des a {
            margin-left: 4px;
        }
    
        <?php return ob_get_clean();
    
    }

    protected function get_shortcode_list() {

        return get_shortcodes();

    }

    protected function get_default_item() {

        $shortcodes = get_shortcodes();

        if ( !empty($shortcodes) ) {
            return $shortcodes[0]['id'];
        }

        return '';

    }

}
