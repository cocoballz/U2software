<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function register (){
        $datos = Request()->validate([
           'name'=>'required|string|max:255',
           'email'=>'required|string|email|max:255|unique:users',
           'password'=>'required|string|min:8',
        ]);
        $user = User::create([
            'name'=>$datos['name'],
            'email'=>$datos['email'],
            'password'=> Hash::make($datos['password'])
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token'=>$token,
            'token_type'=>'Bearer'
        ]);

    }

    public function login()
    {
     if(!Auth::attempt(Request(['email','password']))){
         return response()->json([
             'message' => 'Invalid Login details'
         ],401);
     }
    $user = User::where('email',Request('email'))->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'Bearer'
        ]);

    }

    public function userinfo(){
        return Request()->user();
    }

}
