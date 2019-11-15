


<!doctype html>
<html>
    <head>
        <?php require 'tpl_home/inc/head_tpl.php';?>     
        <link href="css/index.css" rel="stylesheet">
    </head>
    <body>
        <?php require 'tpl_home/inc/nav_tpl.php';?>
        <article> 
          <!--banner begin-->
          <div class="banner">
            <div id="banner" class="fader">

              <?php foreach($view_data['banner_data'] as $item) { ?>
                      <li class="slide" ><a href="<?php echo $item['href'];?>" target="_blank"><img src="<?php echo $item['img'];?>"><span class="imginfo"><?php echo $item['title'];?></span></a></li>
              <?php }?>

              <div class="fader_controls">
                <div class="page prev" data-target="prev">&lsaquo;</div>
                <div class="page next" data-target="next">&rsaquo;</div>
                <ul class="pager_list"></ul>
              </div>
            </div>
          </div>
          <!--banner end-->
            <?php
            /* 定义开始和结束下标 */
            $for_i = 0;
            $end_i = count($view_data['tuijian_data']);
            $tj_wenzhang = $view_data['tuijian_data'];
            ?>
          <div class="toppic">
              <?php if($end_i > 1){   ?>
                <?php for($i=0;$i<2;$i++){   ?>
                    <li> <a href="index.php?c=home&a=info&id=<?php echo $tj_wenzhang[$for_i]['id']?>" target="_blank"> <i><img src="<?php echo $tj_wenzhang[$for_i]['tupian']?>"></i>
                        <h2><?php echo $tj_wenzhang[$for_i]['biaoti']?></h2>
                        <span><?php echo $tj_wenzhang[$for_i]['lanmu_biaoti']?></span> </a> </li>
                    <?php $for_i++; ?>
                <?php }?>
              <?php }?>
          </div>
          <main>
          <div class="news_box">
            <ul><!-- 因为这里显示4个，前面2个，所以至少要有6个，也就是大于5 -->
                <?php if($end_i > 5){   ?>
                    <?php for($i=0;$i<4;$i++){   ?>
                        <li>
                            <i>
                                <a href="index.php?c=home&a=info&id=<?php echo $tj_wenzhang[$for_i]['id']?>" target="_blank">
                                    <img src="<?php echo $tj_wenzhang[$for_i]['tupian']?>">
                                </a>
                            </i>
                            <h3>
                                <a href="index.php?c=home&a=info&id=<?php echo $tj_wenzhang[$for_i]['id']?>" target="_blank">
                                    <?php echo $tj_wenzhang[$for_i]['biaoti']?>
                                </a>
                            </h3>
                        </li>
                        <?php $for_i++; ?>
                    <?php }?>
                <?php }?>
            </ul>
          </div>
          <div class="pics">
            <ul><!-- 因为这里显示3个，前面共6个，所以至少要有9个，也就是大于8 -->
                <?php if($end_i > 8){   ?>
                    <?php for($i=0;$i<3;$i++){   ?>
                        <li><i>
                                <a href="index.php?c=home&a=info&id=<?php echo $tj_wenzhang[$for_i]['id']?>" target="_blank">
                                    <img src="<?php echo $tj_wenzhang[$for_i]['tupian']?>">
                                </a>
                            </i>
                            <span><?php echo $tj_wenzhang[$for_i]['biaoti']?></span>
                        </li>
                        <?php $for_i++; ?>
                    <?php }?>
                <?php }?>
            </ul>
          </div>

          <div class="blogtab">
              <!-- 显示剩下的首页推荐文章 -->
              <?php for($i=$for_i;$i<$end_i;$i++){   ?>
                  <?php $href = 'index.php?c=home&a=info&id='.$tj_wenzhang[$for_i]['id']; ?>
                  <div class="blogs">
                      <h3 class="blogtitle"><a href="<?php echo $href?>" target="_blank"><?php echo $tj_wenzhang[$for_i]['biaoti']?></a></h3>
                      <!-- 有图片的 -->
                      <?php if(!empty($tj_wenzhang[$for_i]['tupian'])){   ?>
                          <span class="blogpic"><a href="<?php echo $href?>" title="<?php echo $tj_wenzhang[$for_i]['biaoti']?>"><img src="<?php echo $tj_wenzhang[$for_i]['tupian']?>" alt=""></a></span>
                      <?php }?>
                      <p class="blogtext"> <?php echo $tj_wenzhang[$for_i]['jianjie']?></p>
                      <div class="bloginfo">
                          <ul>
                              <li class="author"><?php echo $tj_wenzhang[$for_i]['zuozhe']?></li>
                              <li class="lmname"><?php echo $tj_wenzhang[$for_i]['lanmu_biaoti']?></li>
                              <li class="timer"><?php echo $tj_wenzhang[$for_i]['shijian']?></li>
                              <li class="view"><span><?php echo $tj_wenzhang[$for_i]['dianji']?></span>已阅读</li>
                          </ul>
                      </div>
                  </div>

                  <?php $for_i++; ?>
              <?php }?>

              <?php if(0){?>
              <!--多图方式，可按需要自己添加功能实现-->
            <!--
            <div class="blogs" >
              <h3 class="blogtitle"><a href="info.html" target="_blank">别让这些闹心的套路，毁了你的网页设计!</a></h3>
              <span class="bplist"><a href="info.html" title="">
              <li><img src="images/2.jpg" alt=""></li>
              <li><img src="images/3.jpg" alt=""></li>
              <li><img src="images/4.jpg" alt=""></li>
              </a></span>
              <p class="blogtext">如图，要实现上图效果，我采用如下方法：1、首先在数据库模型，增加字段，分别是图片2，图片3。2、增加标签模板，用if，else if 来判断，输出。思路已打开，样式调用就可以多样化啦！... </p>
              <div class="bloginfo">
                <ul>
                  <li class="author"><a href="/">杨青</a></li>
                  <li class="lmname"><a href="/">学无止境</a></li>
                  <li class="timer">2018-5-13</li>
                  <li class="view"><span>34567</span>已阅读</li>
                  <li class="like">9999</li>
                </ul>
              </div>
            </div>
            -->
              <!--大图方式，可按需要自己添加功能实现-->
              <!--<div class="blogs" >
               <h3 class="blogtitle"><a href="/" target="_blank">别让这些闹心的套路，毁了你的网页设计!</a></h3>
               <span class="bigpic"><a href="/" title=""><img src="images/5.jpg" alt=""></a></span>
               <p class="blogtext">如图，要实现上图效果，我采用如下方法：1、首先在数据库模型，增加字段，分别是图片2，图片3。2、增加标签模板，用if，else if 来判断，输出。思路已打开，样式调用就可以多样化啦！... </p>
               <div class="bloginfo">
                 <ul>
                   <li class="author"><a href="/">杨青</a></li>
                   <li class="lmname"><a href="/">学无止境</a></li>
                   <li class="timer">2018-5-13</li>
                   <li class="view"><span>34567</span>已阅读</li>
                   <li class="like">9999</li>
                 </ul>
               </div>
             </div>-->
              <?php }?>
        </div>
          </main>
            <?php require 'tpl_home/inc/aside_tpl.php';?>
        </article>
        <?php require 'tpl_home/inc/foot_tpl.php';?>        
    </body>
</html>
