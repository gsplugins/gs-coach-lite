jQuery(document).ready(function($) {
    $('.gs-coach-upload-cv').click(function(e) {
        e.preventDefault();
        var button = $(this),
            file_frame = wp.media({
                title: 'Select or Upload CV',
                library: { type: ['application/pdf'] },
                button: { text: 'Use this CV' },
                multiple: false
            });

        file_frame.on('select', function() {
            var attachment = file_frame.state().get('selection').first().toJSON();

            // Make sure if the selected file is PDF
            if (attachment.mime !== 'application/pdf') {
                alert('Please select a PDF file.');
                return;
            }

            $('#gs_coach_cv').val(attachment.url);    
            $('.gs-coach-view-cv-link').show();
        });

        file_frame.open();
    });

    $('.gs-coach-remove-cv').click(function(e) {
        e.preventDefault();
        $('#gs_coach_cv').val('');
        $('.gs-coach-view-cv-link').hide();
    });
});