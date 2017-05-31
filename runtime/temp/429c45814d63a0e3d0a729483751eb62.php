<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"E:\WWW\blogNote\public/../application/admin\view\user\addarticle.html";i:1493525390;s:67:"E:\WWW\blogNote\public/../application/admin\view\Common\header.html";i:1493525193;s:65:"E:\WWW\blogNote\public/../application/admin\view\Common\left.html";i:1493525161;s:67:"E:\WWW\blogNote\public/../application/admin\view\Common\footer.html";i:1493438330;}*/ ?>
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
    <div class="panel panel-default panel-height" style="overflow:hidden;">
        <div class="panel-boby panel-height">
            <form class="form form-horizontal builder-form" enctype="multipart/form-data" action="__SELF__" method="post">
              <div class="form-group">
                <label class="col-sm-2 control-label">文章标题</label>
                <div class="col-sm-10">
                  <input type="text" name="title" class="form-control form-text" placeholder="" value="<?php echo $info['title']; ?>">
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">文章题注</label>
                  <div class="col-sm-10">
                      <input type="text" name="descript" class="form-control form-text" placeholder="" value="<?php echo $info['descript']; ?>">
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">标签</label>
                <div class="col-sm-10">
                  <input type="text" name="label" class="form-control form-text" placeholder="" value="<?php echo $info['label']; ?>">
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">文章分类</label>
                  <div class="col-sm-10">
                      <select class="form-control form-text" name="ac_id">
                          <?php if(is_array($article_classifty) || $article_classifty instanceof \think\Collection || $article_classifty instanceof \think\Paginator): $i = 0; $__LIST__ = $article_classifty;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                          <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $info['ac_id']): ?>selected<?php endif; ?>><?php echo $vo['cname']; ?></option>
                          <?php endforeach; endif; else: echo "" ;endif; ?>
                      </select>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">缩略图</label>
                <div class="col-sm-10">
                    <input type="file" name="thumb" class="form-control form-text img_thumb" value="<?php echo $info['thumb']; ?>">
                    <?php if(!(empty($info[thumb]) || (($info[thumb] instanceof \think\Collection || $info[thumb] instanceof \think\Paginator ) && $info[thumb]->isEmpty()))): ?>
                    <img class="thumb" src="<?php echo $info['thumb']; ?>" />
                    <button type="button" class="btn btn-success del_img button-width">删除图片</button>
                    <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-10">
                  <select class="form-control form-text" name="status" style="width: 30%; float: left">
                    <option value="1" <?php if($info['status'] == '1'): ?>selected<?php endif; ?>>启用</option>
                    <option value="0" <?php if($info['status'] == '0'): ?>selected<?php endif; ?>>禁用</option>
                  </select>
                    <label class="col-sm-2 control-label" >置顶</label>
                    <select class="form-control form-text" name="top" style="width: 30%; float: left">
                        <option value="1" <?php if($info['top'] == '1'): ?>selected<?php endif; ?>>置顶</option>
                        <option value="0" <?php if($info['top'] == '0'): ?>selected<?php endif; ?>>取消</option>
                    </select>
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">内容</label>
                  <div class="col-sm-10" sty>
                      <textarea id="description" name="content" style=""><?php echo $info['content']; ?></textarea>
                  </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10">
                   <input type="hidden" name="id" value="<?php echo $info['id']; ?>" />
                   <button type="button" class="btn ajax-pst submit btn-primary button-width" target-form="builder-form">确定</button>

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
  <script type="text/javascript" src="__JS__/jquery.form.js?version=<?PHP echo time();?>"></script>
  <script type="text/javascript" src="__JS__/admin.js?version=<?PHP echo date('Y-m-d H',time())?>"></script>
  <script type="text/javascript" src="__JS__/common.js?version=<?PHP echo time();?>"></script>
  <!-- <script src="__JS__/bootstrap.min.js?version=<?PHP echo date('Y-m-d H',time())?>"></script> -->
  <!-- Include all compiled plugins (below), or include individual files as needed -->
</body>
</html>

<script type="text/javascript" src="__STATIC__kindeditor/kindeditor-all.js" charset="utf-8"></script>
<script type="text/javascript" src="__STATIC__/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
    KindEditor.ready(function(K) {
        description = K.create('#description', {
            allowFileManager: true,
            width: '100%',
            height: '400px',
            cssPath: [
                '__STATIC__kindeditor/themes/default/default.css',
            ],
            resizeType: 1,
            pasteType: 2,
            extraFileUploadParams: {
                session_id: '__USERID__'
            },
            afterBlur: function() {
                this.sync();
            },
        });
    });
    $(function(){
        $(".del_img").click(function(){
            $("input[name=thumb]").removeAttr('value');
            $(".thumb").remove();
            $(this).after("<input type='hidden' name='thumb_del' value='1' />");
            $(this).remove();
        });
        $(".submit").click(function () {
            commonAjaxSubmit();
        });

    });
</script>