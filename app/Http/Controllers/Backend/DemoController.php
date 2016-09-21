<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserInterface;
use UserFacadeRepo;

class DemoController extends Controller
{
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function index() {
        dd($this->user->getById(1));
    }

    public function facades() {
        dd(UserFacadeRepo::getAll());
    }
}
