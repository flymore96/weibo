<?php

namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller{
    public function _before_index(){    
        $content = A('Content');
        $content -> index(); 
        $follows =A('Follow');
        $follows -> follows(); 
        $group =A('Group');
        $group -> groupIndex();
        $friend =A('Friend');
        $friend -> friend();
    }

    //首页
    public function index(){
        $webconfig = M('webconfig');
        $config = $webconfig->find();
        session('config',$config);
        //记住密码自动登录
        if(!empty($_COOKIE['username']) && !empty($_COOKIE['userpwd'])){
            $username = cookie('username');
            $userpwd = cookie('userpwd');
            $model = M('user');
            $res = $model->where("username='{$username}' AND userpwd='{$userpwd}'")->find();
            if($res){
                session('user',$res);
            }
        }
        
        if(!session('?user')){
            redirect(__APP__.'/Home/Index/login');
        }
      
        $this -> assign("userData",$data);
        $this->display();
      
    }  

    public function load(){
        $arr =array(1,2,3,4,5);
        $arr2=array(6,7,8,9,0);
        $this->assign("sign",$arr); 
        $this->assign("sign2",$arr2); 
        $this->display();
    }

    //用户登录页面
    public function login(){
        //登录页标题
        $this->assign('title','登录 - 腾讯微博');
        if(!session('?iserror')){
            session('iserror','0');
        }
        //密码错误三次以上显示验证码
        if(session('iserror')>='3'){
            $this->assign('style','block');
        }else{
            $this->assign('style','none');
        }
        $this->display();
    }

    //验证登陆
    public function checkLogin(){
        $webconfig = M('webconfig');
        $config = $webconfig->find();
        session('config',$config);
        $vcode = trim($_POST['vcode']);
        if((!$this->check_vcode($vcode)) && (session('iserror')=='3')){
            $this->error('验证码错误');
        }
        $db = M('user');
        $user = trim($_POST['user']);
        $userpwd = md5(trim($_POST['userpwd']));
        $res = $db -> where("username = '{$user}' or email='{$user}' AND userpwd = '{$userpwd}'")->find();
        if($res){
            if($_POST['remembe']){

                cookie('username',$res['username'],3600); 
                cookie('userpwd',$res['userpwd'],3600); 
            }
			session('user',$res);
			$f = M('follow');
            $uid = session('user')['id'];
			$resa = $f->where("fansid=$uid")->getField("followid",true);
			session('listen',$resa);
            $this->success("登陆成功，跳转首页",'index');
        }else{
            $i= session('iserror') +1;
            session('iserror',$i);
            $this->error("登陆失败");
        }
    }

    public function logout(){
        session('user',null);
        cookie('username',null);
        cookie('userpwd',null);
        $this->success('退出成功','login');
    }

    //用户注册页面
    public function reg(){
        $this->display();
    }

    //用户注册插入数据库
    public function insert(){
        $vcode = trim($_POST['vcode']);
        if(!$this->check_vcode($vcode)){
           $this->error('验证码错误');
        }
        $data['username'] = trim($_POST['username']);
        $data['userpwd'] = md5(trim($_POST['userpwd']));
        $data['email'] = trim($_POST['email']);
        $data['regip'] = $data['lastip'] = get_client_ip();
        $db = M('user');
        $isuname = $db -> where("username='{$data['username']}'")->select();
        if($isuname){
            $this->error("用户名已存在");
        }
        $isemail = $db -> where("email='{$data['email']}'")->select();
        if($isemail){
            $this->error("邮箱已存在");
        }
        $result = $db ->add($data);
        if($result){
            $this->success('注册成功,请登录','login');
        }else{
            $this->error('注册失败,请联系网站管理员');
        }
    }

    //生成验证码
    public function vcode(){
        $config = array('fontSize'  => 30,
                        'length'   =>4,
                        'useNoise' => false,
                         );
        $Verify = new \Think\Verify($config);
        $Verify->codeSet = 'abcdefghijkimnopqrstov';
        $Verify->entry();
    }

    //判断验证码 $code为用户输入的验证码
    public function check_vcode($code, $id = ''){
        $vcode = new \Think\Verify();
        
        //返回布尔值
        return $vcode->check($code, $id);
    }

    //ajax验证数据
    public function ajax_check(){
        $user = M('user');
        $type = $_POST['type'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $vcode = $_POST['vcode'];
        if($type == 'iserror'){
            echo session('iserror');
        }
        if($type == "email"){
            
            $res = $user -> where("email='{$email}'") -> select();
            if($res){
                echo "error";
            }else{
                echo "success";
            }
        }
        if($type == "username"){
            $res = $user -> where("username='{$username}'") -> select();
            if($res){
                echo "error";
            }else{
                echo "success";
            }
        }
        if($type == "vcode"){
            if($this -> check_vcode($vcode)){
                echo 'success';
            }else{
                echo 'error';
            }
        }
    }
    
}
?>
