<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Config;
use app\common\model\User;
use app\common\model\Menu;
// 应用公共文件

function user_md5($str, $auth_key = ''){
    $auth_key = !empty($auth_key) ? $auth_key : Config::get('auth.AUTH_KEY');
    return '' === $str ? '' : md5(sha1($str) . $auth_key);
}

function is_login(){
    $user = New User;
    return $user->isLogin();
}

function loginAddr(){
    $getIp=$_SERVER["REMOTE_ADDR"];
    $content = file_get_contents("http://api.map.baidu.com/location/ip?ak=7IZ6fgGEGohCrRKUE9Rj4TSQ&ip={$getIp}&coor=bd09ll");
    $json = json_decode($content);
    p($json);
    print $json->{'content'}->{'address'};//按层级关系提取address数据
}

function nowDate(){
    return date("Y-m-d H:i:s", time());
}

function statusTxt($key = '', $arr = array()){
    $arr = !empty($arr) ? $arr : array('1'=>'启用', '0'=>'禁用', '10'=>'删除');
    return $arr[$key];
}


/**
 * RBAC权限认证
 * @param string $url 分组/控制器/操作
 * @param array $html $html需要输出的模板
 * @author mo
 */
function check_rbac($url='',$html='', $module = '', $controller = '', $action = '')
{
    $url = explode('/', $url);
    if(empty($url[0])) unset($url[0]);
    switch (count($url)) {
        case 3:
            $appName        =$url[1];
            $controllerName =$url[2];
            $actionName     =$url[3];
            break;
        case 2:
            $appName        =$module;
            $controllerName =$url[1];
            $actionName     =$url[0];
            break;
        case 1:
            $appName        =$module;
            $controllerName =$controller;
            $actionName     =$url[0];
            break;
        default :
            $appName        =$module;
            $controllerName =$controller;
            $actionName     =$action;
            break;
    }

    if(! \think\Rbac::AccessDecision($module,$controller,$action)){
        if (empty($html))  return false;    //普通认证
    }else{
        if (!empty($html)){
            echo $html;  //模板认证
        }else{
            return true;
        }
    }
}

function get_menu(){
    $map['status'] = array('eq', 1);
    $node = session('node');
    if(session(config('auth.ADMIN_AUTH_KEY'))!==1){
        $elment = db('menu')->field('id, pid, title, url, icon, node_id')->order('sort asc')->where($map)->select();
        foreach ($elment as $k => $v) {
            // continue;
            if(!in_array($v['node_id'], $node)){
                // dump($v['node_id']);
                $second_map['status'] = 1;
                $second_map['pid']  = $v['id'];
                //找出子元素
                $son = db('menu')->where($second_map)->order('sort asc')->select();
                foreach ($son as $key => $val) {
                    //如果子元素没有权限，判断是否含有权限的孙元素
                    if(!in_array($val['node_id'], $node)){
                        $third_map['status'] = 1;
                        $third_map['pid'] = $val['id'];
                        !empty($node) && $third_map['node_id'] = array('in', $node);
                        $grandson = db('menu')->where($third_map)->order('sort asc')->find();
                        if($grandson){
                            $elment[$k]['url'] = $grandson['url'];
                            $right = true;
                            break;
                        }
                        $grandson = "";
                    }else{
                        $elment[$k]['url'] = $val['url'];
                        $right = true;
                        break;
                    }
                }
                if(!$right){
                    unset($elment[$k]);
                }

                $right = "";
            }
        }
    }else{
        $elment = db('menu')->field('id, pid, title, url, icon, node_id')->order('sort asc')->where($map)->select();
    }

    $tree = new \think\Tree();
    $all_admin_menu_list = $tree->list_to_tree($elment);

    //设置数组key为菜单ID
    foreach ($all_admin_menu_list as $key => $value) {
        $all_menu_list[$value['id']] = $value;
    }

    $request = request();

    $menu = new Menu();
    $current_menu = $menu->getCurrentMenu($request->module(), $request->controller(), $request->action());

    // halt($current_menu);

    if($current_menu){
        $parent_menu = $menu->getParentMenu($current_menu);
        foreach ($parent_menu as $key => $value) {
            $parent_menu_id[] = $value['id'];
        }

        $side_menu_list = $all_menu_list[$parent_menu[0]['id']]['_child'];
    }

    return array(
        'all_menu_list'     =>  $all_menu_list,
        'side_menu_list'    =>  $side_menu_list,
        'parent_menu'       =>  $parent_menu,
        'parent_menu_id'    =>  $parent_menu_id,
        'current_rootmenu'  =>  $parent_menu[0]['id']
    );
}

function img_upload($file){
    $info = $file->validate(['size'=>5242880, 'ext'=>'jpg,png,gif'])->move(UPLOAD_PATH.DS.'image');
    $return_info = array();
    if($info){
        $file_path = ROOT_PATH. 'Upload'.DS.'image/'.$info->getSaveName();
        img_thumb($file_path);
        $return_info['status'] = 1;
        $return_info['saveName'] = UPLOAD_URL.DS.'image/'.$info->getSaveName();
    }else{
        $return_info['status'] = 0;
        $return_info['error_msg'] = $file->getError();;
    }
    return $return_info;
}

function img_thumb($file_path){
    $image = \think\Image::open($file_path);
    $image->thumb(150,150)->save($file_path);
}

function userId(){
    if(session('admin')=='1'){
        return session('admin_info.id');
    }else{
        return session('user_info.id');
    }
}
