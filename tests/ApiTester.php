<?php
namespace Tests;
use Symfony\Component\Console\Output\ConsoleOutput;
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
    protected $token;

    /**
     * Initialize
     */
    function __construct()
    {
        parent::__construct();
        $this->fake = Faker::create();
        $this->faker = Faker::create();
    }
    public function console($msg)
    {
        $out = new ConsoleOutput();
        $out->writeln($msg);
    }
    public function signIn($username= 'admin', $password='secret', $company='demo')
    {

        $data=['username'=>$username, 'password'=>$password, 'company'=>$company];
        $response = $this->post('/api/login', $data);
        $system = $this->getSystem();
        $content = json_decode($response->getContent());
        //$this->assertObjectHasAttribute('token', $content, 'Token does not exists');
        $this->token = $content->token;

        return $this;
    }
    protected function headers(){
        $headers['Authorization'] = 'Bearer '. $this->token;
        return $headers;
    }
    public function api($route){
        return '/api/' . $route;

    }
    function getSystem($company = 'test')
    {
        $system = System::where('company', $company)->first();
        $system->createTenantConnection();
        return $system;
    }

    public function indexSuccess($route){
        $this->signIn();
        $rawContent='{}';
        $this->json('GET', $this->api($route), json_decode($rawContent, true),$this->headers())
            ->assertJson(["success"=>'true']);
    }
    public function searchSuccess($route, $rawContent){
        $this->signIn();
        $this->json('POST', $this->api($route . '/search'), json_decode($rawContent, true),$this->headers())
            ->assertJson(["success"=>'true']);
    }
    public function createSuccess($route, $rawContent){
        $this->signIn();
        $this->json('PUT', $this->api($route), json_decode($rawContent, true),$this->headers())
            ->assertJson(["success"=>'true']);
    }
    public function showSuccess($route, $id){
        $this->signIn();
        $rawContent='{}';
        $this->json('GET', $this->api($route).'/'.$id, json_decode($rawContent, true),$this->headers())
            ->assertJson(["success"=>'true']);
    }
    public function updateSuccess($route, $rawContent,$success='true'){
        $this->signIn();
        $this->json('PUT', $this->api($route), json_decode($rawContent, true),$this->headers())
            ->assertJson(["success"=>$success]);
    }
    public function deleteSuccess($route, $rawContent, $success='true'){
        $this->signIn();
        $this->json('DELETE', $this->api($route), json_decode($rawContent, true),$this->headers())
            ->assertJson(["success"=>$success]);
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