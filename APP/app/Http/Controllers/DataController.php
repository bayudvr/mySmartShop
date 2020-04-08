<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function user(){

    	$getData = std_get([
    		'table_name' => 'MAUSR'
    	]);
    	$no = 1;
    	$data = '<table class="table table-striped mb-3" id="tdata">
    						<thead>
    							<tr>
    								<th>No.</th>
    								<th>Code</th>
    								<th>Full Name</th>
    								<th>Email</th>
    								<th>Action</th>
    							</tr>
    						</thead>
    						<tbody>';
    	foreach($getData as $d){
    		$data .= '<tr>
    					<td>'.$no++.'</td>
    					<td>'.$d->MAUSR_CODE.'</td>
    					<td>'.$d->MAUSR_FULL_NAME.'</td>
    					<td>'.$d->MAUSR_EMAIL_ADDRESS.'</td>
						<td>
							<button class="dropdown btn btn-outline-success btn-fab btn-round" data-toggle="dropdown">
								<i class="fa fa-ellipsis-v"></i>
							</button>
							<div class="dropdown-menu">
								<button class="btn btn-fab btn-sm btn-success"><i class="fa fa-edit"></i></button>
								<button class="btn btn-fab btn-sm btn-danger"><i class="fa fa-trash"></i></button>
							</div>
						</td>
    				</tr>';
    	}

    	$data .=			'</tbody>
    					</table>';

    	return json_encode($data);
    }
}
