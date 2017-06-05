<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>单词学习</title>

</head>
<body onload="validate()">
<div class="loading"><img src="Public/images/ajax-loader.gif"/></div>
<div data-role="page" class="touzi set" id="set">
    <!--jqmb需要把所以东西放在page div内-->
    <link rel="stylesheet" href="Public/css/jquery.mobile-1.4.5.min.css"/>
    <link rel="stylesheet" href="Public/css/style4.css"/>
<link rel="stylesheet" href="Public/css/layui.css"  media="all">
<link rel="stylesheet" href="Public/css/amazeui.css"  media="all">
    <script type="text/javascript" src="/Public/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    function validate(){
//        location.replace()
        document.getElementById('jdt').style.width = '<?php echo ($num); ?>'+'%';
    }
       function validate2(){
           $.get("index.php?c=plan&a=ajax", function(data){
               var res = eval("(" + data + ")");//转为Object对象
               var str = res.name;
               document.getElementById('words_name').innerHTML = str;
           });
       }
    function learn_words(){
           var r_id = document.getElementById('hidden_rid').value;
           var up_id = document.getElementById('hidden_upid').value;
        $.get("index.php?c=plan&a=ajax&up_id="+up_id+"&r_id="+r_id, function(data){
            var res = eval("(" + data + ")");//转为Object对象
            var str = res.name;
            document.getElementById('hidden_upid').value = res.upid;
            document.getElementById('hidden_rid').value = res.rid;
            document.getElementById('words_name').innerHTML = res.name;
            document.getElementById('words_show').innerHTML = res.translate;
            document.getElementById('words_symbol').innerHTML = res.symbol;
            document.getElementById('words_num').innerHTML = res.num+'%';
            document.getElementById('jdt').style.width = res.num+'%';
            document.getElementById('words_show').style.color = 'white';
        });
    }


    function show(){
//            alert('<?php echo ($num); ?>');
        document.getElementById('words_show').style.color = 'black';
        var r_id = document.getElementById('hidden_rid').value;
        var up_id = document.getElementById('hidden_upid').value;
        $.get("index.php?c=plan&a=ajax2&up_id="+up_id+"&r_id="+r_id, function(data){

        });
    }
</script>
    <!--jqmb需要把所以东西放在page div内-->
    <header data-role="header" data-position="fixed">
        <a href="index.php?c=plan"  class="ui-btn ui-icon-carat-l ui-btn-icon-left ui-nodisc-icon"  data-ajax="false">退出</a>
        <h3>单词学习</h3>
    </header>
    <input type="hidden" value="<?php echo ($words["r_id"]); ?>" id="hidden_rid">
    <input type="hidden" value="<?php echo ($up_id); ?>" id="hidden_upid">
    <div style="font-size: 12px;">今日学习进度：</div>
<div class="am-progress am-progress-striped" style="margin-top: 5px;">

  <div id="jdt" class="am-progress-bar am-progress-bar-secondary" style="width: 10%;height: 18px;"><div style="font-size: 12px;" id="words_num"><?php echo ($num); ?>%</div></div>
</div>
    <div style="font-size: 25px;margin-top: -25px;" align="center"><h1 id="words_name" style="margin-bottom: 0px;"><?php echo ($words["w_name"]); ?></h1><span style="font-size: 15px;" id="words_symbol"><?php echo ($words["w_symbol"]); ?></span></div>
<div  style="background-color: white;width: 100%;height: 180px;text-align: center;">
    <span id="words_show" style="color: white" ><?php echo ($words["w_translate"]); ?></span>
</div>
<br>
    <!--<a id="btnOK" onclick="validate2();">123</a>-->
    <div style="" align="center">
   <button type="button" style="background-color: #F7B824;width: 35%;" class="am-btn am-btn-default am-round" onclick="show()">还未掌握</button>
        <button type="button" style="background-color: #01AAED;width: 35%;" class="am-btn am-btn-default am-round" onclick="learn_words()" >我已掌握</button>
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