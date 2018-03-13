<?php
/* 
* @Author: Sunshie
* @Date:   2014-11-13 22:57:07
* @Last Modified by:   Sunshie
* @Last Modified time: 2014-11-18 11:04:33
*/
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller{
    public function _initialize(){
        $user = session('admin');
        if($user == false){
            $this -> error('您尚未登录！',U('Login/index'));
        }
		
		
        $userid = $user['userid'];
        $rule = CONTROLLER_NAME;
        
        $auth = new \Think\Auth();
        
		static $Auth;
       
		if(!$Auth){
			
            $Auth = new \Think\Auth();
        }

        if(!$Auth -> check($rule,$userid)){
            //echo "没有权限";
            $this -> error("你没有权限");
        }
    }
}
?>
