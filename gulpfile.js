// Disable notify
process.env.DISABLE_NOTIFIER = true
const elixir = require('laravel-elixir');


elixir((mix) => {

    mix.scripts([
        '/jquery/dist/jquery.js',
    ], 'public/js/main_page.js', 'node_modules')


})
;



