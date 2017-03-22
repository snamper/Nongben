$(function(){
	queryUnReadNum();
	msgTwinkle();//未读消息闪烁
	chageNavCurr();//当前页面导航选中切换
	ssFun();//顶部搜索下拉类型选择
});
var sec=0;
var interval=0;
function queryUnReadNum(){//查询未读消息
	if(!isLogin()){
		return;
	}
	$.ajax({
		type : "POST",
		dataType : "json",
		url:baselocation+"/letter/queryUnReadLetter.json",
		cache : true,
		async : false,
		success : function(result) {
			var letter = result.entity;
			if(letter==null){
				return;
			}

			if(letter=="teacher"){
				$("#msgnotice").hide();
				return ;
			}

			//未读系统消息数
			var systemNum = letter.SMNum;
			//未读站内信数
			var letterNum = letter.mNum;
			//未读粉丝数
			var unreadFansNum = letter.unreadFansNum;
			unReadNum = letter.unReadNum;
			if(unReadNum!=0){
				$("#msgCountId").removeClass("undis");
				//$("#msgCountId").before('<span class="gt-mail-num" title="'+unReadNum+'条未读消息"></span>');
			}
			$("#msgCountId").attr("title",unReadNum+"条未读消息");
			$("#msgCountId").html(unReadNum);
		}
	});
}
//未读消息闪烁
function msgTwinkle(){
	var msgCount = $("#msgCountId").html();
	if(msgCount>0){
		interval= setInterval('twinkle()',800);
	}
}
function twinkle(){
	if($("#msgCountId").is(":hidden")){
		$("#msgCountId").animate({"opacity" : "0" }, 800, function() {
			$("#msgCountId").css({"opacity" : "1" })
		});
	}else{$("#msgCountId").animate({"opacity" : "1" }, 800, function() {
		$("#msgCountId").css({"opacity" : "0" })
	});
	}
	sec = sec+1;
	//闪动三秒后，不闪动
//	if(sec>4){
//		$("#msgCountId").animate({"opacity" : "1" });
//		clearInterval(interval);
//	}
}
//当前页面导航选中切换
function chageNavCurr() {
	var url = window.document.location.pathname;
	$("a[href$='" + url + "']").parent().addClass("current");

	if (url.indexOf("teacherlist") > 0) {
		searchType('TEACHER');
	} else if (url.indexOf("showpackagecoulist") > 0) {
		searchType('PACKAGE');
	}else if (url.indexOf("linecourse") > 0) {
		searchType('LINECOURSE');
	} else {
		searchType('COURSE');
	}
}
//顶部搜索下拉类型选择
function ssFun() {
	var _sBox = $(".t-s-select"),
			_sTxt = $(".s-vv-txt>tt"),
			_sOl = _sBox.children(".s-vv-ol"),
			_sLi = $(".s-vv-ol>li");
	_sBox.hover(function () {
		_sOl.stop().slideDown(50);
	}, function () {
		_sOl.stop().slideUp(50);
	});
	_sLi.each(function () {
		var _this = $(this);
		_this.click(function () {
			if (!_this.hasClass("current")) {
				_sTxt.html(_this.children("a").text());
				_this.addClass("current").siblings().removeClass("current");
			}
			;
			_sOl.hide();
		})
	})
}
/**
 * 搜索
 **/
function getSearch() {
	var searchStr = $("#searchInput").val().trim();
	if (searchStr != $("#searchInput").attr("placeholder")) {
		$("#searchName").val(searchStr);
	}
	$("#formSearch").submit();
}
/**
 * 初始化选择搜索类型
 * @param type
 */
function searchType(type) {
	if (type == "PACKAGE") {
		$("#formSearch").attr("action", "/front/showpackagecoulist.json");
		$("#searchInput").attr("placeholder", "输入你想学的套餐课程");
	} else if (type == "TEACHER") {
		$("#formSearch").attr("action", "/front/teacherlist.json");
		$("#searchInput").attr("placeholder", "输入你要查找的专家");
		$("#searchName").attr("name", "teacher.name");
	}else if (type == "LINECOURSE") {
		$("#formSearch").attr("action", "/front/linecourselist.json");
		$("#searchInput").attr("placeholder", "输入你想学的线下课程");
		$("#searchName").attr("name", "queryLineCourse.name");
	}else {
		$("#formSearch").attr("action", "/front/showcoulist.json");
		$("#searchInput").attr("placeholder", "输入你想学的课程");
		$("#searchName").attr("name", "queryCourse.name");
	}
}