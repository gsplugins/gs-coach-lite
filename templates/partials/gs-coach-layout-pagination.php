<?php

namespace GSCOACH;
/**
 * GS Coach - Layout Pagination
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-coach/partials/gs-coach-layout-pagination.php
 * 
 * @package GS_Coach/Templates
 * @version 1.0.0
 */

do_action( 'gs_coach_before_pagination' );

pagination();

do_action( 'gs_coach_after_pagination' );