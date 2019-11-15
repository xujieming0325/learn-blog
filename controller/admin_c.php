
<?php
/**
 * 后台管理控制器类  admin_c.php
 */
class admin_c
{
    /**
     * 构造函数
     */
    function __construct()
    {
        /* 开启session */
        session_start();

        /* 转义post过来的字符，sql防注入安全考虑 */
        foreach ($_POST as $key => $val){
            if (!get_magic_quotes_gpc()) {
                $_POST[$key] = addslashes($val);
            }
        }

        /* 判断没登录的跳到登录页 */
        if($_GET['a'] == 'login' || $_GET['a'] == 'login_action'){
            /* 不用处理的方法名，比如登录页面不用处理 */
        }else{
            if(!$_SESSION['is_login']){
                /* 跳到登录页 */
                header('Location:index.php?c=admin&a=login');
            }
        }
    }

    /**
     * 登录前端页面输出
     */
    function login(){
        /* 包含登录视图类文件 */
        require('view/admin_login_v.php');

        /* 用new创建一个登录页视图类admin_login_v类的对象 */
        $view = new admin_login_v();

        /* 调用视图的方法，包含并显示模板 */
        $view->display();
    }

    /**
     * 登录接收处理
     */
    function login_action(){
        /* 接收提交过来的username和password,用trim()函数去掉两边空格 */
        /* 账号 */
        $username = trim($_POST['username']);
        /* 密码 */
        $password = trim($_POST['password']);

        /* 包含admin_login_m.php模型类文件，用于进行数据处理和返回 */
        require('model/admin_login_m.php');

        /* 实例模型对象 */
        $admin_login_m = new admin_login_m();

        /* 数据传进模型中处理登录逻辑后返回 */
        $rt_data = $admin_login_m->login($username, $password);

        /* 输出数据：数组转json数据 */
        $out_data = json_encode($rt_data,JSON_UNESCAPED_UNICODE);

        /* 设置输出头，这里是输出json数据，所以为application/json */
        header("Content-Type:application/json;chartset=uft-8");

        /* 输出 */
        echo $out_data;

        /* 返回 */
        return;
    }


    /**
     * 后台管理栏目页
     */
    function lanmu(){

        /* 包含模型类，取回要在view视图里要显示的数据 */
        require('model/admin_lanmu_m.php');

        /* 实例化对象 */
        $admin_lanmu_m = new admin_lanmu_m();

        /* 视图中要用到的数据 */
        $view_data = $admin_lanmu_m->get_lanmu_list();

        /* 包含栏目视图类文件 */
        require('view/admin_lanmu_v.php');

        /* 用new创建一个栏目视图类admin_lanmu_v类的对象 */
        $view = new admin_lanmu_v();

        /* 调用视图的方法，包含并显示模板 */
        $view->display($view_data);
    }


    /**
     * 栏目编辑
     */
    function lanmu_edit(){
        /* 用变量接收get参数,修改栏目时带id参数 */
        if(isset($_GET['id'])){
            $id = intval($_GET['id']);
        }else{
            $id = 0;
        }

        /* 包含模型类，取回要在view视图里要显示的数据 */
        require('model/admin_lanmu_m.php');

        /* 实例化对象 */
        $admin_lanmu_m = new admin_lanmu_m();

        /* 视图中要用到的数据 */
        $view_data = array();

        /* 栏目数据初始化 */
        $view_data['id'] = $id;
        $view_data['pid'] = 0;
        $view_data['title'] = '';
        $view_data['url'] = '';
        $view_data['danye'] = '';
        $view_data['content'] = '';

        /* 如果id>0是修改的，先取要修改的数据回来 */
        if( $id > 0 ){
            $lanmu_data = $admin_lanmu_m->get_lanmu_data($id);
            $view_data['pid'] = $lanmu_data['pid'];
            $view_data['title'] = $lanmu_data['title'];
            $view_data['url'] = $lanmu_data['url'];
            $view_data['danye'] = $lanmu_data['danye'];
            $view_data['content'] = $lanmu_data['content'];
        }

        /* 从模型取回下拉选择表单要用到的html */
        $view_data['option_data'] = $admin_lanmu_m->get_lanmu_option();

        /* 包含添加栏目视图类文件 */
        require('view/admin_lanmu_edit_v.php');

        /*用new创建一个添加栏目视图类admin_lanmu_edit_v类的对象*/
        $view = new admin_lanmu_edit_v();

        /* 调用视图的方法，传进要显示的数据，包含并显示模板 */
        $view->display($view_data);

    }

