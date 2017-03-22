<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<title>宁波农本-商城</title>
		<meta name="author" content="" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/page-style.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/style.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/bootstrap.css" />
		<!--[if lt IE 9]><script src="http://nt1.268xue.com/static/common/html5.js?v=1484845237507"></script><![endif]-->
		<script src="/Public/Webmall/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
	</head>

	<body>
		<div class="header" id="home" style="  min-height:350px">
			<div class="container">
				<div class="header-top">
					<div class="top-menu">
						<span class="menu"><img src="/Public/Webmall/images/nav.png" alt=""/> </span>
						<ul>
							<li>
								<a href="<?php echo U('Index/index');?>">首页</a>
							</li><label>/</label>
							<li>
								<a href="<?php echo U('Academy/index');?>">跟我学</a>
							</li><label>/</label>
							<li>
								<a href="<?php echo U('Shop/shop');?>" class="active">商城</a>
							</li><label>/</label>
							<li>
								<a href="<?php echo U('Online/online');?>">在线监测</a>
							</li><label>/</label>
							<li>
								<a href="<?php echo U('Source/trace');?>">农产品溯源</a>
							</li><label>/</label>
							<li>
								<a href="<?php echo U('Info/news');?>">农业资讯</a>
							</li>
						</ul>
						<!-- script for menu -->

						<script>
							$("span.menu").click(function() {
								$(".top-menu ul").slideToggle("slow", function() {});
							});
						</script>
						<!-- //script for menu -->
					</div>
					<div class="clearfix"></div>

				</div>
				<div class="logo wow bounceIn animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;margin:5em auto 0;padding: 5px 0;border: 0;">
					<a href="index.html"><img src="/Public/Webmall/images/logo.png" width="80%" /></a>
				</div>
			</div>
		</div>
		<div>
			<div style="height:400px; padding:30px 0; text-align:center;">
				<img src="/Public/Webmall/images/guanwei.jpg"><br/>
				<h2>扫一扫，进入微信商城</h2>
			</div>
		</div>

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
				<script type="text/javascript">
					$(document).ready(function() {
						$().UItoTop({
							easingType: 'easeOutQuart'
						});

					});
				</script>
				<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
			</div>
		</div>

	</body>

</html>