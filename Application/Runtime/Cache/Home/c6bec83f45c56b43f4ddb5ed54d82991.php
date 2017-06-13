<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>学钱帮</title>
	<link rel="stylesheet" href="Public/css/jquery.mobile-1.4.5.min.css"/>
	<link rel="stylesheet" href="Public/css/style4.css"/>
</head>
<body>
<div class="loading"><img src="Public/images/ajax-loader.gif"/></div>
<div data-role="page" class="touzi yijian" id="yijian">
	<header data-role="header" data-position="fixed">
		<a href="index.php?c=setting" data-rel="back" class="ui-btn ui-icon-carat-l ui-btn-icon-left ui-nodisc-icon" data-transition="slide" data-direction="revserse">返回</a>
		<h3>意见反馈</h3>
	</header>
	<div class="ui-content" data-role="content">

		<form action="index.php?c=setting&a=advice" method="post">
			<input type="hidden" name="flag" value="1">
			<textarea rows="10" cols="100" name="content"></textarea>
			<span><?php echo ($state); ?></span>
			<input type="submit" value="提交" data-role="none"/>
		</form>
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