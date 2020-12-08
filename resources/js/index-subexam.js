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
        if (item.name == 'forms') {
            delete formData[key]
        }
    })

    let forms = $('#form-filter input[name=forms]:checked').map(function(key, item) {
        return $(item).val()
    }).get()

    if (forms.indexOf('all') > -1) {
        forms = 'all'
    }

    formData.push({
        name: 'forms',
        value: forms
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