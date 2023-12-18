<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\WelcomeEmail;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin(){
        if(Auth::check()){
            return redirect('/');
        }
        return view('pages.auth.login');

    }
    public function showRegister(){
        if(Auth::check()){
            return redirect('/');
        }
        return view('pages.auth.register');
    }
    public function store(RegisterRequest $request){
       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        Mail::to($user->email)->send(new WelcomeEmail($user->id));
        return redirect('/login')->with('status', 'Successfully created account!');
    }

    public function index(LoginRequest $request){
        if(Auth::check()){
            return redirect('/login')->withErrors('You are already logged in!');
        }
        $credentials = $request->only('email', 'password');
        if(!Auth::attempt($credentials)){
            return redirect('/login')->withErrors('Invalid credentials!');
        }

        return redirect('/')->with('status', 'Login success!');
}
    public function destory(){
       Session::flush();
       Auth::logout();

        return redirect('/')->with('status', 'Logged out!');
       

    }
}
