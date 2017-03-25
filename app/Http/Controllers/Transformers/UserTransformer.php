<?php

namespace Api\Transformers;

use App\Models\Tenant\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {

        return [
            'id' 	=> (int) $user->id,
            'name'  => $user->username,
            'roles'	=> $user->role()
        ];
    }
}