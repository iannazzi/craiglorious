<?php namespace App\Classes\Database;

use DB, Config;
use Dotenv;
use Exception;


class MainDatabaseConnector
{
    public static function createMainConnection()
    {
        //I need to manually make local_craiglorious db
        //test_craiglorious db
        //alpha_craiglorious db
        //etc

        //actually I do not.... these are all specified in .env...
        // so we should not need this
        // plus if we use this it makes everything more challenging to upgrade

        $env = strtoupper(env('DB_PREFIX'));

        $main_db = env('MAIN_DB_NAME');
        $database = strtolower($env) . '_' . $main_db;
        $env = strtoupper($env);
        //dd($_ENV);
        //dd(env($env . '_DB_HOST'));
        $connections = Config::get('database.connections');
        $main_connection = [
            'driver'    => 'mysql',
            'host'      => env($env . '_DB_HOST'),
            'database'  => $database,
            'username'  => env($env . '_DB_USERNAME'),
            'password'  => env($env . '_DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'port' => '3306'
        ];
        $connections['main'] = $main_connection;
        Config::set('database.connections', $connections);
        self::checkDB($database);

    }
    public static function checkDB($database)
    {
        dd('error on DB connection - check your credentials ' . $database);

        $sql = "SELECT SCHEMA_NAME FROM
                INFORMATION_SCHEMA.SCHEMATA
                WHERE SCHEMA_NAME = '". $database ."'";

        try{
             DB::connection('main')->select($sql);
        }
        catch(Exception $e)
        {
            dd('error on DB connection - check your credentials ' . $database);
        }


    }




}