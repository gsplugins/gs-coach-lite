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

<div class="gs-containeer-f" itemscope="" itemtype="http://schema.org/Person">

    <div class="gs-roow">

            <div class="gs-col-md-6 gscoach-content-left">

                <div class="gs_coach_img">

                    <div class="gs_ribon_wrapper">
                        
                        <!-- Coach Image -->
                        <?php coach_thumbnail( 'full', true ); ?>
                        <?php do_action( 'gs_coach_after_coach_thumbnail' ); ?>

                        <!-- Ribbon -->
                        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-ribon.php' ); ?>
                        
                    </div>

                    <!-- coach Name -->
                    <h2 class="gs-sin-mem-name" itemprop="name"><?php the_title(); ?></h2>
                    <?php do_action( 'gs_coach_after_coach_name' ); ?>

                    <!-- coach Designation -->
                    <div class="gs-sin-mem-desig" itemprop="jobtitle"><?php echo esc_html( $designation ); ?></div>
                    <?php do_action( 'gs_coach_after_coach_designation' ); ?>

                    <!-- Description -->
                    <div class="gs-coach-desc <?php echo $gs_desc_scroll_contrl == 'on' ? 'gs-coach--scrollbar' : ''; ?>" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
                    <?php do_action( 'gs_coach_after_coach_details' ); ?>

                </div>

            </div> <!--End Of gs-col-md-6 -->

            <div class="gs-col-md-6 gscoach-content-right">

                <div class="gs_coach_details">


                    <!-- Meta Details -->
                    <div class="contact-title">
                        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-details.php' ); ?>
                    </div>

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

            </div> <!--End Of gs-col-md-6 -->

    </div>

    <div class="gs_coach_certificates">
        <!-- Certificates -->
        <?php $is_certificates_enabled = 'on'; ?>
        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-certificates.php' ); ?>
    </div>

</div>