<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\User;
use Entrust;
use Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('name','=','admin')->first();
//        var_dump($user->hasRole("admin"));
//        var_dump($user->can('create_users'));
        // 判断用户角色
//         dd(Entrust::hasRole('admin'));
        return view('home');
    }
}
