<?php

namespace GSCOACH;

/**
 * Protect direct access
 */
if (!defined('ABSPATH')) exit;

class Meta_Fields {

	public function __construct() {

		add_action('add_meta_boxes', [ $this, 'add_gs_coach_metaboxes' ] );
		add_action('save_post', [ $this, 'save_gs_coach_metadata' ] );
	}

	function add_gs_coach_metaboxes() {
		add_meta_box('gsCoachSection', 'Coach\'s Additional Info', [ $this, 'cmb_cb' ], 'gs_coach', 'normal', 'high');
		add_meta_box('gsCoachSectionSocial', 'Coach\'s Social Links', [ $this, 'cmb_social_cb' ], 'gs_coach', 'normal', 'high');
		add_meta_box('gsCoachSectionSkill', 'Coach\'s Skills', [ $this, 'cmb_skill_cb' ], 'gs_coach', 'normal', 'high');
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
		$gs_coach_rating 		   = get_post_meta( $post->ID, '_gscoach_rating', true );
		$gs_coach_rating		   = $gs_coach_rating ? $gs_coach_rating : 2;

		?>

		<div class="gs_coach-metafields">

			<div style="height: 20px;"></div>

			<div class="form-group">
				<label for="gsProf"><?php _e('Profession', 'gscoach'); ?></label>
				<input type="text" id="gsProf" class="form-control" name="gs_prof" value="<?php echo isset($gs_prof) ? esc_attr($gs_prof) : ''; ?>">
			</div>

			<div class="gs-coach-pro-field">

			<div class="form-group">
					<label for="gsCoachExperience"><?php _e('Experience', 'gscoach'); ?></label>
					<input type="text" id="gsCoachExperience" class="form-control" name="gs_coach_experience" placeholder="Experience" value="<?php echo isset($gs_coach_experience) ? esc_attr($gs_coach_experience) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachEducation"><?php _e('Education', 'gscoach'); ?></label>
					<input type="text" id="gsCoachEducation" class="form-control" name="gs_coach_education" placeholder="Education" value="<?php echo isset($gs_coach_education) ? esc_attr($gs_coach_education) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachAddress"><?php _e('Address', 'gscoach'); ?></label>
					<input type="text" id="gsCoachAddress" class="form-control" name="gs_coach_address" placeholder="Address" value="<?php echo isset($gs_coach_address) ? esc_attr($gs_coach_address) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachState"><?php _e('State/City', 'gscoach'); ?></label>
					<input type="text" id="gsCoachState" class="form-control" name="gs_coach_state" placeholder="State/City" value="<?php echo isset($gs_coach_state) ? esc_attr($gs_coach_state) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachCountry"><?php _e('Country', 'gscoach'); ?></label>
					<input type="text" id="gsCoachCountry" class="form-control" name="gs_coach_country" placeholder="Country" value="<?php echo isset($gs_coach_country) ? esc_attr($gs_coach_country) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachContactNumber"><?php _e('Contact Number', 'gscoach'); ?></label>
					<input type="text" id="gsCoachContactNumber" class="form-control" name="gs_coach_contact_number" placeholder="Contact Number" value="<?php echo isset($gs_coach_contact_number) ? esc_attr($gs_coach_contact_number) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachEmail"><?php _e('Email Address', 'gscoach'); ?></label>
					<input type="email" id="gsCoachEmail" class="form-control" name="gs_coach_email" placeholder="Email Address" value="<?php echo isset($gs_coach_email) ? esc_attr($gs_coach_email) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachSchedule"><?php _e('Schedule Time', 'gscoach'); ?></label>
					<input type="time" id="gsCoachSchedule" class="form-control" name="gs_coach_schedule" placeholder="Schedule Time" value="<?php echo isset($gs_coach_schedule) ? esc_attr($gs_coach_schedule) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachAvailable"><?php _e('Availablity', 'gscoach'); ?></label>
					<input type="date" id="gsCoachAvailable" class="form-control" name="gs_coach_available" placeholder="Available" value="<?php echo isset($gs_coach_available) ? esc_attr($gs_coach_available) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachPersonalSite"><?php _e('Personal Site', 'gscoach'); ?></label>
					<input type="url" id="gsCoachPersonalSite" class="form-control" name="gs_coach_psite" placeholder="Personal Site" value="<?php echo isset($gs_coach_psite) ? esc_attr($gs_coach_psite) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachCourseLink"><?php _e('Course Link', 'gscoach'); ?></label>
					<input type="url" id="gsCoachCourseLink" class="form-control" name="gs_coach_courselink" placeholder="Course Link" value="<?php echo isset($gs_coach_courselink) ? esc_attr($gs_coach_courselink) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachFee"><?php _e('Fee', 'gscoach'); ?></label>
					<input type="text" id="gsCoachFee" class="form-control" name="gs_coach_fee" placeholder="Fee" value="<?php echo isset($gs_coach_fee) ? esc_attr($gs_coach_fee) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachReview"><?php _e('Review', 'gscoach'); ?></label>
					<input type="text" id="gsCoachReview" class="form-control" name="gs_coach_review" placeholder="Review" value="<?php echo isset($gs_coach_review) ? esc_attr($gs_coach_review) : ''; ?>">
				</div>

				<div>
					<p><label for="gsCoachRating"><b><?php _e('Rating:', 'gscoach'); ?></b></label></p>
					<p>
						<input name="gs_coach_rating" type="range" value="<?php echo esc_attr($gs_coach_rating); ?>" step="0.25" id="gsCoachRating" style="display:none" />
						<div class="rateit bigstars" data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-backingfld="#gsCoachRating" data-rateit-resetable="false" data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5"></div>
					</p>
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

				<div class="member-details-section">

					<table id="repeatable-fieldset-two" width="100%" class="gstm-sorable-table">
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
											<?php select_builder('gstm-team-icon[]', $social_icons, $field['icon'], __('Select icon', 'gscoach'), 'widefat gstm-icon-select'); ?>
										</td>
										<td><input type="text" placeholder="<?php _e('ex: https://twitter.com/gsplugins', 'gscoach'); ?>" class="widefat" name="gstm-team-link[]" value="<?php if (isset($field['link'])) echo esc_attr($field['link']); ?>" /></td>
										<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
									</tr>

								<?php endforeach;
							else : ?>

								<tr>
									<td><i class="fas fa-arrows-alt" aria-hidden="true"></i></td>
									<td>
										<?php select_builder('gstm-team-icon[]', $social_icons, '', __('Select icon', 'gscoach'), 'widefat gstm-icon-select'); ?>
									</td>
									<td><input type="text" placeholder="<?php _e('ex: https://twitter.com/gsplugins', 'gscoach'); ?>" class="widefat" name="gstm-team-link[]" value="" /></td>
									<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
								</tr>

							<?php endif; ?>

							<tr class="empty-row screen-reader-text">
								<td><i class="fas fa-arrows-alt" aria-hidden="true"></i></td>
								<td>
									<?php select_builder('gstm-team-icon[]', $social_icons, '', __('Select icon', 'gscoach'), 'widefat'); ?>
								</td>
								<td><input type="text" placeholder="<?php _e('ex: https://twitter.com/gsplugins', 'gscoach'); ?>" class="widefat" name="gstm-team-link[]" value="" /></td>
								<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
							</tr>

						</tbody>
					</table>

					<p><a class="button gstm-add-row" href="#" data-table="repeatable-fieldset-two"><?php _e('Add Row', 'gscoach'); ?></a></p>

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

				<div class="member-details-section">
					<table id="repeatable-fieldset-skill" width="100%" class="gstm-sorable-table">
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
											<input type="text" placeholder="html" class="widefat" name="gstm-skill-name[]" value="<?php if (isset($field['skill'])) echo esc_attr($field['skill']); ?>" />
										</td>
										<td><input type="text" placeholder="85" class="widefat" name="gstm-skill-percent[]" value="<?php if (isset($field['percent'])) echo esc_attr($field['percent']); ?>" /></td>
										<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
									</tr>

								<?php endforeach;
							else : ?>

								<tr>
									<td><i class="fas fa-arrows-alt" aria-hidden="true"></i></td>
									<td>
										<input type="text" placeholder="html" class="widefat" name="gstm-skill-name[]" value="<?php if (isset($field['skill'])) echo esc_attr($field['skill']); ?>" />
									</td>
									<td><input type="text" placeholder="85" class="widefat" name="gstm-skill-percent[]" value="<?php if (isset($field['percent'])) echo esc_attr($field['percent']); ?>" /></td>
									<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
								</tr>

							<?php endif; ?>

							<tr class="empty-skill screen-reader-text">
								<td><i class="fas fa-arrows-alt" aria-hidden="true"></i></td>
								<td>
									<input type="text" placeholder="<?php _e('ex: Wordpress', 'gscoach'); ?>" class="widefat" name="gstm-skill-name[]" value="<?php if (isset($field['link'])) echo esc_attr($field['link']); ?>" />
								</td>
								<td><input type="text" placeholder="<?php _e('ex: 90', 'gscoach'); ?>" class="widefat" name="gstm-skill-percent[]" value="" /></td>
								<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
							</tr>

						</tbody>
					</table>

					<p><a class="button gstm-add-skill" href="#" data-table="repeatable-fieldset-skill"><?php _e('Add Row', 'gscoach'); ?></a></p>

				</div>

			</div>


		</div>

<?php
	}


