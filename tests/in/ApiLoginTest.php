<?php

use Tests\ApiTester;
use App\Models\Tenant\User;

class ApiLoginTest extends ApiTester{

    /** @test */

    public function a_user_logs_in()
    {
        $this->json('POST', '/api/login', ['company' => 'Embrasse-Moi', 'username'=> 'admin',  'password' => 'secret'])
            ->assertStatus(200);
    }
    /** @test */
    public function a_user_enters_the_wrong_company_name()
    {
        $this->json('POST', '/api/login', ['company' => 'sdfghsdghjh', 'username'=> 'admin', 'password' => 'secret'])
            ->assertStatus(401);
    }
    /** @test */
    public function a_user_enters_the_wrong_username()
    {
        $this->json('POST', '/api/login', ['company' => 'Embrasse-Moi', 'username'=> 'asshole', 'password' => 'secret'])
            ->assertStatus(401);
    }
    /** @test */
    public function a_user_enters_the_wrong_password()
    {
        $this->json('POST', '/api/login', ['company' => 'Embrasse-Moi', 'username'=> 'admin',  'password' => 'sdfhsdfh'])
            ->assertStatus(401);
    }
    /** @test */
    public function sign_in()
    {
        $this->signIn();

    }
    /** @test */
    public function validate_the_token()
    {
        $this->signIn();
       


    }
//
//    /** @test */
//    public function a_user_can_see_the_dashboard()
//    {
//        $system = $this->getSystem();
//        $user = User::where('email','=', 'ci@embrasse-moi.com')->firstOrFail();
////        $token = JWTAuth::fromUser($user);
////        JWTAuth::setToken($token);
////        Auth::attempt(['username' => $user->username, 'password' => $user->password]);
//        $url = '/api/dashboard';
//
//        // Test unauthenticated access.
//        $this->get($url, $this->headers())
//            ->assertResponseStatus(400);
//
//        // Test authenticated access.
//        $this->get($url, $this->headers($user))
//            ->seeJson()
//            ->assertResponseOk();
//
//        // Test authenticated access.
//        $this->get($url, $this->headers($user))
//            ->seeJson()
//            ->assertResponseOk();
//
//
//
//    }
}