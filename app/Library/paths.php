<?php


function cg_csv_seed_path($table)
{
    return database_path("seeds/craiglorious/csvStartupData/".$table. '.csv');
}
function em_data_seed_path(){


    if(env('LOCATION') == 'local'){
        return database_path("seeds/tenant/EmbrasseMoi/DataGitIgnore");
    }
    elseif(env('LOCATION') == 'server')
    {
        return '/var/www/craiglorious.com/data/EmbrasseMoi';
    }
}
