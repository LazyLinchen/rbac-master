<?php
/**
 * 安装向导
 * User: 81908
 * Date: 2017/4/24
 * Time: 15:01
 */

header('Content-Type:text/html;charset=UTF-8');
//检测是否安装过
if(file_exists('./install.lock')){
    echo '你已经安装过该系统，重新安装需要先删除./Public/install/install.lock文件';
    die();
}

//同意协议页面
if(@!isset($_GET['c']) || @$_GET['c']=='agreement'){
    require './agreement.html';
}


//检测环境页面
if(@$_GET['c'] == 'test'){
    require './test.html';
}

//创建数据库页面
if(@$_GET['c'] == 'create'){
    require './create.html';
}

//安装成功页面
if(@$_GET['c'] == 'success'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data = $_POST;
        $link = @new mysqli("{$data['DB_HOST']}:{$data['DB_PORT']}", $data['DB_USER'], $data['DB_PWD']);
        $error = $link->connect_error;
        if(!is_null($error)){
            //转义防止和alert中的引号冲突
            $error = addcslashes($error);
            die("<script>alert('数据库连接失败：$error');history.go(-);</script>");
        }
        $link->query("SET NAMES utf8");
        $link->server_info>5.0 or die("<script>alert('请将您的mysql升级到5.0以上');history.go(-1)</script>");
        if(!$link->select_db($data['DB_NAME'])){
            $create_sql = 'CREATE DATABASE IF NOT EXISTS '.$data['DB_NAME'].' DEFAULT CHARACTER SET utf8;';
            $link->query($create_sql) or die("<script>alert('创建数据库失败');history.go(-1)</script>");
            $link->select_db($data['DB_NAME']);
        }

        $rbac_str = file_get_contents('./rbac.sql');
        $sql_array = empty($_POST['OLD_PREFIX']) ? $rbac_str : preg_split("/;[\r\n]+/", str_replace($_POST['OLD_PREFIX'], $data['DB_PREFIX'], $rbac_str));
        foreach ($sql_array as $k=>$v){
            if(!empty($v)){
                $link->query($v);
            }
        }
        $link->close();
        $db_str = <<<php
<?php
//***********************数据库设置*************************
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // 数据库类型
    'type'            => 'mysql',
    // 服务器地址
    'hostname'        => '{$data['DB_HOST']}',
    // 数据库名
    'database'        => '{$data['DB_NAME']}',
    // 用户名
    'username'        => '{$data['DB_USER']}',
    // 密码
    'password'        => '{$data['DB_PWD']}',
    // 端口
    'hostport'        => '{$data['DB_PORT']}',
    // 连接dsn
    'dsn'             => '',
    // 数据库连接参数
    'params'          => [],
    // 数据库编码默认采用utf8
    'charset'         => 'utf8',
    // 数据库表前缀
    'prefix'          => '{$data['DB_PREFIX']}',
    // 数据库调试模式
    'debug'           => true,
    // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'deploy'          => 0,
    // 数据库读写是否分离 主从式有效
    'rw_separate'     => false,
    // 读写分离后 主服务器数量
    'master_num'      => 1,
    // 指定从服务器序号
    'slave_no'        => '',
    // 是否严格检查字段是否存在
    'fields_strict'   => true,
    // 数据集返回类型
    'resultset_type'  => 'array',
    // 自动写入时间戳字段
    'auto_timestamp'  => false,
    // 时间字段取出后的默认时间格式
    'datetime_format' => 'Y-m-d H:i:s',
    // 是否需要进行SQL性能分析
    'sql_explain'     => false,
];
php;
        //创建数据库连接配置文件
        $dbconf_path = '../../application/config/database.php';
        if(file_exists($dbconf_path)){
            unlink($dbconf_path);
        }
        file_put_contents($dbconf_path, $db_str);

        $auth_str = <<<php
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// error_reporting(E_ERROR | E_PARSE );
return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------

    //auth配置
    'auth'      => [
        //权限开关
        'auth_on'           => 1,
        //认证方式，1为实时认证；2为登陆验证
        'auth_type'         => 1,
        //用户组数据不带前缀表名
        'auth_group'        => 'auth_group',
        //用户-用户组关系表
        'auth_group_access' => 'auth_rule',
        //用户信息表
        'auth_user'         => 'user',
    ],

    /**
     * RBAC认证配置信息
     */
    'USER_AUTH_ON'          => true,
    'USER_AUTH_TYPE'        => 1,   //默认认证类型，1 登录认证 2 实时认证
    'USER_AUTH_KEY'         => 'authId',    //用户认证SESSION标记
    'ADMIN_AUTH_KEY'        => 'admin',
    'NOT_AUTH_MODULE'       => 'Public',//默认无需认证模块
    'REQUIRE_AUTH_MODULE'   => '',  //默认需要认证的模块
    'NOT_AUTH_ACTION'       => '',  //默认无需认证操作
    'REQUIR_AUTH_ACTION'    => '',  //默认需要认证的操作
    'GUEST_AUTH_ID'         => 0,   //游客用户ID
    'GUEST_AUTH_ON'         => false,   //是否开启游客授权访问
    'USER_AUTH_MODEL'       => '{$data['DB_PREFIX']}user',  //默认验证数据表
    'RBAC_USER_TABLE'       => '{$data['DB_PREFIX']}user_role',
    'RBAC_ROLE_TABLE'       => '{$data['DB_PREFIX']}role',  //
    'RBAC_ACCESS_TABLE'     => '{$data['DB_PREFIX']}access',
    'RBAC_NODE_TABLE'       => '{$data['DB_PREFIX']}node',
];
php;

        //创建auth认证配置文件
        $auth_path = '../../application/config/extra/auth.php';
        if(file_exists($auth_path)){
            unlink($auth_path);
        }
        file_put_contents($auth_path, $auth_str);

        @touch('./install.lock');
        require './success.html';
    }
}