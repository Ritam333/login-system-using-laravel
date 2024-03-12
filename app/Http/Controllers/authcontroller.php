<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


//use Illuminate\Support\Facades\Log;

class authcontroller extends Controller
{
  public function login(){
    return view('login');
  }
  public function showlogin(){
    return view('login');
  }


  public function home(){
    return view('home');
 }

 public function postlogin( Request $request){


   
  $request->validate([
   
   // 'email' => 'required|string|email|max:255|unique:users',
   // 'password' => 'required|string|min:6|confirmed',
   
      'captcha'=>'required|captcha'
    
    
]);



    // Validate the form data
    $credentials = $request->validate([
      'email'=>['required','email'],
      'password'=>['required']
    ]);

    // Attempt to authenticate the user
    if (Auth::attempt($credentials)) {
        // Authentication was successful
        return redirect()->intended('/home'); // Redirect to intended page or any desired page
    } else {
        // Authentication failed
        return back()->with('error1','Invalid credentials'); // Redirect back with error message
    }
}


 


 
  public function register(){
    return view('registration');
  }


  public function postregister(Request $request){
    $check_email=User::where('email',$request->email)->first();
    if($check_email){
        return back()->with('error','email already use');
    }


    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6|confirmed',
     
        'captcha'=>'required|captcha'
      
      
  ]);




    $user=User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password)
    ]);

  
    Auth::login($user);
    return redirect()->route('home')->with('success','congratulations ,your account can be used');
  }



  
 public function logout(){
  Session::flush();
  Auth::logout();
  return redirect('login');

 }


}
