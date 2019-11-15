

<?php
 /* 关于我模型类 about_m.php */

 class about_m extends home_common_m
 {
     /* 构造函数 */
     public function __construct()
     {
         /* 先运行父构造函数，设置好所有共用数据到视图数据中 */
         parent::__construct();

     }

     /* 返回视图用的数据 */
     public function get_view_data() {
         /* 初始化内容 */
         $this->view_data['about_content'] = '';

         if(isset($_GET['lanmu_id'])){
             /* 取栏目id*/
             $lanmu_id = intval(trim($_GET['lanmu_id']));

             /* 实例化取数据库操作对象 */
             $db_obj = ConnectMysqli::getIntance();

             /* 取栏目的数据 */
             $sql = "select content from lanmu where id = ".$lanmu_id;
             $data = $db_obj->getRow($sql);

             /* 设置栏目数据 */
             $this->view_data['about_content'] = $data['content'];

         }
         return $this->view_data;
     }

 }

?>
