<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Vehicle;

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
        $brand = Brand::find($brandId);

        $vehicle = new Vehicle([
            'name' => $name,
            'price' => $price,
            'status' => $status,
            'odometer' => $odometer,
            'type' => $type,
        ]);

        $brand->vehicles()->save($vehicle);

        return $vehicle;
    }
}
