<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	<title>视频中心</title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/common.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/page-style.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/cColor.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/laypage.css"/>
	<!--[if lt IE 9]><script src="http://nt1.268xue.com/static/common/html5.js?v=1486400438591"></script><![endif]-->
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

<div>
	<section class="w1000">
		<div class="mt20 pr">
			<div class="pathwray">
				<ol class="clearfix c-333 f-fM fsize14">
					<li>
						<a href="<?php echo U('Academy/index');?>" title="跟我学" class="c-master">跟我学</a> &gt;</li>
					<li><span>视频中心</span></li>
				</ol>
			</div>
			<section class="c-search pa">
				<div class=" clearfix">
					<section class="fr s-inp-wrap">
						<form id="searchForm" action="http://nt1.268xue.com/front/showcoulist.json" method="post"> <input type="hidden" name="page.currentPage" value="1" id="pageCurrentPage" /> <input type="hidden" id="hiddenMemberId" name="queryCourse.membertype" value="" /> <input type="hidden" id="hiddenSubjectId" name="queryCourse.subjectId" value="244" /> <input type="hidden" id="hiddenTeacherIds" name="queryCourse.teacherId" value="" /> <input type="hidden" id="hiddenorder" name="queryCourse.order" value="0" /> <input type="hidden" id="hiddencourseName" name="queryCourse.name" value="" /> <input type="hidden" id="hiddenYear" name="queryCourse.courseYear" value="" /> </form>
					</section>
				</div>
			</section>
		</div>
		<div class="mt30">
			<section class="mb20">
				<div class="select-box2">
					<div class="select-box2-left">
						<p class="btName">视频分类:</p>
					</div>
					<div class="select-box2-right">
						<ul class="select-box2-mid">
							<?php $i = 0; ?>
							<?php if(is_array($cat)): foreach($cat as $key=>$cat): ?><li>
									<input type="hidden" name="id" value="<?php echo ($cat["id"]); ?>">
									<a title="<?php echo ($cat["name"]); ?>" href="javascript:void(0);" <?php if($i == 0): ?>class='now'<?php endif; ?>><?php echo ($cat["name"]); ?></a>
								</li>
								<?php $i++; endforeach; endif; ?>
						</ul>
						<!--<div class="select-box2-RT">
                            <a class="select-unfolt suMore" href="javascript:void(0)" style="display: none;">更多↓</a>
                        </div>-->
					</div>
				</div>
			</section>
			<section class="comm-title-2" style="box-shadow: 3px 3px 0 rgba(0,0,0,.05);">
				<div class="clearfix pl20 pr20">
					<section class="fr c-999">
								<span class="vam disIb mr20">
									<font class="c-666 fsize12">检索：共搜索到
										<tt class="c-red ml5 mr5"><?php echo ($count); ?></tt>条结果
									</font>
								</span>
					</section>
					<section class="fl">
						<ul class="of sub-sort">
							<li><span class="c-999">排序：</span></li>
							<li class="sub-s-wrap">
								<a id="orderAid2" href="javascript:void(0)" title="最新" class="current">最新</a>
								<a id="orderAid1" href="javascript:void(0)" title="热门">热门</a>
							</li>
						</ul>
					</section>
				</div>
			</section>
		</div>
		<div class="mb50">
			<section id="SL-container">
				<div class="mt40">
					<ol class="s-c-list">
						<!--<?php if(empty($course)): ?><div class="mb50"> <section class="comm-tips-1"> <p> <em class="vam c-tips-1">&nbsp;</em> <font class="c-999 fsize12 vam">对不起，此条件下还没有相关视频！</font> </p> </section> </div><?php endif; ?>
						<?php if(is_array($course)): foreach($course as $key=>$course): ?><li>
								<div class="pr s-c-pics" style="cursor: pointer;">
									<a title="<?php echo ($course["name"]); ?>" href="<?php echo U('Academy/detail',array('id'=>$course['id']));?>" target="_blank"> <img xSrc="<?php echo U('Academy/detail',array('id'=>$course['id']));?>" src="<?php echo ($course["path"]); ?>" height="116" width="154" alt="<?php echo ($course["name"]); ?>"> </a>
									<div class="pa s-c-name">
										<a target="_blank" class="fsize14 c-fff" title="<?php echo ($course["name"]); ?>" href="<?php echo U('Academy/detail',array('id'=>$course['id']));?>"><?php echo ($course["name"]); ?></a>
									</div>
								</div>
								<section class="pl10 pr10 of">
									<div class="s-c-desc pt10 pb10">
										<p class="c-666"><?php echo ($course["description"]); ?></p>
									</div>
									<div class="of mt10 mb20">
										<section class="fl w50pre">
											<div class="tac">
												<p class="mt10">
													<a class="gray-btn" title="观看视频" href="<?php echo U('Academy/detail',array('id'=>$course['id']));?>"><tt class="vam c-333">观看视频</tt><em class="ml5 r-arrow icon16 vam">&nbsp;</em></a>
												</p>
											</div>
										</section>
										<section class="fl w50pre">
											<div class="tac">
												<p class="mt10">

													<?php if($course['collect'] == 'true'): ?><a href="javascript:void(0)" onclick="house($course['id'],$user['id'],'cancel')" title="取消收藏" class="c-orange">取消收藏</a>
														<?php else: ?>
														<a href="javascript:void(0)" onclick="house($course['id'],$user['id'],'collect')" title="收藏视频" class="c-orange">收藏视频</a><?php endif; ?>

												</p>
											</div>
										</section>
									</div>
								</section>
							</li><?php endforeach; endif; ?>-->
					</ol>
					<div class="clear"></div>
				</div>
			</section>
			<section>
				<div id="page" style="text-align: center;">
				</div>
			</section>
		</div>
	</section>
