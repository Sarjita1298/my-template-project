<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
   public function index(){
    return view("frontend.master");
   }
     public function home(){
    return view("frontend.home");
   }
    
   public function contact(){

   return view(view: "frontend.contact");

   }
}   
