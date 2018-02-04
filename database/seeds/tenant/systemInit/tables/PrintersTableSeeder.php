<?php
use Illuminate\Database\Seeder;
use \App\Models\Tenant\Printer;

class PrintersTableSeeder extends Seeder
{
    public function run()
    {
        //this is here for testing
        $system = App\Models\Craiglorious\System::first();
        $system->createTenantConnection();

        echo 'PrintersTableSeeder' . PHP_EOL;
        $insert = [
            [
                'name' => 'brother 2240',
                'description' => 'Office Check Printer',
                'media' =>'Checks - Quicken Format',
                'active' => 1,
            ],
            [
                'name' => 'brother 2240 II',
                'description' => 'Office 9x11 Invoice',
                'media' =>'Letter Paper',
                'active' => 1,
            ],
            [
                'name' => 'POS 01',
                'description' => 'Main POS Printer 5x7 Memo',                'media' =>'Memo 5x7 Paper',
                'active' => 1,
            ],
            [
                'name' => 'POS 02',
                'description' => 'Backup POS printer',                'media' =>'Memo 5x7 Paper',

                'active' => 1,
            ],
        ];

        Printer::insert($insert);


        echo 'Seeded Printer Table' . PHP_EOL;
    }
}
