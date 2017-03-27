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
            "route" => "/" . $table,
            'additionalPostValues' => 'object',
            "data" => "self.data",
        "access" => "read write",
            "type"=> "record collection searchable",
        "table_view" => "index edit show create", //column def show_on_edit show_on_view show_on_create etc..
        "table_buttons" => ['edit', 'delete','addRow','deleteRow','deleteAllRows', 'moveRows','copyRows'],
        "edit display" => "on_page modal modal_only",
            "callbacks" => "onDeleteClick onEditClick onCancelClick onSaveClick onSaveSuccess onCreateCancelClick onCreateSaveClick",
            "onCreateSaveClick" => 'self.$router.push({path: \'/roles/\' + id, props: {justcreated: \'true\'}});',
        "footer" => [],
        "header" => [],
        "column_definition" => "insert Column Def here",
            "getData" => "this is a callback for your ajax, rest, axios, etc"
    ];
        $this->info(json_encode($table_definition));
//        $this->info(json_encode($results));

    }
}
