


<!doctype html>
<html>
    <head>
        <?php require 'tpl_home/inc/head_tpl.php';?>
        <link href="css/index.css" rel="stylesheet">
        <link href="css/info.css" rel="stylesheet">               
    </head>
    <body>
        <?php require 'tpl_home/inc/nav_tpl.php';?>
        <?php $d = $view_data['info_data']?>
        <article>
          <main>
          <div class="infosbox">
            <div class="newsview">
              <h3 class="news_title"><?php echo $d['biaoti']?></h3>
              <div class="bloginfo">
                <ul>
                  <li class="author">作者：<?php echo $d['zuozhe']?></li>
                  <li class="lmname"><a href="index.php?c=home&a=lists&lanmu_id=<?php echo $d['lanmu_id']?>"><?php echo $d['lanmu_biaoti']?></a></li>
                  <li class="timer">时间：<?php echo date('Y-m-d',strtotime($d['shijian']))?></li>
                  <li class="view"><?php echo $d['dianji']?>人已阅读</li>
                </ul>
              </div>
              <div class="news_about"><strong>简介</strong>
                  <?php echo $d['jianjie']?>
              </div>
              <div class="news_con">
                  <?php echo $d['neirong']?>
              </div>
            </div>

            <div class="nextinfo">
              <p>上一篇：<a href="index.php?c=home&a=info&id=<?php echo $d['shang_yi_bian']['id']?>"><?php echo $d['shang_yi_bian']['biaoti']?></a></p>
              <p>下一篇：<a href="index.php?c=home&a=info&id=<?php echo $d['xia_yi_bian']['id']?>"><?php echo $d['xia_yi_bian']['biaoti']?></a></p>
            </div>    
          </div>
          </main>
            <?php require 'tpl_home/inc/aside_tpl.php';?>
        </article>
        <?php require 'tpl_home/inc/foot_tpl.php';?>
    </body>
</html>
