<?php

namespace GSCOACH;

/**
 * Protect direct access
 */
if (!defined('ABSPATH')) exit;

class Meta_Fields {

	public function __construct() {

		add_action('add_meta_boxes', [ $this, 'add_gs_coach_metaboxes' ] );
		add_action('admin_enqueue_scripts', [ $this, 'gs_coach_enqueue_admin_scripts' ]);
		add_action('save_post', [ $this, 'save_gs_coach_metadata' ] );
	}

	function add_gs_coach_metaboxes() {
		add_meta_box('gsCoachSection', 'Coach\'s Additional Info', [ $this, 'cmb_cb' ], 'gs_coach', 'normal', 'high');
		add_meta_box('gsCoachSectionSocial', 'Coach\'s Social Links', [ $this, 'cmb_social_cb' ], 'gs_coach', 'normal', 'high');
		add_meta_box('gsCoachSectionSkill', 'Coach\'s Skills', [ $this, 'cmb_skill_cb' ], 'gs_coach', 'normal', 'high');
		add_meta_box('gsCoachSectionCertificate', 'Coach\'s Certificates', [ $this, 'cmb_certificate_cb' ], 'gs_coach', 'normal', 'high');
		add_meta_box('gsCoachSectionCV', 'Coach\'s CV', [ $this, 'cmb_cv_cb' ], 'gs_coach', 'normal', 'high');
	}

	function gs_coach_enqueue_admin_scripts($hook) {
		global $post;
		if ($hook === 'post.php' || $hook === 'post-new.php') {
			if ('gs_coach' === get_post_type($post)) {
				wp_enqueue_media();
				wp_enqueue_script('gs-coach-cv-uploader', GSCOACH_PLUGIN_URI . '/assets/admin/js/cv-uploader.js', array('jquery'), GSCOACH_VERSION, true);
			}
		}
	}

