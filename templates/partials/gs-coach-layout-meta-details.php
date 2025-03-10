<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Popup Details
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/gs-coach-layout-popup-details.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.0
 */


$gs_coachcom_meta 		    = get_translation( 'gs_coachcom_meta' );
$gs_coachadd_meta 		    = get_translation( 'gs_coachadd_meta' );
$gs_coachcellPhone_meta 	= get_translation( 'gs_coachcellPhone_meta' );
$gs_coachemail_meta 		= get_translation( 'gs_coachemail_meta' );
$gs_coach_zipcode_meta 	    = get_translation( 'gs_coach_zipcode_meta' );

$gs_coach_location_label     = plugin()->builder->get_tax_option( 'location_tax_label' );
$gs_coach_language_label     = plugin()->builder->get_tax_option( 'language_tax_label' );
$gs_coach_specialty_label    = plugin()->builder->get_tax_option( 'specialty_tax_label' );
$gs_coach_gender_label       = plugin()->builder->get_tax_option( 'gender_tax_label' );

$gs_coach_extra_one_label   = 'Extra One';
$gs_coach_extra_two_label   = 'Extra Two';
$gs_coach_extra_three_label = 'Extra Three';
$gs_coach_extra_four_label  = 'Extra Four';
$gs_coach_extra_five_label  = 'Extra Five';

$address            = get_post_meta( get_the_id(), '_gscoach_address', true );
$email              = get_post_meta( get_the_id(), '_gscoach_email', true );
$cell               = get_post_meta( get_the_id(), '_gscoach_contact', true );
$gs_zip_code        = is_pro_valid() ? get_post_meta( get_the_id(), '_gs_zip_code', true ) : '';
$location           = is_pro_valid() ? gs_coach_member_location() : '';
$language           = is_pro_valid() ? gs_coach_member_language() : '';
$specialty          = is_pro_valid() ? gs_coach_member_specialty() : '';
$gender             = is_pro_valid() ? gs_coach_member_gender() : '';
$extra_one          = is_pro_valid() ? gs_coach_member_extra_one() : '';
$extra_two          = is_pro_valid() ? gs_coach_member_extra_two() : '';
$extra_three        = is_pro_valid() ? gs_coach_member_extra_three() : '';
$extra_four         = is_pro_valid() ? gs_coach_member_extra_four() : '';
$extra_five         = is_pro_valid() ? gs_coach_member_extra_five() : '';

?>

<div class="gstm-details">

    <?php if ( !empty($address) ) : ?>
        <div class="gs-member-address">
            <span class="levels"><?php echo esc_html($gs_coachadd_meta); ?></span>
            <span class="level-info-address"><?php echo wp_kses_post( $address ); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty($cell) ) : ?>
        <div class="gs-member-cphon">
            <span class="levels"><?php echo esc_html($gs_coachcellPhone_meta); ?></span>
            <span class="level-info-cphon">
                <?php
                $cell_phone_link = getoption( 'cell_phone_link', 'off' );
                if ( $cell_phone_link == 'on' ) {
                    printf( '<a href="callto:%1$s">%1$s</a>', esc_html($cell) );
                } else {
                    echo esc_html($cell);
                }
                ?>
            </span>
        </div>
    <?php endif; ?>

    <?php if ( !empty($email) ) : ?>
        <div class="gs-member-email">
            <span class="levels"><?php echo esc_html($gs_coachemail_meta); ?></span>
            <span class="level-info-email">
                <?php
                $email_link = getoption( 'email_link', 'off' );
                if ( $email_link == 'on' ) {
                    member_email_mailto('', true);
                } else {
                    echo sanitize_email($email);
                }
                ?>
            </span>
        </div>
    <?php endif; ?>

    <?php if ( !empty( $location )) : ?>
        <div class="gs-member-loc">
            <span class="levels"><?php echo esc_html($gs_coach_location_label); ?></span>
            <span class="level-info-loc"><?php echo esc_html($location); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty( $language ) ) : ?>
        <div class="gs-member-lang">
            <span class="levels"><?php echo esc_html($gs_coach_language_label); ?></span>
            <span class="level-info-lang"><?php echo esc_html($language); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty( $specialty ) ) : ?>
        <div class="gs-member-specialty">
            <span class="levels"><?php echo esc_html($gs_coach_specialty_label); ?></span>
            <span class="level-info-specialty"><?php echo esc_html($specialty); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty( $gender ) ) : ?>
        <div class="gs-member-gender">
            <span class="levels"><?php echo esc_html($gs_coach_gender_label); ?></span>
            <span class="level-info-gender"><?php echo esc_html($gender); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty( $extra_one ) ) : ?>
        <div class="gs-member-extra_one">
            <span class="levels"><?php echo esc_html($gs_coach_extra_one_label); ?></span>
            <span class="level-info-extra_one"><?php echo esc_html($extra_one); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty( $extra_two ) ) : ?>
        <div class="gs-member-extra_two">
            <span class="levels"><?php echo esc_html($gs_coach_extra_two_label); ?></span>
            <span class="level-info-extra_two"><?php echo esc_html($extra_two); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty( $extra_three ) ) : ?>
        <div class="gs-member-extra_three">
            <span class="levels"><?php echo esc_html($gs_coach_extra_three_label); ?></span>
            <span class="level-info-extra_three"><?php echo esc_html($extra_three); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty( $extra_four ) ) : ?>
        <div class="gs-member-extra_four">
            <span class="levels"><?php echo esc_html($gs_coach_extra_four_label); ?></span>
            <span class="level-info-extra_four"><?php echo esc_html($extra_four); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty( $extra_five ) ) : ?>
        <div class="gs-member-extra_five">
            <span class="levels"><?php echo esc_html($gs_coach_extra_five_label); ?></span>
            <span class="level-info-extra_five"><?php echo esc_html($extra_five); ?></span>
        </div>
    <?php endif; ?>

    <?php if ( !empty( $gs_zip_code ) ) : ?>
        <div class="gs-member-zipcode">
            <span class="levels"><?php echo esc_html($gs_coach_zipcode_meta); ?></span>
            <span class="level-info-zipcode"><?php echo esc_html($gs_zip_code); ?></span>
        </div>
    <?php endif; ?>
    
</div>

<?php do_action( 'gs_coach_after_member_meta_details' ); ?>