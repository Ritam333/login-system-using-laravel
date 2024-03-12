<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class captchacontroller extends Controller
{
    //
    public function index()  {

        return view('registration');
        
    }


    public function reloadcaptcha(){

        return response()->json(['captcha'=>captcha_img('math')]);
    }
}
