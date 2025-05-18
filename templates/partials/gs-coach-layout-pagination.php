<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Pagination
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/partials/gs-coach-layout-pagination.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.0
 */

do_action( 'gs_coach_before_pagination' );
?>

<?php if ( 'normal-pagination' === $pagination_type ) : ?>

    <?php echo get_pagination( $id, $coach_per_page ); ?>

<?php elseif ( 'ajax-pagination' === $pagination_type ) : ?>

    <div id="gs-coach-ajax-pagination-wrapper-<?php echo esc_attr( $id ); ?>" data-posts-per-page="<?php echo esc_attr( $coach_per_page ); ?>">
        <?php echo get_ajax_pagination( $id, $coach_per_page, 1 ); ?>
    </div>
    
<?php elseif ( 'load-more-button' === $pagination_type ) : ?>

    <div class="gs-coach-load-more-wrapper">
        <button id="gs-coach-load-more-coach-btn" class="gs-coach-load-more-btn"><?php echo esc_html( $load_button_text ); ?></button>
    </div>

<?php elseif ( 'load-more-scroll' === $pagination_type ) : ?>

    <div class="gs-coach-load-more-scroll">
        <div class="gs-coach-loader-spinner" style="display: none;"><img src="<?php echo GSCOACH_PLUGIN_URI . '/assets/img/loader.svg'; ?>" alt="Loader Image"></div>
    </div>

<?php endif; ?>


<?php do_action( 'gs_coach_after_pagination' ); ?>