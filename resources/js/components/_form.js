window.Form = _selector => {
    this.form = $(_selector);
    this.alert = $(document).find(`*[form="${_selector}"]`);
}

Form.prototype.getAction = () => {
    return this.form.attr('action');
}

Form.prototype.getData = () => {
    return this.form.serializeArray();
}

Form.prototype.showAlert = (_message, _statusCode, _index = 0) => {
    this.alert.eq(_index)
        .removeClass('d-none')
        .removeClass('alert-danger alert-success')
        .addClass(`alert-${_statusCode == 200 ? 'success' : 'danger'}`)
        .html(_message);
}

Form.prototype.hideAlert = () => {
    this.alert
        .removeClass('alert-danger alert-success')
        .addClass('d-none').html('');
}

Form.prototype.redirectToIfAvailable = (_res) => {
    if (_res.redirect_to == 'RELOAD') {
        window.location.reload();
    } else if (_res.redirect_to) {
        window.location.href = _res.redirect_to;
    }
}