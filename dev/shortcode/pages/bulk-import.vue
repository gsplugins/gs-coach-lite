<template>
	<div class="gs-containeer shortcodes-container">

		<div class="gs-coach-box">
			
			<div class="top-section head-section">
				<h2>{{translation('bulk-import')}}</h2>
				<p>{{translation('bulk-import-description')}}</p>
			</div>

			<hr>

			<div class="bottom-section m-t-20">
				
				<template v-if="items && items.length">

					<div class="gs-roow m-t-10">
						
						<div class="gs-col-xs-6">
							<div class="font-16 m-t-10">Total: <strong>{{ items.length }}</strong> Items found.</div>
						</div>

						<div class="gs-col-xs-6 text-right">
							<button class="btn btn-brand btn-sm" @click="startImport"><i class="zmdi zmdi-download"></i> Start Importing</button>
						</div>

					</div>
					
					<table class="gs-coach-table gs--import-table m-t-20">
						<thead>
							<tr>
								<th style="width: 6%; min-width: 60px;">No</th>
								<th style="width: 7%; min-width: 90px;">Image</th>
								<th>Name</th>
								<th>Designation</th>
								<th>Email</th>
								<th>Company</th>
								<th class="text-right">Status</th>
							</tr>
						</thead>
						<tbody>

							<tr v-for="(item, index) in items" :key="index">
								<td><span class="row--number">{{ index + 1 }}</span></td>
								<td><img class="bulk-import--img" :src="item.image" :alt="item.name"></td>
								<td>{{ item.name }}</td>
								<td>{{ item.designation }}</td>
								<td>{{ item.email }}</td>
								<td>{{ item.company }}</td>
								<td class="text-right">
									<span class="status status--waiting" v-if="item.status == 'waiting'">Waiting</span>
									<span class="status status--importing" v-if="item.status == 'importing'">Importing</span>
									<span class="status status--done" v-if="item.status == 'done'">Done</span>
								</td>
							</tr>

						</tbody>
					</table>

				</template>

				<form class="bulk-import--form" enctype='multipart/form-data' @submit.prevent v-else>
					
					<h2 class="m-b-15">Choose the CSV file</h2>
					<p class="m-b-20">Choose the CSV file of your Coach Members you want to import.</p>

					<div class="import-upload--wrapper">
						<label for="import_file" class="import-upload btn btn-brand btn-sm"><i class="zmdi zmdi-cloud-upload"></i> Upload CSV File</label>
						<input type="file" name="import_file" id="import_file" :disabled="!isPro()" @change="submitForm" />
					</div>

					<div class="pro-block" v-if="!isPro()"><div class="pro-block--content"><a href="https://www.gsplugins.com/product/gs-coach-members/#pricing">Upgrade to PRO</a></div></div>

				</form>

			</div>

		</div>

	</div>
</template>

<script>

	import notify from '../includes/notify';
	
	export default {

		data() {
			return {
				items: []
			}
		},

		methods: {

			submitForm() {

				if ( ! this.isPro() ) return;

				var form_data = new FormData();
				var file_data = jQuery('#import_file').prop('files')[0];

				form_data.append( 'file', file_data );
				form_data.append( 'action', 'gscoach_process_csv_file' );
				form_data.append( '_wpnonce', this.getWPNonce() );

				let options = {
					contentType: false,
					processData: false,
					method: 'POST',
					type: 'POST',
				}

				this.ajax( form_data, options ).then( ( response ) => {
					if ( response.success && response.data && response.data.length ) {
						this.items = response.data.map( item => {
							item.status = 'waiting'
							return item;
						});
					} else if ( response.data.message ) {
						notify({
							message: response.data.message
						});
					}
				});

			},

			ajax( data, options = {} ) {

				options = jQuery.extend({}, {
					url: this.getAjaxURL(),
					type: 'POST',
					cache: false,
					data: data
				}, options );

				return new Promise( (resolve, reject) => {

					jQuery.ajax( options ).done( (response, status, settings) => {

						resolve( response );

						if ( response.success && settings.status > 200 && response.data ) {
							notify({
								type: 'info',
								message: response.data
							});
						}

					}).error( () => {

						reject();
						
						notify({
							message: 'Something is wrong! Please try again later'
						});

					})
				
				})

			},

			async startImport() {

				let index = 0;

				for ( const item of this.items ) {
					await this.runImport( item, index );
					index++;
				}

				notify({
					type: 'success',
					message: 'Import Done'
				});

			},

			async runImport( item, index ) {

				var data = {
					index,
					action: 'gscoach_bulk_import',
					_wpnonce: this.getWPNonce()
				}

				item.status = 'importing';

				return await this.ajax( data ).then( response => {
					if ( response.success ) item.status = 'done';
				});

			},

		}

	}

</script>

<style>

	.bulk-import--form {
		text-align: center;
		padding: 140px 0;
		position: relative;

	}

	.bulk-import--form input[type="file"] {
		display: none;
	}

	.pro-block {
		position: absolute;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		z-index: 999;
		display: flex;
		align-items: center;
		justify-content: center;
		background: rgba(255, 255, 255, 0.8);
	}

	.pro-block--content {
		font-size: 18px;
		background: #6472ef;
		padding: 20px 100px;
		box-shadow: 0px 0px 50px rgba(89, 97, 109, .1);
		border-radius: 3px;
		color: #fff;
		letter-spacing: 1px;
	}

	.import-upload--wrapper {
		position: relative;
	}

	.import-upload {
		border: 1px solid #ccc;
		display: inline-block;
		padding: 6px 12px;
		cursor: pointer;
		background: #fff;
		position: relative;
		z-index: 2;
	}

	.gs--import-table {
		font-size: 14px;
		line-height: 1.8;
	}

    .gs--import-table .status,
    .gs--import-table .row--number {
        padding: 3px 6px;
        border-radius: 3px;
        font-size: .9em;
        color: #fff;
        text-align: center;
    }

	.gs--import-table .row--number {
		background: #f4f7fb;
		color: #515365;
	}

    .gs--import-table .status--waiting {
        background: #b6b7c1;
    }

    .gs--import-table .status--importing {
        background: #eab85c;
    }

    .gs--import-table .status--done {
        background: #41d684;
    }

</style>