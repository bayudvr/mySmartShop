<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function add_admin(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'MADMIN_USERNAME' => 'required|max:255|unique:madmin,MADMIN_USERNAME',
            'MADMIN_PASSWORD' => 'required|max:255',
            'MADMINPRO_FULLNAME' => 'required|max:255',
            'MADMINPRO_COB' => 'required|max:255',
            'MADMINPRO_NOB' => 'required|max:255',
            'MADMINPRO_DOB' => "required|date:'Y-m-d'",
            'MADMINPRO_PHOTO' => 'required|file|image|max:2024'
        ]);

        $attributeNames = [
            'MADMIN_USERNAME' => 'Username',
            'MADMIN_PASSWORD' => 'Password',
            'MADMINPRO_FULLNAME' => 'Full Name',
            'MADMINPRO_COB' => 'City of Birth',
            'MADMINPRO_NOB' => 'Nation of Birth',
            'MADMINPRO_DOB' => 'Date of Birth',
            'MADMINPRO_PHOTO' => 'Photo Profile'
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

            $photo = $req->file('MADMINPRO_PHOTO');
            $ext = $photo->getClientOriginalExtension();
            $new_name = time().'.'.$ext;

            if($photo->move('public/storage/uploaded/MADMINPRO_PHOTO', $new_name))
            {
                $save_admin = std_insert([
                    'table_name' => 'madmin',
                    'data' => [
                        'MADMIN_USERNAME' => $req->MADMIN_USERNAME,
                        'MADMIN_PASSWORD' => md5($req->MADMIN_PASSWORD),
                        'MADMIN_LEVEL' => 2,
                        'MADMIN_CRTD_BY' => session('id'),
                        'MADMIN_CRTD_BY_TEXT' => session('username'),
                        'MADMIN_CRTD_TIMESTAMP' => date('Y-m-d H:i:s'),
                        'MADMIN_STATUS' => 1
                    ]
                ]);

                if($save_admin === false)
                {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Something went wrong when saving admin data',
                        'warning' => 'Internal server error'
                    ]);
                } else {
                    $get_admin = std_get([
                        'table_name' => 'madmin',
                        'where' => [
                            [
                                'field_name' => 'MADMIN_USERNAME',
                                'operator' => '=',
                                'value' => $req->MADMIN_USERNAME
                            ]
                        ],
                        'first_row' => true
                    ]);

                    if($get_admin == NULL)
                    {
                        return response()->json([
                            'status' => 'warning',
                            'message' => 'Someting went wrong, please wait a moment',
                            'warning' => 'User not found to save profile'
                        ]);
                    } else {

                        $save_admin_profile = std_insert([
                            'table_name' => 'madminpro',
                            'data' => [
                                'MADMINPRO_MADMIN_ID' => $get_admin['MADMIN_ID'],
                                'MADMINPRO_FULLNAME' => $req->MADMINPRO_FULLNAME,
                                'MADMINPRO_DOB' => $req->MADMINPRO_DOB,
                                'MADMINPRO_COB' => $req->MADMINPRO_COB,
                                'MADMINPRO_NOB' => $req->MADMINPRO_NOB,
                                'MADMINPRO_PHOTO' => $new_name,
                                'MADMINPRO_CRTD_BY' => session('id'),
                                'MADMINPRO_CRTD_BY_TEXT' => session('username'),
                                'MADMINPRO_CRTD_TIMESTAMP' => date('Y-m-d H:i:s')
                            ]
                        ]);

                        if($save_admin_profile === false)
                        {
                            return response()->json([
                                'status' => 'error',
                                'message' => 'Something went wrong when saving admin profile',
                                'warning' => 'Internal server error'
                            ]);
                        } else {
                            return response()->json([
                                'status' => 'done',
                                'message' => 'Admin saved',
                                'warning' => 'Successfully saved'
                            ]);
                        }
                    }
                }

            } else {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Semething happened when uploading picture, please wait a moment',
                    'warning' => 'Fail to upload Photo'
                ]);   
            }
        }
    }

    public function edit_admin(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'id' => 'required|exists:madmin,MADMIN_ID',
            'MADMIN_USERNAME' => 'required|max:255',
            'MADMINPRO_FULLNAME' => 'required|max:255',
            'MADMINPRO_DOB' => "required|date:'Y-m-d'",
            'MADMINPRO_COB' => 'required|max:255',
            'MADMINPRO_NOB' => 'required|max:255',
        ]);

        $attributeNames = [
            'id' => 'ID',
            'MADMIN_USERNAME' => 'Username',
            'MADMINPRO_FULLNAME' => 'Full Name',
            'MADMINPRO_COB' => 'City of Birth',
            'MADMINPRO_NOB' => 'Nation of Birth',
            'MADMINPRO_DOB' => 'Date of Birth'
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
            $get_admin = std_get([
                'table_name' => 'madmin',
                'where' => [
                    [
                        'field_name' => 'MADMIN_ID',
                        'operator' => '=',
                        'value' => $req->id
                    ]
                ],
                'first_row' => true
            ]);

            if($get_admin['MADMIN_USERNAME'] != $req->MADMIN_USERNAME)
            {
                $check_username = std_get([
                    'table_name' => 'madmin',
                    'where' => [
                        [
                            'field_name' => 'MADMIN_USERNAME',
                            'operator' => '=',
                            'value' => $req->MADMIN_USERNAME
                        ]
                    ],
                    'first_row' => true
                ]);

                if($check_username != NULL)
                {
                    return response()->json([
                        'status' => 'warning',
                        'message' => 'Username cannot be used',
                        'warning' => 'Invalid'
                    ]);
                }
            }

            $update_admin = std_update([
                'table_name' => 'madmin',
                'data' => [
                    'MADMIN_USERNAME' => $req->MADMIN_USERNAME,
                    'MADMIN_UPDT_BY' => session('id'),
                    'MADMIN_UPDT_BY_TEXT' => session('username'),
                    'MADMIN_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
                ],
                'where' => [
                    'MADMIN_ID' => $req->id
                ]
            ]);

            if($update_admin === false)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Something went wrong when updating admin data',
                    'warning' => 'Internal Server Error'
                ]);
            } else {
                $update_admin_profile = std_update([
                    'table_name' => 'madminpro',
                    'data' => [
                        'MADMINPRO_FULLNAME' => $req->MADMINPRO_FULLNAME,
                        'MADMINPRO_DOB' => $req->MADMINPRO_DOB,
                        'MADMINPRO_COB' => $req->MADMINPRO_COB,
                        'MADMINPRO_NOB' => $req->MADMINPRO_NOB,
                        'MADMINPRO_UPDT_BY' => session('id'),
                        'MADMINPRO_UPDT_BY_TEXT' => session('username'),
                        'MADMINPRO_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
                    ],
                    'where' => [
                        'MADMINPRO_MADMIN_ID' => $req->id
                    ]
                ]);

                if($update_admin_profile === false)
                {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Something went wrong when updating admin profile',
                        'warning' => 'Internal Server Error'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'done',
                        'message' => 'Admin updated',
                        'warning' => 'Successfully Updated'
                    ]);
                }
            }
        }
    }

    public function banAdmin($id)
    {
        $change_admin_status = std_update([
            'table_name' => 'madmin',
            'data' => [
                'MADMIN_STATUS' => 0,
                'MADMIN_UPDT_BY' => session('id'),
                'MADMIN_UPDT_BY_TEXT' => session('username'),
                'MADMIN_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
            ],
            'where' => [
                'MADMIN_ID' => $id
            ]
        ]);

        if($change_admin_status === false)
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

    public function unbanAdmin($id)
    {
        $change_admin_status = std_update([
            'table_name' => 'madmin',
            'data' => [
                'MADMIN_STATUS' => 1,
                'MADMIN_UPDT_BY' => session('id'),
                'MADMIN_UPDT_BY_TEXT' => session('username'),
                'MADMIN_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
            ],
            'where' => [
                'MADMIN_ID' => $id
            ]
        ]);

        if($change_admin_status === false)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong when updating admin profile',
                'warning' => 'Internal Server Error'
            ]);
        } else {
            return response()->json([
                'status' => 'done',
                'message' => 'is unbanned',
                'warning' => 'Successfully banned'
            ]);
        }
    }
}
