<?php
namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Contracts\Console\Kernel;

class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $baseUrl = 'http://localhost';

//    public function createApplication()
//    {
//        $app = require __DIR__.'/../bootstrap/app.php';
//
//        $app->make(Kernel::class)->bootstrap();
//
//        return $app;
//    }
}
