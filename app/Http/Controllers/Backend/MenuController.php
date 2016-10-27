<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\MenuRepository;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    protected $menu;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menu = $menuRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = $this->getMenus();
        $menuList = $this->menu->getMenuList();
//        dd($menuList);
//        echo '<pre>';
//        var_dump($menuList);
//        echo '</pre>';
        return view("backend.menu.index")->with(compact('menu','menuList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\MenuRequest $request)
    {
        $parent_id = $request->input("parent_id");
        $result = DB::table("menus")->where("id","=",$parent_id)->first();
        $data = $request->all();
        unset($data['_token']);
        $insertId = $this->menu->insertGetId($data);
        if($insertId) {
            $update = ['path' => $result->path . ',' . $insertId];
            $this->menu->update($update, $insertId);
        }

        return redirect('/admin/menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function getMenus() {
        return DB::table("menus")->select("id","name","path")->orderBy("path")->get();
    }
}
