<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumino - Dashboard</title>

    <link href="/Public/Admin/css1/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/Admin/css1/datepicker3.css" rel="stylesheet">
    <link href="/Public/Admin/css1/styles.css" rel="stylesheet">
    <link href="/favicon.ico" rel="shortcut icon">
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



<body style="padding-top:0px;">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">最新数据</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-blue panel-widget ">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <em class="glyphicon glyphicon-shopping-cart glyphicon-l"></em>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">120</div>
                        <div class="text-muted">商城新增订单</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-orange panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <em class="glyphicon glyphicon-comment glyphicon-l"></em>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">52</div>
                        <div class="text-muted">跟我学新增评论</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-teal panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <em class="glyphicon glyphicon-user glyphicon-l"></em>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">24</div>
                        <div class="text-muted">新注册用户</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-red panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <em class="glyphicon glyphicon-stats glyphicon-l"></em>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">25.2k</div>
                        <div class="text-muted">网站浏览量</div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">近几月浏览量（灰）/订单量（蓝）统计</div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>商城新增订单</h4>
                    <div class="easypiechart" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>跟我学新增评论</h4>
                    <div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>新注册用户</h4>
                    <div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>网站浏览量</h4>
                    <div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->

    </div><!--/.row-->

<script src="/Public/Admin/js1/jquery-1.11.1.min.js"></script>
<script src="/Public/Admin/js1/bootstrap.min.js"></script>
<script src="/Public/Admin/js1/chart.min.js"></script>
<script src="/Public/Admin/js1/chart-data.js"></script>
<script src="/Public/Admin/js1/easypiechart.js"></script>
<script src="/Public/Admin/js1/easypiechart-data.js"></script>
<script src="/Public/Admin/js1/bootstrap-datepicker.js"></script>

</body>

</html>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"></h1>
    </div>
</div><!--/.row-->

</html>