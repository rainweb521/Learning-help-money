<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
   		 
   		<!--jqmb需要把所以东西放在page div内--> 
		<header data-role="header" data-position="fixed">
			<a href="#" data-rel="back" class="ui-btn ui-icon-carat-l ui-btn-icon-left ui-nodisc-icon" data-transition="slide" data-direction="revserse">返回</a> 
			<h3>生词本</h3>
		</header>
		<div align="center" style="font-size: 5px;">生词本是在今天及以前，未掌握和测试题中错误的单词</div>
		<div class="ui-content" data-role="content">
			<section>
				<h3>2017-5-23</h3>
				<ul>
					<li>
						<small>words</small>
						<span>单词</span>
					</li> 
					<li>
						<small>words</small>
						<span>单词</span>
					</li>
					<li>
						<small>words</small>
						<span>单词</span>
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