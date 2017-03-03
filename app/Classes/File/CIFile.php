<?php
namespace App\Classes\File;
use Illuminate\Filesystem\Filesystem;
class CIFile
{
	protected $files;

	public function __construct()
	{
		$this->files = new Filesystem();
	}
	public function MYSQLArrayToCSVReadyArray($mysql_array)
	{
		//$mysql_array[0]['pos_product_id'] = 17 etc....
		$csv_ready_array = array();
		$counter = 0;
		foreach($mysql_array[0] as $key => $value)
		{
			$csv_ready_array[0][$counter] = $key;
			$counter++;
		}
		$counter = 0;
		for($i=0;$i<sizeof($mysql_array);$i++)
		{
			foreach($mysql_array[$i] as $value)
			{
				$csv_ready_array[$i+1][$counter] = $value;
				$counter++;
			}
		}
		return $csv_ready_array;
	}
	public function arrayToCsvDownload($filename, $array, $delimiter = "\t")
	{
		//this will give you the popup save as box. Outputs 2-d to tab separated
		header("Content-type: text/csv");   
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		$outstream = fopen("php://output",'w'); 
		foreach($array[0] as $key => $value)
		{
			$header[] = $key;
		}
		fputcsv($outstream, $header, $delimiter); 
		foreach( $array as $row )  
		{  
		    fputcsv($outstream, $row, $delimiter);  
		} 
		fclose($outstream);
	}
	public function csv_to_array($filename='', $delimiter=',')
	{

		if(!file_exists($filename) || !is_readable($filename))
			return FALSE;
		
		$header = NULL;
		$data = array();
		if (($handle = fopen($filename, 'r')) !== FALSE)
		{
			while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
			{
				if(!$header)
					$header = $row;
				else
					$data[] = array_combine($header, $row);

			}
			fclose($handle);
		}
		return $data;
	}
	public function arrayToCSVFile($filepath, $array, $delimiter = ";", $save_keys=false, $header = true )
	{
		$content = '';
	    reset($array);
	    foreach($array[0] as $key1 => $value)
		{
			$headers[] = $key1;
		}
		if($header) {
			if ($save_keys){ $content .= $delimiter; }
			$content .= (is_array($headers)) ? implode($delimiter, $headers) : $headers;
			$content .= "\n";
		}
		reset($array);
	    while(list($key, $val) = each($array))
	    {
	        // replace tabs in keys and values to [space]
	        $key = str_replace("\t", " ", $key);
	        $val = str_replace("\t", " ", $val);
	 
	        if ($save_keys){ $content .=  ($key+1).$delimiter; }
	 
	        // create line:
	        $content .= (is_array($val)) ? implode($delimiter, $val) : $val;
	        $content .= "\n";
	    }
	 	$this->makeDirectory($filepath);
	    if ($fp = fopen($filepath, 'w+'))
	    {
	        fwrite($fp, $content);
	        fclose($fp);
	        return true;
	    }
	    else 
	    { 
	   		 dd('Hmmmmmmmm.... no file path?');
	    }
	    
	}
	public function makeDirectory($path)
	{
		if ( ! $this->files->isDirectory(dirname($path)))
		{
			$this->files->makeDirectory(dirname($path), 0777, true, true);
		}
	}
	public function fileUploadHandler($posted_name, $target_path)
	{
			makeDir($target_path);
			//posted name comes from the name tag of the input box
			//$ target path: UPLOAD_FILE_PATH .'/uploads' etc..
			if ($_FILES[$posted_name]["error"] > 0)
			{
				trigger_error( "Error: " . $_FILES[$file_name]["error"] . "<br />");
				exit();
			}
			else
			{
				//echo "Upload: " .  . "<br />";
				//echo "Type: " . $_FILES["image_file_name"]["type"] . "<br />";
				//echo "Size: " . ($_FILES["image_file_name"]["size"] / 1024) . " Kb<br />";
				//echo "Stored in: " . $_FILES["image_file_name"]["tmp_name"];
				
			}
			$file_name = sanitizeFileName($_FILES[$posted_name]["name"]);
			$file_name_and_path = $target_path .'/'. sanitizeFileName(basename( $_FILES[$posted_name]['name'])); 
			if(move_uploaded_file($_FILES[$posted_name]['tmp_name'], $file_name_and_path)) 
			{
				//echo "<p>The file ".  basename( $_FILES['image_file_name']['name']). " has been uploaded</p>";
				$file['name'] = sanitizeFileName($_FILES[$posted_name]["name"]);
				$file['type'] = $_FILES[$posted_name]["type"];
				$file['size'] = $_FILES[$posted_name]["size"];
				$file['path'] = $file_name_and_path;
				
			} 
			else
			{
				trigger_error( "There was an error uploading the file, please try again!");
				exit();
			}		
			return $file;

	}
	public function getFILEPostData($post_name_for_file, $upload_folder)
	{
		if (isset($_FILES[$post_name_for_file]['size']) && $_FILES[$post_name_for_file]['size'] > 0)
		{
			$file_array = fileUploadHandler($post_name_for_file, $upload_folder);
			
			//$fileName = $_FILES[$post_name_for_file]['name'];
			//$tmpName  = $_FILES[$post_name_for_file]['tmp_name'];
			//$fileSize = $_FILES[$post_name_for_file]['size'];
			//$fileType = $_FILES[$post_name_for_file]['type'];
			
			$fp = fopen($file_array['path'], 'r');
			$content = fread($fp, filesize($file_array['path']));
			$content = addslashes($content);
			fclose($fp);
			if(!get_magic_quotes_gpc())
			{
				$file_array['name'] = addslashes($file_array['name']);
			}
			$file_data['file_name'] = $file_array['name'];
			$file_data['file_type'] = $file_array['type'];
			$file_data['file_size'] = $file_array['size'];
			$file_data['binary_content'] = $content;
			return $file_data;
		}	
		else
		{
			return false;
		}
	}

}


?>