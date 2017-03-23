<?php

namespace Api\Controllers;
use Illuminate\Support\Facades\Auth;

use App\User;
use Dingo\Api\Facade\API;
use Illuminate\Http\Request;
use Api\Requests\UserRequest;
use Api\Requests\RegistrationRequest;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Craiglorious\System;
use App\Classes\TenantSystem\TenantSystemBuilder;

class AuthController extends BaseController
{
    public function me(Request $request)
    {
        $payload = JWTAuth::parseToken()->getPayload();
        $system = System::where('company', '=', $payload['company'])->first();
        if(!$system)
        {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        $system->createTenantConnection();

        return JWTAuth::parseToken()->authenticate();
    }

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        // will it be username or email?
        $credentials = $request->only('username', 'password');
        $company = $request->only('company');
        $system = System::where('company', '=', $company['company'])->first();

        if(!$system)
        {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        $system->createTenantConnection();
        $customClaims = ['company' => $company['company'], 'system' => $system->id];

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials, $customClaims)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        //get the jobs available for the user
        $user = Auth::user();
        $jobs = $user->getJobs();

        // all good so return the token
        return response()->json(compact('token', 'jobs'));
    }

    public function validateToken() 
    {
        // Our routes file should have already authenticated this token, so we just return success here
        //dd(JWTAuth::parseToken());
        return API::response()->array(['status' => 'success'])->statusCode(200);
    }

    public function register(RegistrationRequest $request)
    {
//        $new_system = $request->only(['company', 'email', 'password']);
     //dd($request->company);

        $system = new System();
        $system->company = $request->company;
        $system->name = $request->name;
        $system->email= $request->email;
        $system->password = bcrypt($request->password);
        $system->save();


        $tenantSystemBuilder = new TenantSystemBuilder($system);
        //$tenantSystemBuilder->deleteSystem();
        $tenantSystemBuilder->setupTenantSystem();
        $system->createTenantConnection();


        $user = User::first();
        $user = User::where('username','=', 'admin')->firstOrFail();

        $customClaims = ['company' => $system->company, 'system' => $system->id];

        $token = JWTAuth::fromUser($user,$customClaims);

        return response()->json(compact('token'));
    }
    /**
     * Returns the authenticated user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticatedUser(Request $request)
    {
//        die(var_dump($request->header()));
//        $token = JWTAuth::getToken();
//        dd('token' . $token);
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }
    /**
     * Refresh the token
     *z
     * @return mixed
     */
    public function getToken()
    {
        $token = JWTAuth::getToken();
        if (!$token) {
            return $this->response->errorMethodNotAllowed('Token not provided');
        }
        try {
            $refreshedToken = JWTAuth::refresh($token);
        } catch (JWTException $e) {
            return $this->response->errorInternal('Not able to refresh Token');
        }
        return $this->response->withArray(['token' => $refreshedToken]);
    }
}