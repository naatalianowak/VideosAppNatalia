<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Helpers\DefaultVideoHelper;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios por defecto
        User::factory()->create([
            'name' => 'Usuari per Defecte',
            'email' => 'default@example.com',
            'password' => bcrypt('password'),
        ]);

        DefaultVideoHelper::createDefaultVideos();
    }
}
