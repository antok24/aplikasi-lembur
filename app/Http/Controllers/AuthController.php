<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(){
    	$userlogin = Auth::user()->group;
        if($userlogin != 1 && $userlogin != 2 && $userlogin != 3 && $userlogin != 4 && $userlogin != 5 && $userlogin != 6 && $userlogin != 7 && $userlogin != 8 ){
            abort(404);
        }else{
    	$this->middleware('guest',['except' => ['logout','getLogout']]);
    	}
    }
}
