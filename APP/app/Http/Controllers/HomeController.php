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

               return view('home');
            }else{

                return redirect('');
            }
        }else{
            
            return redirect('');
        }
    }

    public function auth(Request $req){
        $check_user = std_get([
            'table_name' => 'MAUSR',
            'special_where' => [
                [
                    'field_name' => 'MAUSR_EMAIL_ADDRESS',
                    'operator' => '=',
                    'value' => $req->email
                ]
            ],
            'first_row' => TRUE
        ]);

        $msg = null;

        if($check_user != null){
            if($req->password == Crypt::decryptString($check_user['MAUSR_PASSWORD'])){
                $time = date("Y-m-d H:i:s",strtotime("+10 minutesS"));

                $req->session()->put('user_code', $check_user['MAUSR_CODE']);
                $req->session()->put('valid_until', $time);
                $msg = 'done';
            }
        }

        return $msg;
    }

    public function register(Request $req){

        $validate = Validator::make($req->all(),[
        'name' => 'required|unique:MAUSR,MAUSR_FULL_NAME|max:255',
        'email' => 'required|unique:MAUSR,MAUSR_EMAIL_ADDRESS|max:255',
        'password' => 'required|max:255'

        ]);

        $msg = 'fail';

        if($validate->fails()){
            
            return $msg;
        }else if($req->password != $req->cpassword){
            $msg = 'misspass';

            return $msg;
        }else{
            $pass = Crypt::encryptString($req->password);
            $user_code = $this->generateUsrCode();
            $data = [
                'MAUSR_CODE' => $user_code,
                'MAUSR_EMAIL_ADDRESS' => $req->email,
                'MAUSR_FULL_NAME' => $req->name,
                'MAUSR_PASSWORD' => $pass,
                'MAUSR_CRTD_BY' => $user_code,
                'MAUSR_CRTD_BY_TEXT' => $req->name,
                'MAUSR_CRTD_TIMESTAMP' => date('Y-m-d H:i:s')
            ];

            $save_user = std_insert([
                'table_name' => 'MAUSR',
                'insert_data' => $data
            ]);

            if($save_user === false){

                return $msg;
            }else{

                $msg = 'done';

                return $msg;
            }
        }

    }

    public function logout(Request $req){

        $req->session()->flush();

        return redirect('');
    }

    public function generateUsrCode(){

        $cek_user = std_get([
            'table_name' => 'MAUSR'
        ]);

        $no = count($cek_user) + 1;
        $code = null;
        if($no > 0 && $no < 10){

            $code = 'USR000'.$no;
        }elseif($no > 9 && $no < 100){

            $code = 'USR00'.$no;
        }elseif($no > 99 && $no < 1000){

            $code = 'USR0'.$no;
        }elseif($no > 999){

            $code = 'USR'.$no;
        }

        return $code;
    }
}
