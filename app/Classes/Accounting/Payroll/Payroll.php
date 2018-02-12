<?php namespace App\Classes\Accounting\Payroll;
class Payroll {
    public function __construct(){

    }
    public function calculateHours($from, $to, $entries)
    {
        //events can overlap midnight....


        $hours = 0;
        foreach($entries as $entry){
            $hours = $hours + $entry->hours();
        }
        return $hours;
    }
}
?>