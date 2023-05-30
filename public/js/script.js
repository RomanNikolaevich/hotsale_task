$(document).ready(function () {
    $('#registration-form').submit(function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            success: function (response) {
                var $response = $(response);

                if ($response.filter('#success-message').length) {
                    $('#registration-form').hide();
                    $('#success-message').html($response).show();
                } else if ($response.filter('#registration-error-message').length) {
                    $('#registration-error-message').html($response).show();
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});
