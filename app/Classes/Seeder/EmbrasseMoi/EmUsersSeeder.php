<?php
namespace App\Classes\Seeder\EmbrasseMoi;

use App\Classes\Seeder\BaseSeeder;
use App\Models\Tenant\Role;
use App\Models\Tenant\User;
use App\Classes\File\CIFile;
use Iannazzi\Generators\DatabaseImporter\DatabaseMigrationMap;

class EmUsersSeeder extends BaseSeeder
{

    public static function run()
    {
        //users seeder I need to start by getting the users, then
        // physically modify the csv file to add the role name
        //then import the user file

        $i_got_the_data = true;
        $cifile = new CIFile();
        $filename = em_data_seed_path() . '/users.csv';
        if($i_got_the_data){
            User::truncate();
            $users = $cifile->csvToArray($filename, ';');
            $new = [];
            foreach ($users as $user)
            {
                $user['role_id'] = Role::where('name',$user['role'])->first()->id;
                unset($user['role']);
                $new[] = $user;
            }
            User::insert($new);
        }
        else{
            Iannazzi\Generators\DatabaseImporter\DatabaseConnector::addConnections();
            $rows =  DB::connection('POS')->select("select * from pos_users where active = 1");
            $new_data = [];

//        $pos_key = env('POS_KEY');
//        $mm = new DatabaseMigrationMap();

            foreach($rows as $row){
                $entry = [];
                $entry['username'] = $row->login;
                $entry['password'] = bcrypt('feeling positive');
                $entry['passcode'] = bcrypt('33456');
                $entry['role'] = 'admin';
                $new_data[] = $entry;
            }
            //write the file for offline use

            $cifile->arrayToCSVFile($filename, $new_data, ';', false, true);

        }



    }
}
