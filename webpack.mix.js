const mix = require('laravel-mix');

const wpPot = require('wp-pot');

mix.options({
    autoprefixer: {
        remove: false
    },
    processCssUrls: false,
	terser: {
		terserOptions: {
			compress: false
		},
		extractComments: false
	}
});

mix.webpackConfig({
	target: 'web',
	externals: {
		jquery: "window.jQuery",
		$: "window.jQuery",
		wp: 'window.wp',
		React: 'window.React',
		_gscoach_data: 'window._gscoach_data'
	},
});

// Disable notification on dev mode
if ( process.env.NODE_ENV.trim() !== 'production' ) mix.disableNotifications();

// Public CSS
mix.sass('./dev/public/gs-coach.scss', './assets/css/gs-coach.min.css');
mix.sass('./dev/public/public-divi.scss', './assets/css/public-divi.min.css');

// Public JS
mix.scripts('./dev/public/gs-coach.js', './assets/js/gs-coach.min.js');

// Admin CSS
mix.sass('./includes/gs-common-pages/assets/gs-plugins-common-pages.scss', './includes/gs-common-pages/assets/gs-plugins-common-pages.min.css');
mix.sass('./dev/admin/admin.scss', './assets/admin/css/admin.min.css');
mix.sass('./dev/admin/sort.scss', './assets/admin/css/sort.min.css');

// Admin JS
mix.scripts('./dev/admin/admin.js', './assets/admin/js/admin.min.js');
mix.scripts('./dev/admin/sort.js', './assets/admin/js/sort.min.js');

// Shortcode
mix.sass('./dev/shortcode/app.scss', './assets/admin/css/shortcode.min.css');
mix.sass('./dev/shortcode/preview.scss', './assets/css/preview.min.css');
mix.js('./dev/shortcode/app.js', './assets/admin/js/shortcode.min.js').vue();

// Divi Builder
mix.js('./includes/integrations/assets/divi/divi-builder.js', './includes/integrations/assets/divi/divi-builder.min.js');

// Gutenberg Widget
mix.js('./includes/integrations/assets/gutenberg/gutenberg-widget.js', './includes/integrations/assets/gutenberg/gutenberg-widget.min.js');

// Elementor Widget
mix.scripts('./includes/integrations/assets/elementor/elementor-preview.js', './includes/integrations/assets/elementor/elementor-preview.min.js');

if ( process.env.NODE_ENV.trim() === 'production' ) {

	// Language pot file generator
	wpPot({
		destFile: 'languages/gscoach.pot',
		domain: 'gscoach',
		package: 'GS_Coach',
		src: ['**/*.php', '!freemius/**/*.php']
	});
}
