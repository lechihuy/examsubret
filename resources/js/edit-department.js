require('./components/_form')

// Create a new department
$('.btn-edit-department').on('click', function() {
    const indexBtn = $('.btn-edit-departmnet').index($(this));
    let form = new Form('#form-edit-department');
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