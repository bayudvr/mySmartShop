<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function add(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'id' => 'required|exists:mausr,MAUSR_ID',
            'MABUS_NAME' => 'required|max:255',
            'MABUS_DESC' => 'required|max:65000',
            'MABUS_CONTACT' => 'required|max:255',
            'MABUS_ADDRESS' => 'required|max:255'
        ]);

        $att = [
            'id' => 'User ID',
            'MABUS_NAME' => 'Business Name',
            'MABUS_DESC' => 'Business Description',
            'MABUS_CONTACT' => 'Business Contact',
            'MABUS_ADDRESS' => 'Business Address'
        ];

        $validate->setAttributeNames($att);

        if($validate->fails())
        {
            return response()->json([
                'status' => 'warning',
                'message' => $validate->errors()->all(),
                'warning' => 'Invalid'
            ]);
        } else {
            $check_status = std_get([
                'table_name' => 'trpack',
                'where' => [
                    [
                        'field_name' => 'TRPACK_MAUSR_ID',
                        'operator' => '=',
                        'value' => session('id')
                    ],
                    [
                        'field_name' => 'TRPACK_UNTIL',
                        'operator' => '>',
                        'value' => date('Y-m-d')
                    ],
                    [
                        'field_name' => 'TRPACK_STATUS',
                        'operator' => '!=',
                        'value' => 2
                    ]
                ],
                'first_row' => true
            ]);

            if($check_status != NULL)
            {
                $count_business = std_get([
                    'table_name' => 'mabus',
                    'where' => [
                        [
                            'field_name' => 'MABUS_MAUSR_ID',
                            'operator' => '=',
                            'value' => session('id')
                        ],
                        [
                            'field_name' => 'MABUS_STATUS',
                            'operator' => '!=',
                            'value' => 2
                        ]
                    ]
                ]);

                if($check_status['TRPACK_STATUS'] == 0)
                {
                    if(count($count_business) >= 1)
                    {
                        return response()->json([
                            'status' => 'warning',
                            'message' => "You haven't payed your subsciption yet, only 1 Business is allowed to be add. Please complete your payments.",
                            'warning' => 'Bussiness count exceeded'
                        ]);
                    }
                }

                if($check_status['TRPACK_STATUS'] == 1)
                {
                    $get_package = std_get([
                        'table_name' => 'mapack',
                        'where' => [
                            [
                                'field_name' => 'MAPACK_CODE',
                                'operator' => '=',
                                'value' => $check_status['TRPACK_MAPACK_CODE']
                            ]
                        ],
                        'first_row' => true
                    ]);

                    if(count($count_business) >= $get_package['MAPACK_MAX_BUSINESS'])
                    {
                        return response()->json([
                            'status' => 'warning',
                            'message' => "You now only have ".$get_package['MAPACK_MAX_BUSINESS']." business(es) allowed in your subscription. Want more? Updgrade your subscription now",
                            'warning' => 'Bussiness count exceeded'
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Apparently your package has expired, please renew your subscription in the Sucscription menu',
                    'warning' => 'Expired'
                ]);
            }

            $check_name = std_get([
                'table_name' => 'mabus',
                'where' => [
                    [
                        'field_name' => 'MABUS_MAUSR_ID',
                        'operator' => '=',
                        'value' => session('id')
                    ],
                    [
                        'field_name' => 'MABUS_NAME',
                        'operator' => '=',
                        'value' => $req->MABUS_NAME
                    ]
                ],
                'first_row' => true
            ]);

            if($check_name != NULL)
            {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'A business with the same name is already exists',
                    'warning' => 'Business Name Not Available'
                ]);
            } else {
                $save_mabus = std_insert([
                    'table_name' => 'mabus',
                    'data' => [
                        'MABUS_MAUSR_ID' => session('id'),
                        'MABUS_NAME' => $req->MABUS_NAME,
                        'MABUS_DESC' => $req->MABUS_DESC,
                        'MABUS_CONTACT' => $req->MABUS_CONTACT,
                        'MABUS_ADDRESS' => $req->MABUS_ADDRESS,
                        'MABUS_CRTD_BY' => session('id'),
                        'MABUS_CRTD_BY_TEXT' => session('username'),
                        'MABUS_CRTD_TIMESTAMP' => date('Y-m-d H:i:s'),
                        'MABUS_STATUS' => 1
                    ]
                ]);

                if($save_mabus === false)
                {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Somthing went wrong when saving new business',
                        'warning' => 'Internal Server Error'
                    ]);
                } else 
                {
                    return response()->json([
                        'status' => 'done',
                        'message' => 'Business Added',
                        'warning' => 'Successfully Added'
                    ]);
                }
            }
        }
    }

    public function edit(Request $req)
    {
        $validate = Validator::make($req->all(),[
            'id' => 'required|exists:mabus,MABUS_ID',
            'MABUS_NAME' => 'required|max:255',
            'MABUS_DESC' => 'required|max:65000',
            'MABUS_CONTACT' => 'required|max:255',
            'MABUS_ADDRESS' => 'required|max:255'
        ]);

        $att = [
            'id' => 'Business ID',
            'MABUS_NAME' => 'Business Name',
            'MABUS_DESC' => 'Business Description',
            'MABUS_CONTACT' => 'Business Contact',
            'MABUS_ADDRESS' => 'Business Address'
        ];

        $validate->setAttributeNames($att);

        if($validate->fails())
        {
            return response()->json([
                'status' => 'warning',
                'message' => $validate->errors()->all(),
                'warning' => 'Invalid'
            ]);
        } else {
            $get_mabus = std_get([
                'table_name' => 'mabus',
                'where' => [
                    [
                        'field_name' => 'MABUS_ID',
                        'operator' => '=',
                        'value' => $req->id
                    ]
                ],
                'first_row' => true
            ]);

            if($req->MABUS_NAME != $get_mabus['MABUS_NAME'])
            {
                $check_name = std_get([
                    'table_name' => 'mabus',
                    'where' => [
                        [
                            'field_name' => 'MABUS_MAUSR_ID',
                            'operator' => '=',
                            'value' => session('id')
                        ],
                        [
                            'field_name' => 'MABUS_NAME',
                            'operator' => '=',
                            'value' => $req->MABUS_NAME
                        ]
                    ],
                    'first_row' => true
                ]);
    
                if($check_name != NULL)
                {
                    return response()->json([
                        'status' => 'warning',
                        'message' => 'A business with the same name is already exists',
                        'warning' => 'Business Name Not Available'
                    ]);
                }    
            }

            $update_mabus = std_update([
                'table_name' => 'mabus',
                'data' => [
                    'MABUS_NAME' => $req->MABUS_NAME,
                    'MABUS_DESC' => $req->MABUS_DESC,
                    'MABUS_CONTACT' => $req->MABUS_CONTACT,
                    'MABUS_ADDRESS' => $req->MABUS_ADDRESS,
                    'MABUS_UPDT_BY' => session('id'),
                    'MABUS_UPDT_BY_TEXT' => session('username'),
                    'MABUS_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
                ],
                'where' => [
                    'MABUS_ID' => $req->id
                ]
            ]);

            if($update_mabus === false)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Somthing went wrong when saving new business',
                    'warning' => 'Internal Server Error'
                ]);
            } else 
            {
                return response()->json([
                    'status' => 'done',
                    'message' => 'Business Updated',
                    'warning' => 'Successfully Updated'
                ]);
            }
        }
    }

    public function open($id)
    {
        $update_mabus = std_update([
            'table_name' => 'mabus',
            'data' => [
                'MABUS_STATUS' => 1,
                'MABUS_UPDT_BY' => session('id'),
                'MABUS_UPDT_BY_TEXT' => session('username'),
                'MABUS_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
            ],
            'where' => [
                'MABUS_ID' => $id
            ]
        ]);

        if($update_mabus === false)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong when updating business status',
                'warning' => 'Internal Server Error'
            ]);
        } else {
            return response()->json([
                'status' => 'done',
                'message' => 'status is now open',
                'warning' => 'Successfully changed'
            ]);
        }
    }

    public function close($id)
    {
        $update_mabus = std_update([
            'table_name' => 'mabus',
            'data' => [
                'MABUS_STATUS' => 0,
                'MABUS_UPDT_BY' => session('id'),
                'MABUS_UPDT_BY_TEXT' => session('username'),
                'MABUS_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
            ],
            'where' => [
                'MABUS_ID' => $id
            ]
        ]);

        if($update_mabus === false)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong when updating business status',
                'warning' => 'Internal Server Error'
            ]);
        } else {
            return response()->json([
                'status' => 'done',
                'message' => 'status is now open',
                'warning' => 'Successfully changed'
            ]);
        }
    }

    public function delete($id)
    {
        $update_mabus = std_update([
            'table_name' => 'mabus',
            'data' => [
                'MABUS_STATUS' => 2,
                'MABUS_UPDT_BY' => session('id'),
                'MABUS_UPDT_BY_TEXT' => session('username'),
                'MABUS_UPDT_TIMESTAMP' => date('Y-m-d H:i:s')
            ],
            'where' => [
                'MABUS_ID' => $id
            ]
        ]);

        if($update_mabus === false)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong when updating business status',
                'warning' => 'Internal Server Error'
            ]);
        } else {
            return response()->json([
                'status' => 'done',
                'message' => 'is deleted',
                'warning' => 'Successfully deleted'
            ]);
        }
    }
}
