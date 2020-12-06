window.AlertModal = () => {
    this.alert = $('#modal-alert');
}

AlertModal.prototype.show = (data) => {
    this.alert.modal('show');
    console.log(data)
    this.alert.find('.icon').attr('class', `icon fa-4x ${data.icon}`)
    this.alert.find('.title').html(data.title)
    this.alert.find('.message').html(data.message);
}

AlertModal.prototype.hide = () => {
    this.alert
        .removeClass('alert-danger alert-success')
        .addClass('d-none').html('');
}