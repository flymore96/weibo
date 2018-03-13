/* 
* @Author: xiechao
* @Date:   2014-11-03 21:03:48
* @Last Modified by:   xiechao
* @Last Modified time: 2014-11-04 17:25:51
*/

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
        msg = "&nbsp;<img src='__PUBLIC__/Index/User/images/wrong.png'><span class='error'>邮箱不能为空</span>";  
    }else if(!$(obj).val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
         $(obj).css('background','#FFE7E7');
         msg = "&nbsp;<img src='__PUBLIC__/Index/User/images/wrong.png'><span class='error'>邮箱格式不对</span>";
    }else{
        $(obj).css('background','#ffffff');
         msg = "&nbsp;<img src='__PUBLIC__/Index/User/images/right.png'>";
        chkEmail = true;
    }
   }

   //确认密码函数
   function checkRepwd(obj){
    chekRepwd = false;
    if($(obj).val().length == 0){
         $(obj).css('background','#FFE7E7');
        msg = "&nbsp;<img src='__PUBLIC__/Index/User/images/wrong.png'><span class='error'>密码不能为空</span>";
    }else if($(obj).val() != $("input:eq(2)").val()){
        $(obj).css('background','#FFE7E7');
         msg = "&nbsp;<img src='__PUBLIC__/Index/User/images/wrong.png'><span class='error'>两次密码不一致</span>";
    }else{
        $(obj).css('background','#ffffff');
         msg = "&nbsp;<img src='__PUBLIC__/Index/User/images/right.png'>";
        chkRepwd = true;
    }
   }

   //验证密码函数
   function checkPwd(obj){
    chekPwd = false;
    if($(obj).val().length == 0){
        $(obj).css('background','#FFE7E7');
        msg = "&nbsp;<img src='__PUBLIC__/Index/User/images/wrong.png'><span class='error'>密码不能为空</span>";
    }else if($(obj).val().length < 6){
        $(obj).css('background','#FFE7E7');
        msg = "&nbsp;<img src='__PUBLIC__/Index/User/images/wrong.png'><span class='error'>密码长度不能小于6位</span>";
    }else{
        $(obj).css('background','#ffffff');
        msg = "&nbsp;<img src='__PUBLIC__/Index/User/images/right.png'>";
        chkPwd = true;
    }

   }

    //验证用户名函数
   function checkUname(obj){
        chekUname = false;
        if($(obj).val().length == 0){
            $(obj).css('background','#FFE7E7');
            msg = "&nbsp;<img src='__PUBLIC__/Index/User/images/wrong.png'><span class='error'>用户名不能为空</span>";
        }else if($(obj).val().length < 6){
            $(obj).css('background','#FFE7E7');
            msg = "&nbsp;<img src='__PUBLIC__/Index/User/images/wrong.png'><span class='error'>用户名长度不能小于6位</span>";  
        }else{
            $(obj).css('background','#ffffff');
            msg = "&nbsp;<img src='__PUBLIC__/Index/User/images/right.png'>";
            chekUname = true;
        }
   }

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
