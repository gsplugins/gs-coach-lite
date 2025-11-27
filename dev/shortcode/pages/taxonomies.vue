<template>
	<div class="gs-containeer-f shortcodes-container">
		<div class="gs-coach-box">

			<div class="top-section head-section">
				<h2>{{translation('taxonomies-page')}}</h2>
				<p>{{translation('taxonomies-page--des')}}</p>
			</div>

			<div class="bottom-section" v-if="isLoaded">

				<!-- Group Taxonomy Settings -->
				<div class="shortcode-settings--group">

					<div class="shortcode-settings--left">
						<h3>{{ settings.group_tax_plural_label || translation('taxonomy_group')}}</h3>
					</div>

					<div class="shortcode-settings--right">

						<div class="shortcode-setting--row">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="enable_group_tax">{{translation('enable_extra_tax')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input-toggle class="m-t-6" name="enable_group_tax" v-model="settings.enable_group_tax" offLabel="Off" onLabel="On"></input-toggle>
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('enable_extra_tax--details')}}</p>
								</div>

							</div>
						
						</div>

						<div class="shortcode-setting--row" v-if="settings.enable_group_tax">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="group_tax_label">{{translation('extra_tax_label')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input type="text" class="bi-input-control" name="group_tax_label" v-model="settings.group_tax_label" />
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('extra_tax_label--details')}}</p>
								</div>

							</div>
						
						</div>

						<div class="shortcode-setting--row" v-if="settings.enable_group_tax">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="group_tax_plural_label">{{translation('extra_tax_plural_label')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input type="text" class="bi-input-control" name="group_tax_plural_label" v-model="settings.group_tax_plural_label" />
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('extra_tax_plural_label--details')}}</p>
								</div>

							</div>
						
						</div>
						
						<div class="shortcode-setting--row" v-if="settings.enable_group_tax">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="enable_group_tax_archive">{{translation('enable_extra_tax_archive')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input-toggle class="m-t-6" name="enable_group_tax_archive" v-model="settings.enable_group_tax_archive" offLabel="Off" onLabel="On"></input-toggle>
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('enable_extra_tax_archive--details')}}</p>
								</div>

							</div>
						
						</div>

						<div class="shortcode-setting--row" v-if="settings.enable_group_tax && settings.enable_group_tax_archive">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="group_tax_archive_slug">{{translation('extra_tax_archive_slug')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input type="text" class="bi-input-control" name="group_tax_archive_slug" v-model="settings.group_tax_archive_slug" />
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('extra_tax_archive_slug--details')}}</p>
								</div>

							</div>
						
						</div>

					</div>

				</div>

				<!-- Tag Taxonomy Settings -->
				<div class="shortcode-settings--group">

					<div class="shortcode-settings--left">
						<h3>{{ settings.tag_tax_plural_label || translation('taxonomy_tag')}}</h3>
					</div>

					<div class="shortcode-settings--right">

						<div class="shortcode-setting--row">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="enable_tag_tax">{{translation('enable_extra_tax')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="col-xs-6 col-sm-6 col-md-5">
									<input-toggle class="m-t-6" name="enable_tag_tax" v-model="settings.enable_tag_tax" offLabel="Off" onLabel="On"></input-toggle>
								</div>

								<div class="col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('enable_extra_tax--details')}}</p>
								</div>

							</div>
						
						</div>

						<div class="shortcode-setting--row" v-if="settings.enable_tag_tax">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="tag_tax_label">{{translation('extra_tax_label')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input type="text" class="bi-input-control" name="tag_tax_label" v-model="settings.tag_tax_label" />
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('extra_tax_label--details')}}</p>
								</div>

							</div>
						
						</div>

						<div class="shortcode-setting--row" v-if="settings.enable_tag_tax">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="tag_tax_plural_label">{{translation('extra_tax_plural_label')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input type="text" class="bi-input-control" name="tag_tax_plural_label" v-model="settings.tag_tax_plural_label" />
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('extra_tax_plural_label--details')}}</p>
								</div>

							</div>
						
						</div>
						
						<div class="shortcode-setting--row" v-if="settings.enable_tag_tax">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="enable_tag_tax_archive">{{translation('enable_extra_tax_archive')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input-toggle class="m-t-6" name="enable_tag_tax_archive" v-model="settings.enable_tag_tax_archive" offLabel="Off" onLabel="On"></input-toggle>
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('enable_extra_tax_archive--details')}}</p>
								</div>

							</div>
						
						</div>

						<div class="shortcode-setting--row" v-if="settings.enable_tag_tax && settings.enable_tag_tax_archive">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="tag_tax_archive_slug">{{translation('extra_tax_archive_slug')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input type="text" class="bi-input-control" name="tag_tax_archive_slug" v-model="settings.tag_tax_archive_slug" />
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('extra_tax_archive_slug--details')}}</p>
								</div>

							</div>
						
						</div>

					</div>

				</div>

				<!-- Language Taxonomy Settings - Pro Only -->
				<div class="shortcode-settings--group">

					<div class="shortcode-settings--left">
						<h3>{{ settings.language_tax_plural_label || translation('taxonomy_language')}}</h3>
					</div>

					<div class="shortcode-settings--right">

						<div class="shortcode-setting--row">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="enable_language_tax">{{translation('enable_extra_tax')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input-toggle class="m-t-6" name="enable_language_tax" :value="false" offLabel="Off" onLabel="On"></input-toggle>
								</div>

								<div class="gs-col-xs-12 bi-text-help--area"> 
									<p class="bi-text-help">{{translation('enable_extra_tax--details')}}</p>
								</div>

							</div>
						
						</div>

					</div>

					<div class="shortcode-setting--ribon">Premium</div>

				</div>

				<!-- Location Taxonomy Settings -->
				<div class="shortcode-settings--group">

					<div class="shortcode-settings--left">
						<h3>{{ settings.location_tax_plural_label || translation('taxonomy_location')}}</h3>
					</div>

					<div class="shortcode-settings--right">

						<div class="shortcode-setting--row">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="enable_location_tax">{{translation('enable_extra_tax')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input-toggle class="m-t-6" name="enable_location_tax" :value="false" offLabel="Off" onLabel="On"></input-toggle>
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('enable_extra_tax--details')}}</p>
								</div>

							</div>
						
						</div>

					</div>

					<div class="shortcode-setting--ribon">Premium</div>

				</div>

				<!-- Gender Taxonomy Settings -->
				<div class="shortcode-settings--group">

					<div class="shortcode-settings--left">
						<h3>{{ settings.gender_tax_plural_label || translation('taxonomy_gender')}}</h3>
					</div>

					<div class="shortcode-settings--right">

						<div class="shortcode-setting--row">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="enable_gender_tax">{{translation('enable_extra_tax')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input-toggle class="m-t-6" name="enable_gender_tax" :value="false" offLabel="Off" onLabel="On"></input-toggle>
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('enable_extra_tax--details')}}</p>
								</div>

							</div>
						
						</div>

					</div>

					<div class="shortcode-setting--ribon">Premium</div>

				</div>

				<!-- Specialty Taxonomy Settings -->
				<div class="shortcode-settings--group">

					<div class="shortcode-settings--left">
						<h3>{{ settings.specialty_tax_plural_label || translation('taxonomy_specialty')}}</h3>
					</div>

					<div class="shortcode-settings--right">

						<div class="shortcode-setting--row">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="enable_specialty_tax">{{translation('enable_extra_tax')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input-toggle class="m-t-6" name="enable_specialty_tax" :value="false" offLabel="Off" onLabel="On"></input-toggle>
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('enable_extra_tax--details')}}</p>
								</div>

							</div>
						
						</div>

					</div>

					<div class="shortcode-setting--ribon">Premium</div>

				</div>

				<!-- Extra One Taxonomy Settings - Pro Only -->
				<div class="shortcode-settings--group">

					<div class="shortcode-settings--left">
						<h3>{{ settings.extra_one_tax_plural_label || translation('taxonomy_extra_one')}}</h3>
					</div>

					<div class="shortcode-settings--right">

						<div class="shortcode-setting--row">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="enable_extra_one_tax">{{translation('enable_extra_tax')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input-toggle class="m-t-6" name="enable_extra_one_tax" :value="false" offLabel="Off" onLabel="On"></input-toggle>
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('enable_extra_tax--details')}}</p>
								</div>

							</div>
						
						</div>

					</div>

					<div class="shortcode-setting--ribon">Premium</div>

				</div>

				<!-- Extra Two Taxonomy Settings - Pro Only -->
				<div class="shortcode-settings--group">

					<div class="shortcode-settings--left">
						<h3>{{ settings.extra_two_tax_plural_label || translation('taxonomy_extra_two')}}</h3>
					</div>

					<div class="shortcode-settings--right">

						<div class="shortcode-setting--row">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="enable_extra_two_tax">{{translation('enable_extra_tax')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input-toggle class="m-t-6" name="enable_extra_two_tax" :value="false" offLabel="Off" onLabel="On"></input-toggle>
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('enable_extra_tax--details')}}</p>
								</div>

							</div>
						
						</div>

					</div>

					<div class="shortcode-setting--ribon">Premium</div>

				</div>

				<!-- Extra Three Taxonomy Settings - Pro Only -->
				<div class="shortcode-settings--group">

					<div class="shortcode-settings--left">
						<h3>{{ settings.extra_three_tax_plural_label || translation('taxonomy_extra_three')}}</h3>
					</div>

					<div class="shortcode-settings--right">

						<div class="shortcode-setting--row">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="enable_extra_three_tax">{{translation('enable_extra_tax')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input-toggle class="m-t-6" name="enable_extra_three_tax" :value="false" offLabel="Off" onLabel="On"></input-toggle>
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('enable_extra_tax--details')}}</p>
								</div>

							</div>
						
						</div>

					</div>

					<div class="shortcode-setting--ribon">Premium</div>

				</div>

				<!-- Extra Four Taxonomy Settings - Pro Only -->
				<div class="shortcode-settings--group">

					<div class="shortcode-settings--left">
						<h3>{{ settings.extra_four_tax_plural_label || translation('taxonomy_extra_four')}}</h3>
					</div>

					<div class="shortcode-settings--right">

						<div class="shortcode-setting--row">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="enable_extra_four_tax">{{translation('enable_extra_tax')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input-toggle class="m-t-6" name="enable_extra_four_tax" :value="false" offLabel="Off" onLabel="On"></input-toggle>
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">
									<p class="bi-text-help">{{translation('enable_extra_tax--details')}}</p>
								</div>

							</div>
						
						</div>

					</div>

					<div class="shortcode-setting--ribon">Premium</div>

				</div>

				<!-- Extra Five Taxonomy Settings - Pro Only -->
				<div class="shortcode-settings--group">

					<div class="shortcode-settings--left">
						<h3>{{ settings.extra_five_tax_plural_label || translation('taxonomy_extra_five')}}</h3>
					</div>

					<div class="shortcode-settings--right">

						<div class="shortcode-setting--row">

							<div class="gs-roow row-20">

								<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
									<label class="m-t-10" for="enable_extra_five_tax">{{translation('enable_extra_tax')}}:</label>
									<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
								</div>

								<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
									<input-toggle class="m-t-6" name="enable_extra_five_tax" :value="false" offLabel="Off" onLabel="On"></input-toggle>
								</div>

								<div class="gs-col-xs-12 bi-text-help--area">  
									<p class="bi-text-help">{{translation('enable_extra_tax--details')}}</p>
								</div>

							</div>
						
						</div>

					</div>

					<div class="shortcode-setting--ribon">Premium</div>

				</div>

				<button class="btn btn-brand btn-sm m-t-10" @click.prevent.stop="saveOrUpdateTaxSettings">
					<i class="zmdi zmdi-floppy"></i>
					<span>{{translation('save-settings')}}</span>
				</button>

			</div>
			
		</div>
	</div>
</template>

<script>

	import notify from '../includes/notify';
	
	export default {

		data() {
			return {
				settings: {},
				isLoaded: false
			}
		},

		mounted() {
			this.setInitialTaxSettings();
			this.get_tax_settings();
			this.initHelpText();
		},

		methods: {

			getTaxSettings( json = false ) {
				
				let settings = this.nonReactive( this.settings );

				for ( let field in settings ) {

					if ( typeof settings[field] === "boolean" ) {
						settings[field] = this.convertBooleanToString( settings[field] );
					}

				}

				if ( json ) return JSON.stringify(settings);

				return settings;

			},

			setInitialTaxSettings() {

				this.setTaxSettings( this._getDefaultTaxSettings() );

			},

			setTaxSettings( settings ) {

				for ( let field in settings ) {

					if ( typeof settings[field] === "string" && (settings[field] === 'on' || settings[field] === 'off' ) ) {
						settings[field] = this.convertStringToBoolean( settings[field] );
					}

				}

				this.settings = Object.assign( {}, this.settings, settings );

			},

			get_tax_settings() {

				let self = this;

				jQuery.ajax({
					url: this.getAjaxURL(),
					type: 'GET',
					data: {
						action: 'gscoach_get_taxonomy_settings'
					}
				})
				.done(function(response) {

					if ( response && response.data && response.success ) {

						const settings = response.data;

						for ( let prop in settings ) {

							if ( typeof settings[prop] === "string" && (settings[prop] === 'on' || settings[prop] === 'off' ) ) {
								settings[prop] = self.convertStringToBoolean( settings[prop] );
							}

							self.settings = Object.assign( {}, self.settings, settings );

						}

						self.isLoaded = true;

					}

				})
				.error( response => {

					// We shouldn't show the alert to visitors, so console is fine
					console.error( response );

				});

			},

			saveOrUpdateTaxSettings() {

				jQuery.ajax({
					url: this.getAjaxURL(),
					type: 'POST',
					cache: false,
					data: {
						action: 'gscoach_save_taxonomy_settings',
						_wpnonce: this.getWPNonce(),
						tax_settings: this.getTaxSettings()
					}
				})
				.done( response => {

					if ( response.success && response.data ) {
						notify({
							type: 'success',
							message: response.data
						});

						setTimeout(() => {
							window.location.reload();
						}, 700);
					}

				})
				.error( response => {

					// We shouldn't show the alert to visitors, so console is fine
					console.error( response );

				});

			},

			updateTaxMenu( taxonomy, enable_tax_key, tax_plural_label_key ) {

				let $tax_link = jQuery('a[href="edit-tags.php?taxonomy=' + taxonomy + '&post_type=gs_coaches"]', '#menu-posts-gs_coaches');

				if ( this.settings[enable_tax_key] ) {

					if ( $tax_link.length ) {
						$tax_link.parent().show();
						let tax_plural_label = this.settings[tax_plural_label_key];
						if ( tax_plural_label ) $tax_link.text( tax_plural_label );
					}

				} else {
					if ( $tax_link.length ) $tax_link.parent().hide();
				}

			}

		},

		watch: {

			settings: {

				handler: function() {

					if ( ! this.isLoaded ) return;

					this.updateTaxMenu( 'gs_coach_group', 'enable_group_tax', 'group_tax_plural_label' );
					this.updateTaxMenu( 'gs_coach_tag', 'enable_tag_tax', 'tag_tax_plural_label' );
					this.updateTaxMenu( 'gs_coach_language', 'enable_language_tax', 'language_tax_plural_label' );
					this.updateTaxMenu( 'gs_coach_location', 'enable_location_tax', 'location_tax_plural_label' );
					this.updateTaxMenu( 'gs_coach_gender', 'enable_gender_tax', 'gender_tax_plural_label' );
					this.updateTaxMenu( 'gs_coach_specialty', 'enable_specialty_tax', 'specialty_tax_plural_label' );
					this.updateTaxMenu( 'gs_coach_extra_one', 'enable_extra_one_tax', 'extra_one_tax_plural_label' );
					this.updateTaxMenu( 'gs_coach_extra_two', 'enable_extra_two_tax', 'extra_two_tax_plural_label' );
					this.updateTaxMenu( 'gs_coach_extra_three', 'enable_extra_three_tax', 'extra_three_tax_plural_label' );
					this.updateTaxMenu( 'gs_coach_extra_four', 'enable_extra_four_tax', 'extra_four_tax_plural_label' );
					this.updateTaxMenu( 'gs_coach_extra_five', 'enable_extra_five_tax', 'extra_five_tax_plural_label' );

				},

				deep: true

			}

		}

	}
</script>