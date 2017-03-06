// Disable notify
process.env.DISABLE_NOTIFIER = true
const elixir = require('laravel-elixir');


elixir((mix) => {

    mix.scripts([
        '/jsuri/Uri.js',
        'thenby/thenBy.min.js',
        'moment/min/moment.min.js',
        'fullcalendar/dist/fullcalendar.min.js'
    ], 'public/vendor/vendor.js', 'node_modules')


})
;



