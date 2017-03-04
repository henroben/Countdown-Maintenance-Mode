jQuery(document).ready(function($) {

    // check which background effect is selected and show relevant options
    switch($('.background-effect-select').val()) {
        case 'None':
            $('#background-effect-description').text('Select a background effect');
            $('.background-blur').hide();
            $('.background-halftone').hide();
            break;
        case 'Interactive Background Image':
            $('#background-effect-description').text('Animates on mouse movement or mobile device movement.');
            $('.background-blur').hide();
            $('.background-halftone').hide();
            break;
        case 'Blur Background Image':
            $('#background-effect-description').text('Blurs the current background image. Suitable for any image.');
            $('.background-blur').show();
            $('.background-halftone').hide();
            break;
        case 'Halftone Background Image':
            $('#background-effect-description').text('Creates halftone version of current background image, animates on mouse movement. Suits a simple high contrast, low resolution image best.');
            $('.background-blur').hide();
            $('.background-halftone').show();
            break;
    }

    // enable color picker
     $('.text-color').wpColorPicker();
     $('.info-background-color').wpColorPicker();
     $('.countdown-background-color').wpColorPicker();

    // enable date picker
    $( ".date-picker" ).datetimepicker({
        dateFormat: "yy-mm-dd",
        separator: "T"
    });

    // change background effect description on selection
    $('.background-effect-select').change(function() {
        var selected = $(this).val();

        switch(selected) {
            case 'None':
                $('#background-effect-description').text('Select a background effect');
                $('.background-blur').slideUp();
                $('.background-halftone').slideUp();
                break;
            case 'Interactive Background Image':
                $('#background-effect-description').text('Animates on mouse movement or mobile device movement.');
                $('.background-blur').slideUp();
                $('.background-halftone').slideUp();
                break;
            case 'Blur Background Image':
                $('#background-effect-description').text('Blurs the current background image. Suitable for any image.');
                $('.background-halftone').slideUp();
                $('.background-blur').slideDown();
                break;
            case 'Halftone Background Image':
                $('#background-effect-description').text('Creates halftone version of current background image, animates on mouse movement. Suits a simple high contrast, low resolution image best.');
                $('.background-blur').slideUp();
                $('.background-halftone').slideDown();
                break;
        }
    });

    // upload script to grab url of image upload from media uploader
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