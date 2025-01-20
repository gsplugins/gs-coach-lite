<?php
namespace GSCOACH;

if ( $gs_coaches_pop_clm == 'one' ) : ?>

    <div class="gs_coach_popup_details gs-tm-sicons popup-one-column">
        
        <!-- Coach Image -->
        <div class="clearfix">
            <?php member_thumbnail( $gs_coach_thumbnail_sizes, true ); ?>
        </div>
        <?php do_action( 'gs_coach_after_member_thumbnail_popup' ); ?>

        <!-- Member Name -->
        <?php member_name( $id, true, $gs_coach_name_is_linked == 'on' ); ?>
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

        <div class="gs_coach_certificates">
            <!-- Certificates -->
            <?php $is_certificates_enabled = 'on'; ?>
            <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-certificates.php' ); ?>
        </div>

    </div>

<?php else: ?>

    <div class="gs_coach_popup_left__wrapper">
    
        <!-- Coach Image -->
        <div class="gs_coach_popup_img">
            <?php member_thumbnail( $gs_coach_thumbnail_sizes, true ); ?>
            <?php do_action( 'gs_coach_after_member_thumbnail_popup' ); ?>
        </div>

    </div>

    <div class="gs_coach_popup_details gs-tm-sicons">
        
        <div class="name-designation-icon">
            <div class="name-designation">
                <!-- Single member name -->
                <?php member_name( $id, true, $gs_coach_name_is_linked == 'on' ); ?>
                <?php do_action( 'gs_coach_after_member_name' ); ?>

                <!-- Single member designation -->
                <?php if ( !empty( $designation ) ): ?>
                    <div class="gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
                    <?php do_action( 'gs_coach_after_member_designation' ); ?>
                <?php endif; ?>
            </div>

            <div class="item-icon">
                 <!-- Coach Flip Image -->
                <div class="gs_coach_img__wrapper">
                    <?php member_custom(); ?>
                </div>
                <?php do_action( 'gs_coach_after_member_secondary_thumbnail' ); ?>
            </div>
            
        </div>
        
        <!-- Description -->
        <div class="gs-member-desc <?php echo $gs_desc_scroll_contrl == 'on' ? 'gs-coach--scrollbar' : ''; ?>" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
        <?php do_action( 'gs_coach_after_member_details' ); ?>
        
        <!-- Meta Fields -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-fields.php' ); ?>
        
        <!-- Social Links -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>

        <div class="gs_coach_certificates">
            <!-- Certificates -->
            <?php $is_certificates_enabled = 'on'; ?>
            <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-certificates.php' ); ?>
        </div>

    </div>

<?php endif; ?>