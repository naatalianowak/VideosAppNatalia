<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUserHelper
{
    
    public function createDefaultUser()
    {
        $credentials = config('default-users.default_user');

        // Verifica que $credentials tenga los valores correctos
        return User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
        ]);
    }
}
