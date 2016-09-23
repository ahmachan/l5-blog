<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserInterface;
use App\Repositories\Eloquent\UserRepository;
use UserFacadeRepo;

class DemoController extends Controller
{
    private $user;
    private $userRepo;

    public function __construct(UserInterface $user, UserRepository $userRepo)
    {
        $this->user = $user;
        $this->userRepo = $userRepo;
    }

    public function index() {
        dd($this->user->getById(1));
    }

    public function facades() {
        dd(UserFacadeRepo::getAll());
    }

    public function getBy() {
        return dd($this->userRepo->getById(2));
    }
}
