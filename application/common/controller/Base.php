<?php
namespace app\common\controller;
use think\Controller;
use think\Request;

/**
 * Base基类控制类
 */
class Base extends Controller{
    /**
     * 初始化方法
     * @AuthorHTL
     * @DateTime  2017-03-22T14:16:23+0800
     * @return    [type]                   [description]
     */
    public function _initialize(){
        $this->view->replace([
            '__PUBLIC__'    => __PUBLIC__,
            '__STATIC__'    => __STATIC__,
            '__CSS__'       => __STATIC__.'css',
            '__JS__'        => __STATIC__.'js',
            '__IMG__'       => __STATIC__.'img',
            '__LIBS__'      => __STATIC__.'libs',
            '__MODULE__'    => $this->request()->module(),
            '__CONTROLLER__'=> $this->request()->controller(),
            '__SELF__'      => $this->request()->action(),
            '__USERID__'    => userId(),
        ]);
    }

    /**
     * [isPost description]
     * @AuthorHTL
     * @DateTime  2017-03-23T12:10:38+0800
     * @return    boolean                  [description]
     */
    public function isPost(){
        return $this->request()->isPost();
    }

    /**
     * [isGet description]
     * @AuthorHTL
     * @DateTime  2017-03-23T12:10:46+0800
     * @return    boolean                  [description]
     */
    public function isGet(){
        return $this->request()->isGet();
    }

    /**
     * [request description]
     * @AuthorHTL
     * @DateTime  2017-03-23T12:10:50+0800
     * @return    [type]                   [description]
     */
    public function request(){
        return Request::instance();
    }

    public function param($name = ''){
        return $this->request()->param($name);
    }

    /**
     * [post description]
     * @AuthorHTL
     * @DateTime  2017-03-23T12:10:56+0800
     * @param     string                   $name [description]
     * @return    [type]                         [description]
     */
    public function post($name = ''){
        return $this->request()->post($name);
    }

    /**
     * [get description]
     * @AuthorHTL
     * @DateTime  2017-03-23T12:11:00+0800
     * @param     string                   $name [description]
     * @return    [type]                         [description]
     */
    public function get($name = ''){
        return $this->request()->get($name);
    }

    /**
     * [cookie description]
     * @AuthorHTL
     * @DateTime  2017-03-23T12:11:03+0800
     * @param     string                   $name [description]
     * @return    [type]                         [description]
     */
    public function cookie($name = ''){
        return $this->request()->cookie($name);
    }

    /**
     * [file description]
     * @AuthorHTL
     * @DateTime  2017-03-23T12:11:07+0800
     * @param     string                   $name [description]
     * @return    [type]                         [description]
     */
    public function file($name = ''){
        return $this->request()->file($name);
    }

    public function has($name, $method = 'get'){
        return $this->request()->has($name, $method);
    }

    public function module(){
        return $this->request()->module();
    }

    public function controller(){
        return $this->request()->controller();
    }

    public function action(){
        return $this->request()->action();
    }

    public function _empty(){
        header("Location:http://localhost/blogNote/public/404");
    }
}