</div>

<div class="ness-wrap">
	<section class="w1000">
		<ul class="ness clearfix">
			<li> <span class="n-icon n-i-1">&nbsp;</span>
				<h4 class="hLh30 of unFw"><font class="fsize20 c-999 f-fM">独家视频</font></h4>
				<div class="mt10">
					<p class="c-999">各行业及企业掌门人、商业领袖讲授创业人生企业管理，品牌营销、新趋势等独家视频。</p>
				</div>
			</li>
			<li> <span class="n-icon n-i-2">&nbsp;</span>
				<h4 class="hLh30 of unFw"><font class="fsize20 c-999 f-fM">答疑解惑</font></h4>
				<div class="mt10">
					<p class="c-999">各行业及企业掌门人、商业领袖讲授创业人生企业管理，品牌营销、新趋势等独家视频。</p>
				</div>
			</li>
			<li> <span class="n-icon n-i-6">&nbsp;</span>
				<h4 class="hLh30 of unFw"><font class="fsize20 c-999 f-fM">线下视频</font></h4>
				<div class="mt10">
					<p class="c-999">各行业及企业掌门人、商业领袖讲授创业人生企业管理，品牌营销、新趋势等独家视频。</p>
				</div>
			</li>
		</ul>
	</section>
</div>
<footer>
	<section class="foot-link">
		<div class="w1000">
			<div class="pt10 pb20">
				<section class="mt20 mb10">
					<ul class="tac">
						<li id="linkBottom">
							<a target="_blank" class="mr10 ml5" href="#" title="新手指南" target="_blank">新手指南</a>|
							<a target="_blank" class="mr10 ml5" href="/help" title="帮助中心" target="_blank">帮助中心</a>|
							<a target="_blank" class="mr10 ml5" href="#" title="关于我们" target="_blank">关于我们</a>|
							<a target="_blank" class="mr10 ml5" href="#" title="联系我们" target="_blank">联系我们</a>|
							<a target="_blank" class="mr10 ml5" href="/front/to_free_back" title="意见反馈" target="_blank">意见反馈</a>|
						<li class="mt5">
							<font class="fsize12">©2013-2017 宁波农本科技有限公司</font>
						</li>
					</ul>
				</section>
			</div>
		</div>
	</section>
</footer>
<script src="/Public/Webmall/js/index.js" type="text/javascript" charset="utf-8"></script>
<script src="/Public/Webmall/js/laypage.js" type="text/javascript" charset="utf-8"></script>
<script src="/Public/Webmall/js/web_top.js" type="text/javascript" charset="utf-8"></script>
<script src="/Public/Webmall/js/webutils.js" type="text/javascript" charset="utf-8"></script>
<script src="/Public/Webmall/js/pageJs.js" type="text/javascript" charset="utf-8"></script>
<script src="/Public/Webmall/js/emailList.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">

	//获取总页数
	function getPage(url,data){
		console.log('getPage');
		$.ajax({
			url: '/Webmall/Academy/getPage',
			dataType: 'json',
			type: 'get',
			data: data,
			success: function(res){
				console.log(res);
				if(res.state == 'success'){
					laypage({
						cont: 'page', //容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div id="page1"></div>
						pages: res.data, //通过后台拿到的总页数
						curr: 1, //初始化当前页
						skin: '#0B803F', //样式
						jump: function(e){ //触发分页后的回调
							var data = {pageIndex:e.curr, id:$('.select-box2-mid a.now').prev().val()};
							console.log(url);
							var _index = $('.sub-s-wrap a.current').index();
							if(_index == 0){
								var url = '/Webmall/Academy/getNewCourseByCat';
							}else{
								var url = '/Webmall/Academy/getHotCourseByCat';
							}
							put(url,data);
						}
					});
				}
			}
		});
	}

	//页面初始化
	var data = {id : $('.select-box2-mid a.now').prev().val()};
	 getPage('/Webmall/Academy/getNewCourseByCat',data);
