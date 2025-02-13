<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;

class DefaultUserHelper
{
    public static function create_regular_user()
    {
        return User::create([
            'name' => 'Regular',
            'email' => 'regular@videosapp.com',
            'password' => Hash::make('password'),
        ]);
    }

    public static function create_video_manager_user()
    {
        return User::create([
            'name' => 'Video Manager',
            'email' => 'videosmanager@videosapp.com',
            'password' => Hash::make('password'),
        ]);
    }

    public static function create_superadmin_user()
    {
        return User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@videosapp.com',
            'password' => Hash::make('password'),
        ]);
    }

    public static function add_personal_team(User $user)
    {
        $team = $user->teams()->create([
            'name' => $user->name . "'s Team",
            'personal_team' => true,
            'user_id' => $user->id, // Ensure user_id is set
        ]);

        $user->current_team_id = $team->id;
        $user->save();
    }

    public static function define_gates()
    {
        Gate::define('manage-videos', function (User $user) {
            return $user->hasRole('Video Manager') || $user->hasRole('Super Admin');
        });
    }
}
