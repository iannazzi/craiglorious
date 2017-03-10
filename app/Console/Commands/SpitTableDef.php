<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Craiglorious\System;

class SpitTableDef extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zz:td 
                            {table : the table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give me the JSON table Definition for a table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $table = $this->argument('table');
        $this->info($table);
        //get the first system connection

        $system = System::first();
        $system->createTenantConnection();
        $table_definition = [
        "name" => "vendor_table",
        "access" => "READ",
        "record_table_buttons" => ['edit'],
        "dynamic_table_buttons" => ['addRow','deleteRow','deleteAllRows', 'moveRows','copyRows','edit'],
        "table_type" => "KEY_VALUE INDEX",
        "route" => "/" . $table,
        "footer" => [],
        "header" => [],
        "column_definition" => "insert Column Def here",
    ];
        $this->info(json_encode($return));
//        $this->info(json_encode($results));

    }
}
