<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;


class MasterController extends BaseController
{
    public function index(){
        return view("backend.layout.footer");
    }
     
    public function dashboard(){
        return view("backend.dashboard");
    }
  
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }
    }
    public function layout(){
        return view("layouts.app");
    }

    public function register(){
        return view("auth.register");
    }
    
    public function logout(){
        return view("layouts.app");
    }


}