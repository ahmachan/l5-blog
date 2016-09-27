<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\MenuImpRepository;
use App\Models\Menu;
use Cache;

class MenuRepository extends MenuImpRepository
{

    public function model()
    {
        return Menu::class;
    }

    /**
     * 递归菜单数据
     * @param $menus        菜单列表
     * @param int $pid      父级id
     * @return array|string
     */
    public function sortMenu($menus, $pid = 0) {
        $arr = [];
        if (empty($menus)) {
            return '';
        }
        foreach ($menus as $key => $v) {
            if ($v['parent_id'] == $pid) {
                $arr[$key] = $v;
                $arr[$key]['child'] = self::sortMenu($menus,$v['id']);
            }
        }
        return $arr;
    }

    public function sortMenuSetCache() {

    }

    public function getMenuList() {

    }

    public function editMenu($id) {

    }

    public function updateMenu($request) {

    }

    public function destroyMenu($id) {

    }
}