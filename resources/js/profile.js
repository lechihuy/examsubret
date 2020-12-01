require('./components/_form')

// function setupDepartmentSelectors() {
//     $('select[name=department]').select2();
// }

// function setupMajorSelectors(department = null) {

//     $('select[name=major]').select2({
//         "language": {
//             "noResults": function(){
//                 return 'Không tìm thấy kết quả.';
//             }
//         },
//         placeholder: '-- Chọn khoa trước --',
//     })

//     if (department) {

//         let departmentId = department.val()

//         let major = department.parents('.modal').find('select[name=major]')
//         major.find('option').remove()
//         major.val('')
//         major.trigger('change');

//         $.ajax({
//             type: 'GET',
//             url: route('majors') + '?department_id=' + departmentId
//         }).then(function (data) {
//             data.forEach(function(item, index) {
//                 major.append(new Option(`[${item.code}] ${item.name}`, item.id, true, true))
//             })

//             major.trigger('change')
//         });
//     }
// }

// function setupSubjectSelectors(department = null) {
//     $('select[name=subject]').select2({
//         "language": {
//             "noResults": function(){
//                 return 'Không tìm thấy kết quả.';
//             }
//         },
//         placeholder: '-- Chọn khoa trước --',
//     })

//     if (department) {
//         let departmentId = department.val()

//         let subject = department.parents('.modal').find('select[name=subject]')
//         subject.find('option').remove()
//         subject.val('')
//         subject.trigger('change');

//         $.ajax({
//             type: 'GET',
//             url: route('subjects') + '?department_id=' + departmentId
//         }).then(function (data) {
//             data.forEach(function(item, index) {
//                 subject.append(new Option(`[${item.code}] ${item.name}`, item.id, true, true))
//             })

//             subject.trigger('change')
//         });
//     }
// }

// function clearJobModalForm() {
//     $('select[name=department], select[name=major], select[name=subject]').val('')
//     $('select[name=department], select[name=major], select[name=subject]').trigger('change');
// }

// $(document).on('select2:select', 'select[name=department]', function() {
//     setupMajorSelectors($(this))
//     setupSubjectSelectors($(this))
// })

// $(document).on('click', 'button[data-dismiss="modal"]', function() {
//     clearJobModalForm()
// })

// Open edit job
// $(document).on('click', '.btn-open-modal-edit-job', function() {
//     let item = $(this) 
//     let modal = $('#modal-edit-job')
//     let department = item.find('department').html()
//     let major = item.find('major').html()
//     let subject = item.find('subject').html()

//     modal.modal()

//     modal.find('select[name=department]').val(department)
//     modal.find('select[name=department]').trigger('change')

//     setupMajorSelectors(modal.find('select[name=department]'))
//     modal.find('select[name=major]').val(major)
//     modal.find('select[name=major]').trigger('change')

//     setupSubjectSelectors(modal.find('select[name=department]'))
//     modal.find('select[name=subject]').val(subject)
//     modal.find('select[name=subject]').trigger('change')

//     modal.attr('item-index', item.index())
// })

// Edit job
// $('#modal-edit-job .btn-confirm').on('click', function() {
//     let form = new Form('#modal-edit-job')
//     let modal = $(this).parents('.modal')
//     let action = modal.attr('action')
//     let list = $(modal.attr('list'))
//     let index = modal.attr('item-index')

//     let department = $('#modal-edit-job select[name=department]').val()
//     let major = $('#modal-edit-job select[name=major]').val()
//     let subject = $('#modal-edit-job select[name=subject]').val()

//     if (! department || ! major || ! subject) {
//         form.showAlert('Vui lòng nhập đầy đủ thông tin', 422);
//         return
//     }

//     form.hideAlert()

//     $.ajax({
//         url: action,
//         type: 'GET',
//         data: {
//             department_id: department,
//             major_id: major,
//             subject_id: subject
//         },
//         success: function(res) {
//             modal.modal('hide')

//             list.find(`.item:eq(${index})`).replaceWith(res)
            
//         }, error: function(err) {
//             modal.modal('hide')

//             al.show({
//                 'icon': 'fas fa-exclamation-circle text-danger',
//                 'title': 'Oops!',
//                 'message': 'Đã có lỗi xảy ra, vui lòng tải lại trang hoặc thực hiện lại.'
//             })
//         }
//     })

//     clearJobModalForm()
// })

// Add new job
// $('#modal-add-job .btn-confirm').on('click', function() {
//     let form = new Form('#modal-add-job')
//     let modal = $(this).parents('.modal')
//     let action = modal.attr('action')
//     let list = $(modal.attr('list'))

//     let department = $('#modal-add-job select[name=department]').val()
//     let major = $('#modal-add-job select[name=major]').val()
//     let subject = $('#modal-add-job select[name=subject]').val()

//     if (! department || ! major || ! subject) {
//         form.showAlert('Vui lòng nhập đầy đủ thông tin', 422);
//         return
//     }

//     form.hideAlert()

//     $.ajax({
//         url: action,
//         type: 'GET',
//         data: {
//             department_id: department,
//             major_id: major,
//             subject_id: subject
//         },
//         success: function(res) {
//             modal.modal('hide')

//             list.append(res)
            
//         }, error: function(err) {
//             modal.modal('hide')

//             al.show({
//                 'icon': 'fas fa-exclamation-circle text-danger',
//                 'title': 'Oops!',
//                 'message': 'Đã có lỗi xảy ra, vui lòng tải lại trang hoặc thực hiện lại.'
//             })
//         }
//     })

//     clearJobModalForm()
// })

// Delete job
// $('#modal-edit-job .btn-delete').on('click', function() {
//     let modal = $(this).parents('.modal')
//     let list = $(modal.attr('list'))
//     let index = modal.attr('item-index')

//     list.find(`.item:eq(${index})`).remove()
// })

// Update profile
$('.btn-update-profile').on('click', function() {
    const indexBtn = $('.btn-update-profile').index($(this));
    let form = new Form('#form-update-profile');
    let formData = form.getData();

    // let jobs = [];

    // $(document).find('#list-jobs .item').each(function(key, item) {
    //     jobs.push({
    //         'department_id': $(this).find('department').html(),
    //         'major_id': $(this).find('major').html(),
    //         'subject_id': $(this).find('subject').html(),
    //     });
    // });

    // formData.push({
    //     name: 'jobs',
    //     value: JSON.stringify(jobs),
    // });

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

// setupDepartmentSelectors()
// setupMajorSelectors()
// setupSubjectSelectors()