<?php
namespace Home\Controller;
use Think\Controller;
class ListenController extends Controller{
	public function index(){
		//仅用于判断自己的粉丝自己是否已经关注
		$f = M('follow');
        $uid = session('user')['id'];
		$resa = $f->where("fansid=$uid")->getField("followid",true);
		$this->assign("listen",$resa);
		//获取我的粉丝信息
		$m = M('follow f,t_user u');
		$uid = session('user')['id'];
		$count = $m ->where("f.followid=$uid and u.id=$uid")->count();
		$this->assign('count',$count);
		$Page = new \Think\Page($count,12);
		$list = $m->where("f.followid=$uid and u.id=fansid")
				->limit($Page->firstRow.','.$Page->listRows)
				->select();
		$show = $Page->show();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	
	public function follow(){
		$m = M('follow f,t_user u');
		$uid = session('user')['id'];
		$count = $m ->where("f.fansid=$uid and u.id=$uid")->count();
		$this->assign('count',$count);
		//$res = $m ->where("f.followid=$id and u.id=$id")->getField('fansid',true);
		//var_dump($res);
		//实例化分页类
		$Page = new \Think\Page($count,12);
		$list = $m->where("f.fansid=$uid and u.id=followid")
				->limit($Page->firstRow.','.$Page->listRows)
				->select();
		$show = $Page->show();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	
	public function add(){
		$f = M('follow');
		$uid = session('user')['id'];
		$fansid = $_GET['fansid'];
		$data['fansid'] = session('user')['id'];
		$data['followid'] = $_GET['fansid'];
		$resa = $f->where("fansid=$uid and followid=$fansid")->select();
		//$res = $f->add($data);
		if($resa){
			echo 1;
		}else{
			$f->add($data);
			echo 0;
		}
	}
	
	public function dele(){
		$f = M('follow');
		$uid = session('user')['id'];
		$followid = $_GET['followid'];
		$res = $f->where("fansid=$uid and followid=$followid")->delete();
		if($res){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	public function right(){
		//仅用于判断自己的粉丝自己是否已经关注
		$f = M('follow');
        $uid = session('user')['id'];
		$resa = $f->where("fansid=$uid")->getField("followid",true);
		$this->assign("listen",$resa);
		//利用ajax加载right模板因此需要重复index方法获取数据
		$m = M('follow f,t_user u');
		$uid = session('user')['id'];
		$count = $m ->where("f.followid=$uid and u.id=$uid")->count();
		$this->assign('count',$count);
		$Page = new \Think\Page($count,12);
		$list = $m->where("f.followid=$uid and u.id=fansid")
				->limit($Page->firstRow.','.$Page->listRows)
				->select();
		$show = $Page->show();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}

}
?>