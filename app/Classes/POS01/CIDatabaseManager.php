<?php
namespace App\Classes\Database;

class CIDatabaseManager
{
	// THis was my original code that I imported.....
	protected $connection_name;
	protected $dbc; //the connection.......
	public function __construct($connection_name)
	{
		
		$this->connection_name = $connection_name;
		//getDBC($connection_name);
		$this->getDBC();
	}
	public function __destruct() 
    { 
        mysqli_close($this->dbc);
    } 
	private function getDBC()
	{	
		$connections = \Config::get('database.connections');

		$dbc = @mysqli_connect ($connections[$this->connection_name]['host'], 
								$connections[$this->connection_name]['username'], 
								$connections[$this->connection_name]['password'], 
								$connections[$this->connection_name]['database']);
		if (!$dbc) 
		{
			trigger_error( 'Craig laravel dannnng check your config file...- Could not connect to MySQL: ' . $this->connection_name .' ' . mysqli_connect_error());
			exit();
		} 
		$this->dbc = $dbc;
		//return $dbc;
	}
	private function runQuery($sql)
	{
		//this one does the main running, but does not close the DB....
		//dd($this);
		$this->getDBC(); //why do I need to do this again???
		$result = @mysqli_query($this->dbc, $sql);
		if (!$result) 
		{ 
			trigger_error( mysqli_error($this->dbc) . ' Query: ' . $sql , E_USER_WARNING);
		}
		return $result;
	}
	public function runSQL($sql)
	{
		$result = $this->runQuery($sql);
		//mysqli_close($this->dbc);
		return $result;
	}
	public function scrubInput($input)
	{
		if (get_magic_quotes_gpc()) 
		{
			$input = stripslashes($input);
		}
		// Quote if not integer
		if (!is_numeric($input)) 
		{
			$input =  mysqli_real_escape_string($this->dbc, trim($input));
		}
		//mysqli_close($this->dbc);
		return $input;
	}
	public function getSQL($sql)
	{
		$result = $this->runSQL($sql);
		$result_array = $this->convert_mysql_result_to_array($result);
		return $result_array;
	}
	public function getSingleValueSQL($sql)
	{
		$result = $this->getSQL($sql);
		if (sizeof($result)>0)
		{
			foreach($result[0] as $key => $value)
			{
				$return_val =  $value;
			}
			if (isset($return_val))
			{
				return $return_val;
			}
			return false;
			
		}
		else
		{
			return false;
		}	
	}
	public function getFieldRowSql($sql)
	{
		$result = $this->getSQL($sql);
		return $this->switchArrayFromRowFieldToFieldRows($result_array);
	}

