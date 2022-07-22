<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function index(){
        return  view('Admin.login');
    }
    public function logindetailes(Request $request){
        $email=$request->email;
        $password=$request->password;
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                  $request->session()->regenerate();
           return  redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function doAdminLogout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('');

    }

}