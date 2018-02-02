<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Classes\File\CIFile;

class EmUsersSeeder extends Seeder
{

    public function run()
    {


//get users
        Iannazzi\Generators\DatabaseImporter\DatabaseConnector::addConnections();
        $rows =  DB::connection('POS')->select("select * from pos_users where active = 1");

        $filename = base_path() . '/database/users.csv';
        $file = new CIFile();
        //why no file?
        $file->arrayToCSVFile($filename, $rows, ';', false, true);



    }
}
