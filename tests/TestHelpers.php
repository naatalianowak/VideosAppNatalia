<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function usuari_per_defecte()
    {
        $user = User::create([
            'name' => 'Usuari',
            'email' => 'usuari@gmail.com',
            'password' => bcrypt('usuari'), 
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'usuari@example.com',
        ]);
    }

    /** @test */
    public function usuari_professor()
    {
        $teacher = User::create([
            'name' => 'Professor',
            'email' => 'professor@gmail.com',
            'password' => bcrypt('professor'),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'professor@example.com',
        ]);
    }
}