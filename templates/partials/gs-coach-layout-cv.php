<?php

namespace GSCOACH;
/**
 * GS Coach - Layout CV
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/partials/gs-coach-layout-cv.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.0
 */


$coach_id = get_the_id();
$cv_url = get_post_meta( $coach_id, '_gscoach_cv', true );

if ( ! $cv_url ) {
    return;
}

if( 'on' !== $is_cv_enabled ) return;

$cv_title = 'CV';
?>

<h2 class="gs-coach-cv-title"><?php echo esc_html( $cv_title ); ?></h2>
<div class="gs-coach-cv-wrapper">
    <object class="pdf" 
            data="<?php echo esc_url($cv_url); ?>"
            width="800"
            height="500">
    </object>
</div>