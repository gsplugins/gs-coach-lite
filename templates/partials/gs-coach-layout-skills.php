<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Skills
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/partials/gs-coach-layout-skills.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.0
 */

$coach_id = get_the_id();


$skills = get_skills( $coach_id );

$is_skills_title = empty($is_skills_title) ? false : wp_validate_boolean($is_skills_title);
$is_skills_title = apply_filters( 'gs_coach_coach_is_skills_title', $is_skills_title, $skills, $coach_id );
$skills_text = get_translation( 'gs_coach_skills' );

if ( !empty($skills) ) : ?>

    <div class="coach-skill-wraaper">
        <?php if ( $is_skills_title && !empty($skills_text) ) : ?>
            <h3><?php echo esc_html($skills_text); ?></h3>
        <?php endif; ?>

        <div class="coach-skill">
            <?php foreach( $skills as $skill ) : ?>
                
                <?php if ( !empty($skill['percent']) ) : ?>

                    <span class="progressText">
                        <b><?php echo esc_html($skill['skill']); ?></b>
                    </span>

                    <div class="progress" style="--gscoach-progress-width: <?php echo esc_attr($skill['percent']); ?>%">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        <span class="progress-completed"><?php echo esc_html($skill['percent']); ?>%</span>
                    </div>
                    
                <?php endif; ?>

            <?php endforeach; ?>
        </div>
    </div>

    <?php do_action( 'gs_coach_after_coach_skills' ); ?>

<?php endif; ?>