	//SELECT
	public function selectSingleTableDataFromID($dbTable, $key_val_id, $table_def)
	{
		//Version 2 has some added checks in case there is no db Field specified.
		$db_field_array = array();
		$counter = 0;
		for($i=0;$i<sizeof($table_def);$i++)
		{
			if(isset($table_def[$i]['db_field']) && $table_def[$i]['db_field'] !='')
			{
				
					$db_field_array[$counter] = $table_def[$i]['db_field'];
				
				
				$counter++;
			}
		}
		$str_fields = implode(',', $db_field_array);
		$sql = "SELECT " . $str_fields . " FROM " . $dbTable . " WHERE " .key($key_val_id) ." ='" . $key_val_id[key($key_val_id)] . "' LIMIT 1";
		$data_array = $this->getSQL($sql);
		for($i=0;$i<sizeof($table_def);$i++)
		{
			if(isset($table_def[$i]['db_field']) && $table_def[$i]['db_field'] !='')
			{
				if(isset($table_def[$i]['encrypted']))
				{
					$table_def[$i]['value'] = $this->craigsDecryption($data_array[0][$table_def[$i]['db_field']],0);
				}
				else
				{
					$table_def[$i]['value'] = $data_array[0][$table_def[$i]['db_field']];
				}
			}
		}
		return $table_def;
	}
	//Insert
	public function simpleInsertSQLString($table, $mysql_data)
	{
		// Make the query out of the keys and values - they should match mysql fields
		//get the keys
		$db_fields = array_keys($mysql_data);
		$str_fields = implode(', ', $db_fields);
		$row_array = array();
		foreach($db_fields as $field)
		{
			$row_array[] = "'" . $mysql_data[$field] . "'";	
	    }
	    $db_values = '(' .  implode(', ',$row_array) .')';
		
		$insert_q = "INSERT INTO ".$table." (" . $str_fields . ") VALUES  " .  $db_values ;
		return $insert_q;
	}
	public function simpleInsertSQL($table, $mysql_data)
	{
		$insert_q = simpleInsertSQLString($table, $mysql_data);
		return $this->runSQL($insert_q );
	}
	public function simpleInsertSQLReturnID($table, $mysql_data)
	{
		//send in mysql_data that matches the mysql table.... easy breazy
		$insert_q = simpleInsertSQLString($table, $mysql_data);
		$result = runQuery($insert_q);
		$lastID = mysqli_insert_id($this->dbc);
		//mysqli_close($this->$dbc);
		return $lastID;
	}
	public function simpleUpdateSQLString($table, $key_val_id, $mysql_data)
	{
		//use like: $mysql_data[$db_field] = $value;
		//send in mysql_data that matches the mysql table.... easy breazy
		// the $id should have a key like this: $id['pos_expense_id'] = $_POST['pos_expense_id'];
		//UPDATE table SET field = 'value', fied2 = 'value2' WHERE bla

		$db_fields = array_keys($mysql_data);
		$key_value_array = array();
		foreach($db_fields as $field)
		{
			$key_value_array[] = $field . " = '" .$this->scrubInput($mysql_data[$field]) ."'";
	    }
	    $sql_update_string  =  implode(', ',$key_value_array);
		$update_q = "UPDATE ".$table." SET " . $sql_update_string . " WHERE " . key($key_val_id) . "='" .$key_val_id[key($key_val_id)]."'";
		return $update_q;
	}
	public function simpleUpdateSQL($table, $key_val_id, $mysql_data)
	{
		//use like: $update_data = array('verify' => 1,'blbla'=>'hello');
		//send in mysql_data that matches the mysql table.... easy breazy
		// the $id should have a key like this: $id['pos_expense_id'] = $_POST['pos_expense_id'];
		$update_q = $this->simpleUpdateSQLString($table, $key_val_id, $mysql_data);
		return $this->runSQL($update_q);
	}
	public function arrayInsertSQL($table, $mysql_data)
	{
		$insert_q = $this->arrayInsertSQLString($table, $mysql_data);
		return $this->runSQL($this->connection_name,$insert_q);
	}
	public function arrayInsertSQLString($table, $mysql_data)
	{
		$db_fields = array_keys($mysql_data[0]);
		$str_fields = implode(', ', $db_fields);
		for($i=0;$i<sizeof($mysql_data);$i++)
		{
			$row_array = array();
			foreach($db_fields as $field)
			{
				$row_array[] = "'" . $this->scrubInput($mysql_data[$i][$field] ). "'";	
	    	}
	    	$db_values[] = '(' .  implode(', ',$row_array) .')';
	    }
		$all_insert_values = implode(', ',$db_values);
		$insert_q = "INSERT INTO ".$table." (" . $str_fields . ") VALUES  " .  $all_insert_values;
		return $insert_q;
	}
	public function jsonFileInsertSQL($table, $file)
	{
		$mysql_data = json_decode(file_get_contents($file), true);
		return $this->arrayInsertSQL($this->connection_name, $table, $mysql_data);
	}
	
	public function exportToCSV($sql,$path, File $file)
	{
		$data = runSQL($sql);
		$file->arrayToCSVFile($data, ';', true, true);
		

	}
	public function csvFileInsertSQL($table, $file)
	{
		$csv = array_map('str_getcsv', file('data.csv'));
	}
	public function startTransaction()
	{
		@mysqli_query($this->$dbc,"START TRANSACTION");
		return $dbc;
	}
	public function commitTransaction($results)
	{
		$success = true;
		for($i=0;$i<sizeof($results);$i++)
		{
			if(!$results[$i])
			{
				$success = false;
			}
		}
		//	$success = false;
		if ($success) 
		{
			$tmp = @mysqli_query($this->dbc, "COMMIT");
		} 
		else 
		{        
			$tmp  = @mysqli_query($this->dbc, "ROLLBACK");
		}
		//mysqli_close($this->dbc);
		return $success;
	}
	public function simpleCommitTransaction()
	{
		$tmp = @mysqli_query($this->dbc, "COMMIT");
		//mysqli_close($this->dbc);
	}


