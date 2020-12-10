require('../components/_alertModal')
require('../components/_form')

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

    $('#sidebar li').on('click', function() {
        $(this).find('i.icon-toggle').toggleClass('fa-chevron-down fa-chevron-up');
        $(this).children('.sub-nav').slideToggle();
    })

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
    $('.btn-action[has-selected=true]').on('click', function() {
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

    // Select box
    $(document).on('click', '.select-box .option', function() {
        let selectbox = $(this).parent('.select-box')
        selectbox.find('.option').removeClass('active')
        $(this).addClass('active')
    })

    // Table
    $('.table-wrapper td.cell-fixed').each(function(key, item) {
        if ($(item).parent('tr').index() % 2 == 0) {
            $(item).addClass('bg-light');
        }
    })

    // Modal confirm
    $(document).on('click', '.btn-action[has-confirmed=true]', function() {
        let selectedItems = $(document).find('.check-row:checked').map(function() {
            return parseInt($(this).data('id'));
        }).get();

        if ($(this).attr('has-selected') && selectedItems.length == 0) return;

        $('#modal-confirm').modal('show');
        $('#modal-confirm').attr({
            'action': $(this).attr('action'),
            'method': $(this).attr('method'),
        })
        $('#modal-confirm data').data($(this).data());
    });

    $('#modal-confirm .btn-confirm').on('click', function() {
        let modal = $('#modal-confirm');
        let al = new AlertModal;
        let form = new Form('#modal-confirm');
        let data = modal.find('data').data();

        let selectedItems = $(document).find('.check-row:checked').map(function() {
            return parseInt($(this).data('id'));
        }).get();

        if (selectedItems.length) {
            data['ids'] = selectedItems;
        }

        $.ajax({
            url: modal.attr('action'),
            type: modal.attr('method'),
            data: data,
            success: function(res) {
                modal.modal('hide');

                al.show({
                    'icon': 'fas fa-check-circle text-success',
                    'title': 'OK!',
                    'message': res.message,
                })
                form.redirectToIfAvailable(res);
            }, error: function() {
                modal.modal('hide');

                al.show({
                    'icon': 'fas fa-exclamation-circle text-danger',
                    'title': 'Oops!',
                    'message': 'Đã có lỗi xảy ra, vui lòng tải lại trang hoặc thực hiện lại.'
                })
            }
        })
    });

    // Multichoice
    $(document).on('click', '.check-all-mc', function() {
        let mc = $(this).attr('mc')
        let checked = $(this).prop('checked');
        
        $(document).find(`input[type=checkbox][mc=${mc}]`).prop('checked', checked);
    })

    $(document).on('click', `input.choice[type=checkbox][mc]`, function() {
        let checked = $(this).prop('checked');
        let mc = $(this).attr('mc')
        
        if ($(document).find(`input.choice[type=checkbox][mc=${mc}]:checked`).length 
            == $(document).find(`input.choice[type=checkbox][mc=${mc}]`).length) {
            $(document).find(`input.check-all-mc[type=checkbox][mc=${mc}]`).prop('checked', true);
        } else {
            $(document).find(`input.check-all-mc[type=checkbox][mc=${mc}]`).prop('checked', false);
        }
    })

    // Print table
    $(document).on('click', '.btn-print', function() {
        $("#printer").get(0).contentWindow.print()
    })
});