/* This is a fix for Bootstrap requiring jQuery */
global.jQuery = require('jquery');
require('bootstrap');

var $ = require('jquery');
var bootbox = require('bootbox');
var selectize = require('selectize');

$('.confirm').on("submit", function(e) {
    var currentForm = this;
    e.preventDefault();
    bootbox.confirm('Are you sure?', function(result) {
        if(result === true) {
            currentForm.submit();
        }
    })
});

var falseTemplate = '<i class="fa fa-times-circle"></i>';
var trueTemplate = '<i class="fa fa-check-circle"></i>';

$('.kyle-change-boolean').each(function(index, value) {
    var state = $(this).data('state');

    if(state == "1") {
        $(this).html(falseTemplate);
        $(this).addClass('text-danger');
    }
    else {
        $(this).html(trueTemplate);
        $(this).addClass('text-success');
    }
});

$('.kyle-change-boolean').on('click', function(e) {
    var url = $(this).data('url');
    var state = $(this).data('state');

    var that = this;

    $.ajax(url, {
        data: {
            state: state,
            api_token: api_token
        },
        method: 'GET',
        success: function (data) {
            if(data == 0) {
                var opposite = 1;
                $(that).html(falseTemplate);
                $(that).addClass('text-danger');
                $(that).removeClass('text-success');
            }
            else {
                var opposite = 0;
                $(that).html(trueTemplate);
                $(that).addClass('text-success');
                $(that).removeClass('text-danger');
            }
            $(that).data('state', opposite);
        }
    });
});

// Categories can be created on-the-fly
$('#category_id').selectize({
    persist: true,
    create: function (input, callback) {
        $.ajax('/api/v1/categories', {
            data: {
                name: input,
                api_token: api_token
            },
            method: 'POST',
            success: function (data) {
                return callback({
                    value: data.id,
                    text: data.name
                });
            }
        });
    }
});

// Clients can be created on-the-fly
$('#client_id').selectize({
    persist: true,
    create: function (input, callback) {
        $.ajax('/api/v1/clients', {
            data: {
                name: input,
                api_token: api_token
            },
            method: 'POST',
            success: function (data) {
                return callback({
                    value: data.id,
                    text: data.name
                });
            }
        });
    }
});