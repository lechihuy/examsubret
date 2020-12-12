$('#form-filter .btn-search').on('click', function() {
    let form = new Form('#form-filter')
    let formData = form.getData()

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

