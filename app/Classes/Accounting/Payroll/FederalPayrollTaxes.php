<?php namespace App\Classes\Accounting\Payroll;


class FederalPayrollTaxes
{

    public static function calculateEmployeeFicaTax($year, $pay)
    {
        $fica = self::FICARate($year);

        return $pay * ($fica->employee/100);
    }

    public static function FICARate($year)
    {
        return (object) ['employee' => 6.2, 'employer' => 6.2];
    }

    public static function medicaideRate($year)
    {
        return (object) ['employee' => 1.45, 'employer' => 1.45];
    }

    public static function calculateEmployeeMedicaideTax($year, $pay)
    {
        $rate = self::medicaideRate($year);

        return ($rate->employee/100) * $pay;
    }

    public static function calculateWithholding($year, $pay, $single, $withholding_allowance)
    {

        //return eval('WithholdingTax' . $year . '($year, $pay, $single, $withholding_allowance)');

        return self::WithholdingTax2017($pay, $single, $withholding_allowance);
//        $function_name = 'WithholdingTax' . $year;
//
//        call_user_func(array(self, $function_name, $year, $pay, $single, $withholding_allowance));



//        if ($year == '2018')
//        {
//
//        }
//        if ($year == '2017')
//        {
//
//        }
    }

    public static function WithholdingTax2019($year, $pay, $single, $withholding_allowance)
    {
        return WithholdingTax2018($year, $pay, $single, $withholding_allowance);
    }

    public static function WithholdingTax2018($pay, $single, $withholding_allowance)
    {
        //side note i never updated this in my spreadsheet
        $one_withholding_allowance = 159.6;
        //withholding columns are like this....
        //over not over $ %
        if ($single)
        {
            $table = [
                [142, 509, 0, 10],
                [509, 1631, 37.6, 12],
                [1631, 3315, 171.34, 22],
                [3315, 6200, 541.82, 24],
                [6200, 7835, 1234.22, 32],
                [7835, 19373, 1757.42, 32],
                [19373, false, 5795.72, 37],
            ];

        } else //married
        {
            $table = [
                [444, 1177, 0, 10, 333],
                [1177, 3421, 73.3, 12, 1050],
                [3421, 6790, 342.58, 22, 3252],
                [6790, 12560, 1083.76, 24, 3252],
                [12560, 15829, 2468.56, 32, 3252],
                [15829, 23521, 3514.64, 35, 3252],
                [23521, false, 6206.84, 37, 3252],
            ];

        }

        $allowance = $one_withholding_allowance * $withholding_allowance;
        $pay_subject_to_withholding = $pay - $allowance;
        return self::calculateTableValue($table, $pay_subject_to_withholding);

    }



    public static function WithholdingTax2017($pay, $single, $withholding_allowance)
    {
        //biweekley only
        $one_withholding_allowance = 155.8;
        //withholding columns are like this....
        //over not over $ %
        if ($single)
        {
            $table = [
                [88, 447, 0, 10],
                [447, 1548, 35.9, 15],
                [1548, 3623, 201.05, 25],
                [3623, 7460, 719.8, 28]
            ];

        } else //married
        {
            $table = [
                [333, 1050, 0, 10],
                [1050, 3252, 71.7, 15],
                [3252, 6221, 402, 25]
            ];

        }

        $allowance = $one_withholding_allowance * $withholding_allowance;
        $pay_subject_to_withholding = $pay - $allowance;
        return self::calculateTableValue($table, $pay_subject_to_withholding);



    }

    public static function calculateTableValue($table, $pay)
    {
        //if it is less than the first return
        if ($pay < $table[0][0])
        {
            return 0;
        }
        else if ($pay > $table[ sizeof($table) - 1 ][0])
        {
            return $pay * ($table[ sizeof($table) - 1 ][3] / 100) + $table[ sizeof($table) - 1 ][2];
        }
        else
        {
            for ($i = 0; $i < sizeof($table); $i ++)
            {
                if ($pay > $table[ $i ][0] && $pay <= $table[ $i ][1])
                {
                    return $pay * ($table[ $i ][3] / 100) + $table[ $i ][2];
                }
            }
        }

    }
}