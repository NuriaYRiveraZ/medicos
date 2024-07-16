const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .copy('node_modules/@fullcalendar/core/main.css', 'public/css/fullcalendar.css')
   .copy('node_modules/@fullcalendar/daygrid/main.css', 'public/css/daygrid.css')
   .copy('node_modules/@fullcalendar/timegrid/main.css', 'public/css/timegrid.css');