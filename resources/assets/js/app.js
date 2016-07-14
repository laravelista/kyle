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