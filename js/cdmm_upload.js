jQuery(document).ready(function($) {
    // enable color picker
     $('.text-color').wpColorPicker();
     $('.info-background-color').wpColorPicker();
     $('.countdown-background-color').wpColorPicker();

    var imgType = '';
    $('#upload_logo').click(function() {
        imgType = 'logo';
        tb_show('Upload a logo image', 'media-upload.php?referer=cdmm_settings&type=image&TB_iframe=true&post_id=0', false);
        return false;
    });
    $('#upload_background').click(function() {
        imgType = 'background';
        tb_show('Upload a background image', 'media-upload.php?referer=cdmm_settings&type=image&TB_iframe=true&post_id=0', false);
        return false;
    });
    window.send_to_editor = function(html) {

        var image_url = $(html).attr('src');
        if(imgType == 'logo') {
            $('.logo_image_url').val(image_url);
            tb_remove();
            $('#upload_logo_preview img').attr('src',image_url);
        } else if(imgType == 'background') {
            $('.background_image_url').val(image_url);
            tb_remove();
            $('#upload_background_preview img').attr('src',image_url);
        }

    };
});