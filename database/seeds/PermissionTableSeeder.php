<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission();
        $permission->name = 'create_users';
        $permission->display_name = '创建用户';
        $permission->description = '创建用户';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'edit_users';
        $permission->display_name = '编辑用户';
        $permission->description = '编辑用户';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'delete_users';
        $permission->display_name = '删除用户';
        $permission->description = '删除用户';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'ban_users';
        $permission->display_name = '禁用用户';
        $permission->description = '禁用用户';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'login_backend';
        $permission->display_name = '登陆后台用户';
        $permission->description = '登陆后台用户';
        $permission->save();
    }
}
