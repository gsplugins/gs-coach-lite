jQuery(function($) {

    /*
     * Select/Upload image(s) event
     */
    $('body').on('click', '.gs_upload_image_button', function(e){
        e.preventDefault();
 
        var button = $(this),
            custom_uploader = wp.media({
            title: 'Insert image',
            library : {
                // uncomment the next line if you want to attach image to the current post
                // uploadedTo : wp.media.view.settings.post.id, 
                type : 'image'
            },
            button: {
                text: 'Use this image' // button label text
            },
            multiple: false // for multiple image selection set to true
        }).on('select', function() { // it also has "open" and "close" events 
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" />').next().val(attachment.id).next().show();
            /* if you sen multiple to true, here is some code for getting the image IDs
            var attachments = frame.state().get('selection'),
                attachment_ids = new Array(),
                i = 0;
            attachments.each(function(attachment) {
                attachment_ids[i] = attachment['id'];
                console.log( attachment );
                i++;
            });
            */
        })
        .open();
    });
 
    /*
     * Remove image event
     */
    $('body').on('click', '.gs_remove_image_button', function(){
        $(this).hide().prev().val('').prev().addClass('button').html('Upload image');
        return false;
    });


    $('.gstm-icon-select').select2({
        width: "100%",
        templateResult: gstm_formaticon,
        templateSelection: gstm_formaticon
    });

    $('.gstm-add-row').on('click', function(e) {
        e.preventDefault();
        var table = $(this).data('table'),
            row = $('#' + table + ' .empty-row.screen-reader-text').clone(true);
        row.removeClass('empty-row screen-reader-text');
        row.insertBefore('#' + table + ' tbody>tr:last');
        row.find('select').select2({
            width: "100%",
            templateResult: gstm_formaticon,
            templateSelection: gstm_formaticon
        });
        return false;
    });

    $('.gstm-add-skill').on('click', function(e) {
        e.preventDefault();
        var skill = $(this).data('table'),
            row = $('#' + skill + ' .empty-skill.screen-reader-text').clone(true);
        row.removeClass('empty-skill screen-reader-text');
        row.insertBefore('#' + skill + ' tbody>tr:last');
        row.find('select').select2({
            width: "100%",
            templateResult: gstm_formaticon,
            templateSelection: gstm_formaticon
        });
        return false;
    });

    // remove
    $('.remove-row').on('click', function() {
        $(this).parents('tr').remove();
        return false;
    });
    
    $('.gstm-sorable-table tbody').sortable({
        items: "tr",
        axis: "y",
        cursor: 'move',
    });
   
    function gstm_formaticon(icon) {
        if (!icon.id) {
            return icon.text; }
        var $icon = $(
            '<span><i class="' + icon.text.toLowerCase() + '"></i>  ' + icon.text.replace(/fa-|fab|fas|far/g, '').trim().replaceAll('-', ' ') + '</span>'
        );
        return $icon;
    }

    if ( ! gs_team_fs.is_paying_or_trial ) {

        $('.gs-team-pro-field').addClass('gs-team-fields-disable').append('<div class="gs-team-pro-field--inner"><div class="gs-team-pro-field--content"><a href="https://www.gsplugins.com/product/gs-team-members/#pricing">Upgrade to PRO</a></div></div>');

    }

});