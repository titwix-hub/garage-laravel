<?php

namespace Database\Seeders;

use App\Models\Annonce;
use App\Models\User;
use App\Models\Commentaire;
use Illuminate\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Commentaire::factory()
            ->count(20)
            ->for(User::all()->random())
            ->for(Annonce::all()->random())
            ->create();
    }
}
