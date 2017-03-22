<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>个人中心</title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/ucenter.css" />
		<!--[if lt IE 9]><script src="http://nt1.268xue.com/static/common/html5.js?v=1486227637308"></script><![endif]-->
	</head>

	<body class="W-body U-body">
		<header id="u-header">
			<section class="w1000">
				<div class="u-h-left">
					<section class="u-logo-slogn">
						<a href="index.html" title="" class="u-logo">
							<img src="/Public/Webmall/images/logo.png" alt="">
						</a>
						<span class="u-slogn" style="cursor: pointer;vertical-align: top;" onclick="location.href='personal.html'">
							<strong class="c-master">个人中心</strong>
						</span>
					</section>
					<nav class="u-nav ml10">
						<ul class="clearfix" id="userGuideInfo">
							<li>
								<a href="<?php echo U('Index/index');?>" title="首页">首页</a>
							</li>
							<li>
								<a href="<?php echo U('Academy/index');?>" title="跟我学">跟我学</a>
							</li>
							<li>
								<a href="<?php echo U('Shop/shop');?>" title="商城">商城</a>
							</li>
							<li>
								<a href="<?php echo U('Online/online');?>" title="在线监测">在线监测</a>
							</li>
							<li>
								<a href="<?php echo U('Info/trace');?>" title="农产品溯源">农产品溯源</a>
							</li>
							<li>
								<a href="<?php echo U('Info/news');?>" title="农业资讯">农业资讯</a>
							</li>
						</ul>
					</nav>
				</div>
				<div class="u-h-right">
					<section class="u-h-r-user">
						<div class="tar"> <span class="u-h-name-wrap">你好，</span><span class="u-h-name" id="unameheader"><?php echo ($user["username"]); ?></span><span class="pr"><tt id="msgCountId" class="undis tip-news pa"></tt><tt><a class="c-666" href="msg_my.html">消息</a></tt></span><span><a href="javascript:exit()" title="退出" class="c-666">退出</a></span> </div>
					</section>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</section>
		</header>
		<section class="u-banner">
			<a href="javascript:void(0)" onclick="skinChange();return false;" title="点击更换模板" class="u-tem-change"></a>
			<div id="uPosition">&nbsp;</div>
		</section>
		<section id="u-main">
			<menu class="u-m-left">
				<div class="u-elephant of">
					<aside class=""> <img id="userImgId" src="/Public/Webmall/images/user_default.jpg" height="100" width="100" alt="">
						<a href="http://nt1.268xue.com/uc/avatar.json" title="修改头像" class="c-fff">修改头像</a>
					</aside>
					<div class="u-elephant-bg"></div>
				</div>
				<section class="uMenuFixed">
					<div class="u-menu-head">
						<a href="personal.html" title="个人中心"> <em class="icon-2-18 u-m-icon-1">&nbsp;</em> <strong class="c-fff ml5 fsize18 vam">个人中心</strong> </a>
					</div>
					<div class="u-menu-list">
						<dl id='leftdl_course'>
							<dt><em class="icon-2-18 u-m-icon-8">&nbsp;</em><span class="c-333 ml10 fsize16 vam">我的课程</span><em class="icon-2-14 u-up-down ml15">&nbsp;</em></dt>
							<dd>
								<ol>
									<li class="current">
										<a href="personal.html" title="学习记录">学习记录</a>
									</li>
									<li>
										<a href="collect.html" title="我的收藏">我的收藏</a>
									</li>
								</ol>
							</dd>
						</dl>
						<dl id="leftdl_sns">
							<dt><em class="icon-2-18 u-m-icon-6">&nbsp;</em><span class="c-333 ml10 fsize16 vam">我的消息</span><em class="icon-2-14 u-up-down ml15">&nbsp;</em></dt>
							<dd>
								<ol>
									<li>
										<a href="msg_sys.html" title="我的消息">我的消息</a>
									</li>
								</ol>
							</dd>
						</dl>
						<dl id="leftdl_account">
							<dt class="curr"><em class="icon-2-18 u-m-icon-5">&nbsp;</em><span class="c-333 ml10 fsize16 vam">个人信息</span><em class="icon-2-14 u-up-down ml15">&nbsp;</em></dt>
							<dd style="display: block;">
								<ol>
									<li>
										<a class="c-blue" href="info.html" title="个人信息">个人信息</a>
									</li>
									<li>
										<a href="changeEmail.html" title="更换邮箱/手机号">更换邮箱绑定</a>
									</li>
									<li>
										<a href="statistic.html" title="学习统计">学习统计</a>
									</li>
								</ol>
							</dd>
						</dl>
					</div>
				</section>
				<input type="hidden" id="ctx" value="http://nt1.268xue.com">
			</menu>

			<div class="clearfix">
				<article class="u-m-c-w837 u-m-center">
					<section class="u-m-c-wrap">
						<section class="u-m-c-head">
							<ul class="fl u-m-c-h-txt">
								<li class="current">
									<a href="" title="">个人信息</a>
								</li>
							</ul>
							<div class="clear"></div>
						</section>
						<section class="line1">
							
							<form action="http://nt1.268xue.com/cus/uc!updatequeryUser.action" method="post" id="updateUserForm">
								<div class="mt50">
									<input type="hidden" value="<?php echo ($user["id"]); ?>" name="id">
									<ol class="u-account-set">
										<li> <span class="vam u-a-lab">用户名：</span> <label class="u-a-txt"> <input id="email" name="username" type="text" maxlength="50" value="<?php echo ($user["username"]); ?>" disabled=""> </label> </li>
										<li> <span class="vam u-a-lab">昵称：</span> <label class="u-a-txt"><input type="text" maxlength="50" name="name" id="nickname" value="<?php echo ($user["name"]); ?>"></label> </li>
										<li> <span class="vam u-a-lab">性别：</span>
											<label class="c-666"><input type="radio" name="sex" id="gender1" value="1" checked="checked" placeholder="" style="margin: 0 0 0 10px;"> 男</label>
											<label class="c-666"><input type="radio" name="sex" id="gender0" value="0" placeholder="" style="margin: 0 0 0 10px;"> 女</label>
										</li>
										<li> <span class="vam u-a-lab">个人简介：</span> <textarea style="height:200px;width: 80%;" class="vam" name="description" maxlength="500" re="" id="userInfo"><?php echo ($user["description"]); ?></textarea> </li>
										<li class="mt40"> <span class="vam u-a-lab">&nbsp;</span> <span class="vam ml50"> <label class="u-a-set-btn"><input type="button" onclick="formsubmit()" value="保 存"></label> </span> </li>
									</ol>
								</div>
							</form>
						</section>
					</section>
				</article>
			</div>
		</section>
		<!-- /尾部-->
		<div class="footer-section" style="padding: 2em 0;text-align: center;background: #fff;border-top: 1px solid #eee;">
			<div class="container">
				<div class="footer-top">
					<div style="text-align:center;">
						<a href="#"><img src="/Public/Webmall/images/logo1.png"></a>
					</div>
				</div>
				<div class="footer-bottom wow bounceInRight animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<p>Copyright &copy; 2016 www.nbnb.net.cn</p>
				</div>
			</div>
		</div>
		<!-- /尾部 结束-->
		<script src="/Public/Webmall/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/Public/Webmall/js/webutils.js" type="text/javascript" charset="utf-8"></script>
		<script src="/Public/Webmall/js/pageJs.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(function() {
				$(".u-menu-list>dl>dt").each(function() {
					var _this = $(this);
					_this.click(function() {
						if(_this.next("dd").is(":hidden")) {
							_this.addClass("curr");
							_this.next("dd").slideDown(100);
							_this.parent().siblings("dl").children("dt").removeClass("curr");
							_this.parent().siblings("dl").children("dd").slideUp(100);
						} else {
							_this.removeClass("curr");
							_this.next("dd").slideUp(100);
							_this.parent().next("dl").children("dt").addClass("curr");
							_this.parent().next("dl").children("dd").slideDown(100);
						}
					});
				});
			});
			/**
			 * 修改信息 弹窗用一下后台的吧
			 */
			function formsubmit() {
				var data = $("#updateUserForm").serialize();
				console.log(data);
			    //验证
				var a={};
				data.split('&').forEach(function (item) {
					item = item.split('=');
					a[item[0]] = item[1];
				});
			    console.log(a);

				if(isNotEmpty(a['name']) == false){
					dialog('提示','请输入昵称',1);
					return;
				}

			    $.ajax({
			        url: baselocation + 'editInfo',
			        type: 'post',
			        dataType: 'json',
			        data: data,
			        success: function (result) {
			            if (result.state=='success') {
							dialog('提示', '修改成功', 6, 'javascript:window.location.reload()');
							$(".u-h-name").html(result.jumpUrl);
			            } else {
			                dialog('提示', result.message, 1);
			            }
			        }
			    });
			}

		</script>
	</body>

</html>