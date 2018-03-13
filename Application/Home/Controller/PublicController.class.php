<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller{
	public function add(){
		$s = M('user');
		$id = session('user')['id'];
		//接收换肤数据
		$data['skin'] = $_POST['src'];
		
		$res = $s ->where("id = $id")->save($data);
		if($res){
		$_SESSION['user']['skin'] = $data['skin'];
			echo 1;
		}else{
			echo 0;
		}
	}
}

?>