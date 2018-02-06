<?php
namespace App\Classes\Seeder;

use Symfony\Component\Console\Output\ConsoleOutput;

class BaseSeeder
{
    public function __construct()
    {

    }

    public static function console($msg)
    {
        $out = new ConsoleOutput();
        $out->writeln($msg);
    }
}
