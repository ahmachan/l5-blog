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
        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = '管理员';
        $admin->description = '管理员可以编辑其他用户';
        $admin->save();

        $owner = new Role();
        $owner->name = 'user';
        $owner->display_name = '普通管理';
        $owner->description = '普通管理';
        $owner->save();

        $allPermission = array_column(Permission::all()->toArray(), 'id');
        $admin->perms()->sync($allPermission);
        // 普通管理
        $user = Permission::where("display_name", "=", "创建用户")->first();
        $loginBackend = Permission::where('name','admin.system.login')->first();
        $owner->attachPermissions([$user, $loginBackend]);

    }
}
