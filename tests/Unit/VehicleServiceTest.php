<?php

namespace Tests\Unit;

use TypeError;
use Tests\TestCase;
use App\Models\Brand;
use App\Services\VehicleService;
use App\Services\UnexpectedParameterException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_save_vehicle()
    {
        $brand = Brand::factory()->create([
            'name' => 'Peugeot',
        ]);

        $name = '205';
        $price = 152.99;
        $status = 'available';
        $odometer = 247513;
        $type = 'oldschool';

        $vehicleService = new VehicleService();

        $this->assertDatabaseCount('vehicles', 0);

        $vehicleService->saveVehicle(
            $brand->id,
            $name,
            $price,
            $status,
            $odometer,
            $type
        );

        $this->assertDatabaseCount('vehicles', 1);

        $this->assertDatabaseHas('vehicles', [
            'brand_id' => $brand->id,
            'name' => $name,
            'price' => $price,
            'status' => $status,
            'odometer' => $odometer,
            'type' => $type,
        ]);
    }

    /** @test */
    public function cant_save_vehicle_without_existing_brand()
    {
        $brandId = 666;
        $name = '205';
        $price = 152.99;
        $status = 'available';
        $odometer = 247513;
        $type = 'oldschool';

        $vehicleService = new VehicleService();

        $this->assertDatabaseCount('brands', 0);

        $this->expectException(UnexpectedParameterException::class);
        $this->expectExceptionMessage('Brand not found (666)');

        $vehicleService->saveVehicle(
            $brandId,
            $name,
            $price,
            $status,
            $odometer,
            $type
        );
    }

    /** @test */
    public function cant_save_vehicle_without_good_params()
    {
        $brand = Brand::factory()->create([
            'name' => 'Peugeot',
        ]);

        $name = '205';
        $price = 'lowcost';
        $status = 'available';
        $odometer = 247513;
        $type = 'oldschool';

        $vehicleService = new VehicleService();

        $this->expectException(TypeError::class);

        $vehicleService->saveVehicle(
            $brand->id,
            $name,
            $price, // ici
            $status,
            $odometer,
            $type
        );
    }
}
