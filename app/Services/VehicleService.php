<?php

namespace App\Services;

use Exception;
use App\Models\Brand;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VehicleService
{
    public function saveVehicle(
        int $brandId,
        string $name,
        float $price,
        string $status,
        int $odometer,
        string $type
    ): Vehicle
    {
        try {
            $brand = Brand::findOrFail($brandId);

            $vehicle = new Vehicle([
                'name' => $name,
                'price' => $price,
                'status' => $status,
                'odometer' => $odometer,
                'type' => $type,
            ]);

            $brand->vehicles()->save($vehicle);

            return $vehicle;
        } catch (ModelNotFoundException $e) {
            throw new UnexpectedParameterException("Brand not found ($brandId)");
        } catch (Exception $e) {
            throw new UnexpectedParameterException();
        }
    }

    public function getAllVehicles(): Collection
    {
        return Vehicle::all();
    }

    public function getAllAvailableVehicles(): Collection
    {
        return Vehicle::where('status', '=', 'available')->get();
    }
}
