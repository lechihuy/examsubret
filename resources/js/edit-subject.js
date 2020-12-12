require('./components/_form')

$('select[mt=department_id]').select2({
    placeholder: 'Có thể chọn nhiều khoa'
});

// Edit subject
$('.btn-edit-subject').on('click', function() {
    const indexBtn = $('.btn-edit-subject').index($(this));
    let form = new Form('#form-edit-subject');
    let formData = form.getData();

    let departmentId = $('select[mt=department_id] option:selected').map(function(key, item) {
        return $(item).val()
    }).get().join()

    formData.push({
        name: 'department_id',
        value: departmentId,
    })

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