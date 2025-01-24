<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUserHelper
{
    /**
     * Crea un usuari per defecte.
     *
     * @return User
     */
    public function createDefaultUser(): User
    {
        $credentials = config('default-users.default_user');

        return User::query()->create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
        ]);
    }
}
