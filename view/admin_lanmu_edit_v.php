<?php
/**
 * 后台管理.栏目编辑页面视图类 admin_lanmu_edit_v.php
 */
class admin_lanmu_edit_v {
    /**
     * 显示模板方法
     */
    public function display($view_data) {
        /* $view_data 数据在模板文件中调用 */

        /* 包含并显示后台管理栏目页面模板 */
        require('tpl_admin/admin_lanmu_edit_tpl.php');
    }
}
?>