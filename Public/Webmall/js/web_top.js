$(function() {
	// 头部登陆未登录状态是否显示
	showLoginInfo();
	headerShow();
    showshopnums();//显示购物车数量
});
//联合登录,重新打开窗口
function oauthLogin(appType){
    window.location.href=baselocation+"/app/authlogin.json?appType="+appType;
}

/** 前台页面显示登录层* */
function showLoginInfo() {
	var entity = getLoginUser();
	if(isNotNull(entity)){
		$(".newsLi,.outLi,.userNameLi,.cus-center").removeClass('undis');
		$("#loginMsgOn").show();
		$("#loginMsgOFF").hide();
        if( entity && entity.nickname && isNotEmpty(entity.nickname)){//昵称
            $(".cusName").html(entity.nickname);
        }else{
			if(entity && entity.email && isNotEmpty(entity.email)){
				$(".cusName").html(entity.email);//邮箱
			}else{
				$(".cusName").html(entity.mobile);//手机号码
			}
        }
        if(entity.avatar && isNotEmpty(entity.avatar)){
            $("#cusImg").attr("src",staticImageServer+entity.avatar);
            //只用于修改头像处
            //$(".jcrop-preview").attr("src",staticImageServer+entity.avatar);
            $("#userImgId").attr("src",staticImageServer+entity.avatar);
        }else{
            $("#cusImg").attr("src","/static/common/images/user_default.jpg");
            $("#userImgId").attr("src","/static/common/images/user_default.jpg");
        }
	}else{
		$(".forgetPasswordLi,.registerLi,.loginLi").removeClass('undis');
	}
}

// 继续购买
function goCorder() {
	if (isLogin()) {
		window.location.href = baselocation
				+ "/order.json?queryContractCondition.currentPage=1";
	} else {
		window.location.href = baselocation + '/login.json';
	}
}
// 提示消息
function showDialog(dTitle, conent) {
	var oBg = $('<div class="bg-shadow"></div>').appendTo($("body")), dialogEle = $('<div class="dialog-shadow"><div class="dialog-ele"><h4 class="d-s-head pr"><a href="javascript:void(0)" title="关闭" class="dClose icon16 pa">&nbsp;</a><span class="d-s-head-txt">'
			+ dTitle
			+ '</span></h4><div id="dcWrap" class="pt20 pb20 pl20 pr20 of" style=""></div></div></div>')
			.appendTo($("body"));

	var dCont = [
			"<div class='d-tips-1'><em class='icon30 pa d-t-icon-1'></em><p class='fsize14 c-666'>"
					+ conent
					+ "</p><div class='tac mt20'><a href='javascript:void(0);' title='' class='blue-btn ml10 dClose'>确定</a></div><p class='tar mt20 c-666'></p></div>",
			"<div></div>", "<div></div>"];
	$("#dcWrap").html(dCont[0]);

	var dTop = (parseInt(document.documentElement.clientHeight, 10) / 2)
			+ (parseInt(document.documentElement.scrollTop
							|| document.body.scrollTop, 10)), dH = dialogEle
			.height(), dW = dialogEle.width();
	dialogEle.css({
				"top" : (dTop - (dH / 2)),
				"margin-left" : -(dW / 2)
			});
	$(".dClose").bind("click", function() {
				dialogEle.remove();
				oBg.remove();
			});
}
// 已完成支付
function goOrder() {
	window.location.href = baselocation + '/order.json';
}

// 录输入用户名或密码时，会清空错误提示信息
function userOrPwdChange(type, id) {
	$("#requestErrorID").html('');
	if (type == 1) {
		var userName = $("#" + id).val();
		if (userName != null && userName.trim() != '') {
			$("#userNameError").html('');
			return false;
		}
	} else if (type == 2) {
		var pwd = $("#" + id).val();
		if (pwd != null && pwd.trim() != '') {
			$("#passwordError").html('');
			return false;
		}
	}
}

/**
 * 头部点击哪一个，就改其中的样式
 */
