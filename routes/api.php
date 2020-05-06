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
    Route::get('users/logout', 'AuthController@logout');
    Route::resource('users', 'UserAPIController');
    Route::resource('tickets', 'TicketAPIController');
    Route::resource('categorieMateriels', 'CategorieMaterielAPIController');
    Route::resource('categorieApplicatifs', 'CategorieApplicatifAPIController');
    Route::resource('missions', 'MissionAPIController');
});