	function gs_image_uploader_field($name, $value = '') {

		$image = ' button">Upload Image';
		$image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
		$display = 'none'; // display state ot the "Remove image" button
	
		if ($image_attributes = wp_get_attachment_image_src($value, $image_size)) {
	
			// $image_attributes[0] - image URL
			// $image_attributes[1] - image width
			// $image_attributes[2] - image height
	
			$image = '"><img src="' . esc_attr($image_attributes[0]) . '" />';
			$display = 'inline-block';
		}
	
		return '<div class="form-group"><label for="second_featured_img">Flip Image:</label><div class="gs-image-uploader-area"><a href="#" class="gs_upload_image_button' . $image . '</a><input type="hidden" name="' . esc_attr($name) . '" id="' . esc_attr($name) . '" value="' . esc_attr($value) . '" /><a href="#" class="gs_remove_image_button" style="display:inline-block;display:' . esc_attr($display) . '">Remove image</a></div></div>';
	}

	
	function cmb_cb($post) {

		// Add a nonce field so we can check for it later.
		wp_nonce_field('gs_coach_nonce_name', 'gs_coach_cmb_token');

		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$gs_prof        = get_post_meta($post->ID, '_gscoach_profession', true);

		$gs_coach_experience       = get_post_meta($post->ID, '_gscoach_experience', true);
		$gs_coach_education        = get_post_meta($post->ID, '_gscoach_education', true);
		$gs_coach_address          = get_post_meta($post->ID, '_gscoach_address', true);
		$gs_coach_state            = get_post_meta($post->ID, '_gscoach_state', true);
		$gs_coach_country          = get_post_meta($post->ID, '_gscoach_country', true);
		$gs_coach_contact_number   = get_post_meta($post->ID, '_gscoach_contact', true);
		$gs_coach_email            = get_post_meta($post->ID, '_gscoach_email', true);
		$gs_coach_schedule         = get_post_meta($post->ID, '_gscoach_shedule', true);
		$gs_coach_available        = get_post_meta($post->ID, '_gscoach_available', true);
		$gs_coach_psite            = get_post_meta($post->ID, '_gscoach_psite', true);
		$gs_coach_courselink       = get_post_meta($post->ID, '_gscoach_courselink', true);
		$gs_coach_fee              = get_post_meta($post->ID, '_gscoach_fee', true);
		$gs_coach_review           = get_post_meta($post->ID, '_gscoach_review', true);
		$gs_coach_rating 		   = get_post_meta($post->ID, '_gscoach_rating', true);
		$gs_coach_rating		   = '' !== $gs_coach_rating ? $gs_coach_rating : '2';
		$gs_coach_custom_page 	   = get_post_meta($post->ID, '_gscoach_custom_page', true);

		?>

		<div class="gs_coach-metafields">

			<div style="height: 20px;"></div>

			<div class="form-group">
				<label for="gsProf"><?php echo get_meta_field_name('_gscoach_profession'); ?></label>
				<input type="text" id="gsProf" class="form-control" name="gs_prof" value="<?php echo isset($gs_prof) ? esc_attr($gs_prof) : ''; ?>">
			</div>

			<div class="gs-coach-pro-field">

			<div class="form-group">
					<label for="gsCoachExperience"><?php echo get_meta_field_name('_gscoach_experience'); ?></label>
					<input type="text" id="gsCoachExperience" class="form-control" name="gs_coach_experience" placeholder="Experience" value="<?php echo isset($gs_coach_experience) ? esc_attr($gs_coach_experience) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachEducation"><?php echo get_meta_field_name('_gscoach_education'); ?></label>
					<input type="text" id="gsCoachEducation" class="form-control" name="gs_coach_education" placeholder="Education" value="<?php echo isset($gs_coach_education) ? esc_attr($gs_coach_education) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachAddress"><?php echo get_meta_field_name('_gscoach_address'); ?></label>
					<input type="text" id="gsCoachAddress" class="form-control" name="gs_coach_address" placeholder="Address" value="<?php echo isset($gs_coach_address) ? esc_attr($gs_coach_address) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachState"><?php echo get_meta_field_name('_gscoach_state'); ?></label>
					<input type="text" id="gsCoachState" class="form-control" name="gs_coach_state" placeholder="State/City" value="<?php echo isset($gs_coach_state) ? esc_attr($gs_coach_state) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachCountry"><?php echo get_meta_field_name('_gscoach_country'); ?></label>
					<input type="text" id="gsCoachCountry" class="form-control" name="gs_coach_country" placeholder="Country" value="<?php echo isset($gs_coach_country) ? esc_attr($gs_coach_country) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachContactNumber"><?php echo get_meta_field_name('_gscoach_contact'); ?></label>
					<input type="text" id="gsCoachContactNumber" class="form-control" name="gs_coach_contact_number" placeholder="Contact Number" value="<?php echo isset($gs_coach_contact_number) ? esc_attr($gs_coach_contact_number) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachEmail"><?php echo get_meta_field_name('_gscoach_email'); ?></label>
					<input type="email" id="gsCoachEmail" class="form-control" name="gs_coach_email" placeholder="Email Address" value="<?php echo isset($gs_coach_email) ? esc_attr($gs_coach_email) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachSchedule"><?php echo get_meta_field_name('_gscoach_shedule'); ?></label>
					<input type="time" id="gsCoachSchedule" class="form-control" name="gs_coach_schedule" placeholder="Schedule Time" value="<?php echo isset($gs_coach_schedule) ? esc_attr($gs_coach_schedule) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachAvailable"><?php echo get_meta_field_name('_gscoach_available'); ?></label>
					<input type="date" id="gsCoachAvailable" class="form-control" name="gs_coach_available" placeholder="Available" value="<?php echo isset($gs_coach_available) ? esc_attr($gs_coach_available) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachPersonalSite"><?php echo get_meta_field_name('_gscoach_psite'); ?></label>
					<input type="url" id="gsCoachPersonalSite" class="form-control" name="gs_coach_psite" placeholder="Personal Site" value="<?php echo isset($gs_coach_psite) ? esc_attr($gs_coach_psite) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachCourseLink"><?php echo get_meta_field_name('_gscoach_courselink'); ?></label>
					<input type="url" id="gsCoachCourseLink" class="form-control" name="gs_coach_courselink" placeholder="Course Link" value="<?php echo isset($gs_coach_courselink) ? esc_attr($gs_coach_courselink) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachFee"><?php echo get_meta_field_name('_gscoach_fee'); ?></label>
					<input type="text" id="gsCoachFee" class="form-control" name="gs_coach_fee" placeholder="Fee" value="<?php echo isset($gs_coach_fee) ? esc_attr($gs_coach_fee) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachReview"><?php echo get_meta_field_name('_gscoach_review'); ?></label>
					<input type="text" id="gsCoachReview" class="form-control" name="gs_coach_review" placeholder="Review" value="<?php echo isset($gs_coach_review) ? esc_attr($gs_coach_review) : ''; ?>">
				</div>

				<div class="form-group gs-star-rating">
					<label for="gsCoachRating"><b><?php echo get_meta_field_name('_gscoach_rating'); ?></b></label>
					<input name="gs_coach_rating" type="range" value="<?php echo esc_attr($gs_coach_rating); ?>" step="0.25" id="gsCoachRating" class="form-control" style="display:none" />
					<div class="rateit bigstars" data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-backingfld="#gsCoachRating" data-rateit-resetable="false" data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5"></div>
				</div>

				<div class="form-group">
					<label for="gsCoachCustomPage"><?php echo get_meta_field_name('_gscoach_custom_page'); ?></label>
					<input type="url" id="gsCoachCustomPage" class="form-control" name="gs_coach_custom_page" placeholder="Custom Page Link" value="<?php echo isset($gs_coach_custom_page) ? esc_attr($gs_coach_custom_page) : ''; ?>">
				</div>

				<!-- <?php
				// $meta_key = 'second_featured_img';
				// echo $this->gs_image_uploader_field($meta_key, get_post_meta($post->ID, $meta_key, true));
				?> -->

			</div>

		</div>

	<?php
	}