	//form helpers.... these take the post data and insert it....
	// in laravel how would we do that?
	//we would handle the post then deal with the object....
	//there is also a form builder here, but what is the rule, put the view elswhere!!!

	private function deserializeTableDef($table_def)
	{
		return  unserialize(stripslashes(htmlspecialchars_decode($table_def)));
	}
	private function tableDefArraytoMysqlInsertArray($table_def)
	{
		//make an insert array like this:
		//$update_data[$db_field] = $value;
		$insert_array=array();
		foreach($table_def as $mysql_field)
		{
			if ($mysql_field['type'] == 'checkbox')
			{
				if(isset($_POST[$mysql_field['db_field']]) && $_POST[$mysql_field['db_field']] =='on')
				{
					$insert_array[$mysql_field['db_field']] = 1;
				}
				else
				{
					$insert_array[$mysql_field['db_field']] = 0;
				}
			
			}
			elseif ($mysql_field['type'] == 'file_input')
			{
				//do nothing
			}
			else
			{
				$insert_array[$mysql_field['db_field']] = scrubInput($_POST[$mysql_field['db_field']]);
			}
		}
		return $insert_array;
	}
	private function lock_entry($table, $key_val_id)
	{
		$sql_update_string = " user_id_for_entry_lock = " .$_SESSION['pos_user_id'];
		$update_q = "UPDATE ".$table." SET " . $sql_update_string . " WHERE " . key($key_val_id) . "='" .$key_val_id[key($key_val_id)]."'";
		return runSQL($this->connection_name,$update_q);
	}
	private function unlock_entry($table, $key_val_id)
	{
		$sql_update_string = " user_id_for_entry_lock = 0 ";
		$update_q = "UPDATE ".$table." SET " . $sql_update_string . " WHERE " . key($key_val_id) . "='" .$key_val_id[key($key_val_id)]."'";
		return runSQL($this->connection_name,$update_q);
	}
	private function get_entry_lock($table, $key_val_id)
	{
		$sql = "SELECT user_id_for_entry_lock FROM ".$table." WHERE " . key($key_val_id) . "='" .$key_val_id[key($key_val_id)]."'";
		return getSingleValueSQL($this->connection_name,$sql);
	}
	private function check_lock($table, $key_val_id, $complete_location, $cancel_location)
	{
		$page_title = 'Locked';
		$entry_lock = get_entry_lock($this->connection_name,$table, $key_val_id);
		if( $entry_lock != 0)
		{
			
			//problem.... the entry is coded as locked.... this could be because someone is editing it, or a connection was lost and it needs to be unlocked.
			//ask for advice
			$form_handler = POS_ENGINE_URL .'/includes/php/entry_lock.php';
			$html = '<form id = "entry_lock" name="entry_lock" action="'. $form_handler. '" method="post" >';
			$html .= '<p>Problem! This Entry is Coded as LOCKED by ' . getUserFullName($entry_lock) .', meaning one of two things: 1) Another user is busy monkeying with the data, and if you go into it then you might destroy that fresh data, or 2) Somewhere along the way the entry was locked and then the user\'s session expired or a power failure or something else catastrophic happened, meaning you should use the unlock entry option. <br> Either way, make a choice to unlock the entry or leave it locked.</p>';
			//$html .= '<input type="checkbox" name="unlock" value="unlock">Unlock The Table';
			//$html .= '<br>';
			$primary_key_name = key($key_val_id);
			$primary_key_value = $key_val_id[$primary_key_name];
			$html.= createHiddenInput('table', $table);
			$html.= createHiddenInput('primary_key_name', $primary_key_name);
			$html.= createHiddenInput('primary_key_value', $primary_key_value);
			$html.= createHiddenInput('complete_location', $complete_location);
			$html.= createHiddenInput('cancel_location', $cancel_location);
			$html .= '<p><input class = "button" type="submit" name="submit" style="width:200px" value="Unlock Entry And Edit"/>';
			$html .= '<input class = "button" type="submit" name="cancel" style="width:200px"  value="Cancel and Return"/></p>';
			$html .='</form>';
			include (HEADER_FILE);
			echo $html;
			include (FOOTER_FILE);
			exit();
			//exit the code
		}
		else
		{
			//do nothing
		}
	}
	private function check_lockV2($table, $key_val_id)
	{
		$page_title = 'Locked';
		$entry_lock = get_entry_lock($this->connection_name,$table, $key_val_id);
		if( $entry_lock != 0)
		{
			
			//problem.... the entry is coded as locked.... this could be because someone is editing it, or a connection was lost and it needs to be unlocked.
			//ask for advice
			$form_handler = POS_ENGINE_URL .'/includes/php/entry_lock.php';
			$html = '<form id = "entry_lock" name="entry_lock" action="'. $form_handler. '" method="post" >';
			$html .= '<p>Problem! This Entry is Coded as LOCKED by ' . getUserFullName($entry_lock) .', meaning one of two things: 1) Another user is busy monkeying with the data, and if you go into it then you might destroy that fresh data, or 2) Somewhere along the way the entry was locked and then the user\'s session expired or a power failure or something else catastrophic happened, meaning you should use the unlock entry option. <br> Either way, make a choice to unlock the entry or leave it locked.</p>';
			//$html .= '<input type="checkbox" name="unlock" value="unlock">Unlock The Table';
			//$html .= '<br>';
			$primary_key_name = key($key_val_id);
			$primary_key_value = $key_val_id[$primary_key_name];
			$html.= createHiddenInput('table', $table);
			$html.= createHiddenInput('primary_key_name', $primary_key_name);
			$html.= createHiddenInput('primary_key_value', $primary_key_value);
			$html.= createHiddenInput('complete_location', $complete_location);
			$html.= createHiddenInput('cancel_location', $cancel_location);
			$html .= '<p><input class = "button" type="submit" name="submit" style="width:200px" value="Unlock Entry And Edit"/>';
			$html .= '<input class = "button" type="submit" name="cancel" style="width:200px"  value="Cancel and Return"/></p>';
			$html .='</form>';
			return $html;

			//exit the code
		}
		else
		{
			return false;
		}
	}

