<?php
return array(
	//'配置项'=>'配置值'
	'APP_GROUP_LIST'       => 'Home,cnadmin',  // 项目分组设定
	'DEFAULT_GROUP'        => 'Home',        // 默认分组
	'APP_GROUP_MODE'       => 1,             // 定义新版3.13独立分组
	'APP_GROUP_PATH'       => 'Modules',     // 定义独立分组根文件夹
	'URL_MODEL'            => 1,             // REWRITE模式,该URL模式和PATHINFO模式功能一样，除了可以不需要在URL里面写入口文件，和可以定义.htaccess文件
	'TOKEN_ON'             => true,          // 开启表单令牌
	'TOKEN_NAME'           => '__hash__',    // 表单令牌验证的表单隐藏字段名称
	'DB_TYPE'              => 'mysql',       // 数据库类型
	'DB_HOST'              => 'localhost',   // 服务器地址
	'DB_NAME'              => 'qili',      // 数据库名
	'DB_USER'              => 'qili',        // 用户名
	'DB_PWD'               => 'Aa12345',            // 密码
	'DB_PORT'              => 3306,          // 数据库端口
	'DB_PREFIX'            => 'my_',         // 数据库表前缀
	'DB_BACKUP'            => 'Data/backup', // 数据库备份目录
	'LOAD_EXT_CONFIG'      => 'set',         // 自动加载网站基本配置文件
	'RBAC_ROLE_TABLE'      => 'my_role',     // 用户分组表
	'RBAC_USER_TABLE'      => 'my_user',     // 用户表
	'RBAC_ACCESS_TABLE'    => 'my_access',   // 各个操作和用户组的对应
	'RBAC_NODE_TABLE'      => 'my_node',     // 操作节点
	'URL_CASE_INSENSITIVE' => true,          // URL不区分大小写
	'URL_404_REDIRECT'     => '/404.html',    // 定义404错误页面，调试模式下无效
	'URL_ROUTER_ON'        => true,          // 开启路由功能
	'URL_ROUTE_RULES'      => array(
		'/^vip-membership$/'          => 'Vip/index?id=1',  // VIP申请	
		'/^cnadmin$/'                 => 'Cnadmin/Public/login', // 后台首页
	),    	
);