	function cmb_social_cb($post) {

		// Add a nonce field so we can check for it later.
		wp_nonce_field('gs_coach_nonce_name', 'gs_coach_cmb_token');

		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$_gscoach_socials = get_post_meta( $post->ID, '_gscoach_socials', true );
		
		$social_icons = require_once GSCOACH_PLUGIN_DIR . 'includes/fs-icons.php';

	?>

		<div class="gs_coach-metafields">

			<div style="height: 20px;"></div>

			<div class="gs-coach-social--section">

				<div class="coach-details-section">

					<table id="repeatable-fieldset-two" width="100%" class="gscoach-sorable-table">
						<thead>
							<tr>
								<td width="3%"></td>
								<td width="45%"><?php _e('Icon', 'gscoach'); ?></td>
								<td width="42%"><?php _e('Link', 'gscoach'); ?></td>
								<td width="10%"></td>
							</tr>
						</thead>
						<tbody>

							<?php if ($_gscoach_socials) : foreach ($_gscoach_socials as $field) : ?>

									<tr>
										<td><i class="fas fa-arrows-alt" aria-hidden="true"></i></td>
										<td>
											<?php select_builder('gscoach-team-icon[]', $social_icons, $field['icon'], __('Select icon', 'gscoach'), 'widefat gscoach-icon-select'); ?>
										</td>
										<td><input type="text" placeholder="<?php _e('ex: https://twitter.com/gsplugins', 'gscoach'); ?>" class="widefat" name="gscoach-team-link[]" value="<?php if (isset($field['link'])) echo esc_attr($field['link']); ?>" /></td>
										<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
									</tr>

								<?php endforeach;
							else : ?>

								<tr>
									<td><i class="fas fa-arrows-alt" aria-hidden="true"></i></td>
									<td>
										<?php select_builder('gscoach-team-icon[]', $social_icons, '', __('Select icon', 'gscoach'), 'widefat gscoach-icon-select'); ?>
									</td>
									<td><input type="text" placeholder="<?php _e('ex: https://twitter.com/gsplugins', 'gscoach'); ?>" class="widefat" name="gscoach-team-link[]" value="" /></td>
									<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
								</tr>

							<?php endif; ?>

							<tr class="empty-row screen-reader-text">
								<td><i class="fas fa-arrows-alt" aria-hidden="true"></i></td>
								<td>
									<?php select_builder('gscoach-team-icon[]', $social_icons, '', __('Select icon', 'gscoach'), 'widefat'); ?>
								</td>
								<td><input type="text" placeholder="<?php _e('ex: https://twitter.com/gsplugins', 'gscoach'); ?>" class="widefat" name="gscoach-team-link[]" value="" /></td>
								<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
							</tr>

						</tbody>
					</table>

					<p><a class="button gscoach-add-row" href="#" data-table="repeatable-fieldset-two"><?php _e('Add Row', 'gscoach'); ?></a></p>

				</div>

			</div>

		</div>

	<?php
	}


