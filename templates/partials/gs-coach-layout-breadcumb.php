<?php

namespace GSCOACH;
/**
 * GS Coach - Breadcumb Template
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-breadcumb.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.0
 */

if( 'on' === $is_breadcumb_enabled ):

    $home_url = home_url();
    $seperator = ' > ';
    $current_page = get_the_title();
    // get post type slug
    $post_type = get_post_type();
    $post_type_obj = get_post_type_object( $post_type );
    $post_type_slug = ucfirst($post_type_obj->rewrite['slug']);
    $post_type_archive_link = get_post_type_archive_link( $post_type );

?>
<!-- Temporary style -->
<style>
    ul.gs-coach-breadcumb-list li {
    display: inline-block;
}
</style>

<div class="gs-coach-breadcumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="gs-coach-breadcumb-list">
                    <li><a href="<?php echo esc_url( $home_url ); ?>"><?php _e( 'Home', 'gs-coach' ); ?></a><?php echo $seperator; ?></li>
                    <li><a href="<?php echo esc_url( $post_type_archive_link ); ?>"><?php echo esc_html( $post_type_slug ); ?></a><?php echo esc_html( $seperator ); ?></li>
                    <li><?php echo esc_html( $current_page ); ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>