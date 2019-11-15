
<?php
 /* 文章列表模型类 lists_m.php */

 class lists_m extends home_common_m
 {
     /* 构造函数 */
     public function __construct()
     {
         /* 先运行父构造函数，设置好所有共用数据到视图数据中 */
         parent::__construct();

     }

     /* 返回视图用的数据 */
     public function get_view_data($page_num=20) {
         /* 初始化内容 */
         $this->view_data['lists_data'] = array();

         /* 初始化总条数 */
         $this->view_data['total'] = 0;

         /* 初始化总页数 */
         $this->view_data['page_total'] = 0;

         /* 初始化当前页 */
         $this->view_data['now_page'] = 1;

         /* 接收页数 */
         $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

         if(isset($_GET['lanmu_id'])){

             /* 取栏目id*/
             $lanmu_id = intval(trim($_GET['lanmu_id']));

             /* 包含模型类文件，进行数据处理和获取 */
             require('model/admin_wenzhang_m.php');

             /* 用new创建模型类对象 */
             $model = new admin_wenzhang_m();

             /* 调用模型的方法，获取数据 */
             $wenzhang_data = $model->get_wenzhang_list($page,$page_num," wenzhang.lanmu_id=".$lanmu_id);

             /* 转换日期时间格式 */
             foreach ($wenzhang_data['data'] as $key=>$val){
                 $wenzhang_data['data'][$key]['shijian'] = date('Y-m-d',strtotime($val['shijian']));
             }

             /* 设置栏目数据 */
             $this->view_data['lists_data'] = $wenzhang_data['data'];

             /* 总条数 */
             $this->view_data['total'] = $wenzhang_data['count'];

             /* 总页数 */
             $this->view_data['page_total'] = $wenzhang_data['page_total'];

             /* 当前页 */
             $this->view_data['now_page'] = $page;
         }
         return $this->view_data;
     }
 }
?>
