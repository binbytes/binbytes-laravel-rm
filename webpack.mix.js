let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/css')
    .copy('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css', 'public/css/dt-bs4.css')
    .styles([
        'public/css/bootstrap.css',
        'public/css/app.css',
        'public/css/dt-bs4.css',
    ], 'public/css/all.css')
    .copyDirectory('resources/assets/images', 'public/images');
