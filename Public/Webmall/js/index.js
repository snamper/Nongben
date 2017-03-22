var dersellName = '今天你想学什么课程？';
$(function() {
	//ePosition();
	$("#sellName").val(dersellName);
	cousesMy();
	goTop();
	oSlider(); //首页幻灯片
	iSortFun(".isMenu", ".i-items>.i-j-item", ".j-cateright-op", "curr"); //首页课程分类展开一
	//iSortFun(".isMenu-hp", ".i-items>.i-j-item", ".j-cateright-hp", "curr"); //首页课程分类展开二
	//iSortFun(".isMenu-fp", ".i-items>.i-j-item", ".j-cateright-fp", "curr"); //首页课程分类展开三
	upScroll("#i-itera-list"); //课程互动滚动
	newOrhot();//最新课程 热门课程tab
	iOrder(); //排行榜
	//upScroll("ul.newsNotice"); //向上滚动公告内容
	//shMnu(); //二级专业下拉
	//显示所有专业的课程
//	querycourseBySubjectId($("#allsubjectcourse"), 0);

//	cardChange(".i-oe-board-title>a", ".i-oe-board-cont>section", "current"); //首页幻灯片右侧选项卡
});
//$(function() {
//	var u = window.location.href;
//	var us = u.split('?');
//	if(us[1] == 'false' || us[1] == 'false#uPosition') {
//		dialog('提示信息', '您的帐号已在其它地方登录', 15, '/static/web/global/toIndex.html', '');
//	} else {
//		if(us[1] != undefined)
//			SetCookie(upUserId, us[1]);
//	}
//});
//首页全屏适应幻灯片
function oSlider() {
	var Wind = {};
	Wind.Focus = {
		init: function(args) {
			this.id = $(args.id);
			this.aBtn = $(args.aBtn);
			this.prev = $(args.prev);
			this.next = $(args.next);
			this.li = $(args.li);
			this.ms = 4000;
			this.auto = args.auto ? args.auto : false;
			this.on = args.on;
			this.nextTarget = 0;
			this.autoTimer = null;
			this.start();
		},
		start: function() {
			var _this = this;
			var color = this.li.eq(0).find("a").attr("name");

			if(this.aBtn.length > 1){
				//console.log(123);
				this.aBtn.eq(0).addClass(this.on);
			}
			this.id.siblings(".slideColorBg").show().css("background-color", color);
			if(this.li.length === 1) {
				this.showSlides(this.li.length);
				return;
			} else {
				this.aBtn.each(function() {
					var index = _this.aBtn.index(this);
					if(!_this.li.is(':animated')) {
						$(this).hover(function() {
							_this.showSlides(index);
						});
					}
				});
				this.autoTimer = setInterval(function() {
					_this.autoPlay();
				}, _this.ms);
				this.id.hover(function() {
					clearInterval(_this.autoTimer);
					_this.prev.fadeIn(200);
					_this.next.fadeIn(200);
				}, function() {
					_this.autoTimer = setInterval(function() {
						_this.autoPlay();
					}, _this.ms);
					_this.prev.fadeOut(200);
					_this.next.fadeOut(200);
				});
				this.next.click(function() {
					_this.nextTarget++;
					if(_this.nextTarget > _this.li.length - 1) {
						_this.nextTarget = 0;
					}
					if(!_this.li.is(':animated')) {
						_this.showSlides(_this.nextTarget);
					}
				});
				this.prev.click(function() {
					_this.nextTarget--;
					if(_this.nextTarget < 0) {
						_this.nextTarget = _this.li.length - 1;
					}
					if(!_this.li.is(':animated')) {
						_this.showSlides(_this.nextTarget);
					}
				})
			}
		},
		showSlides: function(index) {
			this.nextTarget = index;
			var color = this.li.eq(index).find("a").attr("name");
			var _thisId = this.id;
			if(!this.li.is(":animated")) {
				this.aBtn.eq(index).addClass(this.on).siblings().removeClass(this.on);
				this.li.eq(index).fadeIn(500).siblings().hide();
				_thisId.siblings(".slideColorBg").fadeIn("500", function() {
					$(this).css("background-color", color)
				});
			};
		},
		autoPlay: function() {
			this.nextTarget++;
			if(this.nextTarget > this.li.length - 1) {
				this.nextTarget = 0;
			}
			this.showSlides(this.nextTarget);
		}
	}

	Wind.Focus.init({
		//幻灯片id
		id: "#oSlideFun",
		//按钮
		aBtn: "#oSbtn a",
		//左右
		prev: "#oSlideFun .prev",
		next: "#oSlideFun .next",
		//大图li
		li: "#oSlideFun li",
		//按钮鼠标放上时
		on: "on",
		//自动播放的时间
		ms: 2000,
		//是否自动播放
		auto: true
	});
}
//向上滚动方法
function upScroll(op) {
	var _upWrap = $(op),
		_mli = _upWrap.children("li"),
		_mliH = _mli.outerHeight(),
		_sTime = 5000,
		_moving = null;
	if(_mli.length * _mliH > _upWrap.outerHeight()) {
		_upWrap.hover(function() {
			clearInterval(_moving);
		}, function() {
			_moving = setInterval(function() {
				var _mC = _upWrap.find("li:first"),
					_mH = _mC.outerHeight();
				_mC.animate({
					"margin-top": -_mH + "px"
				}, 600, function() {
					_mC.css("margin-top", 0).appendTo(_upWrap);
				});
			}, _sTime);
		}).trigger("mouseleave");
	}
}

