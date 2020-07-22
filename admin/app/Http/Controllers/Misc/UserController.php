<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // public function add_user(Request $req)
    // {
    //     $validate = Validator::make($req->all(),[
    //         'MAUSR_USERNAME' => 'required|max:255|unique:mausr,MAUSR_USERNAME',
    //         'MAUSR_EMAIL' => 'required|max:255|unique:mausr,MAUSR_EMAIL',
    //         'MAUSR_PASSWORD' => 'required|max:255',
    //         'MAUSR_FULLNAME' => 'required|max:255',
    //         'MAUSPRO_DOB' => "required|date:'Y-m-d'",
    //         'MAUSPRO_COB' => 'required|max:255',
    //         'MAUSPRO_NOB' => 'required|max:255'
    //     ]);

    //     $attributeNames = [
    //         'MAUSR_USERNAME' => 'Username',
    //         'MAUSR_EMAIL' => 'Email',
    //         'MAUSR_PASSWORD' => 'Password',
    //         'MAUSR_FULLNAME' => 'Full Name',
    //         'MAUSPRO_DOB' => "Date of Birth",
    //         'MAUSPRO_COB' => 'City of Birth',
    //         'MAUSPRO_NOB' => 'Nation of Birth'
    //     ];

    //     $validate->setAttributeNames($attributeNames);

    //     if($validate->fails())
    //     {
    //         return response()->json([
    //             'status' => 'warning',
    //             'message' => $validate->errors()->all(),
    //             'warning' => 'Invalid'
    //         ]);
    //     } else {
    //         $save_user = std_insert([
    //             'table_name' => 'mausr',
    //             'data' => [
    //                 'MAUSR_USERNAME' => $req->MAUSR_USERNAME,
    //                 'MAUSR_EMAIL' => $req->MAUSR_EMAIL,
    //                 'MAUSR_PASSWORD' => md5($req->MAUSR_PASSWORD),
    //                 'MAUSR_FULLNAME' => $req->MAUSR_FULLNAME,
    //                 'MAUSR_CRTD_BY' => session('id'),
    //                 'MAUSR_CRTD_BY_TEXT' => session('username'),
    //                 'MAUSR_CRTD_TIMESTAMP' => date('Y-m-d H:i:s'),
    //                 'MAUSR_STATUS' => 1
    //             ]
    //         ]);

    //         if($save_user === false)
    //         {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Something went wrong when saving user',
    //                 'warning' => 'Internal Server Error'
    //             ]);
    //         } else {

    //             $get_user = std_get([
    //                 'table_name' => 'mausr',
    //                 'where' => [
    //                     [
    //                         'field_name' => 'MAUSR_USERNAME',
    //                         'operator' => '=',
    //                         'value' => $req->MAUSR_USERNAME
    //                     ]
    //                 ],
    //                 'first_row' => true
    //             ]);

    //             if($get_user == NULL)
    //             {
    //                 return response()->json([
    //                     'status' => 'warning',
    //                     'message' => 'Something went wrong please wait a moment',
    //                     'warning' => 'User not Found',
    //                 ]);
    //             } else {
    //                 $save_user_profile = std_insert([
    //                     'table_name' => 'mauspro',
    //                     'data' => [
    //                         'MAUSPRO_MAUSR_ID' => $get_user['MAUSR_ID'],
    //                         'MAUSPRO_DOB' => $req->MAUSPRO_DOB,
    //                         'MAUSPRO_COB' => $req->MAUSPRO_COB,
    //                         'MAUSPRO_NOB' => $req->MAUSPRO_NOB,
    //                         'MAUSPRO_CRTD_BY' => session('id'),
    //                         'MAUSPRO_CRTD_BY_TEXT' => session('username'),
    //                         'MAUSPRO_CRTD_TIMESTAMP' => date('Y-m-d H:i:s')
    //                     ]
    //                 ]);

    //                 if($save_user_profile === false)
    //                 {
    //                     return response()->json([
    //                         'status' => 'error',
    //                         'message' => 'Something went wrong when saving user',
    //                         'warning' => 'Internal Server Error'
    //                     ]);
    //                 } else {
    //                     return response()->json([
    //                         'status' => 'done',
    //                         'message' => 'New user saved',
    //                         'warning' => 'Successfully saved'
    //                     ]);
    //                 }
    
    //             }
    //         }
    //     }
    // }

    public function edit_user(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'id' => 'required|numeric|exists:mausr,MAUSR_ID',
            'MAUSR_USERNAME' => 'required|max:255',
            'MAUSR_EMAIL' => 'required|max:255',
            'MAUSR_FULLNAME' => 'required|max:255',
            'MAUSPRO_DOB' => "required|date:'Y-m-d'",
            'MAUSPRO_COB' => 'required|max:255',
            'MAUSPRO_NOB' => 'required|max:255'
        ]);

        $attributeNames = [
            'id' => 'ID',
            'MAUSR_USERNAME' => 'Username',
            'MAUSR_EMAIL' => 'Email',
            'MAUSR_FULLNAME' => 'Full Name',
            'MAUSPRO_DOB' => "Date of Birth",
            'MAUSPRO_COB' => 'City of Birth',
            'MAUSPRO_NOB' => 'Nation of Birth'
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
                'table_name' => 'mausr',
                'where' => [
                    [
                        'field_name' => 'MAUSR_ID',
                        'operator' => '=',
                        'value' => $req->id
                    ]
                ],
                'first_row' => true
            ]);

            if($req->MAUSR_USERNAME != $get_user['MAUSR_USERNAME'])
            {
                $check_username = std_get([
                    'table_name' => 'mausr',
                    'where' => [
                        [
                            'field_name' => 'MAUSR_USERNAME',
                            'operator' => '=',
                            'value' => $req->MAUSR_USERNAME
                        ]
                    ],
                    'first_row' => true
                ]);

                if($check_username != NULL)
                {
                    return response()->json([
                        'status' => 'warning',
                        'message' => 'Username is already taken',
                        'warning' => 'Username not available'
                    ]);
                }
            }

            if($req->MAUSR_EMAIL != $get_user['MAUSR_EMAIL'])
            {
                $check_username = std_get([
                    'table_name' => 'mausr',
                    'where' => [
                        [
                            'field_name' => 'MAUSR_EMAIL',
                            'operator' => '=',
                            'value' => $req->MAUSR_EMAIL
                        ]
                    ],
                    'first_row' => true
                ]);

                if($check_username != NULL)
                {
                    return response()->json([
                        'status' => 'warning',
                        'message' => 'Username is already taken',
                        'warning' => 'Username not available'
                    ]);
                }
            }

            $update_user = std_update([
                'table_name' => 'mausr',
                'data' => [
                    'MAUSR_USERNAME' => $req->MAUSR_USERNAME,
                    'MAUSR_EMAIL' => $req->MAUSR_EMAIL,
                    'MAUSR_FULLNAME' => $req->MAUSR_FULLNAME,
                    'MAUSR_UPDT_BY' => session('id'),
                    'MAUSR_UPDT_BY_TEXT' => session('username'),
                    'MAUSR_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
                ],
                'where' => [
                    'MAUSR_ID' => $req->id
                ]
            ]);

            if($update_user === false)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Something went wrong when updating user data',
                    'warning' => 'Internal Server Error'
                ]);
            } else {
                $update_user_profile = std_update([
                    'table_name' => 'mauspro',
                    'data' => [
                        'MAUSPRO_DOB' => $req->MAUSPRO_DOB,
                        'MAUSPRO_COB' => $req->MAUSPRO_COB,
                        'MAUSPRO_NOB' => $req->MAUSPRO_NOB,
                        'MAUSPRO_UPDT_BY' => session('id'),
                        'MAUSPRO_UPDT_BY_TEXT' => session('username'),
                        'MAUSPRO_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
                    ],
                    'where' => [
                        'MAUSPRO_MAUSR_ID' => $req->id
                    ]
                ]);

                if($update_user_profile === false)
                {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Something went wrong when updating user data',
                        'warning' => 'Internal Server Error'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'done',
                        'message' => 'User Updated',
                        'warning' => 'Successfully Updated'
                    ]);
                }
            }
        }
    }

    public function banUser($id)
    {
        $change_user_status = std_update([
            'table_name' => 'mausr',
            'data' => [
                'MAUSR_STATUS' => 0,
                'MAUSR_UPDT_BY' => session('id'),
                'MAUSR_UPDT_BY_TEXT' => session('username'),
                'MAUSR_UPDT_TIMESTAMP' => date('Y-m-d')
            ],
            'where' => [
                'MAUSR_ID' => $id
            ]
        ]);

        if($change_user_status === false)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong when updating admin profile',
                'warning' => 'Internal Server Error'
            ]);
        } else {
            return response()->json([
                'status' => 'done',
                'message' => 'is banned',
                'warning' => 'Successfully banned'
            ]);
        }
    }

    public function unbanUser($id)
    {
        $change_user_status = std_update([
            'table_name' => 'mausr',
            'data' => [
                'MAUSR_STATUS' => 1,
                'MAUSR_UPDT_BY' => session('id'),
                'MAUSR_UPDT_BY_TEXT' => session('username'),
                'MAUSR_UPDT_TIMESTAMP' => date('Y-m-d')
            ],
            'where' => [
                'MAUSR_ID' => $id
            ]
        ]);

        if($change_user_status === false)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong when updating admin profile',
                'warning' => 'Internal Server Error'
            ]);
        } else {
            return response()->json([
                'status' => 'done',
                'message' => 'is banned',
                'warning' => 'Successfully banned'
            ]);
        }
    }
}
