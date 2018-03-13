<?php if (!defined('THINK_PATH')) exit(); if(empty($_SESSION['user'])): ?><script type="text/javascript">location="/index.php/Home/Index/login"</script><?php endif; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo ($user["username"]); ?>的微博 _<?php echo ($_SESSION['config']['title']); ?></title>
        <link rel="stylesheet" href="/Public/home/css/header.css" /> 
        <meta name="keywords" content="<?php echo ($_SESSION['config']['keywords']); ?>">
        <meta name="description" content="<?php echo ($_SESSION['config']['description']); ?>">
        <script src="/Public/home/js/jquery.js"></script>
        
    <link rel="stylesheet" href="/Public/home/css/zone.css" />
    <style>

        .load-container {
            width: 240px;
            height: 240px;
            /*position: relative;*/
            overflow: hidden;
            margin: 0 auto;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        
        .loader {
          -webkit-transform: translateZ(0);
          -moz-transform: translateZ(0);
          -ms-transform: translateZ(0);
          -o-transform: translateZ(0);
          transform: translateZ(0);
        }

        
        @media (max-width: 960px) {
          .inner {
            width: 480px;
          }
        }
        @media (max-width: 500px) {
          .inner {
            width: 100%;
          }
          .load-container {
            width: 100%;
          }
        }
        .load6 .loader {
              font-size: 90px;
              text-indent: -9999em;
              overflow: hidden;
              width: 1em;
              height: 1em;
              border-radius: 50%;
              margin: 0.8em auto;
              position: relative;
              -webkit-animation: load6 1.7s infinite ease;
              animation: load6 1.7s infinite ease;
            }
            @-webkit-keyframes load6 {
              0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.11em -0.83em 0 -0.42em #ffffff, -0.11em -0.83em 0 -0.44em #ffffff, -0.11em -0.83em 0 -0.46em #ffffff, -0.11em -0.83em 0 -0.477em #ffffff;
              }
              5%,
              95% {
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.11em -0.83em 0 -0.42em #ffffff, -0.11em -0.83em 0 -0.44em #ffffff, -0.11em -0.83em 0 -0.46em #ffffff, -0.11em -0.83em 0 -0.477em #ffffff;
              }
              30% {
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.51em -0.66em 0 -0.42em #ffffff, -0.75em -0.36em 0 -0.44em #ffffff, -0.83em -0.03em 0 -0.46em #ffffff, -0.81em 0.21em 0 -0.477em #ffffff;
              }
              55% {
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.29em -0.78em 0 -0.42em #ffffff, -0.43em -0.72em 0 -0.44em #ffffff, -0.52em -0.65em 0 -0.46em #ffffff, -0.57em -0.61em 0 -0.477em #ffffff;
              }
              100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.11em -0.83em 0 -0.42em #ffffff, -0.11em -0.83em 0 -0.44em #ffffff, -0.11em -0.83em 0 -0.46em #ffffff, -0.11em -0.83em 0 -0.477em #ffffff;
              }
            }
            @keyframes load6 {
              0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.11em -0.83em 0 -0.42em #ffffff, -0.11em -0.83em 0 -0.44em #ffffff, -0.11em -0.83em 0 -0.46em #ffffff, -0.11em -0.83em 0 -0.477em #ffffff;
              }
              5%,
              95% {
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.11em -0.83em 0 -0.42em #ffffff, -0.11em -0.83em 0 -0.44em #ffffff, -0.11em -0.83em 0 -0.46em #ffffff, -0.11em -0.83em 0 -0.477em #ffffff;
              }
              30% {
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.51em -0.66em 0 -0.42em #ffffff, -0.75em -0.36em 0 -0.44em #ffffff, -0.83em -0.03em 0 -0.46em #ffffff, -0.81em 0.21em 0 -0.477em #ffffff;
              }
              55% {
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.29em -0.78em 0 -0.42em #ffffff, -0.43em -0.72em 0 -0.44em #ffffff, -0.52em -0.65em 0 -0.46em #ffffff, -0.57em -0.61em 0 -0.477em #ffffff;
              }
              100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.11em -0.83em 0 -0.42em #ffffff, -0.11em -0.83em 0 -0.44em #ffffff, -0.11em -0.83em 0 -0.46em #ffffff, -0.11em -0.83em 0 -0.477em #ffffff;
              }
            }

    </style>

		
    </head>
    <body style="background:#89E3FC url(/Public/home/images/bg_<?php echo ($_SESSION['user']['skin']); ?>) center top no-repeat fixed">
        <header>
            <nav>
                <div>
                    <div class="navleft">
                        <!-- 导航左边start -->
                        <ul>
                            <li class="logoimg"><a href="/index.php"><img src="/Public/home/uploads/static/<?php echo ($_SESSION['config']['logo']); ?>" alt="" width="124" height="33" /></a></li>
                            <li class="active"><a href="/index.php">首页</a></li>
                            <li><a href="#">爆新鲜</a></li>
                            <li><a href="#">微频道</a></li>
                            <li><a href="#">找人</a></li>
                        </ul>
                        <!-- 导航左边end -->
                    </div>
                    <div class="navright">
                        <!-- 导航右边start -->
                        <div class="islogin">
                         <!--   -->
                            <ul>
                                <li><a href="#" title="任务"><span class="a"></span></a></li>
                                <li><a href="#" title="提到我的"><span class="b"></span></a></li>
                                <li><a href="#" title="私信"><span class="c"></span></a></li>
                                <li><a href="/index.php/Home/Listen" title="听众"><span class="d"></span></a></li>
                                <li><a href="#" title="通知"><span class="e"></span></a></li>
                                <li>
                                        <a class="navuser" href="/index.php/Home/Zone/index/id/<?php echo ($_SESSION['user']['id']); ?>" title="user"><?php echo ($_SESSION['user']['username']); ?>&nbsp;<em></em></a>
                                        <!-- 用户名下拉菜单 -->
                                        <ul class="menu">
                                            <li><a href="/index.php/Home/UserSet">设置</a></li>
                                            <li><a href="javascript:;" class="skin">换肤</a></li>
                                            <li><a href="">会员</a></li>
                                            <li><a href="">我的时光轴</a></li>
                                            <li><a href="">帮助</a></li>
                                            <li><a href="/index.php/Home/Index/logout">退出</a></li>
                                        </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- 头部搜索框start -->
                        <div class="search">
                            <form action="/index.php/Home/Search" method="post">
                                <input type="text" name="keywords" placeholder="搜广播/用户"/>
                                <input type="submit" />
                            </form>
                        </div>
                        <!-- 头部搜索框end -->
                        <!-- 导航右边stop -->
                    </div>
                </div>
            </nav>
        </header>
    <!--换肤隐藏块-->
    <div class="skin_div">
    	<div class="skin_div_head">
    	       <span class="skin_font">换肤设置</span>
    	       <img class="skin_worng" src="/Public/home/images/wrong.png">
    	</div>	
    	<div class="skin_main">
            	<img class="skin_img" src="/Public/home/images/bg_1.jpg">
            	<span>夏威夷海滩</span>
            	<img class="skin_img" src="/Public/home/images/bg_2.jpg">
            	<span>LOVE YOU</span>
            	<img class="skin_img" src="/Public/home/images/bg_3.jpg">
            	<span>金黄麦田</span>		
            	<img class="skin_img" src="/Public/home/images/bg_4.jpg">
            	<span>粉色浪漫</span>		
            	<img class="skin_img" src="/Public/home/images/bg_5.jpg">
            	<span>水墨山水</span>		
            	<img class="skin_img" src="/Public/home/images/bg_6.jpg">
            	<span>技术总监专用</span>	
            	<img class="skin_img" src="/Public/home/images/bg_7.jpg">
            	<span>桂花飘香</span>		
            	<img class="skin_img" src="/Public/home/images/bg_8.jpg">
            	<span>我们的夏天天</span>	
    	</div>
    	<div class="skin_bottom">
    		<span class="skin_red">*</span>
    		<span class="skin_font">&nbsp;&nbsp;点击小图片就可以一起愉快的换肤了  V.V</span>
    	</div>
    	
    </div>
    <!--换肤结束-->
        
    <div id="cover" style="display:none"></div>
    <div id="main">
        <!-- 个人空间头部start -->
        <div class="nav">
            <div class="banner">
                <div class="headpic"><a href="#"><img src="/Public/home/uploads/headpic/<?php echo ($user["headpic"]); ?>" alt="" /></a></div>
                <div class="uname"><span><?php echo ($user["username"]); ?>的微博</span></div>
                <div class="uinfo"><span>
                <?php if(empty($user["sign"])): ?>这家伙很懒，什么都没留下
                <?php else: ?> 
                <?php echo ($user["sign"]); endif; ?>
                </span></div>
            </div>
            <div class="navmenu">
                <table>
                    <tr>
                        <td><a href="javascript:void(0)" class="active">我的主页</a></td>
                        <td><a href="javascript:void(0)">我的相册</a></td>
                        <td><a href="javascript:void(0)">留言板</a></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- 个人空间头部stop -->
        <div id="content">
            
        </div>
    </div>


        <!-- <div class="friendlink">      
            <div class="fdword">
                <a href="#">魅族</a>
                <a href="#">魅族</a>
                <a href="#">魅族</a>
                <a href="#">魅族</a>
                <a href="#">魅族</a>
                <a href="#">魅族</a>      
            </div>
        
            <div class="fdpic">
                <a href="#"><img src="/Public/home/uploads/static/yuanlogo.png" /></a>
                <a href="#"><img src="/Public/home/uploads/static/logo2.png" /></a>
                <a href="#"><img src="/Public/home/uploads/static/start.png" /></a>
                <a href="#"><img src="/Public/home/uploads/static/weixin.png" /></a>
                <a href="#"><img src="/Public/home/uploads/static/greenlogo.png" /></a>
                <a href="#"><img src="/Public/home/uploads/static/milogo.png" /></a>
            </div
        </div> -->
        <footer>
            <div>
                <a href="#" target="_blank">腾讯网</a>
                |
                <a href="#" target="_blank">网站导航</a>
                |
                <a href="#" target="_blank">认证服务</a>
                |
                <a href="#" target="_blank" boss="footer_weiboVip">微博会员</a>
                |
                <a href="#" target="_blank" boss="footer_adtqqcom">企业服务</a>
                |
                <a href="#" target="_blank">开放平台</a>
                |
                <a href="#" target="_blank">腾讯客服</a>
                |
                <a href="#">意见反馈</a>
                
            </div>
            <div>Copyright © 1998 - 2014 Tencent. All Rights Reserved<a href="#"><?php echo ($_SESSION['config']['icpno']); ?></a></div>
        </footer>
		
       
    </body>
		<!-- JiaThis bsharediv go 
		<a class="bshareDiv" href="http://www.bshare.cn/share">分享按钮</a>
		<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#uuid=&amp;style=3&amp;fs=4&amp;textcolor=#fff&amp;bgcolor=#06C&amp;text=分享到">
		</script>-->
		<script>
		//搜索按钮
			$(".head_submits").click(function(){
				var vals = $(".head_keywords").val();
			
			    $.post('/index.php/Home/Search/index',{"vals":vals}
				)
			});
		//换肤功能
			$(".skin").click(function(){
				$(".skin_div").css("display","block");
			});
			$(".skin_img").click(function(){
				//预加载背景功能
				var srcs = $(this).attr("src")
				//拆分src
				var srca = srcs.split('_');
				var src = srca['1'];
				$("body").css("background",'#89E3FC url(/Public/home/images/bg_'+src+')center top no-repeat fixed')
				//判断是否确定换肤
				if(confirm("确定要换肤吗？")){
					$.post("/index.php/Home/Public/add",{"src":src},function(data){
						if(data == 1){
							alert("换肤成功！欢迎使用");
							$(".skin_div").css("display","none");
						}else if(data ==0 ){
							alert("换肤失败！请重新选择换肤");
						}
					});
					
					$("body").css("background",'#89E3FC url(/Public/home/images/bg_'+src+')center top no-repeat fixed')
				}else{
					location.reload() 
				}
			});
			
			//隐藏换肤功能按钮
			$(".skin_worng").click(function(){
				$(".skin_div").css("display","none");
			});
		</script>
    
    <script>  
        $("td>a").click(function(){
            $("td>a").removeClass('active');
            $(this).addClass('active');
        });
        $("#content").html('<div class="load-container load6"><div class="loader">Loading...</div></div>');
        setTimeout(function(){
            $("#content").load("/index.php/Home/Zone/home/id/<?php echo ($_GET['id']); ?>");
        },1000);
        
        $("td>a").eq(0).click(function(){
            $("#content").html('<div class="load-container load6"><div class="loader">Loading...</div></div>');
            // 加载主页
            setTimeout(function(){
                $("#content").load("/index.php/Home/Zone/home/id/<?php echo ($_GET['id']); ?>");
            },1000);
        });
        $("td>a").eq(1).click(function(){
            $("#content").html('<div class="load-container load6"><div class="loader">Loading...</div></div>');
            // 加载相册
            setTimeout(function(){
                $("#content").load("/index.php/Home/Zone/photo/id/<?php echo ($_GET['id']); ?>");
            },1000);
        });
        $("td>a").eq(2).click(function(){
            $("#content").html('<div class="load-container load6"><div class="loader">Loading...</div></div>');
            // 加载留言板
            setTimeout(function(){
                $("#content").load("/index.php/Home/Zone/album/id/<?php echo ($_GET['id']); ?>");
            },1000);
        });
    </script>


</html>