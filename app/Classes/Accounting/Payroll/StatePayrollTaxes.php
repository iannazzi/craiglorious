<?php namespace App\Classes\Accounting\Payroll;


class StatePayrollTaxes
{
    public static function getWithholdingAllowance($single, $withholding_allowance){
        if ($single)
        {
            $table_2a = [284.6, 323.1, 361.6, 400.1, 438.6, 477.1, 515.6, 554.1, 592.6, 631.1, 669.6];

        } else
        {
            $table_2a = [305.8, 344.3, 382.8, 421.3, 459.8, 498.3, 536.8, 575.3, 613.8, 652.3, 690.8];
        }
        if($withholding_allowance > (sizeof($table_2a)-1)){
            return -1;
        }
        else{
            $allowance = $table_2a[ $withholding_allowance ];
            return $allowance;

        }


    }
    public static function calculateWithholding($year, $state, $pay, $single, $withholding_allowance)
    {
        //if ($year == '2018')
        if (1)
        {
            if (strtoupper($state) == 'NY')
            {

                $table_2b = [
                    [0.00, 327.00, 0.00, 0.04, 0.00],
                    [327, 450, 327, 0.045, 13.08],
                    [450, 535, 450, 0.0525, 18.62],
                    [535, 823, 535, 0.059, 23.08],
                    [823, 3102, 823, 0.0633, 40.08],
                    [3102, 3723, 3102, 0.0657, 187.08],
                    [3723, 4140, 3723, 0.0758, 228.38],
                    [4140, 6213, 4140, 0.0808, 260],
                    [6213, 8285, 6213, 0.0707, 427.5],
                    [8285, 10358, 8285, 0.0856, 575.58],
                    [10358, 41444, 10358, 0.0735, 744.54],
                    [41444, 43519, 41444, 0.52, 3029.42]
                ];
                $allowance = self::getWithholdingAllowance($single, $withholding_allowance);
                if($allowance == -1){
                    return 'error withholding allowance is greater than nys allowance table';
                }
                $pay_subject_to_withholding = $pay - $allowance;
                $index = self::getTableIndex($table_2b, $pay_subject_to_withholding);
                $withholding = self::calculateTableValue($table_2b, $pay_subject_to_withholding, $index);
                return $withholding;
            }
        }
    }

    public static function calculateTableValue($table, $pay, $index)
    {
        if($index == -1){
            return 0;
        }
        else{
            return ($pay - $table[ $index ][2]) * ($table[ $index ][3]) + $table[ $index ][4];
        }
    }
    public static function getTableIndex($table, $pay)
    {
        //test the ends of the table first, less than 0 and greater than the greatest....
        if ($pay <= $table[0][0])
        {
            return -1;
        } else if ($pay > $table[ sizeof($table) - 1 ][0])
        {
            return sizeof($table) - 1;
        } else
        {
            for ($i = 0; $i < sizeof($table) - 1; $i ++)
            {
                if ($pay >= $table[ $i ][0] && $pay < $table[ $i ][1])
                {
                    return $i;
                }
            }
        }

    }

    public static function unEmploymentTaxRate($year)
    {
        return 1.625;
    }

    public static function reEmploymentTaxRate($year)
    {
        return .075;
    }

    public static function excessRenumerationRate($year)
    {
        return 10900;
    }
}