require('./components/_form')

$('select[mt=department_id]').select2({
    placeholder: 'Có thể chọn nhiều khoa'
});

// Create a new subject
$('.btn-create-subject').on('click', function() {
    const indexBtn = $('.btn-create-subject').index($(this));
    let form = new Form('#form-create-subject');
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