<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function add_package(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'MAPACK_CODE' => 'required|max:255|unique:mapack,MAPACK_CODE',
            'MAPACK_NAME' => 'required|max:255|unique:mapack,MAPACK_NAME',
            'MAPACK_PRICE' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'MAPACK_MAX_BUSINESS' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'MAPACK_MAX_EMPLOYEE' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'MAPACK_DESC' => 'required|max:65000'
        ]);

        $attributeNames = [
            'MAPACK_CODE' => 'Package Code',
            'MAPACK_NAME' => 'Package Name',
            'MAPACK_PRICE' => 'Package Price',
            'MAPACK_MAX_BUSINESS' => 'Package Max Business',
            'MAPACK_MAX_EMPLOYEE' => 'Package Max Employee',
            'MAPACK_DESC' => 'Package Description'
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
            $save_package = std_insert([
                'table_name' => 'mapack',
                'data' => [
                    'MAPACK_CODE' => $req->MAPACK_CODE,
                    'MAPACK_NAME' => $req->MAPACK_NAME,
                    'MAPACK_PRICE' => $req->MAPACK_PRICE,
                    'MAPACK_MAX_BUSINESS' => $req->MAPACK_MAX_BUSINESS,
                    'MAPACK_MAX_EMPLOYEE' => $req->MAPACK_MAX_EMPLOYEE,
                    'MAPACK_DESC' => $req->MAPACK_DESC,
                    'MAPACK_STATUS' => 1,
                    'MAPACK_CRTD_BY' => session('id'),
                    'MAPACK_CRTD_BY_TEXT' => session('username'),
                    'MAPACK_CRTD_TIMESTAMP' => date('Y-m-d H:i:s'),
                ]
            ]);

            if($save_package === false)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Something went wrong when saving package information',
                    'warning' => 'Internal Server Error'
                ]);
            } else {
                return response()->json([
                    'status' => 'done',
                    'message' => 'New Package Saved',
                    'warning' => 'Succesfully Saved'
                ]);
            }
        }
    }

    public function edit_package(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'id' => 'required|numeric|exists:mapack,MAPACK_ID',
            'MAPACK_CODE' => 'required|max:255',
            'MAPACK_NAME' => 'required|max:255',
            'MAPACK_PRICE' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'MAPACK_MAX_BUSINESS' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'MAPACK_MAX_EMPLOYEE' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'MAPACK_DESC' => 'required|max:65000'
        ]);

        $attributeNames = [
            'id' => 'ID',
            'MAPACK_CODE' => 'Package Code',
            'MAPACK_NAME' => 'Package Name',
            'MAPACK_PRICE' => 'Package Price',
            'MAPACK_MAX_BUSINESS' => 'Package Max Business',
            'MAPACK_MAX_EMPLOYEE' => 'Package Max Employee',
            'MAPACK_DESC' => 'Package Description'
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

            $get_package = std_get([
                'table_name' => 'mapack',
                'where' => [
                    [
                        'field_name' => 'MAPACK_ID',
                        'operator' => '=',
                        'value' => $req->id
                    ]
                ],
                'first_row' => true
            ]);

            if($get_package['MAPACK_CODE'] != $req->MAPACK_CODE)
            {
                $check_code = std_get([
                    'table_name' => 'mapack',
                    'where' => [
                        [
                            'field_name' => 'MAPACK_CODE',
                            'operator' => '=',
                            'value' => $req->MAPACK_CODE
                        ]
                    ],
                    'first_row' => true
                ]);

                if($check_code != NULL)
                {
                    return response()->json([
                        'status' => 'warning',
                        'message' => 'Package code is taken',
                        'warning' => 'Package Code Unavailable'
                    ]);
                }
            }

            if($get_package['MAPACK_NAME'] != $req->MAPACK_NAME)
            {
                $check_name = std_get([
                    'table_name' => 'mapack',
                    'where' => [
                        [
                            'field_name' => 'MAPACK_NAME',
                            'operator' => '=',
                            'value' => $req->MAPACK_NAME
                        ]
                    ],
                    'first_row' => true
                ]);

                if($check_name != NULL)
                {
                    return response()->json([
                        'status' => 'warning',
                        'message' => 'Package name is taken',
                        'warning' => 'Package Name Unavailable'
                    ]);
                }
            }

            $update_package = std_update([
                'table_name' => 'mapack',
                'data' => [
                    'MAPACK_CODE' => $req->MAPACK_CODE,
                    'MAPACK_NAME' => $req->MAPACK_NAME,
                    'MAPACK_PRICE' => $req->MAPACK_PRICE,
                    'MAPACK_MAX_BUSINESS' => $req->MAPACK_MAX_BUSINESS,
                    'MAPACK_MAX_EMPLOYEE' => $req->MAPACK_MAX_EMPLOYEE,
                    'MAPACK_DESC' => $req->MAPACK_DESC,
                    'MAPACK_UPDT_BY' => session('id'),
                    'MAPACK_UPDT_BY_TEXT' => session('username'),
                    'MAPACK_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
                ],
                'where' => [
                    'MAPACK_ID' => $req->id
                ]
            ]);

            if($update_package === false)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Something went wrong when updating package',
                    'warning' => 'Internal Server Error'
                ]);
            } else {
                return response()->json([
                    'status' => 'done',
                    'message' => 'Package updated',
                    'warning' => 'Successfully Updated'
                ]);
            }
        }
    }

    public function deactivate($id)
    {
        $change_status = std_update([
            'table_name' => 'mapack',
            'data' => [
                'MAPACK_STATUS' => 0,
                'MAPACK_UPDT_BY' => session('id'),
                'MAPACK_UPDT_BY_TEXT' => session('username'),
                'MAPACK_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
            ],
            'where' => [
                'MAPACK_ID' => $id
            ]
        ]);

        if($change_status === false)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong when updating package',
                'warning' => 'Internal Server Error'
            ]);
        } else {
            return response()->json([
                'status' => 'done',
                'message' => 'is deactivated',
                'warning' => 'Successfully Deactivated'
            ]);
        }
    }

    public function activate($id)
    {
        $change_status = std_update([
            'table_name' => 'mapack',
            'data' => [
                'MAPACK_STATUS' => 1,
                'MAPACK_UPDT_BY' => session('id'),
                'MAPACK_UPDT_BY_TEXT' => session('username'),
                'MAPACK_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
            ],
            'where' => [
                'MAPACK_ID' => $id
            ]
        ]);

        if($change_status === false)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong when updating package',
                'warning' => 'Internal Server Error'
            ]);
        } else {
            return response()->json([
                'status' => 'done',
                'message' => 'is activated',
                'warning' => 'Successfully Activated'
            ]);
        }
    }
}