	function cmb_skill_cb($post) {

		// Add a nonce field so we can check for it later.
		wp_nonce_field('gs_coach_nonce_name', 'gs_coach_cmb_token');

		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$gscoach_skills = get_post_meta($post->ID, '_gscoach_skills', true);

	?>

		<div class="gs_coach-metafields">

			<div style="height: 20px;"></div>

			<div class="gs-coach-skills--section gs-coach-pro-field">

				<div class="coach-details-section">
					<table id="repeatable-fieldset-skill" width="100%" class="gscoach-sorable-table">
						<thead>
							<tr>
								<td width="3%"></td>
								<td width="45%"><?php _e('Title', 'gscoach'); ?></td>
								<td width="42%"><?php _e('Percent', 'gscoach'); ?></td>
								<td width="10%"></td>
							</tr>
						</thead>
						<tbody>

							<?php if ($gscoach_skills) : foreach ($gscoach_skills as $field) : ?>

									<tr>
										<td><i class="fas fa-arrows-alt" aria-hidden="true"></i></td>
										<td>
											<input type="text" placeholder="html" class="widefat" name="gscoach-skill-name[]" value="<?php if (isset($field['skill'])) echo esc_attr($field['skill']); ?>" />
										</td>
										<td><input type="text" placeholder="85" class="widefat" name="gscoach-skill-percent[]" value="<?php if (isset($field['percent'])) echo esc_attr($field['percent']); ?>" /></td>
										<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
									</tr>

								<?php endforeach;
							else : ?>

								<tr>
									<td><i class="fas fa-arrows-alt" aria-hidden="true"></i></td>
									<td>
										<input type="text" placeholder="html" class="widefat" name="gscoach-skill-name[]" value="<?php if (isset($field['skill'])) echo esc_attr($field['skill']); ?>" />
									</td>
									<td><input type="text" placeholder="85" class="widefat" name="gscoach-skill-percent[]" value="<?php if (isset($field['percent'])) echo esc_attr($field['percent']); ?>" /></td>
									<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
								</tr>

							<?php endif; ?>

							<tr class="empty-skill screen-reader-text">
								<td><i class="fas fa-arrows-alt" aria-hidden="true"></i></td>
								<td>
									<input type="text" placeholder="<?php _e('ex: Wordpress', 'gscoach'); ?>" class="widefat" name="gscoach-skill-name[]" value="<?php if (isset($field['link'])) echo esc_attr($field['link']); ?>" />
								</td>
								<td><input type="text" placeholder="<?php _e('ex: 90', 'gscoach'); ?>" class="widefat" name="gscoach-skill-percent[]" value="" /></td>
								<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
							</tr>

						</tbody>
					</table>

					<p><a class="button gscoach-add-skill" href="#" data-table="repeatable-fieldset-skill"><?php _e('Add Row', 'gscoach'); ?></a></p>

				</div>

			</div>


		</div>

	<?php
	}


