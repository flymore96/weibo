<?php
/* 
* @Author: Sunshie
* @Date:   2014-11-13 22:52:21
* @Last Modified by:   Sunshie
* @Last Modified time: 2014-11-17 09:18:12
*/
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
    //登陆界面显示
    public function index(){
        $this->display();
    }

    //验证登陆
    public function checklogin(){
        $model = M('admin');
        $data['username'] = trim($_POST['username']);
        $data['password'] = md5(trim($_POST['password']));
        $res = $model->where($data)->find();
        if($res){
            session('admin',$res);
            $this->success("登陆成功",__MODULE__);
        }else{
            $this->error("登陆失败");
        }
    }

    //退出登录
    public function logout(){
        session('admin',null);
        $this->success("退出成功",'index');
    }
}
?>
