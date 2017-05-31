<?php
namespace app\common\model;

use think\Model;


/**
* 
*/
class Menu extends Model
{
    
    protected function _initialize(){
        parent::_initialize();
    }
    /*protected $_validate = array(
        array('title','require','菜单标题必须填写', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('title', '1,32', '菜单标题长度为1-32个字符', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),
    );*/

    function add($post){
        $post['create_time'] = date('Y-m-d H:i:s', time());
        $this->data = $post;
        if($this->allowField(true)->save()){
            return true;
        }
    }

    function saveData($post, $map){
        $post['update_time'] = date('Y-m-d H:i:s', time());
        if($this->isUpdate(true)->allowField(true)->save($post, $map)){
            return true;
        }
    }

    public function getCurrentMenu($module, $controller, $action){
        $map['status'] = array('eq', 1);
        $map['url'] = array('like', $module.'/'.$controller.'/'.$action.'%');
        $result = $this->where($map)->order('pid desc')->find();
        if(!$result){
            $map1['status'] = array('eq', 1);
            $map1['url'] = array('like', $module.'/'.$controller.'%');
            $result = $this->where($map1)->order('pid desc')->find();
        }
        return $result;
    }

    /**
     * 根据菜单ID的获取其所有父级菜单
     * @param array $current 当前菜单信息
     * @return array 父级菜单集合
     * @author 
     */
    public function getParentMenu($current){
        if(empty($current)){
            return false;
        }
        $map['status'] = array('eq', 1);
        $menus = $this->where($map)->select();
        $pid   = $current['pid'];
        $temp  = array();
        $res[] = $current;
        while(true){
            foreach ($menus as $key => $val){
                if($val['id'] == $pid){
                    $pid = $val['pid'];
                    array_unshift($res, $val); //将父菜单插入到数组第一个元素前
                }
            }
            if($pid == '0'){
                break;
            }
        }
        return $res;
    }

}