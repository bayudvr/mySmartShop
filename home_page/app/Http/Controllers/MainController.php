<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function index()
    {
        $package_data = std_get([
            'table_name' => 'mapack',
            'where' => [
                [
                    'field_name' => 'MAPACK_STATUS',
                    'operator' => '!=',
                    'value' => 0
                ]
            ]
        ]);

        return view('home',['package' => $package_data]);
    }
}
