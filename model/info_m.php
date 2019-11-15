
<?php
 /* 文章详细模型类 info_m.php */

 class info_m extends home_common_m
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
         $this->view_data['info_data'] = array();

         if(isset($_GET['id'])){

             /* 取文章id*/
             $id = intval(trim($_GET['id']));

             /* 包含模型类文件，进行数据处理和获取 */
             require('model/admin_wenzhang_m.php');

             /* 用new创建模型类对象 */
             $model = new admin_wenzhang_m();

             /* 调用模型的方法，获取数据 */
             $info_data = $model->get_wenzhang_data($id);

             $info_data['shang_yi_bian'] = $this->get_shang_yi_bian($id);
             $info_data['xia_yi_bian'] = $this->get_xia_yi_bian($id);

             /* 设置数据 */
             $this->view_data['info_data'] = $info_data;

             /* 增加阅读数 */
             $this->add_dianji($id);

             /* 改变关键词标题 */
             $this->view_data['gjc_data']['title'] = $info_data['biaoti'];

         }
         return $this->view_data;
     }

     /* 增加阅读数 */
     public function add_dianji($id){
         /* 实例化取数据库操作对象 */
         $db_obj = ConnectMysqli::getIntance();

         /* 组装sql查询语句 */
         $sql = "update wenzhang set dianji=dianji + 1 where id = ".$id;

         /* 执行sql，返回一行记录 */
         return $db_obj->query($sql);
     }

     /* 取上一篇 */
     public function get_shang_yi_bian($id){
         /* 实例化取数据库操作对象 */
         $db_obj = ConnectMysqli::getIntance();

         /* 组装sql查询语句 */
         $sql = "select * from wenzhang where id < ".$id." order by id desc limit 1";

         /* 执行sql，返回一行记录 */
         return $db_obj->getRow($sql);
     }

     /* 取下一篇 */
     public function get_xia_yi_bian($id){
         /* 实例化取数据库操作对象 */
         $db_obj = ConnectMysqli::getIntance();

         /* 组装sql查询语句 */
         $sql = "select * from wenzhang where id > ".$id." order by id asc limit 1";

         /* 执行sql，返回一行记录 */
         return $db_obj->getRow($sql);
     }
 }
?>
