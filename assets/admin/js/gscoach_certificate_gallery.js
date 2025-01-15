jQuery(document).ready(function($) {
	/* WP Media Uploader */

    $(document).on('click', '#manage_certificate', gscoach_upload_gallery_button);

    function gscoach_upload_gallery_button(e) {
        e.preventDefault();
        var $input_field = $('#gscoach_certif_gal_input');
        var ids = $input_field.val();
        var gallerysc = '[gallery ids="' + ids + '"]';
        wp.media.gallery.edit(gallerysc).on('update', function(g) {
            var id_array = [];
            var url_array = [];
            $.each(g.models, function(id, img){
                url_array.push(img.attributes.url);
                id_array.push(img.id);
            });
            var ids = id_array.join(",");
            ids = ids.replace(/,\s*$/, "");
            var urls = url_array.join(",");
            urls = urls.replace(/,\s*$/, "");
            $input_field.val(ids);
            var html = '';
            for(var i = 0 ; i < url_array.length; i++){
                html += '<div class="gallery-item"><img src="'+url_array[i]+'"></div>';
            }

            $('.gs_coach_gallery_certifs').html('').append(html);
        });

    }

    $(document).on('click', '#gscoach_empty_certif', gscoach_empty_gallery_button);

    function gscoach_empty_gallery_button(e){
        e.preventDefault();
        var $input_field = $('#gscoach_certif_gal_input');
        $input_field.val('');
        $('.gs_coach_gallery_certifs').html('');
    }
});