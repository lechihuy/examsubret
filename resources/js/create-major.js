require('./components/_form')

$('select[name=department_id]').select2();

// Create a new major
$('.btn-create-major').on('click', function() {
    const indexBtn = $('.btn-create-major').index($(this));
    let form = new Form('#form-create-major');
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