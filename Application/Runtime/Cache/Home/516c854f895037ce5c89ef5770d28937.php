<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/Public/home//css/reg.css" />
        <script src="/Public/home/js/jquery.js"></script>
        <!-- <script src="/Public/home//js/reg.js"></script> -->
    </head>
    <body>
        <div class="main">
            <div class="logo">
                <img src="/Public/home/images/reg_logo.png" alt="小虎队微博" title="小虎队微博"/>
            </div>  
            <div class="box">
                <div class="title">
                    <strong>用户注册</strong>
                    <span>已有账号？点击
                        <a href="login">登录</a>
                    </span>
                </div>
                <div class="form">
                    <form action="/index.php/Home/Index/insert" method="post">

                       <p>
                            <label>邮 箱 &nbsp;</label>
                            <input type="email" name="email" placeholder="请输入您的常用邮箱" />
                        </p>

                        <p>
                            <label>用户名 &nbsp;</label>
                            <input type="text" name="username" placeholder="请设置你的昵称" />
                        </p>

                        <p>
                            <label>密 码 &nbsp;</label>
                            <input type="password" name="userpwd"/>
                        </p>

                        <p>
                            <label>确认密码 &nbsp;</label>
                            <input type="password" name="userpwd"/>
                        </p>

                        <p class="vcode">
                            <label class="code">验证码 &nbsp;</label>
                            <input type="text" name="vcode" />
                        </p>

                        <p class="vcode_img">
                            <img id="vcode" src="/index.php/Home/Index/vcode" alt="验证码" onclick="change()" width="130px"/>
                            <a href="javascript:void(0);" onclick="change()">换一张？</a>
                        </p>
                    </form>
                    <p>
                        <label> &nbsp;</label>
                        <button>立即注册</button>
                    </p>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            var msg = "";
            var chkEmail = false;
            var chkUname = false;
            var chkPwd = false;
            var chkRepwd = false;
        $("input:eq(0)").blur(function(){
            $(this).next().remove();
            $(this).next().remove();
            checkEmail(this);
            $(this).after(msg);
        });

       $("input:eq(1)").blur(function(){
            $(this).next().remove();
            $(this).next().remove();
            checkUname(this);
            $(this).after(msg);
       });
       $("input:eq(2)").blur(function(){
            $(this).next().remove();
            $(this).next().remove();
            checkPwd(this);
            $(this).after(msg);
       });
       $("input:eq(3)").blur(function(){
            $(this).next().remove();
            $(this).next().remove();
            checkRepwd(this);
            $(this).after(msg);
       });

       //验证邮箱
       function checkEmail(obj){
        chekEmail = false;
        if($(obj).val() == ""){
          $(obj).css('background','#FFE7E7');
            msg = "&nbsp;<img src='/Public/home//images/wrong.png'><span class='error'>邮箱不能为空</span>";  
        }else if(!$(obj).val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
             $(obj).css('background','#FFE7E7');
             msg = "&nbsp;<img src='/Public/home//images/wrong.png'><span class='error'>邮箱格式不对</span>";
        }else{
            $(obj).css('background','#ffffff');
             msg = "&nbsp;<img src='/Public/home//images/right.png'>";
            chkEmail = true;
        }
       }

       //确认密码函数
       function checkRepwd(obj){
        chekRepwd = false;
        if($(obj).val().length == 0){
             $(obj).css('background','#FFE7E7');
            msg = "&nbsp;<img src='/Public/home/images/wrong.png'><span class='error'>密码不能为空</span>";
        }else if($(obj).val() != $("input:eq(2)").val()){
            $(obj).css('background','#FFE7E7');
             msg = "&nbsp;<img src='/Public/home/images/wrong.png'><span class='error'>两次密码不一致</span>";
        }else{
            $(obj).css('background','#ffffff');
             msg = "&nbsp;<img src='/Public/home/images/right.png'>";
            chkRepwd = true;
        }
       }

       //验证密码函数
       function checkPwd(obj){
        chekPwd = false;
        if($(obj).val().length == 0){
            $(obj).css('background','#FFE7E7');
            msg = "&nbsp;<img src='/Public/home/images/wrong.png'><span class='error'>密码不能为空</span>";
        }else if($(obj).val().length < 6){
            $(obj).css('background','#FFE7E7');
            msg = "&nbsp;<img src='/Public/home/images/wrong.png'><span class='error'>密码长度不能小于6位</span>";
        }else{
            $(obj).css('background','#ffffff');
            msg = "&nbsp;<img src='/Public/home/images/right.png'>";
            chkPwd = true;
        }

       }

        //验证用户名函数
       function checkUname(obj){
            chekUname = false;
            if($(obj).val().length == 0){
                $(obj).css('background','#FFE7E7');
                msg = "&nbsp;<img src='/Public/home/images/wrong.png'><span class='error'>用户名不能为空</span>";
            }else if($(obj).val().length <= 4){
                $(obj).css('background','#FFE7E7');
                msg = "&nbsp;<img src='/Public/home/images/wrong.png'><span class='error'>用户名长度不能小于4位</span>";  
            }else{
                $(obj).css('background','#ffffff');
                msg = "&nbsp;<img src='/Public/home/images/right.png'>";
                chkUname = true;
            }
       }
       //点击button提交按钮时判断
       $("button").click(function(){
            $("input:eq(0)").next().remove();
            $("input:eq(0)").next().remove();
            checkEmail($("input:eq(0)"));
            $("input:eq(0)").after(msg);

            $("input:eq(1)").next().remove();
            $("input:eq(1)").next().remove();
            checkUname($("input:eq(1)"));
            $("input:eq(1)").after(msg);

            $("input:eq(2)").next().remove();
            $("input:eq(2)").next().remove();
            checkPwd($("input:eq(2)"));
            $("input:eq(2)").after(msg);

            $("input:eq(3)").next().remove();
            $("input:eq(3)").next().remove();
            checkRepwd($("input:eq(3)"));
            $("input:eq(3)").after(msg);
            if(chkEmail && chkUname && chkPwd && chkRepwd){
                $("form").submit();
            }
       });
    });
    

        //js验证码变换函数
        function change(){
            var obj = document.getElementById('vcode');
            obj.src="/index.php/Home/Index/vcode?a="+Math.random();
        }
        //ajax验证邮箱在数据库是否存在
         $("input:eq(0)").blur(function(){
            $.post('/index.php/Home/Index/ajax_check',{"type":"email","email":$("input:eq(0)").val()},function(data){
                //服务器返回error说明在数据库中存在此邮箱
                if(data == 'error'){
                   $("input:eq(0)").next().remove();
                   $("input:eq(0)").next().remove();
                   $("input:eq(0)").after("&nbsp;<img src='/Public/home/images/wrong.png'><span class='error'>邮箱已注册</span>");
                }
            });
         });

          $("input:eq(1)").blur(function(){
            $.post('/index.php/Home/Index/ajax_check',{"type":"username","username":$("input:eq(1)").val()},function(data){
                //服务器返回error说明在数据库中存在此邮箱
                if(data == 'error'){
                   $("input:eq(1)").next().remove();
                   $("input:eq(1)").next().remove();
                   $("input:eq(1)").after("&nbsp;<img src='/Public/home/images/wrong.png'><span class='error'>这个昵称太火了，请换一个</span>");
                }
            });
         });

         $("input:eq(4)").blur(function(){
            $.post('/index.php/Home/Index/ajax_check',{"type":"vcode","vcode":$("input:eq(4)").val()},function(data){
                //服务器返回error说明在数据库中存在此邮箱
                if(data == 'success'){
                   $("input:eq(4)").next().remove();
                   $("input:eq(4)").next().remove();
                   $("input:eq(4)").after("&nbsp;<img src='/Public/home/images/right.png'><span class='success'>验证码正确</span>");
                }else{
                   $("input:eq(4)").next().remove();
                   $("input:eq(4)").next().remove();
                   $("input:eq(4)").after("&nbsp;<img src='/Public/home/images/wrong.png'><span class='error'>验证码错误</span>");
                }
            });
         });
            
    </script>
</html>