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

mix.typeScript('resources/js/app.ts', 'public/js')
    .extract(['vue', 'lodash', 'axios', 'laravel-echo', 'bootstrap']).vue()
    .sass('resources/css/app.scss', 'public/css');
