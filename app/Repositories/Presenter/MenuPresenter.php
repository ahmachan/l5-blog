<?php
namespace App\Repositories\Presenter;

class MenuPresenter
{
    protected $menuStr;
    public function getMenu($menus)
    {
        if ($menus) {
            $option = '<option value="0">顶级菜单</option>';
            foreach ($menus as $v) {
                $space = '';
                $tmp = explode(',', $v->path);
                $len = count($tmp);
                if($len > 2) {
                    $repeat = "├─────";
                    $space .= str_repeat($repeat, $len - 2);
                }
                $option .= '<option value="'.$v->id.'">'.$space . $v->name.'</option>';
            }
            return $option;
        }
        return '<option value="0">顶级菜单</option>';
    }

    /**
     * 菜单列表视图
     * @author 晚黎
     * @date   2016-08-10
     * @param  [type]     $menus [description]
     * @return [type]            [description]
     */
    public function getMenuList($menus)
    {
        if ($menus) {
            $item = '';
            foreach ($menus as $key => $v) {
                $item .= $this->getNestableItem($v);
            }
            return $item;
        }
        return '暂无菜单';
    }

    public function getMenusList($menus, $deep = 0) {
        foreach ($menus as $key => $value) {
            $len = count($value['child']);
            $this->menuStr .= $this->nodeMenu($value, $deep);
            if($len) {
                $deep_copy = $deep;
                $this->getMenusList($value['child'], ++$deep_copy);
            }
        }
        return $this->menuStr;
    }

    protected function nodeMenu($menu, $deep, $treeNode=8) {
        $node = $deep ? "├─" . str_repeat("─", $treeNode) : '';
        if($deep) {
            $node = str_repeat($node, $deep);
        }
        $node .= $menu['name'];
        $str = "<tr><td>{$menu['id']}</td><td>$node</td><td>{$menu['sort']}</td><td><a href='javascript:;' class='menu-add'>新增</a>|<a href='javascript:;' class='menu-edit'>编辑</a>|<a href='javascript:;' class='menu-delete'>删除</a></td></tr>";
        return $str;
    }
    /**
     * 返回菜单HTML代码
     * @author 晚黎
     * @date   2016-08-10
     * @param  [type]     $id    [description]
     * @param  [type]     $name  [description]
     * @param  [type]     $child [description]
     * @return [type]            [description]
     */
    protected function getNestableItem($menu)
    {
        if ($menu['child']) {
            return $this->getHandleList($menu['id'],$menu['name'],$menu['child']);
        }
        if ($menu['parent_id'] == 0) {
            $str = "<tr><td>{$menu['id']}</td><td>{$menu['name']}</td><td>1</td></tr>";
            return $str;
//            return '<li class="dd-item dd-parent" data-id="'.$menu['id'].'"><div class="dd-handle"><span class="label label-info"></button></span> '.$menu['name'].'</div></li>';
        }
        $str = "<tr><td>{$menu['id']}</td><td>--{$menu['name']}</td><td>1</td></tr>";
        return $str;
//        return '<li class="dd-item" data-id="'.$menu['id'].'"><div class="dd-handle"><span class="label label-info"></span> '.$menu['name'].'</div></li>';
    }
    /**
     * 判断是否有子集
     * @author 晚黎
     * @date   2016-08-10
     * @param  [type]     $id    [description]
     * @param  [type]     $name  [description]
     * @param  [type]     $child [description]
     * @return [type]            [description]
     */
    protected function getHandleList($id,$name,$child)
    {
        $handle = "<tr><td>{$id}</td><td>------{$name}</td><td>1</td></tr>";
//        $handle = '<li class="dd-item" data-id="'.$id.'"><div class="dd-handle"><span class="label label-info"></span>'.$name.' </div><ol class="dd-list">';
        if ($child) {
            foreach ($child as $v) {
                $handle .= $this->getNestableItem($v);
            }
        }
//        $handle .= '</ol></li>';
        return $handle;
    }
    /**
     * 菜单按钮
     * @author 晚黎
     * @date   2016-08-12
     * @return [type]     [description]
     */
    protected function getActionButtons($id,$bool = true)
    {
        $action = '<div class="pull-right action-buttons">';
        if (auth()->user()->can(config('admin.permissions.menus.add')) && $bool) {
            $action .= '<a href="javascript:;" data-pid="'.$id.'" class="btn-xs createMenu" data-toggle="tooltip"data-original-title="添加"  data-placement="top"><i class="fa fa-plus"></i></a>';
        }
        if (auth()->user()->can(config('admin.permissions.menus.edit'))) {
            $action .= '<a href="javascript:;" data-href="'.url('admin/menu/'.$id.'/edit').'" class="btn-xs editMenu" data-toggle="tooltip"data-original-title="修改"  data-placement="top"><i class="fa fa-pencil"></i></a>';
        }
        if (auth()->user()->can(config('admin.permissions.menus.delete'))) {
            $action .= '<a href="javascript:;" class="btn-xs destoryMenu" data-id="'.$id.'" data-original-title="删除"data-toggle="tooltip"  data-placement="top"><i class="fa fa-trash"></i><form action="'.url('admin/menu',[$id]).'" method="POST" name="delete_item'.$id.'" style="display:none"><input type="hidden"name="_method" value="delete"><input type="hidden" name="_token" value="'.csrf_token().'"></form></a>';
        }
        $action .= '</div>';
        return $action;
    }
    /**
     * 左侧菜单渲染
     * @author 晚黎
     * @date   2016-08-26
     * @param  string     $value [description]
     * @return [type]            [description]
     */
    public function sidebarMenus($menus)
    {
        $html = '';
        if ($menus) {
            $html = '<li>';
            foreach ($menus as $v) {
                if (auth()->user()->can($v['slug'])) {
                    if ($v['child']) {
                        $html .= '<li class="'.active_class(if_uri_pattern(explode(',',$v['heightlight_url']))).'"><a><i class="'.$v['icon'].'"></i> '.$v['name'].' <span class="fa fa-chevron-down"></span></a>'.$this->getSidebarChildMenu($v['child']).'</li>';
                    }else{
                        $html .= '<li class="'.active_class(if_uri_pattern([$v['heightlight_url']])).'"><a href="'.$v['url'].'"><i class="'.url($v['url']).'"></i> '.$v['name'].'</a></li>';
                    }
                }
            }
            $html .= '</li>';
        }
        return $html;
    }
    /**
     * 左侧菜单子菜单渲染
     * @author 晚黎
     * @date   2016-08-26
     * @param  string     $childMenu [description]
     * @return [type]                [description]
     */
    public function getSidebarChildMenu($childMenu='')
    {
        $html = '';
        if ($childMenu) {
            $html = '<ul class="nav child_menu" style="display:'.active_class(if_uri_pattern(['admin/menu*']),'block','none').'">';
            foreach ($childMenu as $v) {
                if (auth()->user()->can($v['slug'])) {
                    $html .= '<li class="'.active_class(if_uri_pattern([$v['heightlight_url']]),'current-page').'"><a href="'.url($v['url']).'">'.$v['name'].'</a></li>';
                }
            }
            $html .= '</ul>';
        }
        return $html;
    }
}