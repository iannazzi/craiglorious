<?php

use Tests\ApiTester;
use Illuminate\Support\Facades\App;

class EnvironmentTest extends ApiTester{

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

        $this->assertNotNull(env('LOCATION'));
        $this->assertNotNull(env('DB_PREFIX'));
        $this->assertNotNull(env('MAIN_DB_NAME'));
        $this->assertNotNull(env('JWT_SECRET'));



    }

}