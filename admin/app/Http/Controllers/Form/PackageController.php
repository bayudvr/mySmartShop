<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function add_package()
    {
        $html = '<div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Add New Package</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" id="add" enctype="multipart/form-data">
                    '.csrf_field().'
                    <div class="modal-body">
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Code" name="MAPACK_CODE" id="MAPACK_CODE" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Name" name="MAPACK_NAME" id="MAPACK_NAME" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Price" name="MAPACK_PRICE" id="MAPACK_PRICE" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Maximum Business" name="MAPACK_MAX_BUSINESS" id="MAPACK_MAX_BUSINESS" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Maximum Employee" name="MAPACK_MAX_EMPLOYEE" id="MAPACK_MAX_EMPLOYEE" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <textarea rows="5" placeholder="Package  Description" name="MAPACK_DESC" class="form-control"></textarea>
                            </div>
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

    public function edit_package($id)
    {
        $gp = std_get([
            'table_name' => 'mapack',
            'where' => [
                [
                    'field_name' => 'MAPACK_ID',
                    'operator' => '=',
                    'value' => $id
                ]
            ],
            'first_row' => true
        ]);

        $html = '<div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Add New Package</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" id="edit" enctype="multipart/form-data">
                    '.csrf_field().'
                    <input type="hidden" value="'.$gp['MAPACK_ID'].'" name="id">
                    <div class="modal-body">
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Code" name="MAPACK_CODE" id="MAPACK_CODE" value="'.$gp['MAPACK_CODE'].'" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Name" name="MAPACK_NAME" id="MAPACK_NAME" value="'.$gp['MAPACK_NAME'].'" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Price" name="MAPACK_PRICE" id="MAPACK_PRICE" value="'.$gp['MAPACK_PRICE'].'" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Maximum Business" name="MAPACK_MAX_BUSINESS" id="MAPACK_MAX_BUSINESS" value="'.$gp['MAPACK_MAX_BUSINESS'].'">
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Maximum Employee" name="MAPACK_MAX_EMPLOYEE" id="MAPACK_MAX_EMPLOYEE" value="'.$gp['MAPACK_MAX_EMPLOYEE'].'">
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <textarea rows="5" placeholder="Package  Description" name="MAPACK_DESC" class="form-control">'.$gp['MAPACK_DESC'].'</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="modal-footer">
                                <button type="submit" id="addBtn" class="btn btn-success"><i class="fa fa-edit"></i>Update</button>
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
