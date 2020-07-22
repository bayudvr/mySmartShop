<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function change_password()
    {
        $html = '<div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Change Password</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" id="change_password" enctype="multipart/form-data">
                    '.csrf_field().'
                    <div class="modal-body">
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="New Password" name="MADMIN_PASSWORD" id="MADMIN_PASSWORD" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="Confirm New Password" name="new_pass" id="new_pass" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="modal-footer">
                                <button type="submit" id="editBtn" class="btn btn-success"><i class="fa fa-edit"></i>Update</button>
                                <button class="btn btn-white text-link ml-auto" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>';

        return response()->json([
            'html' => $html
        ]);
    }
}
