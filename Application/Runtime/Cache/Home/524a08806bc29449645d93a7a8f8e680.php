<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="viewport" content="height=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <title></title>
    <link rel="stylesheet" href="Public/css/common.css"/>
    <link rel="stylesheet" href="Public/css/register.css"/>
</head>
<body>
<div class="register">
    <div class="regTop">
        <span style="font-size:20px">用户注册</span>
        <a class="back" href="index.html">&lt;&nbsp;返回</a>
    </div>
    <div class="content">
        <!-- <div class="point">
            <span style="font-size: 13px;">注册成功后，验证邮箱和手机号也可为登录账号。</span>
        </div> -->
        <span style="font-size: 12px;color: red;"><?php echo ($state); ?></span>
        <form action="index.php?c=login&a=register" method="post">
            <div class="message">
                <input type="hidden" name="flag" value="1">
                <input type="tel" name="mobile" placeholder="输入手机号" pattern="[0-9]{11}" required/>
                <input type="email" name="email" placeholder="请输入邮箱"  required/>
                <input type="password" name="password" placeholder="请输入6-25位密码" pattern="[0-9A-Za-z]{6,25}" required/>
                <input type="password" name="c_password" placeholder="请再次输入密码" pattern="[0-9A-Za-z]{6,25}" required/>
                <!--  <select name="job">
                     <option value="choose">选择职位</option>
                     <option value="boss">老板</option>
                     <option value="staff">员工</option>
                 </select> -->
                <div class="icons">
                    <b><img src="Public/images/zc-1.jpg" alt=""/></b>
                    <b><img src="Public/images/zc-2.jpg" alt=""/></b>
                    <b><img src="Public/images/zc-3.jpg" alt=""/></b>
                    <b><img src="Public/images/zc-3.jpg" alt=""/></b>
                </div>
                <!-- <a class="code" href="" required>获取验证码</a> -->
            </div>
            <div class="agree">
                <span style="font-size: 14px;">点击注册则表示您已同意&nbsp;</span><a href="">《注册协议》</a>
            </div>
            <button class="submit" type="submit">注册</button>
        </form>
    </div>
</div>
</body>
</html>