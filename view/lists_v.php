<?php

 /* 博客列表页面视图类 lists_v.php */

 class lists_v {
 
     /* 包含并显示博客列表页面模板 */
     public function display($view_data) {
		 require('tpl_home/lists_tpl.php');
     }	 
 }
 
?>