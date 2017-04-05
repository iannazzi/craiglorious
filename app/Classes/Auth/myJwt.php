<?php namespace App\Classes\Auth;

use Namshi\JOSE\SimpleJWS;
use \Firebase\JWT\JWT;
use Illuminate\Http\Request;


class myJwt
{
    public $secret_key;
    function __construct()
    {
        $this->secret_key = base64_decode(env('JWT_SECRET'));
    }
    //https://www.sitepoint.com/php-authorization-jwt-json-web-tokens/
    public function createFirebaseToken($user, $company, $unique_id)
    {
        $tokenId = base64_encode(random_bytes(32));
        $issuedAt = time();
        $notBefore = $issuedAt;             //Adding 0 seconds
        $expire = $notBefore + 60;            // Adding 60 seconds
        $serverName = 'notneeded'; // Retrieve the server name from config file Request::server('SERVER_NAME');

        /*
         * Create the token as an array
         */
        $data = [
            'iat' => $issuedAt,         // Issued at: time when the token was generated
            'jti' => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss' => $serverName,       // Issuer
            'nbf' => $notBefore,        // Not before
            'exp' => $expire,           // Expire
            'data' => [                  // Data related to the signer user
                'user_id' => $user->id, // userid from the users table
                'username' => $user->username, // User name
                'company' => $company,
                'unique_id' => $unique_id
            ]
        ];
        $token = JWT::encode(
            $data,      //Data to be encoded in the JWT
            $this->secret_key, // The signing key
            'HS512'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );

        return $token;

    }

    public function validateFirebaseToken($token)
    {
        try
        {
            return JWT::decode($token, $this->secret_key, array('HS512'));

        } catch (Exception $e)
        {
            /*
             * the token was not able to be decoded.
             * this is likely because the signature was not able to be verified (tampered token)
             */
            return false;
        }

    }

    public function getUniqueId($token){

        $token_data = $this->validateFirebaseToken($token);
    }
    public function checkExpiredToken(){
    }



//some other stuff not working....

    protected function authHeaderResponse()
    {
        // send the refreshed token back to the client
        //$response->headers->set('Authorization', 'Bearer '.$this->auth->refresh());
    }
    protected function createNamshiToken($user, $company)
    {

        $jws = new SimpleJWS(array(
            'alg' => 'RS256'
        ));
        $jws->setPayload(array(
            'uid' => $user->id,
            'company' => $company
        ));

        //do not understandy this...

        $privateKey = openssl_pkey_get_private("file://path/to/private.key", self::SSL_KEY_PASSPHRASE);

        $jws->sign($privateKey);

        //    setcookie('identity', $jws->getTokenString());

        return $jws->getTokenString();


    }
    protected function validateNamshiToken($token)
    {
        //$jws        = SimpleJWS::load($_COOKIE['identity']);

        $jws = SimpleJWS::load($token);
        $public_key = openssl_pkey_get_public("/path/to/public.key");

        // verify that the token is valid and had the same values
        // you emitted before while setting it as a cookie
        if ($jws->isValid($public_key, 'RS256'))
        {
            $payload = $jws->getPayload();

            echo sprintf("Hey, my JS app just did an action authenticated as user #%s", $payload['uid']);
        }
    }




}