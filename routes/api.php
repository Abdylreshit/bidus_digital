<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.'
], function (){
    Route::post('register', \App\Http\Controllers\Auth\RegisterController::class)->name('register');
    Route::post('login', \App\Http\Controllers\Auth\LoginController::class)->name('login');

    Route::group([
        'middleware' => 'auth:sanctum'
    ], function (){
        Route::get('me', \App\Http\Controllers\Auth\MeController::class)->name('me');
        Route::post('logout', \App\Http\Controllers\Auth\LogoutController::class)->name('logout');
    });
});


Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'task',
    'as' => 'task.'
], function (){
    Route::get('list', \App\Http\Controllers\Task\ListController::class)->name('list');
    Route::get('{id}/find', \App\Http\Controllers\Task\UpdateController::class)->name('find');
    Route::post('store', \App\Http\Controllers\Task\StoreController::class)->name('store');
    Route::post('{id}/update', \App\Http\Controllers\Task\UpdateController::class)->name('update');
    Route::post('{id}/complete', \App\Http\Controllers\Task\CompleteController::class)->name('complete');
    Route::post('{id}/delete', \App\Http\Controllers\Task\DeleteController::class)->name('delete');
});
