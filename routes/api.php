<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Common routes
Route::post('login', 'AuthController@login');
Route::post('forgot-password', 'PasswordResetController@forgotPassword');
Route::post('reset-password', 'PasswordResetController@resetPassword');

// Secure routes
Route::group(['middleware' => 'auth:api'], function()
{
    // logout route
    Route::get('users/logout', 'AuthController@logout');
    // users routes
    Route::resource('users', 'UserAPIController');
    // settings routes
    Route::get('users/getInfos/{email}', 'SettingsController@getUserInfoByEmailAddress');
    Route::put('users/saveInfos/{id}', 'SettingsController@saveSettings');
    // tickets routes
    Route::resource('tickets', 'TicketAPIController');
    // catégories routes
    Route::resource('categorieMateriels', 'CategorieMaterielAPIController');
    Route::resource('categorieApplicatifs', 'CategorieApplicatifAPIController');
    // missions routes
    Route::resource('missions', 'MissionAPIController');
});
