<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>选择计划</title>
     <link rel="stylesheet" type="text/css" href="Public/css/slick.css"/>
    <link rel="stylesheet" href="Public/css/jquery.mobile-1.4.5.min.css"/>
    <link rel="stylesheet" href="Public/css/style4.css"/>
    <script src="Public/js/jquery.min.js"></script>
     <script src="Public/js/jquery.mobile-1.4.5.min.js"></script>
</head>
<body style="background-color: #f2f2f2;">
	<div class="loading"><img src="Public/images/ajax-loader.gif"/></div>
	<div data-role="page" class="index" id="index">
		<header data-role="header" >
			<a href="/index.php?c=plan" data-rel="back"   >返回</a>
			<h3>选择计划</h3>
		</header>
		<div class="ui-content" data-role="content"> 
			
			<ul class="index-menu">
				<li>
					<img src="Public/images/icon01.png"/>
					<p>保险承保</p>
				</li>
				<li>
					<img src="Public/images/icon02.png"/>
					<p>当日计息</p>
				</li>
				<li>
					<img src="Public/images/icon03.png"/>
					<p>收益巨大</p>
				</li>
			</ul>
			<?php if(is_array($plan_arr)): $i = 0; $__LIST__ = $plan_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$plan): $mod = ($i % 2 );++$i;?><dl class="index-year">
					<?php if($plan["p_state"] == 1): ?><a href="index.php?c=plan&a=add&p_id=<?php echo ($plan["p_id"]); ?>" data-transition="slide" data-ajax="false">
							<dd>
								<h4><?php echo ($plan["p_name"]); ?></h4>
								<p><small></small>(<?php echo ($plan["p_lilv"]); ?>)</p>
							</dd>
							<dt style="font-size: 12px;"><?php echo ($plan["p_content"]); ?></dt>
						</a><?php endif; ?>
					<?php if($plan["p_state"] == 2): ?><a href="index.php?c=plan&a=invite&p_id=<?php echo ($plan["p_id"]); ?>" data-transition="slide" data-ajax="false">
							<dd>
								<h4><?php echo ($plan["p_name"]); ?></h4>
								<p><small></small>(<?php echo ($plan["p_lilv"]); ?>)</p>
							</dd>
							<dt style="font-size: 12px;"><?php echo ($plan["p_content"]); ?></dt>
						</a><?php endif; ?>
				</dl><?php endforeach; endif; else: echo "" ;endif; ?>
			<!--<dl class="index-year">-->
				<!--<a href="index.php?c=plan&a=add&tip=1" data-transition="slide" data-ajax="false">-->
					<!--<dd>-->
						<!--<h4>英语四级</h4>-->
						<!--<p><small>年化</small>6.0%起</p>-->
					<!--</dd>-->
					<!--<dt style="font-size: 12px;">单词记忆(个人计划)可自由选择计划期限，投入金额，每日单词数</dt>-->
				<!--</a>-->
			<!--</dl>-->

		</div>
		<footer data-role="footer" data-position="fixed">  
			<ul>
				<li><a href="index.php?c=plan&a=show&tip=1"  rel="external">个人计划</a></li>
				<li><a href="index.php?c=plan&a=show&tip=2"  rel="external">团队计划</a></li>
			</ul>
		</footer>
		<script src="Public/js/slick.min.js" ></script>
	    <script type="text/javascript">
	    	$(document).on("pagecreate","#index",function(){
 					$('.slick').slick({
						    	dots:true,
						    	autoplay:true,
						    	autoplaySpeed:2000,
						    	arrows:false,
						    }); 
					
					});
					$(window).load(function(){
						$(".loading").fadeOut()
					})
	    </script>
	</div>
</body>
</html>