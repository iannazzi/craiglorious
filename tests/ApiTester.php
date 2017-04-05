<?php
namespace Tests;
use App\Models\Craiglorious\System;
use Faker\Factory as Faker;
use Artisan;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


abstract class ApiTester extends TestCase {

    /**
     * @var Faker
     */
    protected $fake;
    protected $faker;
    protected $output;

    /**
     * Initialize
     */
    function __construct()
    {
        parent::__construct();
        $this->fake = Faker::create();
        $this->faker = Faker::create();
    }
    public function signIn($data=['username'=>'admin', 'password'=>'secret', 'company'=>'Embrasse-moi'])
    {
        $response = $this->post('/api/login', $data);
        $system = $this->getSystem();

        $content = json_decode($response->getContent());

        $this->assertObjectHasAttribute('token', $content, 'Token does not exists');
        $this->token = $content->token;

        return $this;
    }
    protected function headers(){
        $headers['Authorization'] = 'Bearer '.$this->token;
        return $headers;
    }
//    protected function headers($user = null)
//    {
//        $headers = ['Accept' => 'application/json'];
//        $system = $this->getSystem();
//        $customClaims = ['company' => $system->company, 'system' => $system->id];
//
//        if (!is_null($user)) {
//            $token = JWTAuth::fromUser($user, $customClaims);
//            JWTAuth::setToken($token);
//            $headers['Authorization'] = 'Bearer '.$token;
//        }
//
//        return $headers;
//    }
    function getSystem()
    {
        $system = System::first();
        $system->createTenantConnection();
//        dd($system->company);
        return $system;
    }
    
    public function writeMethod($method_name)
    {
        fwrite(STDOUT, $method_name . "\n");
    }

    /**
     * Setup database for each test
     */

    public function setUp()
    {
        parent::setUp();
    }

    protected function assertPreConditions()
    {
        //$this->createEM();
        //fwrite(STDOUT, __METHOD__ . "\n");
    }


    public static function setUpBeforeClass()
    {
        //self::createEM();
        //fwrite(STDOUT, __CLASS__ . "\n");

        //fwrite(STDOUT, __METHOD__ . "\n");
    }

    protected function assertPostConditions()
    {
        //fwrite(STDOUT, __METHOD__ . "\n");
    }

    public function tearDown()
    {
       // fwrite(STDOUT, __METHOD__ . "\n");
    }

    public static function tearDownAfterClass()
    {
        //fwrite(STDOUT, __METHOD__ . "\n");
    }







    /**
     * Get JSON output from API
     *
     * @param        $uri
     * @param string $method
     * @param array  $parameters
     * @return mixed
     */
//    public function getJson($uri, $method = 'GET', $parameters = [])
//    {
//        return json_decode($this->call($method, $uri, $parameters)->getContent());
//    }
    public function postRawJson($uri, $rawContent = null, array $data = [], array $headers = [] )
    {
        $server = $this->transformHeadersToServerVars($headers);

        $this->call('POST', $uri, $data, [], [], $server, $rawContent);

        return $this;
    }

    /**
     * Assert object has any number of attributes
     *
     */
    protected function assertObjectHasAttributes()
    {
        $args = func_get_args();
        $object = array_shift($args);

        foreach ($args as $attribute)
        {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }

}