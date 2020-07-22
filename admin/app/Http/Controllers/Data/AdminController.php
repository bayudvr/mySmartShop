<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function admins()
    {
        $get_admin = std_get([
            'table_name' => 'madmin',
            'where' => [
                [
                    'field_name' => 'MADMIN_ID',
                    'operator' => '!=',
                    'value' => session('id')
                ]
            ],
            'order_by' => [
                [
                    'field' => 'MADMIN_CRTD_TIMESTAMP',
                    'type' => 'DESC'
                ]
            ]
        ]);

        $get_admin_profile = std_get([
            'table_name' => 'madminpro'
        ]);

        $html = '<table id="tdata" class="table align-items-center">
                        <thead class="thead-default">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Username</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Date Of Birth</th>
                                <th scope="col">BirthPlace</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">';
        
        foreach($get_admin as $ga)
        {
            $change = "'form/admin/edit_admin/".$ga['MADMIN_ID']."'";

            $status = $ga['MADMIN_STATUS'];

            $html .= '       <tr>
                                <td></td>
                                <td>'.$ga['MADMIN_USERNAME'].'</td>';
            
            foreach($get_admin_profile as $gaf)
            {
                if($ga['MADMIN_ID'] == $gaf['MADMINPRO_MADMIN_ID'])
                {
                    $key = "'".$gaf['MADMINPRO_FULLNAME']."'";

                    $banBtn = '';
    
                    if($status == 1)
                    {
                        $status = '<i class="badge badge-info">Active</i>';
                        $banBtn = '<a class="dropdown-item" href="#" onclick="banAdmin('.$key.','.$gaf['MADMINPRO_MADMIN_ID'].')">Ban</a>';
                    } else {
                        $status = '<i class="badge badge-danger">Banned</i>';
                        $banBtn = '<a class="dropdown-item" href="#" onclick="unbanAdmin('.$key.','.$gaf['MADMINPRO_MADMIN_ID'].')">Unban</a>';
                    }

                    $html.= '   <td>'.$gaf['MADMINPRO_FULLNAME'].'</td>
                                <td>'.date('dS M, Y',strtotime($gaf['MADMINPRO_DOB'])).'</td>
                                <td>'.$gaf['MADMINPRO_COB'].', '.$gaf['MADMINPRO_NOB'].'</td>
                                <td>'.$status.'</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#" onClick="showForm('.$change.')">Edit</a>
                                            '.$banBtn.'
                                        </div>
                                    </div>
                                </td>';
                }
            }

            $html .= '</tr>';
        }

        $html.= '            
                        </tbody>
                    </table>';
        
        return response()->json([
            'html' => $html
        ]);
    }
}
