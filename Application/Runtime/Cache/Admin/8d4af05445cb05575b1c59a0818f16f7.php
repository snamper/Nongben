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

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">用户管理</h1>
    </div>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <table data-toggle="table" data-url="/Public/Admin/tables/data.json"  data-show-refresh="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                    <thead>
                    <tr>
                        <th data-field="state" data-checkbox="true" >ID</th>
                        <th data-field="id" data-sortable="true">ID</th>
                        <th>用户名</th>
                        <th>登陆次数</th>
                        <th>最后一次登陆时间</th>
                        <th>注册时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if(is_array($list)): foreach($list as $key=>$info): ?><tr>
                            <td class="bs-checkbox">
                                <input data-index="0" name="toolbar1" type="checkbox">
                            </td>
                            <td><?php echo ($info["id"]); ?></td>
                            <td><?php echo ($info["username"]); ?></td>
                            <td><?php echo ($info["login_count"]); ?></td>
                            <td><?php echo ($info["gmt_login"]); ?></td>
                            <td><?php echo ($info["gmt_create"]); ?></td>
                            <td>
                                <a href="<?php echo U('do_del',array('id'=>$info['id']));?>" class="tablelink J_ajax_del" title="删除">[删除]</a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!--/.row-->
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
</body>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"></h1>
    </div>
</div><!--/.row-->

</html>