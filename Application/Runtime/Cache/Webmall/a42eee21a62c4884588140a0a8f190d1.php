<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<title>用户登录 · 注册</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=9, IE=8" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/page-style.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Webmall/css/theme.css" />
		<script src="/Public/Webmall/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
		<!--[if lt IE 9]><script src="http://nt1.268xue.com/static/common/html5.js"></script><![endif]-->
		<style type="text/css">
			.ness-wrap {
				display: none;
			}
			
			.phcolor {
				color: #999;
			}
			#container1{
				margin: 0 50px;
			}
			#container2{
				
			}
		</style>

	</head>

	<body class="W-body">
		<input id="shareUser" type="hidden" value="" />
		<!-- /登录 头 -->
		<div class="rl-header">
			<section class="w1000">
				<aside class="rl-tel"><span class="c-master fsize20 f-fM">Email：service@nbnb.net.cn</span></aside>
				<h1 class="of unFw lr-logo">
				<a href="index.html"><img src="/Public/Webmall/images/logo.png" class="logo-2013" style="margin-top:30px;"/></a>
			</h1>
				<div class="rl-subTitle"><span class="c-master fsize20 f-fM fromflagtitle">在线监测</span></div>
				<div class="clear"></div>
			</section>
		</div>
		<div id="container" style="width:100%;">
			<div id="container1" style="margin-top:100px;width: 500px;height: 500px;float: left;">
			</div>
			<div id="container2" style="margin-top:100px;width: 600px;height: 500px;float: left;">
			</div>
		</div>
		<!-- /登录 -->
		<script src="/Public/Webmall/js/echarts.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			var dom = document.getElementById("container1");
			var myChart1 = echarts.init(dom);
			var app = {};

			function randomData() {
				now = new Date(+now + oneDay);
				value = value + Math.random() * 21 - 10;
				return {
					name: now.toString(),
					value: [
						[now.getFullYear(), now.getMonth() + 1, now.getDate()].join('/'),
						Math.round(value)
					]
				}
			}

			var data = [];
			var now = +new Date(2016, 12, 3);
			var oneDay = 24 * 3600 * 1000;
			var value = Math.random() * 1000;
			for(var i = 0; i < 1000; i++) {
				data.push(randomData());
			}

			var option = {
				title: {
					text: 'CO2浓度随时间变化折线图'
				},
				tooltip: {
					trigger: 'axis',
					formatter: function(params) {
						params = params[0];
						var date = new Date(params.name);
						return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() + ' : ' + params.value[1];
					},
					axisPointer: {
						animation: false
					}
				},
				toolbox: {
			        show: true,
			        feature: {
			            dataZoom: {
			                yAxisIndex: 'none'
			            },
			            dataView: {readOnly: false},
			            magicType: {type: ['line', 'bar']},
			            restore: {},
			            saveAsImage: {}
			        }
			    },
				xAxis: {
					type: 'time',
					splitLine: {
						show: false
					}
				},
				yAxis: {
					type: 'value',
					boundaryGap: [0, '100%'],
					splitLine: {
						show: false
					}
				},
				series: [{
					name: '模拟数据',
					type: 'line',
					showSymbol: false,
					hoverAnimation: false,
					data: data
				}]
			};

			setInterval(function() {

				for(var i = 0; i < 5; i++) {
					data.shift();
					data.push(randomData());
				}

				myChart1.setOption({
					series: [{
						data: data
					}]
				});
			}, 1000);
			if(option && typeof option === "object") {
				myChart1.setOption(option, true);
			}
		</script>
		<script>
			var dom = document.getElementById("container2");
			var myChart2 = echarts.init(dom);
			
			var option = {
			    title: {
			        text: '过去一周大棚内温度变化',
			        subtext: '纯属虚构'
			    },
			    tooltip: {
			        trigger: 'axis'
			    },
			    legend: {
			        data:['最高气温','最低气温']
			    },
			    toolbox: {
			        show: true,
			        feature: {
			            dataZoom: {
			                yAxisIndex: 'none'
			            },
			            dataView: {readOnly: false},
			            magicType: {type: ['line', 'bar']},
			            restore: {},
			            saveAsImage: {}
			        }
			    },
			    xAxis:  {
			        type: 'category',
			        boundaryGap: false,
			        data: ['周一','周二','周三','周四','周五','周六','周日']
			    },
			    yAxis: {
			        type: 'value',
			        axisLabel: {
			            formatter: '{value} °C'
			        }
			    },
			    series: [
			        {
			            name:'最高气温',
			            type:'line',
			            data:[11, 11, 15, 13, 12, 13, 10],
			            markPoint: {
			                data: [
			                    {type: 'max', name: '最大值'},
			                    {type: 'min', name: '最小值'}
			                ]
			            },
			            markLine: {
			                data: [
			                    {type: 'average', name: '平均值'}
			                ]
			            }
			        },
			        {
			            name:'最低气温',
			            type:'line',
			            data:[1, -2, 2, 5, 3, 2, 0],
			            markPoint: {
			                data: [
			                    {name: '周最低', value: -2, xAxis: 1, yAxis: -1.5}
			                ]
			            },
			            markLine: {
			                data: [
			                    {type: 'average', name: '平均值'},
			                    [{
			                        symbol: 'none',
			                        x: '90%',
			                        yAxis: 'max'
			                    }, {
			                        symbol: 'circle',
			                        label: {
			                            normal: {
			                                position: 'start',
			                                formatter: '最大值'
			                            }
			                        },
			                        type: 'max',
			                        name: '最高点'
			                    }]
			                ]
			            }
			        }
			    ]
			};
			if(option && typeof option === "object") {
				myChart2.setOption(option, true);
			}
		</script>
	</body>

</html>