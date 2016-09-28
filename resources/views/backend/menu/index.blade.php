@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-sm-4">
                <div id="nestable-menu">
                    <button type="button" data-action="expand-all" class="btn btn-white btn-sm">展开所有</button>
                    <button type="button" data-action="collapse-all" class="btn btn-white btn-sm">收起所有</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>自定义主题</h5>
                    </div>
                    <div class="ibox-content">

                        <p class="m-b-lg">
                            每个列表可以自定义标准的CSS样式。每个单元响应所以你可以给它添加其他元素来改善功能列表。
                        </p>

                        <div class="dd" id="nestable2">
                            <ol class="dd-list">
                                @inject('menus', 'App\Repositories\Presenter\MenuPresenter')
                                {!! $menus->getMenuList($menuList) !!}

                            </ol>
                        </div>
                        <div class="m-t-md">
                            <h5>数据：</h5>
                        </div>
                        <textarea id="nestable2-output" class="form-control"></textarea>
                    </div>

                </div>
            </div>

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
                                        <select class="form-control m-b" name="parent_id">
                                            @inject('menus', 'App\Repositories\Presenter\MenuPresenter')
                                            {{!! $menus->getMenu($menu); !!}}

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
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/js/content.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/nestable/jquery.nestable.js') }}"></script>
    <script>
        $(document).ready(
                function(){
                    var updateOutput=function(e){
                        var list=e.length?e:$(e.target),output=list.data("output");
                        if(window.JSON){
                            output.val(window.JSON.stringify(list.nestable("serialize")))
                        }else{
                            output.val("浏览器不支持")
                        }
                    };
//                    $("#nestable").nestable({group:1}).on("change",updateOutput);
                    $("#nestable2").nestable({group:1}).on("change",updateOutput);
//                    updateOutput($("#nestable").data("output",$("#nestable-output")));
                    updateOutput($("#nestable2").data("output",$("#nestable2-output")));
                    $("#nestable-menu").on("click",function(e){
                        var target=$(e.target),action=target.data("action");
                        if(action==="expand-all"){
                            $(".dd").nestable("expandAll")
                        }if(action==="collapse-all"){
                            $(".dd").nestable("collapseAll")
                        }
                    })
                });
    </script>
@endsection