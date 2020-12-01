require('./components/_form')

// Create a new submit exam request
$('.btn-create-subexam').on('click', function() {
    const indexBtn = $('.btn-create-subexam').index($(this));
    let form = new Form('#form-create-subexam');
    let formData = form.getData();

    let job = {};
    let optionJob = $('.select-box[name=job] .option.active')
    
    if (optionJob.length) {
        job = {
            'department_id': optionJob.find('department').html(),
            'major_id': optionJob.find('major').html(),
            'subject_id': optionJob.find('subject').html(),
        };
    }

    formData.push({
        name: 'department_id',
        value: job.department_id,
    })

    formData.push({
        name: 'major_id',
        value: job.major_id,
    })

    formData.push({
        name: 'subject_id',
        value: job.subject_id,
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