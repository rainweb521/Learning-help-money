<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>学钱帮</title>
    
</head>
<body>
	<div class="loading"><img src="Public/images/ajax-loader.gif"/></div>
	<div data-role="page" class="touzi" id="touzi">
		<!--jqmb需要把所以东西放在page div内-->
		 <link rel="stylesheet" href="Public/css/jquery.mobile-1.4.5.min.css"/>
   		 <link rel="stylesheet" href="Public/css/style4.css"/>
   		 <link rel="stylesheet" href="Public/css/layui.css"  media="all">
		<script type="text/javascript" src="/Public/js/jquery-3.2.1.min.js"></script>

		<!--jqmb需要把所以东西放在page div内-->
		<header data-role="header" data-position="fixed">
			<a href="#" data-rel="back" class="ui-btn ui-icon-carat-l ui-btn-icon-left ui-nodisc-icon" data-transition="slide" data-direction="revserse">返回</a> 
			<h3>收益计算</h3>
		</header>
		<!--<form method="get" action="index.php?c=plan&a=add2"><input type="submit" value="123"></form>-->
		<script>
            function mysubmit(){
                var p_money = document.getElementById('p_money').value;
                if(p_money==''){
                    alert('投资金额不能为空');
                    return 0;
				}
                var p_day = document.getElementById('p_day').value;
                if(p_day==''){
                    alert('计划天数不能为空');
                    return 0;
                }
                var p_num = document.getElementById('p_num').value;
                if(p_num==''){
                    alert('每日单词数不能为空');
                    return 0;
                }
                var balance = document.getElementById('balance').innerHTML;
                p_money = parseInt(p_money);
                p_day = parseInt(p_day);
                p_num = parseInt(p_num);
                balance = parseInt(balance);
                if (p_money>200||p_money<10){
                    alert('投资金额填写无效');
                    return 0;
				}
                if (p_money>balance){
                    alert('投资金额大于可用余额');
                    return 0;
                }
                if (p_day>30||p_day<10){
                    alert('计划天数填写无效');
                    return 0;
                }
                if (p_num>200||p_num<10){
                    alert('每日单词数填写无效');
                    return 0;
                }
                if ((p_day*p_num)>4451){
                    alert('你的计划单词太多，单词学习过程中可能出现重复');
					return 0;
				}
            	alert('用户数据库已生成完毕，您可以开始学习了');
                document.getElementById('myForm').action = "index.php?c=plan&a=add";
                document.getElementById("myForm").submit();
            }
            function get_earning(){
                var p_money = document.getElementById('p_money');
                var p_day = document.getElementById('p_day');
                var p_num = document.getElementById('p_num').value;
                if(p_money.value==''){
                    document.getElementById('state').innerHTML = '(投资金额不能为空)';
                    p_money.focus();
                    return 0;
                }
                if(p_day.value==''){
                    document.getElementById('state').innerHTML = '(计划天数不能为空)';
                    p_day.focus();
                    return 0;
                }
                if(p_num.value==''){
                    document.getElementById('state').innerHTML = '(每日单词数不能为空)';
                    p_num.focus();
                    return 0;
                }
                document.getElementById('state').innerHTML = '';

                $.get("index.php?c=earning&a=count_ajax&money="+p_money.value+"&day="+p_day.value+"&words="+p_num.value, function(data){
                    var res = eval("(" + data + ")");//转为Object对象
                    var sum = res.sum;
                    var max = res.max;
                    document.getElementById('earning_sum').innerHTML = sum + '元';
                    document.getElementById('earning_max').innerHTML = max + '元';
                });
			}
		</script>
		<div class="ui-content" data-role="content">
			<section>
				<h3>计划收益 <span id="state" style="color: #FF5722;"></span></h3>
				<ul>
					<li style="height: 22px;">
						<p style="font-size: 13px;height: 20px;"> 投资金额 <input type="text" id="p_money" name="p_money" value="" data-role="none" placeholder="10元起"></p>

					</li>
					<li style="height: 22px;">
						<p style="font-size: 13px;height: 20px;"> 计划天数<input type="text" id="p_day" name="p_day" value="" data-role="none" placeholder="10天起"></p>
					</li>
					<li style="height: 25px;">
						<p style="font-size: 13px;"> 每日单词数<input type="text" id="p_num" name="p_num" value="" data-role="none" placeholder="20个起"></p>
					</li>
					<li>
						<small>预计总收益</small>
						<span id="earning_sum">0元</span>
					</li>
					<li>
						<small>预计每日最大收益</small>
						<span id="earning_max">0元</span>
					</li>

					<li style="height: 40px;">
						<input type="button" class="layui-btn layui-btn-normal" onclick="get_earning()" value="点击计算预计收益"/>
					</li>

				</ul>
			</section>


		</div>

		<script src="Public/js/jquery.min.js"></script>
   		<script src="Public/js/jquery.mobile-1.4.5.min.js"></script>
   		<script type="text/javascript">
   			$(window).load(function(){
					$(".loading").fadeOut();
					//var id = 1;
					//location.href="touzi.html?id=1";
				})
   		</script>
	</div>
	
</body>
</html>