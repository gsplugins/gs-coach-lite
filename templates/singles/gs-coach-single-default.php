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

<div class="gs-coach-single-content" itemscope="" itemtype="http://schema.org/Person">

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

    <div class="gs_member_details gs-tm-sicons">

        <!-- Member Name -->
        <h1 class="gs-sin-mem-name" itemprop="name"><?php the_title(); ?></h1>
        <?php do_action( 'gs_coach_after_member_name' ); ?>

        <!-- Member Designation -->
        <div class="gs-sin-mem-desig" itemprop="jobtitle"><?php echo esc_html( $designation ); ?></div>
        <?php do_action( 'gs_coach_after_member_designation' ); ?>

        <!-- Social Links -->
        <?php $gs_member_connect = 'on'; ?>
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>

        <!-- Meta Fields -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-fields.php' ); ?>

        <!-- Description -->
        <div class="gs-member-desc" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
        <?php do_action( 'gs_coach_after_member_details' ); ?>
        
        <!-- Skills -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-skills.php' ); ?>
        
    </div>

    <div class="gs_member_certificates">
        <!-- Certificates -->
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-certificates.php' ); ?>
    </div>

</div>