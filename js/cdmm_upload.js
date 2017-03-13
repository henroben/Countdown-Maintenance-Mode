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

    // use new media uploader to upload logo & background image
    var logo_uploader;
    $('#upload_logo').click(function(e) {

        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (logo_uploader) {
            logo_uploader.open();
            return;
        }

        //Extend the wp.media object
        logo_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Logo',
            button: {
                text: 'Choose Logo'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        logo_uploader.on('select', function() {
            attachment = logo_uploader.state().get('selection').first().toJSON();
            $('.logo_image_url').val(attachment.url);
            $('#upload_logo_preview img').attr('src',attachment.url);
        });

        //Open the uploader dialog
        logo_uploader.open();

    });
    // load background image
    var background_uploader;
    $('#upload_background').click(function(e) {

        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (background_uploader) {
            background_uploader.open();
            return;
        }

        //Extend the wp.media object
        background_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Background Image',
            button: {
                text: 'Set Background Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        background_uploader.on('select', function() {
            attachment = background_uploader.state().get('selection').first().toJSON();
            $('.background_image_url').val(attachment.url);
            $('#upload_background_preview img').attr('src',attachment.url);
        });

        //Open the uploader dialog
        background_uploader.open();

    });

});