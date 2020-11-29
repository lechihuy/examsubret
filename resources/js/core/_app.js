require('../components/_alertModal')

$(document).ready(function() {
    // Tooltip
    $(document).find('*[data-toggle=tooltip]').tooltip();

    // Input
    $(document).find('input, textarea').attr({
        'autocomplete': 'off',
        'spellcheck': 'false',
        'user-scalable': 'false'
    });

    // Toggle sidebar
    $(document).on('click', '.btn-toggle-sidebar', function() {
        $(this).find('i').toggleClass('fa-bars fa-times');
        $('#sidebar').toggleClass('d-none');
    });

    // Collapse
    $(document).find('*[data-toggle="collapse"]').click(function() {
        $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
    });

    // Ajax setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Title & slug
    $(document).on('keyup paste change', 'input', function() {
        let input = $(this);
        let name = $(this).attr('name');

        $(document).find(`*[for=${name}]`).val(changeToSlug(input.val()));
    });

    // Single choose image
    $(document).find('.single-choose-img').attr('title', 'Nhấp vào đây để chọn ảnh');
    $(document).on('click', '.single-choose-img', function() {
        browseThumbnail($(this));
    });

    // Remove choose image
    $(document).on('click', '.btn-remove-img', function() {
        let btn = $(this);
        let img = btn.parent().find('img');

        img.attr('src', img.attr('remove-src'));
    });

     // Check all table
     $(document).on('change', '.check-all', function() {
        let checked = $(this).prop('checked');

        $(this).parents('table').find('.check-row').prop('checked', checked);
        $(this).parents('table').find('.check-all').prop('checked', checked);
    });

    // Action button
    $('.btn-action').on('click', function() {
        selectedItems = $(document).find('.check-row:checked').map(function() {
            return parseInt($(this).data('id'));
        }).get();

        if (selectedItems.length == 0) {
            $('modal').modal('hide');
            $('#modal-empty-selected-items').modal();
        }
    });

    // Pagination
    $(document).on('click', '.btn-go-to-page', function() {
        let page = $(this).parent().find('input[name=page]').val();
        let url = $(this).attr('action');

        location.href = query_url(url, 'page', page);
    });

    // Open modal
    $(document).on('click', '.btn-open-modal-form', function() {
        let modal = $($(this).attr('modal'));

        modal.modal();
    });

    // Add new component
    $(document).on('click', '.btn-add-modal-form', function() {
        let modal = $(this).parents('.modal')
        let action = modal.attr('action')
        let list = $(modal.attr('list'))
        let al = new AlertModal;

        $.ajax({
            url: action,
            type: 'GET',
            success: function(res) {
                modal.modal('hide')

                list.append(res)
            }, error: function(err) {
                modal.modal('hide')

                al.show({
                    'icon': 'fas fa-exclamation-circle text-danger',
                    'title': 'Oops!',
                    'message': 'Đã có lỗi xảy ra, vui lòng tải lại trang hoặc thực hiện lại.'
                })
            }
        })
    });

});