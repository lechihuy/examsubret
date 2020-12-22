try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    window.Cookies = require('js-cookie')

    require('bootstrap');
} catch (e) {}

require('./_helpers');
require('./_app');
