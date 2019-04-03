<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    function welcome () {
        return view('welcome');
    }
/*
    function login () {
        $credentials = $request->only('email', 'password');
        $token = auth('api')->attempt($credentials);
        return view('home' , ['token' => $token]);
    }
*/
}
