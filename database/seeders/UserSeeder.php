<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(3)
            ->admin()
            ->create();

        User::factory()
            ->count(30)
            ->hasAttached(
                Vehicle::all()->random(3),
                ['started_at' => now(), 'ended_at' => now()->addDays(7)]
            )
            ->create();
    }
}
