<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function get_profile($key)
    {
        $get_user = std_get([
            'table_name' => 'mausr',
            'where' => [
                [
                    'field_name' => 'MAUSR_ID',
                    'operator' => '=',
                    'value' => session('id')
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
                    'value' => session('id')
                ]
            ],
            'first_row' => true
        ]);

        $get_package = std_get([
            'table_name' => 'trpack',
            'where' => [
                [
                    'field_name' => 'TRPACK_MAUSR_ID',
                    'operator' => '=',
                    'value' => session('id')
                ],
                [
                    'field_name' => 'TRPACK_UNTIL',
                    'operator' => '>',
                    'value' => date('Y-m-d')
                ],
                [
                    'field_name' => 'TRPACK_STATUS',
                    'operator' => '!=',
                    'value' => 2
                ]
            ],
            'first_row' => true
        ]);

        $get_business = std_get([
            'table_name' => 'mabus',
            'where' => [
                [
                    'field_name' => 'MABUS_MAUSR_ID',
                    'operator' => '=',
                    'value' => session('id')
                ],
                [
                    'field_name' => 'MABUS_STATUS',
                    'operator' => '!=',
                    'value' => 2
                ]
            ]
        ]);

        $business = count($get_business);

        $html = '';

        if($key == 'welcome_message')
        {
            $html .= 'Hello, '.$get_user['MAUSR_FULLNAME'];

            return response()->json([
                'html' => $html
            ]);
        }

        if($key == 'user_profile')
        {
            $change = "'form/profile/change_picture'";

            $status = $get_package['TRPACK_STATUS'];

            $until = date('dS F Y');

            if($status == 0)
            {
                $status = '<span class="badge badge-info">Waiting for payment</span>';
                $until = date('dS F Y',strtotime($get_package['TRPACK_CRTD_TIMESTAMP'].' +1 month'));
            } else if($status == 1)
            {
                $status = '<span class="badge badge-success">Active</span>';
                $until = date('dS F Y',strtotime($get_package['TRPACK_UNTIL']));
            } else if($status == 2)
            {
                $status = '<span class="badge badge-danger">Expired</span>';
                $until = date('dS F Y',strtotime($get_package['TRPACK_UNTIL']));
            }

            $html .= '<img src="./assets/vendor/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image" id="admin_photo">
                                    <a href="#">
                                        <img src="./storage/uploaded/MAUSPRO_PHOTO/'.$get_user_profile['MAUSPRO_PHOTO'].'" class="rounded-circle" style="width:100px; object-fit:cover;">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div></div>
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
                            <h5 class="h3">'.$get_user['MAUSR_FULLNAME'].', ('.date('dS M Y',strtotime($get_user_profile['MAUSPRO_DOB'])).')</h5>
                            <div class="h5 font-weight-300">
                                <i class="ni ni-pin mr-2"></i>'.$get_user_profile['MAUSPRO_COB'].', '.$get_user_profile['MAUSPRO_NOB'].'
                            </div>
                            <div class="h5 font-weight-300 table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>Package Status</td>
                                        <td>'.$status.'</td>
                                    </tr>
                                    <tr>
                                        <td>Package Expiration Date</td>
                                        <td>'.$until.'</td>
                                    </tr>
                                    <tr>
                                        <td>Business Owned</td>
                                        <td>'.$business.'</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>';
            
            return response()->json([
                'html' => $html
            ]);
        }

        if($key == 'user_profile_data')
        {
            $html .= '<form method="POST" id="editProfile" enctype="multipart/form-data">
                                    '.csrf_field().'
                                    <input type="hidden" name="id" value="'.$get_user['MAUSR_ID'].'"></input>
                                    <h6 class="heading-small text-muted mb-4">User information</h6>
                                    <div class="pl-lg-4">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="MAUSR_USERNAME">Username</label>
                                                <input type="text" id="MAUSR_USERNAME" name="MAUSR_USERNAME" class="form-control" placeholder="Username" value="'.$get_user['MAUSR_USERNAME'].'" >
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="MAUSR_USERNAME">Email</label>
                                                <input type="email" id="MAUSR_EMAIL" name="MAUSR_EMAIL" class="form-control" placeholder="Email" value="'.$get_user['MAUSR_EMAIL'].'" >
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="MAUSR_FULLNAME" class="form-control-label">Fullname</label>
                                                        <input type="text" name="MAUSR_FULLNAME" id="MAUSR_FULLNAME" class="form-control" placeholder="Your Full Name" value="'.$get_user['MAUSR_FULLNAME'].'" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="MAUSPRO_COB">City</label>
                                                        <input type="text" id="MAUSPRO_COB" name="MAUSPRO_COB" class="form-control" placeholder="City" value="'.$get_user_profile['MAUSPRO_COB'].'" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="MAUSPRO_NOB">Country</label>
                                                        <input type="text" id="MAUSPRO_NOB" name="MAUSPRO_NOB" class="form-control" placeholder="Country" value="'.$get_user_profile['MAUSPRO_NOB'].'" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="MAUSPRO_DOB" class="form-control-label">Date Of Birth</label>
                                                        <input type="date" name="MAUSPRO_DOB" id="MAUSPRO_DOB" class="form-control" placeholder="Select Date" value="'.$get_user_profile['MAUSPRO_DOB'].'" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <button class="btn btn-primary" id="updateBtn" type="submit">Update</button>
                                </form>';

            return response()->json([
                'html' => $html
            ]);
        }
    }
}
