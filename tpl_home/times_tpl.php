


<!doctype html>
<html>
    <head>
        <?php require 'tpl_home/inc/head_tpl.php';?>
        <link href="css/time.css" rel="stylesheet">   
    </head>
    <body>
        <?php require 'tpl_home/inc/nav_tpl.php';?>
        <article>
          <div class="timebox">
            <ul>
                <?php
                /* 定义开始和结束下标 */
                $for_i = 0;
                $end_i = count($view_data['lists_data']);
                $times_data = $view_data['lists_data'];
                ?>
                <?php for($for_i;$for_i<$end_i;$for_i++){   ?>
                    <li>
                        <span><?php echo $times_data[$for_i]['shijian']?></span>
                        <i><a href="index.php?c=home&a=info&id=<?php echo $times_data[$for_i]['id']?>" target="_blank"><?php echo $times_data[$for_i]['biaoti']?></a></i>
                    </li>
                <?php }?>
          </div>
          <div class="pagelist">
              <a title="Total record">&nbsp;<b><?php echo $view_data['total']?></b> </a>&nbsp;&nbsp;&nbsp;
              <?php for($i=1;$i<=$view_data['page_total'];$i++){   ?>
                  <?php if($i == $view_data['now_page']){ ?>
                      <b><?php echo $i?></b>
                  <?php }else{ $i?>
                      <a href="index.php?c=home&a=times&lanmu_id=<?php echo trim($_GET['lanmu_id'])?>&page=<?php echo $i?>"><?php echo $i?> </a>
                  <?php }?>
                  &nbsp;
              <?php }?>
          </div>
        </article>
        <?php require 'tpl_home/inc/foot_tpl.php';?>
    </body>
</html>
