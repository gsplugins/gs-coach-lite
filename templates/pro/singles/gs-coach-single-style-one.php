<?php
namespace GSCOACH;
/**
 * GS Coach - Single Template 
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-single.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.2
 */

$designation = get_post_meta( get_the_id(), '_gscoach_profession', true );

?>

<div class="gs-coach-breadcumb">
    <?php $is_breadcumb_enabled = 'on'; ?>
    <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-breadcumb.php' ); ?>
    <?php do_action( 'gs_coach_after_breadcumb' ); ?>
</div>

<div class="gs-coach-single-content" itemscope="" itemtype="http://schema.org/Person">

    <div class="gs-roow">

        <div class="gs-col-md-3">

            <div class="gs_member_img">
                
                <div class="gs_ribon_wrapper">
                    
                    <!-- Coach Image -->
                    <?php member_thumbnail( 'full', true ); ?>
                    <?php do_action( 'gs_coach_after_member_thumbnail' ); ?>
        
                    <!-- Ribbon -->
                    <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>
                    
                </div>
        
                <!-- Meta Details -->
                <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-details.php' ); ?>
        
            </div>
        
        </div>

        <div class="gs-col-md-9">

            <div class="gs_member_details">

                <div class="gstm-silde-icon">

                    <?php

                        $icon_prev = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12px" height="20px"><path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M11.414,18.485 L10.000,19.899 L0.100,10.000 L1.515,8.585 L1.515,8.585 L10.000,0.100 L11.414,1.514 L2.929,10.000 L11.414,18.485 Z"/></svg>';

                        $icon_next = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12px" height="20px"><path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M11.899,10.000 L2.000,19.899 L0.586,18.485 L9.071,10.000 L0.586,1.514 L2.000,0.100 L10.485,8.585 L10.485,8.585 L11.899,10.000 Z"/></svg>';

                        if ( get_adjacent_post() ) {
                            previous_post_link( '%link', $icon_prev );
                        } else {
                            printf('<a class="gs-arrow-disabled" href="javascript:void(0);">%s</a>', $icon_prev);
                        }
                        
                        if ( get_adjacent_post( false, '', false ) ) {
                            next_post_link( '%link', $icon_next );
                        } else {
                            printf('<a class="gs-arrow-disabled" href="javascript:void(0);">%s</a>', $icon_next);
                        }

                    ?>

                </div>
        
                <!-- Member Name -->
                <h1 class="gs-sin-mem-name" itemprop="name"><?php the_title(); ?></h1>
                <?php do_action( 'gs_coach_after_member_name' ); ?>
        
                <!-- Member Designation -->
                <div class="gs-sin-mem-desig" itemprop="jobtitle"><?php echo esc_html( $designation ); ?></div>
                <?php do_action( 'gs_coach_after_member_designation' ); ?>

                <!-- Meta Fields -->
                <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-fields.php' ); ?>
        
                <!-- Description -->
                <div class="gs-member-desc" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
                <?php do_action( 'gs_coach_after_member_details' ); ?>
        
                <!-- Social Links -->
                <?php if ( ! empty( get_social_links( get_the_id() ) ) ) : ?>
                    <div class="gs-tm-sicons">
                        <div class="gs-tm-sicons-lable"><?php echo esc_html($gs_coach_follow_me_on); ?></div>
                        <?php $gs_member_connect = 'on'; ?>
                        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>
                    </div>
                <?php endif; ?>

                <!-- Skills -->
                <?php $is_skills_title = true; ?>
                <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-skills.php' ); ?>
                
            </div>

        </div>

    </div>

    <div class="gs_member_certificates">
        <!-- Certificates -->
         <?php $is_certificates_enabled = 'on'; ?>
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-certificates.php' ); ?>
    </div>


</div>