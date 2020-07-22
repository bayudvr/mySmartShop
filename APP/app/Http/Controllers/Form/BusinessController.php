<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function add()
    {
        $html = '<div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Add Business</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="add" enctype="multipart/form-data">
                    '.csrf_field().'
                    <input type="hidden" name="id" value="'.session('id').'">
                    <div class="modal-body">
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Business Name" name="MABUS_NAME" autofocus>
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <textarea class="form-control" rows="5" placeholder="Business Description" name="MABUS_DESC"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Business Contact" name="MABUS_CONTACT">
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Business Address" name="MABUS_ADDRESS">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="modal-footer">
                            <button type="submit" id="addBtn" class="btn btn-success"><i class="fa fa-check"></i>Save</button>
                            <button class="btn btn-white text-link ml-auto" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>';

        return response()->json([
            'html' => $html
        ]);
    }

    public function edit($id)
    {
        $get_mabus = std_get([
            'table_name' => 'mabus',
            'where' => [
                [
                    'field_name' => 'MABUS_ID',
                    'operator' => '=',
                    'value' => $id
                ]
            ],
            'first_row' => true
        ]);

        $html = '<div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Edit Business</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="edit" enctype="multipart/form-data">
                    '.csrf_field().'
                    <input type="hidden" name="id" value="'.$get_mabus['MABUS_ID'].'">
                    <div class="modal-body">
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Business Name" name="MABUS_NAME" value="'.$get_mabus['MABUS_NAME'].'" autofocus>
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <textarea class="form-control" rows="5" placeholder="Business Description" name="MABUS_DESC">'.$get_mabus['MABUS_DESC'].'</textarea>
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Business Contact" name="MABUS_CONTACT" value="'.$get_mabus['MABUS_CONTACT'].'">
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Business Address" name="MABUS_ADDRESS" value="'.$get_mabus['MABUS_ADDRESS'].'">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="modal-footer">
                            <button type="submit" id="editBtn" class="btn btn-success"><i class="fa fa-edit"></i>update</button>
                            <button class="btn btn-white text-link ml-auto" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>';

        return response()->json([
            'html' => $html
        ]);
    }
}
