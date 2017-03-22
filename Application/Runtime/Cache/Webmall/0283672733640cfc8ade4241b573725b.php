<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<title>宁波农本-资讯</title>
		<meta name="author" content="" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/common.css"/>
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/page-style.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/style.css"/>
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
				<div class="logo wow bounceIn animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;margin:5em auto 0;padding: 5px 0;border: 0;">
					<a href="index.html"><img src="/Public/Webmall/images/logo.png" width="80%"/></a>
				</div>
			</div>
		</div>
		<div id="SL-container" class="mb50">
			<section class="w1000">
				<div class="mt40">
					<section class="article-pic-wrap">
						<ul class="clearfix">
							<li class="article-pic article-bigPic">
								<a href="<?php echo U('detail',array('id'=>96));?>" title="农产品电商问题在哪？出路又在哪？"><img src="/Public/uploads/Admin/image/20170302/20170302163650.jpg" alt="农产品电商问题在哪？出路又在哪？"></a>
								<a href="<?php echo U('detail',array('id'=>96));?>" title="农产品电商问题在哪？出路又在哪？">
									<section class="article-pic-title-wrap">
										<div class="article-pic-title"> <span>农产品电商问题在哪？出路又在哪？</span> </div>
									</section>
								</a>
							</li>
							<li class="article-pic">
								<a href="<?php echo U('detail',array('id'=>84));?>" title="肥料圈十大热点议题"><img src="/Public/uploads/Admin/image/20170302/20170302154606.jpg" ></a>
								<a href="<?php echo U('detail',array('id'=>84));?>" title="肥料圈十大热点议题">
									<section class="article-pic-title-wrap">
										<div class="article-pic-title"> <span>肥料圈十大热点议题</span> </div>
									</section>
								</a>
							</li>
							<li class="article-pic">
								<a href="<?php echo U('detail',array('id'=>95));?>" title="夏季使用拖拉机十个要点需注意"><img src="/Public/uploads/Admin/image/20170302/20170302163134.jpg" ></a>
								<a href="<?php echo U('detail',array('id'=>95));?>" title="夏季使用拖拉机十个要点需注意">
									<section class="article-pic-title-wrap">
										<div class="article-pic-title"> <span>夏季使用拖拉机十个要点需注意</span> </div>
									</section>
								</a>
							</li>
							<li class="article-pic">
								<a href="<?php echo U('detail',array('id'=>85));?>" title="推广玉米新品种这些方法最有效"> <img src="/Public/uploads/Admin/image/20170302/20170302154929.jpg" alt="推广玉米新品种这些方法最有效" /> </a>
								<a href="<?php echo U('detail',array('id'=>85));?>" title="推广玉米新品种这些方法最有效">
									<section class="article-pic-title-wrap">
										<div class="article-pic-title"> <span>推广玉米新品种这些方法最有效</span> </div>
									</section>
								</a>
							</li>
							<li class="article-pic">
								<a href="<?php echo U('detail',array('id'=>97));?>" title="生物有机肥如何辨真伪"><img src="/Public/uploads/Admin/image/20170302/20170302164303.jpg" alt="生物有机肥如何辨真伪"></a>
								<a href="<?php echo U('detail',array('id'=>97));?>" title="生物有机肥如何辨真伪">
									<section class="article-pic-title-wrap">
										<div class="article-pic-title"> <span>生物有机肥如何辨真伪</span> </div>
									</section>
								</a>
							</li>
						</ul>
					</section>
				</div>
				<div class="mt20">
					<section class="clearfix">
						<aside class="fr w300">
							<div>
								<section class="c-infor-tabTitle c-tab-title of">
									<a class="current" target="">热门资讯</a>
								</section>
								<section class="hot-news-list">
									<ol>
										<?php if(is_array($hotInfo)): foreach($hotInfo as $key=>$hotInfo): ?><li>
												<a href="<?php echo U('detail',array('id'=>$hotInfo['id']));?>" title="<?php echo ($hotInfo['title']); ?>">
													<img class="h-news-list-img" width="90" height="51" xSrc="<?php echo U('detail',array('id'=>$hotInfo['id']));?>" src="<?php echo ($hotInfo['path']); ?>" alt="<?php echo ($hotInfo['title']); ?>"> </a>
												</a>
												<h6 class="a-l-desc-txt"><a href="<?php echo U('detail',array('id'=>$hotInfo['id']));?>" title="<?php echo ($hotInfo['title']); ?>" class="fsize16 c-666"><?php echo ($hotInfo['title']); ?></a></h6> </li><?php endforeach; endif; ?>
									</ol>
								</section>
							</div>
							<?php if(empty($hotInfo)): ?><div class="artic-index-box-tit">
									<div class="mt20">
										<section class="comm-tips-1">
											<p> <em class="vam c-tips-1"> </em>
												<font class="c-999 fsize12 vam">暂无任何资讯. . .</font>
											</p>
										</section>
										<div class="clear"></div>
										<div class="mt30 u-n-i-wrap">
											<div class="clear"></div>
										</div>
									</div>
								</div><?php endif; ?>

						</aside>
						<article class="fl" style="width: 68%;">
							<section class="mb50">
								<div style="margin-top: -10px;">
									<ul class="article-list-wrap article-list-ul">
										<?php if(is_array($info)): foreach($info as $key=>$info): ?><li>
												<a class="aPlot" title="<?php echo ($info["title"]); ?>" href="<?php echo U('detail',array('id'=>$info['id']));?>"> <img alt="<?php echo ($info["title"]); ?>" height="75" width="134" xsrc="<?php echo U('detail',array('id'=>$info['id']));?>" src="<?php echo ($info["path"]); ?>"> </a>
												<h5 class="hLh30 of unFw"><a title="<?php echo ($info["title"]); ?>" href="<?php echo U('detail',array('id'=>$info['id']));?>" class="c-333 fsize20 vam"><?php echo ($info["title"]); ?></a> </h5>
												<div class="a-l-desc-txt"><?php echo ($info["description"]); ?></div>
												<section class="of mt10"> <span class="c-999 vam disIb" title="时间"><em class="icon14 a-time"> &nbsp;</em><?php echo ($info["gmt_create"]); ?></span> <span class="disIb c-999 vam ml50" title="查看"><em class="icon14 a-read"> &nbsp;</em> <?php echo ($info["count"]); ?>人</span> </section>
											</li><?php endforeach; endif; ?>
									</ul>
								</div>
							</section>
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