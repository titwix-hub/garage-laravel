<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateStatusRequest;
use App\Models\Vehicle;
use App\Services\VehiculeConstantes;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('brand')->paginate(25);

        return view('admin.vehicle.index', ['vehicles' => $vehicles]);
    }

    public function show($id)
    {
        $vehicle = Vehicle::find($id);

        $statues = VehiculeConstantes::STATUES;

        return view('admin.vehicle.edit', ['vehicle' => $vehicle, 'statues'=>$statues]);
    }

    public function update($id, UpdateStatusRequest $request)
    {
        $vehicle = Vehicle::find($id);

        $vehicle->status = $request->get('status');
        $vehicle->save();

        return redirect()->route('admin.vehicle.index');

    }
}
