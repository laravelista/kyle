var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
        .copy('node_modules/bootstrap-less/fonts', 'public/build/fonts')
        .copy('node_modules/font-awesome/fonts', 'public/build/fonts')
        .less('app.less')
        .browserify('app.js')
        .version(['css/app.css', 'js/app.js']);
});
