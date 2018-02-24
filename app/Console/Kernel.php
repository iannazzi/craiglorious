<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\TestBroadcast::class,
        Commands\SpitTableDef::class,
        Commands\TestMainConnection::class,
        Commands\MigrateProduction::class,
        Commands\SpitColumnDef::class,
        Commands\DBColumnsToArray::class,
        Commands\RoleViews::class,
        Commands\test::class,
        \App\Classes\Auth\JWTGenerateSecretCommand::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
