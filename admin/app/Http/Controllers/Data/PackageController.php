<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function packages()
    {
        $get_packages = std_get([
            'table_name' => 'mapack',
            'order_by' => [
                [
                    'field' => 'MAPACK_CRTD_TIMESTAMP',
                    'type' => 'DESC'
                ]
            ]
        ]);

        $html = '<table id="tdata" class="table align-items-center">
                    <thead class="thead-default">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Package Code</th>
                            <th scope="col">Package Name</th>
                            <th scope="col">Package Price</th>
                            <th scope="col">Max Business</th>
                            <th scope="col">Max Employee</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="list">';

        foreach($get_packages as $get_package)
        {
            $change = "'form/package/edit_package/".$get_package['MAPACK_ID']."'";
            $status = $get_package['MAPACK_STATUS'];
            $key = "'".$get_package['MAPACK_NAME']."'";
    
            $Btn = '';
    
            if($status == 1)
            {
                $status = '<i class="badge badge-info">Active</i>';
                $Btn = '<a class="dropdown-item" href="#" onclick="deactivatePackage('.$key.','.$get_package['MAPACK_ID'].')">Deactivate</a>';
            } else {
                $status = '<i class="badge badge-danger">Deactive</i>';
                $Btn = '<a class="dropdown-item" href="#" onclick="activatePackage('.$key.','.$get_package['MAPACK_ID'].')">Activate</a>';
            }
    
            $html.= '   <tr>
                            <td></td>
                            <td>'.$get_package['MAPACK_CODE'].'</td>
                            <td>'.$get_package['MAPACK_NAME'].'</td>
                            <td>Rp. '.number_format($get_package['MAPACK_PRICE']).'</td>
                            <td>'.number_format($get_package['MAPACK_MAX_BUSINESS']).'</td>
                            <td>'.number_format($get_package['MAPACK_MAX_EMPLOYEE']).'</td>
                            <td>'.$get_package['MAPACK_DESC'].'</td>
                            <td>'.$status.'</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="#" onClick="showForm('.$change.')">Edit</a>
                                        '.$Btn.'
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
