<?php
/*admin_wenzhang_m.php文章模型*/

class admin_wenzhang_m{

    /**
     * 保存文章数据到数据库
     * @param $postData 文章数据保存数组
     * @return bool|mysqli_result
     */
    public function wenzhang_save($post_data){
        /* 先定义返回数据结构 */
        $rt_data = array(
            "msg" => "操作成功",
            "code" => 1,
            "url" => 'index.php?c=admin&a=wenzhang',
        );

        /* 文章标题为空时返回出错信息 */
        if(empty($post_data['biaoti'])){
            $rt_data['msg'] = '文章标题不能为空';
            $rt_data['code'] = 0;
            $rt_data['url'] = '';
            return $rt_data;
        }

        /* 去掉文章简介中的回车换行符 */
        $post_data['jianjie'] = str_replace("\r\n","，",$post_data['jianjie']);

        /* 处理推荐数据 */
        $post_data['shouye_tuijian'] = $this->on_to_one($post_data['shouye_tuijian']);
        $post_data['cebian_tuijian'] = $this->on_to_one($post_data['cebian_tuijian']);

        /* 实例化取数据库操作对象 */
        $db_obj = ConnectMysqli::getIntance();
        /* 取文章id */
        $id = $post_data['id'];
        /*
         判断是添加还是修改栏目，如果$id为空或为0，说明是添加，
         如果$id大于0说明是修改数据表中id和传来的id相等的那条记录
         */
        if(empty($id) && intval($id) == 0){

            /* 组装添加记录的sql查询语句 */
            $sql = "insert into wenzhang (`lanmu_id`,`zuozhe`,`biaoti`,`tupian`,`jianjie`,`neirong`,`shouye_tuijian`,`cebian_tuijian`,`shijian`) values ('%d','%s','%s','%s','%s','%s','%d','%d','%s')";

            /* sprintf替换生成最终sql */
            $sql = sprintf($sql, $post_data['lanmu_id'], $post_data['zuozhe'], $post_data['biaoti'],
                $post_data['tupian'],$post_data['jianjie'],$post_data['neirong'],$post_data['shouye_tuijian'],
                $post_data['cebian_tuijian'],$post_data['shijian']);

            /* 执行sql */
            $result = $db_obj->query($sql);
        }
        else{

            /* 组装修改记录的sql查询语句 */
            $sql = "update wenzhang set `lanmu_id`= '%d',`zuozhe`='%s',`biaoti`='%s',`tupian`='%s',`jianjie`='%s',`neirong`='%s',`shouye_tuijian`='%s',`cebian_tuijian`='%s',`shijian`='%s' where id = '%d'";

            /* sprintf替换生成最终sql */
            $sql = sprintf($sql, $post_data['lanmu_id'], $post_data['zuozhe'], $post_data['biaoti'],
                $post_data['tupian'],$post_data['jianjie'],$post_data['neirong'],$post_data['shouye_tuijian'],
                $post_data['cebian_tuijian'],$post_data['shijian'],$id);

            /* 执行sql */
            $result = $db_obj->query($sql);
        }
        /* 返回結果 */
        return $rt_data;
    }

    /**
     * 把'on'转化为1
     */
    public function on_to_one($data){
        if(isset($data) && $data == 'on'){
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * 取编辑文章时下拉选择表单的html
     * @param $id
     * @return string
     */
    public function get_lanmu_option($pid=''){

        /* 要返回的html字串 */
        $html_str = '';

        /* 包含栏目模型类，跨模型取栏目数据 */
        require('model/admin_lanmu_m.php');

        /* 实例化对象 */
        $admin_lanmu_m = new admin_lanmu_m();

        /* 从栏目模型取栏目数据 */
        $lanmu_data = $admin_lanmu_m->get_lanmu_list();

        /* 设置顶级栏目数据 */
        $list = $lanmu_data['top_lanmu'];

        /* 设置二级栏目数据 */
        $erji_data = $lanmu_data['erji_data'];

        /* 遍历所有顶级栏目 */
        foreach ($list as $v) {

            /* 如果是单页面，跳过 */
            if($v['danye']) {
                continue;
            }

            $html_str .= '<option level="1" value="' . $v['id'] . '">' . $v['title'] . '</option>';

            if(isset($erji_data[$v['id']])){
                /* 遍历所有二级栏目 */
                foreach ($erji_data[$v['id']] as $v2) {
                    $html_str .= '<option level="2" value="' . $v2['id'] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $v2['title'] . '</option>';
                }
            }
        }

        return $html_str;
    }

    /**
     * 按分页取文章数据
     * @param $page
     * @param $limit
     */
    public function get_wenzhang_list($page,$limit,$where=' 1=1 '){
        /* 初始返回的信息 */
        $msg = "";
        $data = array();

        /* 实例化取数据库操作对象 */
        $db_obj = ConnectMysqli::getIntance();

        /*
        首先获取数据库中到底有多少条数据，才能判断具体要分多少页，总页数 具体的公式就是
        总数据数 除以 每页显示的条数，有余进一 。
        也就是说 10/3=3.3333 = 4 有余数就要进一。
        */

        /* 查总条数 */
        $count_sql = "select count(*) as total from wenzhang where {$where}";
        $total = $db_obj->getRow($count_sql);
        $total = intval($total['total']);

        /* 获得总页数 */
        $page_total = ceil($total/$limit);

        //假如传入的页数参数$page 大于总页数 $page_total，则显示错误信息
        If($page > $page_total || $page == 0){
            $msg = "找不到该页.";
        }else{
            /*获取limit的第一个参数的值偏移量 ，假如第一页则为(1-1)*10 = 0,第二页为(2-1)*10 = 10。
        (传入的页数-1) * 每页的数据 得到limit第一个参数的值*/
            $offset = ($page-1) * $limit;

            /* 获取相应页所需要显示的数据 */
            $sql = "select wenzhang.*,lanmu.title as lanmu_biaoti from wenzhang left join lanmu on lanmu.id = wenzhang.lanmu_id where {$where} order by wenzhang.id desc limit $offset,$limit ";

            $data = $db_obj->getAll($sql);
        }

        /* 定义返回结构 */

        $rt = array(
            'code'=> 0,
            'count' => $total,
            'page_total' => $page_total,
            'data' => $data,
            'msg' => $msg,
        );

        return $rt;
    }

    /**
     * 通过id取文章表的一条记录
     * @param $id
     * @return mixed
     */
    public function get_wenzhang_data($id){
        /* 实例化取数据库操作对象 */
        $db_obj = ConnectMysqli::getIntance();

        /* 组装sql查询语句 */
        $sql = "select wenzhang.*,lanmu.title as lanmu_biaoti from wenzhang left join lanmu on lanmu.id = wenzhang.lanmu_id where wenzhang.id = '%d'";
        $sql = sprintf($sql,$id);

        /* 执行sql，返回一行记录 */
        return $db_obj->getRow($sql);
    }

    /**
     * 删除文章
     * @param $id
     * @return mixed
     */
    public function wenzhang_del($id){
        /* 实例化取数据库操作对象 */
        $db_obj = ConnectMysqli::getIntance();

        /* 组装sql查询语句，查所有二级栏目，pid>0 的 */
        $sql = "delete from wenzhang where id = '%d'";
        $sql = sprintf($sql,$id);

        /* 执行sql，删除一行记录 */
        return $db_obj->query($sql);
    }
}
?>
