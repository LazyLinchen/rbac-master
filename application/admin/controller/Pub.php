<?php
namespace app\admin\controller;
use app\common\controller\Base;
use think\Db;
use app\common\model\User;

class Pub extends Base
{
    function login(){
        // halt($_SESSION);
        if($this->isPost()){
            $post = $this->post();
            $username = $post['username'];
            $password = $post['password'];
            $user = new User;
            $uid = $user->Login($username, $password);
            if($uid > 0){
                return array('status' => 1, 'info' => "登录成功！", 'url' => url('Index/welcome'));
            }else{
                return array('status' => 0, 'info' => $user->getError());
            }
        } else {
            return $this->fetch();
        }
    }

    function logout(){
        $user = new User;
        $user->Logout();
        return array('status' => 1, 'info' => "退出成功！", 'url' => url('login'));
        // $this->success('退出成功！', url('login'));
    }

    function _empty(){
        $this->redirect('login');
    }

    function edit_password(){
        if($this->isPost()){
            $post = $this->post();
            if($post['password2']!==$post['password3'])
                return array('status'=>0, 'info'=>'两次密码不一致！');
            $user = new User();
            $result = $user->edit_password($post['password1'], $post['password2']);
            return $result;
        }
    }

    function edit_username(){
        if($this->isPost()){
            $post = $this->post();
            $user = new User();
            $result = $user->edit_username($post['username'], $post['password']);
            return $result;
        }
    }
}