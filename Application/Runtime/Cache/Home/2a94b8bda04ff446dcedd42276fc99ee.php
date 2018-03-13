<?php if (!defined('THINK_PATH')) exit(); if(empty($_SESSION['user'])): ?><script type="text/javascript">location="/index.php/Home/Index/login"</script><?php endif; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>首页_<?php echo ($_SESSION['config']['title']); ?></title>
        <link rel="stylesheet" href="/Public/home/css/header.css" /> 
        <meta name="keywords" content="<?php echo ($_SESSION['config']['keywords']); ?>">
        <meta name="description" content="<?php echo ($_SESSION['config']['description']); ?>">
        <script src="/Public/home/js/jquery.js"></script>
        
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="/Public/home/css/index.css" />         
    <script src="/Public/home/js/jquery.js"></script>
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/Public/home/js/index.js"></script>
    <link rel="stylesheet" href="/Public/home/css/letter.css" />

		
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
        
    <div id="wrap">
    		<a id="top"></a>	
     		<div id="main">
	     		<div id="main_left_bg">
	     			<!-- 仅作占位用，以防止因浮动引起的位置错乱 -->
	     		</div>
	     		<div id="main_left">
	     			<div id="main_left_top">
	     				<a href="/index.php">首页</a>
					<a class="letter" href="javascript:void(0)">消息</a>
					<a  class="keeplist" href="javascript:void(0)">收藏</a>
	     			</div>
	     			<div class="follow">
	     			<!-- 以下代码多，是因为用了bootstrap提供的字体图标 -->
	     				<a class="a_click" href="javascript:"><span class="glyphicon glyphicon-th-list" style="font-size:12px"></span>&nbsp;全部分组信息</a>
					<div class="hr"></div>

	     				<?php if(is_array($group)): foreach($group as $key=>$group): ?><a  class="groupcontent" href="javascript:;" onclick="groupcontent(<?php echo ($group["id"]); ?>,this)"><span class="glyphicon glyphicon-tint" style="font-size:12px"></span>&nbsp;<?php echo ($group["groupname"]); ?></a><?php endforeach; endif; ?>

					<!-- <a href="javascript:"><span class="glyphicon glyphicon-tint" style="font-size:12px"></span>&nbsp;手机</a> -->
					
				</div>

	    		</div>

	    		<!-- 遮罩层 -->
	    		<div id="mask" class="mask"></div>
			<!-- 遮罩层结束 -->

	    		<!-- 中间一列开始 -->
	    		<div id="main_center">
	    			<div class="send_weibo">
	    				<div class="title_area">
	    					<div class="title_left">
	    						<p>想说神马就说神马</p>
	    					</div>
	    					<div class="title_right">
	    						<p>还可以输入&nbsp;<span ><b id="rest">140</b></span>&nbsp;字</p>
	    					</div>
	    				</div>
					
					<form action="/index.php/Home/Content/add" enctype="multipart/form-data" method="post">
		    				<div class="input">
		    					<textarea class="w_input" name="content" id=""></textarea>
		    				</div>

		    				<div class="func_area">
		    					<div class="kind">
		    						<a href="#"><em class="glyphicon glyphicon-eye-open ficon_face"></em>表情</a>
		    						<a href="#"><em class="glyphicon glyphicon-picture ficon_pic"></em>图片</a>
		    						<a href="#"><em class="glyphicon glyphicon-film ficon_film"></em>视频</a>
		    						<a href="#"><em class="glyphicon glyphicon-align-center ficon_talk"></em>话题</a>	
		    					</div>
		    					<div class="func">
		    						<button>发布</button>
		    					</div>
		    				</div>
	    				</form>
	    			</div>

	    			<div id="weibo_feed">
	    				<div class="wb_tab">
	    					<div class="wb_tab_left">
	    						<ul>
	    							<li><a href="#">全部</a></li>
	    							<li><a href="#">原创</a></li>
	    							<li><a href="#">图片</a></li>
	    							<li><a href="#">视频</a></li>
	    							<li><a href="#">音乐</a></li>
	    						</ul>
	    					</div>
	    					<div class="wb_tab_right">
	    						<form action="" method="get">
	    							<input type="text" name="key_word" placeholder="搜你所想"><button><span>search</span></button>
	    						</form>
	    					</div>
	    				</div>
	    			</div>

				<div class="wball">
					<?php if(is_array($contents)): foreach($contents as $key=>$content): ?><div class="wb_detail">
			    				<div class="headpic">
			    					<img src="/Public/home/uploads/headpic/<?php echo ($content["headpic"]); ?>" >		
			    				</div>
			    				<div class="wb_content">
			    					<div class="wb_info_top">
			    						<a href="/index.php/Home/Zone/index/id/<?php echo ($content["uid"]); ?>"><?php echo ($content["username"]); ?> </a>
			    					</div>
			    					<div class="wb_content_text">
			    						
			    						<?php if($content["turnid"] != 0 ): echo ($content["content"]); ?><br>&nbsp;&nbsp;&nbsp;&nbsp;
			    						<a href="/index.php/Home/Zone/index/id/<?php echo ($content["turn"]["uid"]); ?>">@<?php echo ($content["turn"]["username"]); ?>:</a>
			    						<b><?php echo ($content["turn"]["content"]); ?></b><?php else: echo ($content["content"]); endif; ?>
			    					</div>
			    					<!-- <div class="other_wb">转发微博占位</div> -->
			    					<div class="wb_content_bottom">
			    						<?php echo (date("Y-m-d H:i:s",$content["posttime"])); ?>
			    					</div>
			    					
			    				</div>
			    				<div class="clear"></div>
			    			</div>
			    			<div class="wb_bar">
			    				<ul>
			    					<li class="keep" onclick="keep(<?php echo ($content["id"]); ?>,this)"><a href="javascript:;"><?php if($content["iskeep"] == 1 ): ?>取消收藏<?php else: ?> 收藏<?php endif; ?></a></li>
			    					<li class="zhuanfa"><a href="javascript:;">转发</a></li>
			    					<li class="pinglun">
			    						<a onclick="loads(<?php echo ($content["id"]); ?>,this)" href="javascript:;">评论</a>
			    					</li>
			    					<li class="praise" onclick="praise(<?php echo ($content["id"]); ?>,this)"><a href="javascript:;"><span class="glyphicon glyphicon-thumbs-up zan"></span><em><?php echo ($content["num"]); ?></em></a></li>
			    				</ul>
			    			</div>

					<!-- 点击转发时出现如下内容 -->
						<div class="wb_move">
							<div class="move_title">
								<span>转发微博</span>
								<span class="close">×</span>
							</div>
							<div class="move_content">
								<form action="/index.php/Home/Content/turn" method="post">
									<div class="fill_content">
										<textarea name="content" id=""></textarea>
										<input type="hidden" name="id" value="<?php echo ($content["id"]); ?>"/>
									</div>
									<div class="fill_func">
										<!-- <a href="javascript:">转发微博</a> -->
										<button>转发</button>
									</div>
								</form>
							</div>
						</div>
					<!-- 点击转发时出现如上内容 -->
		    			
		    			<!-- 点击评论时，显示如下内容 -->
		    			<div class="wb_feed_repeat">
		    				<div class="wb_feed_publish">
		    					<div class="wb_face">
		    						<img src="/Public/home/uploads/headpic/<?php echo ($_SESSION['user']['headpic']); ?>"/>
		    					</div>
		    					<div class="wb_publish">
		    					<!-- <form  method="post"> -->
		    						<div class="publish_input">
		    							<textarea class="reply_textarea" name="content" id=""></textarea>
		    						</div>
		    						<input class="contentid" type="hidden" name="id" value="<?php echo ($content["id"]); ?>"/>
		    						<div class="publish_func">
			    						<span>as</span>
			    						<ul>
			    							<li>
			    								<label for="">
			    									<input type="checkbox" name="forward">
			    									<span>同时转发到我的微博</span>
			    								</label>
			    							</li>
			    							<li>
			    								<label for="">
			    									<input type="checkbox" name="forward">
			    									<span>同时评论给原作者</span>
			    								</label>
			    							</li>
			    						</ul>
			    						<button class="reply">发布</button>
			    					</div>
		    						<!-- </form> -->
		    					</div>
		    				</div>

		    				<div class="repeat_list">
		    					<div class="repeat_tab">
		    						<!-- <ul>
		    							<li><a href="#">全部</a></li>
		    							<li><a href="#">热门</a></li>
		    							<li><a href="#">认证用户</a></li>
		    							<li><a href="#">关注的人</a></li>
		    						</ul>
		    						<span>共199条</span> -->
		    					</div>
		    					<div class="list_box">
		    						<!-- 
		    							通过Ajax把每条微博的评论加载过来
		    							<div class="list_li"></div> 
		    						-->
		    					</div>
		    				</div>
		    			</div><?php endforeach; endif; ?> 
	    			    			<!-- 点击评论时，显示如上内容 -->

	    			<div class="page">
	    				<?php echo ($page); ?>
