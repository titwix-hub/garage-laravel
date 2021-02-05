<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Vehicle;
use App\Services\CannotReservedVehicleLockedException;
use Illuminate\Http\Request;
use App\Services\VehicleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreateVehicleRequest;
use App\Http\Requests\ReservedVehicleRequest;
use App\Services\UserHasNotEnoughMoneyException;

class VehicleController extends Controller
{
    /**
     * @var \App\Services\VehicleService
     */
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function index(Request $request)
    {
        $vehicles = Vehicle::with('brand')->get();

        return view('vehicles.index', ['vehicles' => $vehicles]);
    }

    public function create()
    {
        $brands = Brand::all();

        return view('vehicles.create', ['brands' => $brands]);
    }

    public function store(CreateVehicleRequest $request): RedirectResponse
    {
        $this->vehicleService->saveVehicle(
            $request->get('brand_id'),
            $request->get('name'),
            $request->get('price'),
            $request->get('status'),
            $request->get('odometer'),
            $request->get('type')
          );

        return redirect()->route('vehicles.create');
    }

    public function reserved($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('vehicles.reserved', ['vehicle' => $vehicle]);
    }

    public function storeReserved(ReservedVehicleRequest $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $user = Auth::user();

        try {
            $this->vehicleService->reserved($vehicle, $user, $request->all());

            return redirect('/');
        } catch (UserHasNotEnoughMoneyException $exception) {
            return back()->withErrors(['error' => "Vous n'avez pas asser d'argent pour louer cette voiture sur cette durée"]);
        } catch(CannotReservedVehicleLockedException $exception) {
            abort(403);
        }
    }
}
