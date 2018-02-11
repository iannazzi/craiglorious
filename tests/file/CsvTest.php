<?php


use Tests\ApiTester;
use App\Classes\File\CIFile;

class CsvTest extends ApiTester
{

    /** @test */
    function load_employee_csv_file_to_array()
    {
        $system = $this->getSystem();
        $cifile = new CIFile();

        $file=  em_data_seed_path()."/employees.csv";

        $array = $cifile->csvToArray($file);

        $this->assertNotNull($array);

        $path = base_path() . '/tests/File/tmpData';
        $filename = $path . '/tmp.csv';

        $file = new CIFile();
        $file->makeDirectory($filename);
        $this->assertDirectoryExists($path);
        $file->deleteDirectory($path);
        $this->assertDirectoryNotExists($path);

        //why no file?
        $file->arrayToCSVFile($filename, $array, ';', false, true);
        $this->assertFileExists($filename);

        $file->deleteFile($filename);
        $this->assertFileNotExists($filename);
        $file->deleteDirectory($path);
        $this->assertDirectoryNotExists($path);






    }





}