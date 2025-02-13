<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create permissions
        Permission::create(['name' => 'view videos']);
        Permission::create(['name' => 'create videos']);
        Permission::create(['name' => 'manage videos']);



        // Create roles and assign permissions
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        $videoManagerRole = Role::create(['name' => 'Video Manager']);
        $videoManagerRole->givePermissionTo(['view videos', 'create videos']);

        $regularUserRole = Role::create(['name' => 'Regular User']);
        $regularUserRole->givePermissionTo(['view videos']);

        // Create users and assign roles
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@videosapp.com',
            'password' => Hash::make('123456789'),
        ]);
        $superAdmin->assignRole($superAdminRole);

        $videoManager = User::create([
            'name' => 'Video Manager',
            'email' => 'videomanager@videosapp.com',
            'password' => Hash::make('123456789'),
        ]);
        $videoManager->assignRole($videoManagerRole);

        $regularUser = User::create([
            'name' => 'Regular User',
            'email' => 'regular@videosapp.com',
            'password' => Hash::make('123456789'),
        ]);
        $regularUser->assignRole($regularUserRole);
    }
}
