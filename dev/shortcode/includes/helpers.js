_gscoach_data.is_multilingual = _gscoach_data.is_multilingual == '1';
const config = Object.assign({}, window._gscoach_data);
const translations = Object.assign({}, window._gscoach_data.translations);


delete window._gscoach_data.nonce;
delete window._gscoach_data.siteurl;
delete window._gscoach_data.ajaxurl;
delete window._gscoach_data.adminurl;
delete window._gscoach_data.shortcode_settings;
delete window._gscoach_data.shortcode_options;
delete window._gscoach_data.preference;
delete window._gscoach_data.preference_options;
delete window._gscoach_data.translations;

import notify from './notify';

const helpers = {

	copyShortcodeToClipboard() {

		new Clipboard('.copy-holder', {
			target(trigger) {
				return jQuery(trigger).parent().find('.shortcode-input')[0];
			}
		}).on('success', function(e) {
			e.clearSelection();
		});

		jQuery(this.$el).delegate('.shortcode-input', 'click', function(event) {
			jQuery(this).select();
		});

	},

	getDemoDataStatus() {
		return window._gscoach_data.demo_data;
	},

	_updateDemoDataStatus( data = {} ) {
		window._gscoach_data.demo_data = Object.assign({}, window._gscoach_data.demo_data, data);
	},

	_getShortcodeSettings() {
		return config.shortcode_settings;
	},

	initHelpText() {
		jQuery(this.$el).on( 'click', '.gscoach-show--info', function() {
			jQuery(this).closest('.shortcode-setting--row').find('.bi-text-help--area').slideToggle(250).end().siblings().find('.bi-text-help--area').slideUp(250);
		});
	},

	_getShortcodeOptions() {
		return config.shortcode_options;
	},

	_getPreference() {
		return config.preference;
	},

	_getTaxSettings() {
		return config.taxonomy_settings;
	},

	_getPreferenceOptions() {
		return config.preference_options;
	},
			
	convertBooleanToString( val ) {
		return val === true ? 'on' : 'off'
	},
			
	convertStringToBoolean( val ) {
		return val === 'on' ? true : false;
	},
	
	getSiteURL() {
		return config.siteurl;
	},
	
	getWPNonce() {
		return config.nonce;
	},
	
	getAjaxURL() {
		return config.ajaxurl;
	},
	
	getAdminURL() {
		return config.adminurl;
	},

	isEmptyObject( data ) {

		for ( var prop in data ) {
			return !data.hasOwnProperty(prop);
		}

		return JSON.stringify(data) === JSON.stringify({});

	},

	isPro() {

		return gs_coach_fs.is_paying_or_trial;

	},

	isArray( data ) {
		return typeof data && Array.isArray(data);
	},

	isObject( data ) {
		return typeof data && !Array.isArray(data);
	},

	nonReactive(data) {
		return JSON.parse( JSON.stringify( data ) );
	},

	ltrim( str, charlist ) {

		charlist = !charlist ? ' \\s\u00A0' : (charlist + '').replace(/([[\]().?/*{}+$^:])/g, '$1');

		let re = new RegExp('^[' + charlist + ']+', 'g');

		return (str + '').replace(re, '');

	},

	notifyError( response ) {

		if ( response && response.responseJSON && response.responseJSON.data ) {
			return notify({
				message: response.responseJSON.data,
				clearAll: true
			});			
		}

		notify({
			clearAll: true
		});

	},

	translation( key = null ) {

		if ( key && key in translations ) {
			return translations[key];
		}

		return '';

	},

	themes_v2() {
		return ['gs-grid-style-one', 'gs-grid-style-two', 'gs-grid-style-three', 'gs-grid-style-four', 'gs-grid-style-five', 'gs-grid-style-six', 'gs-coach-circle-one', 'gs-coach-circle-two', 'gs-coach-circle-three', 'gs-coach-circle-four', 'gs-coach-circle-five', 'gs-coach-horizontal-one', 'gs-coach-horizontal-two', 'gs-coach-horizontal-three', 'gs-coach-horizontal-four', 'gs-coach-horizontal-five', 'gs-coach-flip-one', 'gs-coach-flip-two', 'gs-coach-flip-three', 'gs-coach-flip-four', 'gs-coach-flip-five', 'gs-coach-table-one', 'gs-coach-table-two', 'gs-coach-table-three', 'gs-coach-table-four', 'gs-coach-table-five', 'gs-coach-list-style-one', 'gs-coach-list-style-two', 'gs-coach-list-style-three', 'gs-coach-list-style-four', 'gs-coach-list-style-five'];
	},

	themes_v2_carousel() {
		return this.themes_v2().filter( theme => (theme.indexOf('table') == -1 && theme.indexOf('list') == -1 ) );
	},

	themes_v2_filter() {
		return this.themes_v2().filter( theme => (theme.indexOf('table') == -1 && theme.indexOf('list') == -1 ) );
	}
	
}

export default helpers;