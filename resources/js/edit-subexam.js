require('./components/_form')

function setupDepartmentSelectors() {
    $('select[name=department_id]').select2();
}

function setupMajorSelectors(department = null) {

    $('select[name=major_id]').select2({
        "language": {
            "noResults": function(){
                return 'Không tìm thấy kết quả.';
            }
        },
        placeholder: '-- Chọn khoa trước --',
    })

    if (department) {

        let departmentId = department.val()

        let major = department.parents('form').find('select[name=major_id]')
        major.find('option').remove()
        major.val('')
        major.trigger('change');

        $.ajax({
            type: 'GET',
            url: route('data.majors') + '?department_id=' + departmentId
        }).then(function (data) {
            data.forEach(function(item, index) {
                major.append(new Option(`[${item.code}] ${item.name}`, item.id, true, true))
            })

            major.trigger('change')
        });
    }
}

function setupSubjectSelectors(department = null) {
    $('select[name=subject_id]').select2({
        "language": {
            "noResults": function(){
                return 'Không tìm thấy kết quả.';
            }
        },
        placeholder: '-- Chọn khoa trước --',
    })

    if (department) {
        let departmentId = department.val()

        let subject = department.parents('form').find('select[name=subject_id]')
        subject.find('option').remove()
        subject.val('')
        subject.trigger('change');

        $.ajax({
            type: 'GET',
            url: route('data.subjects') + '?department_id=' + departmentId
        }).then(function (data) {
            data.forEach(function(item, index) {
                subject.append(new Option(`[${item.code}] ${item.name}`, item.id, true, true))
            })

            subject.trigger('change')
        });
    }
}

$(document).on('select2:select', 'select[name=department_id]', function() {
    setupMajorSelectors($(this))
    setupSubjectSelectors($(this))
})

// Edit a submit exam request
$('.btn-edit-subexam').on('click', function() {
    const indexBtn = $('.btn-edit-subexam').index($(this));
    let form = new Form('#form-edit-subexam');
    let formData = form.getData();
    let forms = [];

    $('#form-edit-subexam').find('input[type=checkbox][name=forms]:checked').each(function() {
        forms.push($(this).val());
    });

    formData.push({
        name: 'forms',
        value: JSON.stringify(forms),
    });

    formData.push({
        name: 'times_1',
        value: JSON.stringify({
            origin_exam_qty: $('#form-edit-subexam').find('input[name=times_1_origin_exam_qty]').val(),
            exam_code_qty: $('#form-edit-subexam').find('input[name=times_1_exam_code_qty]').val(),
        })
    });

    formData.push({
        name: 'times_2',
        value: JSON.stringify({
            origin_exam_qty: $('#form-edit-subexam').find('input[name=times_2_origin_exam_qty]').val(),
            exam_code_qty: $('#form-edit-subexam').find('input[name=times_2_exam_code_qty]').val(),
        })
    });

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

setupDepartmentSelectors()
setupMajorSelectors()
setupSubjectSelectors()

// Handle to exam times
$('input[type=radio][name=exam]').on('change', function() {
    let exam = $(this).val()

    if (exam == 'MT') {
        $('.times-2').addClass('d-none')
    } else {
        $('.times-2').removeClass('d-none')        
    }
})