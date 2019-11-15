


<!DOCTYPE html>
<html>
<head>
    <title>文章管理</title>
    <?php require "inc/admin_head.php";?>
</head>
<body class="hisi-theme-099">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header" style="z-index:999!important;">
        <div class="fl header-logo">博客管理后台V1.0</div>
        <ul class="layui-nav fl nobg main-nav">
            <li class="layui-nav-item layui-this">
                <a href="javascript:;">首页</a>
            </li>
        </ul>
        <ul class="layui-nav fr nobg head-info">
            <li class="layui-nav-item">
                <a href="javascript:void(0);">管理员</a>
                <dl class="layui-nav-child">
                    <dd><a href="index.php?c=admin&a=logout">退出登录</a></dd>
                </dl>
            </li>
        </ul>
    </div>
    <div class="layui-side layui-bg-black" id="switchNav">
        <?php require "inc/admin_left_menu.php"?>
    </div>

    <div class="layui-body" id="switchBody">
        <ul class="bread-crumbs">
            <li><a href="javascript:void(0);">系统功能</a></li>
            <li>></li>
            <li><a href="javascript:void(0);">文章管理</a></li>
        </ul>
        <div style="padding:0 10px;" class="mcolor"></div>
        <div class="page-body">

            <div class="layui-tab layui-tab-card">
                <ul class="layui-tab-title">
                    <li class="layui-this">
                        文章列表
                    </li>
                    <div class="tool-btns">
                        <a href="javascript:location.reload();" title="刷新当前页面" class="aicon ai-shuaxin2 font18"></a>
                        <a href="javascript:;" class="aicon ai-quanping1 font18" id="fullscreen-btn" title="打开/关闭全屏"></a>
                    </div>
                </ul>
                <div class="layui-tab-content page-tab-content">
                    <div class="layui-tab-item layui-show">
                        <div class="page-toolbar">
                            <div class="layui-btn-group fl">
                                <a href="index.php?c=admin&a=wenzhang_edit" class="layui-btn layui-btn-primary layui-icon layui-icon-add-circle-fine">&nbsp;添加新文章</a>
                            </div>
                        </div>
                        <table id="dataTable"></table>
                        <script src="js/layui/layui.js?v=1.0.9"></script>
                        <script>
                            var ADMIN_PATH = "index.php";
                            layui.config({
                                base: 'js/',
                                version: '1.0.9'
                            }).use('global');
                        </script>
                        <script type="text/html" title="标题模板" id="biaoTpl">
                            <a href="index.php?c=home&a=info&id={{d.id}}" target="_blank">{{d.biaoti}}</a>
                        </script>
                        <script type="text/html" title="操作按钮模板" id="buttonTpl">
                            <a href="index.php?c=admin&a=wenzhang_edit&id={{d.id}}" class="layui-btn layui-btn-xs layui-btn-normal">修改</a>
                            <a href="index.php?c=admin&a=wenzhang_del&id={{d.id}}" class="layui-btn layui-btn-xs layui-btn-danger j-tr-del">删除</a>
                        </script>
                        <script type="text/html" title="图片模板" id="tupianTpl">
                            {{#  if(d.tupian && d.tupian != ''){ }}
                                <img width="50" height="50" src="{{d.tupian}}" />
                            {{#  }else{ }}
                                暂无
                            {{#  } }}
                        </script>
                        <script type="text/html" title="推荐模板" id="tuijianTpl">
                            {{#  if(d.shouye_tuijian && d.shouye_tuijian === '1'){ }}
                                <span class="layui-badge layui-bg-blue">主页</span>
                            {{#  } }}
                            {{#  if(d.cebian_tuijian && d.cebian_tuijian === '1'){ }}
                                <span class="layui-badge layui-bg-green">侧边</span>
                            {{#  } }}
                        </script>
                        <script type="text/javascript">
                            layui.use(['table'], function() {
                                var table = layui.table;
                                table.render({
                                    elem: '#dataTable'
                                    ,url: 'index.php?c=admin&a=wenzhang_list' //数据接口
                                    ,page: true //开启分页
                                    ,limit: 10
                                    ,text: {
                                        none : '暂无相关数据'
                                    }
                                    ,cols: [[ //表头
                                        {field:'id',title:'Id',width: 50}
                                        ,{field: 'biaoti', title: '标题',templet: '#biaoTpl'}
                                        ,{field: 'tupian', title: '图片',templet: '#tupianTpl',width: 80}
                                        ,{field: 'zuozhe', title: '作者',width: 80}
                                        ,{field: 'lanmu_biaoti', title: '所属栏目',width: 120}
                                        ,{field: 'shijian', title: '发表时间',width: 170}
                                        ,{field: 'tuijian', title: '推荐',width: 110,templet: '#tuijianTpl'}
                                        ,{title: '操作',width: 120, templet: '#buttonTpl'}
                                    ]]
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-footer footer">
        <span class="fr">博客管理后台V1.0</span>
    </div>
</div>
</body>
</html>
