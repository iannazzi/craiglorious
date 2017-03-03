<?php
//namespace Database\Seeds\Tenant\StartupSeeds;

use Illuminate\Database\Seeder;
use App\Models\Tenant\Role;
use App\Models\Craiglorious\View;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo 'RolesTableSeeder - it is easier to do this with csv' . PHP_EOL;

        $file = database_path("seeds/tenant/RoleViews/RoleViews.csv");
        $fileManager = new App\Classes\File\CIFile();
        $csv = $fileManager->csv_to_array($file, ';');
//this is here for testing
//        $system = App\Models\Craiglorious\System::first();
//        $system->createTenantConnection();

        //$views = View::all();

        $insert = function ($role_id, $view_id, $access){
            \DB::insert('insert into role_view (role_id, view_id, access) values (?, ?, ?)', [$role_id, $view_id, $access]);
        };
        foreach ($csv as $line)
        {
            $role = Role::where('name','=',$line['Role'])->firstOrFail();
            foreach ($line as $key => $value) {
                if($key !='Role'){
                    $view = View::where('name', '=', $key)->first();
                    $insert($role->id, $view->id, $line[$key]);
                }

            }
        }


//        $views = View::all();
//        $roles = Role::all();
//        foreach ($roles as $role)
//        {
//            foreach ($views as $view)
//            {
//                if ($view->name == 'Roles'){
//                    if($role->name == 'Administrator'){
//                        $insert($role->id, $view->id, 'write');
//                    }
//                    if($role->name =='Owner'){
//                        $insert($role->id, $view->id, 'write');
//                    }
//                    if($role->name == "Manager"){
//                        $insert($role->id, $view->id, 'read');
//                    }
//                    else{
//                        $insert($role->id, $view->id, 'none');
//                    }
//                }
//                else{
//                    if($role->name == 'Administrator'){
//                        $insert($role->id, $view->id, 'write');
//                    }
//                    if($role->name =='Owner'){
//                        $insert($role->id, $view->id, 'write');
//                    }
//                    if($role->name == "Manager"){
//                        $insert($role->id, $view->id, 'write');
//                    }
//                    if($role->name == "Guest"){
//                        $insert($role->id, $view->id, 'read');
//                    }
//                    else{
//                        $insert($role->id, $view->id, 'none');
//                    }
//                }
//
//
//            }
//        }
    }
}
