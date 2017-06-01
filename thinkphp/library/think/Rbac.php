<?php
/**
 * Created by PhpStorm.
 * User: 11937
 * Date: 2017/3/23
 * Time: 22:19
 */

namespace think;

use Think\Db;

/**
+------------------------------------------------------------------------------
 * 基于角色的数据库方式验证类
+------------------------------------------------------------------------------
 */
// 配置文件增加设置
// USER_AUTH_ON 是否需要认证
// USER_AUTH_TYPE 认证类型
// USER_AUTH_KEY 认证识别号
// REQUIRE_AUTH_MODULE  需要认证模块
// NOT_AUTH_MODULE 无需认证模块
// USER_AUTH_GATEWAY 认证网关
// RBAC_DB_DSN  数据库连接DSN
// RBAC_ROLE_TABLE 角色表名称
// RBAC_USER_TABLE 用户表名称
// RBAC_ACCESS_TABLE 权限表名称
// RBAC_NODE_TABLE 节点表名称
/*
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `think_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `think_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `think_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `think_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `uid` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
*/
class Rbac {
    // 认证方法
    static public function authenticate($map,$model='') {
        if(empty($model)) $model =  config('auth.USER_AUTH_MODEL');
        //使用给定的Map进行认证
        return Db::name($model)->where($map)->find();
    }

    //用于检测用户权限的方法,并保存到Session中
    static function saveAccessList($authId=null) {
        if(null===$authId)   $authId = session(config('auth.USER_AUTH_KEY'));
        // 如果使用普通权限模式，保存当前用户的访问权限列表
        // 对管理员开发所有权限
        if(config('auth.USER_AUTH_TYPE') !=2 && !session(config('auth.ADMIN_AUTH_KEY'))){
            session('_ACCESS_LIST', self::getAccessList($authId));
        }
        return ;
    }

    // 取得模块的所属记录访问权限列表 返回有权限的记录ID数组
    static function getRecordAccessList($authId=null,$module='') {
        if(null===$authId)   $authId = session(config('auth.USER_AUTH_KEY'));
        if(empty($module))  $module	=	$controllerName;
        //获取权限访问列表
        $accessList = self::getModuleAccessList($authId,$module);
        return $accessList;
    }

    //检查当前操作是否需要认证
    static function checkAccess($appName='',$controllerName='',$actionName='') {
        //如果项目要求认证，并且当前模块需要认证，则进行权限认证
        if( config('auth.USER_AUTH_ON') ){
            $_module	=	array();
            $_action	=	array();
            if("" != config('auth.REQUIRE_AUTH_MODULE')) {
                //需要认证的模块
                $_module['yes'] = explode(',',strtoupper(config('auth.REQUIRE_AUTH_MODULE')));
            }else {
                //无需认证的模块
                $_module['no'] = explode(',',strtoupper(config('auth.NOT_AUTH_MODULE')));
            }
            //检查当前模块是否需要认证
            if((!empty($_module['no']) && !in_array(strtoupper($controllerName),$_module['no'])) || (!empty($_module['yes']) && in_array(strtoupper($controllerName),$_module['yes']))) {
                if("" != config('auth.REQUIRE_AUTH_ACTION')) {
                    //需要认证的操作
                    $_action['yes'] = explode(',',strtoupper(config('auth.REQUIRE_AUTH_ACTION')));
                }else {
                    //无需认证的操作
                    $_action['no'] = explode(',',strtoupper(config('auth.NOT_AUTH_ACTION')));
                }
                //检查当前操作是否需要认证
                if((!empty($_action['no']) && !in_array(strtoupper($actionName),$_action['no'])) || (!empty($_action['yes']) && in_array(strtoupper($actionName),$_action['yes']))) {
                    return true;
                }else {
                    return false;
                }
            }else {
                return false;
            }
        }
        return false;
    }

    // 登录检查
    static public function checkLogin() {
        //检查当前操作是否需要认证
        if(self::checkAccess($appName,$controllerName,$actionName)) {
            //检查认证识别号
            if(!session(config('auth.USER_AUTH_KEY'))) {
                if(config('auth.GUEST_AUTH_ON')) {
                    // 开启游客授权访问
                    if(!empty(session('_ACCESS_LIST')))
                        // 保存游客权限
                        self::saveAccessList(config('auth.GUEST_AUTH_ID'));
                }else{
                    // 禁止游客访问跳转到认证网关
                    redirect(PHP_FILE.config('auth.USER_AUTH_GATEWAY'));
                }
            }
        }
        return true;
    }

