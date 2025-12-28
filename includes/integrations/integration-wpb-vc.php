<?php
namespace GSCOACH;
/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class Integration_WPB_VC {

	private static $_instance = null;
        
    public static function get_instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
        
    }

    public function __construct() {

        add_action( 'vc_before_init', [ $this, 'register_wpbakery_vc_widget' ] );

        add_action( 'admin_footer', [$this, 'print_wpbakery_vc_editor_scripts'] );
        
    }

    public function register_wpbakery_vc_widget() {

        $params = [

            'name' => __( 'GS Coaches', 'gscoach' ),
            'base' => 'gscoach',
            'description' => __( 'Show coaches from GS Coach plugin' ),
            'category' => 'GS Plugins',
            'icon' => GSCOACH_PLUGIN_URI . '/assets/img/icon.svg',
            'params' => [
                [
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Select Shortcode', 'gscoach' ),
                    'param_name' => 'id',
                    'value' => $this->get_shortcode_list(),
                    'std' => $this->get_default_item(),
                    'description' => $this->get_field_description(),
                ]
            ]
        
        ];
        
        vc_map( $params );

    }

    public function print_wpbakery_vc_editor_scripts() {

        ?>
        <script>
            
            window.onload = function() {

                if ( ! window.vc ) return;

                function wpb_vc_gs_coach_edit_link_fix() {

                    var gsCoachHandler6544_counter = 0;

                    var gsCoachHandler6544 = setInterval(function() {

                        gsCoachHandler6544_counter++;

                        var $shortcode_field = jQuery('.vc_ui-panel-window[data-vc-shortcode="gscoach"] .vc_shortcode-param[data-vc-shortcode-param-name="id"] .wpb-select');

                        if ( $shortcode_field.length || gsCoachHandler6544_counter > 100 ) clearInterval( gsCoachHandler6544 );

                        if ( $shortcode_field.length ) {

                            var $edit_link = jQuery('.vc_ui-panel-window[data-vc-shortcode="gscoach"] .vc_shortcode-param[data-vc-shortcode-param-name="id"] .gs-coach-edit-link');
                            var shortcode_id = $shortcode_field.val();
                            var href = $edit_link.attr('href');
                            href = href.substring(0, href.indexOf('/shortcode/')+11);

                            $edit_link.attr( 'href', href + shortcode_id );

                            $shortcode_field.on('change', function() {
                                shortcode_id = jQuery(this).val();
                                $edit_link.attr( 'href', href + shortcode_id );
                            });

                        }

                    }, 50);

                }

                jQuery('body').delegate( '.wpb_gscoach .vc_control-btn-edit', 'click', wpb_vc_gs_coach_edit_link_fix );
                jQuery('body').delegate( '.wpb-elements-list li.wpb-layout-element-button a#gscoach', 'click', wpb_vc_gs_coach_edit_link_fix );
                jQuery('#vc_inline-frame').contents().find('body').delegate('.vc_gscoach .vc_controls .vc_control-btn-edit', 'mouseleave', wpb_vc_gs_coach_edit_link_fix );

            };

        </script>

        <?php

    }

    protected function get_field_description() {

        $eidt_link = sprintf( '%s: <a class="gs-coach-edit-link" href="%s" target="_blank">%s</a>',
            __('Edit this shortcode', 'gscoach'),
            admin_url( "edit.php?post_type=gs_coaches&page=gs-coach-shortcode#/shortcode/" ),
            __('Edit', 'gscoach')
        );

        $create_link = sprintf( '%s: <a class="gs-coach-create-link" href="%s" target="_blank">%s</a>',
            __('Create new shortcode', 'gscoach'),
            admin_url( 'edit.php?post_type=gs_coaches&page=gs-coach-shortcode#/shortcode' ),
            __('Create', 'gscoach')
        );

        return implode( '<br />', [$eidt_link, $create_link] );

    }

    protected function get_shortcode_list() {

        $shortcodes = get_shortcodes();

        if ( !empty($shortcodes) ) {
            return wp_list_pluck( $shortcodes, 'id', 'shortcode_name' );
        }
        
        return [];

    }

    protected function get_default_item() {

        $shortcodes = get_shortcodes();

        if ( !empty($shortcodes) ) {
            return $shortcodes[0]['shortcode_name'];
        }

        return '';

    }

}