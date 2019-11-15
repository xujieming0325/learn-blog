
<?php
/*admin_lanmu_m.php栏目模型*/

class admin_lanmu_m{

    /**
     * 保存栏目数据到数据库
     * @param $id  栏目id，存在数字时为修改，不存在时为添加
     * @param $pid 栏目上级栏目id，即父栏目id
     * @param $title  栏目名称
     * @param $url  栏目网址
     * @param $content 栏目内容
     * @return bool|mysqli_result
     */
    public function lanmu_save($id, $pid, $title, $url, $danye, $content){
        /* 先定义返回数据结构 */
        $rt_data = array(
            "msg" => "操作成功",
            "code" => 1,
            "url" => 'index.php?c=admin&a=lanmu',
        );

        /* 标题为空时返回出错信息 */
        if(empty($title)){
            $rt_data['msg'] = '标题不能为空';
            $rt_data['code'] = 0;
            $rt_data['url'] = '';
            return $rt_data;
        }

        /* 实例化取数据库操作对象 */
        $db_obj = ConnectMysqli::getIntance();

        /* 处理单页设置 */
        if($danye == 'on'){
            $danye = 1;
        }else{
            $danye = 0;
        }

        /*
         判断是添加还是修改栏目，如果$id为空或为0，说明是添加，
         如果$id大于0说明是修改数据表中id和传来的id相等的那条记录
         */
        if(empty($id) && intval($id) == 0){

            /* 组装添加记录的sql查询语句 */
            $sql = "insert into lanmu (`pid`,`title`,`url`,`content`,`danye`) values ('%d','%s','%s','%s','%d')";

            /* 这里因为pid是整数类型，在这用intval()函数转换成整数 */
            $sql = sprintf($sql, intval($pid), $title, $url, $content, $danye);

            /* 执行sql */
            $result = $db_obj->query($sql);
        }
        else{
            /* 修改时如果上级栏目pid 如果和 id相等，返回*/
            if(intval($id) == intval($pid)){
                $rt_data['msg'] = '上级栏目和当前栏目id不能相等';
                $rt_data['code'] = 0;
                $rt_data['url'] = '';
                return $rt_data;
            }

            /* 组装修改记录的sql查询语句 */
            $sql = "update lanmu set `pid`= '%d',`title`='%s',`url`='%s',`content`='%s',`danye`='%d' where id = '%d'";

            /* 这里因为pid和id都是整数类型，在这用intval()函数转换成整数 */
            $sql = sprintf($sql, intval($pid), $title, $url, $content, $danye, intval($id));

            /* 执行sql */
            $result = $db_obj->query($sql);
        }
        /* 返回結果 */
        return $rt_data;
    }

    /**
     * 取顶级栏目数据
     */
    public function get_top_lanmu(){
        /* 实例化取数据库操作对象 */
        $db_obj = ConnectMysqli::getIntance();

        /* 组装sql查询语句，查所有最顶级栏目 */
        $sql = "select id,pid,title,danye,url from lanmu where pid = 0 order by id";

        /* 执行sql，返回记录 */
        return $db_obj->getAll($sql);
    }

    /**
     * 取非顶级栏目数据，即二级栏目
     */
    public function get_erji_lanmu(){
        /* 实例化取数据库操作对象 */
        $db_obj = ConnectMysqli::getIntance();

        /* 组装sql查询语句，查所有二级栏目，pid>0 的 */
        $sql = "select id,pid,title,danye,url from lanmu where pid > 0 order by id";

        /* 执行sql，返回记录 */
        return $db_obj->getAll($sql);
    }

    /**
     * 取栏目列表数据，用于在栏目管理页面显示栏目列表数据
     */
    public function get_lanmu_list(){

        /* 定义顶级与二级栏目关系数组 */
        $erji_data  = array();

        /* 取顶级栏目 */
        $top_lanmu = $this->get_top_lanmu();

        /* 取二级栏目 */
        $erji_lanmu = $this->get_erji_lanmu();

        /* 组织顶级和二级栏目对应数据结构 */
        foreach ($erji_lanmu as $val){
            if(!isset($erji_data[$val['pid']])){
                $erji_data[$val['pid']] = array();
            }
            $erji_data[$val['pid']][] = $val;
        }

        /* 返回 */
        return array(
            'top_lanmu' => $top_lanmu,
            'erji_data' => $erji_data
        );
    }

    /**
     * 取编辑栏目时下拉选择表单的html
     * @param $id
     * @return string
     */
    public function get_lanmu_option($pid=''){

        /* 要返回的html字串 */
        $html_str = '';

        /* 取回顶级栏目数据 */
        $list = $this->get_top_lanmu();

        /* 遍历所有顶级栏目 */
        foreach ($list as $v) {
            /* 如果是单页面，跳过 */
            if($v['danye']) {
                continue;
            }
            /* 如果是修改栏目，默认选中当前的父级栏目 */
            if ($pid == $v['id']) {
                $html_str .= '<option level="1" value="' . $v['id'] . '" selected>' . $v['title'] . '</option>';
            } else {
                $html_str .= '<option level="1" value="' . $v['id'] . '">' . $v['title'] . '</option>';
            }
        }

        return $html_str;
    }

    /**
     * 通过id取栏目表的一条记录
     * @param $id
     * @return mixed
     */
    public function get_lanmu_data($id){
        /* 实例化取数据库操作对象 */
        $db_obj = ConnectMysqli::getIntance();

        /* 组装sql查询语句 */
        $sql = "select id,pid,title,url,danye,content from lanmu where id = '%d'";
        $sql = sprintf($sql,$id);

        /* 执行sql，返回一行记录 */
        return $db_obj->getRow($sql);
    }

    /**
     * 删除栏目
     * @param $id
     * @return mixed
     */
    public function lanmu_del($id){
        /* 实例化取数据库操作对象 */
        $db_obj = ConnectMysqli::getIntance();

        /* 组装sql查询语句，查所有二级栏目，pid>0 的 */
        $sql = "delete from lanmu where id = '%d'";
        $sql = sprintf($sql,$id);

        /* 执行sql，删除一行记录 */
        return $db_obj->query($sql);
    }
}
