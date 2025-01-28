<template>
	<div class="gs-containeer shortcodes-container">
		<div class="gs-coach-box">

			<div class="top-section head-section">
				<h2>{{translation('preference')}}</h2>
				<p>{{translation('global-settings-for-gs-coach-members')}}</p>
			</div>

			<div class="bottom-section">

				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="gs_coachmembers_slug">{{translation('coaches-slug')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input type="text" class="bi-input-control" name="gs_coachmembers_slug" v-model="preference.gs_coachmembers_slug" />
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">  
							<p class="bi-text-help">{{translation('coaches-slug-details')}}</p>
						</div>

					</div>
				
				</div>

				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="replace_custom_slug">{{translation('replace-custom-slug')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input-toggle class="m-t-6" name="replace_custom_slug" v-model="preference.replace_custom_slug" offLabel="Off" onLabel="On"></input-toggle>
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">  
							<p class="bi-text-help">{{translation('replace-custom-slug-details')}}</p>
						</div>

					</div>
				
				</div>

				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="archive_page_slug">{{translation('archive-page-slug')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input type="text" class="bi-input-control" name="archive_page_slug" v-model="preference.archive_page_slug" />
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">  
							<p class="bi-text-help">{{translation('archive-page-slug-details')}}</p>
						</div>

					</div>
				
				</div>

				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="archive_page_title">{{translation('archive-page-title')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input type="text" class="bi-input-control" name="archive_page_title" v-model="preference.archive_page_title" />
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">  
							<p class="bi-text-help">{{translation('archive-page-title-details')}}</p>
						</div>

					</div>
				
				</div>

				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="disable_google_fonts">{{translation('disable-google-fonts')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input-toggle class="m-t-6" name="disable_google_fonts" v-model="preference.disable_google_fonts" offLabel="Off" onLabel="On"></input-toggle>
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">
							<p class="bi-text-help">{{translation('disable-google-fonts-details')}}</p>
						</div>

					</div>

				</div>

				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="single_link_type">{{translation('single_link_type')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input-select class="m-t-6" key="single_link_type" id="single_link_type" v-model="preference.single_link_type" :options="preference_options.single_link_type" :placeholder="translation('single_link_type')"></input-select>
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">
							<p class="bi-text-help">{{translation('single_link_type__details')}}</p>
						</div>

					</div>

				</div>

				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="single_page_style">{{translation('single_page_style')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input-select class="m-t-6" key="single_page_style" id="single_page_style" v-model="preference.single_page_style" :options="preference_options.single_page_style" :placeholder="translation('single_page_style')"></input-select>
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">
							<p class="bi-text-help">{{translation('single_page_style__details')}}</p>
						</div>

					</div>

				</div>

				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="enable_breadcumb">{{translation('enable-breadcumb')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input-toggle class="m-t-6" name="enable_breadcumb" v-model="preference.enable_breadcumb" offLabel="Off" onLabel="On"></input-toggle>
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">
							<p class="bi-text-help">{{translation('enable-breadcumb--details')}}</p>
						</div>

					</div>

				</div>
				
				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="cell_phone_link">{{translation('cell-phone-link')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input-toggle class="m-t-6" name="cell_phone_link" v-model="preference.cell_phone_link" offLabel="Off" onLabel="On"></input-toggle>
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">
							<p class="bi-text-help">{{translation('cell-phone-link--details')}}</p>
						</div>

					</div>

				</div>
				
				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="email_link">{{translation('email-link')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input-toggle class="m-t-6" name="email_link" v-model="preference.email_link" offLabel="Off" onLabel="On"></input-toggle>
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">
							<p class="bi-text-help">{{translation('email-link--details')}}</p>
						</div>

					</div>

				</div>





				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="gs_member_nxt_prev">{{translation('next-prev-member')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input-toggle class="m-t-6" name="gs_member_nxt_prev" v-model="preference.gs_member_nxt_prev" offLabel="Off" onLabel="On"></input-toggle>
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">
							<p class="bi-text-help">{{translation('show-or-hide-next-prev-member-link-at-single-team-template')}}</p>
						</div>

					</div>

				</div>

				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="gs_member_search_all_fields">{{translation('pref-search-all-fields')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input-toggle class="m-t-6" name="gs_member_search_all_fields" v-model="preference.gs_member_search_all_fields" offLabel="Off" onLabel="On"></input-toggle>
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">
							<p class="bi-text-help">{{translation('pref-search-all-fields-details')}}</p>
						</div>

					</div>

				</div>
				
				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="disable_lazy_load">{{translation('disable_lazy_load')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input-toggle class="m-t-6" name="disable_lazy_load" v-model="preference.disable_lazy_load" offLabel="Off" onLabel="On"></input-toggle>
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">
							<p class="bi-text-help">{{translation('disable_lazy_load-details')}}</p>
						</div>

					</div>

				</div>

				<div class="shortcode-setting--row" v-if="preference.disable_lazy_load">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="lazy_load_class">{{translation('lazy_load_class')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input type="text" class="bi-input-control" name="lazy_load_class" v-model="preference.lazy_load_class" />
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">
							<p class="bi-text-help">{{translation('lazy_load_class-details')}}</p>
						</div>

					</div>
				
				</div>

				<template v-if="enabled_plugins.includes('advanced-custom-fields')">
					
					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="show_acf_fields">{{translation('show-acf-fields')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input-toggle class="m-t-6" name="show_acf_fields" v-model="preference.show_acf_fields" offLabel="Off" onLabel="On"></input-toggle>
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('show-acf-fields-details')}}</p>
							</div>

						</div>
					</div>
					
					<div class="shortcode-setting--row" v-if="preference.show_acf_fields">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="acf_fields_position">{{translation('acf-fields-position')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input-select class="m-t-6" key="acf_fields_position" id="acf_fields_position" v-model="preference.acf_fields_position" :options="preference_options.acf_fields_position" :placeholder="translation('acf_fields_position')"></input-select>
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('acf-fields-position-details')}}</p>
							</div>

						</div>

					</div>

				</template>

				<div class="shortcode-setting--row">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
							<label class="m-t-10" for="gs_member_enable_multilingual">{{translation('enable-multilingual')}}:</label>
							<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
						</div>

						<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
							<input-toggle class="m-t-6" name="gs_member_enable_multilingual" v-model="preference.gs_member_enable_multilingual" offLabel="Off" onLabel="On"></input-toggle>
						</div>

						<div class="gs-col-xs-12 bi-text-help--area">
							<p class="bi-text-help">{{translation('enable-multilingual--details')}}</p>
						</div>

					</div>

				</div>

				<template v-if="! preference.gs_member_enable_multilingual">
				
					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coachfliter_designation">{{translation('pref-filter-designation-text')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coachfliter_designation" v-model="preference.gs_coachfliter_designation" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-filter-designation-text-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coachfliter_name">{{translation('pref-serach-text')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coachfliter_name" v-model="preference.gs_coachfliter_name" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-serach-text-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coachfliter_zip">{{translation('gs_coachfliter_zip-text')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coachfliter_zip" v-model="preference.gs_coachfliter_zip" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('gs_coachfliter_zip-text-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coachfliter_tag">{{translation('gs_coachfliter_tag-text')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coachfliter_tag" v-model="preference.gs_coachfliter_tag" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('gs_coachfliter_tag-text-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coachadd_meta">{{translation('pref-address')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coachadd_meta" v-model="preference.gs_coachadd_meta" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-address-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coachemail_meta">{{translation('pref-email')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coachemail_meta" v-model="preference.gs_coachemail_meta" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-email-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_zipcode_meta">{{translation('pref-zip_code-text')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_zipcode_meta" v-model="preference.gs_coach_zipcode_meta" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-zip_code-text-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_follow_me_on">{{translation('pref-follow_me_on-text')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_follow_me_on" v-model="preference.gs_coach_follow_me_on" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-follow_me_on-text-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_skills">{{translation('pref-skills-text')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_skills" v-model="preference.gs_coach_skills" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-skills-text-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_more">{{translation('pref-more')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_more" v-model="preference.gs_coach_more" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-more-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_profession">{{translation('pref-profession')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_profession" v-model="preference.gs_coach_profession" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-profession-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_experience">{{translation('pref-experience')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_experience" v-model="preference.gs_coach_experience" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-experience-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_education">{{translation('pref-education')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_education" v-model="preference.gs_coach_education" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-education-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_state">{{translation('pref-state')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_state" v-model="preference.gs_coach_state" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-state-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_country">{{translation('pref-country')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_country" v-model="preference.gs_coach_country" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-country-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_schedule">{{translation('pref-schedule')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_schedule" v-model="preference.gs_coach_schedule" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-schedule-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_availablity">{{translation('pref-availablity')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_availablity" v-model="preference.gs_coach_availablity" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-availablity-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_personal-site">{{translation('pref-personal-site')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_personal-site" v-model="preference.gs_coach_personal_site" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-personal-site-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_course-link">{{translation('pref-course-link')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_course-link" v-model="preference.gs_coach_course_link" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-course-link-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_fee">{{translation('pref-fee')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_fee" v-model="preference.gs_coach_fee" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-fee-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_review">{{translation('pref-review')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_review" v-model="preference.gs_coach_review" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-review-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_rating">{{translation('pref-rating')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_rating" v-model="preference.gs_coach_rating" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('pref-rating-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_reset_filters_txt">{{translation('reset-filters')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_reset_filters_txt" v-model="preference.gs_coach_reset_filters_txt" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('reset-filters-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_next_txt">{{translation('next')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_next_txt" v-model="preference.gs_coach_next_txt" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('next-details')}}</p>
							</div>

						</div>
					
					</div>

					<div class="shortcode-setting--row">

						<div class="gs-roow row-20">

							<div class="gs-col-xs-6 gs-col-sm-5 gs-col-md-4">
								<label class="m-t-10" for="gs_coach_prev_txt">{{translation('prev')}}:</label>
								<button class="gscoach-show--info"><i class="zmdi zmdi-help-outline"></i></button>
							</div>

							<div class="gs-col-xs-6 gs-col-sm-6 gs-col-md-5">
								<input type="text" class="bi-input-control" name="gs_coach_prev_txt" v-model="preference.gs_coach_prev_txt" />
							</div>

							<div class="gs-col-xs-12 bi-text-help--area">
								<p class="bi-text-help">{{translation('prev-details')}}</p>
							</div>

						</div>
					
					</div>

				</template>

				<div class="shortcode-setting--row" style="border: none;">

					<div class="gs-roow row-20">

						<div class="gs-col-xs-12">
							<label class="m-t-10" for="gs_coach_custom_css">{{translation('custom-css')}}:</label>
						</div>

						<div class="gs-col-xs-9">
							<editor-cm id="gs_coach_custom_css" mode="css" name="gs_coach_custom_css" v-model="preference.gs_coach_custom_css"></editor-cm>
						</div>

					</div>
				
				</div>

				<button class="btn btn-brand btn-sm m-t-10" @click.prevent.stop="saveOrUpdatePreference">
					<i class="zmdi zmdi-floppy"></i>
					<span>{{translation('save-preference')}}</span>
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
				preference: {},
				preference_options: {},
				enabled_plugins: _gscoach_data.enabled_plugins
			}
		},

		mounted() {

			this.stopWatcher = false;
			this.setInitialSettings();
			this.get_preference();
			
			this.initHelpText();
			Events.$emit('editor-sm:update-value');

		},

		methods: {

			getPreference( json = false ) {
				
				let preference = this.nonReactive( this.preference );

				for ( let field in preference ) {

					if ( typeof preference[field] === "boolean" ) {
						preference[field] = this.convertBooleanToString( preference[field] );
					}

				}

				if ( json ) return JSON.stringify(preference);

				return preference;

			},

			setInitialSettings() {

				let pref_options = this._getPreferenceOptions();

				for ( let option_group in pref_options ) {
					if ( pref_options[option_group].some( item => item.pro ) ) {
						pref_options[option_group] = pref_options[option_group].map( item => {
							if ( item.pro ) item.disabled = true;
							return item;
						});
					}
				}

				this.$set( this, 'preference_options', pref_options );

				this.setPreference( this._getPreference() );

			},

			setPreference( settings ) {

				for ( let field in settings ) {

					if ( typeof settings[field] === "string" && (settings[field] === 'on' || settings[field] === 'off' ) ) {
						settings[field] = this.convertStringToBoolean( settings[field] );
					}

				}

				this.preference = Object.assign( {}, this.preference, settings );

			},

			get_preference() {

				let self = this;

				jQuery.ajax({
					url: this.getAjaxURL(),
					type: 'GET',
					data: {
						action: 'gscoach_get_shortcode_pref'
					}
				})
				.done(function(response) {

					if ( response && response.data && response.success ) {

						const prefs = response.data;

						for ( let prop in prefs ) {

							if ( typeof prefs[prop] === "string" && (prefs[prop] === 'on' || prefs[prop] === 'off' ) ) {
								prefs[prop] = self.convertStringToBoolean( prefs[prop] );
							}

							self.preference = Object.assign( {}, self.preference, prefs );

						}

					}

				})
				.error( response => {

					// We shouldn't show the alert to visitors, so console is fine
					console.error( response );

				});

			},

			saveOrUpdatePreference() {

				jQuery.ajax({
					url: this.getAjaxURL(),
					type: 'POST',
					cache: false,
					data: {
						action: 'gscoach_save_shortcode_pref',
						_wpnonce: this.getWPNonce(),
						prefs: this.getPreference()
					}
				})
				.done( response => {

					if ( response.success && response.data ) {
						notify({
							type: 'success',
							message: response.data
						});
					}

				})
				.error( response => {

					// We shouldn't show the alert to visitors, so console is fine
					console.error( response );

				});

			},

		},

		watch: {

			preference: {

				handler: function() {
					if ( Object.keys( this.preference ).length ) {
						_gscoach_data.is_multilingual = this.preference.gs_member_enable_multilingual;
					}
				},

				deep: true

			}

		}

	}
</script>