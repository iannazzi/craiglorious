<?php

use Tests\ApiTester;
use App\Models\Tenant\User;
use \Firebase\JWT\JWT;

class LoginTest extends ApiTester{

    /** @test */

    public function a_user_logs_in()
    {
        $this->json('POST', $this->api('login'), ['company' => 'Embrasse-Moi', 'username'=> 'admin',  'password' => 'secret'])
//            ->dump()
            ->assertStatus(200);
    }
    /** @test */
    public function a_user_enters_the_wrong_company_name()
    {
        $this->json('POST', $this->api('login'), ['company' => 'sdfghsdghjh', 'username'=> 'admin', 'password' => 'secret'])
            ->assertStatus(401);
    }
    /** @test */
    public function a_user_enters_the_wrong_username()
    {
        $this->json('POST', $this->api('login'), ['company' => 'Embrasse-Moi', 'username'=> 'asshole', 'password' => 'secret'])
            ->assertStatus(401);
    }
    /** @test */
    public function a_user_enters_the_wrong_password()
    {
        $this->json('POST', $this->api('login'), ['company' => 'Embrasse-Moi', 'username'=> 'admin',  'password' => 'sdfhsdfh'])
            ->assertStatus(401);
    }
    /** @test */
    public function sign_in()
    {
        $this->signIn();

    }
    /** @test */
    public function test_JWT()
    {
//        $key = "example_key";
//        $token = array(
//            "iss" => "http://example.org",
//            "aud" => "http://example.com",
//            "iat" => 1356999524,
//            "nbf" => 1357000000
//        );
//        $jwt = JWT::encode($token, $key);
//        $decoded = JWT::decode($jwt, $key, array('HS256'));
//        print_r($jwt);
//        print_r($decoded);

    }

    /** @test */
    public function validate_the_token()
    {

        $this->signIn();
        $url = $this->api('auth');

        $this->get($url, $this->headers())
            ->assertStatus(200);

    }
    /** @test */
    public function a_user_can_see_the_dashboard()
    {
        $this->signIn();

        $url = $this->api('dashboard');


        // Test unauthenticated access.
        $this->get($url)
            ->assertStatus(401);

        // Test authenticated access.
        $this->get($url, $this->headers())
            ->assertStatus(200);

    }
    /** @test */
    public function user_can_see_roles()
    {
        $this->signIn();

        $url = $this->api('roles');


        // Test unauthenticated access.
        $this->get($url)
            ->assertStatus(401);

        // Test authenticated access.
        $this->get($url, $this->headers())
            ->assertStatus(200);

    }
    /** @test */
    public function owner_cannot_see_roles()
    {
        $this->signIn('owner');

        $url = $this->api('roles');


        // Test unauthenticated access.
        $this->get($url)
            ->assertStatus(401);

        // Test authenticated access.
        $this->get($url, $this->headers())
            ->assertStatus(401);

    }


}