<!-- 	    			<a href="javascript:">上一页</a>
	    				<span class="page_list">第2页</span>
	    				<a href="javascript:">下一页</a> -->
	    			</div>
	    		</div>
			</div>

			<!--最右边一列，第三列开始 -->
	    		<div id="main_right">
	    			<div class="w_person_info">
	    				<div class="w_person_bg">
	    					<a href="/index.php/Home/Zone"><img src="/Public/home/uploads/headpic/<?php echo ($_SESSION['user']['headpic']); ?>"/></a>
	    				</div>
	    				<div class="w_info">
	    					<div class="name_box">
	    						<p><?php echo ($_SESSION['user']['username']); ?> LV99</p>
	    					</div>
	    					<div class="user_info">
	    						<ul>
	    							<li><a href="/index.php/Home/Group/group"><strong><?php echo ($follows); ?></strong><span>关注</span></a></li>
	    							<li><a href="/index.php/Home/Listen"><strong><?php echo ($fans); ?></strong><span>粉丝</span></a></li>
	    							<li id="li_last"><a href="/index.php/Home/Zone"><strong><?php echo ($conts); ?></strong><span>微博</span></a></li>
	    							
	    						</ul>
	    						<div class="clear"></div>
	    					</div>
	    				</div>
	    			</div>

	    			<div class="interest_person">
	    				<!-- 通过Ajax  -->
	    			</div>

	    			<div class="hot_talk">
	    				<div id="hot" class="interest_title">
	    					<span>热门话题</span>
	    					<a href="#"><span class="glyphicon glyphicon-repeat"></span>&nbsp;换一换</a>
	    				</div>
	    				<div class="hot_talking">
	    					<div class="talking_detail">
	    						<span>#好热的话题啊#</span>
	    						<span>12万</span>
	    					</div>
	    					<div class="talking_detail">
	    						<span>#好热的话题啊#</span>
	    						<span>12万</span>
	    					</div>
	    					<div class="talking_detail">
	    						<span>#好热的话题啊#</span>
	    						<span>12万</span>
	    					</div>
	    					<div class="talking_detail">
	    						<span>#好热的话题啊#</span>
	    						<span>12万</span>
	    					</div>
	    					<div class="talking_detail">
	    						<span>#好热的话题啊#</span>
	    						<span>12万</span>
	    					</div>
	    					<div class="talking_detail">
	    						<span>#好热的话题啊#</span>
	    						<span>12万</span>
	    					</div>
	    					<div class="talking_detail">
	    						<span>#好热的话题啊#</span>
	    						<span>12万</span>
	    					</div>
	    				</div>
	    				<div id="more">
	    					<p><a href="#">查看更多</a></p>
	    				</div>
	    			</div>
	    			<div class="hot_talk">
	    				<div id="hot" class="interest_title">
	    					<span>好站推荐</span>
	    					<a href="javascript"><span class="glyphicon glyphicon-repeat"></span>&nbsp;换一换</a>
	    				</div>
	    				<div class="hot_talking">
	    					<?php if(is_array($friendlink)): foreach($friendlink as $key=>$friendlink): ?><div class="clear"></div>
		    					<div class="friend_link">
		    						<a href="<?php echo ($friendlink["linkurl"]); ?>"><img src="/Public/home/uploads/static/<?php echo ($friendlink["linklogo"]); ?>" ></a>
		    					</div><?php endforeach; endif; ?>
	    					
	    				</div>
	    				<div id="more">
	    					<p><a href="#">查看更多</a></p>
	    				</div>
	    			</div>

	    		</div>
	    		<!-- 设置锚点，返回顶部 -->
	    		<div class="back_top">
	    			<a id="back" href="javascript:">
	    				<span class="glyphicon glyphicon-circle-arrow-up"></span>
	    			</a>
	    		</div> 

	    		<!-- <div id="load">
	    			a啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊
	    		</div> -->

	    		<div class="clear"></div>
	    	</div><!-- main结束标签 -->
		
     		<div class="clear"></div> 
    </div><!-- wrap结束标签 -->


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
	$("#main_left a").click(function(){
		$("#main_left a").removeClass("a_click");
		$(this).addClass("a_click");
	});
	$(".w_input").keyup(function(){
		var len = $(this).val().length;			
		if(len > 139){	
			$(this).val($(this).val().substring(0, 140));
			// $(this).attr("disabled",true);
		}
		var num = 140 -len;
		if(num < 0){
			num = 0;
		}
		$("#rest").text(num);
	});

	$(".interest_person").load("/index.php/Home/Recommend/recommend");
	
	function loads(id,obj){
		$.get("/index.php/Home/Content/reply/id/"+id,function(data){
			$(obj).parents('.wb_bar').next().next().children(':eq(1)').children(':eq(1)').html(data);
		});
	}
	
	$('.reply').click(function(){
		$.post('/index.php/Home/Content/add2',{'content':$('.reply_textarea').val(),'id':$('.contentid').val()},function(data){
			if(data == 'success'){
				alert('评论成功！');
				$('.list_box').load('/index.php/Home/Content/reply/id/'+$('.contentid').val(),function(){

				});
			}
		});
	})
	//ajax获取点赞数
	function praise(id,obj){
		$.get('/index.php/Home/Content/praise/id/'+id,function(data){
			$(obj).children().children(':eq(1)').html(data);
		});
	}

	//ajax获取是否收藏
	function keep(id,obj){
		$.get('/index.php/Home/Content/keep/id/'+id,function(data){
			
				$(obj).children().html(data);
			
		});
	}

	$('.letter').click(function(){
		$('#main_center').load('/index.php/Home/Letter/letter');
	});

	$('.keeplist').click(function(){
		$('.wball').load('/index.php/Home/Content/keeplist');
	});

	function groupcontent(id,obj){
	
			$('.wball').load('/index.php/Home/Content/groupcontent/id/'+id);
		
	}
	$(".friend_link:odd").css("float","right");
</script>


</html>