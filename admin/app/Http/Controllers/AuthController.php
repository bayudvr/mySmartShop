<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function index()
    {
        if(session('is_login') == 1)
        {
            return redirect('dashboard');
        } else {
            return view('login');
        }
    }

    public function login(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'MADMIN_USERNAME' => 'required|max:255',
            'MADMIN_PASSWORD' => 'required|max:255'
        ]);

        $attributeNames = [
            'MADMIN_USERNAME' => 'Username',
            'MADMIN_PASSWORD' => 'Password'
        ];

        $validate->setAttributeNames($attributeNames);

        if($validate->fails())
        {
            return response()->json([
                'status' => 'warning',
                'message' => $validate->errors()->all(),
                'warning' => 'Invalid'
            ]);
        } else {
            $get_user = std_get([
                "table_name" => "madmin",
                "where" => [
                    [
                        "field_name" => "MADMIN_USERNAME",
                        "operator" => "=",
                        "value" => $req->MADMIN_USERNAME
                    ],
                    [
                        "field_name" => "MADMIN_PASSWORD",
                        "operator" => "=",
                        "value" => md5($req->MADMIN_PASSWORD)
                    ],
                    [
                        "field_name" => "MADMIN_STATUS",
                        "operator" => "=",
                        "value" => 1
                    ]
                ],
                "first_row" => true    
            ]);

            if($get_user == NULL)
            {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Account not exist Or Banned',
                    'warning' => 'Not Found'
                ]);
            }else if($get_user != NULL)
            {
                session(['id' => $get_user['MADMIN_ID']]);
                session(['username' => $get_user['MADMIN_USERNAME']]);
                session(['level' => $get_user['MADMIN_LEVEL']]);
                session(['is_login' => 1]);

                return response()->json([
                    'status' => 'done',
                    'message' => 'Login Verified',
                    'warning' => 'Welcome!'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Internal Server Error',
                    'warning' => 'Error'
                ]);
            }


        }
    }

    public function logout()
    {
        session()->forget(['id','username','level','is_login']);

        return redirect('');
    }
}
