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
			<h3><?php echo ($title); ?></h3>
		</header>
		<div align="center" style="font-size: 5px;"><?php echo ($content); ?></div>
		<div class="ui-content" data-role="content">
			<section>
				<h3>笔记本</h3>

				<ul>
					<?php if(is_array($words)): $i = 0; $__LIST__ = $words;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$word): $mod = ($i % 2 );++$i;?><li>
						<small><?php echo ($word["w_name"]); ?></small>
						<span><?php echo ($word["w_translate"]); ?></span>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</section>

		</div>
		<div style="font-size: 28px;margin: auto;" align="center">功能正在开发中</div>
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