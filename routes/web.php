<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;

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
Auth::routes();

Route::get('/', [VehicleController::class, 'index'])->name('vehicles.index');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
        Route::put('/settings/money', [UserController::class, 'addMoney'])->name('user.add.money');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => [IsAdmin::class]], function () {
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
});
