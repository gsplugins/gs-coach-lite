<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Social Links
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/partials/gs-coach-layout-social-links.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.0
 */

$social_links = get_social_links( get_the_id() );

if ( 'on' == $gs_coach_connect && !empty($social_links) ): ?>

    <ul class="gs-coach-social">

    <?php foreach ( $social_links as $social ) :

        $linkclass = str_replace( ['fa-', 'fab', 'fas', 'far'], '', $social['icon'] );
        $linkclass = trim($linkclass);
        
        if ( str_contains( $social['icon'], 'envelope' ) ) {
            $link = !empty($social['link']) ? 'mailto:' . $social['link'] : '#';
        } else {
            $link = !empty($social['link']) ? $social['link'] : '#';
        } ?>

        <li>
            <?php printf( '<a class="%s" href="%s" target="_blank" itemprop="sameAs"><i class="%s"></i></a>', esc_attr($linkclass), esc_url($link), esc_attr($social['icon']) ); ?>
        </li>

    <?php endforeach; ?>
        
    </ul>

    <?php do_action( 'gs_coach_after_coach_social_links' ); ?>

<?php endif; ?>