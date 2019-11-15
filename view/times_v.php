<?php

 /* 博客时间轴页面视图类 times_v.php */

 class times_v {
 
     /* 包含并显示博客时间轴页面模板 */
     public function display($view_data) {
		 require('tpl_home/times_tpl.php');
     }	 
 }
 
?>