	//data converters
	private function switchArrayFromRowFieldToFieldRows($array)
	{
		$output = array();
		for($i=0;$i<sizeof($array);$i++)
		{
			foreach($array[$i] as $key => $value)
			{
				$output[$key][$i] = $array[$i][$key];
			}
		}
		return $output;
	}
	private function convert_mysql_result_to_field_row_array($result)
	{
		/*
		* This function will take a mysql result and convert it to a php array
		* access variables like this: array[0]['column_name'] if it is multdimensional
		*/
		$cntr = 0;
		$php_array_from_mysql = array();
		//if (mysql_num_rows($result) == 0) ? need to test for bunk result?
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
		{
			//this little sweet trick will dump the row to an array
			foreach($row as $key => $value)
			{
				$php_array_from_mysql[$key][$cntr] = $value;
				//echo '<p>' . $key . ': ' . $php_array_from_mysql[$cntr][$key]. '</p>';
			}
			$cntr++;
		}	
		return $php_array_from_mysql;
	}
	private function convert_mysql_result_to_array($result)
	{
		/*
		* This function will take a mysql result and convert it to a php array
		* access variables like this: array[0]['column_name'] if it is multdimensional
		*/
		$cntr = 0;
		$php_array_from_mysql = array();
		//if (mysql_num_rows($result) == 0) ? need to test for bunk result?
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
		{
			//this little sweet trick will dump the row to an array
			foreach($row as $key => $value)
			{
				$php_array_from_mysql[$cntr][$key] = $value;
				//echo '<p>' . $key . ': ' . $php_array_from_mysql[$cntr][$key]. '</p>';
			}
			$cntr++;
		}	
		return $php_array_from_mysql;
	}
	private function convert_mysql_data_to_indexed_array($data)
	{
		$php_array_from_mysql = array();
		for($row = 0;$row<sizeof($data);$row++)
		{
			foreach($data[$row] as $key => $value)
			{
				$php_array_from_mysql[$key][$row] = $value;
			}
		}	
		return $php_array_from_mysql;
	}
}
?>