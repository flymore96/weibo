<?php if (!defined('THINK_PATH')) exit();?><div  class="interest_title">
	<span>可能感兴趣的人</span>
	<a id="interest" href="javascript:;"><span class="glyphicon glyphicon-repeat"></span>&nbsp;换一换</a>
</div>

<?php if(is_array($sign)): foreach($sign as $key=>$vo): ?><div class="interest_first">
		<div class="interest_box">
			<div class="person_headpic">
				<img src="/Public/home/uploads/headpic/<?php echo ($vo["headpic"]); ?>" alt="">
			</div>
			<div class="person_name">
				<p><?php echo ($vo["username"]); ?>V<?php echo ($vo["id"]); ?></p>
				<span class=""><a onclick="follow(<?php echo ($vo["id"]); ?>,this)" href="javascript:;">+&nbsp;关注</a></span>
			</div>
		</div>
	</div><?php endforeach; endif; ?>
<script>
	$("#interest").click(function(){
		$(".interest_person").load("/index.php/Home/Recommend/recommend");
	});

	function follow(id,obj){
		$.get("/index.php/Home/Follow/follow/id/"+id,function(data){
			if (data == 1) {
				alert("您已关注此用户");
			}else if(data == 0){
				alert("关注成功");
				$(obj).text("已关注");	
			}
		});
	}

</script>