	public function cmb_certificate_cb(){
		
		// Add a nonce field so we can check for it later.
		wp_nonce_field('gs_coach_nonce_name', 'gs_coach_cmb_token');

		global $post;
		// Here we get the current images ids of the gallery
		$custom = get_post_custom($post->ID);
		$gscoach_certif_gallery = (isset($custom["gscoach_certif_gallery"][0])) ? $custom["gscoach_certif_gallery"][0] : '';
	
		// We display the gallery
		?>
	
		<div class="gs-coach-pro-field gs_coach-metafields">
			<div class="gs_coach_gallery_certifs">
				<?php
				$img_array = (isset($gscoach_certif_gallery) && $gscoach_certif_gallery != '') ? explode(',', $gscoach_certif_gallery) : '';
				if ($img_array != '') {
					foreach ($img_array as $img) {
						echo '<div class="gallery-item">'.wp_get_attachment_image($img).'</div>';
					}
				}
				?>
			</div>
			<p class="separator">
				<input id="gscoach_certif_gal_input" type="hidden" name="gscoach_certif_gallery" value="<?php echo $gscoach_certif_gallery; ?>" data-urls=""/>
				<input id="manage_certificate" class="button gs-meta-button" title="Add / Edit Certificates" type="button" value="Add / Edit Certificates" />
				<input id="gscoach_empty_certif" class="button gs-meta-button" title="Empty Certificates" type="button" value="Empty Certificates" />
			</p>
		</div>
		<?php
	}


	public function cmb_cv_cb( $post ){
		// Add a nonce field so we can check for it later.
		wp_nonce_field('gs_coach_nonce_name', 'gs_coach_cmb_token');

		$cv_url = get_post_meta($post->ID, '_gscoach_cv', true);

		?>
		<div class="gs-coach-pro-field gs_coach-metafields">
			<p>
				<input type="text" id="gs_coach_cv" name="gs_coach_cv" value="<?php echo esc_url($cv_url); ?>" placeholder="Select or Upload CV" readonly />
				<button type="button" class="button gs-meta-button gs-coach-upload-cv"><?php esc_html_e('Upload CV', 'gscoach'); ?></button>
				<button type="button" class="button gs-meta-button gs-coach-remove-cv"><?php esc_html_e('Remove', 'gscoach'); ?></button>
			</p>
			<?php if ($cv_url) : ?>
				<p><a class="gs-coach-view-cv-link" href="<?php echo esc_url($cv_url); ?>" target="_blank"><?php esc_html_e('View CV', 'gscoach'); ?></a></p>
			<?php endif; ?>
		</div>
		<?php
	}


	public function save_gs_coach_metadata($post_id) {

		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */

		// Check if our nonce is set.
		if (!isset($_POST['gs_coach_cmb_token'])) {
			return;
		}

		// Verify that the nonce is valid.
		if (!wp_verify_nonce($_POST['gs_coach_cmb_token'], 'gs_coach_nonce_name')) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		// Check the user's permissions.
		if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

			if (!current_user_can('edit_page', $post_id)) {
				return;
			}
		} else {

			if (!current_user_can('edit_post', $post_id)) {
				return;
			}
		}

		if (!empty($social_icons = $_POST['gscoach-team-icon']) && !empty($social_links = $_POST['gscoach-team-link'])) {

			$social_icons = array_map('sanitize_text_field', $social_icons);
			$social_links = array_map('sanitize_text_field', $social_links);

			$newdata = array_map(function ($icon, $link) {
				if (!empty($icon) && !empty($link)) return ['icon' => $icon, 'link' => $link];
			}, $social_icons, $social_links);

			$meta_key = '_gscoach_socials';

			$newdata = array_values(array_filter($newdata));
			$olddata = get_post_meta($post_id, $meta_key, true);

			if (!empty($newdata) && $newdata != $olddata) {
				update_post_meta($post_id, $meta_key, $newdata);
			} elseif (empty($newdata) && $olddata) {
				delete_post_meta($post_id, $meta_key, $olddata);
			}
		}


