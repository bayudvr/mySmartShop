<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function get()
    {
        $get_user_package = std_get([
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
                ]   
            ],
            'first_row' => true
        ]);

        $get_package = std_get([
            'table_name' => 'mapack',
            'where' => [
                [
                    'field_name' => 'MAPACK_CODE',
                    'operator' => '=',
                    'value' => $get_user_package['TRPACK_MAPACK_CODE']
                ]
            ],
            'first_row' => true
        ]);

        $status = $get_user_package['TRPACK_STATUS'];
        $until = null;
        $btn = null;

        if($status == 0)
        {
            $status = '<span class="badge badge-info">Waiting for Payment</span>';
            $until = date('dS F Y',strtotime($get_user_package['TRPACK_CRTD_TIMESTAMP'].' +1 month')).' (Until Payment Confirmed)';
            $btn = '<button class="btn btn-info" onClick="payNow()">Pay Now</button>';
        } else if($status == 1)
        {
            $status = '<span class="badge badge-success">Active</span>';
            $until = date('dS F Y',strtotime($get_user_package['TRPACK_UNTIL']));
            $btn = '';
        } else if($status == 2)
        {
            $status = '<span class="badge badge-danger">Expired</span>';
            $until = date('dS F Y',strtotime($get_user_package['TRPACK_UNTIL']));
            $btn = '<button class="btn btn-danger" onClick="renew()">Renew Package</button>';
        }

        $html = '<table class="table table-striped table-hover table-dark">
                    <tr>
                        <td>Package Name</td>
                        <td></td>
                        <td>'.$get_package['MAPACK_NAME'].'</td>
                    </tr>
                    <tr>
                        <td>Expiration Date</td>
                        <td></td>
                        <td>'.$until.'</td>
                    </tr>
                    <tr>
                        <td>Package Status</td>
                        <td></td>
                        <td>'.$status.'</td>
                    </tr>
                    <tr>
                        <td>Total Payment</td>
                        <td></td>
                        <td>Rp. '.number_format($get_user_package['TRPACK_TOTAL_PRICE']).'</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>'.$btn.'</td>
                        <td></td>
                    </tr>
                </table>';

        return response()->json([
            'html' => $html
        ]);
    }
}
