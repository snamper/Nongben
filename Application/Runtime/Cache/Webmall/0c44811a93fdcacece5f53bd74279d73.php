<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<title>宁波农本-资讯详情</title>
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

	<body class="W-body">
		<div class="header" id="home" style="min-height:200px">
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
								<a href="<?php echo U('Source/trace');?>">农产品溯源</a>
							</li><label>/</label>
							<li>
								<a href="<?php echo U('Info/news');?>" class="active">农业资讯</a>
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
				
			</div>
		</div>
		<div class="mb50">
			<section class="w1000" style="width:990px">
				<div class="mt20">
					<section class="clearfix">
						
						<article class="fl w650" style="width:100%;">
							<div class="">
								<div class="pathwray" style="height: 46px;">
									<ol class="clearfix c-master f-fM fsize14">
										<li>
											<a class="c-master" title="首页" href="/">首页</a>
											&gt;
										</li>
										<li>
											<a class="c-master" title="首页" href="/Webmall/Info/news.html">资讯首页</a>
											&gt;
										</li>
										<li><span>资讯详情</span></li>
									</ol>
								</div>
							</div>
							<section class="pb20 mt30">
								<h2 class="tac unFw"><font class="fsize20 c-4e f-fM"><?php echo ($info["title"]); ?></font></h2>
								<div class="mt5 mb5 tac"><span title="时间" class="c-999 vam disIb"> <em class="icon14 a-time">&nbsp;</em> <?php echo ($info["gmt_create"]); ?></span>
									<span title="查看" class="disIb c-999 vam ml20"> <em class="icon14 a-read">&nbsp;</em> <?php echo ($info["count"]); ?>人</span>
									<span title="268xue" class="disIb c-999 vam ml20">作者：<?php echo ($info["author"]); ?></span>
								</div>
							</section>
							<div>
								<div class="articleText c-666">
									<?php echo (htmlspecialchars_decode($info["content"])); ?>
								</div>
							</div>
							<div class="share-article mt30">
								<div class="fr"><span class="fl fsize16 f-fM c-666 dis hLh30">分享到：</span>
									<div class="fl">
										<div class="bdsharebuttonbox bdshare-button-style0-16" data-bd-bind="1486191588016">
											<a href="#" class="bds_more" data-cmd="more"></a>
											<a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a>
											<a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a>
											<a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a>
											<a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a>
											<a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a>
										</div>
										<script>
											window._bd_share_config = {
												"common": {
													"bdSnsKey": {},
													"bdText": "",
													"bdMini": "2",
													"bdMiniList": false,
													"bdPic": "",
													"bdStyle": "0",
													"bdSize": "16"
												},
												"share": {}
											};
											with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
										</script>
									</div>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</div>
							<ul class="c-666 upDownBar mt20 pt20">
								<li>
									<?php if(!empty($pre)): ?><span>上一篇：</span>
										<a class="c-4e" href="<?php echo U('detail',array('id'=>$pre['id']));?>"><?php echo ($pre["title"]); ?></a>
										<?php else: endif; ?>
								</li>
								<li class="mt20">
									<?php if(!empty($next)): ?><span>下一篇：</span>
										<a class="c-4e" href="<?php echo U('detail',array('id'=>$next['id']));?>"><?php echo ($next["title"]); ?></a>
										<?php else: endif; ?>
								</li>
							</ul>
						</article>
					</section>
				</div>
			</section>
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
	</body>

</html>