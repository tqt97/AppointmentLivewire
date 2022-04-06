/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/backend.js ***!
  \*********************************/
$(document).ready(function () {
  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "1000",
    "extendedTimeOut": "500",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };
  window.addEventListener('hide-form', function (event) {
    $('#form').modal('hide');
    toastr.success(event.detail.message, 'Success !');
  });
  window.addEventListener('show-form', function (event) {
    $('#form').modal('show');
  });
  window.addEventListener('updated', function (event) {
    toastr.success(event.detail.message, 'Success !');
  });
  window.addEventListener('success', function (event) {
    toastr.success(event.detail.message, 'Success !');
  });
  window.addEventListener('role-changed', function (event) {
    toastr.success(event.detail.message, 'Success !');
  });
});
$('[x-ref="profileLink"]').on('click', function () {
  localStorage.setItem('_x_currentTab', '"profile"');
});
$('[x-ref="changePasswordLink"]').on('click', function () {
  localStorage.setItem('_x_currentTab', '"changePassword"');
});
/******/ })()
;