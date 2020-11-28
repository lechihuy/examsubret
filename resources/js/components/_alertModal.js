window.AlertModal = () => {
    this.alert = $('#modal-alert');
}

AlertModal.prototype.show = (data) => {
    this.alert.modal('show');

    this.alert.find('.icon').addClass(`${data.icon} ${data.icon_color}`)
    this.alert.find('.title').html(data.title)
    this.alert.find('.message').html(data.message);
}

AlertModal.prototype.hide = () => {
    this.alert
        .removeClass('alert-danger alert-success')
        .addClass('d-none').html('');
}