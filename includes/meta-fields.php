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
		add_meta_box('gsCoachSectionSocial', 'Member\'s Social Links', [ $this, 'cmb_social_cb' ], 'gs_coach', 'normal', 'high');
		// add_meta_box('gsCoachSectionSkill', 'Member\'s Skills', [ $this, 'cmb_skill_cb' ], 'gs_coach', 'normal', 'high');
	}

    function cmb_cb($post) {

		// Add a nonce field so we can check for it later.
		wp_nonce_field('gs_coach_nonce_name', 'gs_coach_cmb_token');

		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$gs_coach_profession       = get_post_meta($post->ID, '_gs_coach_profession', true);
		$gs_coach_experience       = get_post_meta($post->ID, '_gs_coach_experience', true);
		$gs_coach_education        = get_post_meta($post->ID, '_gs_coach_education', true);
		$gs_coach_skills           = get_post_meta($post->ID, '_gs_coach_skills', true);
		$gs_coach_address          = get_post_meta($post->ID, '_gs_coach_address', true);
		$gs_coach_state            = get_post_meta($post->ID, '_gs_coach_state', true);
		$gs_coach_country          = get_post_meta($post->ID, '_gs_coach_country', true);
		$gs_coach_contact_number   = get_post_meta($post->ID, '_gs_coach_contact_number', true);
		$gs_coach_schedule         = get_post_meta($post->ID, '_gs_coach_schedule', true);
		$gs_coach_available        = get_post_meta($post->ID, '_gs_coach_available', true);
		$gs_coach_fee              = get_post_meta($post->ID, '_gs_coach_fee', true);
		$gs_coach_review           = get_post_meta($post->ID, '_gs_coach_review', true);
		$gs_coach_students_rating  = get_post_meta($post->ID, '_gs_coach_students_rating', true);


		?>

		<div class="gs_coach-metafields">

			<div style="height: 20px;"></div>

			<div class="form-group">
				<label for="gsCoachProfession"><?php _e('Profession', 'gscoach'); ?></label>
				<input type="text" id="gsCoachProfession" class="form-control" name="gs_coach_profession" placeholder="Your Profession" value="<?php echo isset($gs_coach_profession) ? esc_attr($gs_coach_profession) : ''; ?>">
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
					<label for="gsCoachSkills"><?php _e('Skills', 'gscoach'); ?></label>
					<input type="text" id="gsCoachSkills" class="form-control" name="gs_coach_skills" placeholder="Skills" value="<?php echo isset($gs_coach_skills) ? esc_attr($gs_coach_skills) : ''; ?>">
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
					<label for="gsCoachSchedule"><?php _e('Schedule Time', 'gscoach'); ?></label>
					<input type="text" id="gsCoachSchedule" class="form-control" name="gs_coach_schedule" placeholder="Schedule Time" value="<?php echo isset($gs_coach_schedule) ? esc_attr($gs_coach_schedule) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachAvailable"><?php _e('Available', 'gscoach'); ?></label>
					<input type="text" id="gsCoachAvailable" class="form-control" name="gs_coach_available" placeholder="Available" value="<?php echo isset($gs_coach_available) ? esc_attr($gs_coach_available) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachFee"><?php _e('Fee', 'gscoach'); ?></label>
					<input type="text" id="gsCoachFee" class="form-control" name="gs_coach_fee" placeholder="Fee" value="<?php echo isset($gs_coach_fee) ? esc_attr($gs_coach_fee) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachReview"><?php _e('Review', 'gscoach'); ?></label>
					<input type="text" id="gsCoachReview" class="form-control" name="gs_coach_review" placeholder="Review" value="<?php echo isset($gs_coach_review) ? esc_attr($gs_coach_review) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsCoachStudentsRating"><?php _e('Students Rating', 'gscoach'); ?></label>
					<input type="text" id="gsCoachStudentsRating" class="form-control" name="gs_coach_students_rating" placeholder="Students Rating" value="<?php echo isset($gs_coach_students_rating) ? esc_attr($gs_coach_students_rating) : ''; ?>">
				</div>

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
		$gs_social = get_post_meta( $post->ID, 'gs_coach_social', true );
		
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

							<?php if ($gs_social) : foreach ($gs_social as $field) : ?>

									<tr>
										<td><i class="fas fa-arrows-alt" aria-hidden="true"></i></td>
										<td>
											<?php select_builder('gstm-coach-icon[]', $social_icons, $field['icon'], __('Select icon', 'gscoach'), 'widefat gstm-icon-select'); ?>
										</td>
										<td><input type="text" placeholder="<?php _e('ex: https://twitter.com/gsplugins', 'gscoach'); ?>" class="widefat" name="gstm-coach-link[]" value="<?php if (isset($field['link'])) echo esc_attr($field['link']); ?>" /></td>
										<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
									</tr>

								<?php endforeach;
							else : ?>

								<tr>
									<td><i class="fas fa-arrows-alt" aria-hidden="true"></i></td>
									<td>
										<?php select_builder('gstm-coach-icon[]', $social_icons, '', __('Select icon', 'gscoach'), 'widefat gstm-icon-select'); ?>
									</td>
									<td><input type="text" placeholder="<?php _e('ex: https://twitter.com/gsplugins', 'gscoach'); ?>" class="widefat" name="gstm-coach-link[]" value="" /></td>
									<td><a class="button remove-row" href="#"><?php _e('Remove', 'gscoach'); ?></a></td>
								</tr>

							<?php endif; ?>

							<tr class="empty-row screen-reader-text">
								<td><i class="fas fa-arrows-alt" aria-hidden="true"></i></td>
								<td>
									<?php select_builder('gstm-coach-icon[]', $social_icons, '', __('Select icon', 'gscoach'), 'widefat'); ?>
								</td>
								<td><input type="text" placeholder="<?php _e('ex: https://twitter.com/gsplugins', 'gscoach'); ?>" class="widefat" name="gstm-coach-link[]" value="" /></td>
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

		if (!empty($social_icons = $_POST['gstm-coach-icon']) && !empty($social_links = $_POST['gstm-coach-link'])) {

			$social_icons = array_map('sanitize_text_field', $social_icons);
			$social_links = array_map('sanitize_text_field', $social_links);

			$newdata = array_map(function ($icon, $link) {
				if (!empty($icon) && !empty($link)) return ['icon' => $icon, 'link' => $link];
			}, $social_icons, $social_links);

			$meta_key = 'gs_coach_social';

			$newdata = array_values(array_filter($newdata));
			$olddata = get_post_meta($post_id, $meta_key, true);

			if (!empty($newdata) && $newdata != $olddata) {
				update_post_meta($post_id, $meta_key, $newdata);
			} elseif (empty($newdata) && $olddata) {
				delete_post_meta($post_id, $meta_key, $olddata);
			}
		}


		// if (gtm_fs()->is_paying_or_trial()) {

		// 	if (!empty($member_skill = $_POST['gstm-skill-name']) && !empty($members_percent = $_POST['gstm-skill-percent'])) {

		// 		$member_skill = array_map('sanitize_text_field', $member_skill);
		// 		$members_percent = array_map('absint', $members_percent);

		// 		$newdata = array_map(function ($skill, $percent) {
		// 			if (!empty($skill) && !empty($percent)) return ['skill' => $skill, 'percent' => $percent];
		// 		}, $member_skill, $members_percent);

		// 		$meta_key = 'gs_skill';

		// 		$newdata = array_values(array_filter($newdata));
		// 		$olddata = get_post_meta($post_id, $meta_key, true);

		// 		if (!empty($newdata) && $newdata != $olddata) {
		// 			update_post_meta($post_id, $meta_key, $newdata);
		// 		} elseif (empty($newdata) && $olddata) {
		// 			delete_post_meta($post_id, $meta_key, $olddata);
		// 		}
		// 	}
		// }

		/* OK, it's safe for us to save the data now. */

		// Make sure that it is set.
		if (!isset($_POST['gs_coach_profession'])) {
			return;
		}

		// Sanitize user input.
		$gs_coach_profession = sanitize_text_field($_POST['gs_coach_profession']);
		update_post_meta($post_id, '_gs_coach_profession', $gs_coach_profession);

		// if (gtm_fs()->is_paying_or_trial()) {

			update_post_meta($post_id, '_gs_coach_experience', sanitize_text_field($_POST['gs_coach_experience']));
			update_post_meta($post_id, '_gs_coach_education', sanitize_text_field($_POST['gs_coach_education']));
			update_post_meta($post_id, '_gs_coach_skills', sanitize_text_field($_POST['gs_coach_skills']));
			update_post_meta($post_id, '_gs_coach_address', sanitize_text_field($_POST['gs_coach_address']));
			update_post_meta($post_id, '_gs_coach_state', sanitize_text_field($_POST['gs_coach_state']));
			update_post_meta($post_id, '_gs_coach_country', sanitize_text_field($_POST['gs_coach_country']));
			update_post_meta($post_id, '_gs_coach_contact_number', sanitize_text_field($_POST['gs_coach_contact_number']));
			update_post_meta($post_id, '_gs_coach_schedule', sanitize_text_field($_POST['gs_coach_schedule']));
			update_post_meta($post_id, '_gs_coach_available', sanitize_text_field($_POST['gs_coach_available']));
			update_post_meta($post_id, '_gs_coach_fee', sanitize_text_field($_POST['gs_coach_fee']));
			update_post_meta($post_id, '_gs_coach_review', sanitize_text_field($_POST['gs_coach_review']));
			update_post_meta($post_id, '_gs_coach_students_rating', sanitize_text_field($_POST['gs_coach_students_rating']));

		// }
	}
}