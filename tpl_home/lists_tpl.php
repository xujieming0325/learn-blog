


<!doctype html>
<html>
    <head>
        <?php require 'tpl_home/inc/head_tpl.php';?>
        <link href="css/index.css" rel="stylesheet">
    </head>
    <body>
        <?php require 'tpl_home/inc/nav_tpl.php';?>
        <article>
          <main>
              <?php
              /* 定义开始和结束下标 */
              $for_i = 0;
              $end_i = count($view_data['lists_data']);
              $info_data = $view_data['lists_data'];
              ?>
              <?php for($i=$for_i;$i<$end_i;$i++){   ?>
                  <?php $href = 'index.php?c=home&a=info&id='.$info_data[$for_i]['id']; ?>
                  <div class="blogs">
                      <h3 class="blogtitle"><a href="<?php echo $href?>" target="_blank"><?php echo $info_data[$for_i]['biaoti']?></a></h3>
                      <!-- 有图片的 -->
                      <?php if(!empty($info_data[$for_i]['tupian'])){   ?>
                          <span class="blogpic"><a href="<?php echo $href?>" title="<?php echo $info_data[$for_i]['biaoti']?>"><img src="<?php echo $info_data[$for_i]['tupian']?>" alt=""></a></span>
                      <?php }?>
                      <p class="blogtext"> <?php echo $info_data[$for_i]['jianjie']?></p>
                      <div class="bloginfo">
                          <ul>
                              <li class="author"><?php echo $info_data[$for_i]['zuozhe']?></li>
                              <li class="lmname"><?php echo $info_data[$for_i]['lanmu_biaoti']?></li>
                              <li class="timer"><?php echo $info_data[$for_i]['shijian']?></li>
                              <li class="view"><span><?php echo $info_data[$for_i]['dianji']?></span>已阅读</li>
                          </ul>
                      </div>
                  </div>

                  <?php $for_i++; ?>
              <?php }?>

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
          </main>
            <?php require 'tpl_home/inc/aside_tpl.php';?>
        </article>
        <?php require 'tpl_home/inc/foot_tpl.php';?>
    </body>
</html>
	