<?php namespace App\Classes\Accounting\Payroll;

use App\Models\Tenant\CalendarEntry;

class Payroll
{
    public function __construct()
    {

    }

    public static function getEmployeeHours($from, $to)
    {
        $entries = CalendarEntry::where('end', '>=', $from)
            ->where('end', '<=', $to)
            ->where('class_name', 'scheduled_shift')
            ->get();

        return $entries;
    }

    public static function findEmployeesWhoWorked($entries)
    {
        return false;
    }

    public static function calculateHours($from, $to)
    {

        $entries = self::getEmployeeHours($from, $to);
        //$employees = findEmployeesWhoWorked($entries);

        $hours = 0;
        foreach ($entries as $entry)
        {
            $hours = $hours + $entry->hours($from, $to);
        }
        dd($hours);


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
}

?>