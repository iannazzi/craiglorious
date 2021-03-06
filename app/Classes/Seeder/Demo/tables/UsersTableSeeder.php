<?php
namespace App\Classes\Seeder\Demo\tables;

use App\Classes\Seeder\BaseSeeder;
use App\Models\Tenant\User;
use App\Models\Tenant\Role;

class UsersTableSeeder extends BaseSeeder
{
    public static function run()
    {
        self::console('DemoUsersTableSeeder');
        $users = [
            [
                'username' => 'owner',
//                'first_name' => 'owner',
                'password' => bcrypt('secret'),
                'passcode' => '12341',


//                'email' => '',
                'role_id' => Role::where('name', '=', 'Owner')->first()->id,
                'active' => 1,
            ],
            [
                'username' => 'Manager',
//                'first_name' => 'Manager',
                'password' => bcrypt('secret'),
                'passcode' => '12342',
//                'email' => '',
                'role_id' => Role::where('name', '=', 'Sales Manager')->first()->id,
                'active' => 1,
            ],
            [
                'username' => 'Sales',
//                'first_name' => 'Sales Associate',
                'password' => bcrypt('secret'),
                'passcode' => '12343',
//                'email' => '',
                'role_id' => Role::where('name', '=', 'Sales Associate')->first()->id,
                'active' => 1,
            ],
            [
                'username' => 'John.Doe',
//                'first_name' => 'Back End Associate',
                'password' => bcrypt('secret'),
                'passcode' => '12344',
//                'email' => '',
                'role_id' => Role::where('name', '=', 'Back End Associate')->first()->id,
                'active' => 1,
            ],
            [
                'username' => 'Accountant',
//                'first_name' => 'Accountant',
                'password' => bcrypt('secret'),
                'passcode' => '12345',
//                'email' => '',
                'role_id' => Role::where('name', '=', 'Accountant')->first()->id,
                'active' => 1,
            ],
            [
                'username' => 'Guest',
////                'first_name' => 'Guest',
                'password' => bcrypt('secret'),
                'passcode' => '12346',
//                'email' => '',
                'role_id' => Role::where('name', '=', 'Guest')->first()->id,
                'active' => 1,
            ],
            [
                'username' => 'Trainee',
//                'first_name' => 'Trainee',
                'password' => bcrypt('secret'),
                'passcode' => '12347',
//                'email' => '',
                'role_id' => Role::where('name', '=', 'Trainee')->first()->id,
                'active' => 1,
            ],
        ];
        User::insert($users);
    }
}
