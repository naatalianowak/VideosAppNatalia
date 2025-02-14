<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class DefaultUserHelper
{
    public static function create_regular_user() : User
    {
        return User::create([
            'name' => 'Regular',
            'email' => 'regular@videosapp.com',
            'password' => Hash::make('password'),
        ]);
    }

    public static function create_video_manager_user() : User
    {
        return User::create([
            'name' => 'Video Manager',
            'email' => 'videosmanager@videosapp.com',
            'password' => Hash::make('password'),
        ]);
    }

    public static function create_superadmin_user() : User
    {
        return User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@videosapp.com',
            'password' => Hash::make('password'),
        ]);
    }
    public static function create_default_professor(): User
    {
        $user = self::create_user('Professor', 'professor@videosapp.com');
        $user->assignRole('Professor');

        if (config('app.professors_are_superadmins', false)) {
            $user->assignRole('Super Admin');
        }

        return $user;
    }

    public static function add_personal_team(User $user)
    {
        $team = $user->teams()->create([
            'name' => $user->name . "'s Team",
            'personal_team' => true,
            'user_id' => $user->id,
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
