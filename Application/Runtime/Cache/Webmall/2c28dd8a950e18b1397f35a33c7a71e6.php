<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta content="zh-CN" http-equiv="Content-Language" />
		<meta name="description" content="农产品及食品溯源服务平台(www.qs360.com)" />
		<meta name="keywords" content="食品安全,第三方,qs,qs360,360,物联网技术,产品服务,安全监管,b2b,电子商务,智能物流,溯源,网商,服务" />
		<title>农本-农产品溯源</title>
		
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/style.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/sy.css" />
		<script src="/Public/Webmall/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
	</head>

	<body>
		<div class="header" id="home" style="  min-height:440px">
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
								<a href="<?php echo U('Shop/shop');?>">商城</a>
							</li><label>/</label>
							<li>
								<a href="<?php echo U('Online/online');?>">在线监测</a>
							</li><label>/</label>
							<li>
								<a href="<?php echo U('Source/trace');?>" class="active">农产品溯源</a>
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
				
					<div class="banner_c">
						<h2 class="sy">欢迎使用农本溯源平台！</h2>
						<div class="sy_search_box">
							<span style="text-align: center; color: red; font-size: 12px;" id="spanTip"></span>
							<input id="j_q" class="sy_num" name="tracesource" type="text" placeholder="请输入您的溯源码" onkeypress="if(event.keyCode==13){ event.returnValue = false;document.getElementById('btnSubmit').click();}" /><input class="sy_search_btn" id="btnSubmit" onclick="submitFn();" value="马上追溯" type="button" />
						</div>
					</div>
				
			</div>
		</div>
		<div class="sy_container">
			<h2 id="steps_1" class="sy_case_title">案例展示<em>(记得用手机扫描二维码哦(*^__^*))</em>
        </h2>
			<ul class="case_ul" id="ProductsList">
				<?php if(is_array($list)): foreach($list as $key=>$list): ?><li>
						<img src="<?php echo ($list["logo_path"]); ?>" width="270" height="190">
						<h3 class="name"><?php echo ($list["source"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($list["name"]); ?></h3><span class="black_cover" style="display: none;"></span>
						<span class="scan_code" style="top: -154px;"><img style="width: 154px; height: 154px;" src="<?php echo ($list["code_path"]); ?>"></span>
						<span class="scan_icon"></span>
					</li><?php endforeach; endif; ?>
				</ul>
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
						/*
						 var defaults = {
						 containerID: 'toTop', // fading element id
						 containerHoverID: 'toTopHover', // fading element hover id
						 scrollSpeed: 1200,
						 easingType: 'linear'
						 };
						 */

						$().UItoTop({
							easingType: 'easeOutQuart'
						});

					});
				</script>
				<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
			</div>
		</div>
		<script>
			var $caseLi = $(".case_ul li");
			$caseLi.each(function(i) {
				$caseLi.eq(i).hover(function() {
					$(this).children(".black_cover").stop(false, true).fadeIn(150);
					$(this).children("h3").addClass("hover");
					$(this).children(".scan_code").stop(false, true).animate({
						top: "0"
					}, 190);
					$(this).children(".scan_icon").addClass("scan_icon_hover");
				}, function() {
					$(this).children(".black_cover").stop(false, true).fadeOut(150);
					$(this).children("h3").removeClass("hover");
					$(this).children(".scan_code").stop(false, true).animate({
						top: "-154px"
					}, 190);
					$(this).children(".scan_icon").removeClass("scan_icon_hover");
				})
			});
		</script>
	</body>

</html>