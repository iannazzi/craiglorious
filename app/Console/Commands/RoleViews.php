<?php

namespace App\Console\Commands;

use App\Models\Craiglorious\System;
use Illuminate\Console\Command;

class RoleViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zz:roleviews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a list of all the roles and views and access to create csv import';

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

        $system = System::first();
        $system->createTenantConnection();

        //$views = \App\Models\Craiglorious\View::all();
        $views = $system->views();
        $var1 = var_export(implode(";",$views->pluck('name')->toArray()));

        $this->info($var1);

        $roles = \App\Models\Tenant\Role::all();

        foreach($roles as $role){
            $this->info($role->name);
        }





    }
}
