<?php
return array(
	//'配置项'=>'配置值'
	'MODULE_ALLOW_LIST'=>array('Home','Admin'),
	// 设置默认目录
	'DEFAULT_ MODULE'=>'Admin',
	// 数据库配置
	'DB_TYPE' => 'mysql',
	'DB_HOST' => 'localhost',
	'DB_PORT' => '3306',
	'DB_USER' => 'root',
	'DB_PWD'  => 'root',
	'DB_NAME' => 'skcshop',
	'DB_PREFIX' => 'ecshop_',
	// URL模式
	'URL_MODEL' => 2,  //url重写模式
	/* 图片相关的配置 */
	'IMG_maxSize' => '3M',
	'IMG_exts' => array('jpg', 'pjpeg', 'bmp', 'gif', 'png', 'jpeg'),
	'IMG_rootPath' => './Public/Uploads/',
	/* 修改I函数底层过滤时使用的函数 */
	'DEFAULT_FILTER' => 'trim,removeXSS',

	'SHOW_PAGE_TRACE' => 'true',
);