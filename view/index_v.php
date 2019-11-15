<?php
 /* 首页页面视图类 index_v.php */
 class index_v {
 
     /* 包含并显示首页页面模板 */
     public function display($view_data) {
		 require('tpl_home/index_tpl.php');
     }	 
     
 }
?>