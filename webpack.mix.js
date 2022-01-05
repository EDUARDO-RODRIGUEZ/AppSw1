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

   mix.styles([
      'resources/plantilla/css/adminlte.css',
      'resources/plantilla/css/adminlte.css.map',
      'resources/plantilla/css/adminlte.min.css',
      'resources/plantilla/css/adminlte.min.css.map'
   ], 'public/dist/css/plantilla.css').scripts([
      'resources/plantilla/js/adminlte.min.js','resources/plantilla/js/sweetalert2.all.min.js'
   ], 'public/dist/js/plantilla.js').js(['resources/js/app.js'],'public/dist/js/app.js');