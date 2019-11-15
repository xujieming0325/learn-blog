
<?php
 /* 首页模型类 index_m.php */

 class index_m extends home_common_m
 {
     /* 构造函数 */
     public function __construct()
     {
         /* 先运行父构造函数，设置好所有共用数据到视图数据中 */
         parent::__construct();

     }

     /* 返回视图用的数据 */
     public function get_view_data() {

         /* 设置首页幻灯片数据 */
         $this->view_data['banner_data'] = site_config::get('banner_data');

         /* 设置首页推荐数据 */
         $this->view_data['tuijian_data'] = $this->get_tuijian_data();

         return $this->view_data;
     }

     /* 取幻灯片数据 */
     public function get_banner_data() {
        $rt_data = site_config::get('banner_data');
        return $rt_data;
     }

     /* 取首页推荐数据 */
     public function get_tuijian_data() {
         /* 定义返回 */
         $rt_data = array();

         /* 实例化取数据库操作对象 */
         $db_obj = ConnectMysqli::getIntance();

         /* 获取首页推荐数据 */
         $sql = "select wenzhang.*,lanmu.title as lanmu_biaoti from wenzhang left join lanmu on lanmu.id=wenzhang.lanmu_id where wenzhang.shouye_tuijian=1 order by wenzhang.dianji desc";

         $rt_data = $db_obj->getAll($sql);
         return $rt_data;
     }


 }

?>
