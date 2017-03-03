<?php namespace App\Classes\Database;

use App\Models\Craiglorious\System;
use DB, Config;

class TenantDatabaseConnector
{
    public static function GetDBCPrefix()
    {
        return strtolower(env('DB_PREFIX')) .'_'.env('MAIN_DB_NAME') . '_';
    }
    public static function createTenantConnection(System $system)
    {
        if(! self::checkDB($system->dbc()))
        {
            dd('You sure there is a database named ' . $system->dbc());
        }
        $env = strtoupper(env('DB_PREFIX'));
        $connections = Config::get('database.connections');
        $tenant_connection = [
            'driver'    => 'mysql',
            'host'      => env($env . '_DB_HOST'),
            'database'  => $system->dbc(),
            'username'  => env($env. '_DB_USERNAME'),
            'password'  => env($env .'_DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'port' => '3306'
        ];
        $connections[$system->dbc()] = $tenant_connection;
        Config::set('database.connections', $connections);
        self::setDefaultDBC($system);
        return true;

    }
    public static function setDefaultDBC($system)
    {
        Config::set('database.default', $system->dbc());
    }
    public static function checkDB($dbc)
    {
        $sql = "SELECT SCHEMA_NAME FROM 
                INFORMATION_SCHEMA.SCHEMATA 
                WHERE SCHEMA_NAME = '". $dbc ."'";

        $dbexists = DB::connection('main')->select($sql);

        if(sizeof($dbexists) > 0)
        {
            return true;
        }
        return false;
    }

}