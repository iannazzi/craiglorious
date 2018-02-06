<?php

namespace Iannazzi\Generators;

use Illuminate\Support\ServiceProvider;

class ImporterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->registerCommand('CreateMigrationsFromDatabaseCommand');
        $this->registerCommand('CreateModelsFromDatabaseCommand');
        $this->registerCommand('CreateFactoriesFromDatabaseCommand');
        $this->registerCommand('InitializeSystemsCommand');
        $this->registerCommand('DeleteAllSystemsCommand');
        $this->registerCommand('ImportDatabaseCommand');
        $this->registerCommand('MigrateCraigloriousCommand');
        $this->registerCommand('SeedCraigloriousCommand');
        $this->registerCommand('DmsCommand');
        $this->registerCommand('DstCommand');

    }

   public function registerCommand($name)
   {
       $this->app->singleton('command.iannazzi.' . $name, function ($app) use ($name){
           return $app['Iannazzi\Generators\Commands\\' . $name];
       });

       $this->commands('command.iannazzi.' . $name);
   }
}