	function save_gs_coach_metadata($post_id) {

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

		if (!empty($social_icons = $_POST['gstm-team-icon']) && !empty($social_links = $_POST['gstm-team-link'])) {

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

			if (!empty($member_skill = $_POST['gstm-skill-name']) && !empty($members_percent = $_POST['gstm-skill-percent'])) {

				$member_skill = array_map('sanitize_text_field', $member_skill);
				$members_percent = array_map('absint', $members_percent);

				$newdata = array_map(function ($skill, $percent) {
					if (!empty($skill) && !empty($percent)) return ['skill' => $skill, 'percent' => $percent];
				}, $member_skill, $members_percent);

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
			update_post_meta($post_id, '_gs_coach_country', sanitize_text_field($_POST['gs_coach_country']));
			update_post_meta($post_id, '_gscoach_contact', sanitize_text_field($_POST['gs_coach_contact_number']));
			update_post_meta($post_id, '_gscoach_email', sanitize_text_field($_POST['gs_coach_email']));
			update_post_meta($post_id, '_gscoach_shedule', sanitize_text_field($_POST['gs_coach_schedule']));
			update_post_meta($post_id, '_gscoach_available', sanitize_text_field($_POST['gs_coach_available']));
			update_post_meta($post_id, '_gscoach_psite', sanitize_text_field($_POST['gs_coach_psite']));
			update_post_meta($post_id, '_gscoach_courselink', sanitize_text_field($_POST['gs_coach_courselink']));
			update_post_meta($post_id, '_gscoach_fee', sanitize_text_field($_POST['gs_coach_fee']));
			update_post_meta($post_id, '_gscoach_review', sanitize_text_field($_POST['gs_coach_review']));
			update_post_meta($post_id, '_gscoach_rating', sanitize_text_field($_POST['gs_coach_rating']));
		}
	}
}
