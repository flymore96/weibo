$(function(){
	$(".wb_bar .pinglun").click(function(){
		$(this).parents(".wb_bar").next().next().toggle(600);
		// $(".wb_feed_repeat").toggle(600);
	});
	
	$(".wb_bar .zhuanfa").click(function(){
		// $(".wb_move").css("display","block");
		$(this).parent().parent().next().css("display","block");
		$(".mask").css("height",$(document).height());  
	     	$(".mask").css("width",$(document).width());  
	      $(".mask").show();  
	});

	$(".move_title .close").click(function(){
		$(this).parent().parent().hide();
		// $(".wb_move").hide();
		$(".mask").hide(); 
	});

	$(document).scroll(function(){
    		// alert($('#wrap').height());
	})
	
	$(document).scroll(function(){
		if($(document).scrollTop()>900){
			$(".back_top").slideDown(500);	
		}
		if($(document).scrollTop()<=500){
			$(".back_top").slideUp(500);
		}
	});	

	$("#back").click(function(){
		$('body,html').animate({scrollTop:0},500); 
	});

	
		
})


	