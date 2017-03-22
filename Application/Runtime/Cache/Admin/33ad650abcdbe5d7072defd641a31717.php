<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumino - Dashboard</title>

    <link href="/Public/Admin/css1/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/Admin/css1/datepicker3.css" rel="stylesheet">
    <link href="/Public/Admin/css1/styles.css" rel="stylesheet">
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
    <script src="/Public/Admin/js1/bootstrap.min.js"></script>
    <script src="/Public/Admin/js1/bootstrap-table.js"></script>

    <script type="text/javascript">
        var GV = {
            JS_ROOT: "/Public/Admin/js/",
            JS_VERSION: "20141001"
        };
    </script>
    <script type="text/javascript" src="/Public/Admin/js/Wind.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <style>
        body{
            padding-left:0px;
            padding-top: 0px;
        }
    </style>
</head>



<body>
<link href="/Public/Admin/js1/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="/Public/Admin/js1/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/Admin/js1/umeditor/umeditor.js"></script>
<script type="text/javascript" src="/Public/Admin/js1/umeditor/lang/zh-cn/zh-cn.js"></script>


<script src="/Public/Admin/js1/uploadify/uploadify/jquery.uploadify.js"></script>
<script src="/Public/Admin/js1/uploadify/msgbox/jquery.msgbox.min.js"></script>
<script src="/Public/Admin/js1/uploadify/url/url.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Admin/js1/uploadify/uploadify/uploadify.css">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">资讯添加</h1>
    </div>
</div><!--/.row-->
<div class="row">
<div class="col-md-8">
<div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal J_validateForm J_ajaxForm demoform" action="<?php echo U('info/do_add');?>" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="title">标题</label>
                            <div class="col-md-9">
                                <input id="title" name="title" type="text" placeholder="标题，不超过50个字" class="form-control" datatype="*1-50" errormsg="标题不能超过50个字" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="author">作者</label>
                            <div class="col-md-9">
                                <input id="author" name="author" type="text" placeholder="作者，不超过20个字" class="form-control" datatype="s1-20" errormsg="作者不能超过20个字">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="sort">排序</label>
                            <div class="col-md-9">
                                <input id="sort" name="sort" type="text" placeholder="默认为1" class="form-control" datatype="n0-10000" errormsg="填写错误">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">图片</label>
                            <div class="col-md-9">
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="hidden" name="logo" datatype="*" nullmsg="请上传图片" value=""><!--接收上传成功后的数据表img的id-->
                                        <input type="file" id="wx-avatar"><!--上传点击按钮-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="container">内容</label>
                            <div class="col-md-9">
                                <script id="container" name="content" type="text/plain" style="width:819.75px;height:240px;"></script>
                            </div>
                        </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">是否热门</label>
                                <div class="radio col-md-9">
                                    <label>
                                        <input type="radio" name="is_hot" id="optionsRadios1" value="1">是
                                    </label>
                                    <label>
                                        <input type="radio" name="is_hot" id="optionsRadios2" value="0" checked>否
                                    </label>
                                </div>
                            </div>
                    </fieldset>
                    <div class="pop_bottom">
                        <button type="submit" class="btn btn_submit J_ajax_submit_btn">提交</button>
                        <a type="submit" class="btn" href="javascript:history.go(-1)">返回</a>
                        <span id="msgdemo2" style="margin-left:30px;"></span>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

<script src="/Public/Admin/js1/validate/Validform_v5.3.2_ncr_min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript">
    $(function(){
        var um = UM.getEditor('container');
    });
</script>
<script type="text/javascript">
    $(function() {
        var swfurl = "/Public/Admin/js1/uploadify/uploadify/";
        var uploadImgUrl = "<?php echo U('Image/uploadImage');?>";
        var __root__ = "";

        $('#wx-avatar').uploadify({
            swf: swfurl + 'uploadify.swf',//swf文件路径
            uploader: uploadImgUrl,  // 服务器端接收处理文件上传的地址，这里使用url插件取得地址栏里面的用户ID，并发送到服务器端
            // Options
            auto: true,  // 文件添加到队列后自动上传
            buttonText: '点击上传图片',  // 上传按钮上面的文字
            fileSizeLimit: '2 MB',    // 上传文件的大小限制，可以使用B\KB\MB\GB单位，填0表示不限制。
            fileTypeDesc: '图片',    //选择文件时关于文件类型的描述
            fileTypeExts: '*.jpeg;*.jpg;*.png;*.bmp',    // 选择文件时允许的扩展名
            height: 30,   // 上传按钮的高度
            width: 120,    // 上传按钮的宽度
            overrideEvents: ['onDialogClose', 'onSelectError', 'onUploadSuccess'],   //重写事件， 如果自定义了弹出窗，一定要重写onDialogClose事件，否则会跳两次窗（uploadify插件预设的警告+自己定义的弹出窗），onDialogClose设定后，uploadify预设的警告窗将不会弹出。
            onSelectError: function (file, errorCode, errorMsg) { //重写选择时候出现的错误
                var msgText = "上传失败！\n\n";
                switch (errorCode) {
                    case -100:
                        msgText += "单次上传的文件最多" + this.settings.queueSizeLimit + " 个";
                        break;
                    case -110:
                        msgText += "文件 [" + file.name + "] 大小超过限制!<br><br>温馨提示：图片大小不能超过 " + this.settings.fileSizeLimit;
                        break;
                    case -120:
                        msgText += "文件 [" + file.name + "] 大小为0，不能上传";
                        break;
                    case -130:
                        msgText += "文件 [" + file.name + "] 格式不正确，限： " + this.settings.fileTypeExts;
                        break;
                    default:
                        msgText += "错误代码:" + errorCode + "\n" + errorMsg;
                }
                $.msgbox(msgText);//调用msgbox插件弹出信息。
            },
            onUploadSuccess: function (file, data, response) {

                var data = eval("(" + data + ")");   //将回传的数据转换成json格式，这里我没有搞明白为什么要转换一次，我在其他地方后台使用$this->ajaxReturn($data)返回数据后就直接是json格式，不用转换，但是在这里不行，有知道原因的童鞋能否告知一下，谢谢。
                console.log(data);
                console.log(data.data.id);
                $('#wx-avatar').parent('.controls').find('img').remove();//将页面上原有的缩略图删除
                $('#wx-avatar').before("<img src='" + __root__ + data.data.path + "' style='height: 120px;width: 120px;padding-bottom: 10px;'>");//显示刚上传的图片的缩略图
                $('#wx-avatar').parent('.controls').find("input[name='logo']").val(data.data.id);//将图片img表中的id给到input。
            }
        });
    });
</script>
</body>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"></h1>
    </div>
</div><!--/.row-->

</html>