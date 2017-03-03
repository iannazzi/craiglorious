<?php


function cg_csv_seed_path($table)
{
    return database_path("seeds/craiglorious/csvStartupData/".$table. '.csv');
}
function tenant_csv_seed_path($table)
{
    return database_path("seeds/tenant/csvStartupData/".$table. '.csv');
}
