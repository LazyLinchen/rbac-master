<?php
namespace app\admin\controller;

use app\admin\controller\Common;

use app\common\model\Category;

use app\common\controller\Dbinsert;

use think\Db;
/**
* 权限管理
*/
class Access extends Common
{
    /**
     * 初始化控制器
     * @AuthorHTL
     * @DateTime  2017-03-24T13:52:07+0800
     * @return    [type]                   [description]
     */
    function _initialize(){
        parent::_initialize();
    }

    /**
     * 用户列表
     * @AuthorHTL
     * @DateTime  2017-03-28T10:17:17+0800
     * @return    [type]                   [description]
     */
    function user(){
        $keyword = htmlspecialchars(trim($this->get('keyword')));
        $where['name|username|email'] = array('like', '%'.$keyword.'%');
        $where['status'] = array('neq', 10);
        $list = Db::name('user')->where($where)->paginate(20);
        $this->assign(['list'=>$list, 'keyword'=>$keyword]);
        return $this->fetch();
    }

    /**
     * 添加用户
     * @AuthorHTL
     * @DateTime  2017-03-28T10:17:33+0800
     * @return    [type]                   [description]
     */
    function userAdd(){
        if($this->isPost()){
            $post = $this->post();
            $data['name'] = $post['name'];
            $data['username'] = $post['username'];
            $data['password'] = user_md5($post['password']);
            $data['email'] = $post['email'];
            $data['status'] = $post['status'];
            $data['create_time'] = nowDate();
            if(is_numeric($post['id'])){
                $where['id'] = $post['id'];
                if(session('admin')!==1  & Db::name('user')->where("id = ".$post['id'])->value('is_admin') == 1)
                    return array('status'=>0, 'info'=>'此操作无效！', 'url'=>url('Access/user'));
                //开始事务操作
                Db::startTrans();
                try{
                    //若密码为空则不进行密码更改
                    if(empty($data['password']))    unset($data['password']);
                    Db::name('user')->where($where)->update($data);
                    if(Db::name('user_role')->where("uid", $where['id'])->find())
                        Db::name('user_role')->where("uid", $where['id'])->delete();
                    if($this->has('role_id', 'post')){
                        $data1 = array();
                        foreach ($post['role_id'] as $k => $v) {
                            $data1[$k]['uid'] = $where['id'];
                            $data1[$k]['role_id'] = $v;
                            $data1[$k]['created_time'] = nowDate();
                        }
                        Db::name('user_role')->insertAll($data1);
                    }
                    Db::commit();
                    return array('status'=>1, 'info'=>'修改用户成功!', 'url'=>url('Access/user'));
                }catch(\Exception $e){
                    Db::rollback();
                    return array('status'=>0, 'info'=>'修改用户失败！');
                }
            }else{
                if(empty($post['password']))    return array('status'=>0, 'info'=>'密码不能为空!');
                unset($post['id']);
                $where['username'] = $post['username'];
                if(Db::name('user')->where($where)->find())
                    return array('status'=>0, 'info'=>'该用户已存在');
                //开始事务操作
                Db::startTrans();
                try{
                    $userId = Db::name('user')->insertGetId($data);
                    if($this->has('role_id', 'post')){
                        $data1 = array();
                        foreach ($post['role_id'] as $k => $v) {
                            $data1[$k]['uid'] = $where['id'];
                            $data1[$k]['role_id'] = $v;
                            $data1[$k]['created_time'] = nowDate();
                        }
                        Db::name('user_role')->insertAll($data1);
                    }
                    Db::commit();
                    return array('status'=>1, 'info'=>'添加用户成功!', 'url'=>url('Access/user'));
                }catch(\Exception $e){
                    Db::rollback();
                    return array('status'=>0, 'info'=>'添加用户失败！');
                }
            }
        }else{
            if(is_numeric($this->param('id', 'get'))){
                $map['id'] = $this->param('id', 'get');
                $info = Db::name('user')->where($map)->find();
                $info['role_id'] = Db::name('user_role')->where('uid', $map['id'])->column('role_id');
                // halt($info);
            }
            $where['status'] = array('in', '0, 1');
            $list = Db::name('role')->where($where)->field('id, name')->select();
            $this->assign(['list'=>$list, 'info'=>$info]);
            return $this->fetch();
        }
    }

