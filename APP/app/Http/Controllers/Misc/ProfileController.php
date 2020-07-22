<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function change_profile_picture(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'MAUSPRO_PHOTO' => 'required|file|image|mimes:jpg,jpeg,png|max:2024'
        ]);

        $attributeNames = [
            'MAUSPRO_PHOTO' => 'Profile Photo'
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
            $get_user_profile = std_get([
                'table_name' => 'mauspro',
                'where' => [
                    [
                        'field_name' => 'MAUSPRO_MAUSR_ID',
                        'operator' => '=',
                        'value' => session('id')
                    ]
                ],
                'first_row' => true
            ]);

            $path_photo = 'public/storage/uploaded/MAUSPRO_PHOTO/'.$get_user_profile['MAUSPRO_PHOTO'];

            if(is_file($path_photo))
            {
                File::delete($path_photo);
            }

            $photo = $req->file('MAUSPRO_PHOTO');
            $ext = $photo->getClientOriginalExtension();
            $new_name = time().'.'.$ext;

            if($photo->move('public/storage/uploaded/MAUSPRO_PHOTO', $new_name))
            {
                $update_photo = std_update([
                    'table_name' => 'mauspro',
                    'data' => [
                        'MAUSPRO_PHOTO' => $new_name,
                        'MAUSPRO_UPDT_BY' => session('id'),
                        'MAUSPRO_UPDT_BY_TEXT' => session('username'),
                        'MAUSPRO_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
                    ],
                    'where' => [
                        'MAUSPRO_ID' => session('id')
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

    public function edit_profile(Request $req)
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
                } else {
                    if($req->MAUSR_EMAIL != $get_user['MAUSR_EMAIL'])
                    {
                        $check_email = std_get([
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

                        if($check_email != NULL)
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
                                'status' => 'relog',
                            ]);
                        }
                    }
                }
            }

            if($req->MAUSR_EMAIL != $get_user['MAUSR_EMAIL'])
            {
                $check_email = std_get([
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

                if($check_email != NULL)
                {
                    return response()->json([
                        'status' => 'warning',
                        'message' => 'Username is already taken',
                        'warning' => 'Username not available'
                    ]);
                } else {
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
                                'status' => 'relog',
                            ]);
                        }
                    }
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
}
