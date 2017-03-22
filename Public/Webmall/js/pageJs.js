	$(function() {
		effect();
		cousesMy();
		//cStar();
		//menuNote();//课程播放目录与笔记
		cardChange("#pay-title>li" , "#pay-cont>section" , "current");
		//cardChange("#wsTabT>a" , "#wsContC>section" , "onClick");
		ePosition();
		goTop();
		gtFun();
		rOnLineFixed(); //右侧获得在线咨询信息
		fixedR();//右侧客服二维码
	});
	function ePosition() {
		//课程排列+排行SORT
		//$(".s-c-list>li:nth-child(4n)").css({"margin-right" : "0px"});
		$(".c-c-list>ul>li .order:lt(3)").addClass("b-master c-fff");
		$(".c-c-list>ul>li .order:gt(2)").addClass("b-yellow c-666");
		$(".article-list-1>ol>li .order:lt(3)").addClass("b-master c-fff");
		$(".article-list-1>ol>li .order:gt(2)").addClass("b-ccc c-666");
	}

	function effect() {
		//课程列表说明层
		$(".courses-list-1>li .c-l-wrap").hover(function() {
			$(this).children(".c-l-desc").animate({"bottom" : "0px"}, 200);
		}, function() {
			$(this).children(".c-l-desc").animate({"bottom" : "-68px"}, 200);
		});

        //checkbox控件
        $(".inpCb").click(function() {
            if ($(this).find("input").is(":checked")==false) {
                $(this).addClass("unforget");
            } else {
                $(this).removeClass("unforget");
            };
        });

        //分享
		$(".c-share").hover(function() {
			$(this).stop().animate({"width" : "210px"}, 200);
			$(this).children("#bdshare").stop().animate({"right" : "0"}, 200);
		}, function() {
			$(this).stop().animate({"width" : "92px"}, 200);
			$(this).children("#bdshare").stop().animate({"right" : "-160px"}, 200);
		});
		$(".c-share-1").hover(function() {
			$(this).stop().animate({"width" : "240px"}, 200);
			$(this).children("#bdshare").stop().animate({"right" : "0"}, 200);
		}, function() {
			$(this).stop().animate({"width" : "72px"}, 200);
			$(this).children("#bdshare").stop().animate({"right" : "-160px"}, 200);
		});
		//众筹课
		$(".c-c-up-down").click(function() {
			if (!$(".c-c-body").is(":hidden")) {
				$(".c-c-body").slideUp(300);
				$(".c-c-up-down").attr("title" , "展开");
				$(".c-c-up-down>em").removeClass("c-c-ud").addClass("c-c-down");
			} else {
				$(".c-c-body").slideDown(300);
				$(".c-c-up-down").attr("title" , "关闭");
				$(".c-c-up-down>em").removeClass("c-c-down").addClass("c-c-ud");
			};
		});
		
		
		$(".c-sort-title dd").each(function() {
			$(this).hover(function() {
				$(this).addClass("hover");
				$(this).children(".c-sort-sub-list").show();
			}, function() {
				$(this).removeClass("hover");
				$(this).children(".c-sort-sub-list").hide();
			});
		});
	}
	//头部 我的课程下拉
	function cousesMy() {
		var _timer = null;
		$(".my-course-wrap").on({
			mouseover: function() {
				var _this = $(this);
				if(_this.find(".m-c-box").is(":hidden")){
					_timer = setTimeout(function() {
						_this.addClass("my-c-show");
						if(_this.attr("name")=="aMyCourBox1") {
							$("#enwCListId").html("<dt><span>最近</span></dt>");			//清空文本的信息
	                        $("#notnewCListId").html("<dt><span>更早</span></dt>");		//清空文本的信息
	                        if(isLogin()){
	                            $.ajax({
	                                type:'post',
	                                dataType:'text',
	                                data:{},
	                                url:baselocation+'/course/ajax/his.json',
	                                async:false,
	                                success:function (result){
	                                    if(isNotEmpty(result)){
	                                        $("#studulist").removeClass('undis').html(result);
	                                    }else{
	                                        $("#nocoursebug").removeClass('undis');
	                                    }
	                                },error:function(error){
	                                    $("#nocoursebug").removeClass('undis');
	                                }
	                            });
	                        }else{
	                            $("#notLogin").removeClass('undis');
	                        }
						};
						if(_this.attr("name")=="aMyCourBox2") {
							headerCartHtml();
						}
					}, 200);
				}
			},
			mouseleave: function() {
				var _this = $(this);
				clearTimeout(_timer);
				_this.removeClass("my-c-show");
			}
		}, ".aMyCourBox");
	}

    function headerCartHtml(){
        $.ajax({
            type:'post',
            dataType:'text',
            data:{},
            url:baselocation+'/shopCart/ajax/queryUserShopCart.json',
            async:false,
            success:function (result){
                $(".carthtml").html(result);
            }
        });
    }


	//事件监听
	function stopFunc(e){
		document.all? event.cancelBubble = true : e.stopPropagation();
	}
	//星级评论
	function cStar() {
		var sWrap = $("#cStar"),
			sLi = sWrap.find("li"),
			sTxt = sWrap.find("span"),
			i = iScore = iStar = 0;
		sLi.hover(function() {
			var _index = $(this).index() + 1;
			curPoint(_index);
		}, function() {
			curPoint();
		});
		sLi.click(function() {
			var _index = $(this).index() + 1;
			var sT = $(this).find("a").attr("title");
			curPoint(_index);
			iStar = $(this).index() + 1;
			sTxt.text(sT);
		});
		function curPoint(cNum) {
			if (cNum) {
				iScore = cNum;
			} else {
				iScore = iStar;
			};
			for (i=0; i<sLi.length; i++) {
				if (i<iScore) {
					sLi.eq(i).addClass("current");
				} else {
					sLi.eq(i).removeClass("current");
				};
			};
		}

	}
	//选项卡公共方法
	function cardChange(oTitle, oCont, current) {
		console.log(1);
		var oTitle = $(oTitle),
			oCont = $(oCont),
			_index;
		oTitle.click(function() {
			_index = oTitle.index(this);
			$(this).addClass(current).siblings().removeClass(current);
			oCont.eq(_index).show().siblings().hide();
		}).eq(0).click();
	}
	/**
	 * 弹出框 
	 * @param dTitle 窗口标题
	 * @param conent 窗口内容
	 * @param idnex 窗口下标（要用哪一种窗口）
	 * 0为支付弹框1为错误弹框2为confirm弹框3登陆弹框4为正确弹框5为强制登陆6为确定跳转7为错误提示8视频试听地址
	 * @param url (确认窗口的确定按钮路径)
	 * @param loginType (登录窗口的登录类)
	 * 
	 * 如果有的点参不需要，可以传入空字符串
	 */
	function dialog(dTitle,conent,idnex,url,loginType) {
		//关闭上次弹窗
		$(".d-tips-2").remove();
		$(".dialog-shadow").remove();
		$(".bg-shadow").remove();
		dialogEle = $('<div class="dialog-shadow"><div class="dialog-ele"><h4 class="d-s-head pr"><a href="javascript:void(0)" title="关闭" class="dClose icon16 pa">&nbsp;</a><span class="d-s-head-txt">'+dTitle+'</span></h4><div id="dcWrap" class="pt20 pb20 pl20 pr20 of" style=""></div></div></div>').appendTo($("body")).addClass("animate-enter animated flyIn5");
		$.ajax({
				url:baselocation+"/Webmall/Common/dialog",
				data:{
					"dialog.title":dTitle,
					  "dialog.conent":conent,
					  "dialog.index":idnex,
					  "dialog.url":url
					  },
				type:"post",
				dataType:"text",
				async:false,
				success:function(result){
					console.log(result);
					$("#dcWrap").html(result);
				},error:function(){
                    $("#dcWrap").html("获取异常,请稍后再试试");
                }
			});
		//$("#dcWrap").html(dCont[idnex]);
		effect();
		var dTop = (parseInt(document.documentElement.clientHeight, 10)/2) + (parseInt(document.documentElement.scrollTop || document.body.scrollTop, 10)),
			dH = dialogEle.height(),
			dW = dialogEle.width(),
			dHead = $(".dialog-ele>h4");
		dialogEle.css({"top" : (dTop-(dH/2)) , "margin-left" : -(dW/2)});
		dHead.css({"width" : (dW-"12")}); //ie7下兼容性;
		$("#tisbutt,.dClose ,#qujiao").bind("click", function() {dialogEle.removeClass("animate-enter animated flyIn5").remove();});
	}
	
	function goCorder(){
		if(isLogin()){
			window.location.href=baselocation+"/order.json?queryContractCondition.currentPage=1";
		}else{
			window.location.href=baselocation+'/login.json';
		}
	}
	function showDialog(dTitle,conent) {
		var oBg = $('<div class="bg-shadow"></div>').appendTo($("body")),
		dialogEle = $('<div class="dialog-shadow"><div class="dialog-ele"><h4 class="d-s-head pr"><a href="javascript:void(0)" title="关闭" class="dClose icon16 pa">&nbsp;</a><span class="d-s-head-txt">'+dTitle+'</span></h4><div id="dcWrap" class="pt20 pb20 pl20 pr20 of" style=""></div></div></div>').appendTo($("body")).addClass("animate-enter animated flyIn5");
		
		var dCont = [
		             "<div class='d-tips-1'><em class='icon30 pa d-t-icon-1'></em><p class='fsize14 c-666'>"+conent+"</p><div class='tac mt20'><a href='javascript:void(0);' title='' class='blue-btn ml10 dClose'>确定</a></div><p class='tar mt20 c-666'></p></div>",
		             "<div></div>",
		             "<div></div>"
		             ];
		$("#dcWrap").html(dCont[0]);
		
		var dTop = (parseInt(document.documentElement.clientHeight, 10)/2) + (parseInt(document.documentElement.scrollTop || document.body.scrollTop, 10)),
		dH = dialogEle.height(),
		dW = dialogEle.width();
		dialogEle.css({"top" : (dTop-(dH/2)) , "margin-left" : -(dW/2)});
		$(".dClose").bind("click", function() {dialogEle.removeClass("animate-enter animated flyIn5").remove();oBg.remove();});
	}
	function goOrder(){
		window.location.href= baselocation+'/order.json';
	}
	function haedRequest(type){
		if(isLogin()){
			if(type==1){
			}else if(type==2){
				window.location.href= baselocation+'/sug.json';
			}	
		}else{
			if(type==2){
				if(window.location.href.indexOf('/login.json')==-1&&window.location.href.indexOf('/register.json')==-1){
					dialog('登录','',3,baselocation+'/sug.json',3);
					$("#userEmail").mailAutoComplete({
					    boxClass: "out_box", //外部box样式
					    listClass: "list_box", //默认的列表样式
					    focusClass: "focus_box", //列表选样式中
					    markCalss: "mark_box", //高亮样式
					    autoClass: false,//不使用默认的样式
					    textHint: true, //提示文字自动隐藏
					    hintText: "请输入邮箱地址"
					});
				}else{
					 if(window.location.href.indexOf('/register.json')!=-1){
						SetCookie('forward', baselocation+'/sug.json');
					}
				}
			}
		}
	}

	//录输入用户名或密码时，会清空错误提示信息
	function userOrPwdChange(type,id){
		$("#requestErrorID").html('');
		if(type==1){
			var userName=$("#"+id).val();
			if(userName!=null && userName.trim()!=''){
				$("#userNameError").html('');
				return false;
			}
		}else if(type==2){
			var pwd = $("#"+id).val();
			if(pwd!=null && pwd.trim()!=''){
				$("#passwordError").html('');
				return false;
			}
		}
	}
	
    /**
     * 得到购物加中的课程数量
     * @param id
     */
    function getCartCount(id){
    	var shorValue=getCookie('shortcars');
    	if(shorValue!=null && shorValue.trim()!=''){
    		var idArr = shorValue.split(',');
    		$("#"+id).text('有'+idArr.length+'件课程');
    	}else{
    		$("#"+id).text('有0件课程');
    	}
    }

	function goTop(){
		$("#goTop").click(function() {$("html, body").animate({scrollTop : 0}, 500);});
	}
	function gtFun() {
		var gtB = $(".onlineConsult>dl>dt");
		gtB.hide();
		var uGt = function() {
			var sTop = document.documentElement.scrollTop + document.body.scrollTop;
			if (sTop > 0) {
				gtB.show();
			} else {
				gtB.hide();
			}
		}
		$(window).bind("scroll",uGt);

		/*update by xieyl in 2016.1.25*/
		$(".onlineConsult>dl>dd").mouseenter(function(){
			$(this).find(".smgz-pic").show("normal");
		}).mouseleave(function(){
			$(this).find(".smgz-pic").hide();
		});
	}

	//右侧悬浮方法
	function fixedR() {
		$(".onlineC-item>ul>li>div").each(function() {
			var _this = $(this);
			_this.hover(function() {
				_this.find(".onlineC").stop().animate({"width" : _this.attr("name") + "px"}, 300);
			}, function() {
				_this.find(".onlineC").stop().animate({"width" : "0px"}, 300);
			});
		});
	}
	//限制登录
	function callbackFun(){
		if(isLogin()){
			$.ajax({
				url:"/check/userIsLogin.json",
				data:{},
				type : "post",
				dataType : "json",
				async:false,
				success: function (result){
					if(result.success == false){
						if (result.message == "OthersIsLogin") {
							dialog("下线提示", "您的账号在其他地方登录，若非本人操作，请重新登录。", 6, '/index');
							DeleteCookie("stime");
						}
					}else{
						setTimeout(callbackFun,10000); //time是指本身,延时递归调用自己,100为间隔调用时间,单位毫秒
					}
				}
			});
		}
	}
	//右侧获得在线咨询信息
	function rOnLineFixed() {
		$.ajax({
			url: baselocation + "/ajax/websiteProfile/online.json",
			data: {},
			dataType: "json",
			type: "post",
			success: function (result) {
				var websitemap = result.entity;//获得map
				if (websitemap != null && websitemap != '') {
					if (websitemap.online.onlineKeyWord == 'ON') {
						$(".onlineConsult").show();
					}
					$(".onlineC-item1").children("a").attr("href", websitemap.online.onlineUrl);
					$("#ewm_index").attr("src", staticImageServer + websitemap.online.onlineImageUrl);
				}
			}
		})
	}
	//全局顶部消息提示
	function abNew() {
		$.ajax({
			url: baselocation + "/front/ajax/article/getImportantArtile.json",
			type: "post",
			dataType: "json",
			cache: false,
			success: function (result) {
				if (result.success) {
					var list = result.entity;
					if (list != null && list != '') {
						var valSource = '';
						var val = '';
						//判断cookie中是否存在已浏览标识
						if (isNotNull(getCookieFromServer("importantArtile"))) {
							valSource = getCookieFromServer("importantArtile");
						}
						for (i = 0; i < list.length; i++) {
							//循环查询判断是否浏览过
							if (valSource.indexOf("," + list[i].id + ",") < 0) {
								val = "," + list[i].id + ",";
								var abEle = $('<div class="abEleBox"><div class="w1000"><span class="fr"><a href="javascript:void(0)" title="关闭" class="abClose dClose icon16">&nbsp;</a></span><em class="icon18 disIb newIcon18Cs"></em><a href="/front/toArticle/' + list[i].id + '.json" target="_blank" class="fsize12 c-orange ml5">' + list[i].title + '</a></div></div>').prependTo($("body"));
								//点击关闭存浏览cookie标识
								$(".abEleBox .abClose").bind("click", function () {
									abEle.slideUp(200);
									var d = new Date();
									d.setHours(d.getHours() + (24 * 5)); //保存5天
									if (isNull(valSource)) {
										valSource = ",";
									}
									document.cookie = "importantArtile=" + escape(valSource + list[i].id + ",") + ";expires=" + d.toGMTString() + ";path=/";
								})
								break;
							}
						}
					}
				}
			}
		});
	}