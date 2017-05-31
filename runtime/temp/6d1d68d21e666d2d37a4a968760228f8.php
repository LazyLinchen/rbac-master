<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:68:"E:\WWW\blogNote\public/../application/admin\view\access\useradd.html";i:1492681254;s:67:"E:\WWW\blogNote\public/../application/admin\view\Common\header.html";i:1493112829;s:65:"E:\WWW\blogNote\public/../application/admin\view\Common\left.html";i:1492681434;s:67:"E:\WWW\blogNote\public/../application/admin\view\Common\footer.html";i:1493430734;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <title>RBAC管理后台</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="__CSS__/admin.min.css">
  <link href="__CSS__/bootstrap.min.css?version=<?PHP echo date('Y-m-d H',time())?>" rel="stylesheet">
  <link href="__CSS__/app.css?version=<?PHP echo date('Y-m-d H',time())?>" rel="stylesheet">


</head>
<body>
<!-- 导航栏 -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="#">RBAC</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!-- <li class="active"><a href="<?php echo url('/admin/Index/welcome'); ?>">首页 <span class="sr-only">(current)</span></a></li> -->
        <?php if(is_array($__ALL_MENU_LIST__) || $__ALL_MENU_LIST__ instanceof \think\Collection || $__ALL_MENU_LIST__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__ALL_MENU_LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <li <?php if($vo['id'] == $__CURRENT_ROOTMENU__) echo 'class="active"'; ?>><a href="<?php echo url($vo['url']); ?>"><i class="<?php echo $vo['icon']; ?>"></i>&nbsp;<?php echo $vo['title']; ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
        <div class="dropdown navbar-right " style="margin-top: 8px; margin-right: 5px;">
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fa fa-user"></i><?php echo $__USERNAME__; ?>
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
            <li><a href="javascript:void(0)" class="edit_password"><i class="fa fa-edit"></i>修改密码</a></li>
            <li><a href="javascript:void(0)" class="edit_username"><i class="fa fa-edit"></i>修改用户名</a></li>
            <li><a href="<?php echo url('/admin/Pub/logout'); ?>" class="ajax-get"><i class="fa fa-sign-out"></i>退出</a></li>
          </ul>
        </div>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- 顶部导航栏结束 -->
<!-- 中部内容区域开始 -->
<div class="container-fluid">
<div id="sidebar" class="col-xs-12 col-sm-2 sidebar" style="padding: 0">
    <!-- 菜单区域 -->
    <button id="sidebar-toggle" class="btn btn-default btn-block hidden-xs" title="切换左侧菜单">
        <i class="fa fa-bars"></i>
    </button>

    <div class="panel-group" role="tablist">
        <?php if(is_array($__SIDE_MENU_LIST__) || $__SIDE_MENU_LIST__ instanceof \think\Collection || $__SIDE_MENU_LIST__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__SIDE_MENU_LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab">
                    <h4 class="panel-title"><a class="menu_tab" data-toggle="collapse" href="#side-menu<?php echo $key; ?>">
                        <i class="<?php echo $vo['icon']; ?>"></i> 
                        <span class="sidebar-title"><?php echo $vo['title']; ?></a></span>
                    </h4>
                </div>
                <div id="side-menu<?php echo $key; ?>" class="panel-collapse collapse in" role="tabpanel">

                    <div class="list-group">
                        <?php if(is_array($vo['_child']) || $vo['_child'] instanceof \think\Collection || $vo['_child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo_child): $mod = ($i % 2 );++$i;?>
                            <a class="list-group-item <?php  if(in_array($vo_child['id'], $__PARENT_MENU_ID__)) echo 'active';  ?>"
                            href="<?php echo url($vo_child['url']); ?>">
                                <i class="<?php echo $vo_child['icon']; ?>"  style="margin-left: 15px;"></i> 
                                <span class="sidebar-title"><?php echo $vo_child['title']; ?></span>
                            </a>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>

                </div>
            </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<!-- 内容区域 -->
<div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 col-lg-10 col-lg-offset-2">
    <!-- 地址导航栏 -->
    <ul class="breadcrumb">
        <li><i class="fa fa-map-marker"></i></li>
        <?php if(is_array($__PARENT_MENU__) || $__PARENT_MENU__ instanceof \think\Collection || $__PARENT_MENU__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__PARENT_MENU__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li><?php echo $vo['title']; ?></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <div class="panel panel-default panel-height">
        <div class="panel-boby panel-height">
            <form class="form form-horizontal builder-form" action="__SELF__" method="post">
              <div class="form-group">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                  <input type="text" name="name" class="form-control form-text" placeholder="例如:张三" value="<?php echo $info['name']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">登录帐号</label>
                <div class="col-sm-10">
                  <input type="text" name="username" class="form-control form-text" placeholder="" value="<?php echo $info['username']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">登录密码</label>
                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control form-text" <?php if(!(empty($info) || (($info instanceof \think\Collection || $info instanceof \think\Paginator ) && $info->isEmpty()))): ?>placeholder="为空则不更新"<?php endif; ?> value="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">确认密码</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control form-text verpassword" placeholder="" value="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">邮箱地址</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control form-text" name="email" placeholder="" value="<?php echo $info['email']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-10">
                  <select class="form-control form-text" name="status">
                    <option value="1" <?php if($info['status'] == '1'): ?>selected<?php endif; ?>>启用</option>
                    <option value="0" <?php if($info['status'] == '0'): ?>selected<?php endif; ?>>禁用</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">所属角色</label>
                <div class="col-sm-10">
                  <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                  <label class="checkbox-inline" style="font-size: 14px">
                     <input type="checkbox" name="role_id[]" value="<?php echo $vo['id']; ?>" <?php if(in_array(($vo[id]), is_array($info['role_id'])?$info['role_id']:explode(',',$info['role_id']))): ?>checked<?php endif; ?> /><?php echo $vo['name']; ?>
                  </label>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">备注</label>
                <div class="col-sm-10">
                  <textarea class="form-control form-text" rows="3" name="remark" placeholder="<?php echo $info['remark']; ?>"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10">
                  <input type="hidden" name="id" value="<?php echo $info['id']; ?>" />
                   <button type="submit" class="btn ajax-post btn-primary button-width" target-form="builder-form">确定</button>

                   <button type="button" onclick="javascript:history.back();" class="btn btn-success button-width">返回</button>
                </div>
              </div>
            </form>
        </div>
    </div>

</div>
<!-- 内容区域结束 -->
<!-- 中部内容区域结束 -->
</div>

<div>
    
</div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="__STATIC__/layer/layer.js"></script>
  <script type="text/javascript" src="__JS__/admin.min.js?version=<?PHP echo date('Y-m-d H',time())?>"></script>
  <script type="text/javascript" src="__JS__/admin.js?version=<?PHP echo date('Y-m-d H',time())?>"></script>
  <script type="text/javascript" src="__JS__/common.js?version=<?PHP echo time();?>"></script>
  <!-- <script src="__JS__/bootstrap.min.js?version=<?PHP echo date('Y-m-d H',time())?>"></script> -->
  <!-- Include all compiled plugins (below), or include individual files as needed -->
</body>
</html>

<script type="text/javascript">
  $(function(){
    $("button[type=submit]").click(function(){
      if($("input[name=name]").val()=="" || $("input[name=name]").val()==null){
        layer.msg('用户名不能为空', {icon: 0});
        return false;
      }
      if($("input[name=username]").val()=="" || $("input[name=username]").val()==null){
        layer.msg('登录名不能为空', {icon: 0});
        return false;
      }
      var verty = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_])+(.[a-zA-Z0-9_])/;
      var email = $("input[name=email]").val();
      if((email!="" || email!=null) & !verty.test(email)){
        layer.msg('邮箱格式不正确！', {icon: 0});
        return false;
      }
      if($("input[name=password]").val()!=$(".verpassword").val()){
        layer.msg('密码不一致！', {icon: 0});
        return false;
      }
    });
  });

</script>