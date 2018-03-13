<?php
/*
* @Author: Sunshie
* @Date:   2014-11-04 14:33:32
* @Last Modified by:   xiechao
* @Last Modified time: 2014-11-23 22:50:10
* @param 前台配置文件
*/
return  array(
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'blog',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  't_',    // 数据库表前缀
    'DB_FIELDTYPE_CHECK'    =>  false,       // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      //
    'LOG_RECORD'            => false,

    // 'SHOW_PAGE_TRACE' => true, //调试信息，项目开发阶段推荐打开

   );
?>
