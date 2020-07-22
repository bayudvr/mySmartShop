<?php

namespace App\Http\Controllers\Inventories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PanelController extends Controller
{
    public function index()
    {
        return view('inventories.index',[
            'title' => 'Dashboard',
            'menu' => 'dashboard',
            'sub_menu' => ''
        ]);
    }
}
