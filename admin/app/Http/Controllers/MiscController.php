<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MiscController extends Controller
{
    public function change_password(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'MADMIN_PASSWORD' => 'required|max:255',
            'new_pass' => 'required|max:255|same:MADMIN_PASSWORD'
        ]);

        $attributeNames = [
            'MADMIN_PASSWORD' => 'New Password',
            'new_pass' => 'New Password Confrimation'
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
            $update_password = std_update([
                'table_name' => 'madmin',
                'data' => [
                    'MADMIN_PASSWORD' => md5($req->MADMIN_PASSWORD),
                    'MADMIN_UPDT_BY' => session('id'),
                    'MADMIN_UPDT_BY_TEXT' => session('username'),
                    'MADMIN_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
                ],
                'where' => [
                    'MADMIN_ID' => session('id')
                ]
            ]);

            if($update_password === false)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is something wrong whern updating password',
                    'warning' => 'Internal Server Error'
                ]);
            } else {
                return response()->json([
                    'status' => 'done',
                    'message' => 'Password successfully changed',
                    'warning' => 'Successfully Updated'
                ]);
            }
        }
    }
}
