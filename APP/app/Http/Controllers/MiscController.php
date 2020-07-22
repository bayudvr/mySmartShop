<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MiscController extends Controller
{
    public function signup(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'MAUSR_USERNAME' => 'required|max:255|unique:mausr,MAUSR_USERNAME',
            'MAUSR_EMAIL' => 'required|max:255|unique:mausr,MAUSR_EMAIL',
            'MAUSR_PASSWORD' => 'required|max:255',
            'confirm_password' => 'required|max:255|same:MAUSR_PASSWORD',
            'MAUSR_FULLNAME' => 'required|max:255',
            'MAUSPRO_DOB' => "required|date:'Y-m-d'",
            'MAUSPRO_COB' => 'required|max:255',
            'MAUSPRO_NOB' => 'required|max:255',
            'MAUSPRO_PHOTO' => 'required|file|image|mimes:jpg,jpeg,png|max:2024',
            'MABUS_NAME' => 'required|max:255',
            'MABUS_DESC' => 'required|max:65000',
            'MABUS_CONTACT' => 'required|max:255',
            'MABUS_ADDRESS' => 'required|max:65000',
            'package' => 'required|max:255|exists:mapack,MAPACK_CODE',
            'length' => 'required|numeric|in:2,6,12,24',
            'TRPACK_PAYMENT_METHOD' => 'required|numeric|in:1,2,3'
        ]);

        $attributeNames = [
            'MAUSR_USERNAME' => 'Username',
            'MAUSR_EMAIL' => 'Email',
            'MAUSR_PASSWORD' => 'Password',
            'confirm_password' => 'Password Confirmation',
            'MAUSR_FULLNAME' => 'Full Name',
            'MAUSPRO_DOB' => "Date of Birth",
            'MAUSPRO_COB' => 'City of Birth',
            'MAUSPRO_NOB' => 'Nation of Birth',
            'MAUSPRO_PHOTO' => 'Profile Photo',
            'MABUS_NAME' => 'Business Name',
            'MABUS_DESC' => 'Business Description',
            'MABUS_CONTACT' => 'Business Contact',
            'MABUS_ADDRESS' => 'Business Address',
            'package' => 'Package',
            'length' => 'Subcription Duration',
            'TRPACK_PAYMENT_METHOD' => 'Payment Method'
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
            
            $save_user = std_insert([
                'table_name' => 'mausr',
                'data' => [
                    'MAUSR_USERNAME' => $req->MAUSR_USERNAME,
                    'MAUSR_EMAIL' => $req->MAUSR_EMAIL,
                    'MAUSR_PASSWORD' => md5($req->MAUSR_PASSWORD),
                    'MAUSR_FULLNAME' => $req->MAUSR_FULLNAME,
                    'MAUSR_CRTD_BY' => 0,
                    'MAUSR_CRTD_BY_TEXT' => 'System',
                    'MAUSR_CRTD_TIMESTAMP' => date('Y-m-d H:i:s'),
                    'MAUSR_STATUS' => 1
                ]
            ]);

            if($save_user === false)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Something went wrong when saving user data',
                    'warning' => 'Internal Server Error'
                ]);
            } else {
                $get_user = std_get([
                    'table_name' => 'mausr',
                    'where' => [
                        [
                            'field_name' => 'MAUSR_USERNAME',
                            'operator' => '=',
                            'value' => $req->MAUSR_USERNAME
                        ],
                        [
                            'field_name' => 'MAUSR_EMAIL',
                            'operator' => '=',
                            'value' => $req->MAUSR_EMAIL
                        ]
                    ],
                    'first_row' => true
                ]);

                if($get_user == NULL)
                {
                    return response()->json([
                        'status' => 'warning',
                        'message' => 'Something went wrong when searching for user',
                        'warning' => 'User Not Found'
                    ]);
                } else {

                    $photo = $req->file('MAUSPRO_PHOTO');
                    $ext = $photo->getClientOriginalExtension();
                    $new_name = time().'.'.$ext;

                    if($photo->move('public/storage/uploaded/MAUSPRO_PHOTO', $new_name))
                    {
                        $save_user_profile = std_insert([
                            'table_name' => 'mauspro',
                            'data' => [
                                'MAUSPRO_MAUSR_ID' => $get_user['MAUSR_ID'],
                                'MAUSPRO_DOB' => $req->MAUSPRO_DOB,
                                'MAUSPRO_COB' => $req->MAUSPRO_COB,
                                'MAUSPRO_NOB' => $req->MAUSPRO_NOB,
                                'MAUSPRO_PHOTO' => $new_name,
                                'MAUSPRO_CRTD_BY' => 0,
                                'MAUSPRO_CRTD_BY_TEXT' => 'System',
                                'MAUSPRO_CRTD_TIMESTAMP' => date('Y-m-d H:i:s')
                            ]
                        ]);

                        if($save_user_profile === false)
                        {
                            return response()->json([
                                'status' => 'error',
                                'message' => 'Something went wrong when saving user profile',
                                'warning' => 'Internal Server Error'
                            ]);
                        } else {
                            $save_user_business = std_insert([
                                'table_name' => 'mabus',
                                'data' => [
                                    'MABUS_MAUSR_ID' => $get_user['MAUSR_ID'],
                                    'MABUS_NAME' => $req->MABUS_NAME,
                                    'MABUS_DESC' => $req->MABUS_DESC,
                                    'MABUS_CONTACT' => $req->MABUS_CONTACT,
                                    'MABUS_ADDRESS' => $req->MABUS_ADDRESS,
                                    'MABUS_CRTD_BY' => 0,
                                    'MABUS_CRTD_BY_TEXT' => 'System',
                                    'MABUS_CRTD_TIMESTAMP' => date('Y-m-d H:i:s'),
                                    'MABUS_STATUS' => 1
                                ]
                            ]);

                            if($save_user_business === false)
                            {
                                return response()->json([
                                    'status' => 'error',
                                    'message' => 'Something went wrong when saving user profile',
                                    'warning' => 'Internal Server Error'
                                ]);
                            } else {
                                $get_package = std_get([
                                    'table_name' => 'mapack',
                                    'where' => [
                                        [
                                            'field_name' => 'MAPACK_CODE',
                                            'operator' => '=',
                                            'value' => $req->package
                                        ]
                                    ],
                                    'first_row' => true
                                ]);

                                if($get_package == NULL)
                                {
                                    return response()->json([
                                        'status' => 'warning',
                                        'message' => 'Something went wrong when searching for package',
                                        'warning' => 'Package Not Found'
                                    ]);
                                } else {
                                    $trpack_code = $get_package['MAPACK_CODE'].date('ymd').time();
                                    $until = date('Y-m-d',strtotime('+ '.$req->length.' months'));
                                    $total = $get_package['MAPACK_PRICE'] * $req->length;

                                    $save_package_transaction = std_insert([
                                        'table_name' => 'trpack',
                                        'data' => [
                                            'TRPACK_CODE' => $trpack_code,
                                            'TRPACK_MAPACK_CODE' => $get_package['MAPACK_CODE'],
                                            'TRPACK_MAUSR_ID' => $get_user['MAUSR_ID'],
                                            'TRPACK_UNTIL' => $until,
                                            'TRPACK_TOTAL_PRICE' => $total,
                                            'TRPACK_PAYMENT_METHOD' => $req->TRPACK_PAYMENT_METHOD,
                                            'TRPACK_CRTD_BY' => 0,
                                            'TRPACK_CRTD_BY_TEXT' => 'System',
                                            'TRPACK_CRTD_TIMESTAMP' => date('Y-m-d H:i:s'),
                                            'TRPACK_STATUS' => 0
                                        ]
                                    ]);

                                    if($save_package_transaction === false)
                                    {
                                        return response()->json([
                                            'status' => 'error',
                                            'message' => 'Something went wrong when saving package transaction',
                                            'warning' => 'Internal Server Error'
                                        ]);
                                    } else {
                                        return response()->json([
                                            'status' => 'done',
                                            'message' => 'You are registered!',
                                            'warning' => 'Successfully Registered'
                                        ]);
                                    }
                                }
                            }
                        }
                    } else {
                        return response()->json([
                            'status' => 'warning',
                            'message' => 'Something went wrong when uploading picture',
                            'warning' => 'Failed to Upload'
                        ]);
                    }
                }
            }
        }
    }
}
