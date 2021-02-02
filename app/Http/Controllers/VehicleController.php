<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Services\VehicleService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreateVehicleRequest;

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
}
