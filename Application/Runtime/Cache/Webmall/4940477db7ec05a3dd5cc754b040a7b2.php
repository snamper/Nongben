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
						<div class="pathwray unBr">
							<ol class="c-333 f-fM fsize14">
								<li>
									<a class="c-333" title="跟我学" href="<?php echo U('Academy/index');?>">跟我学</a>&gt; </li>
								<li>
									<a class="c-333" title="视频中心" href="#">视频中心</a>&gt; </li>
								<li> <span><?php echo ($course["category_name"]); ?></span> </li>
							</ol>
							<div class="clear"></div>
						</div>

						<input type="hidden" name="id" id="id" value="<?php echo ($course["id"]); ?>">
						<section class="clearfix mt20">
							<div class="fl c-play" id="vedioSpace">
								<aside class="pr of mt20 ml20">
									<a class="lookngVedio" href="javascript:void(0)" title="播放">
										<img src="<?php echo ($course["img_path"]); ?>" height="300" width="400" alt="">
									</a>
									<a onclick="play($('#id').val())" title="播放" class="c-p-btn pa lookngVedio">&nbsp;</a>
									<aside class="c-free-tp">
										<em class="c-free-img">&nbsp;</em>
									</aside>
								</aside>
							</div>
							<div class="fl" style="padding-top: 30px;">
								<article class="c-attr">
									<div>
										<h3 class="hLh30 of unFw"> <font class="c-333 fsize24 f-fM"><?php echo ($course["name"]); ?></font> </h3>
										<div class="s-c-desc pt10 pb10 mt5">
											<p class="c-666 h-90"><?php echo ($course["description"]); ?></p>
										</div>
									</div>
									<div class="">
										<section class="mt8">
											<div class="of hLh20">
												<span class="vam" title="讲师："> <tt class="vam c-333 fsize14 f-fM">讲师：</tt> </span>
												<span class="vam ml10 teac-wrap fsize14 f-fM">
													<span class="vam"><?php echo ($course["teacher"]); ?></span>
												</span>
											</div>
										</section>
										<section class="mt8 c-333 fsize14 f-fM">
											<span class="vam">播放：</span>
											<span class="vam ml10"><?php echo ($course["learned_count"]); ?>次</span>
											<span class="vam ml10">&nbsp;评论数：</span>
											<span class="vam"><?php echo ($course["comment_count"]); ?>条</span>
										</section>
										<section class="mt8 c-333 fsize14 f-fM">
											<span class="vam">课时：</span>
											<span class="vam ml10">1节课</span>
										</section>
										</div>
									<div>
										<section class="clearfix mt50">
											<div class="fl">
												<input type="hidden" value="0" id="courseIsPay">
												<a href="javascript:void(0)" onclick="play($('#id').val())" class="buy-btn lookngVedio">
													<font class="c-fff tac" title="观看课程">观看课程</font>
													<input type="hidden" value="yes" id="playPower">
												</a>
											</div>
											<div class="fr">
												<p class="mt30 mr20"> <font class="f-fM c-blue fsize12">（如有疑问请拨打）400-0620-268</font> </p>
											</div>
										</section>
									</div>
								</article>
							</div>
						</section>

						<section class="mt50">
							<ul class="c-play-nav clearfix" id="c-play-nav">
								<li class="current expandClass list" lang="sellSuggest">
									<a href="javascript:void(0)" id="" title="课程介绍" class="c-p-n-txt"> <em class="icon18 c-js">&nbsp;</em> <tt class="vam f-fM">课程介绍</tt> </a>
								</li>
								<li class="expandClass list" lang="sellWayComment">
									<a href="javascript:void(0)" title="课程评论" class="c-p-n-txt"> <em class="icon18 c-dy">&nbsp;</em> <tt class="vam f-fM">课程评论</tt> </a>
								</li>
								<li <?php if($collect == 'true'): ?>class="current"<?php endif; ?> id="collect">
									<?php if($collect == 'true'): ?><a href="javascript:void(0)" title="取消收藏" class="c-p-n-txt"> <em class="icon18 c-sc">&nbsp;</em> <tt class="vam f-fM">已收藏</tt> </a>
										<?php else: ?>
										<a href="javascript:void(0)" title="收藏课程" class="c-p-n-txt"> <em class="icon18 c-sc">&nbsp;</em> <tt class="vam f-fM">收藏课程</tt> </a><?php endif; ?>
								</li>
							</ul>
						</section>
					</div>
				</div>
			</section>
			<section class="mb50">
				<div class="w1000">
					<article class="fl w100">
						<div id="sellSuggest" class="publicClass mt20">
							<section class="comm-shadow-1">
								<div class="comm-title-1">
									<section> <span class="fl"> <font class="fsize16 f-fM c-brow">课程介绍</font> </span> </section>
								</div>
							</section>
							<section class="pt20 pr10 c-i-kc-js"><?php echo ($course["description"]); ?></section>
						</div>
						<div id="sellWayComment" class="publicClass mt20" style="display: none;">
							<section class="comm-shadow-1">
								<div class="comm-title-1">
									<section> <span class="fl"> <font class="fsize16 f-fM c-brow">课程评论</font> </span> </section>
								</div>
							</section>
							<section>
								<div class="comment-box"> <span class="c-q-img-1"> <img width="60" height="60" id="assessUserImg" src="/Public/Webmall/images/user_default.jpg"/> </span>
									<section class="c-box-wrap pr"> <em class="icon16 c-q-sj">&nbsp;</em>
										<textarea cols="75" id="assessContent" rows="" name=""></textarea>
									</section>
									<section class="tar mt10"> <span class="mr10"><small class="c-orange" id="assessContentError"></small></span>
										<a class="question-btn" title="提交评论" href="javascript:void(0)">提交评论</a>
									</section>
								</div>
							</section>
							<section class="pl10 pr10 ajaxHtml1">
								<div class="mt20">
									<ul class="c-comment-list">
											<?php if(empty($comment)): ?><section class="comment-question">
													<dl>
													<section class="comm-tips-1">
														<p><em class="vam c-tips-1">&nbsp;</em><font class="c-999 fsize12 vam">还没有相关评论，快来抢沙发！</font></p>
													</section>
													</dl>
												</section>
												<?php else: ?>
												<?php if(is_array($comment)): foreach($comment as $key=>$comment): ?><section class="comment-question">
														<dl><dt>
															<span class="c-q-img-1"><img src="/Public/Webmall/images/user_default.jpg" height="60" width="60"></span>
															<div class="clearfix">
																<span class="fr"> <font class="fsize12 c-666"><?php echo ($comment["gmt_create"]); ?></font></span>
														<span>
															<strong class="fsize14 c-master vam"><?php echo ($comment["username"]); ?></strong>
															<tt class="c-666 vam ml10">评论：</tt>
														</span>
															</div>
															<div class="mt5"><p class="c-999"><?php echo ($comment["comment"]); ?></p></div>
															<div class="mt10 clearfix">
																<span class="fr c-ccc"><tt class="f-fM c-666 vam mr5"></tt></span>
															</div>
														</dt></dl>
													</section><?php endforeach; endif; endif; ?>
								</ul>
							</div>
							</section>
							<!--<tt class="c-666" style="padding-left: 536px;">加载更多</tt>-->
						</div>
					</article>
					<section class="clear"></section>
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
		<script src="/Public/Webmall/js/web_top.js" type="text/javascript" charset="utf-8"></script>
		<script src="/Public/Webmall/js/webutils.js" type="text/javascript" charset="utf-8"></script>
		<script src="/Public/Webmall/js/pageJs.js" type="text/javascript" charset="utf-8"></script>
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


			$("#collect").on("click",function(){
				var courseId = $('#id').val();
				var type;
				var html;
				if($(this).attr('class') == 'current'){
					type = 'cancel';
					html = "<a href='javascript:void(0)' title='收藏课程' class='c-p-n-txt'> <em class='icon18 c-sc'>&nbsp;</em> <tt class='vam f-fM'>收藏课程</tt> </a>";
				}else{
					type='collect';
					html = "<a href='javascript:void(0)' title='取消收藏' class='c-p-n-txt'> <em class='icon18 c-sc'>&nbsp;</em> <tt class='vam f-fM'>已收藏</tt> </a>";
					}
				$.ajax({
					url:baselocation+"/Webmall/Academy/collect",
					data:{'course_id':courseId,'type':type},
					type : "post",
					dataType : "json",
					success: function (result){
						console.log(result);
						if(result.code == "301"){
							window.location.href = baselocation + "/Webmall/User/login";
						}else if(result.code == '200'){
							if(type == 'cancel'){
								$('#collect').removeClass('current');
							}else{
								$('#collect').addClass('current');
							}
							$('#collect').html(html);
						}else{
							dialog('操作提示','操作失败',1);
						}
					}
				});
			});

			$('.question-btn').click(function () {
				var be_comment_id = $('#id').val();
				var comment = $('#assessContent').val();
				$.ajax({
					url:baselocation+"/Webmall/Comment/comment",
					data:{'be_comment_id':be_comment_id,'comment':comment},
					type : "post",
					dataType : "json",
					success: function (result){
						console.log(result);
						if(result.code == "301"){
							window.location.href = baselocation + "/Webmall/User/login";
						}else if(result.code == '200'){
							var html = "";
							//$('.c-comment-list').html(html);   有这句会很奇怪的
							$.get(baselocation + "/Webmall/Comment/getComment?id=" + be_comment_id, function(res){
								console.log(res.data.length);
								for(var i=0;i<res.data.length;i++){
									html +=  "<section class='comment-question'>" +
											 "<dl><dt>" +
											 "<span class='c-q-img-1'><img src='/Public/Webmall/images/user_default.jpg' height='60' width='60'></span>" +
											 "<div class='clearfix'>" +
											 "<span class='fr'><font class='fsize12 c-666'>"+ res.data[i].gmt_create +"</font></span>" +
											 "<span>" +
											 "<strong class='fsize14 c-master vam'>"+ res.data[i].username +"</strong>" +
											 "<tt class='c-666 vam ml10'>评论：</tt>" +
											 "</span>" +
											 "</div>" +
											 "<div class='mt5'><p class='c-999'>"+ res.data[i].comment +"</p></div>" +
											 "<div class='mt10 clearfix'>" +
											 "<span class='fr c-ccc'><tt class='f-fM c-666 vam mr5'></tt></span>" +
											 "</div>" +
											 "</dt></dl>" +
											 "</section>";
								}
								//console.log(html);
								$('.c-comment-list').html(html);
								$('#assessContent').val('');
							});
						}else{
							dialog('操作提示','评论失败',1);
						}
					}
				})
			})
		</script>
	</body>

</html>