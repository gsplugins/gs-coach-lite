<?php
namespace GSCOACH;
$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

plugin()->hooks->load_acf_fields( $show_acf_fields, $acf_fields_position );

?>

<div class="gs-roow">

    <div class="gs-col-md-4 gs-col-sm-12 team-description gstm-drawer-left">

            <!-- Coach Image -->
            <div class="gs_coach_image__wrapper">
                <?php member_thumbnail( $gs_member_thumbnail_sizes, true ); ?>
                <?php do_action( 'gs_coach_after_member_thumbnail_popup' ); ?>
            </div>

            <!-- Meta Details -->
            <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-details-2.php' ); ?>

    </div>


    <div class="gs-col-md-8 gs-col-sm-12 gstm-drawer-right">

        <!-- Single member name -->
        <?php member_name( $id, true, false, $gs_member_link_type, 'h2', 'title', true ); ?>
        <?php do_action( 'gs_coach_after_member_name' ); ?>
        
        <!-- Single member designation -->
        <p class="gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></p>
        <?php do_action( 'gs_coach_after_member_designation' ); ?>

        <!-- Description -->
        <div class="gs-member-desc <?php echo $gs_desc_scroll_contrl == 'on' ? 'gs-coach--scrollbar' : ''; ?>" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
        <?php do_action( 'gs_coach_after_member_details' ); ?>

        <!-- Social Links -->
        <?php if ( ! empty( get_social_links( get_the_id() ) ) ) : ?>
            <div class="gs-tm-sicons">
                <div class="gs-tm-sicons-lable"><?php echo esc_html($gs_coach_follow_me_on); ?></div>
                <?php $gs_member_connect = 'on'; ?>
                <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>
            </div>
        <?php endif; ?>

        <!-- Meta Details -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-details-2.php' ); ?>

        <!-- Skills -->
        <?php $is_skills_title = true; ?>
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-skills.php' ); ?>
        

    </div>

</div>