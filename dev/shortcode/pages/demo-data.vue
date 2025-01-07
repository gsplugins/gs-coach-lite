<template>
	<div class="gs-containeer shortcodes-container">

		<div class="gs-coach-box" v-if="!processing">
			
			<div class="top-section head-section">
				<h2>{{translation('install-demo-data')}}</h2>
				<p>{{translation('install-demo-data-description')}}</p>
			</div>

			<hr>

			<div class="bottom-section m-t-20">

				<div v-if="mode == 'all'">

					<div class="demo-data--import-section m-b-30">

						<h3>Import All Data</h3>
						<p>Following data will get imported:</p>

						<ul class="ul-list">
							<li>6 Coach Members</li>
							<li>12 Attachments for Coach Members</li>
							<li>Texonomies: Group, Language, Location, Gender, Specialty</li>
							<li>27 Premade Shortcodes will be created</li>
						</ul>

						<button class="btn btn-brand btn-sm m-t-6 m-r-5" @click.prevent.stop="importAllData" v-if="!teamImported || !shortcodeImported">
							<i class="zmdi zmdi-cloud-download"></i>
							<span>Import Now</span>
						</button>

						<div class="btn btn-success btn-sm m-t-6 m-r-5" v-if="teamImported && shortcodeImported">
							<i class="zmdi zmdi-cloud-done"></i>
							<span>Already Imported</span>
						</div>

						<button class="btn btn-red btn-sm m-t-6" @click.prevent.stop="removeAllData" :disabled="!teamImported && !shortcodeImported">
							<i class="zmdi zmdi-delete"></i>
							<span>Remove Data</span>
						</button>
					
					</div>

					<div class="import-manually">
						<a href="#" @click.prevent="mode='manual'">Import Manually</a>
					</div>

				</div>

				<div v-else>

					<div class="demo-data--import-section m-b-30">

						<h3>Import Coach Members</h3>
						<p>Following data will get imported:</p>

						<ul class="ul-list">
							<li>6 Coach Members</li>
							<li>12 Attachments for Coach Members</li>
							<li>Texonomies: Group, Language, Location, Gender, Specialty</li>
						</ul>

						<button class="btn btn-brand btn-sm m-t-6 m-r-5" @click.prevent.stop="importCoachData" v-if="!teamImported">
							<i class="zmdi zmdi-cloud-download"></i>
							<span>Import Now</span>
						</button>

						<div class="btn btn-success btn-sm m-t-6 m-r-5" v-if="teamImported">
							<i class="zmdi zmdi-cloud-done"></i>
							<span>Already Imported</span>
						</div>

						<button class="btn btn-red btn-sm m-t-6" @click.prevent.stop="removeCoachData" :disabled="!teamImported">
							<i class="zmdi zmdi-delete"></i>
							<span>Remove Data</span>
						</button>
					
					</div>

					<hr>

					<div class="demo-data--import-section m-t-20 m-b-30">

						<h3>Import Prebuilt Shortcodes</h3>
						<p>Following data will get imported:</p>

						<ul class="ul-list">
							<li>27 Premade Shortcodes will be created</li>
						</ul>

						<button class="btn btn-brand btn-sm m-t-6 m-r-5" @click.prevent.stop="importCoachShortcodes" v-if="!shortcodeImported">
							<i class="zmdi zmdi-cloud-download"></i>
							<span>Import Now</span>
						</button>

						<div class="btn btn-success btn-sm m-t-6 m-r-5" v-if="shortcodeImported">
							<i class="zmdi zmdi-cloud-done"></i>
							<span>Already Imported</span>
						</div>

						<button class="btn btn-red btn-sm m-t-6" @click.prevent.stop="removeCoachShortcodes" :disabled="!shortcodeImported">
							<i class="zmdi zmdi-delete"></i>
							<span>Remove Data</span>
						</button>
					
					</div>

					<div class="import-manually">
						<a href="#" @click.prevent="mode='all'">Import All</a>
					</div>

				</div>

				<vue-confirm-dialog></vue-confirm-dialog>

			</div>
		</div>

		<div class="demo-data--processing" v-if="processing">
			<div class="gs-coach-box">
				<div class="demo-data--pro-wrapper">
					<h3>Processing..</h3>
					<p>Please wait until the process completed.</p>
					<div class="gs-coach-loader"></div>
				</div>
			</div>
		</div>

	</div>
