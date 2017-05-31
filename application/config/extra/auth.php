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
    'USER_AUTH_MODEL'       => 'rbac1_user',  //默认验证数据表
    'RBAC_USER_TABLE'       => 'rbac1_user_role',
    'RBAC_ROLE_TABLE'       => 'rbac1_role',  //
    'RBAC_ACCESS_TABLE'     => 'rbac1_access',
    'RBAC_NODE_TABLE'       => 'rbac1_node',
];