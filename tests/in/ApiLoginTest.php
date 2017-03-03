<?php

use IannazziTestLibrary\Tests\ApiTester;
use App\Models\Tenant\User;

class LoginTest extends ApiTester{

    /** @test */
    function check_if_server_is_running()
    {
        //post to the api a user name and password.....

        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->status());

    }
    /** @test */
    public function a_user_enters_the_wrong_company_name()
    {
        $this->json('POST', '/api/login', ['company' => 'sdfghsdghjh', 'username'=> 'admin', 'email' => 'ci@embrasse-moi.com', 'password' => 'iluv2tow'])
            ->see('{"error":');

    }
    /** @test */
    public function a_user_enters_the_wrong_username_or_email()
    {
        $this->json('POST', '/api/login', ['company' => 'Embrasse-Moi', 'username'=> 'asshole', 'email' => 'sdfgfdsgsdfg', 'password' => 'iluv2tow'])
            ->see('{"error":"invalid_credentials"}');
    }
    /** @test */
    public function a_user_enters_the_wrong_password()
    {
        $this->json('POST', '/api/login', ['company' => 'Embrasse-Moi', 'username'=> 'admin', 'email' => 'ci@embrasse-moi.com', 'password' => 'sdfhsdfh'])
            ->see('{"error":"invalid_credentials"}');
    }
    /** @test */
    public function a_user_logs_in()
    {
        $this->json('POST', '/api/login', ['company' => 'Embrasse-Moi', 'username'=> 'admin', 'email' => 'ci@embrasse-moi.com', 'password' => 'iluv2tow'])
            ->see('token');
       // $this->json('POST', '/api/login', ['company' => 'Embrasse-Moi', 'email' => 'ci@embrasse-moi.com', 'password' => 'iluv2tow'])
        //    ->seeJsonStructure(['token']);
    }
    /** @test */
    public function a_user_can_see_the_dashboard()
    {
        $system = $this->getSystem();
        $user = User::where('email','=', 'ci@embrasse-moi.com')->firstOrFail();
//        $token = JWTAuth::fromUser($user);
//        JWTAuth::setToken($token);
//        Auth::attempt(['username' => $user->username, 'password' => $user->password]);
        $url = '/api/dashboard';

        // Test unauthenticated access.
        $this->get($url, $this->headers())
            ->assertResponseStatus(400);

        // Test authenticated access.
        $this->get($url, $this->headers($user))
            ->seeJson()
            ->assertResponseOk();

        // Test authenticated access.
        $this->get($url, $this->headers($user))
            ->seeJson()
            ->assertResponseOk();



    }
}