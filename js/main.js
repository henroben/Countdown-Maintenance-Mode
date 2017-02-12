jQuery(document).ready(
    function($) {

        CountDownTimer(target_date, 'countdown');

        function CountDownTimer(dt, id)
        {
            var end = new Date(dt);

            var _second = 1000;
            var _minute = _second * 60;
            var _hour = _minute * 60;
            var _day = _hour * 24;
            var _week = _day * 7;
            var timer;

            function minTwoDigits(n) {
                return (n < 10 ? '0' : '') + n;
            }

            function showRemaining() {
                var now = new Date();
                var distance = end - now;
                if (distance < 0) {

                    clearInterval(timer);
                    $(id).innerHTML = 'EXPIRED!';

                    return;
                }
                var weeks = Math.floor(distance / _week);
                var days = Math.floor((distance % _week) / _day);
                var hours = Math.floor((distance % _day) / _hour);
                var minutes = Math.floor((distance % _hour) / _minute);
                var seconds = Math.floor((distance % _minute) / _second);

                $('#weeks').text(minTwoDigits(weeks));
                $('#days').text(minTwoDigits(days));
                $('#hours').text(minTwoDigits(hours));
                $('#minutes').text(minTwoDigits(minutes));
                $('#seconds').text(minTwoDigits(seconds));
            }

            timer = setInterval(showRemaining, 1000);
        }

        $('#maintenance-form').submit(
            function (e) {
                e.preventDefault();

                // Serialize Form
                var subscriberData = $('#maintenance-form').serialize();

                // Submit Form using Ajax
                $.ajax({
                    type: 'post',
                    url: $('#maintenance-form').attr('action'),
                    data: subscriberData
                }).done(function(response) {
                    // if success
                    $('#form-msg').removeClass('error');
                    $('#form-msg').addClass('success');
                    // set message text
                    $('#form-msg').text(response);
                    // clear fields
                    $('#email').val('');

                }).fail(function(data) {

                    // if error
                    $('#form-msg').removeClass('success');
                    $('#form-msg').addClass('error');

                    if(data.responseText !== '') {
                        // set message text
                        $('#form-msg').text(data.responseText);
                    } else {
                        // set message text
                        $('#form-msg').text('Message not sent');
                    }

                });
            }
        );
});