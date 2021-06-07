<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{



    public function testApi(){
        return "testApi";
    }

    
    public function register(Request $request){
       
        $validator = Validator::make($request->all() , [
            'name' => 'required|min:4',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            "confirmed_password" => "required|same:password"
        ]);

        if($validator->fails()){
            return response()->json($validator->errors() , 202);
        }

        $user = User::create([
            "name" => $request['name'],
            "email" => $request["email"],
            "password" => Hash::make($request["password"])
        ]);

        $accessToken = $user->createToken("authToken")->accessToken;

        return response(["user" => $user , "access_token" => $accessToken]);
    }


    public function login(Request $request){

       
        $user = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        
        if(!Auth::attempt($user)){
            return response(["message" => "Invalid email or password"]);
        }


        $accessToken = Auth::user()->createToken("authToken")->accessToken;

        return response(["user" => Auth::user(), "accessToken" => $accessToken]);

    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            "message" => "Logout Successfully"
        ]);
    }

}
