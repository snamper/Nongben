$(function() {
	//initValidate();
});

var isEmailVali=false;//定义全局唯一验证通过
var isMobileVali=false;//定义全局唯一验证通过
/**
 * 单独验证email
 */
function emailCheck(id){
	var emailVal=$("#regEmail").val();
	console.log(emailVal);
	if(isNotEmpty(emailVal)==false){//验证邮箱是否为空
		$("#emailError").html('<em class="icon18 vam disIb">&nbsp;</em>请输入邮箱');
		return;
	}
	/*var reg=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_])+(\.[a-zA-Z0-9_])+/; //验证邮箱正则*/
	var reg = /^[a-z0-9]+([._\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/; //验证邮箱正则
	if(reg.test(emailVal)==false){//格式不正确
		$("#emailError").html('<em class="icon18 vam disIb">&nbsp;</em>请输入正确的邮箱');
		return;
	};
	//验证邮箱是否存在
	$("#"+id+"Error").html('<tt class="o-pass"><em class="icon18 vam disIb"></em></tt>');
	return true;
}
/**
 * 单独验证密码
 * @param id
 * @returns {boolean}
 */
function passCheck(id){
	var passVal=$("#"+id).val();
	
	var pattern =/^(?!_)(?!_$)[a-zA-Z0-9_\u4e00-\u9fa5]+$/;
	if(pattern.test(passVal)==false){
		$("#"+id+"Error").html('<em class="icon18 vam disIb">&nbsp;</em>请输入密码');
		return false;
	}
	if(passVal.indexOf(" ")!=-1){
		$("#"+id+"Error").html('<em class="icon18 vam disIb">&nbsp;</em>密码不能包含空格');
		return false;
	}
	if(isNotEmpty(passVal)==false){//验证邮箱是否为空
		$("#"+id+"Error").html('<em class="icon18 vam disIb">&nbsp;</em>请输入密码');
		return false;
	}else if(passVal.length<6){
		$("#"+id+"Error").html('<em class="icon18 vam disIb">&nbsp;</em>密码不能少于六位');
		return false;
	}

	$("#"+id+"Error").html('<tt class="o-pass"><em class="icon18 vam disIb"></em></tt>');
	return true;
}
/**
 * 单独验证重复密码
 * @param id
 * @param pwdId
 * @returns {boolean}
 */
function passConfirmCheck(id,pwdId){
	var passConfirmVal=$("#"+id).val();
	var passVal=$("#"+pwdId).val();
	if(isNotEmpty(passConfirmVal)==false){//验证邮箱是否为空
		$("#"+id+"Error").html('<em class="icon18 vam disIb">&nbsp;</em>请输入重复密码');
		return false;
	}
	if(passConfirmVal!=passVal){
		$("#"+id+"Error").html('<em class="icon18 vam disIb">&nbsp;</em>两次密码输入不一致');
		return false;
	}
	$("#"+id+"Error").html('<tt class="o-pass"><em class="icon18 vam disIb"></em></tt>');
	return true;
}
/**
 * 错误提示位置
 * @param id
 */
function gohsData(id){
	$("#"+id).html('');
}

/**
 * 邮箱注册
 * @returns {boolean}
 */
function emailregister() {
	var emailVal=$("#regEmail").val();
	if(isNotEmpty(emailVal)==false){//验证邮箱是否为空
		$("#emailError").html('<em class="icon18 vam disIb">&nbsp;</em>请输入邮箱');
		return;
	}
	var reg = /^[a-z0-9]+([._\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/; //验证邮箱正则
	if(reg.test(emailVal)==false){//格式不正确
		$("#emailError").html('<em class="icon18 vam disIb">&nbsp;</em>请输入正确的邮箱');
		return;
	};
	/*if(verifyRegEmailCode=='ON'){
		if(isNotEmpty($("#randomcode").val())==false){//验证 验证码是否为空
			dialog('注册提示','请输入验证码',1);
			$("#randomcodeError").html('<em class="icon18 vam disIb">&nbsp;</em>');
			return;
		}
	}*/
	if(isNotEmpty($("#regPwd").val())==false){//验证密码是否为空
		$("#regPwdError").html('<em class="icon18 vam disIb">&nbsp;</em>请输入密码');
		return;
	}
	if($("#regPwd").val().length<6){//验证密码长度
		$("#regPwdError").html('<em class="icon18 vam disIb">&nbsp;</em>密码长度不能小于六位');
		return;
	}
	if(($("#regPwd").val()).indexOf(" ")!=-1){
		$("#regPwdError").html('<em class="icon18 vam disIb">&nbsp;</em>密码不能包含空格');
		return false;
	}
	if(isNotEmpty($("#cusPwdConfirm").val())==false){//验证确认密码是否为空
		$("#cusPwdConfirmError").html('<em class="icon18 vam disIb">&nbsp;</em>请输入确认密码');
		return;
	}
	if($("#cusPwdConfirm").val()!=$("#regPwd").val()){//验证确认密码是否相同
		$("#cusPwdConfirmError").html('<em class="icon18 vam disIb">&nbsp;</em>两次密码输入不一致');
		return;
	}
	var t268xueAgreement = $("#t268xueAgreementEmail").prop('checked');
	if(!t268xueAgreement){
		dialog('注册提示','请阅读并同意注册协议！',1);
		return;
	}

	$.ajax({
		url : baselocation + "/Webmall/Api/register",
		data : {
			"username":$("#regEmail").val(),
			"password":$("#regPwd").val(),
		},
		type : "post",
		dataType : "json",
		cache : false,
		async : false,
		success : function(result) {
			console.log(result);
			if(result.state=='success') {
				var forwordURL=getCookie("forward");
				console.log(forwordURL);
				if (typeof(forwordURL) != "undefined" && forwordURL) {
					DeleteCookie("forward");
					window.location.href = forwordURL.replaceAll('"','');
					return;
				}
				window.location.href = baselocation + "/Webmall/Personal/personal";
			}else if(result.message == 'formDataIsNot'){
				dialog('注册提示','表单数据不为能为空',1);
			}else if(result.message == 'emailIsNot'){
				$("#emailError").html('<em class="icon18 vam disIb">&nbsp;</em>请输入邮箱');
			}else if(result.message == 'emailFormatError'){
				$("#emailError").html('<em class="icon18 vam disIb">&nbsp;</em>请输入正确的邮箱');
			}else if(result.message == 'pwdIsNull'){
				$("#regPwdError").html('<em class="icon18 vam disIb">&nbsp;</em>请输入密码');
			}else if(result.message == 'pwdNotEqual'){
				$("#cusPwdConfirmError").html('<em class="icon18 vam disIb">&nbsp;</em>两次密码输入不一致');
			}else if(result.message == "regEmailExist") {
				$("#emailError").html('<em class="icon18 vam disIb">&nbsp;</em>您的邮箱已经注册');
			}else if(result.message == "regDangerWord") {
				dialog('注册提示','请不要输入非法关键字',1);
			}else if(result.message == "邮箱验证码错误") {
				dialog('注册提示','邮箱验证码错误',1);
				$("#randomcodeError").html('<em class="icon18 vam disIb">&nbsp;</em>');
			}else {
				dialog('注册提示',result.message,1);
			}
		},
		error : function(error) {
			dialog('注册提示','系统繁忙，请稍后再操作',1);
		}
	});
}

/**
 * 判断字符串是否为空
 * @param str
 * @returns {Boolean}
 */
function isNotEmpty(str) {
    if (str == null || str == "" || str.trim() == '') {
        return false;
    }
    return true;
}

function isEmpty(str) {
    if (str == null || str == "" || str.trim() == '') {
        return true;
    }
    return false;
}

//checkbox控件
$(".inpCb").click(function() {
    if($(this).find("input").is(":checked") == false) {
        $(this).addClass("unforget");
    } else {
        $(this).removeClass("unforget");
    };
});