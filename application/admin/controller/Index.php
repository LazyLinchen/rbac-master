<?php
namespace app\admin\controller;
use app\admin\controller\Common;
class Index extends Common
{
    public function _initialize(){
        parent::_initialize();
    }

    public function index()
    {
        // p($_SESSION['think']);
        // p($this->request()->session());
        return $this->fetch();
    }

    public function welcome(){

        $info = $this->request()->server();
        $server['last_time'] = session('is_admin') ? session('admin_info.last_time') : session('user_info.last_time');
        $server['loginip'] = session('is_admin') ? session('admin_info.loginip') : session('user_info.loginip');
        $server['logintime'] = session('is_admin') ? session('admin_info.time') : session('user_info.time');
        $server['system'] = explode(" ", php_uname())[0];
        $server['server_port'] = $info['SERVER_PORT'];
        $server['server_addr'] = $info['SERVER_ADDR'];
        $server['domain'] = $this->request()->domain();
        $server['server_eng'] = $info['SERVER_SOFTWARE'];
        $server['lang'] = $info['HTTP_ACCEPT_LANGUAGE'];
        $server['time'] = date('Y-m-d H:i:s', $info['REQUEST_TIME']);
        $server['remo_ip'] = $info['REMOTE_ADDR'];
        // p($server);
        $this->assign('info', $server);
        return $this->fetch();
    }

}
