<?php
use IannazziTestLibrary\Tests\ApiTester;
use App\Models\Tenant\User;

class ApiTest2 extends ApiTester{


    /** @test */
    function check_protected_route()
    {
        $system = $this->getSystem();
        $user = User::where('email','=', 'ci@embrasse-moi.com')->firstOrFail();
        //$this->post('/api/authenticatedUser', $this->headers($user))
        //   ->see('{"error":"invalid_credentials"}');
        //->seeStatusCode(200);

//        $res = $this->get('/api/user', ['name' => 'peache'], $this->headers($user));

        $res = $this->post('/api/dogs', ['name' => 'peache'], $this->headers($user));
        $res->seeStatusCode(200);

        $this->post('/api/getToken', $this->headers($user))
            ->see('"token"');


    }
    /** @test */
    function check_dashboard_route()
    {
        $system = $this->getSystem();
        $user = User::where('email','=', 'ci@embrasse-moi.com')->firstOrFail();
        $this->get('/api/dashboard', $this->headers($user))
            ->see('binders');
        $this->get('/api/validate_token', $this->headers($user))
            ->see('"success"');


    }

}