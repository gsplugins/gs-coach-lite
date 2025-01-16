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

$member_id = get_the_id();

$certificates = get_certificates( $member_id );

var_dump($certificates);
exit();


?>

<div class="">

</div>