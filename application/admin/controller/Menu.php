<?php
namespace app\admin\controller;

use app\common\model\Menu AS MenuModel;

use app\common\model\Category;

use app\admin\controller\Common;

/**
* 菜单管理
*/
class Menu extends Common
{

    function index(){
        $keyword = $this->get('keyword');
        $where['module'] = array('like', '%'.strtoupper($keyword).'%');
        $where['status'] = array('neq', 10);
        $category = new Category('menu', array('id', 'pid', 'title', 'fullname'));
        $temp = $category->getList($where, 0, 'sort');
        $list = array();
        if($temp){
            foreach ($temp as $k => $v) {
                $list[$v['id']] = $temp[$k];
            }
        }
        $this->assign(['list' => $list, 'keyword' => $keyword]);

        return $this->fetch();
    }

    /**
     * 添加或者编辑菜单
     * @AuthorHTL
     * @DateTime  2017-03-28T10:08:25+0800
     */
    function addMenu(){
        if($this->isPost()){
            $post = $this->post();
//            halt($post);
            $module = explode("/", $post['url']);
            $post['module'] = empty($post['module']) ? strtoupper($module[0]) : strtoupper($this->request()->module());
            $menu = new MenuModel;

            if($this->has('id', 'post') && is_numeric($post['id'])){
                $data = $menu->saveData($post, array('id'=>$post['id']));
                if($data){
                    return array('status' => 1, 'info' => "更新成功", 'url' => url("index"));
                }else{
                    return array('status' => 0, 'info' => "更新失败");
                }
            }
        
            $where['pid'] = $post['pid'];
            $where['title'] = $post['title'];
            if($res = $menu::get($where))
                return array('status' => 0, 'info' => "该菜单已存在");
            $data = $menu->add($post);
            if($data){
                return array('status' => 1, 'info' => "成功添加", 'url' => url("index"));
            }else{
                return array('status' => 0, 'info' => "添加失败");
            }
        }else{
            if($this->has('id', 'param')){
                $id = $this->param('id');
                if(is_numeric($id)){
                    $menu = new MenuModel;
                    $info = $menu->where('id', $id)->find();
                    $this->assign('info', $info);
                }
            }
//            halt($this->getSelectStr('admin'));
            $this->assign('menu', $this->getMenu(array('pid'=>$info['pid'])));
            $this->assign('select_node', $this->getSelectStr('Admin'));
            return $this->fetch();
        }
    }

    /**
     * 操作菜单状态
     * @AuthorHTL
     * @DateTime  2017-04-13T11:22:58+0800
     */
    function menuStatus(){
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
        $MenuModel = new MenuModel;
        if($MenuModel->where($map)->update(['status' => $status])){
            return array('status'=>1, 'info'=>'操作成功！');
        }else{
            return array('status'=>0, 'info'=>'操作失败！');
        }
    }

    /**
     * 获取所有的菜单
     * @AuthorHTL
     * @DateTime  2017-03-28T10:08:40+0800
     * @param     array                    $info [description]
     * @return    [type]                         [description]
     */
    function getMenu($info = array()){
        $category = new Category('Menu', array('id', 'pid', 'title', ''));
        $list = $category->getList();
        if(!$list) return false;
        foreach ($list as $k => $v) {
            $selected = $v['id'] == $info['pid'] ? ' selected="selected"' : "";
            $info['pidOption'] .= '<option value="' .$v['id']. '"' .$selected. '>'.$v['fullname'].'</option>';
        }
        return $info;
    }

    //返回节点select框
    public function getNode(){
        if($this->isPost()){
            echo $this->getSelectStr($this->post('link'));
        }
    }

    //返回一个拼接完成的select字符串
    //参数：$url格式：Admin/Access/index
    private function getSelectStr($url){
        $url = explode("/",$url);
        $str = '<div class="form-group item_sort">'."\r\n".'
                    <label class="item-label col-sm-2 control-label">节点</label>'."\r\n".'
                    <div class="col-sm-10" style="overflow:hidden;">'."\r\n".'
                    <input name="module1" value="'.strtoupper($url[0]).'" type="hidden"/>'."\r\n";


        $Moeld_id = db('node')->where(array('name' => ucwords($url[0]),'status' => 1,'level' => 1,'pid' => 0))->value('id');
        $Controller_id = db('node')->where(array('name' => ucwords($url[1]),'status' => 1,'level' => 2,'pid' => $Moeld_id))->value('id');
        $function_id = db('node')->where(array('name' => ucwords($url[2]),'status' => 1,'level' => 3,'pid' => $Controller_id))->value('id');
        $node = db('node')->where(array('level' => 1))->select();
        if(empty($Moeld_id)){
        }
        $node2 = db('node')->where(array('level' => 2,'pid' => $Moeld_id))->select();
        if(empty($Controller_id)){
            $Controller_id = $node2[0]['id'];
        }
        $node3 = db('node')->where(array('level' => 3,'pid' => $Controller_id))->select();
        // halt($Controller_id);
        $str = $this->getNode_function($str,$node,$Moeld_id);
        $str = $this->getNode_function($str,$node2,$Controller_id);
        $str = $this->getNode_function($str,$node3,$function_id,false);
        $str.='<div style="float:left;margin-left:10px;" class="btn btn-primary url">选择连接</div></div></div>'."\r\n";
        // halt($str);
        return $str;
    }

    //拼接节点select框
    //$str : 字符串 $node:节点数据 $id:选中的id $node_select:select标签是否添加node_select样式
    private function getNode_function($str,$node,$id='',$node_select=true){
        if($node){
            //$node_select为空，代表是最后一层，则不添加触发事件样式node_select
            if($node_select){
                $str .= '<select name="node_id" class="form-control select node_select remove_node" style="width:143px;float:left;margin-right:10px;">'."\r\n";
            }else{
                $str .= '<select name="node_id" class="form-control select remove_node" style="width:143px;float:left;margin-right:10px;">'."\r\n";
            }
            foreach($node as $key => $val){
                if($id == $val['id']){
                    $str .='<option value="'.$val['id'].'" selected>'.$val['name'].'</option>'."\r\n";
                }else{
                    $str .='<option value="'.$val['id'].'">'.$val['name'].'</option>'."\r\n";
                }
            }
            $str .= '</select>';
        }
        
        return $str;
    }

    //节点select框改变触发事件函数
    public function node_change_select(){
        if($this->isPost()){
            $id = $this->post('id');
            $node = db('node')->where(array('id' => $id))->field('id,pid,name,level')->find();

            $str = '';
            for($num = $node['level'];$num<3;$num++){
                $allnode = db('node')->where(array('pid' => $node['id'],'level' => $num+1))->select();
                //获取下一级节点的pid
                $node['id'] = $allnode[0]['id'];
                if($num==2){
                    $str = $this->getNode_function($str,$allnode,$Moeld_id,'',false);
                }else{
                    $str = $this->getNode_function($str,$allnode,$Moeld_id);
                }
            }
            //echo $str;
            $data['htm_str'] = $str;
            $data['level'] = $node['level'];
            $data['name'] = strtoupper($node['name']);
            return $data;
            // $this->ajaxReturn($data);
        }
    }


}