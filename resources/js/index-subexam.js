$(document).on('click', '#btn-switch-status-items', function() {
    let status = $(this).attr('status');
    let form = new Form('#modal-confirm');

    form.hideAlert();

    $.ajax({
        url: $('meta[name=switch-status-post-list-route]').attr('content'),
        method: 'PUT',
        data: {
            ids: selectedItems,
            status: status
        }, success: function(res, textStatus, xhr) {
            form.showAlert(res.message, xhr.status);
            form.redirectToIfAvailable(res);
        }, error: function(err) {
            form.showAlert(err.responseJSON.message);
        }
    });
});