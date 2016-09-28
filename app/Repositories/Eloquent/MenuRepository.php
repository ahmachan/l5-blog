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
        $menus = parent::orderBy('sort','desc');
        if ($menus) {
            $menuList = $this->sortMenu($menus);
            // 缓存菜单数据
            Cache::forever(config('admin.globals.cache.menuList'),$menuList);
            return $menuList;

        }
        return '';
    }

    public function getMenuList() {
        // 判断数据是否缓存
        if (Cache::has(config('admin.globals.cache.menuList'))) {
            return Cache::get(config('admin.globals.cache.menuList'));
        }
        return $this->sortMenuSetCache();
    }

    public function editMenu($id) {

    }

    public function updateMenu($request) {

    }

    public function destroyMenu($id) {

    }
}