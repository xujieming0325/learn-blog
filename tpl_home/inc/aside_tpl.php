<aside class="r_box" >
    <div class="about_me">
        <h2>博主简介</h2>
        <ul>
            <i><img src="<?php echo $view_data['user_data']['img']?>"></i>
            <p>
                <?php echo $view_data['user_data']['txt']?>
            </p>
        </ul>
    </div>
    <?php
    /* 定义开始和结束下标 */
    $for_i = 0;
    $end_i = count($view_data['cebian_data']);
    $cebian_data = $view_data['cebian_data'];
    ?>
    <div class="wdxc">
        <h2>图片精选</h2>
        <ul>
            <?php if($end_i > 5){   ?>
                <?php for($i=0;$i<6;$i++){   ?>
                    <li>
                        <a href="index.php?c=home&a=info&id=<?php echo $cebian_data[$for_i]['id']?>" target="_blank">
                            <img src="<?php echo $cebian_data[$for_i]['tupian']?>">
                        </a>
                    </li>
                    <?php $for_i++; ?>
                <?php }?>
            <?php }?>
        </ul>

    </div>

    <div class="tuijian">
        <h2>站长推荐</h2>
        <div id="content">
            <ul style="display:block;">
                <!-- 除去前面6个图的，这里最多显示8个 -->
                <?php for($i=$for_i;$i<$end_i;$i++){   ?>
                    <li>
                        <a href="index.php?c=home&a=info&id=<?php echo $cebian_data[$for_i]['id']?>" target="_blank">
                            <?php echo $cebian_data[$for_i]['biaoti']?>
                        </a>
                    </li>
                    <?php $for_i++; ?>
                <?php }?>
            </ul>
        </div>

    </div>
    <div class="guanzhu">
        <h2>关注我 么么哒</h2>
        <ul>
            <img src="<?php echo $view_data['user_data']['erweima_img']?>">
        </ul>
    </div>
    <div class="fenlei" style="display: none">
        <h2>文章分类</h2>
        <ul>
            <?php foreach ($view_data['lanmu_data']['top_lanmu'] as $val) { ?>
                <li><a href="<?php echo $val['url'];?>&lanmu_id=<?php echo $val['id'];?>"><?php echo $val['title'];?></li>
            <?php }?>
        </ul>
    </div>
</aside>