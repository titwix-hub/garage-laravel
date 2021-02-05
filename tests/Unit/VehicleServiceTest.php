<?php

namespace Tests\Unit;

use TypeError;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Services\VehicleService;
use App\Services\VehiculeConstantes;
use App\Services\UnexpectedParameterException;
use App\Services\UserHasNotEnoughMoneyException;
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

    /** @test */
    public function can_have_all_vehicles()
    {
        $expectedVehicles = Vehicle::factory()
            ->count(3)
            ->for(Brand::factory()->create())
            ->create();

        $vehicleService = new VehicleService();

        $vehicles = $vehicleService->getAllVehicles();

        $this->assertCount(3, $vehicles);
        $this->assertContainsOnlyInstancesOf(Vehicle::class, $vehicles);
        $this->assertEquals($vehicles[0]->name, $expectedVehicles[0]->name);
        $this->assertEquals($vehicles[1]->name, $expectedVehicles[1]->name);
        $this->assertEquals($vehicles[2]->name, $expectedVehicles[2]->name);
    }

    /** @test */
    public function can_have_all_available_vehicles()
    {
        $expectedAvailableVehicles = Vehicle::factory()
            ->count(2)
            ->for(Brand::factory()->create())
            ->create([
                'status' => 'available',
            ]);

        $lockedVehicles = Vehicle::factory()
            ->count(1)
            ->for(Brand::factory()->create())
            ->create([
                'status' => 'locked',
            ]);

        $vehicleService = new VehicleService();

        $availableVehicles = $vehicleService->getAllAvailableVehicles();

        $this->assertCount(2, $availableVehicles);
        $this->assertContainsOnlyInstancesOf(Vehicle::class, $availableVehicles);
        $this->assertEquals($availableVehicles[0]->name, $expectedAvailableVehicles[0]->name);
        $this->assertEquals($availableVehicles[1]->name, $expectedAvailableVehicles[1]->name);
    }

    /** @test */
    public function throw_exception_when_user_has_not_enough_money()
    {
        $vehicle = Vehicle::factory()->create([
            'status' => VehiculeConstantes::STATUES['AVAIlABLE'],
            'price' => 100,
            'brand_id' => Brand::factory()->create([
                'name' => 'Peugeot',
            ]),
        ]);

        $user = new User([
            'wallet' => 1,
        ]);

        $requestParameters = [
            'starting_at' => '2020-02-05',
            'ending_at' => '2020-02-06',
        ];

        $vehicleService = new VehicleService();

        $this->expectException(UserHasNotEnoughMoneyException::class);

        $vehicleService->reserved($vehicle, $user, $requestParameters);
    }

    /** @test */
    public function user_can_reserved_car()
    {
        $vehicle = Vehicle::factory()->create([
            'status' => VehiculeConstantes::STATUES['AVAIlABLE'],
            'price' => 100,
            'brand_id' => Brand::factory()->create([
                'name' => 'Peugeot',
            ]),
        ]);

        $user = User::factory()->create([
            'wallet' => 101,
        ]);

        $requestParameters = [
            'starting_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'ending_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $vehicleService = new VehicleService();

        $vehicleService->reserved($vehicle, $user, $requestParameters);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'wallet' => 1,
        ]);

        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicle->id,
            'status' => VehiculeConstantes::STATUES['LOCKED'],
        ]);

        $this->assertDatabaseHas('user_vehicle', [
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'started_at' => $requestParameters['starting_at'],
            'ended_at' => $requestParameters['ending_at'],
        ]);
    }
}
