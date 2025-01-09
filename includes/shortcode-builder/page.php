<?php

$routes = [
	[
		'slug'  => '/',
		'title' => __('Shortcodes', 'gscoach')
	],
	[
		'slug'  => '/shortcode',
		'title' => __( 'Create New', 'gscoach' )
	],
	[
		'slug'  => '/preferences',
		'title' => __( 'Preferences', 'gscoach' )
	],
	[
		'slug'  => '/taxonomies',
		'title' => __( 'Taxonomies', 'gscoach' )
	],
	[
		'slug'  => '/bulk-import',
		'title' => __( 'Bulk Import', 'gscoach' )
	],
	[
		'slug'  => '/demo-data',
		'title' => __( 'Demo Data', 'gscoach' )
	],
	[
		'slug'  => '/import-export',
		'title' => __( 'Import Export', 'gscoach' )
	]
];

?>
<div class="app-container">
	<div class="main-container">		
		<div id="gs-coach-shortcode-app">
			<header class="gs-coach-header">
				<div class="gs-containeer-f">
					<div class="gs-roow">
						<div class="logo-area gs-col-xs-6 gs-col-sm-5 gs-col-md-3">
							<router-link to="/"><img src="<?php echo GSCOACH_PLUGIN_URI . '/assets/img/logo.svg'; ?>" alt="GS Coaches Logo"></router-link>
						</div>
						<div class="menu-area gs-col-xs-6 gs-col-sm-7 gs-col-md-9 text-right">
							<ul>
								<?php
								foreach($routes as $route) { ?>
									<router-link to=<?php echo esc_attr($route['slug']); ?> custom v-slot="{ isActive, href, navigate, isExactActive }">
										<li :class="[isActive ? 'router-link-active' : '', isExactActive ? 'router-link-exact-active' : '']">
											<a :href="href" @click="navigate" @keypress.enter="navigate" role="link"><?php echo esc_html($route['title']); ?></a>
										</li>
									</router-link>									
								<?php
								}
								?>								
							</ul>
						</div>
					</div>
				</div>
			</header>

			<div class="gs-coach-app-view-container">
				<router-view :key="$route.fullPath"></router-view>
			</div>

		</div>		
	</div>
</div>