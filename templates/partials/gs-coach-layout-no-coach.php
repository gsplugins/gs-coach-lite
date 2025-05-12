<?php

namespace GSCOACH;
/**
 * GS Coach - Layout No coach
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/partials/gs-coach-layout-no-team-coach.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.0
 */

?>

<div class="gs-col-md-12 gs-coach-no-coach-found">
    <p><?php _e( 'No coach found', 'gscoach' ); ?></p>
</div>

<?php do_action( 'gs_coach_after_no_coach_found' ); ?>