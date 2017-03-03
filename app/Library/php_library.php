<?php
//use Illuminate\Http\Request;
function hello_world()
{
    echo 'hello world';
    exit;
}
function getTenantDatabaseConnectionName()
{
    /*session_start();
    var_dump($_SESSION);
    if(session('db'))
    {
       // dd(Session::get('db'));
    }
    //dd(Session);*/
    $system_id = session('system_id');
    $system = App\Models\Craiglorious\System::find($system_id);
    if (!$system)
    {
        trigger_error('no system....');
        return false;
    }
    return $system->getDBC();
}
function createPassword(){
    $faker = \Faker\Factory::create();
    $my_rand_strng = substr(str_shuffle(passwordSymbols()), -1);
    $part1 = $faker->firstName;
    $part2 = $faker->randomNumber(4);
    $part3 = $my_rand_strng;
    $shuffle = $faker->shuffle([$part1,$part2,$part3]);
    $join = substr(str_shuffle("-:_"), -1);
    $password = implode($join,$shuffle);
    return $password;
}
function passwordSymbols()
{
    return '!@#$%&*+=';
}
function unique_random($table, $col, $chars = 16, $string_or_number = 'string'){

    $unique = false;

    // Store tested results in array to not test them again
    $tested = [];

    do{
        if($string_or_number == 'string'){
            $random = str_random($chars);
        }
        else{
            $random = '';
            for ($i = 0; $i<$chars; $i++)
            {
                $random .= mt_rand(0,9);
            }
        }

        if( in_array($random, $tested) ){
            continue;
        }
        $count = DB::table($table)->where($col, '=', $random)->count();
        // Store the random character in the tested array
        // To keep track which ones are already tested
        $tested[] = $random;

        // String appears to be unique
        if( $count == 0){
            // Set unique to true to break the loop
            $unique = true;
        }

        // If unique is still false at this point
        // it will just repeat all the steps until
        // it has generated a random string of characters

    }
    while(!$unique);
    return $random;
}
function checkHTTPS()
{
	if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "")
	{
   	 $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    	header("Location: $redirect");
    	exit();
	}
}
function addGetValue($url, $name, $value)
{
	$separator = "?";
	if (strpos($url,"?")!=false)
	{
  			$separator = "&";
  	}
	$newUrl = $url . $separator .$name . '=' .urlencode($value); 
	return $newUrl;
}
function header_redirect($url)
{
	header('Location: '. $url);
}
function curPageURL() 
{
	return urlencode(BASE_URL . $_SERVER['REQUEST_URI']);
 //$pageURL = 'http';
 //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
// $pageURL .= "://";
 //if ($_SERVER["SERVER_PORT"] != "80") {
 // $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 //} else {
 // $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 //}
 //return $pageURL;
}
function getDateTime()
{
	return date('Y:m:d H:i:s');
}
function getDateFromDatetime($date_time)
{
	$date_array=  date_parse($date_time);
	$year = $date_array['year'];
	$month = $date_array['month'];
	if(strlen($month)==1)$month="0".$month;
	$day = $date_array['day'];
	if(strlen($day)==1)$day="0".$day;
	$date_part =  $year .'-'.$month .'-'.$day;
	if ($date_part =='--')
	{
		return '';
	}
	else if($date_part =='0-0-0')
	{
		return '';
	}
	else
	{
		return $date_part;
	}
}
function getTimeFromDateTime($date_time)
{
	$date_array=  date_parse($date_time);
	$time =  $date_array['hour'] .':'.$date_array['minute'] .':'.$date_array['second'];
	return $time;
	/*if ($time =='::')
	{
		return '';
	}
	else
	{
		return $time;
	}*/
}
function removeKey($array)
{
	//pass in a single value array - just one key
	$new_array=array();
	$key = array_keys($array);
	for($i=0;$i<sizeof($array);$i++)
	{
		$new_array[$i] = $array[i][$key];
	}
	return $new_array;
}

function sanitizeFileName($dangerous_filename, $platform = 'Unix')
 {
        if (in_array(strtolower($platform), array('unix', 'linux'))) {
                // our list of "dangerous characters", add/remove characters if necessary
                $dangerous_characters = array(" ", '"', "'", "&", "/", "\\", "?", "#");
        }
        else {
                // no OS matched? return the original filename then...
                return $dangerous_filename;
        }

        // every forbidden character is replace by an underscore
        return str_replace($dangerous_characters, '_', $dangerous_filename);
    }
function sksort(&$array, $subkey="id", $sort_ascending=false) {
/*$info = array("peter" => array("age" => 21,
                                           "gender" => "male"
                                           ),
                   "john"  => array("age" => 19,
                                           "gender" => "male"
                                           ),
                   "mary" => array("age" => 20,
                                           "gender" => "female"
                                          )
                  );

sksort($info, "age");
var_dump($info);

sksort($info, "age", true);*/

    if (count($array))
        $temp_array[key($array)] = array_shift($array);

    foreach($array as $key => $val){
        $offset = 0;
        $found = false;
        foreach($temp_array as $tmp_key => $tmp_val)
        {
            if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
            {
                $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                                            array($key => $val),
                                            array_slice($temp_array,$offset)
                                          );
                $found = true;
            }
            $offset++;
        }
        if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
    }

    if ($sort_ascending) $array = array_reverse($temp_array);

    else $array = $temp_array;
}
//url cleaners
function slug($z){
    $z = strtolower($z);
    $z = preg_replace('/[^a-z0-9 -]+/', '', $z);
    $z = str_replace(' ', '-', $z);
    return trim($z, '-');
}
function slugify($text)
{
    // Swap out Non "Letters" with a -
    $text = preg_replace('/[^\\pL\d]+/u', '-', $text); 

    // Trim out extra -'s
    $text = trim($text, '-');

    // Convert letters that we have left to the closest ASCII representation
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // Make text lowercase
    $text = strtolower($text);

    // Strip out anything we haven't been able to convert
    $text = preg_replace('/[^-\w]+/', '', $text);

    return $text;
}
function toAscii($str) {
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

	return $clean;
}

?>