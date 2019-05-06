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

// const path = require('path')

// mix.webpackConfig({
//     resolve: {
//         alias: {
//             // 'filepicker': path.join(__dirname, './resources/assets/js/vendor/filepicker'),
//             'date-picker': path.join(__dirname, './public/themes/adminlte3/plugins/datepicker/bootstrap-datepicker.js')
//         }
//     }
// });

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

   if(mix.inProduction()){
       mix.version();
   }
mix.browserSync('househelp-vue.test');
