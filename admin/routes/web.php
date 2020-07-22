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
Route::get('/logout','AuthController@logout');

// Panel
Route::get('/dashboard','PanelController@index');
Route::get('/profile','PanelController@profile');
Route::get('/admin-data','PanelController@admin');
Route::get('/user-data','PanelController@user');
Route::get('/package-data','PanelController@package');

// Form

Route::get('/form/change_password','FormController@change_password');

// Profile
Route::get('/form/profile/change_picture','Form\ProfileController@change_picture');

// Admin
Route::get('/form/admin/add_admin','Form\AdminController@add_admin');
Route::get('/form/admin/edit_admin/{id}','Form\AdminController@edit_admin');

// User
// Route::get('/form/user/add_user','Form\UserController@add_user');
Route::get('/form/user/edit_user/{id}','Form\UserController@edit_user');

// Package
Route::get('/form/package/add_package','Form\PackageController@add_package');
Route::get('/form/package/edit_package/{id}','Form\PackageController@edit_package');

// Data

// Profile Data
Route::get('/data/profile/{key}','Data\ProfileController@profile_user');

// Admin Data
Route::get('/data/admin/admins','Data\AdminController@admins');

// User
Route::get('/data/user/users','Data\UserController@users');

// Package
Route::get('/data/package/packages','Data\PackageController@packages');

// Misc

Route::post('/misc/change_password','MiscController@change_password');

// Profile
Route::post('/misc/profile/edit_profile','Misc\ProfileController@update');
Route::post('/misc/profile/change_profile_picture','Misc\ProfileController@change_picture');

// Admin
Route::post('/misc/admin/add_admin','Misc\AdminController@add_admin');
Route::post('/misc/admin/edit_admin','Misc\AdminController@edit_admin');
Route::get('/misc/admin/banAdmin/{id}','Misc\AdminController@banAdmin');
Route::get('/misc/admin/unbanAdmin/{id}','Misc\AdminController@unbanAdmin');

// User
// Route::post('/misc/user/add_user','Misc\UserController@add_user');
Route::post('/misc/user/edit_user','Misc\UserController@edit_user');
Route::get('/misc/user/banUser/{id}','Misc\UserController@banUser');
Route::get('/misc/user/unbanUser/{id}','Misc\UserController@unbanUser');

// Package
Route::post('/misc/package/add_package','Misc\PackageController@add_package');
Route::post('/misc/package/edit_package','Misc\PackageController@edit_package');
Route::get('/misc/package/activate/{id}','Misc\PackageController@activate');
Route::get('/misc/package/deactivate/{id}','Misc\PackageController@deactivate');