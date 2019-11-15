<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
 class DemoController
 {
     public function index()
     {
             echo 'hello world';
     }
 }
 class DemoController
 {
     private $data = 'hello world in view';

     public function index()
     {
             //echo 'hello world';
             require('view/index.php');
             $view = new Index();
             $view->display($data);
     }
 } 
 class DemoController
 {
     // private $data = 'hello world in view';
     function index($param)
     {
             // echo 'hello world';
             require('view/index.php');
             require('model/model.php');
             $model = new Model();
             $view = new Index();
             $data = $model->getData($param);
             $view->display($data);
     }
 }
</body>
</html>
