<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function get()
    {
        $business = std_get([
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

        $html = '<table id="tdata" class="table align-items-center">
                        <thead class="thead-default">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Name</th>
                                <th scope="col">Employee</th>
                                <th scope="col">Description</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Address</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">';

        foreach($business as $b)
        {
            $change = "'form/business/edit/".$b['MABUS_ID']."'";
            $status = $b['MABUS_STATUS'];

            $key = "'".$b['MABUS_NAME']."'";

            if($status == 1)
            {
                $status = '<span class="badge badge-success">Open</span>';
                $btn = '<a class="dropdown-item" href="#" onclick="closeBusiness('.$key.','.$b['MABUS_ID'].')">Close Business</a>';
            } else {
                $status = '<span class="badge badge-danger">Close</span>';
                $btn = '<a class="dropdown-item" href="#" onclick="openBusiness('.$key.','.$b['MABUS_ID'].')">Open Business</a>';
            }

            $get_employee = std_get([
                'table_name' => 'maemp',
                'where' => [
                    [
                        'field_name' => 'MAEMP_MABUS_ID',
                        'operator' => '=',
                        'value' => $b['MABUS_ID']
                    ]
                ]
            ]);

            $employee = count($get_employee);

            $html .= '<tr>
                        <td></td>
                        <td>'.$b['MABUS_NAME'].'</td>
                        <td>'.$employee.'</td>
                        <td>'.$b['MABUS_DESC'].'</td>
                        <td>'.$b['MABUS_CONTACT'].'</td>
                        <td>'.$b['MABUS_ADDRESS'].'</td>
                        <td>'.$status.'</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="#" onClick="showForm('.$change.')">Edit</a>
                                    '.$btn.'
                                    <a class="dropdown-item" href="#" onClick="deleteBusiness('.$key.','.$b['MABUS_ID'].')">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>';
        }

        $html.= '            
                        </tbody>
                    </table>';

        return response()->json([
            'html' => $html
        ]);
    }
}
