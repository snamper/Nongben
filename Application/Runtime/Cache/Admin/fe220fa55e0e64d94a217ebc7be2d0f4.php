<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html style="height:100%; overflow: hidden">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>欢迎登录后台管理系统</title>
    <link href="/Public/Admin/css1/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/Admin/css1/datepicker3.css" rel="stylesheet">
    <link href="/Public/Admin/css1/styles.css" rel="stylesheet">
</head>

<body>
<div class="header">
    
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/Admin/Index/index.html"><span>农本</span>后台管理系统</a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo ($managerData["name"]); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> 帮助</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-cog"></span> 设置</a></li>
                        <li><a href="<?php echo U('public/logout');?>"><span class="glyphicon glyphicon-log-out"></span> 退出</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

</div>


<!--左边导航区-->
    
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="搜索">
        </div>
    </form>
    <ul class="nav menu">
        <li class="active"><a><span class="glyphicon glyphicon-dashboard"></span>后台菜单</a></li>
        <li class="parent ">
            <a href="#">
                <span class="glyphicon glyphicon-list"></span> 系统管理 <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li>
                    <a class="leftmenu" href="/Admin/Source/index.html" target="rightFrame" data-value="系统管理 -> 溯源系统">
                        <span class="glyphicon glyphicon-share-alt"></span> 溯源系统
                    </a>
                </li>
                <li>
                    <a class="" href="#">
                        <span class="glyphicon glyphicon-share-alt"></span> 在线监测
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent ">
            <a href="#">
                <span class="glyphicon glyphicon-list"></span> 资讯管理 <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li>
                    <a class="leftmenu" href="/Admin/Info/index.html" target="rightFrame" data-value="资讯管理 -> 文章管理">
                        <span class="glyphicon glyphicon-share-alt"></span> 文章管理
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent ">
            <a href="#">
                <span class="glyphicon glyphicon-list"></span> 跟我学 <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-3">
                <li>
                    <a class="leftmenu" href="/Admin/User/index.html" target="rightFrame" data-value="跟我学 -> 用户管理">
                        <span class="glyphicon glyphicon-share-alt"></span> 用户管理
                    </a>
                </li>
                <li>
                    <a class="leftmenu" href="/Admin/Category/index.html" target="rightFrame" data-value="跟我学 -> 分类管理">
                        <span class="glyphicon glyphicon-share-alt"></span> 分类管理
                    </a>
                </li>
                <li>
                    <a class="leftmenu" href="/Admin/Course/index.html" target="rightFrame" data-value="跟我学 -> 课程管理">
                        <span class="glyphicon glyphicon-share-alt"></span> 课程管理
                    </a>
                </li>
                <li>
                    <a class="leftmenu" href="/Admin/Advertisement/index.html" target="rightFrame" data-value="跟我学 -> 广告管理">
                        <span class="glyphicon glyphicon-share-alt"></span> 广告管理
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div><!--/.sidebar-->

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active_top">首页</li>
        </ol>
    </div>
<div class="mainn" data-href="<?php echo U('main');?>" style="height: 100%">
</div>

</body>

<script src="/Public/Admin/js1/jquery-1.11.1.min.js"></script>
<script src="/Public/Admin/js1/bootstrap.min.js"></script>
<script>
    var defaulhref = $('.mainn').data('href');
    var iframeAttr = {
        src: defaulhref,
        id: 'iframepage',
        frameborder: '0',
        scrolling: 'auto',
        width: '100%',
        height: '100%'
    };
    $('.mainn iframe').remove();
    var iframe = $('<iframe/>').prop(iframeAttr).appendTo('.mainn');

    //点击菜单加载iframe
    $('.leftmenu').on('click',function(e){
        e.preventDefault();
        e.stopPropagation();
        var $this = $(this),id = $this.attr('data-id');
        var href = this.href;

        var iframeAttr = {
            src: href,
            id: 'iframepage',
            frameborder: '0',
            scrolling: 'auto',
            width: '100%',
            height: '100%'
        };
        $('.mainn iframe').remove();
        var iframe = $('<iframe/>').prop(iframeAttr).appendTo('.mainn');
        $('.active_top').html($(this).attr('data-value'));
    });
</script>


</html>