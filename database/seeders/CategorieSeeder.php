<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run(): void
{
    $categories = [
        'Roman',
        'Informatique',
        'Science',
        'Histoire',
    ];

    foreach ($categories as $nom) {
       Categorie::firstOrCreate(['nom' => $nom]);
    }
}
}
