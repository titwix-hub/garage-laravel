<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\UserVehicle;
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

    public function reserved(Vehicle $vehicle, User $user, array $requestParameters): void
    {
        if ($this->vehicleIsLocked($vehicle)) {
            throw new CannotReservedVehicleLockedException();
        }

        $price = $this->getPrice($requestParameters, $vehicle);

        if ($this->userHasNoEnoughMoney($user, $price)) {
            throw new UserHasNotEnoughMoneyException();
        }

        $user->update([
           'wallet' => $user->wallet - $price,
        ]);

        UserVehicle::create([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'started_at' => $requestParameters['starting_at'],
            'ended_at' => $requestParameters['ending_at'],
        ]);
    }

    private function getPrice(array $requestParameters, Vehicle $vehicle): float
    {
        $startingAt = Carbon::parse($requestParameters['starting_at']);

        $days = $startingAt->diffInDays($requestParameters['ending_at']);

        return ($days + 1) * $vehicle->price;
    }

    private function userHasNoEnoughMoney(User $user, float $price): bool
    {
        return $user->wallet < $price;
    }

    private function vehicleIsLocked(Vehicle $vehicle): bool
    {
        return $vehicle->status === VehiculeConstantes::STATUES['LOCKED'];
    }
}
