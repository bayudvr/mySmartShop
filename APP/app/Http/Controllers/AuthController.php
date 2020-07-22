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
            return redirect('panel_redirect');
        } else {
            return view('login');
        }
    }

    public function signup()
    {
        $packages = std_get([
            'table_name' => 'mapack'
        ]);
        return view('signup',[
            'packages' => $packages
        ]);
    }

    public function login(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'cred' => 'required|max:255',
            'MAUSR_PASSWORD' => 'required|max:255'
        ]);

        $attributeNames = [
            'cred' => 'Username or Email',
            'MAUSR_PASSWORD'=> 'Password'
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
            $get_user_by_username = std_get([
                'table_name' => 'mausr',
                'where' => [
                    [
                        'field_name' => 'MAUSR_USERNAME',
                        'operator' => '=',
                        'value' => $req->cred
                    ],
                    [
                        'field_name' => 'MAUSR_PASSWORD',
                        'operator' => '=',
                        'value' => md5($req->MAUSR_PASSWORD)
                    ],
                    [
                        'field_name' => 'MAUSR_STATUS',
                        'operator' => '=',
                        'value' => 1
                    ],
                ],
                'first_row' => true
            ]);

            if($get_user_by_username != NULL)
            {
                session(['id' => $get_user_by_username['MAUSR_ID']]);
                session(['username' => $get_user_by_username['MAUSR_USERNAME']]);
                session(['is_login' => 1]);

                return response()->json([
                    'status' => 'done',
                    'message' => 'Login Verified',
                    'warning' => 'Welcome!'
                ]);
            } else {
                $get_user_by_email = std_get([
                    'table_name' => 'mausr',
                    'where' => [
                        [
                            'field_name' => 'MAUSR_EMAIL',
                            'operator' => '=',
                            'value' => $req->cred
                        ],
                        [
                            'field_name' => 'MAUSR_PASSWORD',
                            'operator' => '=',
                            'value' => md5($req->MAUSR_PASSWORD)
                        ],
                        [
                            'field_name' => 'MAUSR_STATUS',
                            'operator' => '=',
                            'value' => 1
                        ],
                    ],
                    'first_row' => true
                ]);

                if($get_user_by_email != NULL)
                {
                    session(['id' => $get_user_by_email['MAUSR_ID']]);
                    session(['username' => $get_user_by_email['MAUSR_USERNAME']]);
                    session(['is_login' => 1]);

                    return response()->json([
                        'status' => 'done',
                        'message' => 'Login Verified',
                        'warning' => 'Welcome!'
                    ]);
                } else {
                    $get_employee_by_username = std_get([
                        'table_name' => 'maemp',
                        'where' => [
                            [
                                'field_name' => 'MAEMP_USERNAME',
                                'operator' => '=',
                                'value' => $req->cred
                            ],
                            [
                                'field_name' => 'MAEMP_PASSWORD',
                                'operator' => '=',
                                'value' => md5($req->MAUSR_PASSWORD)
                            ],
                            [
                                'field_name' => 'MAEMP_STATUS',
                                'operator' => '=',
                                'value' => 1
                            ],
                        ],
                        'first_row' => true
                    ]);

                    if($get_employee_by_username != NULL)
                    {
                        session(['id' => $get_employee_by_username['MAEMP_ID']]);
                        session(['username' => $get_employee_by_username['MAEMP_USERNAME']]);
                        session(['business' => $get_employee_by_username['MAEMP_MABUS_ID']]);
                        session(['role' => $get_employee_by_username['MAEMP_ROLE']]);
                        session(['is_login' => 1]);

                        return response()->json([
                            'status' => 'done',
                            'message' => 'Login Verified',
                            'warning' => 'Welcome!'
                        ]);
                    } else {
                        $get_employee_by_email = std_get([
                            'table_name' => 'maemp',
                            'where' => [
                                [
                                    'field_name' => 'MAEMP_EMAIL',
                                    'operator' => '=',
                                    'value' => $req->cred
                                ],
                                [
                                    'field_name' => 'MAEMP_PASSWORD',
                                    'operator' => '=',
                                    'value' => md5($req->MAUSR_PASSWORD)
                                ],
                                [
                                    'field_name' => 'MAEMP_STATUS',
                                    'operator' => '=',
                                    'value' => 1
                                ],
                            ],
                            'first_row' => true
                        ]);

                        if($get_employee_by_email != NULL)
                        {
                            session(['id' => $get_employee_by_email['MAEMP_ID']]);
                            session(['username' => $get_employee_by_email['MAEMP_USERNAME']]);
                            session(['business' => $get_employee_by_email['MAEMP_MABUS_ID']]);
                            session(['role' => $get_employee_by_email['MAEMP_ROLE']]);
                            session(['is_login' => 1]);

                            return response()->json([
                                'status' => 'done',
                                'message' => 'Login Verified',
                                'warning' => 'Welcome!'
                            ]);
                        } else {
                            return response()->json([
                                'status' => 'warning',
                                'message' => 'Account not exist Or Banned',
                                'warning' => 'Not Found'
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function logout()
    {
        session()->forget(['is_login']);

        return redirect('');
    }
}
