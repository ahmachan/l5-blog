<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new Role();
        $owner->name = 'owner';
        $owner->display_name = '项目所有者';
        $owner->description = '项目所有者';
        $owner->save();

        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = '管理员';
        $admin->description = '管理员可以编辑其他用户';
        $admin->save();

        $allPermission = array_column(Permission::all()->toArray(), 'id');
        $admin->perms()->sync($allPermission);
//        $user = Permission::where("display_name", "=", "创建用户")->first();
//        $owner->attachPermission($user);

    }
}
