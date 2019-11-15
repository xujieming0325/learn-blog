
<?php
/* 入口文件  /index.php */

/* 包含公用类库 */
 require('lib/mysqli_lib.php');

/* 包含公用配置文件 */
require('config/site_config.php');

/* 取得参数中的c */
 $c_str = isset($_GET['c']) ? trim($_GET['c']) : 'home';

/* 通过c得到完整的控制名称 */
 $c_name = $c_str.'_c';

/* 组装控制器类的路径 */
 $c_path = 'controller/'.$c_name.'.php';

/* 包含控制器类文件 */
 require($c_path);

/* 实例化类 */
 $controller = new $c_name;

/* 取当前操作方法 */
 $method = isset($_GET['a']) ? trim($_GET['a']) : 'index';

/* 运行类的方法 */
 $controller->$method();

 ?>
