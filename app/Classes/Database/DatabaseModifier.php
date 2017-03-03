<?php namespace App\Classes\Database;

use App\Classes\Database\DatabaseManagerTrait;
Use DB, Schema;


class DatabaseModifier
{
	use DatabaseManagerTrait;
	private $test;
	public function __construct($test = false)
	{
		$this->test = $test;
	}

	



} 