<?php
use Tests\ApiTester;

class LogoutTest extends ApiTester
{
    /** @test */
    function logout()
    {

        $r = $this->post('/auth/logout', ['name' => 'Sally']);
//        dd($r);
            $r->assertRedirect('/auth/login');
    }

}