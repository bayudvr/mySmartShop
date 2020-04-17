<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class FormController extends Controller
{
    public function user($id){

        $getUser = std_get([
            'table_name'=>'MAUSR',
            'special_where'=>[
                [
                    'field_name'=>'MAUSR_CODE',
                    'operator'=>'=',
                    'value'=>$id
                ]
            ],
            'first_row' => true
        ]);

            $data = '<form id="editUserForm" class="col-md-12" method="POST">
                        '.csrf_field().'
                        <div class="form-group row">
                            <label for="email" class="col-md-4 label-control" style="color:#000000;">Email</label>
                            <input class="col-md-8 form-control" type="email" id="email" name="email" value="'.$getUser["MAUSR_EMAIL_ADDRESS"].'" placeholder="example@yourmail.domain" required>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 label-control" style="color:#000000;">Full Name</label>
                            <input class="col-md-8 form-control" type="text" id="fullName" name="fullName" value="'.$getUser["MAUSR_FULL_NAME"].'" placeholder="your full name" required>
                        </div>
                        <div class="form-group">
                            <center>
                                <button type="submit" class="btn btn-success" value="Update">Update</button>
                            </center>
                        </div>
                    </form>';

        return $data;
    }
}
