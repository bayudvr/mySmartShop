<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function index(Request $req){

        if(session()->get('user_code') != null){
            
            if(session()->get('valid_until') > date('Y-m-d H:i:s')){

               return redirect('home');
            }else{

                return view('login');
            }
        }else{
            
            return view('login');
        }

    }

    public function home(Request $req){

        if(session()->get('user_code') != null){
            
            if(session()->get('valid_until') > date('Y-m-d H:i:s')){

               return view('home.index');
            }else{

                return redirect('');
            }
        }else{
            
            return redirect('');
        }
    }

    public function user_data(Request $req){

        if(session()->get('user_code') != null){
            
            if(session()->get('valid_until') > date('Y-m-d H:i:s')){

               return view('home.user_data');
            }else{

                return redirect('');
            }
        }else{
            
            return redirect('');
        }
    }
}
