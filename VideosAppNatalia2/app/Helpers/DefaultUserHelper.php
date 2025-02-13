<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DefaultUserHelper
{
    /**
     * Crea un usuari per defecte.
     *
     * @return User
     */
    public function createDefaultUser(): User
    {
        $credentials = Config::get('default-users.default_user', []);

        return User::query()->create([
            'name' => $credentials['name'] ?? 'Default User',
            'email' => $credentials['email'] ?? 'default@videosapp.com',
            'password' => Hash::make($credentials['password'] ?? 'password'),
            'super_admin' => $credentials['super_admin'] ?? false,
        ]);
    }
    
    public static function create_default_professor()
    {
        return User::factory()->create([
            'name' => 'Professor per defecte',
            'email' => 'profesor@videosapp.com',
            'password' => bcrypt('123456789'),
            'super_admin' => true
        ]);
    }
    
    public static function add_personal_team(User $user)
    {
        $team = $user->teams()->create([
            'name' => $user->name . "'s Equip",
            'user_id' => $user->id,
        ]);
        $user->switchTeam($team);
    }
    
    public static function create_regular_user(): User
    {
        $existingUser = User::where('email', 'regular@videosapp.com')->first();
        if ($existingUser) {
            return $existingUser; 
        }
        Role::firstOrCreate(['name' => 'regular']);
        return User::query()->create([
            'name' => 'Usuari Regular',
            'email' => 'regular@videosapp.com',
            'password' => Hash::make('123456789'),
        ])->assignRole('regular');
    }
   
    public static function create_video_manager_user(): User
    {
        $existingUser = User::where('email', 'videosmanager@videosapp.com')->first();
        if ($existingUser) {
            return $existingUser; 
        }
        Role::firstOrCreate(['name' => 'video_manager'])->givePermissionTo('manage videos');
        return User::query()->create([
            'name' => 'Videos Manager',
            'email' => 'videosmanager@videosapp.com',
            'password' => Hash::make('123456789'),
        ])->assignRole('video_manager');
    }
    
    public static function create_superadmin_user(): User
    {
        $existingUser = User::where('email', 'superadmin@videosapp.com')->first();
        if ($existingUser) {
            return $existingUser; 
        }
        Role::firstOrCreate(['name' => 'super_admin'])->givePermissionTo(Permission::all());
        return User::query()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@videosapp.com',
            'password' => Hash::make('123456789'),
            'super_admin' => true,
        ])->assignRole('super_admin');
    }
    
    public static function define_gates()
    {
        Gate::define('manage-videos', function (User $user) {
            return $user->hasRole('video_manager') || $user->isSuperAdmin();
        });
    }
    
    public static function create_permissions()
    {
        Permission::firstOrCreate(['name' => 'manage videos']);
        Role::firstOrCreate(['name' => 'regular']);
        Role::firstOrCreate(['name' => 'video_manager'])
            ->givePermissionTo('manage videos');
        Role::firstOrCreate(['name' => 'super_admin'])
            ->givePermissionTo(Permission::all());
    }
}
