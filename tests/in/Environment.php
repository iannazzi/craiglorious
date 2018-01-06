<?php

use Tests\ApiTester;
use Illuminate\Support\Facades\App;

class Environment extends ApiTester{

    /** @test */
    public function env_file_is_correct()
    {
        if (App::environment('local')) {
            echo 'local environment'  .PHP_EOL;
        }
        if (App::environment('testing')) {
            echo 'testing environment'  .PHP_EOL;
        }
        if (App::environment('staging')) {
            echo 'staging environment'  .PHP_EOL;
        }
        if (App::environment('production')) {
            echo 'production environment'  .PHP_EOL;
        }

        if (env('JWT_SECRET')==''){
            dd('JWT_SECRET not set Set JWT_SECRET via php artisan JWT:secret');
        }

    }

}