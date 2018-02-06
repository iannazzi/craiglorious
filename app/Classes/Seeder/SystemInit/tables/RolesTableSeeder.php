<?php
namespace App\Classes\Seeder\SystemInit\tables;


use App\Classes\Seeder\BaseSeeder;
use Illuminate\Database\Seeder;
use App\Models\Tenant\Role;
use App\Models\Craiglorious\View;
use App\Classes\File\CIFile;

class RolesTableSeeder extends BaseSeeder
{
    public static function run()
    {
        self::console('RolesTableSeeder');
        $file = database_path("seeds/tenant/systemInit/csvStartupData/RoleViews.csv");
        $fileManager = new CIFile();
        $csv = $fileManager->csvToArray($file, ';');
//this is here for testing
//        $system = App\Models\Craiglorious\System::first();
//        $system->createTenantConnection();


        $insert = function ($role_id, $view_id, $access)
        {
            \DB::insert('insert into role_view (role_id, view_id, access) values (?, ?, ?)', [$role_id, $view_id, $access]);
        };
        foreach ($csv as $line)
        {
            $role = Role::where('name', '=', $line['Role'])->firstOrFail();
            foreach ($line as $key => $value)
            {
                if ($key != 'Role')
                {
                    $view = View::where('name', '=', $key)->first();
                    $insert($role->id, $view->id, $line[ $key ]);
                }

            }
        }
    }
}
