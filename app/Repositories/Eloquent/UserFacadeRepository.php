<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserInterface;
use App\Models\User;

class UserFacadeRepository implements UserInterface
{
    public function getById($id)
    {
        // TODO: Implement getById() method.
        return User::where("id", "=", $id)->first()->toArray();
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
        return User::all()->toArray();
    }
}