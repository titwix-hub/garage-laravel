<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\CommentaireController;
use \App\Http\Controllers\Admin;
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
        Route::get('/reservations', [UserController::class, 'reservations'])->name('user.show.reservations');
    });
    Route::group(['prefix' => 'vehicles'], function () {
        Route::get('/{id}/reserved', [VehicleController::class, 'reserved'])->name('vehicles.reserved');
        Route::post('/{vehicle}/reserved', [VehicleController::class, 'storeReserved'])->name('vehicules.reserved.store');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => [IsAdmin::class]], function () {
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles',[Admin\VehicleController::class, 'index'])->name('admin.vehicle.index');
    Route::get('/vehicles/{id}',[Admin\VehicleController::class, 'show'])->name('admin.vehicle.show');
    Route::put('/vehicles/{id}',[Admin\VehicleController::class, 'update'])->name('admin.vehicle.update');
});

Route::group(['prefix' => 'annonces'], function () {
    Route::get('/', [AnnonceController::class, 'home'])->name('annonces.home');
    Route::get('/detail/{id}', [AnnonceController::class, 'show'])->name('annonces.show');
    Route::get('/commentaire', [AnnonceController::class, 'commentaire'])->name('annonces.commentaire');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/ajouter', [AnnonceController::class, 'ajouter'])->name('annonces.ajouter');
        Route::post('/new', [AnnonceController::class, 'new'])->name('annonces.new');
        Route::delete('/delete/{id}', [AnnonceController::class, 'delete'])->name('annonces.delete');
        Route::get('/modifier/{id}', [AnnonceController::class, 'modifier'])->name('annonces.modifier');
        Route::put('/change/{id}', [AnnonceController::class, 'change'])->name('annonces.change');
        Route::post('/addcomment/{id}', [CommentaireController::class, 'addcomment'])->name('annonces.addcomment');
        Route::delete('/deletecomment/{id}/{commentaire}', [CommentaireController::class, 'deletecomment'])->name('annonces.deletecomment');
        Route::get('/modifcomment/{id}/{commentaire}', [CommentaireController::class, 'modifcomment'])->name('annonces.modifcomment');
        Route::post('/newcomment/{id}/{commentaire}', [CommentaireController::class, 'newcomment'])->name('annonces.newcomment');
    });
});