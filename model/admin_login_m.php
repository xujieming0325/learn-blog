<?php
/*admin_login_m.php后台登录模型
类*/

class admin_login_m
{
    //登录逻辑处理
    public function login($username, $password){
        //先定义返回数据结构
        $rt_data = array(
            "msg" => "登录成功",
            "code" => 1,
            "url" => 'index.php?c=admin&a=lanmu',
        );

        //判断是否账号或密码为空，为空返回出错信息
        if(empty($username) || empty($password)){
            $rt_data['msg'] = '账号或密码都不能为空';
            $rt_data['code'] = 0;
            $rt_data['url'] = '';
            return $rt_data;
        }

        //实例化取数据库操作对象
        $db_obj = ConnectMysqli::getIntance();

        //密码转md5加密字串
        $password = md5($password);

        //组装sql查询语句，查登录用户表的记录
        $sql = "select * from admin_user where username='%s' and password='%s'";
        $sql = sprintf($sql, $username, $password);

        //取数据库中的一行数据
        $list = $db_obj->getRow($sql);

        //如果有数据说明登录成功，否则登录失败
        if($list){
            $this->set_login_data($list);
        }else{
            $rt_data['msg'] = '账号不存在或密码不对';
            $rt_data['code'] = 0;
            $rt_data['url'] = '';
        }

        //返回最终结果
        return $rt_data;
    }

    //设置登录成功的session数据
    private function set_login_data($login_data){
        //判断是否启动了session，有session_id说明已经启动，没有就启动一下
        if(!session_id()){
            session_start();
        }
        $_SESSION['is_login'] = 1;
        $_SESSION['login_data'] = $login_data;
        return;
    }

}