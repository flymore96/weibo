<?php
namespace Home\Controller;
use Think\Controller;
class FollowController extends Controller{
	public function follow(){
		$f = M("follow");
		$uid = session('user')['id'];
		$followid = $_GET['id'];
		$data['fansid'] = $uid;
		$data['followid'] = $followid;
		$res = $f -> where("fansid=$uid and followid=$followid")->select();
		if ($res) {
			echo 1;
		}else{
			$f -> add($data);
			echo 0;
		}		
	}

	// public function find(){
	// 	$m = M('user');
	// 	$data = $m->order('rand()')->limit(4)->select();
	// 	$this -> assign('sign',$data);
	// }

	public function follows(){
		$m = M("follow");
		$c = M("content");
		$uid = session('user')['id'];
		$follows = $m->where("fansid = $uid") -> count();
		$fans = $m->where("followid = $uid") -> count();
		$conts = $c->where("uid = $uid AND replyid=0") -> count();
		$this->assign("follows",$follows);
		$this->assign("fans",$fans);
		$this->assign("conts",$conts);
	}

	public function test(){
		$bad = array('共产党','苍井空','罗玉凤');
		$good = array('好领导','老师','美女');
		$arr = array(array('毛主席是共产党'),'苍井空是啥','罗玉凤炒作','罗玉凤啊');
		$data = str_replace($bad,$good,$arr);
		var_dump($data);
	}


}