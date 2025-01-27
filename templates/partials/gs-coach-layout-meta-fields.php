<?php

namespace GSCOACH;
/**
 * GS Coach - Meta Fields Template
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-meta-fields.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.0
 */

//  Translation Strings
$gs_coach_experience_meta   = 'Experience:';
$gs_coach_education_meta    = 'Education:';
$gs_coach_state_meta        = 'State:';
$gs_coach_country_meta      = 'Country:';
$gs_coach_schedule_meta     = 'Schedule:';
$gs_coach_availablity_meta  = 'Availablity:';
$gs_coach_psite_meta        = 'Personal Site:';
$gs_coach_courselink_meta   = 'Course Link:';
$gs_coach_fee_meta          = 'Fee:';
$gs_coach_review_meta       = 'Review:';
$gs_coach_rating_meta       = 'Rating:';

foreach ( gs_get_sort_metas() as $meta ) {
    $meta_value = get_post_meta( get_the_id(), $meta['key'], true );
    if ( empty( $meta['name'] ) ) continue;

    if( '_gscoach_rating' !== $meta['key'] ){
        ?>
            <div class="gs-coach-meta-fields">
                <span class="gs-coach-meta-label"><?php echo get_meta_field_name($meta['key']) . ': '; ?></span>
                <span class="gs-coach-meta-info"><?php echo esc_html( $meta_value ); ?></span>
            </div>
        <?php
    } else {
        ?>
            <div class="gs-coach-rating">
                <span class="gs-coach-meta-label"><?php echo get_meta_field_name($meta['key']) . ': '; ?></span>
                <span class="gs-coach-meta-rating"><?php esc_html( gs_star_rating( array( 'rating' => $meta_value ) ) ); ?></span>
            </div>
        <?php
    }
}


?>

<div class="gs-coach-meta-fields">
    
    <?php if ( !empty($experience) ) : ?>
        <div class="gs-member-experience">
            <span class="levels"><?php echo esc_html($gs_coach_experience_meta); ?></span>
            <span class="level-info-experience"><?php echo esc_html($experience); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty($education) ) : ?>
        <div class="gs-member-education">
            <span class="levels"><?php echo esc_html($gs_coach_education_meta); ?></span>
            <span class="level-info-education"><?php echo esc_html($education); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty($state) ) : ?>
        <div class="gs-member-state">
            <span class="levels"><?php echo esc_html($gs_coach_state_meta); ?></span>
            <span class="level-info-state"><?php echo esc_html($state); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty($country) ) : ?>
        <div class="gs-member-country">
            <span class="levels"><?php echo esc_html($gs_coach_country_meta); ?></span>
            <span class="level-info-country"><?php echo esc_html($country); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty($schedule) ) : ?>
        <div class="gs-member-schedule">
            <span class="levels"><?php echo esc_html($gs_coach_schedule_meta); ?></span>
            <span class="level-info-schedule"><?php echo esc_html($schedule); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty($availablity) ) : ?>
        <div class="gs-member-availablity">
            <span class="levels"><?php echo esc_html($gs_coach_availablity_meta); ?></span>
            <span class="level-info-availablity"><?php echo esc_html($availablity); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty($personal_site) ) : ?>
        <div class="gs-member-psite">
            <span class="levels"><?php echo esc_html($gs_coach_psite_meta); ?></span>
            <span class="level-info-psite"><?php echo esc_html($personal_site); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty($course_link) ) : ?>
        <div class="gs-member-courselink">
            <span class="levels"><?php echo esc_html($gs_coach_courselink_meta); ?></span>
            <span class="level-info-courselink"><?php echo esc_html($course_link); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty($fee) ) : ?>
        <div class="gs-member-fee">
            <span class="levels"><?php echo esc_html($gs_coach_fee_meta); ?></span>
            <span class="level-info-fee"><?php echo esc_html($fee); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty($review) ) : ?>
        <div class="gs-member-review">
            <span class="levels"><?php echo esc_html($gs_coach_review_meta); ?></span>
            <span class="level-info-review"><?php echo esc_html($review); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty($rating) ) : ?>
        <div class="gs-member-rating">
            <span class="levels"><?php echo esc_html($gs_coach_rating_meta); ?></span>
            <span class="level-info-rating"><?php esc_html( gs_star_rating( array( 'rating' => $rating ) ) ); ?></span>
        </div>
    <?php endif; ?>

</div>