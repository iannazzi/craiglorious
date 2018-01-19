<?php

namespace App\Http\Controllers\Auth;

use App\Mail\RegistrationEmailConfirmation;
use App\Http\Controllers\Controller;

use App\Models\Craiglorious\System;
use App\Classes\Registration\RegisterTenant;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    public function postRegister(Request $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['password'] = $request->password;
        $data['password_confirmation'] = $request->password_confirmation;
        $data['company'] = $request->company;
        $data['email'] = $request->email;


        //VALIDATE FIRST

        $rules = array(
//            'company' => 'required|unique:systems',
            'email' => 'required|email',
            'name' => 'required|max:40|min:6',
            'password' => $this->passwordRules(),
        );

        $validation = \Validator::make($data, $rules);
        if ($validation->passes())
        {
            //create the system
            $system  = RegisterTenant::register($data);
            RegisterTenant::buildSystem($system);

            $system->createTenantConnection();
            return response()->json([
                'success' => true,
                'message' => 'system created',
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => $validation->errors()
        ], 422);






    }
    public function registrationConfirmation($to, $data){
        \Mail::to($to)->send(new RegistrationEmailConfirmation($data));
    }
    public function passwordRules(){
        return ['required',
            'min:8',
            //'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d])(?=.*['.passwordSymbols().']).*$/',
            'confirmed'];
    }
}
