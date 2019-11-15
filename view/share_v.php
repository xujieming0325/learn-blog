<?php

/* 相册分享页面视图类 share_v.php */

class share_v {

    /* 包含并显示相册分享页面模板 */
    public function display($view_data) {
        require('tpl_home/share_tpl.php');
    }
}

?>
