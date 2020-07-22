<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        $get_user = std_get([
            'table_name' => 'mausr',
            'order_by' =>[
                [
                    'field' => 'MAUSR_CRTD_TIMESTAMP',
                    'type' => 'DESC'
                ]
            ]
        ]);

        $get_user_profile = std_get([
            'table_name' => 'mauspro'
        ]);
        
        $html = '<table id="tdata" class="table align-items-center">
                    <thead class="thead-default">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Username</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Date Of Birth</th>
                            <th scope="col">Birthplace</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="list">';

        foreach($get_user as $gu)
        {
            $status = $gu['MAUSR_STATUS'];
            $change = "'form/user/edit_user/".$gu['MAUSR_ID']."'";
            $key = "'".$gu['MAUSR_FULLNAME']."'";
            $banBtn = '';

            if($status == 1)
            {
                $status = '<i class="badge badge-info">Active</i>';
                $banBtn = '<a class="dropdown-item" href="#" onclick="banUser('.$key.','.$gu['MAUSR_ID'].')">Ban</a>';
            } else {
                $status = '<i class="badge badge-danger">Banned</i>';
                $banBtn = '<a class="dropdown-item" href="#" onclick="unbanUser('.$key.','.$gu['MAUSR_ID'].')">Unban</a>';
            }

            foreach($get_user_profile as $gup)
            {
                if($gu['MAUSR_ID'] == $gup['MAUSPRO_MAUSR_ID'])
                {                    
                    $html .= '  <tr>
                                    <td></td>
                                    <td>'.$gu['MAUSR_USERNAME'].'</td>
                                    <td>'.$gu['MAUSR_FULLNAME'].'</td>
                                    <td>'.$gu['MAUSR_EMAIL'].'</td>
                                    <td>'.date('dS M Y', strtotime($gup['MAUSPRO_DOB'])).'</td>
                                    <td>'.$gup['MAUSPRO_COB'].', '.$gup['MAUSPRO_NOB'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="#" onClick="showForm('.$change.')">Edit</a>'.$banBtn.'
                                            </div>
                                        </div>
                                    </td>
                                </tr>';
                }
            }
        }

        $html.= '   </tbody>
                </table>';

        return response()->json([
            'html' => $html
        ]);
    }
}
