<?php

namespace Database\Seeders;

use App\Models\Livre;
use App\Models\Categorie;
use Illuminate\Database\Seeder;

class LivreSeeder extends Seeder
{
    public function run(): void
{
   $categorie = Categorie::where('nom', 'Informatique')->first();

    Livre::create([
        'titre' => 'Laravel pour débutants',
        'auteur' => 'Taylor Otwell',
        'description' => 'Livre pour apprendre Laravel',
        'date_publication' => '2024-01-01',
        'categorie_id' => $categorie->id,
    ]);
}
}
