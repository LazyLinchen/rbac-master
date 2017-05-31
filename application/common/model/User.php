<?php
namespace app\common\model;
use think\Model;
use think\Rbac;
use think\Db;

class User extends Model
{
    //设置完整的数据表(包含前缀)
    // protected $table = 'user';

    /**
     * 用户登录
     * @param $username
     * @param $password
     * @param int $type
     * @return bool
     */
    function Login($username, $password, $type=1){
        $username = trim($username);
        $map['username'] = array('eq', $username);
        $map['status'] = array('eq', 1);
        $user = Rbac::authenticate($map, 'user');
        if(!$user){
            $this->error = '用户不存在或者被禁用！';
        }else{
            if($type){
                $password = user_md5($password);
            }
            if($password !== $user['password']){
                $this->error = '帐号或密码错误！';
            }else{
                $user['time'] = date('Y-m-d H:i:s', time());
                $this->autoLogin($user);
                $this->changeUser($user['id']);
                return $user['id'];
            }
        }
        return false;
    }

    public function changeUser($id){
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        $data['loginip'] = $ip ? $ip : request()->server('REMOTE_ADDR');
        $data['last_time'] = date('Y-m-d H:i:s', time());
        return $this->where('id', $id)->update($data);
    }

    /**
     * 登录自动保存凭证
     * @AuthorHTL
     * @DateTime  2017-04-19T15:58:26+0800
     * @param     [type]                   $user [description]
     * @return    [type]                         [description]
     */
    public function autoLogin($user){
        session(null);
        unset($user['password']);
        if($user['is_admin'] == 1){
            session('admin_info', $user);
            session('admin_info_sign', $this->dataAuthSign($user));
            session('is_admin', $user['is_admin']);
            session(config('auth.ADMIN_AUTH_KEY'), $user['id']);
        }else{
            session('user_info', $user);
            session('user_info_sign', $this->dataAuthSign($user));
            session(config('auth.USER_AUTH_KEY'),$user['id']);
        }
        session('username', $user['name']);
        //获取保存RBAC权限
        RBAC::saveAccessList($user['id']);

        //获取所有节点，以便取出菜单
        $node = RBAC::getModuleAccessList($user['id']);
        session('node', $node);
    }

    protected function checkUsername(){
        $deny = explode(',', Config::get('auth.SNSITIVE_WORDS'));
        foreach ($deny as $k => $v){

        }
    }

    /**
     * 数据签名认证
     * @param $data
     */
    public function  dataAuthSign($data){
        //数据类型检测
        if(!is_array($data)){
            $data = array($data);
        }
        ksort($data);
        $code = http_build_query($data);    //url编码并生成query字符串
        $sign = sha1($code);    //生成签名
        return $sign;
    }

    public function isLogin(){
        if(session('is_admin')==1){
            $module = strtolower(request()->module());
        }else{
            $module = 'user';
        }
        

        $session_info = session($module.'_info');
        if(empty($session_info)){
            return 0;
        }else{
            return session($module.'_info_sign') == $this->dataAuthSign($session_info) ? $session_info['id'] : 0;
        }
    }

    public function Logout(){
        session(null);
        return true;
    }

    public function edit_password($password1, $password2){
        $map['id'] = empty(session('admin')) ? session(config('auth.USER_AUTH_KEY')) : session(config('auth.ADMIN_AUTH_KEY'));
        if($this->where($map)->value('password') == user_md5($password1)){
            if($this->where($map)->update(['password'=>user_md5($password2)])){
                return array('status'=>1, 'info'=>'密码修改成功');
            }
            else{
                return array('status'=>0, 'info'=>'密码修改失败');
            }
        }else{
            return array('status'=>0, 'info'=>'原密码不匹配');
        }
    }

    public function edit_username($username, $password){
        $map['id'] = empty(session('admin')) ? session(config('auth.USER_AUTH_KEY')) : session(config('auth.ADMIN_AUTH_KEY'));
        if($this->where($map)->value('password') == user_md5($password)){
            if($re = $this->get(['username' => $username]))
                return array('status'=>0, 'info'=>'该用户名已存在');
            if($this->where($map)->update(['username'=>$username])){
                return array('status'=>1, 'info'=>'用户名修改成功');
            }
            else{
                return array('status'=>0, 'info'=>'用户名修改失败');
            }
        }else{
            return array('status'=>0, 'info'=>'原密码不匹配');
        }
    }
}