function getNewFreeSell(aelm, type) {
	if($(aelm).parent('li').hasClass('current') == false) {
		if(type == 1) {
			$(aelm).parent('li').addClass('current');
			$(aelm).parent('li').next('li').removeClass('current');
			$("#newWelcomeSellWayListUlId").show();
			$("#newFreeSellWayListUlId").hide();
		} else if(type == 2) {
			$(aelm).parent('li').addClass('current');
			$(aelm).parent('li').prev('li').removeClass('current');
			$("#newWelcomeSellWayListUlId").hide();
			$("#newFreeSellWayListUlId").show();
		}
	}
}
//处理老师
function withTeahcer(teacherIds, teacherNames) {
	var tNames = teacherNames.replace(/\|/g, ' ').trim().replace(/ /g, '-');
	var tId = teacherIds.replace(/\|/g, ' ').trim().replace(/ /g, '-');
	tId = tId.replace(/ /g, '-');
	var tIdArr = tId.split("-");
	var tNameArr = tNames.split("-");
	var conent = '';
	for(var i = 0; i < tIdArr.length; i++) {
		if(tIdArr[i] != null && tIdArr[i] != '') {
			conent += '<a class="c-666" href="' + baselocation + '/front/teacher=' + tIdArr[i] + '&querySellWayCondition.currentPage=1" title="' + tNameArr[i] + '">' + tNameArr[i] + '&nbsp;&nbsp;</a>';
		}
	}
	return conent;
}
//首页讲师
function iTeach() {
	var ocol = $(".oc-t-list>ol");
	if(ocol.length > 0) {
		ocol.on({
			mouseenter: function() {
				$(this).find(".t-infor-wrap").animate({
					"top": "0"
				}, 200);
			},
			mouseleave: function() {
				$(this).find(".t-infor-wrap").animate({
					"top": "-122px"
				}, 200);
			}
		}, 'li');
	}
}
/**
 * 根据专业id获取课程 首页切换专业用
 * @param em
 * @param subjectId
 * @returns {Boolean}
 
function querycourseBySubjectId(em, subjectId) {
	if($(em).parent('li').hasClass('current')) {
		return false;
	}
	$.ajax({
		type: 'post',
		dataType: "text",
		url: "/front/ajax/course.json",
		data: {
			"subjectId": subjectId
		},
		async: false,
		success: function(result) {
			$("#s_c_list_ol_ID").html(result);
			//$(".s-c-list>li:nth-child(4n)").css({"margin-right" : "0px"});
			$(em).parent('li').parent('ol').find('li').removeClass('current');
			$(em).parent('li').addClass('current');
		}
	});
	scrollLoad();
}
*/
function queryPageIndex(em, type) {
	if($(em).parent('li').hasClass('current')) {
		return false;
	}
	$(em).parent('li').parent('ul').find('li').removeClass('current');
	$(em).parent('li').addClass('current');
	if(type == 1) {
		$("#oneRightUlId").hide();
		$("#groomUlId").show();
	} else {
		$("#oneRightUlId").show();
		$("#groomUlId").hide();
	}
}

function search() {
	if($("#sellName").val() != dersellName) {
		$("#sellNamehidden").val(encodeURIComponent($("#sellName").val()));
	} else {
		$("#sellNamehidden").val('');
	}
	$("#sellWayForm").submit();
}

