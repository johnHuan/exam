<?php
return array(
	//'配置项'=>'配置值'
    //'配置项'=>'配置值'
    //启用路由
    'URL_ROUTER_ON'=>false,
    'URL_MODEL' => '2',

    // 添加下面一行定义即可
    'app_begin' => array('Behavior\CheckLang'),


    'LANG_SWITCH_ON' => true,   // 开启语言包功能

    'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST'        => 'en', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE'     => 'l', // 默认语言切换变量

    //url可以不区分大小写
    'URL_CASE_INSENSITIVE'=>true,

    //thinkphp页面调试工具
    'SHOW_PAGE_TRACE'=>true,

    //2、PDO专用定义
    'DB_TYPE'=>'pdo',           //数据库类型
    'DB_USER'=>'root',          //用户名
    'DB_PWD'=>'',       //密码
    'DB_PREFIX'=>'john_',       //数据库表前缀
    'DB_DSN'=>'mysql:host=127.0.0.1;dbname=examination;charset=utf8',


    //修改视图目录
    'DEFAULT_V_LAYER' => 'View',
    // 允许访问的模块列表
    'MODULE_ALLOW_LIST'=>array('Home', 'Admin'),
    'DEFAULT_MODULE'=>'Home',

);
