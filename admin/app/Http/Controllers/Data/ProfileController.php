<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profile_user($key)
    {
        $get_user = std_get([
            'table_name' => 'madmin',
            'where' => [
                [
                    'field_name' => 'MADMIN_ID',
                    'operator' => '=',
                    'value' => session('id')
                ]
            ],
            'first_row' => true
        ]);

        $get_user_profile = std_get([
            'table_name' => 'madminpro',
            'where' => [
                [
                    'field_name' => 'MADMINPRO_MADMIN_ID',
                    'operator' => '=',
                    'value' => session('id')
                ]
            ],
            'first_row' => true
        ]);

        $html = '';

        if($key == 'welcome_message')
        {
            if($get_user_profile == NULL)
            {
                $html .= 'Hello, '.$get_user['MADMIN_USERNAME'];
            } else {
                $html .= 'Hello, '.$get_user_profile['MADMINPRO_FULLNAME'];
            }
            return response()->json([
                'html' => $html
            ]);
        }

        if($key == 'admin_profiles')
        {
            $change = "'form/profile/change_picture'";

            if($get_user_profile != NULL)
            {    
                $level = $get_user['MADMIN_LEVEL'];
    
                if($level == 1)
                {
                    $level = 'Super Admin';
                } else if($level == 2)
                {
                    $level = 'Admin';
                }
    
                $html .= '<img src="./assets/vendor/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image" id="admin_photo">
                                    <a href="#">
                                        <img src="./storage/uploaded/MADMINPRO_PHOTO/'.$get_user_profile['MADMINPRO_PHOTO'].'" class="rounded-circle" style="width:100px; object-fit:cover;">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-sm btn-info mr-4 ">'.$level.'</button>
                            <button class="btn btn-sm btn-success ml-4" onClick="showForm('.$change.')">
                                <i class="ni ni-album-2"></i> Change
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="h3">'.$get_user_profile['MADMINPRO_FULLNAME'].', ('.date('dS M Y',strtotime($get_user_profile['MADMINPRO_DOB'])).')</h5>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>'.$get_user_profile['MADMINPRO_COB'].', '.$get_user_profile['MADMINPRO_NOB'].'
                            </div>
                        </div>
                    </div>';
            } else {
                $level = $get_user['MADMIN_LEVEL'];
    
                if($level == 1)
                {
                    $level = 'Super Admin';
                } else if($level == 2)
                {
                    $level = 'Admin';
                }
    
                $html .= '<img src="./assets/vendor/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image" id="admin_photo">
                                    <a href="#">
                                        <img src="#" class="rounded-circle" style="width:100px; object-fit:cover;">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-sm btn-info mr-4 ">'.$level.'</button>
                            <button class="btn btn-sm btn-success ml-4" onClick="showForm('.$change.')">
                                <i class="ni ni-album-2"></i> Change
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="h3">'.$get_user['MADMIN_USERNAME'].', (Undefined)</h5>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>Undefined, Undefined
                            </div>
                        </div>
                    </div>';
            }

            return response()->json([
                'html' => $html
            ]);
        }

        if($key == 'admin_profile_data')
        {
            if($get_user_profile != NULL)
            {
                $html .= '<form method="POST" id="editProfile" enctype="multipart/form-data">
                                    '.csrf_field().'
                                    <input type="hidden" name="id" value="'.$get_user['MADMIN_ID'].'"></input>
                                    <h6 class="heading-small text-muted mb-4">User information</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="MADMIN_USERNAME">Username</label>
                                                    <input type="text" id="MADMIN_USERNAME" name="MADMIN_USERNAME" class="form-control" placeholder="Username" value="'.$get_user['MADMIN_USERNAME'].'" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="MADMINPRO_FULLNAME" class="form-control-label">Fullname</label>
                                                        <input type="text" name="MADMINPRO_FULLNAME" id="MADMINPRO_FULLNAME" class="form-control" placeholder="Your Full Name" value="'.$get_user_profile['MADMINPRO_FULLNAME'].'" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="MADMINPRO_COB">City</label>
                                                        <input type="text" id="MADMINPRO_COB" name="MADMINPRO_COB" class="form-control" placeholder="City" value="'.$get_user_profile['MADMINPRO_COB'].'" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="MADMINPRO_NOB">Country</label>
                                                        <input type="text" id="MADMINPRO_NOB" name="MADMINPRO_NOB" class="form-control" placeholder="Country" value="'.$get_user_profile['MADMINPRO_NOB'].'" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="MADMINPRO_DOB" class="form-control-label">Date Of Birth</label>
                                                        <input type="date" name="MADMINPRO_DOB" id="MADMINPRO_DOB" class="form-control" placeholder="Select Date" value="'.$get_user_profile['MADMINPRO_DOB'].'" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <button class="btn btn-primary" id="updateBtn" type="submit">Update</button>
                                </form>';
            } else {
                $html .= '<form method="POST" id="editProfile" enctype="multipart/form-data">
                                    '.csrf_field().'
                                    <input type="hidden" name="id" value="'.$get_user['MADMIN_ID'].'"></input>
                                    <h6 class="heading-small text-muted mb-4">User information</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="MADMIN_USERNAME">Username</label>
                                                    <input type="text" id="MADMIN_USERNAME" name="MADMIN_USERNAME" class="form-control" placeholder="Username" value="'.$get_user['MADMIN_USERNAME'].'" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="MADMINPRO_FULLNAME" class="form-control-label">Fullname</label>
                                                        <input type="text" name="MADMINPRO_FULLNAME" id="MADMINPRO_FULLNAME" class="form-control" placeholder="Your Full Name" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="MADMINPRO_COB">City</label>
                                                        <input type="text" id="MADMINPRO_COB" name="MADMINPRO_COB" class="form-control" placeholder="City" value="" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="MADMINPRO_NOB">Country</label>
                                                        <input type="text" id="MADMINPRO_NOB" name="MADMINPRO_NOB" class="form-control" placeholder="Country" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="MADMINPRO_DOB" class="form-control-label">Date Of Birth</label>
                                                        <input type="date" name="MADMINPRO_DOB" id="MADMINPRO_DOB" class="form-control" placeholder="Select Date" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <button class="btn btn-primary" id="updateBtn" type="submit">Update</button>
                                </form>';
            }

            return response()->json([
                'html' => $html
            ]);
        }
    }
}
