<?php

require_once plugin_dir_path( __FILE__ ) . 'gs-plugins-common-pages.php';

new GS_Plugins_Common_Pages([
	
	'parent_slug' 	=> 'edit.php?post_type=gs_coaches',
	
	'lite_page_title' 	=> __('Lite Plugins by GS Plugins'),
	'pro_page_title' 	=> __('Premium Plugins by GS Plugins'),
	'help_page_title' 	=> __('Support & Documentation by GS Plugins'),

	'lite_page_slug' 	=> 'gs-coach-plugins-lite',
	'pro_page_slug' 	=> 'gs-coach-plugins-premium',
	'help_page_slug' 	=> 'gs-coach-plugins-help',

	'links' => [
		'docs_link' 	=> 'https://docs.gsplugins.com/gs-coaches/',
		'rating_link' 	=> 'https://wordpress.org/support/plugin/gs-coaches/reviews/#new-post',
		'tutorial_link' => 'https://coach.gsplugins.com/'
	]

]);