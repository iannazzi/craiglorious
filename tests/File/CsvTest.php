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

        $file= database_path("seeds/tenant/EmbrasseMoi/DataGitIgnore/employees.csv");

        $array = $cifile->csvToArray($file);

        $this->assertNotNull($array);
    }




}