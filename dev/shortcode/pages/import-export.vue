<template>
	<div class="gs-containeer import-export--container">

		<div class="gs-coach-box">

			<div class="gs-roow">

				<div class="gs-col-xs-12 gs-col-md-6 section--export">
				
					<div class="top-section head-section">
						<h2>{{translation('export-data')}}</h2>
						<p>{{translation('export-data--description')}}</p>
					</div>

					<hr>

					<div class="bottom-section m-t-20">

						<ul>
							<li>
								<label for="export-coaches">
									<input type="checkbox" id="export-coaches" v-model="export_data.coaches"> {{translation('export-coaches-data')}}
								</label>
							</li>

							<li>
								<label for="export-shortcodes">
									<input type="checkbox" id="export-shortcodes" v-model="export_data.shortcodes"> {{translation('export-shortcodes-data')}}
								</label>
							</li>

							<li>
								<label for="export-settings">
									<input type="checkbox" id="export-settings" v-model="export_data.settings"> {{translation('export-settings-data')}}
								</label>
							</li>
						</ul>

						<div class="action-btn--area m-t-15 m-r-5">

							<button class="btn btn-brand btn-sm" @click.prevent.stop="exportData" :disabled="exporting || importing || Object.values( export_data ).every(v => !v)">
								<i class="zmdi zmdi-file-text"></i>
								<span>Export Data</span>
							</button>

							<div class="gs-coach-loader--circle" v-if="exporting"><span></span><span></span><span></span></div>

						</div>


					</div>

				</div>

				<div class="gs-col-xs-12 gs-col-md-6 section--import">

					<div class="top-section head-section">
						<h2>{{translation('import-data')}}</h2>
						<p>{{translation('import-data--description')}}</p>
					</div>

					<hr>

					<div class="bottom-section m-t-20">

						<form @submit.prevent="importData">

							<input type="file" ref="importFile" accept="application/zip" required @change="onUploadFiles">
							<br>
							<br>

							<div class="action-btn--area m-t-6 m-r-5">

								<button type="submit" class="btn btn-brand btn-sm" :disabled="importing || exporting || ! importFileSelected">
									<i class="zmdi zmdi-file-text"></i>
									<span>Import Data</span>
								</button>

								<div class="gs-coach-loader--circle" v-if="importing"><span></span><span></span><span></span></div>

							</div>

						</form>

					</div>

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
				exporting: false,
				importing: false,
				importFileSelected: false,
				export_data: {
					coaches: true,
					shortcodes: true,
					settings: true
				}
			}
		},

		methods: {

			onUploadFiles( e ) {
				this.importFileSelected = this.$refs.importFile && this.$refs.importFile.files.length > 0;
			},

			exportData() {
				
				this.exporting = true;

				const requestedStarted = Date.now();
				
				const args = {
					url: this.getAjaxURL(),
					type: 'POST',
					cache: false,
					data: {
						_wpnonce: this.getWPNonce(),
						action: 'gscoach_export_data',
						export_data: this.export_data
					},
					xhrFields: {
						responseType: 'blob'
					}
				}

				jQuery.ajax( args ).done( data => {
					
					// Download the file
					this.fileDownload( data, 'gs-coach--export--data.zip' );

					// Show notification
					notify({
						type: 'success',
						message: 'Data exported successfully'
					});

					// Reset the exporting flag
					this.resetExporting( requestedStarted );

				}).fail( () => {

					// Reset the exporting flag
					this.exporting = false;

					// Show notification
					notify({
						type: 'error',
						message: 'Failed to export data'
					});

					// Reset the exporting flag
					this.resetExporting( requestedStarted );

				});

			},

			resetExporting( requestedStarted ) {
				const timeDiff = Date.now() - requestedStarted;
				const delay = timeDiff < 1000 ? 1000 - timeDiff : 0;
				setTimeout( () => {
					this.exporting = false;
				}, delay );
			},

			resetImporting( requestedStarted ) {
				const timeDiff = Date.now() - requestedStarted;
				const delay = timeDiff < 500 ? 500 - timeDiff : 0;
				setTimeout( () => {
					this.importing = false;
				}, delay );
			},

			importData() {

				this.importing = true;

				const requestedStarted = Date.now();

				const formData = new FormData();

				formData.append( 'import_file', this.$refs.importFile.files[0] );
				formData.append( 'action', 'gscoach_import_data' );
				formData.append( '_wpnonce', this.getWPNonce() );

				const options = {
					contentType: false,
					processData: false,
					method: 'POST',
					type: 'POST',
					data: formData
				}

				jQuery.ajax( this.getAjaxURL(), options ).done( res => {
					
					// Show notification
					notify({
						type: 'success',
						message: res.data || 'Data imported successfully'
					});

					// Reset the file input
					this.$refs.importFile.value = '';
					this.importFileSelected = false;

					// Reset the importing flag
					this.resetImporting( requestedStarted );

				}).fail( (error) => {
					
					// Show notification
					notify({
						type: 'error',
						message: error.responseJSON.data || 'Failed to import data'
					});

					// Reset the importing flag
					this.resetImporting( requestedStarted );

				});

			},

			fileDownload( data, filename ) {
				var a = document.createElement('a');
				var url = window.URL.createObjectURL(data);
				a.href = url;
				a.download = filename;
				document.body.append(a);
				a.click();
				a.remove();
				window.URL.revokeObjectURL(url);
			},

		}

	}
	
</script>