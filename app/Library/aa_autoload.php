<?php 

$baseDir = dirname(__FILE__);
$files = [];


if ($handle = opendir(dirname(__FILE__))) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != ".." && $entry != 'aa_autoload.php' && $entry != '.DS_Store') {

            $files[] = $entry;
        }
    }

    closedir($handle);
}
//dd($files);

for($i=0;$i<sizeof($files);$i++){

	require_once($baseDir . '/' . $files[$i]);

}

?>