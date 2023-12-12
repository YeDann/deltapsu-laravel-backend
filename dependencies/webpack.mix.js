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

// mix.js('resources/js/app.js', 'public/js')
//    .css('resources/sass/app.scss', 'public/css');


mix.styles([
 'public/oldcss/bootstrap.css',
 'public/oldcss/font.css',
 'public/oldcss/header-front.css',
 'public/oldcss/container.css',
 'public/oldcss/home.css',
 'public/oldcss/news.css',
 'public/oldcss/login.css',
 'public/oldcss/details.css',
 'public/oldcss/result-page.css',
 'public/oldcss/product-comparison.css',
 'public/oldcss/vanilla-calendar-min.css',
 'public/oldcss/fontello.css',
 'public/oldcss/owl.theme.default.css',
 'public/oldcss/owl.carousel.min.css',
 'public/oldcss/product.css',
 'public/oldcss/font-awesome.css',
 'public/oldcss/datatables.css',
 'public/oldcss/slick.css',
 'public/oldcss/slick.css',
 'public/oldcss/nouislider.min.css',
 'public/oldcss/jquery.datepicker.css',
 'public/oldcss/zabuto_calendar.css',
 'public/oldcss/fontello2.css',
], 'public/css/all.css');


mix.js([
 'public/oldjs/popper.min.js',
 'public/oldjs/bootstrap.min.js',
 'public/oldjs/bootstrap-select.min.js',
 'public/oldjs/map.js',
 'public/oldjs/product.js',
 'public/oldjs/owl.carousel.js',
 'public/oldjs/owl.carousel.min.js',
 // 'public/oldjs/datatables.min.js',
 'public/oldjs/slick.min.js',
 'public/oldjs/nouislider.min.js',
 'public/oldjs/zabuto_calendar.min.js',
 'public/oldjs/mb5.js',
], 'public/js/all.js');
