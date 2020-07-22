<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function add_admin()
    {
        $html = '<div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Add New Admin</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" id="add" enctype="multipart/form-data">
                    '.csrf_field().'
                    <div class="modal-body">
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Username" name="MADMIN_USERNAME" id="MADMIN_USERNAME" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Password" name="MADMIN_PASSWORD" id="MADMIN_PASSWORD" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Full Name" name="MADMINPRO_FULLNAME" id="MADMINPRO_FULLNAME" >
                            </div>
                        </div>
                        <div class="form-group row col-lg-12">
                            <div class="input-group col-lg-6">
                                <input type="text" class="form-control" placeholder="City Of Birth" name="MADMINPRO_COB" id="MADMINPRO_COB" >
                            </div>
                            <div class="input-group col-lg-6">
                                <input type="text" class="form-control" placeholder="Country Of Birth" name="MADMINPRO_NOB" id="MADMINPRO_NOB" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="date" class="form-control datepicker" placeholder="" name="MADMINPRO_DOB" id="MADMINPRO_DOB" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="file" class="form-control" name="MADMINPRO_PHOTO" id="MADMINPRO_PHOTO" accept="image/*" >
                        </div>
                        <div class="form-group">
                            <div class="modal-footer">
                                <button type="submit" id="addBtn" class="btn btn-success"><i class="fa fa-check"></i>Save</button>
                                <button class="btn btn-white text-link ml-auto" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>';
        
        return response()->json([
            'html' => $html
        ]);
    }

    public function edit_admin($id)
    {
        $get_admin = std_get([
            'table_name' => 'madmin',
            'where' => [
                [
                    'field_name' => 'MADMIN_ID',
                    'operator' => '=',
                    'value' => $id
                ]
            ],
            'first_row' => true
        ]);

        $get_admin_profile = std_get([
            'table_name' => 'madminpro',
            'where' => [
                [
                    'field_name' => 'MADMINPRO_MADMIN_ID',
                    'operator' => '=',
                    'value' => $id
                ]
            ],
            'first_row' => true
        ]);

        $html = '<div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Edit Admin Info</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" id="edit" enctype="multipart/form-data">
                    '.csrf_field().'
                    <input type="hidden" name="id" value="'.$id.'">
                    <div class="modal-body">
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Username" name="MADMIN_USERNAME" id="MADMIN_USERNAME" value="'.$get_admin['MADMIN_USERNAME'].'" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Full Name" name="MADMINPRO_FULLNAME" id="MADMINPRO_FULLNAME" value="'.$get_admin_profile['MADMINPRO_FULLNAME'].'"  >
                            </div>
                        </div>
                        <div class="form-group row col-lg-12">
                            <div class="input-group col-lg-6">
                                <input type="text" class="form-control" placeholder="City Of Birth" name="MADMINPRO_COB" id="MADMINPRO_COB" value="'.$get_admin_profile['MADMINPRO_COB'].'"   >
                            </div>
                            <div class="input-group col-lg-6">
                                <input type="text" class="form-control" placeholder="Country Of Birth" name="MADMINPRO_NOB" id="MADMINPRO_NOB" value="'.$get_admin_profile['MADMINPRO_NOB'].'"   >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="date" class="form-control datepicker" placeholder="Password" name="MADMINPRO_DOB" id="MADMINPRO_DOB"  value="'.$get_admin_profile['MADMINPRO_DOB'].'"   >
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