</script>
<script>
	function put(url,data){
		$.ajax({
			url: url,
			data: data,
			type: 'post',
			dataType: 'json',
			success: function (res) {
				console.log(res);
				if(res.state == 'success'){
					var html='';
					$('.s-c-list').html(html);
					console.log(res.data.items);
					if(res.data.items != null){
						for(var i=0; i<res.data.items.length; i++){
							html  += "<li>"+
									"<div class='pr s-c-pics' style='cursor: pointer;'>"+
									"<a title='<?php echo ($course["name"]); ?>' href='/Webmall/Academy/detail/id/"+res.data.items[i].id+"' target='_blank'> <img xSrc='/Webmall/Academy/detail/id/"+res.data.items[i].id+"' src='"+ res.data.items[i].path +"' height='116' width='154' alt='"+ res.data.items[i].name +"'> </a>"+
									"<div class='pa s-c-name'>"+
									"<a target='_blank' class='fsize14 c-fff' title='"+res.data.items[i].name+"' href='/Webmall/Academy/detail/id/"+res.data.items[i].id+"'>"+res.data.items[i].name+"</a>"+
									"</div>"+
									"</div>"+
									"<section class='pl10 pr10 of'>"+
									"<div class='s-c-desc pt10 pb10'>"+
									"<p class='c-666 h-50'>"+res.data.items[i].description+"</p>"+
									"</div>"+
									"<div class='of mt10 mb20'>"+
									"<section class='fl w50pre'>"+
									"<div class='tac'>"+
									"<p class='mt10'>"+
									"<a href='javascript:void(0)' class='gray-btn' title='观看视频' onclick='play(" + res.data.items[i].id + ")' ><tt class='vam c-333'>观看视频</tt><em class='ml5 r-arrow icon16 vam'>&nbsp;</em></a>"+
									"</p>"+
									"</div>"+
									"</section>"+
									"<section class='fl w50pre'>"+
									"<div class='tac'>"+
									"<p class='mt10'>";
							if(res.data.items[i]['collect'] == true){
								html += "<a href='javascript:void(0)' onclick='house(" + res.data.items[i].id + ",\"cancel\")' title='取消收藏' class='c-orange'>已收藏</a>";
							}else{
								html += "<a href='javascript:void(0)' onclick='house(" + res.data.items[i].id + ",\"collect\")' title='收藏视频' class='c-orange'>收藏视频</a>";
							}

							html +=	"</p>"+
									"</div>"+
									"</section>"+
									"</div>"+
									"</section>"+
									"</li>";
						}
					}else{
						html += '<div class="mb50">'+
								'<section class="comm-tips-1">'+
								'<p>'+
								'<em class="vam c-tips-1">&nbsp;</em>'+
								'<font class="c-999 fsize12 vam">对不起，此条件下还没有相关视频！</font>'+
								'</p>'+
								'</section>'+
								'</div>';

					}
					//console.log(html);
					$('.s-c-list').html(html);
					$('.c-red').html(res.data.count);
				}
			}
		});
	}

	$('.select-box2-mid a').click(function(){
		var _this = $(this);
		$('.select-box2-mid a').removeClass('now');
		_this.addClass('now');
		$('#orderAid2').addClass('current');
		var data = {id : _this.parent().find('input').val()};
		var url = '/Webmall/Academy/getNewCourseByCat';
		put(url,data);
		getPage(url,data);
	});

	$('#orderAid1,#orderAid2').click(function(){
		var _this = $(this);
		$('#orderAid1,#orderAid2').removeClass('current');
		_this.addClass('current');
		var url;
		var data = {id : $('.select-box2-mid a.now').prev().val()};
		//console.log(data);
		if(_this.attr('id') == 'orderAid1'){
			url = '/Webmall/Academy/getHotCourseByCat';
		}else{
			url = '/Webmall/Academy/getNewCourseByCat';
		}
		//console.log(url);
		put(url,data);
		getPage(url,data);
	})
</script>

</body>

</html>