<?php

namespace GSCOACH;
/**
 * GS Coach - Meta Fields Template
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-meta-fields.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.0
 */
?>

<!-- Temporary style -->
<style>
    .star-rating {
        display: inline-block;
    }
</style>

<?php

foreach ( gs_get_sort_metas() as $meta ) {
    $meta_value = get_post_meta( get_the_id(), $meta['key'], true );
    if ( empty( $meta['name'] ) ) continue;

    if( '_gscoach_rating' !== $meta['key'] ){
        ?>
            <div class="gs-coach-meta-fields">
                <span class="gs-coach-meta-label"><?php echo get_meta_field_name($meta['key']) . ': '; ?></span>
                <span class="gs-coach-meta-info"><?php echo esc_html( $meta_value ); ?></span>
            </div>
        <?php
    } else {
        ?>
            <div class="gs-coach-rating">
                <span class="gs-coach-meta-label"><?php echo get_meta_field_name($meta['key']) . ': '; ?></span>
                <span class="gs-coach-meta-rating"><?php esc_html( gs_star_rating( array( 'rating' => $meta_value ) ) ); ?></span>
            </div>
        <?php
    }
}


?>