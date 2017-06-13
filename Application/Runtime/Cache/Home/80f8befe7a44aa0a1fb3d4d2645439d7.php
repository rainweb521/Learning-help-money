<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>学钱帮</title>

</head>
<body>
<script type="text/javascript">
    function form_submit(){
        document.getElementById('myForm').action = "index.php?c=setting&a=upfile";
        document.getElementById("myForm").submit();
    }
</script>
<div class="loading"><img src="Public/images/ajax-loader.gif"/></div>
<div data-role="page" class="touzi name" id="set-name">
    <!--jqmb需要把所以东西放在page div内-->
    <link rel="stylesheet" href="Public/css/jquery.mobile-1.4.5.min.css"/>
    <link rel="stylesheet" href="Public/css/style4.css"/>

    <!--jqmb需要把所以东西放在page div内-->
    <header data-role="header" data-position="fixed">
        <a href="index.php?c=setting" data-rel="back" class="ui-btn ui-icon-carat-l ui-btn-icon-left ui-nodisc-icon" data-transition="slide" data-direction="revserse">返回</a>
        <h3>上传头像</h3>
    </header>
    <div class="ui-content" data-role="content">
        <div class="namebox">
            <!--<h3></h3>-->
            <p><img width="143px" height="143px" src="<?php echo ($photo); ?>"></p>
        </div>
        <form id="myForm" method="post"  enctype="multipart/form-data">
            <input type="hidden" name="flag" value="1">
            <input type="file" name="upfile"></form>
        <a href="" onclick="form_submit()" data-transition="slide">立即上传</a>
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