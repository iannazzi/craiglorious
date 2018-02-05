<?php


function cg_csv_seed_path($table)
{
    return database_path("seeds/craiglorious/csvStartupData/".$table. '.csv');
}
function em_data_seed_path(){
    dd(env('APP_ENV'));

    if(env('APP_ENV') == 'local'){
        return database_path("seeds/tenant/EmbrasseMoi/DataGitIgnore");
    }
    else{
        return '/var/www/craiglorious.com/data/EmbrasseMoi';
    }
}
