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
    Route::apiResource('users', 'UserAPIController');
    // settings routes
    Route::get('users/getInfos/{email}', 'SettingsController@getUserInfoByEmailAddress');
    Route::put('users/saveInfos/{id}', 'SettingsController@saveSettings');
    // catégories routes
    Route::apiResource('categorieMateriels', 'CategorieMaterielAPIController');
    Route::apiResource('categorieApplicatifs', 'CategorieApplicatifAPIController');
    // missions routes
    Route::apiResource('missions', 'MissionAPIController', [
        'except' => ['destroy']
    ]);
    // mission response route
    Route::apiResource('missionResponses', 'MissionResponseAPIController', [
        'only' => ['store']
    ]);
    // confirmer mission route
    Route::get('missionResponses/confirmer/{id}', 'MissionResponseAPIController@confirmer');
    // tickets routes
    Route::apiResource('tickets', 'TicketAPIController', [
        'except' => ['destroy']
    ]);
    // relancer ticket
    Route::post('tickets/relancer/{id}', 'TicketAPIController@relancer');
    // affectation du priorité
    Route::put('tickets/priorite/{id}', 'TicketAPIController@priorite');
    // reponse à un ticket
    Route::apiResource('ticketResponses', 'TicketResponseAPIController', [
        'except' => ['destroy']
    ]);
    // avis sur un ticket
    Route::apiResource('ticketAvis', 'TicketAvisAPIController', [
        'except' => ['update', 'destroy']
    ]);
});
