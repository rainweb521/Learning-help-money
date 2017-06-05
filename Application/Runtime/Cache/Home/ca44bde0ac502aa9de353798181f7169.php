<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>个人中心</title>
<link rel="stylesheet" type="text/css" href="Public/css/style.css">
<link href="Public/css/style2.css" rel="stylesheet" type="text/css" />
<link href="Public/css/iscroll.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="_centent">
<header>

	<div class="top-name"><p>监督计划</p></div>
</header>
    <section class="mt-1">
        <div class="ps-lt">
            <a href="index.php?c=plan&a=show">
            <div class="lt-dsb cl-bb">
                <p>申请加入更多的计划</p>
                <i class="arr-right"></i>
            </div>
            </a>
        </div>
    </section>
<section class="mt-1">
    <div class="ps-lt">
        <div class="lt-dsb">
            <p>个人计划</p>
        </div>
    </div>
</section>
<ul class="mainmenu">
    <?php if(is_array($plan_arr)): $i = 0; $__LIST__ = $plan_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$plan): $mod = ($i % 2 );++$i; if($plan["p_state"] == 1): ?><li><a href="index.php?c=plan&a=learn&up_id=<?php echo ($plan["up_id"]); ?>" ><b><img src="<?php echo ($plan["p_photo"]); ?>" /></b><span><?php echo ($plan["p_name"]); ?></span></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    <!--<li><a href="/" ><b><img src="Public/images/tb06.png" /></b><span><?php echo ($p_name); ?></span></a></li>-->
    <!--<li><a href="/" ><b><img src="Public/images/tb07.png" /></b><span>早起签到</span></a></li>-->
    <!--<li><a href="/" ><b><img src="Public/images/tb08.png" /></b><span>英语四级</span></a></li>       -->
</ul>


<section class="mt-1">
    <div class="ps-lt" style="">
        <div class="lt-dsb">
            <p>团队计划</p>
        </div>
    </div>
</section>
<ul class="mainmenu">
    <?php if(is_array($plan_arr)): $i = 0; $__LIST__ = $plan_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$plan): $mod = ($i % 2 );++$i; if($plan["p_state"] == 2): ?><li><a href="/" ><b><img src="<?php echo ($p_photo); ?>" /></b><span><?php echo ($p_name); ?></span></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</ul>


<div class="jg"></div>
</div>
<footer>
    <div class="mune">
        <a href="index.php?c=index">
        <img src="Public/images/1.png">
        <p>首页</p>
        </a>
    </div>
    <div class="mune">
        <a href="index.php?c=plan">
        <img src="Public/images/3.png">
        <p>计划</p>
        </a>
    </div>
    <div class="mune">
        <a href="index.php?c=earning">
        <img src="Public/images/2.png">
        <p>收益</p>
        </a>
    </div>
    <div class="mune">
        <a href="index.php?c=setting">
        <img src="Public/images/4.png">
        <p>个人</p>
        </a>
    </div>
</footer>

<script>
	(function (doc, win) {
	  var docEl = doc.documentElement,
		resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
		recalc = function () {
		  var clientWidth = docEl.clientWidth;
		  if (!clientWidth) return;
		  docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
		};

	  if (!doc.addEventListener) return;
	  win.addEventListener(resizeEvt, recalc, false);
	  doc.addEventListener('DOMContentLoaded', recalc, false);
	})(document, window);
</script>
<script type="text/javascript" src="Public/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
	$('.check-on').click(function(){
		$(this).toggleClass('check-off');
		})
</script>
</body>
</html>