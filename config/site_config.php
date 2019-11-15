<?php
/**
 * 公共配置文件
 */

class site_config
{
    public static function get($key){
        /* 全部配置内容 */
        $config = array(

            /* 首页幻灯数据 */
            'banner_data' => array(
                array('img'=>'images/1.jpg','title'=>'爱设计，也是生活的一部分','href'=>'/'),
                array('img'=>'images/2.jpg','title'=>'网页中图片属性固定宽度，如何用js改变大小','href'=>'/'),
                array('img'=>'images/3.jpg','title'=>'个人博客，属于我的小世界！','href'=>'/'),
				array('img'=>'images/4.jpg','title'=>'青春是最好的资本，不要去浪费！','href'=>'/'),
            ),

            /* 侧边栏博主数据 */
            'user_data' => array(
                'img' => 'images/4.jpg',
                'txt' => '非常喜欢web前端技术，一边学习一边积累经验，分享一些个人博客模板，以及前端框架的使用心得。',
                'erweima_img' => 'images/wx.jpg',
            ),

            /* 关键词数据 */
            'gjc_data' => array(
                'title' => '我的个人博客 - 一个站在web前端设计之路的技术员个人博客网站',
                'keywords' => '个人博客,我的个人博客,个人博客模板',
                'description' => '我的个人博客，是一个站在web前端设计之路的程序员个人网站，提供个人博客模板免费资源下载的个人原创网站',
            ),
        );

        /* 判断如果配置项存在返回对应值，否则返回null */
        if(isset($config[$key])){
            return $config[$key];
        }else{
            return null;
        }
    }
}

?>