    /**
     * 栏目添加-接收数据并处理
     */
    function lanmu_add_action(){

        /* 用变量接收post参数 */
        $id = $_POST['id'];
        $pid = $_POST['pid'];
        $title = $_POST['title'];
        $url = $_POST['url'];
        $content = $_POST['content'];
        $danye = isset($_POST['danye']) ? trim($_POST['danye']) : '';

        /* 包含model目录下的admin_lanmu_m.php模型类文件，用于进行数据处理和返回 */
        require('model/admin_lanmu_m.php');

        /* 实例模型对象 */
        $admin_lanmu_m = new admin_lanmu_m();

        /* 返回操作结果 */
        $rt_data = $admin_lanmu_m->lanmu_save($id, $pid, $title, $url,$danye, $content);

        /* 输出数据：数组转json数据 */
        $out_data = json_encode($rt_data,JSON_UNESCAPED_UNICODE);

        /* 设置输出头，这里是输出json数据，所以为application/json */
        header("Content-Type:application/json;chartset=uft-8");

        /* 输出 */
        echo $out_data;

        /* 返回 */
        return;

    }

    /**
     * 栏目删除
     */
    function lanmu_del(){

        /* 用变量接收要删除的id */
        $id = intval($_GET['id']);

        /* 包含model目录下的admin_lanmu_m.php模型类文件，用于进行数据处理和返回 */
        require('model/admin_lanmu_m.php');

        /* 实例模型对象 */
        $admin_lanmu_m = new admin_lanmu_m();

        /* 操作删除 */
        $admin_lanmu_m->lanmu_del($id);

        /* 设置输出头，跳转回栏目管理页面 */
        header("Location:index.php?c=admin&a=lanmu");

        /* 返回 */
        return;
    }


    /**
     * 退出登录
     */
    function logout(){
        /* 清空session的登录内容 */
        session_unset();
        session_destroy();
        /* 跳到登录页 */
        header('Location:index.php?c=admin&a=login');
    }


    /**
     * 上传图片，这里编辑框和文章图片共用本上传方法
     */
    function upload(){
        /* 定义输出结构 */
        $rt = array(
            'code' => 0,
            'msg' => '上传错误',
            'data' => array(),
        );

        /* 判断是不是从编辑框传的图，并设置一个标记$is_bjq说明是从编辑框传的 */
        if(isset($_GET['dir']) && $_GET['dir']=='image'){
            $file = $_FILES['imgFile'];
            $is_bjq = 1;
        }else{
            $file = $_FILES['file'];
            $is_bjq = 0;
        }

        /* 如果有传来$_FILES内容 */
        if(count($file) > 0 ){

            /* 文件名切分成数组 */
            $ary = explode('.',$file['name']);

            /* 取得扩展名 */
            $ext = array_pop($ary);

            /* 设置保存的文件名 */
            $file_name = uniqid().'.'.$ext;

            /* 设置保存的路径 */
            $save_dir = 'upload/'.date('Y-m-d').'/';

            /* 保存的路径不存在时新建一个 */
            if(!is_dir('upload/')){
                mkdir('upload/');
            }
            if(!is_dir($save_dir)){
                mkdir($save_dir);
            }

            /* 包括文件名的完整的保存路径 */
            $full_path = $save_dir.$file_name;

            /* 保存文件 */
            file_put_contents($full_path,file_get_contents($file['tmp_name']));

            /* 上传成功，修改覆盖定义的返回结构 */
            $rt = array(
                'code' => 1,
                'msg' => '上传成功',
                'data' => array('file'=>$full_path),
            );
        }
        if($is_bjq){
            /* 覆盖定义的返回结构，因为编辑框的返回结构不同 */
            $rt = array(
                'error' => 0,
                'url' => $full_path,
            );
            /* 输出最终JSON数据 */
            echo json_encode($rt);
        }else{
            /* 输出最终JSON数据 */
            echo json_encode($rt);
        }
        /* 返回 */
        return;
    }

    /**
     * 文章管理-列表页面
     */
    function wenzhang(){
        $view_data = array();
        /* 包含文章列表视图类文件 */
        require('view/admin_wenzhang_v.php');

        /*用new创建一个文章列表视图类admin_wenzhang_v类的对象*/
        $view = new admin_wenzhang_v();

        /* 调用视图的方法，传进要显示的数据，包含并显示模板 */
        $view->display($view_data);
    }

