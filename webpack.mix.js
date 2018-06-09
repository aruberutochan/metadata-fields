let mix = require('laravel-mix');

mix.js('src/resources/assets/js/app.js', 'src/public/js')
   .sass('src/resources/assets/sass/app.scss', 'src/public/css')
   .copy('node_modules/font-awesome/fonts', 'src/public/fonts/font-awesome');
