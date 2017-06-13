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
			<h3>分享功能</h3>
		</header>
		<div class="ui-content" data-role="content">
			<dl>
				<!-- JiaThis Button BEGIN -->
				<div class="jiathis_style">
					<span class="jiathis_txt">分享到：</span>
					<br>
					<a class="jiathis_button_qzone">QQ空间</a>
					<a class="jiathis_button_tsina">新浪微博</a>
					<a class="jiathis_button_tqq">腾讯微博</a><br>
					<a class="jiathis_button_renren">人人网</a>
					<a class="jiathis_button_kaixin001">开心网</a>
					<a class="jiathis_button_email">邮件</a><br>
					<a class="jiathis_button_copy">复制网址</a>
					<a class="jiathis_button_cqq">QQ好友</a>
					<a class="jiathis_button_fb">Facebook</a><br>
					<a class="jiathis_button_twitter">Twitter</a>
					<a class="jiathis_button_googleplus">Google+</a>
					<a class="jiathis_button_ydnote">有道云笔记</a><br>
					<a class="jiathis_button_douban">豆瓣</a>
					<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a>
					<a class="jiathis_counter_style"></a>
				</div>
				<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
				<!-- JiaThis Button END -->
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