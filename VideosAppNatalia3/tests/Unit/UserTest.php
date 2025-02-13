<?php

namespace Tests\Unit;

use Spatie\Permission\Models\Role;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;


    public function setUp(): void
    {
        parent::setUp();

        Role::create(['name' => 'Super Admin']);
    }

    public function test_is_super_admin()
    {

        $user = User::factory()->create(['super_admin' => true]);
        $user->assignRole('Super Admin');

        $this->assertTrue($user->isSuperAdmin());
    }

}