    /**
     * 文章编辑-添加与修改
     */
    function wenzhang_edit(){
        /* 用变量接收get参数,修改栏目时带id参数 */
        if(isset($_GET['id'])){
            $id = intval($_GET['id']);
        }else{
            $id = 0;
        }

        /* 视图中要用到的数据 */
        $view_data = array();

        /* 数据初始化 */
        $view_data['id'] = $id;
        $view_data['lanmu_id'] = 0;
        $view_data['zuozhe'] = '';
        $view_data['biaoti'] = '';
        $view_data['tupian'] = '';
        $view_data['jianjie'] = '';
        $view_data['neirong'] = '';
        $view_data['shouye_tuijian'] = '';
        $view_data['cebian_tuijian'] = '';

        /* 包含文章模型类，取回要在view视图里要显示的数据（选择文章所属栏目） */
        require('model/admin_wenzhang_m.php');

        /* 实例化对象 */
        $admin_wenzhang_m = new admin_wenzhang_m();

        /* 如果id>0是修改的，先取要修改的数据回来 */
        if( $id > 0 ){
            $wenzhang_data = $admin_wenzhang_m->get_wenzhang_data($id);
            $view_data['lanmu_id'] = $wenzhang_data['lanmu_id'];
            $view_data['zuozhe'] = $wenzhang_data['zuozhe'];
            $view_data['biaoti'] = $wenzhang_data['biaoti'];
            $view_data['tupian'] = $wenzhang_data['tupian'];
            $view_data['jianjie'] = $wenzhang_data['jianjie'];
            $view_data['neirong'] = $wenzhang_data['neirong'];
            $view_data['shouye_tuijian'] = $wenzhang_data['shouye_tuijian'];
            $view_data['cebian_tuijian'] = $wenzhang_data['cebian_tuijian'];
        }

        /* 从模型取回下拉选择表单要用到的html */
        $view_data['option_data'] = $admin_wenzhang_m->get_lanmu_option();

        /* 包含文章列表视图类文件 */
        require('view/admin_wenzhang_edit_v.php');

        /*用new创建一个文章列表视图类admin_wenzhang_edit_v类的对象*/
        $view = new admin_wenzhang_edit_v();

        /* 调用视图的方法，传进要显示的数据，包含并显示模板 */
        $view->display($view_data);
    }

    /**
     * 保存添加或修改的文章内容
     */
    function wenzhang_add_action(){

        /* 用数组变量接收post数据 */
        $post_data = array(
            'id' => intval($_POST['id']),
            'lanmu_id' => intval($_POST['lanmu_id']),
            'zuozhe' => $_POST['zuozhe'],
            'biaoti' => $_POST['biaoti'],
            'tupian' => $_POST['tupian'],
            'jianjie' => $_POST['jianjie'],
            'neirong' => $_POST['neirong'],
            'shouye_tuijian' => isset($_POST['shouye_tuijian']) ? $_POST['shouye_tuijian'] : '',
            'cebian_tuijian' => isset($_POST['cebian_tuijian']) ? $_POST['cebian_tuijian'] : '',
            'shijian' => date('Y-m-d H:i:s'),
        );

        /* 包含model目录下的admin_wenzhang_m.php模型类文件，用于进行数据处理和返回 */
        require('model/admin_wenzhang_m.php');

        /* 实例模型对象 */
        $admin_wenzhang_m = new admin_wenzhang_m();

        /* 返回操作结果 */
        $rt_data = $admin_wenzhang_m->wenzhang_save($post_data);

        /* 输出数据：数组转json数据 */
        $out_data = json_encode($rt_data,JSON_UNESCAPED_UNICODE);

        /* 设置输出头，这里是输出json数据，所以为application/json */
        header("Content-Type:application/json;chartset=uft-8");

        /* 输出 */
        echo $out_data;

        /* 返回 */
        return;
    }

    /**
     * 文章管理-取列表数据
     */
    function wenzhang_list(){

        /* 取第几页 页数 */
        $page = intval($_GET['page']);

        /* 每页多少条 */
        $limit = intval($_GET['limit']);

        /* 包含model目录下的admin_wenzhang_m.php模型类文件，用于进行数据处理和返回 */
        require('model/admin_wenzhang_m.php');

        /* 实例模型对象 */
        $admin_wenzhang_m = new admin_wenzhang_m();

        /* 返回操作结果 */
        $rt_data = $admin_wenzhang_m->get_wenzhang_list($page,$limit);

        /* 输出数据：数组转json数据 */
        $out_data = json_encode($rt_data,JSON_UNESCAPED_UNICODE);

        /* 设置输出头，这里是输出json数据，所以为application/json */
        header("Content-Type:application/json;chartset=uft-8");

        /* 输出 */
        echo $out_data;

        /* 返回 */
        return;

    }

    /**
     * 文章删除
     */
    function wenzhang_del(){

        /* 用变量接收要删除的id */
        $id = intval($_GET['id']);

        /* 包含model目录下的admin_wenzhang_m.php模型类文件，用于进行数据处理和返回 */
        require('model/admin_wenzhang_m.php');

        /* 实例模型对象 */
        $admin_lanmu_m = new admin_wenzhang_m();

        /* 操作删除 */
        $admin_lanmu_m->wenzhang_del($id);

        /* 设置输出头，跳转回栏目管理页面 */
        header("Location:index.php?c=admin&a=wenzhang");

        /* 返回 */
        return;
    }
}
?>
