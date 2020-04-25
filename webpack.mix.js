const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js(['resources/js/app.js', 'node_modules/bootstrap-select/dist/js/bootstrap-select.min.js'], 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles(
        [
            'node_modules/bootstrap/dist/css/bootstrap.min.css',
            'node_modules/bootstrap-select/dist/css/bootstrap-select.min.css',
        ],
        'public/css/app.css'
    );
