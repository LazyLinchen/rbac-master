<?php
namespace app\admin\controller;
use app\common\controller\Base;

class Common extends Base
{
    function _initialize(){
        parent::_initialize();
        if(!is_login()){
            $this->redirect('admin/Pub/login');
        }
//        halt($this->request()->session());
        //检测权限
        if(($this->controller()!='Index' || $this->action()!='index') && !check_rbac($this->request()->url(),'', $this->module(), $this->controller(), $this->action())){
            if(!session(config('auth.USER_AUTH_KEY'))){
                redirect(url('Pub/login'));
            }
            if(config('RBAC_ERROR_PAGE')){
                redirect(config('RBAC_ERROR_PAGE'));
            }else{
                if(config('GUEST_AUTH_ON')) {
                    $this->assign('jumpUrl', config('USER_AUTH_GATEWAY'));
                }
                if(config('ERROR_PAGE')){
                    header("Location:".config('ERROR_PAGE'));
                    exit();
                }
                $this->error(lang('你没有该权限'));
            }
        }
        if(!$this->isPost())    $this->get_menu();
        $username = !empty(session(config('auth.ADMIN_AUTH_KEY'))) ? session('admin_info.name') : session('user_info.name');
//        halt(session('admin_info.name'));
        $this->assign(['__USERNAME__' => $username]);
    }

    function get_menu(){
//        halt($this->request()->session());
        $menu = get_menu();
        $this->assign([
            '__ALL_MENU_LIST__'     =>  $menu['all_menu_list'],
            '__SIDE_MENU_LIST__'    =>  $menu['side_menu_list'],
            '__PARENT_MENU__'       =>  $menu['parent_menu'],
            '__PARENT_MENU_ID__'    =>  $menu['parent_menu_id'],
            '__CURRENT_ROOTMENU__'  =>  $menu['current_rootmenu']
        ]);
        
    }
}