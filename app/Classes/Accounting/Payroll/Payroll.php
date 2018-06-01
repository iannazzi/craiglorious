<?php namespace App\Classes\Accounting\Payroll;

use App\Models\Tenant\CalendarEntry;

class Payroll
{
    public function __construct()
    {

    }

    public static function getEmployees( $from, $to){
        $entries = CalendarEntry::select('employee_id')->where('end', '>=', $from)
            ->distinct()
            ->where('end', '<=', $to)
            ->where('class_name', 'scheduled_shift')
            ->get()->toArray();
        return $entries;
    }
    public static function getEmployeeHours($employee_id, $from, $to)
    {
        $entries = CalendarEntry::where('end', '>=', $from)
            ->where('end', '<=', $to)
            ->where('class_name', 'scheduled_shift')
            ->where('employee_id',$employee_id)
            ->get();

        return $entries;
    }

    public static function findEmployeesWhoWorked($entries)
    {
        return false;
    }

    public static function calculateHours($empoyee_id, $from, $to)
    {

        $entries = self::getEmployeeHours($empoyee_id, $from, $to);
        //$employees = findEmployeesWhoWorked($entries);

        $hours = 0;
        foreach ($entries as $entry)
        {
            $hours +=  $entry->hours($from, $to);
        }
        return $hours;


        //return an array of employee_id => x hours => x
        //events can overlap midnight....
        //dd(CalendarEntry::all()->toArray());
        //we are actually looking at the end times to find the hours the employee was working at a date....
        //if the if the $from date shift crosses midnight, we will pull the hours from after midnight, not before

        $hours = 0;
        foreach ($entries as $entry)
        {
            $hours = $hours + $entry->hours();
        }

        return $hours;
    }

    public static function totalHours($from, $to){

        //could further break this down by location, department, etc
        $employees = self::getEmployees($from, $to);
        $total = 0;
        foreach($employees as $employee){
            $total += self::calculateHours($employee['employee_id'], $from, $to);
        }
        return $total;

    }
}

?>