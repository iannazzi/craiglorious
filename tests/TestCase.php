<?php
namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Contracts\Console\Kernel;
use App\Models\Craiglorious\System;
use Symfony\Component\Console\Output\ConsoleOutput;


class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $baseUrl = 'http://localhost';
    function getSystem($company = 'test')
    {
        $system = System::where('company', $company)->first();
        $system->createTenantConnection();
        \DB::statement('set global max_connections = 800;');

        return $system;
    }
    public function console($msg)
    {
        $out = new ConsoleOutput();
        $out->writeln($msg);
    }

    public function dump($response)
    {
        dd($response->getContent());

    }
//    public function createApplication()
//    {
//        $app = require __DIR__.'/../bootstrap/app.php';
//
//        $app->make(Kernel::class)->bootstrap();
//
//        return $app;
//    }
}
