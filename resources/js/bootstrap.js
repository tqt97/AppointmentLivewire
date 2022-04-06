// window._ = require('lodash');

// window.axios = require('axios');

// window.axios.defaults.headers.common[ 'X-Requested-With' ] = 'XMLHttpRequest';

try {
    window.$ = window.jQuery = require('jquery');
    require('admin-lte');
    require('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js');
    window.toastr = require('admin-lte/plugins/toastr/toastr.min.js');
} catch (e) {
    console.log(e);
}
