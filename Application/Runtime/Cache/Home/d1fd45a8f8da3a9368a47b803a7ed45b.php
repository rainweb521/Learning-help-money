<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>学钱帮</title>
    
</head>
<body>
	<div class="loading"><img src="Public/images/ajax-loader.gif"/></div>
	<div data-role="page" class="touzi ques" id="details">
		<!--jqmb需要把所以东西放在page div内-->
		 <link rel="stylesheet" href="Public/css/jquery.mobile-1.4.5.min.css"/>
   		 <link rel="stylesheet" href="Public/css/style4.css"/>

   		 
   		<!--jqmb需要把所以东西放在page div内--> 
		<header data-role="header" data-position="fixed">
			<a href="#" data-rel="back" class="ui-btn ui-icon-carat-l ui-btn-icon-left ui-nodisc-icon" data-transition="slide" data-direction="revserse">返回</a> 
			<h3>邀请好友</h3>
		</header>
		<div class="ui-content" data-role="content">
			<div class="details">
				<h4>好友列表</h4>
				<p>

				<div class="head" style="width: 500px;height: 5%;">
					<div class="head-img" style="margin:10px auto;float: left;margin-right: 20px;">
						<a href="index.php?c=setting&a=upfile">
							<img style="border-radius:40%;font-size: 12px;"  width="40px" height="40px" src="./Public/images/rain23891497325565.png" alt="快点击上传个头像吧">

						</a>
					</div>
					<div class="head-dsb" style="float: left;">
						<p class="dsb-name">--wcy</p>
					</div>

				</div>

		<br>
				</p>

			</div>

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