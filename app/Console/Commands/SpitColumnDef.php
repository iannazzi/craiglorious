<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Craiglorious\System;

class SpitColumnDef extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zz:cd 
                            {table : the table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give me the JSON Column Definition for a table';

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
        $results = \DB::getSchemaBuilder()->getColumnListing($table);

        $results = \DB::select("show columns in " . $table);
        foreach ($results as $result)
        {
            if ($result->Field != 'created_at' && $result->Field != 'updated_at')
            {
                $return[] = [
                    "db_field" => $result->Field,
                    "caption" => ucwords(str_replace('_', ' ', $result->Field)),
                    "type" => "html date text textarea number row_checkbox row_number checkbox select tree_select button link radio",
                    "placeholder" => false,
                    "route" => "$table", //this is going away....
                    "onClick" => "callback",
                    "select_values" => [['value'=>'open','name'=>'Open'],['value'=>'closed','name'=>'Closed'],['value'=>'locked','name'=>'Locked']],
                    'array' => "true or not set caption has to then be set in 2d array [[]]",
                    'default_value' => 'default value is set',
                    "show_on_list" => true,
                    "show_on_view" => true,
                    "show_on_edit" => true,
                    "show_on_create" => true,
                    "th_width" => "150px",
                    "td_tags" => '',
                    "class" => '',
                    "events" => [],
                    "search" => "LIKE ANY BETWEEN EXACT",
                    "search_default" => "",
                    "properties" => [],
                    "total" => 0,
                    "round" => 0,
                    'word_wrap' => true,
                    'post' => true
                ];
            }


        }
        $this->info(json_encode($return));
//        $this->info(json_encode($results));

    }
}
