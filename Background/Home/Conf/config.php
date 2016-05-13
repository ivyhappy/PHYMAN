<?php
return array(
	//'配置项'=>'配置值'
	
    
    'TMPL_TEMPLATE_SUFFIX'=>'.html',
    // 添加数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'phyman', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'phyman_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    define('__DIRNAME__','/PHYMAN/Background/Home/contents/'),
    define('__DIRART__',$_SERVER['DOCUMENT_ROOT'].__DIRNAME__),
    define('__PREFIX__',"phyman_"),
    //关于路径问题：http://www.phpddt.com/php/get-path.html
    
    
);