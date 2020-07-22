<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PanelController extends Controller
{
    public function index()
    {
        return view('cashier.index',[
            'title' => 'PointOf Sales',
            'menu' => 'pos',
            'sub_menu' => ''
        ]);
    }
}
