<?php
/**
 * 后台管理.文章编辑页面视图类
 */
class admin_wenzhang_edit_v {
    /**
     * 显示模板方法
     */
    public function display($view_data) {
        /* $view_data 数据在模板文件中调用 */

        /* 包含并显示后台管理文章编辑页面模板 */
        require('tpl_admin/admin_wenzhang_edit_tpl.php');
    }
}
?>