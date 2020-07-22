<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function change_picture()
    {
        $get_user_profile = std_get([
            'table_name' => 'mauspro',
            'where' => [
                [
                    'field_name' => 'MAUSPRO_MAUSR_ID',
                    'operator' => '=',
                    'value' => session('id')
                ]
            ],
            'first_row' => true
        ]);

        $html = '<div class="modal-header">
                        <h6 class="modal-title" id="modal-title-notification">Profile Picture</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="ubahFoto" enctype="multipart/form-data">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.session('id').'">
                        <div class="form-group col-lg-12">
                            <center>
                                <img src="public/storage/uploaded/MAUSPRO_PHOTO/'.$get_user_profile['MAUSPRO_PHOTO'].'" class="rounded-circle mb-5" style="width:200px; object-fit:contain;">
                            </center>
                            <div class="modal-body">
                                <input type="file" class="form-control" name="MAUSPRO_PHOTO" id="MAUSPRO_PHOTO" accept="image/*">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="modal-footer">
                                <button type="submit" id="editBtn" class="btn btn-success"><i class="fa fa-edit"></i>Update</button>
                                <button class="btn btn-white text-link ml-auto" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>';
        
        return response()->json([
            'html' => $html
        ]);
    }
}