		if (is_pro_valid()) {

			if (!empty($coach_skill = $_POST['gscoach-skill-name']) && !empty($coachs_percent = $_POST['gscoach-skill-percent'])) {

				$coach_skill = array_map('sanitize_text_field', $coach_skill);
				$coachs_percent = array_map('absint', $coachs_percent);

				$newdata = array_map(function ($skill, $percent) {
					if (!empty($skill) && !empty($percent)) return ['skill' => $skill, 'percent' => $percent];
				}, $coach_skill, $coachs_percent);

				$meta_key = '_gscoach_skills';

				$newdata = array_values(array_filter($newdata));
				$olddata = get_post_meta($post_id, $meta_key, true);

				if (!empty($newdata) && $newdata != $olddata) {
					update_post_meta($post_id, $meta_key, $newdata);
				} elseif (empty($newdata) && $olddata) {
					delete_post_meta($post_id, $meta_key, $olddata);
				}
			}
		}

		/* OK, it's safe for us to save the data now. */

		// Make sure that it is set.
		if (!isset($_POST['gs_prof'])) {
			return;
		}

		// Sanitize user input.
		$gs_prof_data = sanitize_text_field($_POST['gs_prof']);
		update_post_meta($post_id, '_gscoach_profession', $gs_prof_data);

		if (is_pro_valid()) {

			update_post_meta($post_id, '_gscoach_experience', sanitize_text_field($_POST['gs_coach_experience']));
			update_post_meta($post_id, '_gscoach_education', sanitize_text_field($_POST['gs_coach_education']));
			update_post_meta($post_id, '_gscoach_address', sanitize_text_field($_POST['gs_coach_address']));
			update_post_meta($post_id, '_gscoach_state', sanitize_text_field($_POST['gs_coach_state']));
			update_post_meta($post_id, '_gscoach_country', sanitize_text_field($_POST['gs_coach_country']));
			update_post_meta($post_id, '_gscoach_contact', sanitize_text_field($_POST['gs_coach_contact_number']));
			update_post_meta($post_id, '_gscoach_email', sanitize_text_field($_POST['gs_coach_email']));
			update_post_meta($post_id, '_gscoach_shedule', sanitize_text_field($_POST['gs_coach_schedule']));
			update_post_meta($post_id, '_gscoach_available', sanitize_text_field($_POST['gs_coach_available']));
			update_post_meta($post_id, '_gscoach_psite', sanitize_text_field($_POST['gs_coach_psite']));
			update_post_meta($post_id, '_gscoach_courselink', sanitize_text_field($_POST['gs_coach_courselink']));
			update_post_meta($post_id, '_gscoach_fee', sanitize_text_field($_POST['gs_coach_fee']));
			update_post_meta($post_id, '_gscoach_review', sanitize_text_field($_POST['gs_coach_review']));
			update_post_meta($post_id, '_gscoach_rating', sanitize_text_field($_POST['gs_coach_rating']));
			update_post_meta($post_id, '_gscoach_custom_page', sanitize_text_field($_POST['gs_coach_custom_page']));

			// Save certificate gallery
			global $post;
			if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
				return;
			} else if(is_object($post)){
			   
				$gscoach_certif_gallery = (isset($_POST["gscoach_certif_gallery"])) ? $_POST["gscoach_certif_gallery"] : '';
				update_post_meta($post->ID, "gscoach_certif_gallery", $gscoach_certif_gallery);
			}

			// Save CV
			if (isset($_POST['gs_coach_cv'])) {
				update_post_meta($post_id, '_gscoach_cv', esc_url_raw($_POST['gs_coach_cv']));
			} else {
				delete_post_meta($post_id, '_gscoach_cv');
			}
		}
	}
}
