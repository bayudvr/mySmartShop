<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function update(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'id' => 'required|numeric|exists:madmin,MADMIN_ID',
            'MADMIN_USERNAME' => 'required|max:255',
            'MADMINPRO_FULLNAME' => 'required|max:255',
            'MADMINPRO_COB' => 'required|max:255',
            'MADMINPRO_NOB' => 'required|max:255',
            'MADMINPRO_DOB' => "required|date:'Y-m-d'"
        ]);

        $attributeNames = [
            'id' => 'ID',
            'MADMIN_USERNAME' => 'Username',
            'MADMINPRO_FULLNAME' => 'Full Name',
            'MADMINPRO_COB' => 'City of Birth',
            'MADMINPRO_NOB' => 'Nation of Birth',
            'MADMINPRO_DOB' => 'Date of Birth'
        ];

        $validator->setAttributeNames($attributeNames);
        
        if($validator->fails())
        {
            return response()->json([
                'status' => 'warning',
                'message' => $validator->errors()->all(),
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
                        'status' => 'username_double',
                        'message' => '',
                        'warning' => 'Username not available'
                    ]);
                }

                $update_admin = std_update([
                    'table_name' => 'madmin',
                    'data' => [
                        'MADMIN_USERNAME' => $req->MADMIN_USERNAME,
                        'MADMIN_UPDT_BY' => 0,
                        'MADMIN_UPDT_BY_TEXT' => 'System',
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
                        'message' => 'Internal Server Error',
                        'warning' => 'Error'
                    ]);
                } else {
                    $update_admin_profile = std_update([
                        'table_name' => 'madminpro',
                        'data' => [
                            'MADMINPRO_FULLNAME' => $req->MADMINPRO_FULLNAME,
                            'MADMINPRO_COB' => $req->MADMINPRO_COB,
                            'MADMINPRO_NOB' => $req->MADMINPRO_NOB,
                            'MADMINPRO_DOB' => $req->MADMINPRO_DOB,
                            'MADMINPRO_UPDT_BY' => 0,
                            'MADMINPRO_UPDT_BY_TEXT' => 'System',
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
                            'message' => 'Internal Server Error',
                            'warning' => 'Error'
                        ]);
                    } else {
                        return response()->json([
                            'status' => 'relog',
                            'message' => 'Profile Updated',
                            'warning' => 'Updated'
                        ]);
                    }
                }
            } else {
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
                        'message' => 'Internal Server Error',
                        'warning' => 'Error'
                    ]);
                } else {
                    $update_admin_profile = std_update([
                        'table_name' => 'madminpro',
                        'data' => [
                            'MADMINPRO_FULLNAME' => $req->MADMINPRO_FULLNAME,
                            'MADMINPRO_COB' => $req->MADMINPRO_COB,
                            'MADMINPRO_NOB' => $req->MADMINPRO_NOB,
                            'MADMINPRO_DOB' => $req->MADMINPRO_DOB,
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
                            'message' => 'Internal Server Error',
                            'warning' => 'Error'
                        ]);
                    } else {
                        return response()->json([
                            'status' => 'done',
                            'message' => 'Profile Updated',
                            'warning' => 'Updated'
                        ]);
                    }
                }
            }
        }
    }

    public function change_picture(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'MADMINPRO_PHOTO' => 'required|file|image|max:2024'
        ]);

        $attributeNames = [
            'MADMINPRO_PHOTO' => 'Profile Picture'
        ];

        $validator->setAttributeNames($attributeNames);

        if($validator->fails())
        {
            return response()->json([
                'status' => 'warning',
                'message' => $validator->errors()->all(),
                'warning' => 'Invalid'
            ]);
        } else {
            $get_admin_profile = std_get([
                'table_name' => 'madminpro',
                'where' => [
                    [
                        'field_name' => 'MADMINPRO_MADMIN_ID',
                        'operator' => '=',
                        'value' => session('id')
                    ]
                ],
                'first_row' => true
            ]);

            $path_photo = 'public/storage/uploaded/MADMINPRO_PHOTO/'.$get_admin_profile['MADMINPRO_PHOTO'];

            if(is_file($path_photo))
            {
                File::delete($path_photo);
            }

            $photo = $req->file('MADMINPRO_PHOTO');
            $ext = $photo->getClientOriginalExtension();
            $new_name = time().'.'.$ext;

            if($photo->move('public/storage/uploaded/MADMINPRO_PHOTO', $new_name))
            {
                $update_photo = std_update([
                    'table_name' => 'madminpro',
                    'data' => [
                        'MADMINPRO_PHOTO' => $new_name,
                        'MADMINPRO_UPDT_BY' => session('id'),
                        'MADMINPRO_UPDT_BY_TEXT' => session('username'),
                        'MADMINPRO_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
                        
                    ], 
                    'where' => [
                        'MADMINPRO_MADMIN_ID' => session('id')
                    ]
                ]);

                if($update_photo === false)
                {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Something when wrong when updating photo profile',
                        'warning' => 'Internal Server Error'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'done',
                        'message' => 'Profile picture updated',
                        'warning' => 'Updated'
                    ]);
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
}
