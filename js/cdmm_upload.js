jQuery(document).ready(function($) {
    // enable color picker
     $('.text-color').wpColorPicker();
     $('.info-background-color').wpColorPicker();
     $('.countdown-background-color').wpColorPicker();

    // enable date picker
    $( ".date-picker" ).datetimepicker({
        dateFormat: "yy-mm-dd",
        separator: "T"
    });

    var imgType = '';
    $('#upload_logo').click(function() {
        console.warn('upload logo called');
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
        console.warn('src', $(html).attr('src'));
        console.warn('href', $(html).attr('href'));
        var image_url = $(html).attr('href');
        if(!image_url) {
            image_url = $(html).attr('src');
        }
        console.warn('send_to_editor called', image_url);
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