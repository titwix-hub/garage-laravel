<?php

use App\Models\User;
use App\Models\Brand;
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

Route::get('/', function () {

    $users = User::all();

    echo "<h1>Les utilisateurs</h1>";
    echo "<ul>";

    foreach ($users as $user) {
        echo "<li>#$user->id $user->name (score: $user->score, porte-monnaie: $user->wallet, role: $user->role, actif: $user->enabled)</li>";
    }

    echo "</ul>";

    $brands = Brand::all();

    echo "<h1>Les marques</h1>";
    echo "<ul>";
    foreach ($brands as $brand) {
        echo "<li>";
        echo "#$brand->id $brand->name (premium: $brand->premium)";

        echo "<ul>";
        foreach ($brand->vehicles as $vehicle) {
            echo "<li>#$vehicle->id $vehicle->name (type: $vehicle->type, km: $vehicle->odometer, statut: $vehicle->status)</li>";
        }

        echo "</ul>";
        echo "</li>";
    }
    echo "</ul>";

    $users = User::has('vehicles')->get();

    echo "<h1>Les locations par client</h1>";
    echo "<ul>";

    foreach ($users as $user) {
        echo "<li>";
        echo "$user->name :";

        echo "<ul>";
        foreach ($user->vehicles as $vehicle) {
            echo "<li>" . $vehicle->brand->name . " $vehicle->name (début: " . $vehicle->pivot->started_at->format('d/m/Y') . ", fin: " .$vehicle->pivot->ended_at->format('d/m/Y') . ")</li>";
        }
        echo "</ul>";
        echo "</li>";
    }
    echo "</ul>";
});
