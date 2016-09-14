<?php

use Illuminate\Database\Seeder;

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
        $admin = factory('App\Model\User')->create([
            "name"      => 'admin',
            "email"     => "admin@gmail.com",
            "password"  => bcrypt("123456")
        ]);
        //来宾账号
        $guest = factory('App\Model\User')->create([
            "name"      => 'guest',
            "email"     => "guest@gmail.com",
            "password"  => bcrypt("123456")
        ]);
        //其他随机账号
        factory('App\Model\User', 5)->create([
            "password"  => bcrypt("123456")
        ]);
    }
}
