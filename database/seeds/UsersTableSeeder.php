<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //管理员账号
//        $admin = factory(App\Models\User::class)->create([
//            "name"      => 'admin',
//            "email"     => "admin@gmail.com",
//            "password"  => bcrypt("123456")
//        ]);
//        //来宾账号
//        $guest = factory(App\Models\User::class)->create([
//            "name"      => 'guest',
//            "email"     => "guest@gmail.com",
//            "password"  => bcrypt("123456")
//        ]);
//        //其他随机账号
//        factory(App\Models\User::class, 5)->create([
//            "password"  => bcrypt("123456")
//        ]);
//        $admin = User::where("name", "=", "admin")->first();
//        $user = User::where("name", "=", "guest")->first();
//
//        $adminRole = Role::where('name','admin')->first();
//        $userRole = Role::where('name','owner')->first();
//
//        $admin->attachRole($adminRole);
//        $user->roles()->attach([$userRole->id]);


        $adminRole = Role::where('name','admin')->first();
        $userRole = Role::where('name','user')->first();
        //超级管理员
        $admin = factory(App\Models\User::class)->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ])->each(function($u) use ($adminRole){
            // $u->roles()->attach([$admin->id]);
            $u->attachRole($adminRole);
        });
        //普通管理员
        $guest = factory(App\Models\User::class)->create([
            'name' => 'guest',
            'email' => 'guest@gmail.com',
            'password' => bcrypt('123456')
        ])->each(function($u) use ($userRole){
            $u->attachRole($userRole);
        });
        //普通账号
        $users = factory('App\Models\User',3)->create([
            'password' => bcrypt('123456')
        ])->each(function($u) use ($userRole){
            $u->roles()->attach([$userRole->id]);
        });
    }
}
