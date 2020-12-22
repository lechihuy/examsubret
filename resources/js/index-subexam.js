
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
            major.append(new Option('Tất cả', 'all', true, true))

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
            subject.append(new Option('Tất cả', 'all', true, true))

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

$('#form-filter .btn-search').on('click', function() {
    let form = new Form('#form-filter')
    let formData = form.getData()

    formData.forEach(function(item, key) {
        if (item.name == 'exam_forms') {
            delete formData[key]
        }
    })

    let exam_forms = $('#form-filter input[for=exam_forms]:checked').map(function(key, item) {
        return $(item).val()
    }).get()

    if (exam_forms.indexOf('all') > -1) {
        exam_forms = 'all'
    } else {
        exam_forms = exam_forms.join()
    }

    formData.push({
        name: 'exam_forms',
        value: exam_forms
    })

    formData.push({
        name: 'k',
        value: $('input[name=k]').val()
    })

    let queries = {};
    
    formData.forEach(function(item) {
        if (Array.isArray(item.value)) {
            queries[item.name] = item.value.join(',')
        } else {
            queries[item.name] = item.value
        }
    })

    window.location.href = '?' + $.param(queries)
})

setupDepartmentSelectors()
setupMajorSelectors()
setupSubjectSelectors()
$('select[name=teacher_id]').select2()
$('select[name=class]').select2()

$('.btn-search').on('click', function() {
    let k = $('input[name=k]').val();
    let url = $(this).attr('action');

    location.href = query_url(url, 'k', k);
})

$('input[name=k]').on('keyup', function(e) {
    if (e.key == 'Enter') {
        let k = $('input[name=k]').val();
        let url = $(this).attr('action');

        location.href = query_url(url, 'k', k);
    }
})

// Save selected items
if (Cookies.get('subexam_selected_items') != '' && Cookies.get('subexam_selected_items') !== undefined) {
    let subexamSelectedItems = Cookies.get('subexam_selected_items').split(',');
    let checked = 0;

    for (item of subexamSelectedItems) {
        $(`.check-row[data-id=${item}]`).prop('checked', true);
    }

    $('.check-row').each(function(key, item) {
        if (subexamSelectedItems.includes($(item).data('id').toString())) {
            $(item).prop('checked', true);
            checked++;
        }
    });

    if (checked == $('.check-row').length) {
        $('.check-all').prop('checked', true);
    }

    $('#save-selected-item-switcher .counter').html(subexamSelectedItems.length);
}

if (Cookies.get('subexam_save_selected_items_mode') !== undefined) {
    $('#save-selected-item-mode').prop('checked', Cookies.get('subexam_save_selected_items_mode') === 'true')
}

if (Cookies.get('subexam_save_selected_items_mode') === 'true') {
    $('#save-selected-item-switcher .label-counter').removeClass('d-none');
} else {
    $('#save-selected-item-switcher .label-counter').addClass('d-none');
}

$('#save-selected-item-mode').on('change', function() {
    let mode = $(this).prop('checked');
    Cookies.set(`subexam_save_selected_items_mode`, mode)

    if (Cookies.get('subexam_save_selected_items_mode') === 'true') {
        $('#save-selected-item-switcher .label-counter').removeClass('d-none');
        Cookies.set('subexam_selected_items', '');
    } else {
        $('#save-selected-item-switcher .label-counter').addClass('d-none');
        Cookies.remove('subexam_selected_items');
    }

    $('#save-selected-item-switcher .counter').html('0');
});

$('.check-row').on('change', function() {
    if (Cookies.get('subexam_save_selected_items_mode') === 'true') {
        let checked = $(this).prop('checked');
        let subexamSelectedItems = Cookies.get('subexam_selected_items') != '' 
            ? Cookies.get('subexam_selected_items').split(',')
            : [];
        let id = $(this).data('id').toString();

        if (checked) {
            subexamSelectedItems.push(id);
        } else {
            subexamSelectedItems.splice(subexamSelectedItems.indexOf(id), 1);
        }
    
        Cookies.set('subexam_selected_items', subexamSelectedItems.join(','));

        $('#save-selected-item-switcher .counter').html(subexamSelectedItems.length);
    }
})

// Export table
$(document).on('click', '.btn-print', function() {
    $('#printer').remove();

    let url = $(this).attr('action');
    let selected = null;

    if (Cookies.get('subexam_save_selected_items_mode') === 'true') {
        selected = Cookies.get('subexam_selected_items')
    } else {
        selected = $('.check-row:checked').map(function(key, item) {
            return $(item).data('id');
        }).get().join(',') ?? '';
    }

    $('body').append(`
        <iframe id="printer" class="d-none" src="${query_url(url, 'selected', selected)}"></iframe>
    `)

    $('#printer').get(0).contentWindow.print()
})

$(document).on('click', '.btn-excel', function() {
    let url = $(this).attr('action');
    let selected = null;

    if (Cookies.get('subexam_save_selected_items_mode') === 'true') {
        selected = Cookies.get('subexam_selected_items')
    } else {
        selected = $('.check-row:checked').map(function(key, item) {
            return $(item).data('id');
        }).get().join(',') ?? '';
    }

    window.location = query_url(url, 'selected', selected);
})