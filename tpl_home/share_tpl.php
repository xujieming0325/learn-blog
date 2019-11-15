


<!doctype html>
<html>
    <head>
        <?php require 'tpl_home/inc/head_tpl.php';?>  
        <link href="css/share.css" rel="stylesheet">
    </head>
    <body>
        <?php require 'tpl_home/inc/nav_tpl.php';?>
        <?php
        /* 定义开始和结束下标 */
        $for_i = 0;
        $end_i = count($view_data['share_data']);
        $share_data = $view_data['share_data'];
        ?>
        <article>
          <div class="topbox">
            <ul>
                <?php if($end_i > 5){   ?>
                    <?php for($i=0;$i<4;$i++){   ?>
                        <li>
                            <i>
                                <a href="index.php?c=home&a=info&id=<?php echo $share_data[$for_i]['id']?>" target="_blank">
                                    <span class="tnum"><?php echo $i+1;?></span>
                                    <span class="tpic">
                                        <img src="<?php echo $share_data[$for_i]['tupian']?>">
                                    </span>
                                    <span class="toptext"><?php echo $share_data[$for_i]['biaoti']?></span>
                                </a>
                            </i>
                        </li>
                        <?php $for_i++; ?>
                    <?php }?>
                <?php }?>
            </ul>
          </div>

          <div class="mbans" >
            <div class="mban"  style="display: block;" name="top1">
              <ul>
                  <!-- 除去前面的 -->
                  <?php for($i=$for_i;$i<$end_i;$i++){   ?>
                      <li>
                          <i>
                              <a href="index.php?c=home&a=info&id=<?php echo $share_data[$for_i]['id']?>" target="_blank">
                                  <span class="tnum"><?php echo $share_data[$for_i]['lanmu_biaoti']?></span>
                                  <img src="<?php echo $share_data[$for_i]['tupian']?>">
                                  <span class="mbtitle"><?php echo $share_data[$for_i]['biaoti']?></span>
                              </a>
                          </i>
                      </li>
                      <?php $for_i++; ?>
                  <?php }?>
              </ul>
            </div>
        </article>
        <?php require 'tpl_home/inc/foot_tpl.php';?>
    </body>
</html>
