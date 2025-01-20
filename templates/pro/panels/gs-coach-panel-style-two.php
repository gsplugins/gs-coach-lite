<?php 
namespace GSCOACH; ?>
<div id="gscoach_<?php echo esc_attr(get_the_id()); ?>_<?php echo esc_attr($id); ?>" class="gstm-panel">

    <div class="panel-container">

            <div class="gstm-panel-right">

                    <!-- Panel Top -->
                    <div class="gstm-panel-top">

                        <div class="gstm-pt-left">
                            <button class="prev-gstm-panel-bt gstm-panel-bt-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19.094" height="35.38" viewBox="0 0 19.094 35.38"><path fill="#c1c1c7" d="M307.236,2709.09l17.678,17.67-1.414,1.42-17.678-17.68Zm17.678-14.85-17.678,17.67-1.414-1.41,17.678-17.68Z" transform="translate(-305.812 -2692.81)"></path></svg>
                            </button>
                            <button class="next-gstm-panel-bt gstm-panel-bt-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19.1" height="35.38" viewBox="0 0 19.1 35.38"><path fill="#c1c1c7" d="M1612.76,2709.09l-17.67,17.67,1.41,1.42,17.68-17.68Zm-17.67-14.85,17.67,17.67,1.42-1.41-17.68-17.68Z" transform="translate(-1595.09 -2692.81)"></path></svg>
                            </button>
                        </div>

                        <div class="gstm-pt-right">
                            <button class="close-gstm-panel-bt">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22.62" height="22.62" viewBox="0 0 22.62 22.62"><path fill="#c1c1c7" d="M1474.1,7297.69l21.21,21.21-1.41,1.41-21.21-21.21Zm-1.41,21.21,21.21-21.21,1.41,1.41-21.21,21.21Z" transform="translate(-1472.69 -7297.69)"></path></svg>
                            </button>
                        </div>

                    </div>


                <!-- Coach Image -->
                <div class="gs_coach_image__wrapper">
                    <?php member_thumbnail( $gs_coach_thumbnail_sizes, true ); ?>
                    <?php do_action( 'gs_coach_after_member_thumbnail_popup' ); ?>
                </div>

                <div class="gstm-panel-info">

                    <div class="gstm-panel-title">
                        <!-- Member Name -->    
                        <?php the_title(); ?>
                        <?php do_action( 'gs_coach_after_member_name' ); ?>
                    </div>
                    
                    <!-- Member Designation -->
                    <div class="gstm-panel-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
                    <?php do_action( 'gs_coach_after_member_designation' ); ?>
    
                    <!-- Description -->
                    <div class="gs-member-desc" itemprop="description"><?php echo wpautop( do_shortcode( get_the_content() ) ); ?></div>
                    <?php do_action( 'gs_coach_after_member_details' ); ?>

                    <!-- Meta Fields -->
                    <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-fields.php' ); ?>
    
                    <!-- Social Links -->
                    <?php if ( ! empty( get_social_links( get_the_id() ) ) ) : ?>
                        <div class="gs-tm-sicons">
                            <div class="gs-tm-sicons-lable"><?php echo esc_html($gs_coach_follow_me_on); ?></div>
                            <?php $gs_coach_connect = 'on'; ?>
                            <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>
                        </div>
                    <?php endif; ?>
    
                    <!-- Skills -->
                    <?php $is_skills_title = true; ?>
                    <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-skills.php' ); ?>

                    <div class="gs_coach_certificates">
                        <!-- Certificates -->
                        <?php $is_certificates_enabled = 'on'; ?>
                        <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-certificates.php' ); ?>
                    </div>

                </div>

            </div>
    </div>
    
</div>