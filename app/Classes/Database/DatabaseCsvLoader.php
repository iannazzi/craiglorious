<?php

namespace App\Classes\Database;


use App\Classes\File\CIFile;
use DB;
use File;
use Schema;

class DatabaseCsvLoader
{
    public static function loadCSVStartupData($dbc, $path)
    {
        $files = File::allFiles($path);
        foreach ($files as $file)
        {

            self::loadCSVStartupFile($dbc, $file);
        }
    }
    public static function loadCSVStartupFile($dbc, $file)
    {
        $fileManager = new CIFile();
        $table = basename((string) $file, '.csv');
        if (Schema::Connection($dbc)->hasTable($table))
        {
            $csv = $fileManager->csv_to_array($file, ';');
            $num_chunk_records = 1000;
            $chunk_array = array_chunk($csv, $num_chunk_records);
            foreach($chunk_array as $chunk)
            {


                try {

                    DB::connection($dbc)->table($table)->insert($chunk);
                }catch(\Exception $e){
                    var_dump($e->getMessage());
                    dd($table . ' Looks like you have a bad key or something in the insert array');
                }


            }






        }
    }
}