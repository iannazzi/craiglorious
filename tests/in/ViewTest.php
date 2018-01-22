<?php


use App\Models\Craiglorious\View;
use Tests\ApiTester;


class ViewTest extends ApiTester
{




    /** @test */
    function we_have_views()
    {
        dd(View::views());
    }










}