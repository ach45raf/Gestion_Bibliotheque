<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\LivreSeeder;
use Database\Seeders\CategorieSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Appel de tous les Seeders
        $this->call([
            AdminSeeder::class,
            CategorieSeeder::class,  
            LivreSeeder::class,      
        ]);
    }
}
