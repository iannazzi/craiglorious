<?php
namespace App\Classes\Database;

use Symfony\Component\Console\Output\ConsoleOutput;

trait DatabaseManagerTrait
{
	public function console($msg)
	{
		$out = new ConsoleOutput();
		$out->writeln($msg);
	}

	
}