</template>

<script>

	import notify from '../includes/notify';
	
	export default {

		data() {
			return {
				mode: 'all',
				processing: false,
				teamImported: false,
				shortcodeImported: false,
			}
		},

		mounted() {

			const demoDataStatus = this.getDemoDataStatus();

			this.teamImported = demoDataStatus.team_data;
			this.shortcodeImported = demoDataStatus.shortcode_data;

		},

		computed: {

		},

		methods: {

			showLoader() {

				this.processing = true;

			},

			hideLoader() {

				this.processing = false;

			},

			updateDemoDataStatus() {

				this._updateDemoDataStatus({
					team_data: this.teamImported,
					shortcode_data: this.shortcodeImported
				});

			},

			importAllData() {

				this.ajax( 'gscoach_import_all_data' ).then( () => {
					this.teamImported = true;
					this.shortcodeImported = true;
					this.updateDemoDataStatus();
				});

			},

			removeAllData() {

				this.$confirm({
					title: 'Are you sure?',
					message: 'This action will delete all unmodified shortcodes & team members including attachments & texonomies, that inserted by gscoach dummy data importer',
					button: {
						yes: 'Yes',
						no: 'Cancel'
					},
					callback: confirm => {
						
						if ( ! confirm ) return;

						this.ajax( 'gscoach_remove_all_data' ).then( () => {
							this.teamImported = false;
							this.shortcodeImported = false;
							this.updateDemoDataStatus();
						});

					}
				});
				
			},

			importCoachData() {

				this.ajax( 'gscoach_import_team_data' ).then( () => {
					this.teamImported = true;
					this.updateDemoDataStatus();
				});

			},

			removeCoachData() {

				this.$confirm({
					title: 'Are you sure?',
					message: 'This action will delete all unmodified team members including attachments & texonomies, that inserted by gscoach dummy data importer',
					button: {
						yes: 'Yes',
						no: 'Cancel'
					},
					callback: confirm => {
						
						if ( ! confirm ) return;

						this.ajax( 'gscoach_remove_team_data' ).then( () => {
							this.teamImported = false;
							this.updateDemoDataStatus();
						});

					}
				});

			},

			importCoachShortcodes() {

				this.ajax( 'gscoach_import_shortcode_data' ).then( () => {
					this.shortcodeImported = true;
					this.updateDemoDataStatus();
				});

			},

			removeCoachShortcodes() {

				this.$confirm({
					title: 'Are you sure?',
					message: 'This action will delete all unmodified shortcodes, that inserted by gscoach dummy data importer',
					button: {
						yes: 'Yes',
						no: 'Cancel'
					},
					callback: confirm => {
						
						if ( ! confirm ) return;

						this.ajax( 'gscoach_remove_shortcode_data' ).then( () => {
							this.shortcodeImported = false;
							this.updateDemoDataStatus();
						});

					}
				});

			},

			ajax( action ) {
				
				return new Promise( (resolve, reject) => {
					
					this.showLoader();

					jQuery.ajax({
						url: this.getAjaxURL(),
						type: 'POST',
						cache: false,
						data: {
							action: action,
							_wpnonce: this.getWPNonce()
						}
					})
					.done( (response, status, settings) => {

						resolve();

						if ( this.mode == 'all' ) {

							for ( let data in response.data ) {

								notify({
									type: response.data[data].status > 200 ? 'info' : 'success',
									message: response.data[data].message
								});

							}

							return;

						}

						if ( response.success && settings.status > 200 && response.data ) {
							notify({
								type: 'info',
								message: response.data
							});
						}

						if ( response.success && settings.status == 200 && response.data ) {
							notify({
								type: 'success',
								message: response.data
							});
						}

					})
					.error( response => {

						reject();
						
						notify({
							message: 'Something is wrong! Please try again later'
						});

					})
					.always( response => {

						this.hideLoader();

					});
					
				});

			},

		},

		watch: {

		}

	}
	
</script>