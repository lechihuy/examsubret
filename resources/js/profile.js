require('./components/_form')

// Update profile
$('.btn-update-profile').on('click', function() {
    const indexBtn = $('.btn-update-profile').index($(this));
    let form = new Form('#form-update-profile');

    let avatar = $('input[name=avatar]')[0].files[0];


    form.hideAlert();
    $('#form-update-profile').ajaxSubmit({
        url: form.getAction(),
        method: 'POST',
        contentType: false,
        processData: false,
        data: {
            _method: 'PUT',
        },
        success: function(res, textStatus, xhr) {
            form.showAlert(res.message, xhr.status, indexBtn);
            form.redirectToIfAvailable(res);
        }, error: function(err) {
            form.showAlert(err.responseJSON.message, err.status, indexBtn);
        }
    });

    // $.ajax({
    //     url: form.getAction(),
    //     method: 'PUT',
    //     data: {
    //         fullname: 1,
    //         'avatar': avatar
    //     },
    //     processData: false,
    //     success: function(res, textStatus, xhr) {
    //         form.showAlert(res.message, xhr.status, indexBtn);
    //         form.redirectToIfAvailable(res);
    //     }, error: function(err) {
    //         form.showAlert(err.responseJSON.message, err.status, indexBtn);
    //     }
    // });
})