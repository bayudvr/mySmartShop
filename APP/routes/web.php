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

// Auth
Route::get('/', 'AuthController@index');
Route::post('/login','AuthController@login');
Route::get('/signup','AuthController@signup');
Route::get('/logout','AuthController@logout');

// Data
// User Panel
// Profile
Route::get('/data/profile/{key}','Data\ProfileController@get_profile');
// Business
Route::get('/data/businesses','Data\BusinessController@get');
// Subscription
Route::get('/data/user_package','Data\PackageController@get');

// Form
// User Panel
// Profile
Route::get('/form/profile/change_picture','Form\ProfileController@change_picture');
// Business
Route::get('/form/business/add','Form\BusinessController@add');
Route::get('/form/business/edit/{id}','Form\BusinessController@edit');

// Misc
Route::post('/misc/signup','MiscController@signup');
// User Panel
// Profile
Route::post('/misc/profile/change_profile_picture','Misc\ProfileController@change_profile_picture');
Route::post('/misc/profile/edit_profile','Misc\ProfileController@edit_profile');
// Business
Route::post('/misc/business/add','Misc\BusinessController@add');
Route::post('/misc/business/edit','Misc\BusinessController@edit');
Route::get('/misc/business/open/{id}','Misc\BusinessController@open');
Route::get('/misc/business/close/{id}','Misc\BusinessController@close');
Route::get('/misc/business/delete/{id}','Misc\BusinessController@delete');

// Panel
Route::get('/panel_redirect','PanelController@panel_redirect');
// User Panel
Route::get('/dashboard','PanelController@index');
Route::get('/profile','PanelController@profile');
// Master-data
Route::get('/businesses','PanelController@businesses');
Route::get('/employees','PanelController@employees');
// Subscription
Route::get('/subscription','PanelController@subscription');
// Cashier Panel
Route::get('/cashier','Cashier\PanelController@index');
// Inventories Panel
Route::get('/inventories','Inventories\PanelController@index');