function headerShow() {
	var index = '/index.json';
	var course = '/front/showcoulist.json';
	var teahcer = '/front/teacherlist.json';
	var article = '/front/articlelist.json';
	var atricleInfo = '/front/toArticle.json';
	var courseInfo = '/front/couinfo.json';

	var pageUrl = window.location;
	pageUrl = pageUrl + '';
	if (urlindexOf(pageUrl, index)) {
		$("#headerindex").addClass('current');
	} else if (urlindexOf(pageUrl, course) || urlindexOf(pageUrl, courseInfo)) {
		$("#headercourse").addClass('current');
	} else if (urlindexOf(pageUrl, teahcer)) {
		$("#headerteacher").addClass('current');
	} else if (urlindexOf(pageUrl, article) || urlindexOf(pageUrl, atricleInfo)) {
		$("#headerarticle").addClass('current');
	}
}
// str1是否包含str2
function urlindexOf(str1, str2) {
	return str1.indexOf(str2) != -1;
}

// commonjs
// 收藏本站
function addFavorite() {
	var _url = baselocation, _tit = '268xue在线';
	if (window.sidebar && window.sidebar.addPanel) {// 新版火狐不再支持window.sidebar.addPanel
		try {
			window.sidebar.addPanel(_tit, _url, "");
		} catch (e) {
			showDialog('提示消息',
					'您使用的浏览器不支持此操作。\n请使用 Ctrl + D 进行添加，或手动在浏览器里进行设置。');
		}
	} else if (document.all) {// IE类浏览器
		try {
			var external = window.external;
			external.AddFavorite(_url, _tit);
		} catch (e) {
			showDialog('提示消息',
					'国内开发的360浏览器等不支持主动加入收藏\n请使用 Ctrl + D 进行添加，或手动在浏览器里进行设置。');
		}
	} else {
		showDialog('提示消息', '您使用的浏览器不支持此操作。\n请使用 Ctrl + D 进行添加，或手动在浏览器里进行设置。');
	}
}
//购买商品
function BuyNow(courseId){
    //添加到购物车
	$.ajax({//验证课程金额
		url:baselocation+"/course/check/"+courseId+".json",
		type:"post",
		dataType:"json",
		success:function(result){
			if(result.message!='true'){
				dialog('提示信息',result.message,1);
			}else{
				window.location.href="/shopcart.json?goodsid="+courseId+"&type=1&command=addShopitem";
			}
		}
	})
}

//购买套餐商品
function BuyPackageNow(courseIds){
	//添加到购物车
	$.ajax({//验证课程金额
		url:baselocation+"/course/checkPackageCourseInfo.json",
		data:{"courseIds":courseIds},
		type:"post",
		dataType:"json",
		success:function(result){
			if(result.message!='true'){
				dialog('提示信息',result.message,1);
			}else{
				window.location.href="/shopcart.json?goodsid="+courseIds+"&type=1&command=addShopitem";
			}
		}
	})
}

// 加入收藏
function addFavorite(){
	var _url = baselocation,
	_tit = '268xue在线';
	if(window.sidebar && window.sidebar.addPanel) {//新版火狐不再支持window.sidebar.addPanel
		try{
			window.sidebar.addPanel(_tit, _url, "");
		}catch (e) {
			showDialog('提示消息','您使用的浏览器不支持此操作。\n请使用 Ctrl + D 进行添加，或手动在浏览器里进行设置。');
		}
	}else if(document.all) {//IE类浏览器
		try{
		var external = window.external;
		external.AddFavorite(_url, _tit);
		}catch(e){
			showDialog('提示消息','国内开发的360浏览器等不支持主动加入收藏\n请使用 Ctrl + D 进行添加，或手动在浏览器里进行设置。');
		}
	}else {
		showDialog('提示消息','您使用的浏览器不支持此操作。\n请使用 Ctrl + D 进行添加，或手动在浏览器里进行设置。');
	}
}