    /**
     * 节点列表
     * @AuthorHTL
     * @DateTime  2017-03-28T10:17:41+0800
     * @return    [type]                   [description]
     */
    function nodeList(){
        $where['status'] = array('neq', 10);
        $category = new Category('node', array('id', 'pid', 'title', 'fullname'));
        $temp = $category->getList($where, 0, 'sort');
        $level = array('1'=>'项目(GROUP_NAME)', '2'=>'模块(MODEL_NAME)', '3'=>'操作(ACTION_NAME)');
        $list = array();
        if($temp){
            foreach ($temp as $key => $value) {
                $temp[$key]['statusTxt'] = $value['status'] ==1 ? "启用" : "禁用";
                $temp[$key]['chStatusTxt'] = $value['status'] == 0 ? "启用" : "禁用";
                $temp[$key]['level'] = $level[$value['level']];
                $list[$value['id']] = $temp[$key];
            }
        }
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 添加节点或编辑节点
     * @AuthorHTL
     * @DateTime  2017-03-28T10:17:51+0800
     * @return    [type]                   [description]
     */
    function nodeAdd(){
        if($this->isPost()){
            $post = $this->post();
            //如参数id不为空则进行修改操作
            if(!empty($post['id'])){
                $id = $post['id'];
                if(!is_numeric($id)) return array('status'=>0, 'info'=>'发生错误，请重新再试!', 'url'=>url('Access/nodeList'));
                unset($post['id']);
                if(Db::name('node')->where('id', $id)->update($post)){
                    return array('status'=>1, 'info'=>'修改节点成功！', 'url'=>url('Access/nodeList'));
                }
            }else{
                //判断不能重复添加相同节点
                $where['pid'] = $post['pid'];
                $where['name'] = $post['name'];
                if(Db::name('node')->where($where)->find()){
                    return array('status'=>0, 'info'=>'该节点已存在');
                }

                if(Db::name('node')->insert($post)){
                    return array('status'=>1, 'info'=>'新增节点成功！', 'url'=>url('Access/nodeList'));
                }
            }
        }else{
            if($this->has('id', 'param') && is_numeric($this->param('id'))){
                $id = $this->param('id');
                $info = Db::name('node')->where('id', $id)->find();
                $level = array('1'=>'项目', '2'=>'模块', '3'=>'操作');
                $this->assign('info', $info);
                // p($info);
            }
            $node = empty($info) ? array('level'=>1) : array('level'=>$info['level'], 'pid'=>$info['pid']);
            $this->assign('node', $this->getNode($node));
            // p($this->getNode(array('level'=>1)));
            return $this->fetch();
        }
    }

    /**
     * 状态修改
     * @AuthorHTL
     * @DateTime  2017-04-10T17:31:23+0800
     * @return    [type]                   [description]
     */
    function changeStatus(){
        $arr = array('node',  'user', 'role');
        if(!in_array($this->param('model'), $arr))  return array('status'=>0, 'info'=>'非法操作');
        $model = $this->param('model');
        if(!is_numeric($this->param('id')) && !$this->post('ids'))  return array('status'=>0, 'info'=>'非法操作');
        /*判断是否多条操作*/
        if($ids = $this->post('ids')){
            $ids = mb_substr($ids, 0, -1);
        }
        if($this->param('id'))  $map['id'] = $this->param('id');
        if($ids)    $map['id'] = array('in', $ids);
        switch ($this->post('type')) {
            case 'stop':
                $status = 0;
                break;
            case 'start':
                $status = 1;
                break;
            case 'del':
                $status = 10;
                break;
            default:
                return array('status'=>0, 'info'=>'非法操作');
                break;
        }
        if(Db::name($model)->where($map)->setField('status', $status)){
            return array('status'=>1, 'info'=>'操作成功！');
        }else{
            return array('status'=>0, 'info'=>'操作失败！');
        }
    }

    /**
     * 角色列表
     * @AuthorHTL
     * @DateTime  2017-03-28T10:20:37+0800
     * @return    [type]                   [description]
     */
    function roleList(){
        $where['status'] = array('neq', 10);
        $list = Db::name('role')->where($where)->select();
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 添加/编辑角色
     * @AuthorHTL
     * @DateTime  2017-03-28T10:20:51+0800
     * @return    [type]                   [description]
     */
    function roleAdd(){
        if($this->isPost()){
            $post = $this->post();
            /*编辑*/
            if($this->has('id', 'post') && is_numeric($this->post('id'))){
                $where['id'] = $post['id'];
                unset($post['id']);
                $post['updated_time'] = nowDate();
                if(Db::name('role')->where($where)->update($post)){
                    return array('status'=>1, 'info'=>'修改角色组成功！', 'url'=>url('roleList'));
                }else{
                    return array('status'=>0, 'info'=>'修改角色组失败!');
                }
            }else{
            /*添加*/
                unset($post['id']);
                $where['pid'] = $post['pid'];
                $where['name'] = $post['name'];
                if(Db::name('role')->where($where)->find())   return array('status'=>0, 'info'=>'该角色组已存在!');
                $post['created_time'] = nowDate();
                if(Db::name('role')->insert($post)){
                    return array('status'=>1, 'info'=>'添加角色组成功！', 'url'=>url('roleList'));
                }else{
                    return array('status'=>0, 'info'=>'添加角色组失败!');
                }
            }
        }else{
            if($this->has('id', 'param') && is_numeric($this->param('id'))){
                $where['id'] = $this->param('id');
                $info = Db::name('role')->where($where)->find();
                $this->assign('info', $info);
            }
            $list = Db::name('role')->field('id, name')->select();
            $this->assign('list', $list);
            return $this->fetch();
        }
    }

    /**
     * 更改权限
     * @AuthorHTL
     * @DateTime  2017-03-28T10:18:03+0800
     * @return    [type]                   [description]
     */
    function changeRole(){
        if($this->isPost()){
            $post = $this->post();
            if(!is_numeric($post['id']))
                return array('status'=>0, 'info'=>'非法操作!', 'url'=>url('roleList'));
            $id = $post['id'];
            Db::startTrans();
            try{
                Db::name('access')->where("role_id = $id")->delete();
                /*若$post['data']不存在，则只进行清空权限操作*/
                if($this->has('data', 'post')){
                    $datas = array();
                    foreach ($post['data'] as $k => $v) {
                        $ids = explode(":", $v);
                        $datas[$k]['node_id'] = $ids[0];
                        $datas[$k]['role_id'] = $id;
                        $datas[$k]['level'] = $ids[1];
                        $datas[$k]['pid'] = $ids[2];
                    }
                    Db::name('access')->insertAll($datas);
                }
                Db::commit();
                return array('status'=>1, 'info'=>'权限设置成功!', 'url'=>url('roleList'));
            }catch(\Exception $e){
                Db::rollback();
                return array('status'=>0, 'info'=>'权限设置失败!');
            }
        }else{
            if(!is_numeric($this->param('id', 'get')))
                return array('status'=>0, 'info'=>'非法操作!', 'url'=>url('roleList'));
            $id = $this->param('id', 'get');
            if(!Db::name('user')->where("id = $id")->find());
                // return array('status'=>0, 'info'=>'不存在该用户组!', url('roleList'));
            $access = Db::name('access')->where("role_id = $id")->field('node_id')->select();
            $access = count($access) > 0 ? json_encode($access) : json_encode(array());
            $list = Db::name('node')->where("level=1")->select();
            foreach ($list as $k => $v) {
                $map['level'] = 2;
                $map['pid'] = $v['id'];
                $list[$k]['data'] = Db::name('node')->where($map)->select();
                foreach ($list[$k]['data'] as $key => $val) {
                    $map['level'] = 3;
                    $map['pid'] = $val['id'];
                    $list[$k]['data'][$key]['data'] = Db::name('node')->where($map)->select();
                }
            }
            $this->assign(['list'=>$list, 'id'=>$id, 'access'=>$access]);
            return $this->fetch();
        }
    }
    
    /**
     * 输出所节点
     * @AuthorHTL
     * @DateTime  2017-03-28T15:13:25+0800
     * @return    [type]                   [description]
     */
    function getNode($info){
        $arr = array('请选择', '项目', '模块', '操作');
        for($i = 1; $i < 4; $i++){
            $selected = $info['level'] == $i ? "selected='selected'" : "";
            $info['levelOpiton'] .= '<option value="'. $i .'"'. $selected . '>'.$arr[$i].'</option>';
        }
        $level = $info['level'] - 1;

        $category = new Category('node', array('id', 'pid', 'title', 'fullname'));
        $list = $category->getList();
        $option = $level == 0 ? '<option value="0" level="-1">根节点</option>' : '<option value="0" disabled="disabled">根节点</option>';
        if($list){
            foreach ($list as $k => $v) {
                $disabled = $v['level'] == $level ? "" : 'disabled="disabled"';
                $selected = $v['id'] != $info['pid'] ? "" : 'selected="selected"';
                $option .= '<option value="'.$v['id'].'"'.$disabled.$selected. ' level="'.$v['level']. '">'.$v['fullname'] .'</option>';
            }
        }
        $info['pidOption'] = $option;

        return $info;
    }

}