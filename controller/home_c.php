

<?php
/* 前台页面控制器类  home_c.php */

/* 先包含公共数据模型类 */
require 'model/home_common_m.php';

class home_c
 {
     /* 显示首页页面 */
     function index()
     {             
        /* 包含首页模型类文件，进行数据处理和获取 */
        require('model/index_m.php');

        /* 用new创建一个首页模型类index_m类的对象 */
        $model = new index_m();

        /* 调用模型的方法，获取数据 */
        $view_data = $model->get_view_data();

        /* 包含首页视图类文件 */
        require('view/index_v.php');

        /* 用new创建一个首页视图类index_v类的对象 */
        $view = new index_v();

        /* 调用视图的方法，包含并显示模板 */
        $view->display($view_data);
     }


     /* 显示关于我页面 */
     function about()
     {
         /* 包含模型类文件，进行数据处理和获取 */
         require('model/about_m.php');

         /* 用new创建模型类对象 */
         $model = new about_m();

         /* 调用模型的方法，获取数据 */
         $view_data = $model->get_view_data();

        /* 包含关于我页面的视图类文件 */
        require('view/about_v.php');

        /* 用new创建一个关于我页面视图类对象 */
        $view = new about_v();

        /* 调用视图的方法，包含并显示模板 */
        $view->display($view_data);
     }


     /* 显示相册分享页面 */
     function share()
     {
         /* 包含模型类文件，进行数据处理和获取 */
         require('model/share_m.php');

         /* 用new创建模型类对象 */
         $model = new share_m();

         /* 调用模型的方法，获取数据 */
         $view_data = $model->get_view_data();

         /* 包含相册分享页面的视图类文件 */
         require('view/share_v.php');

         /* 用new创建一个相册分享页面视图类share_v类的对象 */
         $view = new share_v();

         /* 调用视图的方法，包含并显示模板 */
         $view->display($view_data);
     }


     /* 显示博客日记页面 */
     function info()
     {
         /* 包含模型类文件，进行数据处理和获取 */
         require('model/info_m.php');

         /* 用new创建模型类对象 */
         $model = new info_m();

         /* 调用模型的方法，获取数据 */
         $view_data = $model->get_view_data();

        /* 包含博客日记页面的视图类文件 */
        require('view/info_v.php');

        /* 用new创建一个博客日记页面视图类info_v类的对象 */
        $view = new info_v();

        /* 调用视图的方法，包含并显示模板 */
        $view->display($view_data);
     }


     /* 显示博客列表页面 */
     function lists()
     {
         /* 包含模型类文件，进行数据处理和获取 */
         require('model/lists_m.php');

         /* 用new创建模型类对象 */
         $model = new lists_m();

         /* 调用模型的方法，获取数据 */
         $view_data = $model->get_view_data(20);

        /* 包含博客列表页面的视图类文件 */
        require('view/lists_v.php');

        /* 用new创建一个博客列表页面视图类lists_v类的对象 */
        $view = new lists_v();

        /* 调用视图的方法，包含并显示模板 */
        $view->display($view_data);
     }


     /* 显示博客时间轴页面 */
     function times()
     {
         /* 包含模型类文件，进行数据处理和获取 */
         require('model/lists_m.php');

         /* 用new创建模型类对象 */
         $model = new lists_m();

         /* 调用模型的方法，获取数据 */
         $view_data = $model->get_view_data(20);

        /* 包含博客时间轴页面的视图类文件 */
        require('view/times_v.php');

        /* 用new创建一个博客时间轴页面视图类times_v类的对象 */
        $view = new times_v();

        /* 调用视图的方法，包含并显示模板 */
        $view->display($view_data);
     }
 }
?>
