<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Sidebar
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-sidebar.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.2
 */

global $gs_coach_loop_side;

$gs_coach_name    = getoption( 'gs_coach_name', 'on' );
$gs_coach_role    = getoption( 'gs_coach_role', 'on' );
$gs_coach_connect = getoption( 'gs_coach_connect', 'on' );
$gs_coach_name_is_linked = getoption( 'gs_coach_name_is_linked', 'on' );

if ( $gs_coach_loop_side->have_posts() ) : while ( $gs_coach_loop_side->have_posts() ) : $gs_coach_loop_side->the_post();

    $gs_coach_id = get_post_thumbnail_id();
    $gs_coach_url = wp_get_attachment_image_src($gs_coach_id, 'full', true);
    $team_thumb = $gs_coach_url[0];
    $gs_coach_alt = get_post_meta($gs_coach_id,'_wp_attachment_image_alt',true);
    $gs_coach_desc_link = get_the_permalink();
    $gs_tm_meta = get_post_meta( get_the_id() );
    $designation = !empty($gs_tm_meta['_gscoach_profession'][0]) ? $gs_tm_meta['_gscoach_profession'][0] : '';
    $_gscoach_socials  = get_post_meta( get_the_id(), '_gscoach_socials', true);

    ?>

    <div class="gs-coach-widget--single-item" itemscope="" itemtype="http://schema.org/Person">

        <div class="gs-coach-widget">

            <div class="gs-coach-widget--member-image">
                
                <!-- Coach Image -->
                <a class="gs_coach_image__wrapper" href="<?php the_permalink(); ?>">
                    <?php member_thumbnail( $gs_coach_thumbnail_sizes, true ); ?>
                </a>

            </div>

            <div class="gs-coach-widget--member-info">

                <!-- Single member name -->
                <?php if ( 'on' ==  $gs_coach_name ): ?>
                    <?php member_name( $id, true, $gs_coach_name_is_linked == 'on' ); ?>
                <?php endif; ?>

                <!-- Single member designation -->
                <?php if ( !empty( $designation ) && 'on' == $gs_coach_role ): ?>
                    <div class="gs-member-desig" itemprop="jobtitle"><?php echo wp_kses_post($designation); ?></div>
                <?php endif; ?>

                <!-- Social Links -->
                <div class="gs-coach-table-cell gs-tm-sicons">
                    <?php include Template_Loader::locate_template( 'partials/gs-coach-layout-social-links.php' ); ?>
                </div>

            </div>

        </div>

    </div>

<?php endwhile; else: ?>

    <!--es not found - Load no-team-member template -->
	<?php include Template_Loader::locate_template( 'partials/gs-coach-layout-no-team-member.php' ); ?>

<?php endif; ?>