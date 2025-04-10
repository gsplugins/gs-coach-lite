<?php
namespace GSCOACH;
$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

plugin()->hooks->load_acf_fields( $show_acf_fields, $acf_fields_position );

?>

<div class="gs-roow">

    <div class="gs-col-md-6 team-description gscoach-drawer-left">

            <!-- Single coach name -->
            <?php coach_name( $id, true, false, $gs_coach_link_type, 'h2', 'title', true ); ?>
            <?php do_action( 'gs_coach_after_coach_name' ); ?>
            
            <!-- Single coach designation -->
            <p class="gs-coach-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></p>
            <?php do_action( 'gs_coach_after_coach_designation' ); ?>

            <!-- Single coach description -->
            <div class="gs-coach-desc <?php echo $gs_desc_scroll_contrl == 'on' ? 'gs-coach--scrollbar' : ''; ?>" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
            <?php do_action( 'gs_coach_after_coach_details' ); ?>

            <!-- Meta Fields -->
            <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-fields.php' ); ?>

    </div>


    <div class="gs-col-md-6 gscoach-drawer-right">

        <!-- Meta Details -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-details-2.php' ); ?>

        <!-- Skills -->
        <?php $is_skills_title = true; ?>
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-skills.php' ); ?>

        <!-- Social Links -->
        <?php if ( ! empty( get_social_links( get_the_id() ) ) ) : ?>
            <div class="gs-tm-sicons">
                <div class="gs-tm-sicons-lable"><?php echo esc_html($gs_coach_follow_me_on); ?></div>
                <?php $gs_coach_connect = 'on'; ?>
                <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>
            </div>
        <?php endif; ?>
        

    </div>

</div>

<div class="gs_coach_certificates">
    <!-- Certificates -->
    <?php $is_certificates_enabled = 'on'; ?>
    <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-certificates.php' ); ?>
</div>