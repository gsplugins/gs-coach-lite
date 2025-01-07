jQuery(function($) {

	var isPro = gs_coach_fs.is_paying_or_trial;
	var nonce, action;
	
	if ( isPro ) {
		nonce = window._gscoach_sort_data.nonce;
		action = window._gscoach_sort_data.action;
		window._gscoach_sort_data = null;
	}

	var $resourceSort = $('#sortable-list');

	$resourceSort.sortable({
		update: function() {

			if ( ! isPro ) return;

			$('#loading-animation').show(); // Show the animate loading gif while waiting

			$.ajax({
				url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
				type: 'POST',
				async: true,
				cache: false,
				dataType: 'json',
				data: {
					_nonce: nonce,
					action: action,
					order: $resourceSort.sortable('toArray').toString() // Passes ID's of list items in	1,3,2 format
				},
				success: function() {
					setTimeout(function() {
						$('#loading-animation').hide();
					}, 200);
				},
				error: function() {
					alert('There was an error saving the updates');
					setTimeout(function() {
						$('#loading-animation').hide();
					}, 200);
				}
			});
		}
	});

});