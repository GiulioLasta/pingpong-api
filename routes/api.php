<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

     Route::post('login', 'AuthController@login');
     Route::post('logout', 'AuthController@logout');
     Route::post('refresh', 'AuthController@refresh');
     Route::post('me', 'AuthController@me');

});