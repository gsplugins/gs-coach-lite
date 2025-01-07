<?php

namespace GSCOACH;
/**
 * GS Coach - Single Template 
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-single.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.2
 */

remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

get_header();

$display_ribbon = 'on';

$gs_coach_follow_me_on = get_translation( 'gs_coach_follow_me_on' );

include Template_Loader::locate_template( 'partials/gs-coach-layout-single.php' );

get_footer();