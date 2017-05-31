<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"E:\WWW\blogNote\public/../application/user\view\customer\index.html";i:1493544956;s:66:"E:\WWW\blogNote\public/../application/user\view\Common\header.html";i:1493524770;s:66:"E:\WWW\blogNote\public/../application/user\view\Common\footer.html";i:1493524590;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>个人博客</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="__CSS__/admin.min.css">
    <link href="__CSS__/bootstrap.min.css?version=<?PHP echo date('Y-m-d H',time())?>" rel="stylesheet">
    <link href="__CSS__/user.css?version=<?PHP echo date('Y-m-d H:i:s',time())?>" rel="stylesheet">
    <link rel="shortcut icon" href="__PUBLIC__Faicon.ico" type="image/x-icon" />

</head>
<body>
<div class="hide-page"></div>
<!-- 导航栏 -->
<nav class="navbar navbar-default navbar-user" >
    <div class="container-fluid user-nav">
        <div class="navbar-header ">
            <a class="navbar-brand" href="">
                <img alt="Brand" src="__IMG__/user/log.jpg">
            </a>
        </div>
        <div class="navbar-music">
            <audio src="__STATIC__/media/tiankongzhicheng.mp3" autoplay controls loop></audio>
        </div>
        <div class="navbar-header pull-right">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo url('user/customer/index'); ?>"><span>首页</span><span class="en">Protal</span></a></li>
                <li><a href="#"><span>慢生活</span><span class="en">Life</span></a></li>
                <li><a href="#"><span>日志</span><span class="en">Note</span></a></li>
                <li><a href="#"><span>学无止境</span><span class="en">Learn</span></a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- 顶部导航栏结束 -->
<!-- 中部内容区域开始 -->
<div class="container-fluid">
<div class="banner">
    <div class="banner-inner">
        <ul>
            <p>生命就像一条大河</p>
            <p>时而迷茫，时而疯狂</p>
            <p>我要飞的更高</p>
        </ul>
        <div class="head-portrait pull-right">
            <a href=""><span>Linchen</span></a>
        </div>
    </div>
</div>
<div class="artle">
    <div class="article-header">
        <h4>
            <font color="#ff1493">文章列表</font>
        </h4>
    </div>
    <div class="artle-left col-sm-8" >
        <?php if(!(empty($article_list) || (($article_list instanceof \think\Collection || $article_list instanceof \think\Paginator ) && $article_list->isEmpty()))): if(is_array($article_list) || $article_list instanceof \think\Collection || $article_list instanceof \think\Paginator): $i = 0; $__LIST__ = $article_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div class="article_list">
            <label><font <?php if($vo[top] == '1'): ?>color="red"<?php endif; ?>><?php echo $vo['title']; ?></font></lable></label>
            <div>
                <div class="thumbimg">
                    <a href="#" class="thumbnail">
                        <img src="<?php echo $vo['thumb']; ?>" alt="...">
                    </a>
                </div>
                <ul class="descript">
                    <p><?php echo mb_substr($vo['descript'],0,200); ?></p>
                    <p class="pull-right"><a href="<?php echo url('article', array('id'=>$vo['id'])); ?>">阅读全文>></a></p>
                </ul>
            </div>
            <div class="article_bottom">
                <p>
                    <span><?php echo $vo['create_time']; ?></span>
                    <span>作者：<?php echo $vo['name']; ?></span>
                    <span>分类：<?php echo $vo['cname']; ?></span>
                </p>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; else: ?>
        <p>该人比较懒，还没有留下任何文章！</p>
        <?php endif; ?>
        <nav aria-label="Page navigation" class="text-center">
            <?php echo $article_list->render(); ?>
        </nav>
    </div>
    <div class="artle-rigt pull-right">
        <div class="weather">
            <iframe allowtransparency="true" frameborder="0" width="100%" height="96" scrolling="no" src="//tianqi.eastday.com/plugin/widget.html?sc=2&z=1&t=0&v=0&d=2&bd=0&k=000000&f=&q=1&a=1&c=59287&w=290&h=96&align=center"></iframe>
        </div>
        <div class="new-article">
            <div class="list-group">
                <a href="javascript:void (0)" class="list-group-item">最新文章</a>
                <?php if(is_array($new_article_list) || $new_article_list instanceof \think\Collection || $new_article_list instanceof \think\Paginator): $k = 0; $__LIST__ = $new_article_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                <a href="#" class="list-group-item"><?php echo $k; ?>、<?php echo $vo['title']; ?></a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>

</div>

<!-- 中部内容区域结束 -->
</div>

<div>
    <hr />
    <p class="text-center footer-font">CopyRight 2017/4/26 Linchen, Inc. All rights reserved.<br />粤ICP备16024761号</p>
</div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="__STATIC__/layer/layer.js"></script>
    <script type="text/javascript" src="__JS__/admin.min.js?version=<?PHP echo date('Y-m-d H',time())?>"></script>
    <script type="text/javascript" src="__JS__/admin.js?version=<?PHP echo date('Y-m-d H',time())?>"></script>
    <script type="text/javascript" src="__JS__/common.js?version=<?PHP echo time() ?>"></script>
  <!-- <script src="__JS__/bootstrap.min.js?version=<?PHP echo date('Y-m-d H',time())?>"></script> -->
  <!-- Include all compiled plugins (below), or include individual files as needed -->
</body>
</html>
