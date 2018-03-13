<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- 微博用户登陆页面  -->
<html lang="en">
    <head>
        <title><?php echo ($title); ?></title>
        <meta charset="utf-8">
        <meta name="keywords" content="微博,腾讯微博,QQ微博,围脖,QQ围脖,腾讯围脖,企鹅微博,企鹅围脖,名人微博,名人围脖,微型博客"/>
        <meta name="description" content="腾讯微博 与其在别处仰望 不如在这里并肩"/>
        <link rel="stylesheet" href="/Public/home/css/login.css" />
        <script src="/Public/home/js/jquery.js"></script>
    </head>
    <body>
        <div class="logo">
            <img src="/Public/home/images/logo.png" alt="" />
        </div>
        <div class="login">
            <div>
                <!-- 微频道start -->
                <h1>微频道，发现更多精彩</h1>
                <div class="cimg">
                    <a href="#">
                        <img src="/Public/home/images/wpd1.jpg" alt="美女" />
                    </a>
                    <div class="top">
                        <a href="#"><img src="/Public/home/images/wpd2.jpg" alt="杂谈" /></a>
                        <a href="#"><img src="/Public/home/images/wpd3.jpg" alt="时尚" /></a>
                        <a href="#"><img src="/Public/home/images/wpd4.jpg" alt="摄影" /></a>
                    </div>
                    <div class="bottom">
                        <a href="#"><img src="/Public/home/images/wpd5.jpg" alt="星座" />
                        </a>
                        <a href="#"><img src="/Public/home/images/wpd6.jpg" alt="明星" /></a>
                    </div>
                </div>
                <!-- 微频道end-->
            </div>
            <div>
                <!-- 登陆框start -->
                <h1>帐号登录</h1>
                <div class="form">
                <span class="error">sbsb</span>
                    <form action="/index.php/Home/Index/checkLogin" method="post">
                        <div>
                        <input type="text" name="user" placeholder="支持用户名/邮箱登陆" /></div>
                        <div><input type="password" name="userpwd" placeholder="密码" /></div>
                        <div class="vcode" style="display:<?php echo ($style); ?>"><input type="text" name="vcode" placeholder="验证码" /></div>
                        <div class="vcode" style="display:<?php echo ($style); ?>">
                            <img id="vcode" onclick="change()" style="width:130px;height:43px" src="/index.php/Home/Index/vcode" alt="" />
                            <a href="javascript:void(0)" onclick="change();">看不清，换一张</a>
                        </div>
                        <div>
                        <button type="submit">登 陆</button>
                        <input type="checkbox" name="remembe" value="1" /><span class="remembe">下次自动登录</span>
                        </div>
                    </form>
                    
                </div>
                <!-- 登陆框end -->
                <span class="foo"><a href="#">忘了密码？</a> | <a href="/index.php/Home/Index/reg" target="_blank">注册新帐号</a> | <a href="#">意见反馈</a>&nbsp;
                </span>
            </div>
        </div>
    </body>
    <script>
        $.post("/index.php/Home/Index/ajax_check",{type:"iserror"},function(data){
                if(data >= '3'){
                    $('.vcode').show();
                }
        });
        $("form").submit(function(){
            var username = $("input[name='username']").val();
            var userpwd = $("input[name='userpwd']").val();
            if(username == ""){
                $(".error").css("display","block");
                $(".error").text("用户名不能为空");
                setTimeout(function(){
                    $(".error").css("display","none");
                },2000);
                return false;
            }

            if(userpwd == ""){
                $(".error").css("display","block");
                $(".error").text("密码不能为空");
                setTimeout(function(){
                    $(".error").css("display","none");
                },2000);
                return false;
            }
        });
        function change(){
            var obj = document.getElementById('vcode');
            obj.src="/index.php/Home/Index/vcode?a="+Math.random();
        }
    
    </script>
</html>