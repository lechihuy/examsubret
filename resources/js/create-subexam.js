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
            url: route('majors') + '?department_id=' + departmentId
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
            url: route('subjects') + '?department_id=' + departmentId
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

// Create a new submit exam request
$('.btn-create-subexam').on('click', function() {
    const indexBtn = $('.btn-create-subexam').index($(this));
    let form = new Form('#form-create-subexam');
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

setupDepartmentSelectors()
setupMajorSelectors()
setupSubjectSelectors()

// Handle to exam turn
if ($('input[type=radio][name=exam]:checked').val() == 'MT') {
    $('input[type=radio][name=exam_turn][value=2]').attr('disabled', true)
}

$('input[type=radio][name=exam]').on('change', function() {
    let exam = $(this).val()

    if (exam == 'MT') {
        $('input[type=radio][name=exam_turn][value=1]').prop('checked', true)
        $('input[type=radio][name=exam_turn][value=2]').attr('disabled', true)
    } else {
        $('input[type=radio][name=exam_turn][value=2]').removeAttr('disabled')
    }
})