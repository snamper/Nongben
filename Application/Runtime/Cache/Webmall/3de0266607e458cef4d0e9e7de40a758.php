<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<title>课程详情</title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/page-style.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/cColor.css" />
		<link rel="stylesheet" href="/Public/Webmall/css/zy.media.css">
		<!--[if lt IE 9]><script src="http://nt1.268xue.com/static/common/html5.js?v=1486400438591"></script><![endif]-->
		<script src="/Public/Webmall/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
		<style>
			textarea {
				resize: none;
			}
		</style>
	</head>

	<body class="W-body">
	<div class="topBarWrap" style="font-size: 12px;">
		<div class="w1000">
			<section class="cleafix">
				<ul class="t-link c-ccc fr">
					<?php if(!empty($user)): ?><li class="userNameLi"><tt class="c-666 vam">欢迎你</tt></li>
						<li class="userNameLi">
							<a href="<?php echo U('Personal/personal');?>">
								<img src="/Public/Webmall/images/user_default.jpg" id="cusImg" width="24" height="24" class="vam"><tt class="c-666 ml5 cusName"><?php echo ($user["username"]); ?></tt>
							</a>|
						</li>
						<li class="outLi">
							<a href="<?php echo U('User/logout');?>" title="退出">退出</a>
						</li>
						<?php else: ?>
						<li class="loginLi">
							<a href="<?php echo U('User/login');?>" title="登录">登录</a>|</li>
						<li class="registerLi">
							<a href="<?php echo U('User/register');?>" title="注册">注册</a>|</li>
						<li class="forgetPasswordLi">
							<a href="<?php echo U('User/forget');?>" title="忘记密码">忘记密码</a>
						</li><?php endif; ?>
				</ul>
			</section>
		</div>
	</div>
	<!-- 公共头引入 -->
	<!-- /公共头 -->
	<header id="header" class="png">
		<section class="head-wrap">
			<section class="w1000">
				<h1 class="logo-wrap"><a href="index.html" title="宁波农本" class="png"><img width="100%" src="/Public/Webmall/images/logo.png"/></a></h1>
				<div>
					<section class="topSearchWrap">
						<div class="tsTabCont t-s-box">

							<section class="tsTabContInp">
								<input id="searchInput" type="text" onkeyup="enterSubmit(event,'getSearch()')" placeholder='今天你想学什么课程？' x-webkit-speech="" class="tscInp" value="" />
								<a href="javascript:void(0);" onclick="getSearch()" class="tscBtn">搜 索</a>
							</section>
							<form id="formSearch" method="post">
								<input id="searchName" type="hidden" name="queryCourse.name" value="" />
							</form>
						</div>
					</section>
					<section class="top-link pr">
						<div class="mt30">
							<section class="my-course-wrap">
								<aside class="aMyCourBox fl pr aMyCourBox2" name="aMyCourBox2">
									<?php if(empty($user)): ?><a href="#" class="shopCar hand pr" style="overflow:inherit;" title="个人中心">
											<em class="icon24">&nbsp;</em><tt class="vam f-fM">个人中心</tt>
										</a>
										<div class="m-c-box shopCar-box undis">
											<section class="pr m-c">
												<span class="pa white-bg">&nbsp;</span>
												<div id="notLogin" class="tac">
													<em class="c-tips-2 icon24">&nbsp;</em>
													<font class="c-999 fsize12 vam">
														对不起，你还没有
														<a href="<?php echo U('User/Login');?>" title="登录" class="c-master ml5">登录</a>
													</font>
												</div>
											</section>
										</div>
										<?php else: ?>
										<a href="<?php echo U('Personal/personal');?>" class="shopCar hand pr" style="overflow:inherit;" title="个人中心">
											<em class="icon24">&nbsp;</em><tt class="vam f-fM">个人中心</tt>
										</a><?php endif; ?>

								</aside>

								<div class="clear"></div>
							</section>
						</div>
					</section>

					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</section>
		</section>
		<div class="hNavWrap">
			<section class="w1000 clearfix">
				<ul class="hNav fl" id="guideInfo">
					<!-- current -->
					<li>
						<a href="<?php echo U('Index/index');?>" title="首页">首页
						</a>
					</li>
					<li>
						<a href="<?php echo U('Academy/index');?>" title="跟我学">跟我学
						</a>
					</li>
					<li>
						<a href="<?php echo U('Shop/shop');?>" title="商城">商城
						</a>
					</li>
					<li>
						<a href="<?php echo U('Online/online');?>" title="在线监测">在线监测
						</a>
					</li>
					<li>
						<a href="<?php echo U('Source/trace');?>" title="农产品溯源">农产品溯源
						</a>
					</li>
					<li>
						<a href="<?php echo U('Info/news');?>" title="农业资讯" target="_blank">农业资讯
						</a>
					</li>

				</ul>
			</section>
		</div>
	</header>
	<!-- 公共头引入 -->

		<input id="playId" type="hidden" value="300" />
		<div class="pr">
			<section class="course-infor-wrap">
				<div class="w1000">
					<div class="pt10">
						<div class="zy_media">
						    <video id="myvideo">
						        <source src="<?php echo ($course["path_video"]); ?>" type="video/mp4">
						        您的浏览器不支持HTML5视频
						    </video>
						</div>
					</div>
				</div>
			</section>
		</div>
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
		<script src="/Public/Webmall/js/index.js" type="text/javascript" charset="utf-8"></script>
		<script src="/Public/Webmall/js/zy.media.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			var video  =  document.getElementById('myvideo');
			var currentTime;
			if(localStorage.getItem("currentTime")) {
				currentTime = parseInt(localStorage.getItem("currentTime"));
			}
			window.onload = function() {
				zymedia('video',{
					watchTime:currentTime
				});
				video.currentTime = currentTime;
			};
			video.addEventListener("timeupdate",function(){
				var currentT = video.currentTime;
				var ok = currentT/video.duration;
				if(ok>=0.3){
					console.log("ok");
					return false;
				}else{
					console.log("no");
				}
			});
			window.onunload = function(){
				localStorage.setItem("currentTime", video.currentTime);
			}
		</script>
		<script type="text/javascript">
			$(".expandClass").click(function () {
		        $(".expandClass").removeClass('current');
		        $(this).addClass('current');
		        var id = $(this).attr('lang');
		        if (id != 'house') {
		            $(".publicClass").hide();
		            $("#" + id).css('display', '');
		        }
		    });
		</script>
	</body>

</html>