//课程收藏
 function house(courseId,type){
	 console.log(courseId,type);
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
						alert($(this).text());
					}else{
						dialog('操作提示','操作失败',1);
					}
 				}
 			});
 	}

//视频播放
function play(courseId){
	console.log(courseId);
	$.ajax({
		url:baselocation+"/Webmall/Academy/start",
		data:{'course_id':courseId},
		type : "post",
		dataType : "json",
		success: function (result){
			//window.location.href = baselocation + "/Webmall/Academy/play?id=" +courseId;
			//console.log(result);
			if(result.code == "301"){
				window.location.href = baselocation + "/Webmall/User/login";
			}else if(result.code == '200'){
				window.location.href = baselocation + "/Webmall/Academy/play?id=" +courseId;
			}else{
				dialog('操作提示','操作失败',1);
			}
		}
	});
}

/**
 * 公共ajax登录方法
 * @param type 登录类型 1重新加载本页面,2跳转到首页，3跳转到传来的URL
 * @param url 要转向的路径
 */
function pageLogin(type,url){
    var userName=$("#userEmail").val();
    var pwd = $("#userPassword").val();
    var autoThirty=$("#autoThirty").prop("checked");
	var userType=$("#userType").val();
    $("#passwordError").html('');
    $("#userNameError").html('');
    $("#requestErrorID").html('');
    if(!isNotEmpty(userName)){
        $("#userNameError").html('<em class="icon18 vam disIb newIcon18Cs"></em><font class="fsize12">输入用户名</font>');
        return false;
    }
    if(!isNotEmpty(pwd)){
        $("#passwordError").html('<em class="icon18 vam disIb newIcon18Cs"></em><font class="fsize12">请输入密码</font>');
        return false;
    }
    $.ajax({
        url : baselocation + "/Webmall/User/userLogin",
        data : {'username':userName,'password':pwd},
        type : "post",
        dataType : "json",
        cache : false,
        async : false,
        success : function(result) {
            if(result.state=='success'){
				if(type==1){
					window.location.reload();
				}else if(type==2){
					window.location.href = baselocation+'/Webmall/Academy/index.html';
				}else if(type==3){
					window.location=url;
				}
            }else{
				dialog('登录提示','用户名或者密码不正确',1);
            }
        }
    });
}
var resultfalg = null;

//请求获得子系统设置cookie链接发送跨域请求
function queryoss(){
	$.ajax({
		async : false,
		url : baselocation + "/querysso.json?jsoncallback=?",
		data : {},
		type : "get",
		dataType : "text",
		cache : false,
		success : function(result) {
			var str = '<div style="display:none;" id="oss_url_append"></div>';
			$("body").append(str);
			$("#oss_url_append").html(result);

		}
	});
}
function sleep(numberMillis) {
	var now = new Date();
	var exitTime = now.getTime() + numberMillis;
	while (true) {
		now = new Date();
		if (now.getTime() > exitTime)
			return;
	}
}

/**
 * 显示购物车数量
 */
function showshopnums(){
    $.ajax({
        url:"/shopCart/ajax/shopcartnums.json",
        data:{"type":1},
        type : "post",
        dataType : "json",
        success: function (result){
            if(result.entity && isNotNull(result.entity ) && result.entity.shopCartNum>0){
                $("#myCartNum").html(result.entity.shopCartNum);
                $("#myCartNum").show();
            }else{
                $("#myCartNum").html(0);
                $("#myCartNum").hide();
            }
        }
    });
}

//删除购物车
function deleteCartId(id,goodsid,type) {
	alert(321321);
    $.ajax({
        url : baselocation + "/shopcart/ajax/deleteShopitem.json",
        data : {
            "id":id,
            'goodsid' : goodsid,
            "type":type
        },
        type : "post",
        dataType : "json",
        async : false,
        cache : false,
        success : function(result) {
            headerCartHtml();
        }
    });
}

//角色登录切换
function toggleLoginMenu(userType,obj){
	$(".roleToggle").removeClass("current");
	$(obj).parent().addClass("current");
	$("#userType").val(userType);
}