<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\TicketController;
use App\Http\Controllers\Auth\ProjectsController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('list', 'AuthController@list');
    Route::patch('update', 'AuthController@update');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'ticket'
], function ($router) {
    Route::post('create', 'TicketController@create');
    Route::post('update', 'TicketController@update');
    Route::post('delete', 'TicketController@delete');
    Route::post('deleteList', 'TicketController@deleteList');
    Route::post('list', 'TicketController@list');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'projects'
], function ($router) {
    Route::post('create', 'ProjectsController@create');
    Route::post('update', 'ProjectsController@update');
    // Route::post('delete', 'ProjectsController@delete');
    // Route::post('deleteList', 'TicketController@deleteList');
    Route::post('list', 'ProjectsController@list');
});