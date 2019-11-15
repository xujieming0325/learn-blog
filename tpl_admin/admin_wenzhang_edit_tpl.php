<!DOCTYPE html>
<html>
<head>
    <title>文章管理</title>
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
            <li><a href="index.php?c=admin&a=wenzhang">文章管理</a></li>
            <li>&gt;</li>
            <li><a href="javascript:void(0);">添加文章</a></li>
        </ul>
        <div style="padding:0 10px;" class="mcolor"></div>
        <div class="page-body">

            <div class="layui-tab layui-tab-card">
                <ul class="layui-tab-title">
                    <li class="layui-this">
                        <a href="javascript:;" id="curTitle">添加文章</a>
                    </li>
                    <div class="tool-btns">
                        <a href="javascript:location.reload();" title="刷新当前页面" class="aicon ai-shuaxin2 font18"></a>
                        <a href="javascript:;" class="aicon ai-quanping1 font18" id="fullscreen-btn" title="打开/关闭全屏"></a>
                    </div>
                </ul>
                <div class="layui-tab-content page-tab-content">
                    <div class="layui-tab-item layui-show">
                        <form class="layui-form layui-form-pane" action="index.php?c=admin&a=wenzhang_add_action" method="post" id="editForm" lay-filter="myform">
                            <div class="layui-form-item">
                                <label class="layui-form-label">文章标题</label>
                                <div class="layui-input-inline" style="width: 500px;">
                                    <input type="text" class="layui-input field-biaoti" name="biaoti" lay-verify="required" autocomplete="off" placeholder="请输入文章标题">
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                    必填
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">所属栏目</label>
                                <div class="layui-input-inline">
                                    <select name="lanmu_id" class="field-lanmu_id" type="select" lay-filter="lanmu_id">
                                        <option value="0" level="0">请选择</option>
                                        <?php echo $view_data['option_data'];?>
                                    </select>
                                </div>
                                <div class="layui-form-mid layui-word-aux">
                                    请选择上级栏目
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">文章作者</label>
                                <div class="layui-input-inline">
                                    <input type="text" class="layui-input field-zuozhe" name="zuozhe"  autocomplete="off" >
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">文章图片</label>
                                <div class="layui-input-inline upload">
                                    <button type="button" name="upload" class="layui-btn layui-btn-primary layui-upload" lay-type="image" lay-data="{accept:'image'}">请上传图片</button>
                                    <input type="hidden" class="upload-input" name="tupian" value="<?php echo $view_data['tupian'];?>">
                                    <img class="wz_tupian" src="" style="display:none;border-radius:5px;border:1px solid #ccc" width="36" height="36">
                                </div>
                                <div class="layui-form-mid layui-word-aux"></div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">推荐设置</label>
                                <div class="layui-input-block">
                                    <input type="checkbox" name="shouye_tuijian" title="首页推荐">
                                    <input type="checkbox" name="cebian_tuijian" title="侧边推荐">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">文章简介</label>
                                <div class="layui-input-block" >
                                    <textarea name="jianjie" class="field-jianjie" style="width: 100%;height: 80px;"></textarea>
                                </div>

                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">栏目内容</label>
                                <div class="layui-input-block">
                                    <textarea id="kindeditor" name="neirong" ><?php echo $view_data['neirong'];?></textarea>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <input type="hidden" class="field-id" name="id">
                                    <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit">提交</button>
                                    <a href="index.php?c=admin&a=wenzhang" class="layui-btn layui-btn-primary ml10"><i class="aicon ai-fanhui"></i>返回</a>
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
    /* 修改模式下需要将原来文章数据初始赋值到表单 */
    <?php if( isset($view_data['id']) && $view_data['id'] > 0 ){ ?>
        layui.use(['jquery','form'], function() {
            //显示原来文章图片
            var $ = layui.jquery;
            var form = layui.form;
            $('.wz_tupian').hide();
            if("<?php echo $view_data['tupian'];?>" != ''){
                $('.wz_tupian').attr("src","<?php echo $view_data['tupian'];?>").show();
            }

            //表单初始赋值
            form.val('myform',{
                 "id":<?php echo $view_data['id'];?>,
                "lanmu_id":<?php echo $view_data['lanmu_id'];?>,
                "biaoti":"<?php echo $view_data['biaoti'];?>",
                "zuozhe":"<?php echo $view_data['zuozhe'];?>",
                "jianjie":"<?php echo str_replace("\r\n","，",$view_data['jianjie']);?>",
                "shouye_tuijian":<?php echo $view_data['shouye_tuijian'];?>,
                "cebian_tuijian":<?php echo $view_data['cebian_tuijian'];?>
            });
        });
    <?php }?>

    layui.use(['upload'], function() {
        var $ = layui.jquery, layer = layui.layer, upload = layui.upload;
        /**
         * 附件上传url参数说明
         * @param string $from 来源
         * @param string $group 附件分组,默认sys[系统]，模块格式：m_模块名，插件：p_插件名
         * @param string $water 水印，参数为空默认调用系统配置，no直接关闭水印，image 图片水印，text文字水印
         * @param string $thumb 缩略图，参数为空默认调用系统配置，no直接关闭缩略图，如需生成 500x500 的缩略图，则 500x500多个规格请用";"隔开
         * @param string $thumb_type 缩略图方式
         * @param string $input 文件表单字段名
         */
        upload.render({
            elem: '.layui-upload'
            ,url: 'index.php?c=admin&a=upload'
            ,method: 'post'
            ,before: function(input) {
                layer.msg('文件上传中...', {time:3000000});
            },done: function(res, index, upload) {
                var obj = this.item;
                if (res.code == 0) {
                    layer.msg(res.msg);
                    return false;
                }
                layer.closeAll();
                var input = $(obj).parents('.upload').find('.upload-input');
                if ($(obj).attr('lay-type') == 'image') {
                    input.siblings('img').attr('src', res.data.file).show();
                }
                input.val(res.data.file);
            }
        });
    });


    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#kindeditor', {uploadJson: "index.php?c=admin&a=upload",allowFileManager : false,minHeight:300, width:"100%", afterBlur:function(){this.sync();}});
    });
</script>
</body>
</html>
