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
		// add_meta_box('gsTeamSectionSocial', 'Member\'s Social Links', [ $this, 'cmb_social_cb' ], 'gs_team', 'normal', 'high');
		// add_meta_box('gsTeamSectionSkill', 'Member\'s Skills', [ $this, 'cmb_skill_cb' ], 'gs_team', 'normal', 'high');
	}

    function cmb_cb($post) {

		// Add a nonce field so we can check for it later.
		wp_nonce_field('gs_coach_nonce_name', 'gs_coach_cmb_token');

		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$gs_profession       = get_post_meta($post->ID, '_gs_profession', true);
		$gs_linkedin         = get_post_meta($post->ID, '_gs_linkedin', true);
		$gs_twitter          = get_post_meta($post->ID, '_gs_twitter', true);
		$gs_facebook         = get_post_meta($post->ID, '_gs_facebook', true);
		$gs_google_plus 	 = get_post_meta($post->ID, '_gs_google_plus', true);
		$gs_youtube          = get_post_meta($post->ID, '_gs_youtube', true);
		$gs_personal_site    = get_post_meta($post->ID, '_gs_personal_site', true);


		?>

		<div class="gs_coach-metafields">

			<div style="height: 20px;"></div>

			<div class="form-group">
				<label for="gsProfession"><?php _e('Profession', 'gscoach'); ?></label>
				<input type="text" id="gsProfession" class="form-control" name="gs_profession" value="<?php echo isset($gs_profession) ? esc_attr($gs_profession) : ''; ?>">
			</div>

			<div class="gs-coach-pro-field">

				<div class="form-group">
					<label for="gsLinkedin"><?php _e('Linkedin', 'gscoach'); ?></label>
					<input type="text" id="gsLinkedin" class="form-control" name="gs_linkedin" value="<?php echo isset($gs_linkedin) ? esc_attr($gs_linkedin) : ''; ?>">
				</div>
				
				<div class="form-group">
					<label for="gsTwitter"><?php _e('Twitter', 'gscoach'); ?></label>
					<input type="text" id="gsTwitter" class="form-control" name="gs_twitter" value="<?php echo isset($gs_twitter) ? esc_attr($gs_twitter) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsFacebook"><?php _e('Facebook', 'gscoach'); ?></label>
					<input type="text" id="gsFacebook" class="form-control" name="gs_facebook" value="<?php echo isset($gs_facebook) ? esc_attr($gs_facebook) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsGooglePlus"><?php _e('Google+', 'gscoach'); ?></label>
					<input type="text" id="gsGooglePlus" class="form-control" name="gs_google_plus" value="<?php echo isset($gs_google_plus) ? esc_attr($gs_google_plus) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsYoutube"><?php _e('Youtube', 'gscoach'); ?></label>
					<input type="text" id="gsYoutube" class="form-control" name="gs_youtube" value="<?php echo isset($gs_youtube) ? esc_attr($gs_youtube) : ''; ?>">
				</div>

				<div class="form-group">
					<label for="gsPersonalSite"><?php _e('Personal Site', 'gscoach'); ?></label>
					<input type="text" id="gsPersonalSite" class="form-control" name="gs_personal_site" value="<?php echo isset($gs_personal_site) ? esc_attr($gs_personal_site) : ''; ?>">
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
		if (!isset($_POST['gs_profession'])) {
			return;
		}

		// Sanitize user input.
		$gs_profession_data = sanitize_text_field($_POST['gs_profession']);
		update_post_meta($post_id, '_gs_profession', $gs_profession_data);

		// if (gtm_fs()->is_paying_or_trial()) {

			update_post_meta($post_id, '_gs_linkedin', sanitize_text_field($_POST['gs_linkedin']));
			update_post_meta($post_id, '_gs_twitter', sanitize_text_field($_POST['gs_twitter']));
			update_post_meta($post_id, '_gs_facebook', sanitize_text_field($_POST['gs_facebook']));
			update_post_meta($post_id, '_gs_google_plus', sanitize_text_field($_POST['gs_google_plus']));
			update_post_meta($post_id, '_gs_youtube', sanitize_text_field($_POST['gs_youtube']));
			update_post_meta($post_id, '_gs_personal_site', sanitize_text_field($_POST['gs_personal_site']));

		// }
	}
}