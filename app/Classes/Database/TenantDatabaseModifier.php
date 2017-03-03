<?php
namespace App\Classes\Database;
use App\Models\Craiglorious\System;
use Log,DB;
use Symfony\Component\Console\Output\ConsoleOutput;


class TenantDatabaseModifier
{
	//this guy is responsible for modifying the database
	private $tdbc;
	private $connector;
	public function __construct(System $system)
	{	
		$this->tdbc = $system->dbc();
		$this->database = $system->dbc();
		$this->connector = new TenantDatabaseConnector($system);
		$this->output = new ConsoleOutput();

	}
	public function emptyTenantTable($table)
	{
		$dbc = $this->dbc;
		$this->emptyTable($dbc, $table);
	}
	public function deleteDatabase()
	{
		$db_name = $this->database;;
		if(!TenantDatabaseConnector::checkDB($this->tdbc))
		{
			$msg = 'Database Does Not exist: ' . 	$db_name  . PHP_EOL;
			$this->output->writeln($msg);
			Log::info($msg);

			return;
		}
		$msg = 'Deleting database ' . 	$db_name . PHP_EOL;
		$this->output->writeln($msg);
		Log::info($msg);
		$sql = 'Drop Database ' . $db_name;
        DB::connection('main')->statement($sql);
        $msg = 'Deleted ' . 	$db_name . PHP_EOL;
		$this->output->writeln($msg);
		Log::info($msg);
	}

}