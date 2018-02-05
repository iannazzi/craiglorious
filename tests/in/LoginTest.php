<?php

use Tests\ApiTester;
use App\Models\Tenant\User;
use \Firebase\JWT\JWT;

class LoginTest extends ApiTester{

    /** @test */

    public function a_user_logs_in()
    {
        $this->json('POST', $this->api('login'), ['company' => 'demo', 'username'=> 'admin',  'password' => 'secret'])
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
        $this->json('POST', $this->api('login'), ['company' => 'demo', 'username'=> 'asshole', 'password' => 'secret'])
            ->assertStatus(401);
    }
    /** @test */
    public function a_user_enters_the_wrong_password()
    {
        $this->json('POST', $this->api('login'), ['company' => 'demo', 'username'=> 'admin',  'password' => 'sdfhsdfh'])
            ->assertStatus(401);
    }

    /** @test */
    public function validate_the_token()
    {

        $this->signIn('admin','secret','demo');
        $url = $this->api('verify');

        $this->get($url, $this->headers())
            ->assertStatus(200);

    }
    /** @test */
    public function craigsocket()
    {

        $this->signIn('admin','secret','demo');
        $url = $this->api('craigsocket');

        $this->get($url, $this->headers())
            ->assertStatus(200);

    }
    /** @test */
    public function a_user_can_see_the_dashboard()
    {
        $this->signIn('admin','secret','demo');

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
        $this->signIn('admin','secret','demo');

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
        $this->signIn('owner','secret','demo');

        $url = $this->api('roles');


        // Test unauthenticated access.
        $this->get($url)
            ->assertStatus(401);

        // Test authenticated access.
        $this->get($url, $this->headers())
            ->assertStatus(401);

    }


}