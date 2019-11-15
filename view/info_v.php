<?php

 /* 博客日记页面视图类 info_v.php */

 class info_v {
 
     /* 包含并显示博客日记页面模板 */
     public function display($view_data) {
		 require('tpl_home/info_tpl.php');
     }	 
 }
 
?>