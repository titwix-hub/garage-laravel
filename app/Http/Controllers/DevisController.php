<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class DevisController extends Controller
{
    public function home()
    {
        $vehicle = Vehicle::all();

        return view('devis.home', ['vehicles' => $vehicle]);
    }

    public function resume(Request $request)
    {
        $vehicle = Vehicle::findOrFail($request->get('vehicle'));
        
        $datetime1 = date_create($request->get('starting_at')); // Date fixe
        $datetime2 = date_create($request->get('ending_at')); // Date fixe
        $interval = date_diff($datetime1, $datetime2);
        $nb_jour = $interval->format('%a'); 
        $starting = date("j F Y", strtotime($request->get('starting_at')));
        $ending = date("j F Y", strtotime($request->get('ending_at')));
        $nom_vehicle = $vehicle->name;

        $prix_ht = $vehicle->price * $nb_jour;
        $prix_ttc = $prix_ht * 1.2;

        return view('devis.resume', ['nom' => $nom_vehicle, 'prix_ht' => $prix_ht, 'prix_ttc' => $prix_ttc, 'starting_at' => $starting, 'ending_at' => $ending]);
    }

}
