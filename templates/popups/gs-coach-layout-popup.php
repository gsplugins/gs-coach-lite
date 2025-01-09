<?php
namespace GSCOACH;
/**
 * GS Coach - Layout Popup
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/partials/gs-coach-layout-popup.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.2
 */

if ( ! $_popup_enabled ) return;

plugin()->hooks->load_acf_fields( $show_acf_fields, $acf_fields_position );

?>

<div id="gs_coach_popup_<?php echo get_the_id(); ?>_<?php echo esc_attr($id); ?>" class="gs_coach_popup_shortcode_<?php echo esc_attr($id); ?> white-popup mfp-hide mfp-with-anim gs_coach_popup <?php echo esc_attr($popup_style); ?>">
    <div class="mfp-content--container">
        <?php

        if ( ! is_pro_valid() ) {
            include Template_Loader::locate_template( 'popups/gs-coach-popup-default.php' );     
        } 
        else {
            switch ( $popup_style ) {
                case 'style-one': {
                    include Template_Loader::locate_template( 'popups/gs-coach-popup-style-one.php' );
                    break;
                }
                case 'style-two': {
                    include Template_Loader::locate_template( 'popups/gs-coach-popup-style-two.php' );
                    break;
                }
                case 'style-three': {
                    include Template_Loader::locate_template( 'popups/gs-coach-popup-style-three.php' );
                    break;
                }
                case 'style-four': {
                    include Template_Loader::locate_template( 'popups/gs-coach-popup-style-four.php' );
                    break;
                }
                case 'style-five': {
                    include Template_Loader::locate_template( 'popups/gs-coach-popup-style-five.php' );
                    break;
                }
                case 'style-six': {
                    include Template_Loader::locate_template( 'popups/gs-coach-popup-style-six.php' );
                    break;
                }
                default: {
                    include Template_Loader::locate_template( 'popups/gs-coach-popup-default.php' );
                }
            }
        }
        
        ?>
    </div>
</div>