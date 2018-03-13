<?php
namespace Home\Controller;
use Think\Controller;
class FriendController extends Controller{
	public function friend(){
		$f = M("friendlink");
		$data = $f -> limit(5) -> select();
		$this -> assign('friendlink',$data);
	}
}