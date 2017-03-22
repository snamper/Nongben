<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<title>宁波农本-跟我学</title>
		<!--<meta name="author" content="268教育(www.268xue.com)" />
		<meta name="keywords" content="268教育,在线教育,网校搭建,网校,网络教育,远程教育,云网校,在线学习,在线考试" />
		<meta name="description" content="268在线教育是一家专注“在线教育平台”的互联网公司，在国内属顶级在线教育解决方案提供商中的领跑者。为大、中型客户提供领先的在线教育平台方案服务。" />-->
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/page-style.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/i_temp.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/cColor.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/theme.css" />
		<!--[if lt IE 9]><script src="http://nt1.268xue.com/static/common/html5.js?v=1486141236265"></script><![endif]-->
		<script src="/Public/Webmall/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>

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

		<div id="SL-container">
			<div id="tempOne">
				<div class="" name="to-2">
					<div class="b-f8 pt20 pb30">
						<div class="iContainer">
							<menu class="w240 fl pr isMenu">
								<div class="b-fff i-item-menu">
									<div class="i-fbg-title pt15"><span class="fsize18 c-333">全部视频</span></div>
									<div class="i-items">
										<?php if(is_array($category)): foreach($category as $key=>$category): ?><section class="i-j-item">
												<div class="i-j-item-bx">
													<div class="DT-arrow"><em>◆</em><span>◆</span></div>
													<input type="hidden" value="<?php echo ($category["id"]); ?>" name="id">
													<a href="javascript: void(0)" class="i-j-item-first-a"><?php echo ($category["name"]); ?></a>
												</div>
											</section><?php endforeach; endif; ?>
										<section class="i-j-item last-i-j-item">
											<div class="i-j-item-bx">
												<span class="c-more pa"><a href="#" title="更多类别">&nbsp;</a></span>
												<a href="#" class="i-j-item-first-a">更多类别</a>
											</div>
										</section>
									</div>
								</div>
								<div class="j-cateright j-cateright-op">

									<?php if(is_array($cat)): foreach($cat as $key=>$category): ?><section class="j-cateright-wrap undis">

											<div class="hLh30 txtOf">
												<a href="<?php echo U('Academy/course',array('id'=>$category['id']));?>" title="<?php echo ($category["name"]); ?>" class="c-master fsize18"><?php echo ($category["name"]); ?></a>
											</div>
										<div class="v-i-tab-a">
											<?php if(is_array($category['child'])): foreach($category['child'] as $key=>$child): ?><a href="<?php echo U('Academy/course',array('id'=>$child['id']));?>"><?php echo ($child["name"]); ?></a><?php endforeach; endif; ?>
										</div>

									</section><?php endforeach; endif; ?>

								</div>
							</menu>
							<div class="fl">
								<section class="i-middle-cont fl">
									<div class="ml20 mr20">
										<div class="i-m-c-slider">
											<!-- /幻灯片 -->
											<div class="oSlide">
												<section class="oSlide-P" id="oSlideFun">
													<ul>
														<?php if(is_array($adv)): foreach($adv as $key=>$adv): ?><li class='oShow'>
																<a target="_blank" href="<?php echo ($adv["url"]); ?>" name="<?php echo ($adv["title"]); ?>">
																	<img src="<?php echo ($adv["image_path"]); ?>"/>
																	<div class="news">
																			<span class="ceng"></span>
																			<span class="text"><?php echo ($adv["title"]); ?></span>
																	</div>
																</a>
															</li><?php endforeach; endif; ?>
													</ul>
													<span id="oSbtn" class="oSbtn">
														<?php if(is_array($adv)): foreach($adv as $key=>$adv): ?><a href="javascript:void(0)">&nbsp;</a><?php endforeach; endif; ?>
													</span>
													<a class="prev" target="_self" href="javascript:void(0)">Prev</a>
													<a class="next" target="_self" href="javascript:void(0)">next</a>
												</section>
												<section class="slideColorBg" style="background: #333;"></section>
											</div>
											<!-- /幻灯片结束 -->
										</div>
									</div>
								</section>
								<aside class="w240 fl">
									<section class="b-fff">
										<div class="i-fbg-title pt15"><span class="fsize18 c-333">资讯公告</span></div>
										<div class="i-r-news-list i-r-news-list-thr">
											<ul>
												<?php if(is_array($info)): foreach($info as $key=>$info): ?><li>
														<a href="<?php echo U('Info/detail',array('id'=>$info['id']));?>" title="" target="_blank"><?php echo ($info["title"]); ?></a>
													</li><?php endforeach; endif; ?>

											</ul>
										</div>
									</section>
								</aside>
								<div class="clear"></div>
								<div class="mt20 ml20">
									<section class="b-fff">
										<ul class="i-course-list-one">
											<?php if(is_array($recommend)): foreach($recommend as $key=>$recommend): ?><li>
													<a href="<?php echo U('Academy/detail',array('id'=>$recommend['id']));?>"><img xsrc="<?php echo U('Academy/detail',array('id'=>$recommend['id']));?>" src="<?php echo ($recommend["path"]); ?>" height="140" width="187" alt="<?php echo ($recommend["name"]); ?>"></a>
													<div class="pa s-c-name">
														<a href="<?php echo U('Academy/detail',array('id'=>$recommend['id']));?>" title="<?php echo ($recommend["name"]); ?>" class="fsize12 c-fff" target="_blank"><?php echo ($recommend["name"]); ?></a>
													</div>
												</li><?php endforeach; endif; ?>

										</ul>
										<div class="clear"></div>
									</section>
								</div>
							</div>
							<div class="clear"></div>
						</div>
					</div>

				</div>

				<div class="" name="tt-3">
					<div class="b-fff pt10 pb50">
						<div class="iContainer">
							<div>
								<div class="i-fbg-title pt15 pr">
									<aside class="i-cc-more">
										<a href="#" class="c-999" title="更多" target="_blank">更多</a>
									</aside>
									<section class="c-infor-tabTitle c-tab-title">
											<a class="choose current" href="javascript: void(0)" target="_self" lang="boutique">精品课程</a>
											<a class="choose" href="javascript: void(0)" target="_self" lang="hot">热门课程</a>
									</section>
								</div>
								<div>
									<aside class="fr w300">
										<div class="ml30">
											<div class="mt10">
												<section class="c-infor-tabTitle c-tab-title" style="margin-top: 40px">
													<a class="Top current" href="javascript: void(0)" >排行榜</a>
												</section>
											</div>
											<div class="i-cc-rank-bx free" id="free">
												<ul class="c-c-list">
													<li>
														<span class="order">1</span>
														<a title="金银花生产栽培技术" href="<?php echo U('detail',array('id'=>5));?>">
															<p>金银花生产栽培技术</p>
															<div class="i-cc-r-cimg mt10">
																<span class="fl mr10">
																<img src="/Public/Webmall/images/jinyinhuazhongzhijishu.jpg" xsrc="http://ni1.268xue.com/upload/mavendemo/course/20161031/1477896986968565237.jpg" width="100" height="75" alt="">
															</span>
																<h6 class="hLh20 txtOf"><small class="c-green fsize12">500</small><small class="ml5 c-ccc fsize12">人学习</small></h6>
																<div class="s-c-desc pt10 pb10"><small class="fsize12 c-999">金银花是名贵中药材，生于山坡灌丛或疏林中、乱石堆、山足路旁及村庄篱笆边，海拔最高达1500米。也常栽培。日本和朝鲜也有分布。在北美洲逸生成为难除的杂草。《神农本草经》称其“凌冬不凋”。</small></div>
															</div>
														</a>
													</li>

													<li>
														<span class="order">2</span>
														<a title="花草栽培技术" href="<?php echo U('detail',array('id'=>4));?>">
															<p>花草栽培技术</p>
														</a>
													</li>

													<li>
														<span class="order">3</span>
														<a title="蜜蜂养殖，管理与生产" href="<?php echo U('detail',array('id'=>8));?>">
															<p>蜜蜂养殖，管理与生产</p>
														</a>
													</li>

													<li>
														<span class="order">4</span>
														<a title="果树嫁接技术" href="<?php echo U('detail',array('id'=>3));?>">
															<p>果树嫁接技术</p>
														</a>
													</li>

													<li>
														<span class="order">5</span>
														<a title="侧柏盆景制作" href="<?php echo U('detail',array('id'=>1));?>">
															<p>侧柏盆景制作</p>
														</a>
													</li>

													<li>
														<span class="order">6</span>
														<a title="蛋鸡养殖技术" href="<?php echo U('detail',array('id'=>6));?>">
															<p>蛋鸡养殖技术</p>
														</a>
													</li>

													<li>
														<span class="order">7</span>
														<a title="新娘手捧花制作" href="<?php echo U('detail',array('id'=>2));?>">
															<p>新娘手捧花制作</p>
														</a>
													</li>

													<li>
														<span class="order">8</span>
														<a title="食用菌饮食加工技术" href="<?php echo U('detail',array('id'=>10));?>">
															<p>食用菌饮食加工技术</p>
														</a>
													</li>

													<li>
														<span class="order">9</span>
														<a title="葡萄种植与栽培技术" href="<?php echo U('detail',array('id'=>9));?>">
															<p>葡萄种植与栽培技术</p>
														</a>
													</li>

													<li>
														<span class="order">10</span>
														<a title="家具加工制作" href="<?php echo U('detail',array('id'=>7));?>">
															<p>家具加工制作</p>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</aside>
									<article class="fl w670 i-tthre-course-l-bx" id="boutiqueCourse">
										<section class="i-ttwo-course-list i-tthre-course-list mt40">
											<ul class="s-c-list">
												<?php if(is_array($new)): foreach($new as $key=>$new): ?><li>
														<div class="s-c-pics">
															<a target="_blank" href="<?php echo U('Academy/detail',array('id'=>$new['id']));?>" title="<?php echo ($new["name"]); ?>">
																<img width="154" height="116" alt="<?php echo ($new["name"]); ?>" src="<?php echo ($new["path"]); ?>" xsrc="<?php echo U('Academy/detail',array('id'=>$new.['id']));?>">
															</a>
														</div>
														<div class="pl15 pr15 pb10">
															<div class="s-c-desc pt10 pb10 h-41">
																<a target="_blank" class="fsize14" title="<?php echo ($new["name"]); ?>" href="<?php echo U('Academy/detail',array('id'=>$new.['id']));?>"><?php echo ($new["name"]); ?></a>
															</div>
															<div class="hLh20">
																<a href="" class="fsize12 c-999"><?php echo ($new["teacher"]); ?></a>
															</div>
															<div class="hLh30 of mt5">
																<span class="fl"><small class="fsize12 c-999"><?php echo ($new["learned_count"]); ?>人学习</small></span>
																<span class="fr"><small class="fsize12 c-999"><?php echo ($new["comment_count"]); ?>条评论</small></span>
															</div>
														</div>
													</li><?php endforeach; endif; ?>

											</ul>
										</section>
									</article>
									<article class="fl w670 i-tthre-course-l-bx" id="hotCourse" style="display: none;">
										<section class="i-ttwo-course-list i-tthre-course-list mt40">
											<ul class="s-c-list">
												<?php if(is_array($hot)): foreach($hot as $key=>$new): ?><li>
														<div class="s-c-pics">
															<a target="_blank" href="<?php echo U('Academy/detail',array('id'=>$new['id']));?>" title="<?php echo ($new["name"]); ?>">
																<img width="154" height="116" alt="<?php echo ($new["name"]); ?>" src="<?php echo ($new["path"]); ?>" xsrc="<?php echo U('Academy/detail',array('id'=>$new.['id']));?>">
															</a>
														</div>
														<div class="pl15 pr15 pb10">
															<div class="s-c-desc pt10 pb10 h-41">
																<a target="_blank" class="fsize14" title="<?php echo ($new["name"]); ?>" href="<?php echo U('Academy/detail',array('id'=>$new.['id']));?>"><?php echo ($new["name"]); ?></a>
															</div>
															<div class="hLh20">
																<a href="" class="fsize12 c-999"><?php echo ($new["teacher"]); ?></a>
															</div>
															<div class="hLh30 of mt5">
																<span class="fl"><small class="fsize12 c-999"><?php echo ($new["learned_count"]); ?>人学习</small></span>
																<span class="fr"><small class="fsize12 c-999"><?php echo ($new["comment_count"]); ?>条评论</small></span>
															</div>
														</div>
													</li><?php endforeach; endif; ?>

											</ul>
										</section>
									</article>
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="" name="tth-1">
					<div class="b-f8 pt30 pb10">
						<div class="iContainer">
							<asdie class="fr w300">
								<section class="b-fff">
									<div class="i-fbg-title pt15"><span class="fsize18 c-333">视频动态</span></div>
									<div class="i-box-pd">
										<ul class="stuDynamincHtml">
											<li>
												<div class="us-face">
													<img src="/Public/uploads/Admin/image/20170228/avatar6.jpg" alt="">
												</div>
												<div class="hLh30 txtOf">
													<span class="fr">
														<small class="c-999 fsize12">2017-02-20</small>
													</span>
													<span class="fl"><small class="c-666 fsize14"></small></span>
												</div>
												<div class="hLh20 txtOf">
													<span class="c-999">观看了</span>
													<a href="<?php echo U('detail',array('id'=>5));?>" target="_blank" class="c-orange">金银花生产栽培技术</a>
												</div>
											</li>
										</ul>
									</div>
									<div class="i-box-pd">
										<ul class="stuDynamincHtml">
											<li>
												<div class="us-face">
													<img src="/Public/uploads/Admin/image/20170228/avatar9.jpg" alt="">
												</div>
												<div class="hLh30 txtOf">
													<span class="fr">
														<small class="c-999 fsize12">2017-02-20</small>
													</span>
													<span class="fl"><small class="c-666 fsize14"></small></span>
												</div>
												<div class="hLh20 txtOf">
													<span class="c-999">观看了</span>
													<a href="<?php echo U('detail',array('id'=>7));?>" target="_blank" class="c-orange">家具加工制作</a>
												</div>
											</li>
										</ul>
									</div>
									<div class="i-box-pd">
										<ul class="stuDynamincHtml">
											<li>
												<div class="us-face">
													<img src="/Public/uploads/Admin/image/20170228/avatar8.jpg" alt="">
												</div>
												<div class="hLh30 txtOf">
													<span class="fr">
														<small class="c-999 fsize12">2017-02-18</small>
													</span>
													<span class="fl"><small class="c-666 fsize14"></small></span>
												</div>
												<div class="hLh20 txtOf">
													<span class="c-999">观看了</span>
													<a href="<?php echo U('detail',array('id'=>10));?>" target="_blank" class="c-orange">食用菌饮食加工技术</a>
												</div>
											</li>
										</ul>
									</div>
									<div class="i-box-pd">
										<ul class="stuDynamincHtml">
											<li>
												<div class="us-face">
													<img src="/Public/uploads/Admin/image/20170228/avatar7.jpg" alt="">
												</div>
												<div class="hLh30 txtOf">
													<span class="fr">
														<small class="c-999 fsize12">2017-02-11</small>
													</span>
													<span class="fl"><small class="c-666 fsize14"></small></span>
												</div>
												<div class="hLh20 txtOf">
													<span class="c-999">观看了</span>
													<a href="<?php echo U('detail',array('id'=>4));?>" target="_blank" class="c-orange">花草栽培技术</a>
												</div>
											</li>
										</ul>
									</div>

								</section>
							</asdie>
							<article class="fl w650">
								<section class="b-fff">
									<div class="i-fbg-title pt15"><span class="fsize18 c-333">视频互动</span></div>
									<div class="i-box-pd">
										<div class="i-itera-bx">
											<ul id="i-itera-list" class="stuDynamincHtml">
												<?php if(is_array($comment)): foreach($comment as $key=>$comment): ?><li>
														<div class="us-face">
															<img src="<?php echo ($comment["path"]); ?>" alt="">
														</div>
														<div class="hLh30 txtOf">
														<span class="fr"><small class="c-999 fsize12"><?php echo ($comment["gmt_create"]); ?></small></span>
														<span class="fl">
															<small class="c-666 fsize14"><?php echo ($comment["name"]); ?></small>
															<small class="c-999 fsize12">评价课程</small>
															<a href="<?php echo U('Academy/detail',array('id'=>$comment['course_id']));?>" target="_blank" class="c-orange"><?php echo ($comment["course_name"]); ?></a>
														</span>
														</div>
														<div class="hLh20 txtOf mt5">
															<span class="c-999"><?php echo ($comment["comment"]); ?></span>
														</div>
													</li><?php endforeach; endif; ?>
											</ul>
										</div>
									</div>
								</section>
							</article>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
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
		
		<div class="onlineConsult">
			<dl>
				<dt>
		            <a href="javascript: void(0)" id="goTop">
		                <em class="ocgld-em gT-btn">&nbsp;</em>
		                <span class="fb-hover-text">返回顶部</span>
		            </a>
		        </dt>

			</dl>
		</div>
		
		<script src="/Public/Webmall/js/index.js" type="text/javascript" charset="utf-8"></script>
	</body>
	<style type="text/css">
		.ceng {
			display: block;
			width: 632px;
			height: 42px;
			position: absolute;
			bottom: 0px;
			background: #000;
			opacity: 0.4;
		}
		.news{
			width: 100%;
			z-index: 99;
		}
		.text{
			padding-left: 10px;
			display: block;
			height: 42px;
			line-height: 42px;
			position: absolute;
			bottom: 0px;
			color: #fff;
			font-size: 18px;
		}
	</style>
</html>