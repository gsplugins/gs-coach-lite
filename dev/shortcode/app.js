// require('../libs/color-picker/color-picker.js');
require('./includes/polyfills.js');

import Vue from 'vue';
import VueRouter from 'vue-router';
import helpers from './includes/helpers';
import Clipboard from 'clipboard';
import VueConfirmDialog from 'vue-confirm-dialog';

window.Clipboard = Clipboard;

// Pages
import Shortcodes from './pages/shortcodes.vue';
import Shortcode from './pages/shortcode.vue';
import Preferences from './pages/preferences.vue';
import Taxonomies from './pages/taxonomies.vue';
import DemoData from './pages/demo-data.vue';
import BulkImport from './pages/bulk-import.vue';
import ImportExport from './pages/import-export.vue';

// global use
Vue.use(VueRouter);
Vue.use(VueConfirmDialog);

window.Events = new Vue({});

Vue.mixin({
	methods: helpers
});

Vue.component( 'input-tag', 		require('./components/input-tag.vue').default );      
Vue.component( 'input-increment', 	require('./components/input-increment.vue') .default );
Vue.component( 'input-range', 		require('./components/input-range.vue').default ); 
Vue.component( 'input-checkbox', 	require('./components/input-checkbox.vue').default );
Vue.component( 'input-radio', 		require('./components/input-radio.vue').default );
Vue.component( 'input-select', 		require('./components/input-select/component/select.vue').default );
Vue.component( 'input-color', 		require('./components/input-color/input-color.vue').default );
Vue.component( 'input-toggle', 		require('./components/input-toggle.vue').default );
Vue.component( 'editor-cm', 		require('./components/editor-codemirror/component/editor-cm.vue').default );
Vue.component( 'vue-confirm-dialog', VueConfirmDialog.default );

jQuery(function($){

	let routes = [
		{ path: '/', 				component: Shortcodes },
		{ path: '/shortcode', 		component: Shortcode },
		{ path: '/shortcode/:id', 	component: Shortcode },
		{ path: '/preferences', 	component: Preferences },
		{ path: '/taxonomies', 		component: Taxonomies },
		{ path: '/demo-data', 		component: DemoData },
		{ path: '/bulk-import', 	component: BulkImport },
		{ path: '/import-export', 	component: ImportExport },
	];

	const router = new VueRouter({ routes });

	if ( $('#gs-coach-shortcode-app').length > 0 ) {
		window.app = new Vue({
			router
		}).$mount('#gs-coach-shortcode-app');
	}

	let $team_admin_menu;

	function fixAdminActiveLink( currentPath ) {

		if ( !$team_admin_menu || !$team_admin_menu.length ) $team_admin_menu = $('#menu-posts-gs_coaches');
		if ( !$team_admin_menu.length ) return;

		let $demo_link = $team_admin_menu.find( "a[href='edit.php?post_type=gs_coaches&page=gs-coach-shortcode#/demo-data']" );
		let $shortcode_link = $team_admin_menu.find( "a[href='edit.php?post_type=gs_coaches&page=gs-coach-shortcode']" );
		let $bulk_import_link = $team_admin_menu.find( "a[href='edit.php?post_type=gs_coaches&page=gs-coach-shortcode#/bulk-import']" );
		let $export_link = $team_admin_menu.find( "a[href='edit.php?post_type=gs_coaches&page=gs-coach-shortcode#/import-export']" );
		let $preference_link = $team_admin_menu.find( "a[href='edit.php?post_type=gs_coaches&page=gs-coach-shortcode#/preferences']" );
		let $taxonomies_link = $team_admin_menu.find( "a[href='edit.php?post_type=gs_coaches&page=gs-coach-shortcode#/taxonomies']" );
		
		if ( currentPath == '/demo-data' ) {
			$demo_link.parent().addClass('current').siblings('li').removeClass('current');
		} else if ( currentPath == '/bulk-import' ) {
			$bulk_import_link.parent().addClass('current').siblings('li').removeClass('current');
		} else if ( currentPath == '/import-export' ) {
			$export_link.parent().addClass('current').siblings('li').removeClass('current');
		} else if ( currentPath == '/preferences' ) {
			$preference_link.parent().addClass('current').siblings('li').removeClass('current');
		} else if ( currentPath == '/taxonomies' ) {
			$taxonomies_link.parent().addClass('current').siblings('li').removeClass('current');
		} else {
			$shortcode_link.parent().addClass('current').siblings('li').removeClass('current');
		}
	}

	router.beforeEach((to, from, next) => {

		fixAdminActiveLink( to.path );
		next();

	});

	fixAdminActiveLink( router.history.current.path );

}); 