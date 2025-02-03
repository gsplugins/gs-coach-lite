<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Certificates
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/partials/gs-coach-layout-certificates.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.0
 */


$coach_id = get_the_id();
$certificates = get_certificate_ids( $coach_id );

if ( ! $certificates ) {
    return;
}

if( 'on' === $is_certificates_enabled ):

$certificates_title = 'Certificates';
?>


<!-- Temporary Styles -->
<style>
	.gs-coach-certificates-wrapper {
		display: grid;
		grid-template-columns: auto auto auto;
		gap: 10px;
	}
</style>

<h2 class="gs-coach-certificates-title"><?php echo esc_html( $certificates_title ); ?></h2>
<div class="gs-coach-certificates-wrapper">
    <?php foreach ( $certificates as $certificate ) : ?>
        <div class="gs-coach-certificate">
            <?php echo wp_get_attachment_image( $certificate, 'full' ); ?>
        </div>
    <?php endforeach; ?>
</div>

<?php endif; ?>