<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PanelController extends Controller
{
    public function panel_redirect()
    {
        if(session('is_login') != 1)
        {
            return redirect('');
        } else {
            if(session('role') == 1)
            {
                return redirect('cashier');
            } else if(session('role') == 2)
            {
                return redirect('inventories');
            } else {
                return redirect('dashboard');
            }
        }
    }

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

    public function businesses()
    {
        if(session('is_login') != 1)
        {
            return redirect('');
        } else {
            return view('master-data.businesses',[
                'title' => 'Businesses',
                'menu' => 'master-data',
                'sub_menu' => 'businesses'
            ]);
        }
    }

    public function subscription()
    {
        if(session('is_login') != 1)
        {
            return redirect('');
        } else {
            return view('subscription',[
                'title' => 'Subscription',
                'menu' => 'subscription',
                'sub_menu' => ''
            ]);
        }
    }
}
