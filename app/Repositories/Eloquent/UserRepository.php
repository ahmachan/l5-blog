<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\UserAbstractRepository;
use App\Models\User;


class UserRepository extends UserAbstractRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return User::class;
    }
}