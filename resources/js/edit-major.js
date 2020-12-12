require('./components/_form')

$('select[name=department_id]').select2();

// Edit major
$('.btn-edit-major').on('click', function() {
    const indexBtn = $('.btn-edit-major').index($(this));
    let form = new Form('#form-edit-major');
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