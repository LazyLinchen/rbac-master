<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:63:"E:\WWW\rbac1\public/../application/admin\view\user\article.html";i:1493285955;s:64:"E:\WWW\rbac1\public/../application/admin\view\Common\header.html";i:1493525193;s:62:"E:\WWW\rbac1\public/../application/admin\view\Common\left.html";i:1493525161;s:64:"E:\WWW\rbac1\public/../application/admin\view\Common\footer.html";i:1493438330;}*/ ?>
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
  <link href="__CSS__/app.css?version=<?PHP echo time()?>" rel="stylesheet">


</head>
<body>
<div class="spinner">
  <div class="cube1"></div>
  <div class="cube2"></div>
</div>
<div class="hide-page"></div>
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
<div id="sidebar" class="col-xs-12 col-sm-2 sidebar" style="padding: 0; z-index: 99;">
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
    <div class="panel panel-success">
      <div class="panel-body ">
        <!-- 内联表单 -->
        <div class="container-fluid">
            <form class="form-inline col-lg-5 col-md-5 col-sm-5" action="__SELF__" method="get">
              <div class="form-group">
                <input type="text" name="keyword" class="form-control" placeholder="文章标题/关键字" value="<?php echo $keyword; ?>">
              </div>
              <button type="submit" class="btn btn-default">搜索</button>
            </form>

            <div class="col-lg-6 col-md-6 col-sm-6 pull-right text-center">

              <a class="btn btn-primary active" href="<?php echo url('addArticle'); ?>" role="button">添加文章</a>

              <!-- Contextual button for informational alert messages -->
              <a class="btn btn-info active js-Allstop" link="<?php echo url('changeStatus', array('model'=>'Article')); ?>" href="javascript:void(0);" role="button">隐藏</a>

              <!-- Indicates caution should be taken with this action -->
              <a class="btn btn-warning active js-Allstart" link="<?php echo url('changeStatus', array('model'=>'Article')); ?>" href="javascript:void(0);" role="button">显示</a>

              <!-- Indicates a dangerous or potentially negative action -->
              <a class="btn btn-danger active js-Alldel" link="<?php echo url('changeStatus', array('model'=>'Article')); ?>" href="javascript:void(0);" role="button">删除</a>

            </div>
        </div>
      </div>
    </div>

    <div class="panel panel-success">
      <div class="panel-body">
          <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th><input type="checkbox" class="check-all" name="all"></th>
                    <th>序号</th>
                    <th>文章标题</th>
                    <th>作者</th>
                    <th>文章分类</th>
                    <th>显示状态</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <tr>
                        <td><input class="ids" type="checkbox" value="<?php echo $vo['id']; ?>" name="id[]"></td>
                        <td><?php echo $k; if($vo[top] == '1'): ?><img src="__IMG__/5-120601155S3.gif" /><?php endif; ?></td>
                        <td><?php echo $vo['title']; ?></td>
                        <td><?php echo $vo['name']; ?></td>
                        <td><?php echo $vo['cname']; ?></td>
                        <td><?php if($vo[status] == '1'): ?>启用<?php endif; if($vo[status] == '0'): ?>禁用<?php endif; ?></td>
                        <td><?php echo $vo['create_time']; ?></td>
                        <td>
                          <a title="编辑" class="label label-primary" href="<?php echo url('addArticle', array('id' => $vo['id'])); ?>">编辑</a>
                          <?php if($vo[top] == '1'): ?><a class="label label-warning js-deltop" link="<?php echo url('top', array('id' => $vo['id'])); ?>" href="javascript:void(0);">取消置顶</a>&nbsp;<?php endif; if($vo[top] == '0'): ?><a class="label label-warning js-top" link="<?php echo url('top', array('id' => $vo['id'])); ?>" href="javascript:void(0);">置顶</a>&nbsp;<?php endif; if($vo[status] == '0'): ?><a class="label label-info js-start" link="<?php echo url('changeStatus', array('id' => $vo['id'], 'model'=>'Article')); ?>" href="javascript:void(0);">显示</a>&nbsp;<?php endif; if($vo[status] == '1'): ?><a class="label label-warning js-stop" link="<?php echo url('changeStatus', array('id' => $vo['id'], 'model'=>'Article')); ?>" href="javascript:void(0);">隐藏</a>&nbsp;<?php endif; if($vo[status] != '10'): ?><a class="label label-danger js-del" link="<?php echo url('changeStatus', array('id' => $vo['id'], 'model'=>'Article')); ?>" href="javascript:void(0);">删除</a>&nbsp;<?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation" class="pull-right">
            <?php echo $list->render(); ?>
        </nav>
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
  <script type="text/javascript" src="__JS__/jquery.form.js?version=<?PHP echo time();?>"></script>
  <script type="text/javascript" src="__JS__/admin.js?version=<?PHP echo date('Y-m-d H',time())?>"></script>
  <script type="text/javascript" src="__JS__/common.js?version=<?PHP echo time();?>"></script>
  <!-- <script src="__JS__/bootstrap.min.js?version=<?PHP echo date('Y-m-d H',time())?>"></script> -->
  <!-- Include all compiled plugins (below), or include individual files as needed -->
</body>
</html>

<script type="text/javascript" src="__JS__/admin.js?version=<?PHP echo date('Y-m-d H',time())?>"></script>