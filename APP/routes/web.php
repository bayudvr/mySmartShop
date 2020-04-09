<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Main
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home');
Route::get('/data_management/user', 'HomeController@user_data');
Route::get('/data_management/item', 'HomeController@item_data');
Route::get('/profile', 'HomeController@profile');

// Crud
Route::get('/logout', 'AuthController@logout');
Route::post('/auth', 'AuthController@auth');
Route::post('/register', 'CrudController@register');

// Data
Route::get('/data/user', 'DataController@user');
Route::get('/data/item', 'DataController@item');