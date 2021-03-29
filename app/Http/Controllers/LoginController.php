<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
class LoginController extends Controller
{
    //
    public function index(){
        return view('pages/login/login');
    }
    public function checklogin(Request $request){
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required|min:3'
        ]);

        $user_data = array(
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        );

        if(Auth::attempt($user_data)){
            return redirect('/customer');
        }else{
            return back()->with('error' , 'Wrong Login Details');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

}
