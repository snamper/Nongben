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
<script src="/Public/Admin/js1/uploadify/uploadify/jquery.uploadify.js"></script>
<script src="/Public/Admin/js1/uploadify/msgbox/jquery.msgbox.min.js"></script>
<script src="/Public/Admin/js1/uploadify/url/url.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Admin/js1/uploadify/uploadify/uploadify.css">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">课程修改</h1>
    </div>
</div><!--/.row-->
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal J_validateForm J_ajaxForm demoform" action="<?php echo U('course/do_edit');?>" method="post">
                    <fieldset>
                        <input type="hidden" value="<?php echo ($course["id"]); ?>" name="id">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="title">课程名称</label>
                            <div class="col-md-9">
                                <input id="title" name="name" type="text" placeholder="课程名称，不超过50个字" class="form-control" datatype="*1-50" errormsg="课程名称不能超过50个字" value="<?php echo ($course["name"]); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="description">简介</label>
                            <div class="col-md-9">
                                <textarea id="description" name="description" datatype="*1-1000" placeholder="课程简介，不超过1000个字" class="form-control" errormsg="课程简介不能超过1000个字"><?php echo ($course["description"]); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="teacher">课程讲师</label>
                            <div class="col-md-9">
                                <input id="teacher" name="teacher" type="text" placeholder="课程讲师，不超过20个字" class="form-control" datatype="*1-20" errormsg="课程讲师不能超过20个字" value="<?php echo ($course["teacher"]); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="category_id">课程分类</label>
                            <div class="col-md-9">
                                <input type="hidden" id="category_id" name="category_id" datatype="*" nullmsg="请选择课程分类" value="<?php echo ($course["category_id"]); ?>">
                                <table>
                                    <tr>
                                        <td>
                                            <select id="first" class="J_ajax_select length_4 form-control" data-init="true" data-val="category_id" data-value="<?php echo ($category["0"]); ?>" data-url="<?php echo U('category/get_category_list');?>" data-target="second">
                                                <option value="">请选择</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="second" class="J_ajax_select length_4 form-control" data-val="category_id" data-target="third" data-value="<?php echo ($category["1"]); ?>" data-url="<?php echo U('category/get_category_list');?>">
                                                <option value="">请选择</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="third" class="J_ajax_select length_4 form-control" data-val="category_id" data-value="<?php echo ($category["2"]); ?>" data-url="<?php echo U('category/get_category_list');?>">
                                                <option value="">请选择</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">图片</label>
                            <div class="col-md-9">
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="hidden" name="image" datatype="*" nullmsg="请上传图片" value="<?php echo ($course["image"]); ?>"><!--接收上传成功后的数据表img的id-->
                                        <img src="<?php echo ($course["path_img"]); ?>" style="width: 120px;height:120px;padding-bottom: 10px;">
                                        <input type="file" id="wx-avatar"><!--上传点击按钮-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">课程视频</label>
                            <div class="col-md-9">
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="hidden" name="video" datatype="*" nullmsg="请上传视频" value="<?php echo ($course["video"]); ?>"><!--接收上传成功后的数据表img的id-->
                                        <video src="<?php echo ($course["path_video"]); ?>" style="width: 200px;height:200px;padding-bottom: 10px;" controls="controls"></video>
                                        <input type="file" id="wx-video"><!--上传点击按钮-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">是否推荐</label>
                            <div class="radio col-md-9">
                                <label>
                                    <input type="radio" name="is_recommend" id="optionsRadios1" value="1">是
                                </label>
                                <label>
                                    <input type="radio" name="is_recommend" id="optionsRadios2" value="0" checked>否
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
    $(function() {
        var swfurl = "/Public/Admin/js1/uploadify/uploadify/";
        var uploadImgUrl = "<?php echo U('Image/uploadImage');?>";
        var uploadVideoUrl = "<?php echo U('Image/uploadVideo');?>";
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
                $('#wx-avatar').parent('.controls').find("input[name='image']").val(data.data.id);//将图片img表中的id给到input。
            }
        });

        $('#wx-video').uploadify({
            swf: swfurl + 'uploadify.swf',//swf文件路径
            uploader: uploadVideoUrl,  // 服务器端接收处理文件上传的地址，这里使用url插件取得地址栏里面的用户ID，并发送到服务器端
            // Options
            auto: true,  // 文件添加到队列后自动上传
            buttonText: '点击上传视频',  // 上传按钮上面的文字
            fileSizeLimit: '200 MB',    // 上传文件的大小限制，可以使用B\KB\MB\GB单位，填0表示不限制。
            fileTypeDesc: '视频',    //选择文件时关于文件类型的描述
            fileTypeExts: '*.mp4;*.avi;*.wmv;',    // 选择文件时允许的扩展名
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
                $('#wx-video').parent('.controls').find('video').remove();//将页面上原有的缩略图删除
                $('#wx-video').before("<video src='" + __root__ + data.data.path + "' style='width:200px;height:200px;padding-bottom: 10px;' controls='controls'></video>");//显示刚上传的图片的缩略图
                $('#wx-video').parent('.controls').find("input[name='video']").val(data.data.id);//将图片img表中的id给到input。
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