    //权限认证的过滤器方法
    static public function AccessDecision($appName='',$controllerName='',$actionName='') {
        //检查是否需要认证
        if(self::checkAccess($appName, $controllerName, $actionName)) {

            //存在认证识别号，则进行进一步的访问决策
            $accessGuid   =   md5($appName.$controllerName.$actionName);
            if(empty(session(config('auth.ADMIN_AUTH_KEY')))) {
                if(config('auth.USER_AUTH_TYPE')==2) {
                    //加强验证和即时验证模式 更加安全 后台权限修改可以即时生效
                    //通过数据库进行访问检查
                    $accessList = self::getAccessList(session(config('auth.USER_AUTH_KEY')));
                }else {
                    // 如果是管理员或者当前操作已经认证过，无需再次认证
                    if( session($accessGuid)) {
                        return true;
                    }
                    //登录验证模式，比较登录后保存的权限访问列表
                    $accessList = session('_ACCESS_LIST');
                }
                /*dump($accessList);
                halt(strtoupper($appName).'-'.strtoupper($controllerName).'-'.strtoupper($actionName));
                halt($accessList[strtoupper($appName)][strtoupper($controllerName)][strtoupper($actionName)]);*/

                //判断是否为组件化模式，如果是，验证其全模块名
                if(!isset($accessList[strtoupper($appName)][strtoupper($controllerName)][strtoupper($actionName)])) {
                    // session($accessGuid, null);
                    return false;
                }
                else {
                    session($accessGuid, true);
                }
            }else{
                //管理员无需认证
                return true;
            }
        }
        return true;
    }

    /**
    +----------------------------------------------------------
     * 取得当前认证号的所有权限列表
    +----------------------------------------------------------
     * @param integer $authId 用户ID
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     */
    static public function getAccessList($authId) {
        // Db方式权限数据
        /*$db     =   Db::getInstance(config('auth.RBAC_DB_DSN'));*/
        $table = array('role'=>config('auth.RBAC_ROLE_TABLE'),'user_role'=>config('auth.RBAC_USER_TABLE'),'access'=>config('auth.RBAC_ACCESS_TABLE'),'node'=>config('auth.RBAC_NODE_TABLE'));
        $sql    =   "select distinct node.id,node.name from ".
            $table['role']." as role,".
            $table['user_role']." as urole,".
            $table['access']." as access ,".
            $table['node']." as node ".
            "where urole.uid='{$authId}' and role.id in(urole.role_id) and access.role_id=role.id and role.status=1 and access.node_id=node.id and node.level=1 and node.status=1";
        $apps =   Db::query($sql);
        $access =  array();
        foreach($apps as $key=>$app) {
            $appId	=	$app['id'];
            $appName	 =	 $app['name'];
            // 读取项目的模块权限
            $access[strtoupper($appName)]   =  array();
            $sql    =   "select distinct node.id,node.name from ".
                $table['role']." as role,".
                $table['user_role']." as urole,".
                $table['access']." as access ,".
                $table['node']." as node ".
                "where urole.uid='{$authId}' and urole.role_id=role.id and access.role_id=role.id and role.status=1 and access.node_id=node.id and node.level=2 and node.pid={$appId} and node.status=1";
            $modules =   Db::query($sql);
            // 判断是否存在公共模块的权限
            $publicAction  = array();
            foreach($modules as $key=>$module) {
                $moduleId	 =	 $module['id'];
                $moduleName = $module['name'];
                if('PUBLIC'== strtoupper($moduleName)) {
                    $sql    =   "select distinct node.id,node.name from ".
                        $table['role']." as role,".
                        $table['user_role']." as urole,".
                        $table['access']." as access ,".
                        $table['node']." as node ".
                        "where urole.uid='{$authId}' and urole.role_id=role.id and  access.role_id=role.id and role.status=1 and access.node_id=node.id and node.level=3 and node.pid={$moduleId} and node.status=1";
                    $rs =   Db::query($sql);
                    foreach ($rs as $a){
                        $publicAction[$a['name']]	 =	 $a['id'];
                    }
                    unset($modules[$key]);
                    break;
                }
            }
            // 依次读取模块的操作权限
            foreach($modules as $key=>$module) {
                $moduleId	 =	 $module['id'];
                $moduleName = $module['name'];
                $sql    =   "select distinct node.id,node.name from ".
                    $table['role']." as role,".
                    $table['user_role']." as urole,".
                    $table['access']." as access ,".
                    $table['node']." as node ".
                    "where urole.uid='{$authId}' and urole.role_id=role.id and  access.role_id=role.id and role.status=1 and access.node_id=node.id and node.level=3 and node.pid={$moduleId} and node.status=1";
                $rs =   Db::query($sql);
                $action = array();
                foreach ($rs as $a){
                    $action[$a['name']]	 =	 $a['id'];
                }
                // 和公共模块的操作权限合并
                $action += $publicAction;
                $access[strtoupper($appName)][strtoupper($moduleName)]   =  array_change_key_case($action,CASE_UPPER);
            }
        }
        return $access;
    }

    // 读取模块所属的记录访问权限
    static public function getModuleAccessList($authId) {
        // Db方式
        $table = array('role'=>config('auth.RBAC_ROLE_TABLE'),'user_role'=>config('auth.RBAC_USER_TABLE'),'access'=>config('auth.RBAC_ACCESS_TABLE'));
        $sql    =   "select distinct access.node_id from ".
            $table['role']." as role,".
            $table['user_role']." as urole,".
            $table['access']." as access ".
            "where urole.uid='{$authId}' and urole.role_id=role.id and  access.role_id=role.id and role.status=1";
        $rs =   Db::query($sql);
        $access	=	array();
        foreach ($rs as $node){
            $access[]	=	$node['node_id'];
        }
        return $access;
    }
}