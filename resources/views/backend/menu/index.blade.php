@extends('layouts.backend')
@section('css')
    <style>
        .flashing{border:1px solid #d00;}
    </style>
@endsection

@section('content')
    @inject('menus', 'App\Repositories\Presenter\MenuPresenter')
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>边框</h5>
                </div>
                <div class="ibox-content">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>排序</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        {!! $menus->getMenusList($menuList) !!}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        @permission(config('back.permission.menus.add'))
        <div class="col-sm-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>菜单数据</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">

                        <div class="col-sm-12 b-r">
                            <div class="form-group">
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger">{{$error}}</div>
                                @endforeach
                            </div>
                            <form role="form" method="post" action="{{ url('admin/menu') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>菜单名称</label>
                                    <input type="text" name="name" placeholder="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>父级菜单</label>
                                    <select class="form-control" id="menu_select" name="parent_id">
                                        {!! $menus->getMenu($menu) !!}

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>菜单链接</label>
                                    <input type="text" name="url" placeholder="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>菜单排序</label>
                                    <input type="text" name="sort" placeholder="" class="form-control">
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>提 交</strong></button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endpermission
    </div>
@endsection

@section('script')
<script>
    /**
     * 网页上的元素闪动
     * @param ele       jQuery Object [object]  要闪动的元素<br>
     * @param cls       Class Name [string] 闪动的类<br>
     * @param times     Number [Number] 闪动几次
     */
    function shake(ele, cls, times) {
        var i = 0,
            t = false,
            o = ele.attr("class") + " ",
            c = "",
            times = times || 2;
        if (t) return;
        t = setInterval(function() {
            i++;
            c = i % 2 ? o + cls : o;
            ele.attr("class", c);
            if (i == 2 * times) {
                clearInterval(t);
                ele.removeClass(cls);
            }
        }, 200);
    };
    $(".menu-add").on("click", function () {
       var parent = $(this).parents("tr");
        $("#menu_select").val(parent.find("td:eq(0)").html());
        shake($(".form-control"), "flashing", 3);
    });
</script>
@endsection