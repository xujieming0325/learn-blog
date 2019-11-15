<?php

 /* 关于我页面视图类 about_v.php */

 class about_v {
 
     /* 包含并显示关于我页面模板 */
     public function display($view_data) {
		 require('tpl_home/about_tpl.php');
     }	 
 }
 
?>