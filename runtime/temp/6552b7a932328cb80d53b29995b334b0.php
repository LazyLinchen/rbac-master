<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:71:"E:\WWW\blogNote\public/../application/admin\view\access\changerole.html";i:1492681220;s:67:"E:\WWW\blogNote\public/../application/admin\view\Common\header.html";i:1493112829;s:65:"E:\WWW\blogNote\public/../application/admin\view\Common\left.html";i:1492681434;s:67:"E:\WWW\blogNote\public/../application/admin\view\Common\footer.html";i:1492764109;}*/ ?>
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
    <div class="panel panel-success">
      <div class="panel-body">
        <form action="__SELF__" method="post" class="builder-form">
        <table class="table table-striped table-bordered text-left">
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
          <tr><td class="text-left"><input type="checkbox" class="checkboxys" cid="<?php echo $v['id']; ?>" level="<?php echo $v['level']; ?>" value="<?php echo $v['id']; ?>:<?php echo $v['level']; ?>:<?php echo $v['pid']; ?>" pid="<?php echo $v['pid']; ?>" name="data[]" />&nbsp;<b>[项目]</b>&nbsp;<?php echo $v['title']; ?></td></tr>
          <?php if(is_array($v[data]) || $v[data] instanceof \think\Collection || $v[data] instanceof \think\Paginator): $i = 0; $__LIST__ = $v[data];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr><td class="text-left" style="padding-left: 30px;"><input type="checkbox" cid="<?php echo $vo['id']; ?>" level="<?php echo $vo['level']; ?>" value="<?php echo $vo['id']; ?>:<?php echo $vo['level']; ?>:<?php echo $vo['pid']; ?>" pid="<?php echo $vo['pid']; ?>" class="checkboxys" name="data[]" />&nbsp;<b>[模块]</b>&nbsp;<?php echo $vo['title']; ?></td></tr>
              <tr>
                <td class="text-left" style="padding-left: 60px;">
                <?php if(is_array($vo[data]) || $vo[data] instanceof \think\Collection || $vo[data] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo[data];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?>
                  <li style="list-style: none; float: left;margin-right: 15px;"><input type="checkbox" cid="<?php echo $voo['id']; ?>" level="<?php echo $voo['level']; ?>" pid="<?php echo $voo['pid']; ?>" class="checkboxys" value="<?php echo $voo['id']; ?>:<?php echo $voo['level']; ?>:<?php echo $voo['pid']; ?>" name="data[]" />&nbsp;<?php echo $voo['title']; ?></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </td>
              </tr>
          <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        </form>
        <div class="col-sm-10">
             
             <button type="submit" class="btn ajax-post btn-primary button-width" target-form="builder-form">确定</button>

             <button class="btn btn-primary button-width reset">重置</button>

             <button class="btn btn-primary button-width qk">清空</button>

             <button onclick="javascript:history.back();" class="btn btn-success button-width">返回</button>
          </div>
        </div>
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

      /*初始化复选框*/
      function initCheckbox(){
        $(".checkboxys").prop("checked", false);
        var access = JSON.parse('<?php echo $access; ?>');
        if(access.length>0){
          for (var i = 0; i < access.length; i++) {
            $("input[cid="+access[i]['node_id']+"]").prop("checked", true);
          }
        }
      }

      initCheckbox();

      /*向下选定复选框或取消选定*/
      function chm(cid, status){
          $("input[pid="+cid+"]").each(function(){
              $(this).prop("checked", status);
              cid = $(this).attr("cid");
              chm(cid, status);
          });
      }

      /*向上选定复选框*/
      function chu(pid){
        $("input[cid="+pid+"]").each(function(){
          $(this).prop("checked", true);
          pid = $(this).attr('pid');
          if(pid<1){
            return ;
          }
          chu(pid);
        });
      }

      $(".checkboxys").change(function(){
          if($(this).is(":checked")){
            chm($(this).attr("cid"), true);
          }else{
            chm($(this).attr("cid"), false);
          }
          if($(this).attr('level')==3){
            if($(this).is(":checked")){
              chu($(this).attr('pid'));
            }
          }
          if($(this).attr('level')==2){
            if($(this).is(":checked")){
              chu($(this).attr('pid'));
            }
          }
      });

      //重置到最初状态，以防错误选择
      $(".reset").click(function(){
        initCheckbox();
      });

      //清空以选择的复选框
      $(".qk").click(function(){
        $(".checkboxys").attr("checked", false);
      });
  });

</script>