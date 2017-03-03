<?php namespace App\Classes\Database;

Use App\Classes\Database\DatabaseManagerTrait;

class DatabaseMigrator 
{
	use DatabaseManagerTrait;
	public function getMigrationFiles($db)
	{
		//$db is tenant or craiglorious
		$directory = database_path("migrations/".$db);
		$files = \File::allFiles($directory);
		return $files;
	}
	public function getMigrationTableName($files)
	{
		$tables = [];
		foreach ($files as $file)
		{
			//get the name and make it a seeder...
			$migration_name = basename((string)$file, '.php');
			$migration_name = substr($migration_name, 25);
			$table = substr($migration_name, 0, strlen($migration_name)-6);
			//$table = 'pos_' . $migration_name;
			$tables[] =$table;
		}
		return $tables;

	}


}