<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

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
			$id = "'".$d->MAUSR_CODE."'";
			$name = "'".$d->MAUSR_FULL_NAME."'";
    		$data .= '<tr>
    					<td>'.$no++.'</td>
    					<td>'.$d->MAUSR_CODE.'</td>
    					<td>'.$d->MAUSR_FULL_NAME.'</td>
    					<td>'.$d->MAUSR_EMAIL_ADDRESS.'</td>
						<td>
							<button class="btn btn-success btn-sm btn-fab btn-round" onclick="editUser('.$id.','.$name.')">
								<i class="fa fa-edit"></i>
							</button>
							<button class="btn btn-danger btn-sm btn-fab btn-round" onclick="hapusUser('.$id.','.$name.')">
								<i class="fa fa-trash"></i>
							</button>
						</td>
    				</tr>';
    	}

    	$data .=			'</tbody>
    					</table>';

    	return json_encode($data);
    }
}
