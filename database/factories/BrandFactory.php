<?php

namespace Database\Factories;

use App\Models\Brand;
use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(Fakecar::class);

        return [
            'name' => $this->faker->vehicleBrand,
            'premium' => $this->faker->boolean,
        ];
    }
}
