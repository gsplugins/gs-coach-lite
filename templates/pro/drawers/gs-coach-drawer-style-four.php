<?php
namespace GSCOACH;
$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

plugin()->hooks->load_acf_fields( $show_acf_fields, $acf_fields_position );

?>

<div class="gs-roow">

    <div class="gs-col-md-4 team-description gstm-drawer-left">

        <!-- Coach Image -->
        <div class="gs_coach_image__wrapper">
            <?php member_thumbnail( $gs_member_thumbnail_sizes, true ); ?>
            <?php do_action( 'gs_coach_after_member_thumbnail_popup' ); ?>
        </div>

    </div>


    <div class="gs-col-md-8 gstm-drawer-right">

        <!-- Single member name -->
        <?php member_name( $id, true, false, $gs_member_link_type, 'h2', 'title', true ); ?>
        <?php do_action( 'gs_coach_after_member_name' ); ?>
        
        <!-- Single member designation -->
        <p class="gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></p>
        <?php do_action( 'gs_coach_after_member_designation' ); ?>

        <!-- Description -->
        <div class="gs-member-desc <?php echo $gs_desc_scroll_contrl == 'on' ? 'gs-coach--scrollbar' : ''; ?>" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
        <?php do_action( 'gs_coach_after_member_details' ); ?>

        <!-- Meta Fields -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-fields.php' ); ?>

        <!-- Meta Details -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-details-2.php' ); ?>

    </div>

</div>