<?php

class td_gs_coach extends \td_block {
    
    function render($atts, $content = null) {

        parent::render($atts);

        $atts = shortcode_atts([
            'gs_coach_shortcode' => $this->get_default_item()
        ], $atts);

        $content = $this->get_block_css();
        
        $content .= '<div class="wpb_wrapper td_gs_coach_block ' . $this->get_wrapper_class() . ' ' . $this->get_block_classes() . '">';
        $content .= do_shortcode( sprintf( '[gscoach id=%d]', $atts['gs_coach_shortcode'] ) );
        $content .= '</div>';

        return $content;

    }

    protected function get_default_item() {

        $shortcodes = array_values( (array) GSCOACH\get_shortcodes() );

        if ( empty($shortcodes) ) return '';

        $shortcode = array_shift( $shortcodes );

        return $shortcode['id'];

    }

}