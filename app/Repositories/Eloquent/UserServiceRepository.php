<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserInterface;
use App\Models\User;

class UserServiceRepository implements UserInterface
{
    public function getById($id)
    {
        return User::where("id", "=", $id)->first()->toArray();
    }
}