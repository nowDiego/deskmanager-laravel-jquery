const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/css');
    mix.sass('resources/scss/global.scss', 'public/css');
    mix.sass('resources/scss/sidebar.scss', 'public/css');
    mix.sass('resources/scss/login.scss', 'public/css');
    
    