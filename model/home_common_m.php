<?php
/**
 * 前台页面公共模型基类，别的模型都
 */

class home_common_m
{
    /* 定义全局视图数据数组 */
    public $view_data;

    /* 构造函数 */
    public function __construct()
    {
        $this->view_data = array(
            /* 栏目数据 */
            'lanmu_data' => $this->get_lanmu_data(),

            /* 设置全局关键词数据 */
            'gjc_data' => site_config::get('gjc_data'),

            /* 设置侧边博主数据 */
            'user_data' => site_config::get('user_data'),

            /* 侧边栏文章数据 */
            'cebian_data' => $this->get_cebian_data(),
        );
    }

    /* 取公用栏目数据 */
    public function get_lanmu_data(){

        /* 直接引用栏目模型类 */
        require "model/admin_lanmu_m.php";

        /* 实例化对象 */
        $lanmu_m = new admin_lanmu_m();

        /* 取栏目数据 */
        $lanmu_data = $lanmu_m->get_lanmu_list();

        /* 返回数据 */
        return $lanmu_data;
    }

    /* 取公用底部数据 */
    public function get_dibu_data(){
        /* 定义返回结构 */
        $dibu_data = array();

        /* 返回数据 */
        return $dibu_data;
    }

    /* 取公用侧边数据 */
    public function get_cebian_data(){
        /* 定义返回结构 */
        $cebian_data = array();

        /* 实例化取数据库操作对象 */
        $db_obj = ConnectMysqli::getIntance();

        /* 获取首页推荐数据 */
        $sql = "select wenzhang.*,lanmu.title as lanmu_biaoti from wenzhang left join lanmu on lanmu.id=wenzhang.lanmu_id where wenzhang.cebian_tuijian=1 order by wenzhang.dianji desc";

        $cebian_data = $db_obj->getAll($sql);

        /* 返回数据 */
        return $cebian_data;
    }
}