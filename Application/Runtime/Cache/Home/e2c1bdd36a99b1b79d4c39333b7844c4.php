<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>学钱帮</title>
    
</head>
<body>
	<div class="loading"><img src="Public/images/ajax-loader.gif"/></div>
	<div data-role="page" class="touzi set" id="set">
		<!--jqmb需要把所以东西放在page div内-->
		 <link rel="stylesheet" href="Public/css/jquery.mobile-1.4.5.min.css"/>
   		 <link rel="stylesheet" href="Public/css/style4.css"/>
   		 
   		<!--jqmb需要把所以东西放在page div内--> 
		<header data-role="header" data-position="fixed">
			<a href="#" data-rel="back" class="ui-btn ui-icon-carat-l ui-btn-icon-left ui-nodisc-icon"  data-ajax="false">返回</a> 
			<h3>通知</h3>
		</header>
		<div class="ui-content" data-role="content">
			<dl>
				<dd>
					<a href="" data-ajax="false" class="ui-btn ui-icon-appright ui-btn-icon-right ui-nodisc-icon">关于用户使用说明<small></small></a>
				</dd>
				<dd>
					<a href=""  data-ajax="false" class="ui-btn ui-icon-appright ui-btn-icon-right ui-nodisc-icon">关于学钱帮介绍<small></small></a>
				</dd>
				<dd>
					<a href="" data-ajax="false" class="ui-btn ui-icon-appright ui-btn-icon-right ui-nodisc-icon">用户须知</a>
				</dd>
			</dl>

		</div>
		<script src="Public/js/jquery.min.js"></script>
   		<script src="Public/js/jquery.mobile-1.4.5.min.js"></script>
   		<script type="text/javascript">
   			$(window).load(function(){
					$(".loading").fadeOut();
					
				})
   		</script>
	</div>
	
</body>
</html>