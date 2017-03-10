<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Craiglorious\System;

class DBColumnsToArray extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zz:dbcol 
                            {table : the table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give me the table Columns in an array I can populate';

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

            $return[$result->Field] =  "fillin";



        }
//        dd($return);
        $string = var_export($return,true);
//        dd($string);
        $this->info('$columns = ' .$string .';');
//        $this->info(json_encode($results));

    }
}
