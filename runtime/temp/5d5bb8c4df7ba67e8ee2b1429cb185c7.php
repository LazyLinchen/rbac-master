<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:66:"E:\WWW\blogNote\public/../application/admin\view\menu\addmenu.html";i:1493113367;s:67:"E:\WWW\blogNote\public/../application/admin\view\Common\header.html";i:1493112829;s:65:"E:\WWW\blogNote\public/../application/admin\view\Common\left.html";i:1492681434;s:67:"E:\WWW\blogNote\public/../application/admin\view\Common\footer.html";i:1492764109;}*/ ?>
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
            <form class="form form-horizontal builder-form" action="" method="post">
              <div class="form-group">
                <label class="col-sm-2 control-label">上级菜单</label>
                <div class="col-sm-10">
                  <select class="form-control form-text" name="pid">
                    <option value="0">根菜单</option>
                    <?php echo $menu['pidOption']; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">菜单标题</label>
                <div class="col-sm-10">
                  <input type="text" name="title" class="form-control form-text" placeholder="" value="<?php echo $info['title']; ?>">
                </div>
              </div>
              <div class="form-group" id='node_url'>
                <label class="col-sm-2 control-label">菜单链接</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-text" style='float:left;' name="url" placeholder="" value="<?php echo $info['url']; ?>">
                  <div style='float:left;margin-left:10px;' class='btn btn-primary node'>选择节点</div>
                </div>
              </div>
              <?php echo $select_node; ?>
              <div class="form-group">
                  <label class="col-sm-2 control-label">选择模块</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-text form-control input icon-choosen" name="module" value="<?php echo $info['module']; ?>" />
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">图标</label>
                <div class="col-sm-10">
                  <input type="text" id="_icon_4" class="form-text form-control input icon-choosen" name="icon" value="<?php echo $info['icon']; ?>" />
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">alt信息</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-text form-control input icon-choosen" name="alt" value="<?php echo $info['alt']; ?>" />
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">排序</label>
                <div class="col-sm-10">
                  <input type="text" name="sort" class="form-control form-text" placeholder="" value="<?php echo $info['sort']; ?>">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10">
                  <input type="hidden" name="id" value="<?php echo $info['id']; ?>" />
                   <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                   <button type="submit" class="btn ajax-post btn-primary button-width" target-form="builder-form">确定</button>

                   <!-- Indicates a successful or positive action -->
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
  <!-- <script type="text/javascript" src="__JS__/admin.js"></script> -->
  <!-- <script src="__JS__/bootstrap.min.js?version=<?PHP echo date('Y-m-d H',time())?>"></script> -->
  <!-- Include all compiled plugins (below), or include individual files as needed -->
