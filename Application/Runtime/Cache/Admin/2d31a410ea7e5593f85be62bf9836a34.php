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
        <h1 class="page-header">溯源产品编辑</h1>
    </div>
</div><!--/.row-->
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal J_validateForm J_ajaxForm demoform" action="<?php echo U('source/do_edit');?>" method="post">
                    <fieldset>
                        <input type="hidden" name="id" value="<?php echo ($source["id"]); ?>">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">产品名称</label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text" placeholder="产品名称，不超过10个字" class="form-control" datatype="s1-10" errormsg="产品名称不能超过10个字" value="<?php echo ($source["name"]); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="author">来源地</label>
                            <div class="col-md-9">
                                <input id="author" name="source" type="text" placeholder="来源地，不超过10个字" class="form-control" datatype="*1-10" errormsg="来源地不能超过10个字" value="<?php echo ($source["source"]); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="sort">排序</label>
                            <div class="col-md-9">
                                <input id="sort" name="sort" type="text" placeholder="默认为1" class="form-control" datatype="n0-10000" errormsg="填写错误" value="<?php echo ($source["sort"]); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">图片</label>
                            <div class="col-md-9">
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="hidden" name="logo" datatype="*" nullmsg="请上传图片" value="<?php echo ($source["logo"]); ?>">
                                        <img src='<?php echo ($source["img_path"]); ?>' style='height: 120px;width: 120px;padding-bottom: 10px;'>
                                        <input type="file" id="wx-avatar">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">二维码</label>
                            <div class="col-md-9">
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="hidden" name="code" datatype="*" nullmsg="请上传二维码" value="<?php echo ($source["code"]); ?>">
                                        <img src='<?php echo ($source["code_path"]); ?>' style='height: 120px;width: 120px;padding-bottom: 10px;'>
                                        <input type="file" id="wx-code">
                                    </div>
                                </div>
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
        var __root__ = "";

        $('#wx-avatar').uploadify({
            swf: swfurl + 'uploadify.swf',
            uploader: uploadImgUrl,
            auto: true,
            buttonText: '点击上传图片',
            fileSizeLimit: '2 MB',
            fileTypeDesc: '图片',
            fileTypeExts: '*.jpeg;*.jpg;*.png;*.bmp',
            height: 30,
            width: 120,
            overrideEvents: ['onDialogClose', 'onSelectError', 'onUploadSuccess'],
            onSelectError: function (file, errorCode, errorMsg) {
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
                $.msgbox(msgText);
            },
            onUploadSuccess: function (file, data, response) {

                var data = eval("(" + data + ")");
                console.log(data);
                console.log(data.data.id);
                $('#wx-avatar').parent('.controls').find('img').remove();//将页面上原有的缩略图删除
                $('#wx-avatar').before("<img src='" + __root__ + data.data.path + "' style='height: 120px;width: 120px;padding-bottom: 10px;'>");//显示刚上传的图片的缩略图
                $('#wx-avatar').parent('.controls').find("input[name='logo']").val(data.data.id);//将图片img表中的id给到input。
            }
        });

        $('#wx-code').uploadify({
            swf: swfurl + 'uploadify.swf',
            uploader: uploadImgUrl,
            // Options
            auto: true,
            buttonText: '点击上传二维码',
            fileSizeLimit: '2 MB',
            fileTypeDesc: '图片',
            fileTypeExts: '*.jpeg;*.jpg;*.png;*.bmp',
            height: 30,
            width: 120,
            overrideEvents: ['onDialogClose', 'onSelectError', 'onUploadSuccess'],
            onSelectError: function (file, errorCode, errorMsg) {
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
                $.msgbox(msgText);
            },
            onUploadSuccess: function (file, data, response) {

                var data = eval("(" + data + ")");
                console.log(data);
                console.log(data.data.id);
                $('#wx-code').parent('.controls').find('img').remove();//将页面上原有的缩略图删除
                $('#wx-code').before("<img src='" + __root__ + data.data.path + "' style='height: 120px;width: 120px;padding-bottom: 10px;'>");//显示刚上传的图片的缩略图
                $('#wx-code').parent('.controls').find("input[name='code']").val(data.data.id);//将图片img表中的id给到input。
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