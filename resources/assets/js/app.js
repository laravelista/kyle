/* This is a fix for Bootstrap requiring jQuery */
global.jQuery = require('jquery');
require('bootstrap');

var $ = require('jquery');
var bootbox = require('bootbox');

$('.confirm').on("submit", function(e) {
    var currentForm = this;
    e.preventDefault();
    bootbox.confirm('Are you sure?', function(result) {
        if(result === true) {
            currentForm.submit();
        }
    })
});

//var api_token = window.api_token || {};

$('#currency').on('change', function() {

    var currency = $(this).val();

    $.ajax('/api/v1/quote', {
        data: {
            currency: currency,
            api_token: api_token
        },
        method: 'GET',
        success: function (data) {
            data = data.replace('.', ',');
            $('#exchange_rate').val(data);
        }
    });
});