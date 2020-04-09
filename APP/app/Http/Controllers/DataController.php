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
    	$data = '<button class="btn btn-fab btn-primary mb-3" onclick="showDataUser();"><i class="fa fa-retweet"></i></button>
    	<table class="table table-striped mb-3" id="tdata">
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
							<div class="dropdown-menu pl-auto pr-auto">
								<a class="dropdown-item">
									<button class="btn btn-success"><i class="fa fa-edit"></i> Edit</button>
								</a>
								<a class="dropdown-item">
									<button class="btn btn-danger"><i class="fa fa-trash"></i> Remove</button>
								</a>
							</div>
						</td>
    				</tr>';
    	}

    	$data .=			'</tbody>
    					</table>';

    	return json_encode($data);
    }
}
