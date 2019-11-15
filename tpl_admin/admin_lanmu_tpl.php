<!DOCTYPE html>
<html>
<head>
    <title>栏目管理</title>
    <?php require "inc/admin_head.php";?>
</head>
<body class="hisi-theme-0">
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
    <div class="layui-body" id="switchBody" style="z-index: 998;">
        <ul class="bread-crumbs">
            <li><a href="javascript:void(0);">系统功能</a></li>
            <li>&gt;</li>
            <li><a href="javascript:void(0);">栏目管理</a></li>
        </ul>
        <div style="padding:0 10px;" class="mcolor"></div>
        <div class="page-body">

            <div class="layui-tab layui-tab-card">
                <ul class="layui-tab-title">
                    <li class="layui-this">
                        <a href="javascript:;">栏目列表</a>
                    </li>

                    <div class="tool-btns">
                        <a href="javascript:location.reload();" title="刷新当前页面" class="aicon ai-shuaxin2 font18"></a>
                        <a href="javascript:;" class="aicon font18 ai-quanping1" id="fullscreen-btn" title="打开/关闭全屏"></a>
                    </div>
                </ul>
                <div class="layui-tab-content page-tab-content" style="min-height: auto;">
                    <div class="layui-tab-item layui-form menu-dl layui-show">
                        <form class="page-list-form">
                            <div class="page-toolbar">
                                <div class="layui-btn-group fl">
                                    <a href="index.php?c=admin&a=lanmu_edit" class="layui-btn layui-btn-primary"><i class="aicon ai-tianjia"></i>添加栏目</a>
                                </div>
                            </div>
                            <dl class="menu-dl1 menu-hd mt10">
                                <dt>栏目名称</dt>
                                <dd>
                                   <span class="hd">栏目网址</span>
                                    <!--<span class="hd2">状态</span>-->
                                    <span class="hd3">操作</span>
                                </dd>
                            </dl>

                            <?php
                            /* 遍历顶级栏目的内容 */
                            foreach ($view_data['top_lanmu'] as $val) {          ?>
                            <dl class="menu-dl1">
                                <dt>
                                    <div class="" lay-skin="primary"><i class="layui-icon layui-icon-right"></i><span><?php echo $val['title'];?></span></div>
                                    <span class="menu-sort " style="width: 200px;border: none;text-align: left;"><?php echo $val['url'];?></span>
                                    <div class="menu-btns">
                                        <a href="index.php?c=admin&a=lanmu_edit&id=<?php echo $val['id'];?>" title="编辑"><i class="layui-icon">&#xe642;</i></a>
                                        <a href="index.php?c=admin&a=lanmu_del&id=<?php echo $val['id'];?>" title="删除" onclick="return confirm('确定要删除吗？')"><i class="layui-icon">&#xe640;</i></a>
                                    </div>
                                </dt>
                                <?php
                                /* 如果存在二级数据，输出二级栏目的内容 */
                                if(isset($view_data['erji_data'][$val['id']])) {
                                    $erji_lanmu = $view_data['erji_data'][$val['id']];
                                    ?>
                                    <dd>
                                        <dl class="menu-dl2">
                                            <?php
                                                foreach ($erji_lanmu as $er_val){
                                                ?>
                                                <dt>
                                                    <div class="" lay-skin="primary"><i class="layui-icon layui-icon-right"></i><span><?php echo $er_val['title'];?></span></i></div>
                                                    <span class="menu-sort " style="width: 200px;border: none;text-align: left;"><?php echo $er_val['url'];?></span>
                                                    <div class="menu-btns">
                                                        <a href="index.php?c=admin&a=lanmu_edit&id=<?php echo $er_val['id'];?>" title="编辑"><i class="layui-icon">&#xe642;</i></a>
                                                        <a href="index.php?c=admin&a=lanmu_del&id=<?php echo $er_val['id'];?>" title="删除" onclick="return confirm('确定要删除吗？')"><i class="layui-icon">&#xe640;</i></a>
                                                    </div>
                                                </dt>
                                                <?php
                                            }
                                            ?>
                                        </dl>
                                    </dd>
                                    <?php
                                }
                                ?>
                            </dl>
                                <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-footer footer">
        <span class="fr">博客管理后台V1.0</span>
    </div>
</div>
<script src="js/layui/layui.js?v=1.0.9"></script>
<script>
    var ADMIN_PATH = "index.php";
    layui.config({
        base: 'js/',
        version: '1.0.9'
    }).use('global');
</script>
</body>
</html>