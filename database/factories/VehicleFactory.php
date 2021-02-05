<?php

namespace Database\Factories;

use App\Models\Vehicle;
use App\Services\VehiculeConstantes;
use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(Fakecar::class);

        $statues = array_values(VehiculeConstantes::STATUES);

        return [
            'name' => $this->faker->vehicleModel,
            'price' => $this->faker->numberBetween(0, 1000),
            'status' => $this->faker->randomElement($statues),
            'odometer' => $this->faker->numberBetween(5000, 20000),
            'type' => $this->faker->vehicleType,
        ];
    }
}
