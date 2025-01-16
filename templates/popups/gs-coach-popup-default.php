<?php
namespace GSCOACH;
if ( $gs_coachmembers_pop_clm == 'one' ) : ?>

    <div class="gs_coach_popup_details gs-tm-sicons popup-one-column">
        
        <!-- Coach Image -->
        <div class="clearfix">
            <?php member_thumbnail( $gs_member_thumbnail_sizes, true ); ?>
        </div>
        <?php do_action( 'gs_coach_after_member_thumbnail_popup' ); ?>

        <!-- Member Name -->
        <?php member_name( $id, true, false, 'single_page', 'h2' ); ?>
        <?php do_action( 'gs_coach_after_member_name' ); ?>

        <!-- Member Designation -->
        <?php if ( !empty( $designation ) ): ?>
            <div class="gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
            <?php do_action( 'gs_coach_after_member_designation' ); ?>
        <?php endif; ?>

        <!-- Social Links -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>

        <!-- Meta Fields -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-fields.php' ); ?>

        <!-- Description -->
        <div class="gs-member-desc <?php echo $gs_desc_scroll_contrl == 'on' ? 'gs-coach--scrollbar' : ''; ?>" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
        <?php do_action( 'gs_coach_after_member_details' ); ?>
        
        <!-- Meta Details -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-details.php' ); ?>

        <!-- Skills -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-skills.php' ); ?>

        <div class="gs_member_certificates">
            <!-- Certificates -->
            <?php $is_certificates_enabled = 'on'; ?>
            <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-certificates.php' ); ?>
        </div>

    </div>

<?php else: ?>

    <div class="gs_coach_popup_left__wrapper">
    
        <!-- Coach Image -->
        <div class="gs_coach_popup_img">
            <?php member_thumbnail( $gs_member_thumbnail_sizes, true ); ?>
            <?php do_action( 'gs_coach_after_member_thumbnail_popup' ); ?>
        </div>

        <!-- Meta Details -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-details.php' ); ?>

    </div>

    <div class="gs_coach_popup_details gs-tm-sicons">
        
        <!-- Single member name -->
        <?php member_name( $id, true, false, 'single_page', 'h2' ); ?>
        <?php do_action( 'gs_coach_after_member_name' ); ?>

        <!-- Single member designation -->
        <?php if ( !empty( $designation ) ): ?>
            <div class="gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
            <?php do_action( 'gs_coach_after_member_designation' ); ?>
        <?php endif; ?>

        <!-- Social Links -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>

        
        <!-- Meta Fields -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-fields.php' ); ?>

        <!-- Description -->
        <div class="gs-member-desc <?php echo $gs_desc_scroll_contrl == 'on' ? 'gs-coach--scrollbar' : ''; ?>" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
        <?php do_action( 'gs_coach_after_member_details' ); ?>

        <!-- Skills -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-skills.php' ); ?>

        <div class="gs_member_certificates">
            <!-- Certificates -->
            <?php $is_certificates_enabled = 'on'; ?>
            <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-certificates.php' ); ?>
        </div>

    </div>

<?php endif; ?>