<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
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

    public function logout(Request $req){

        $req->session()->flush();

        return redirect('');
    }
}
