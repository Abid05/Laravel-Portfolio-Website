<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function LoginIndex(){

        return view('Login');
    }

    public function onLogin(Request $request){

       $user =  $request->input('user');
       $pass =  $request->input('pass');
       $coutValue =  admin::where('username', '=',$user)->where('password','=',$pass)->count();

       if($coutValue == 1){
            $request->session()->put('user',$user);
            return 1;
       }else{
            return 0;
       }
      
    }

    public function onLogout(Request $request){
        $request->session()->flush();
        return redirect('/Login');
    }
}
