<?php namespace  App\Models\Craiglorious;
use App\Models\BaseCraigloriousModel;


class FederalPayrollTax extends BaseCraigloriousModel {


    protected $guarded = ['id'];


    function WithholdingTax($year, $pay, $single, $withholding_allowance)
    {
        if ($year == '2018')
        {
            //biweekley only
            $one_witholding_allowance = 159.6;
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
            return (object) ['one_withholding_allowance' => $one_witholding_allowance, 'table' => $table];

        }
        //side note i never updated this in my spreadsheet
        if ($year == '2017')
        {
            //biweekley only
            $one_witholding_allowance = 155.8;
            //withholding columns are like this....
            //over not over $ %
            if ($single)
            {
                $table = [
                    [0, 88, 0, 0],
                    [88, 447, 0, 10],
                    [447, 1548, 35.9, 15],
                    [1548, 3623, 201.05, 25],
                    [3623, 7460, 719.8, 28]
                ];

            } else //married
            {
                $table = [
                    [0, 333, 0, 0, 0],
                    [333, 1050, 0, 10, 333],
                    [1050, 3252, 71.7, 15, 1050],
                    [3252, 6221, 402, 25, 3252]
                ];

            }
            return (object) ['one_withholding_allowance' => $one_witholding_allowance, 'table' => $table];

        }
    }

}