<?php

namespace App\Console\Commands;

use App\Models\Craiglorious\System;
use Illuminate\Console\Command;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zz:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'something random';

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

        $role = \App\Models\Tenant\Role::find(6);
        dd($role->getSelectableParents());;







    }
}
