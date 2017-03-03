<?php

namespace App\Classes\Views;

use \Auth;


class CIResponse
{
    public static function response()
    {
        $user = Auth::user();

        return ['user' => [
            'username' => $user->username,
            'isAdmin' => $user->isAdmin(),
            'role' => [
                'name' => $user->role->name,
                'id' => $user->role->id
            ]
        ]
        ];
    }
}