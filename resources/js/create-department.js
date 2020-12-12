require('./components/_form')

// Create a new department
$('.btn-create-department').on('click', function() {
    const indexBtn = $('.btn-create-departmnet').index($(this));
    let form = new Form('#form-create-department');
    let formData = form.getData();

    form.hideAlert();

    $.ajax({
        url: form.getAction(),
        method: 'POST',
        data: formData,
        success: function(res, textStatus, xhr) {
            form.showAlert(res.message, xhr.status, indexBtn);
            form.redirectToIfAvailable(res);
        }, error: function(err) {
            form.showAlert(err.responseJSON.message, err.status, indexBtn);
        }
    });
})