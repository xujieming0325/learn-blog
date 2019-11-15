
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

    <div class="layui-body" id="switchBody">
        <ul class="bread-crumbs">
            <li><a href="javascript:void(0);">系统功能</a></li>
            <li>&gt;</li>
            <li><a href="index.php?c=admin&a=lanmu">栏目管理</a></li>
            <li>&gt;</li>
            <li><a href="javascript:void(0);">添加栏目</a></li>
        </ul>
        <div style="padding:0 10px;" class="mcolor"></div>
        <div class="page-body">

            <div class="layui-tab layui-tab-card">
                <ul class="layui-tab-title">
                    <li class="layui-this">
                        <a href="javascript:;" id="curTitle">添加栏目</a>
                    </li>
                    <div class="tool-btns">
                        <a href="javascript:location.reload();" title="刷新当前页面" class="aicon ai-shuaxin2 font18"></a>
                        <a href="javascript:;" class="aicon ai-quanping1 font18" id="fullscreen-btn" title="打开/关闭全屏"></a>
                    </div>
                </ul>
                <div class="layui-tab-content page-tab-content">
                    <div class="layui-tab-item layui-show">
                        <form class="layui-form layui-form-pane" action="index.php?c=admin&a=lanmu_add_action" method="post" id="editForm" lay-filter="myform">

                            <div class="layui-form-item">
                                <label class="layui-form-label">所属栏目</label>
                                <div class="layui-input-inline">
                                    <select name="pid" class="field-pid" type="select" lay-filter="pid">
                                        <option value="0" level="0">顶级栏目</option>
                                        <?php echo $view_data['option_data'];?>
                                    </select>
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                    请选择上级栏目
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">栏目名称</label>
                                <div class="layui-input-inline">
                                    <input type="text" class="layui-input field-title" name="title" lay-verify="required" autocomplete="off" placeholder="请输入栏目名称">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                    必填，长度限制3-24个字节(1个汉字等于3个字节)
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">栏目网址</label>
                                <div class="layui-input-inline" style="width: 450px;">
                                    <input type="text" class="layui-input field-url" name="url" lay-verify="required" autocomplete="off" placeholder="例如:index.php?c=home&a=index">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                    必填
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">单页设置</label>
                                <div class="layui-input-block">
                                    <input type="checkbox" name="danye" title="是否单页">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">栏目内容</label>
                                <div class="layui-input-block">
                                    <textarea id="kindeditor" name="content" class="field-content"><?php echo $view_data['content'];?></textarea>
                                </div>
                            </div>



                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <input type="hidden" class="field-id" name="id">
                                    <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit">提交</button>
                                    <a href="index.php?c=admin&a=lanmu" class="layui-btn layui-btn-primary ml10"><i class="aicon ai-fanhui"></i>返回</a>
                                </div>
                            </div>
                        </form>
                        <script src="js/layui/layui.js?v=1.0.9"></script>
                        <script>
                            var ADMIN_PATH = "/index.php";
                            layui.config({
                                base: '/js/',
                                version: '1.0.9'
                            }).use('global');
                        </script>
                        <script>
                            var formData = "";
                            layui.use(['form'], function() {
                                var $ = layui.jquery, form = layui.form;
                                if (formData) {
                                    $('.ass-level').val(parseInt($('.field-pid option:selected').attr('level'))+1);
                                }
                            });
                        </script>
                        <script src="js/footer.js"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="layui-footer footer">
        <span class="fr">博客管理后台V1.0</span>
    </div>
</div>
<script src="js/editor/kindeditor/kindeditor-min.js"></script>
<script>
    /* 修改模式下需要将数据放入此变量 */
    <?php if( $view_data['id'] > 0 ){ ?>
        layui.use(['form'], function() {
            var form = layui.form;
            //表单初始赋值
            form.val('myform',{
                "id":<?php echo $view_data['id'];?>,
                "pid":<?php echo $view_data['pid'];?>,
                "url":"<?php echo $view_data['url'];?>",
                "title":"<?php echo $view_data['title'];?>",
                "danye":<?php echo $view_data['danye'];?>
            });
        });
    <?php }?>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#kindeditor', {uploadJson: "index.php?c=admin&a=upload",allowFileManager : false,minHeight:300, width:"100%", afterBlur:function(){this.sync();}});
    });
</script>
</body>
</html>