</body>
<script type="text/javascript">
  $(function(){
    $(".edit_password").click(function(){
      layer.open({
        type: 1,
        area: ['400px', '300px'],
        title: '修改密码',
        btn: false,
        shift: 2,
        shade: [0],
        scrollbar: false,
        shadeClose: false,
        content: '<div style="width:90%;margin-top:10px;" class="form-horizontal">'+
			'<div class="form-group"><label for="password1" class="col-sm-4 control-label">旧密码：</label><div class="col-sm-8"><input type="password" class="form-control" id="password1" value="" placeholder="为空则不修改"></div></div>'+
			'<div class="form-group"><label for="password2" class="col-sm-4 control-label">新密码：</label><div class="col-sm-8"><input type="password" class="form-control" id="password2" placeholder="输入新密码"></div></div>'+
			'<div class="form-group"><label for="password3" class="col-sm-4 control-label">确认密码：</label><div class="col-sm-8"><input type="password" class="form-control" id="password3" placeholder="重复新密码"></div></div></div>'+
			'<div style="text-align:center;"><buttun class="btn btn-success" onclick="edit_pass()">确认修改</buttun></div>',

      });
    });
    $(".edit_username").click(function(){
      	layer.open({
			type: 1,
			area:['400px','200px'],
			title:'修改用户名',
			btn:false,
			shift: 2,
			shade: [0],
			scrollbar: false,
			shadeClose:false,
			content:'<div style="width:90%;margin-top:10px;" class="form-horizontal">'+
			'<div class="form-group"><label for="new_username" class="col-sm-4 control-label">新用户名：</label><div class="col-sm-8"><input type="text" class="form-control" id="new_username" placeholder="新用户名"></div></div>'+
			'<div class="form-group"><label for="password" class="col-sm-4 control-label">用户密码：</label><div class="col-sm-8"><input type="password" class="form-control" id="password" placeholder="用户密码"></div></div></div>'+
			'<div style="text-align:center;"><buttun class="btn btn-success" onclick="update_name()">确认修改</buttun></div>',
			
		});
    });
  });
	function edit_pass(){
		var password1 = $("#password1").val();
		var password2 = $("#password2").val();
		var password3 = $("#password3").val();
		if(password1.trim()==''){
			layer.tips('请输入旧密码', '#password1');
			$("#password1").val("");
			$("#password1").focus();
			return false;
		}
		if(password2.trim()==''){
			layer.tips('请输入新密码', '#password2');
			$("#password2").val("");
			$("#password2").focus();
			return false;
		}
		if(password3.trim()==''){
			layer.tips('请输入确认密码', '#password3');
			$("#password3").val("");
			$("#password3").focus();
			return false;
		}
		if(password3.trim()!=password2.trim()){
			layer.tips('两次密码不一致', '#password3');
			$('#password3').focus();
			return false;
		}
		$.post("<?php echo url('/admin/Pub/edit_password'); ?>", {password1:password1, password2:password2, password3:password3}, function(data){
			layer.closeAll('loading');
			if(data.status==1){
				layer.msg(data.info, {icon:1});
				setTimeout(function(){
					window.location.reload();
				},800);
			}else{
				layer.msg(data.info, {icon:0});
			}
		});
	}

	function update_name(){
		var username = $("#new_username").val();
		var password = $("#password").val();
		if(username.trim()==''){
			layer.tips('不能为空', '#new_username');
			$("#new_username").val("");
			$("#new_username").focus();
			return false;
		}
		if(password.trim()==''){
			layer.tips('输入密码', '#password');
			$("#password").val("");
			$("#password").focus();
			return false;
		}
		$.post("<?php echo url('/admin/Pub/edit_username'); ?>", {username:username, password:password}, function(data){
			// console.log(data);
			layer.closeAll('loading');
			if(data.status==1){
				layer.msg(data.info, {icon:1});
				setTimeout(function(){
					window.location.reload();
				},800);
			}else{
				layer.msg(data.info, {icon:0});
			}
		});
	}
</script>
</html>

<script type="text/javascript">
    $(function(){
        $("#_icon_4").iconChoosen({});

        $(document).on('click','.node',function(){
          if($('.item_sort')){
            $('.item_sort').remove();
          }
          var url = $(this).prev().val();
          alert(url);
          //if(/[\w\d]*\/[\w\d]*\/[\w\d]*/.test(url)){
          $.post('<?php echo url("getNode"); ?>',{link : url},function(data){
            $('#node_url').after(data);
          },'html');
          //}else{
             //$.alertMessager('请输入正确的链接格式','success');
          //}
        });

        $(document).on('change','.node_select',function(){
          var id = $(this).val();
//          alert(id);
          $.post('<?php echo url("node_change_select"); ?>',{id:id},function(data){
            var level = data.level;
            if(level == 1){
              $('input[name="module"]').val(data.name);
            }
            var nodeObj = $('.remove_node');
            //alert(nodeObj.length);
            for(var i = level;i<=3;i++){
              nodeObj.eq(i).remove();
            }
            nodeObj.eq(level - 1).after(data.htm_str);
          },'json');
        });

        $(document).on('click','.url',function(){
          var str = '';
          $.each($('select[name=node_id]>option:selected'),function(k,v){
            str +=$(this).text()+'/';
          });
          str = str.substring(0,str.length-1);
          $('input[name=url]').attr('value',str);     
        });

    });
</script>