<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PanelController extends Controller
{    
    public function index()
    {
        if(session('is_login') != 1)
        {
            return redirect('');
        } else {
            return view('dashboard',[
                'title' => 'Dashboard',
                'menu' => 'dashboard',
                'sub_menu' => ''
            ]);
        }
    }

    public function profile()
    {
        if(session('is_login') != 1)
        {
            return redirect('');
        } else {
            return view('profile',[
                'title' => 'Profile',
                'menu' => 'profile',
                'sub_menu' => ''
            ]);
        }
    }

    public function admin()
    {
        if(session('is_login') != 1)
        {
            return redirect('');
        } else {
            return view('master-data.admin',[
                'title' => 'Admin Data',
                'menu' => 'master-data',
                'sub_menu' => 'admin'
            ]);
        }
    }

    public function user()
    {
        if(session('is_login') != 1)
        {
            return redirect('');
        } else {
            return view('master-data.user',[
                'title' => 'User Data',
                'menu' => 'master-data',
                'sub_menu' => 'user'
            ]);
        }
    }

    public function package()
    {
        if(session('is_login') != 1)
        {
            return redirect('');
        } else {
            return view('master-data.package',[
                'title' => 'Package',
                'menu' => 'master-data',
                'sub_menu' => 'package'
            ]);
        }
    }
}
