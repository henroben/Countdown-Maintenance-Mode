jQuery(document).ready(function($) {
    $('#upload_background').click(function() {
        tb_show('Upload a background image', 'media-upload.php?referer=cdmm_settings&type=image&TB_iframe=true&post_id=0', false);
        return false;
    });
    window.send_to_editor = function(html) {

        var image_url = $(html).attr('src');
        console.log('image url', image_url);
        $('.background_image_url').val(image_url);
        tb_remove();
        $('#upload_background_preview img').attr('src',image_url);
    }
});