function inputSell(type) {
	if(type == 1) {
		if($("#sellName").val() == dersellName) {
			$("#sellName").val('');
		}
	} else if(type == 2) {
		if($("#sellName").val() == null || $("#sellName").val().trim() == '') {
			$("#sellName").val(dersellName);
		}
	}
}
//课程分类展开
//iSortFun(".isMenu", ".i-items>.i-j-item", ".j-cateright-op", "curr")
function iSortFun(obj, iTem, iCont, curr) {
	//console.log(1);
	var _timer = null;
	$(obj).on({
		mouseover: function(e) {
			var _this = $(this),
				_index = _this.index();
			var item = $('.i-j-item').eq(_index);
			/*var data = item.find('input').val();
			var title = item.find('a').text();*/
			//alert(title);

			/*$.ajax({
				url : '/Webmall/Academy/get_category_list',
				data: {id:data},
				type: 'post',
				dataType: 'json',
				success: function (res) {
					console.log(res.data[0]);
					if(res.state == 'success'){
						var html = 	"<div class='hLh30 txtOf'>" +
									"<a href='' title='"+ title +"' class='c-master fsize18'>"+ title +"</a>" +
									"</div>";
						for(var i=0; i<res.data.length; i++){
							html += "<div class='v-i-tab-a'>" +
									"<a href='javascript:void(0)' onclick=courseList(257)>"+ res.data[i].name +"</a>" +
									"</div>";
						}
						$('.j-cateright-wrap').html(html);

					}
				}
			});*/
			if($(iCont).children().eq(_index).length > 0) {
				e.stopPropagation();
				_this.addClass(curr).siblings().removeClass(curr);
				_timer = setTimeout(function() {
					$(iCont).show().children().eq(_index).show().siblings().hide();
				}, 100);
				$(iCont).unbind().bind('mouseover', function(e) {
					e.stopPropagation();
					clearTimeout(_timer);
				});
				$(document).unbind().bind('mouseover', function(e) {
					e.stopPropagation();
					clearTimeout(_timer);
					_this.removeClass(curr);
					$(iCont).hide().children().eq(_index).hide();
				});
			}
		}
	}, iTem);
}
//二级专业下拉
function shMnu() {
	var iLiWrap = $(".hMenu"),
		iLi = iLiWrap.children("li"),
		timer = null;
	iLiWrap.on({
		mouseenter: function() {
			var _this = $(this),
				_liSub = _this.children(".hMenu_secord");
			if(_liSub.length > 0) {
				timer = setTimeout(function() {
					_this.addClass('current');
					_liSub.show();
				}, 300);
			}
		},
		mouseleave: function() {
			var _this = $(this),
				_liSub = _this.children(".hMenu_secord");
			if(_liSub.length > 0) {
				clearTimeout(timer);
				_this.removeClass('current');
				_liSub.hide();
			}
		}
	}, 'li[name="isli"]');
}
//排行序列TOP3
function iOrder() {
	var _order_o_free = $(".i-cc-rank-bx.free>ul>li .order"),
		_order_o_pay = $(".i-cc-rank-bx.pay>ul>li .order")
	_order_t = $(".i-ccus-rank-li>ul>li .order");
	var adFun = function(rankObj) {
		rankObj.eq(0).addClass("nb-1");
		rankObj.eq(1).addClass("nb-2");
		rankObj.eq(2).addClass("nb-3");
	}
	if(_order_o_free.length > 0) adFun(_order_o_free);
	if(_order_o_pay.length > 0) adFun(_order_o_pay);
	if(_order_t.length > 0) adFun(_order_t);
}
//左右滚动
function slideScroll(oBox, prev, next, oUl, speed, autoplay) {
	var oBox = $(oBox),
		prev = $(prev),
		next = $(next),
		oUl = $(oUl).find("ul"),
		ulW = oUl.find("li").outerWidth(true),
		oLi = oUl.find("li").length,
		s = speed,
		timer = null;
	oUl.css("width", oLi * ulW + "px");
	//click prev
	next.click(function() {
		if(!oUl.is(":animated")) {
			oUl.animate({
				"margin-left": -ulW
			}, function() {
				oUl.find("li").eq(0).appendTo(oUl);
				oUl.css("margin-left", 0);
			});
		};
	});
	//click next
	prev.click(function() {
		if(!oUl.is(":animated")) {
			oUl.find("li:last").prependTo(oUl);
			oUl.css("margin-left", -ulW);
			oUl.animate({
				"margin-left": 0
			});
		};
	});
	//autoplay
	if(autoplay === true) {
		timer = setInterval(function() {
			prev.click();
		}, s * 1000);
		oBox.hover(function() {
			clearInterval(timer);
		}, function() {
			timer = setInterval(function() {
				prev.click();
			}, s * 1000)
		})
	};
}

function goTop() {
	$("#goTop").click(function() {
		$("html, body").animate({
			scrollTop: 0
		}, 500);
	});
}

function isPay(obj) {
	$(".Top").removeClass("current");
	if(obj == "free") {
		$(".Top").eq(0).addClass("current");
		$("#free").show();
		$("#pay").hide();
	} else {
		$(".Top").eq(1).addClass("current");
		$("#free").hide();
		$("#pay").show();
	}
}

function newOrhot() {
	$(".choose").click(function() {
		$(".choose").removeClass("current");
		$(this).addClass("current");
		if($(this).attr("lang") == 'hot') {
			$("#boutiqueCourse").hide();
			$("#hotCourse").show();
		}
		if($(this).attr("lang") == 'boutique') {
			$("#boutiqueCourse").show();
			$("#hotCourse").hide();
		}
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
