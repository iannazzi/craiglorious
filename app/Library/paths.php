<?php


function cg_csv_seed_path($table)
{
    return database_path("seeds/craiglorious/csvStartupData/".$table. '.csv');
}
function em_data_seed_path(){


    if(env('LOCATION') == 'local'){
        $path = base_path(). "/DataGitIgnore/seeds/EmbrasseMoi";
        return $path;
    }
    elseif(env('LOCATION') == 'server')
    {
        return '/var/www/craiglorious.com/data/EmbrasseMoi';
    }
}
