<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;


class StatePayrollTax extends BaseCraigloriousModel
{


    protected $guarded = ['id'];

    function WitholdingTax($year, $state, $pay, $single, $withholding_allowance)
    {
        if ($year == '2018')
        {
            if (strtoupper($state) == 'NY')
            {
                if ($single)
                {
                    $table_2a = [284.6, 323.1, 361.6, 400.1, 438.6, 477.1, 515.6, 554.1, 592.6, 631.1, 669.6];

                } else
                {
                    $table_2a = [305.8, 344.3, 382.8, 421.3, 459.8, 498.3, 536.8, 575.3, 613.8, 652.3, 690.8];
                }
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


            }
        }
    }

}