<header class="header-navigation" id="header">
  <nav>
    <div class="logo"><a href="index.php?c=home&a=index">我的个人博客</a></div>
    <h2 id="mnavh"><span class="navicon"></span></h2>
    <ul id="starlist">
        <li><a href="index.php?c=home&a=index" >博客首页</a> </li>
        <?php foreach ($view_data['lanmu_data']['top_lanmu'] as $val) { ?>
            <li><a href="<?php echo $val['url'];?>&lanmu_id=<?php echo $val['id'];?>"><?php echo $val['title'];?></a>

                <?php
                $erji_data = $view_data['lanmu_data']['erji_data'];
                if(isset($erji_data[$val['id']])){
                    ?>
                <ul class="sub">
                    <?php foreach ($erji_data[$val['id']] as $val2) { ?>
                        <li><a href="<?php echo $val2['url'];?>&lanmu_id=<?php echo $val2['id'];?>"><?php echo $val2['title'];?></a></li>
                    <?php }?>
                </ul>
                <?php } ?>

            </li>
        <?php }?>
    </ul>    
  </nav>
</header>