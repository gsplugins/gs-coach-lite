<?php 
namespace GSCOACH;
?>
<div id="gscoach_<?php echo esc_attr(get_the_id()); ?>_<?php echo esc_attr($id); ?>" class="gstm-panel">

    <div class="panel-container">

            <!-- Panel Top -->
            <div class="gstm-panel-top">
                <button class="close-gstm-panel-bt">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22.62" height="22.62" viewBox="0 0 22.62 22.62"><path fill="#c1c1c7" d="M1474.1,7297.69l21.21,21.21-1.41,1.41-21.21-21.21Zm-1.41,21.21,21.21-21.21,1.41,1.41-21.21,21.21Z" transform="translate(-1472.69 -7297.69)"></path></svg>
                </button>
            </div>

            <div class="gstm-panel-right">

                <!-- Coach Image -->
                <div class="gs_coach_image__wrapper">
                    <?php member_thumbnail( $gs_member_thumbnail_sizes, true ); ?>
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

                    <!-- Meta Details -->
                    <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-meta-details-2.php' ); ?>
    
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
    
</div>