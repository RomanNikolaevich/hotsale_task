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

                if ($response.find('#success-message').length) {
                    $('#registration-form').hide();
                    $('#success-message-container').html($response.find('#success-message').html()).show();
                } else if ($response.find('#registration-error-container').length) {
                    $('#registration-error-container').html($response.find('#registration-error-container').html()).show();
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
