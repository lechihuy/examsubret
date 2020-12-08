require('./components/_form')

// Update profile
$('.btn-update-profile').on('click', function() {
    const indexBtn = $('.btn-update-profile').index($(this));
    let form = new Form('#form-update-profile');
    let formData = form.getData();

    form.hideAlert();

    $.ajax({
        url: form.getAction(),
        method: 'PUT',
        data: formData,
        success: function(res, textStatus, xhr) {
            form.showAlert(res.message, xhr.status, indexBtn);
            form.redirectToIfAvailable(res);
        }, error: function(err) {
            form.showAlert(err.responseJSON.message, err.status, indexBtn);
        }
    });
})