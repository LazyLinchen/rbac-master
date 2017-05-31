<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
// 
if(version_compare(PHP_VERSION, '5.4', '<')) die("ERROR : Please require PHP > 5.4！, This PHP_VERSION is ".PHP_VERSION);

// error_reporting(3);
//检测是否新安装
if(file_exists("./install") && !file_exists("./install/install.lock")){
    $url = $_SERVER['HTTP_HOST'].trim($_SERVER['SCRIPT_NAME'], 'index.php').'install/index.php';
    header("Location:http://$url");
    exit();
}

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');

define('CONF_PATH', APP_PATH.'config/');

define('__PUBLIC__', '/blogNote/public/');

define('__STATIC__', __PUBLIC__.'static/');

define('UPLOAD_PATH', __DIR__.'/../Upload/');

define('UPLOAD_URL', '/blogNote/Upload');

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';

/*$build = include '../build.php';
\think\Build::run($build);*/


