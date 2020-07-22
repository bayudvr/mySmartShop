<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // public function add_user()
    // {
    //     $html = '<div class="modal-header">
    //                 <h6 class="modal-title" id="modal-title-notification">Add New User</h6>
    //                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    //                     <span aria-hidden="true">×</span>
    //                 </button>
    //             </div>
    //             <form method="POST" id="add" enctype="multipart/form-data">
    //                 '.csrf_field().'
    //                 <div class="modal-body">
    //                     <div class="form-group col-lg-12">
    //                         <div class="input-group">
    //                             <input type="text" class="form-control" placeholder="Username" name="MAUSR_USERNAME" id="MAUSR_USERNAME" >
    //                         </div>
    //                     </div>
    //                     <div class="form-group col-lg-12">
    //                         <div class="input-group">
    //                             <input type="email" class="form-control" placeholder="Email Address" name="MAUSR_EMAIL" id="MAUSR_EMAIL" >
    //                         </div>
    //                     </div>
    //                     <div class="form-group col-lg-12">
    //                         <div class="input-group">
    //                             <input type="text" class="form-control" placeholder="Password" name="MAUSR_PASSWORD" id="MAUSR_PASSWORD" >
    //                         </div>
    //                     </div>
    //                     <div class="form-group col-lg-12">
    //                         <div class="input-group">
    //                             <input type="text" class="form-control" placeholder="Full Name" name="MAUSR_FULLNAME" id="MAUSR_FULLNAME" >
    //                         </div>
    //                     </div>
    //                     <div class="form-group col-lg-12">
    //                         <div class="input-group">
    //                             <input type="date" class="form-control" name="MAUSPRO_DOB" id="MAUSPRO_DOB" >
    //                         </div>
    //                     </div>
    //                     <div class="form-group col-lg-12">
    //                         <div class="input-group">
    //                             <input type="text" class="form-control" placeholder="City of Birth" name="MAUSPRO_COB" id="MAUSPRO_COB" >
    //                         </div>
    //                     </div>
    //                     <div class="form-group col-lg-12">
    //                         <div class="input-group">
    //                             <input type="text" class="form-control" placeholder="Nation of Birth" name="MAUSPRO_NOB" id="MAUSPRO_NOB" >
    //                         </div>
    //                     </div>
    //                     <div class="form-group">
    //                         <div class="modal-footer">
    //                             <button type="submit" id="addBtn" class="btn btn-success"><i class="fa fa-check"></i>Save</button>
    //                             <button class="btn btn-white text-link ml-auto" data-dismiss="modal">Close</button>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </form>';

    //     return response()->json([
    //         'html' => $html
    //     ]);
    // }

    public function edit_user($id)
    {
        $get_user = std_get([
            'table_name' => 'mausr',
            'where' => [
                [
                    'field_name' => 'MAUSR_ID',
                    'operator' => '=',
                    'value' => $id
                ]
            ],
            'first_row' => true
        ]);

        $get_user_profile = std_get([
            'table_name' => 'mauspro',
            'where' => [
                [
                    'field_name' => 'MAUSPRO_MAUSR_ID',
                    'operator' => '=',
                    'value' => $id
                ]
            ],
            'first_row' => true
        ]);

        $html = '<div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Edit User</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" id="edit" enctype="multipart/form-data">
                    '.csrf_field().'
                    <input type="hidden" name="id" value="'.$get_user['MAUSR_ID'].'" >
                    <div class="modal-body">
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Username" name="MAUSR_USERNAME" id="MAUSR_USERNAME" value="'.$get_user['MAUSR_USERNAME'].'" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Email Address" name="MAUSR_EMAIL" id="MAUSR_EMAIL" value="'.$get_user['MAUSR_EMAIL'].'" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Full Name" name="MAUSR_FULLNAME" id="MAUSR_FULLNAME" value="'.$get_user['MAUSR_FULLNAME'].'" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="date" class="form-control" name="MAUSPRO_DOB" id="MAUSPRO_DOB" value="'.$get_user_profile['MAUSPRO_DOB'].'">
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="City of Birth" name="MAUSPRO_COB" value="'.$get_user_profile['MAUSPRO_COB'].'" id="MAUSPRO_COB" >
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nation of Birth" name="MAUSPRO_NOB" id="MAUSPRO_NOB" value="'.$get_user_profile['MAUSPRO_NOB'].'">
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
