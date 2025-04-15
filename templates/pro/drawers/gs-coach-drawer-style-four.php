<?php
namespace GSCOACH;
$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

plugin()->hooks->load_acf_fields( $show_acf_fields, $acf_fields_position );

?>

<div class="gs-roow">

    <div class="gs-col-md-4 team-description gscoach-drawer-left">

        <!-- Coach Image -->
        <div class="gs_coach_image__wrapper">
            <?php coach_thumbnail( $gs_coach_thumbnail_sizes, true ); ?>
            <?php do_action( 'gs_coach_after_coach_thumbnail_popup' ); ?>
        </div>

    </div>


    <div class="gs-col-md-8 gscoach-drawer-right">

        <!-- Single coach name -->
        <?php coach_name( $id, true, false, $gs_coach_link_type, 'h2', 'title', true ); ?>
        <?php do_action( 'gs_coach_after_coach_name' ); ?>
        
        <!-- Single coach designation -->
        <p class="gs-coach-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></p>
        <?php do_action( 'gs_coach_after_coach_designation' ); ?>

        <!-- Description -->
        <div class="gs-coach-desc <?php echo $gs_desc_scroll_contrl == 'on' ? 'gs-coach--scrollbar' : ''; ?>" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
        <?php do_action( 'gs_coach_after_coach_details' ); ?>

        <!-- Meta Details -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-details-2.php' ); ?>

    </div>

</div>

<div class="gs_coach_certificates">
    <!-- Certificates -->
    <?php $is_certificates_enabled = 'on'; ?>
    <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-certificates.php' ); ?>
</div>