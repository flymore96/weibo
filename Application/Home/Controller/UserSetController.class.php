<?php
namespace Home\Controller;
use Think\Controller;
use Think\Area;
class UserSetController extends Controller{
	public function index(){
        //获取用户信息
		$user=M('user');
		$id = $_SESSION['user']['id'];
		$res = $user->where("id=$id")->select();
		$data['qq'] = $res['0']['qq'];
		$data['username'] = $res['0']['username'];
		$data['email'] = $res['0']['email'];
		$data['sex'] = $res['0']['sex'];
		$data['provinve'] = $res['0']['province'];
		$data['county'] = $res['0']['county'];
		$data['sign'] = $res['0']['sign'];
		$data['city'] = $res['0']['city'];
		$this->assign("data",$data);
		//城市三级联动
		$pro = array("省","市","县");
		$this->assign("city",Area::city($pro));
		$this->display();
	}
	//修改基本信息
	public function dataSave(){
		$user = M('user');
		$id = $_SESSION['user']['id'];
		$data['sex'] = $_POST['sex'];
		$data['qq'] = $_POST['qq'];
		$data['email'] = $_POST['email'];
		$data['province'] = $_POST['province'];
		$data['city'] = $_POST['city'];
		$data['county'] = $_POST['county'];
		$data['sign'] = trim($_POST['sign']);
		$res = $user->where("id=$id")->save($data);
		if($res){
			$this->success('修改成功');
		}else{
			$this->error('修改失败');
		}
		
	}
	public function face(){
		$user = M('user');
		$id = $_SESSION['user']['id'];
		$res = $user->where("id=$id")->select();
		$data = $res['0']['headpic'];
		$this->assign("headpic",$data);
		$this->display();
	}
	//上传用户头像
	public function upload(){
		$config = array(
			'maxSize' =>3145728,// 设置附件上传大小
			'exts' => array('jpg', 'gif', 'png', 'jpeg'),// 设置附件上传类型
			'savePath' => './home/uploads/headpic/', // 设置附件上传目录
			'rootPath' => 'Public',
			'hash'=> true,
			'autoSub'=>false,
			);
		$upload = new \Think\Upload($config);// 实例化上传类
		// 上传文件
		$user = M('user');
		$id = $_SESSION['user']['id'];
		$info   =   $upload->upload();
			if(!$info) {// 上传错误信息
				$this->error($upload->getError());
			}else{// 上传成功
				 $data['headpic'] = $info['headpic']['savename'];
				 $_SESSION['user']['headpic'] = $data['headpic'];
				 $user ->where("id=$id")->save($data);
				 $this->success('上传成功');
				// echo $info['savepath'].$info['savename'];
			}
	}
	public function edu(){
		
		$this->display();
	}
	public function dataEdu(){
		$user = M('user');
		$id = $_SESSION['user']['id'];
		$data['edus'] = $_POST['school'];
		$res = $user->where("id=$id")->save($data);
		if($res){
			$this->success('修改成功');
		}else{
			$this->error('修改失败');
		}
	}
	public function work(){
		$this->display();
	}
	public function tag(){
		$this->display();
	}
	public function password(){
	
		$this->display();
	}
	//修改密码
	public function savePassword(){
		$user = M('user');
		$id = $_SESSION['user']['id'];
		$data['userpwd']=md5($_POST['password']);
		$res = $user->where("id=$id")->save($data);
		if($res){
			$this->success('修改成功','logout');
		}else{
			$this->error('修改失败');
		}
	}
	//修改密码成功自动退出登录
	 public function logout(){
        session('user',null);
        cookie('username',null);
        cookie('userpwd',null);
        $this->success('修改成请重新登录','Index/login');
    }
	//修改密码检测旧密码正确性
	public function checkpassword(){
		$m = M('user');
		$id = $_SESSION['user']['id'];
		$userpwd = md5($_POST['oldPassword']);
		$res = $m->where("userpwd='{$userpwd}' and id='{$id}'")->select();
		if($res){
			echo success;
		}else{
			echo error;
		}
	}
	public function power(){
		$this->display();
	}
	public function other(){
		$this->display();
	}
	public function chat(){
		$this->display();
	}

}	
?>