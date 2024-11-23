<?php

namespace App\Helpers;

use App\Models\User;

class UserHelpers
{
    public static function creaUsuariPerDefecte()
    {
        return User::create([
            'name' => 'Usuari',
            'email' => 'usuari@gmail.com',
            'password' => bcrypt('usuari'),
        ]);
    }

    public static function creaProfessorPerDefecte()
    {
        return User::create([
            'name' => 'Professor',
            'email' => 'professor@gmail.com',
            'password' => bcrypt('profe'),
        ]);
    }
}
