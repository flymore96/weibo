<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends Controller{
	public function index(){
		$m = M('user');
		$f = M("follow");
		$id = $_SESSION['user']['id'];
		//如果是已经关注过了的用户则不再显示在推荐收听
		$ids = $f ->where("fansid=$id")->getField('followid',true);
		if(!$ids){
			$ids = $id;
		}
		$map['id'] = array('not in',$ids);
		$data = $m->where("id!=$id")->where($map)->order('rand()')->limit(4)->select();
		$this->assign("res",$data);
		//获取右侧粉丝关注微博数
		$c = M("content");
		$uid = session('user')['id'];
		$follows = $f->where("fansid = $uid") ->count();
		$fans = $f ->where("followid = $uid") ->count();
		$counts = $c->where("uid = $uid AND replyid=0")->count();
		$this->assign("follows",$follows);
		$this->assign("fans",$fans);
		$this->assign("conts",$counts);
		$this->display();
	}
	//搜索用户主页
	public function person(){
		$m = M('user');
		$f = M('follow');
		$vals=$_POST['vals'];
		//$_SESSION['user']['val'] = $_POST['vals'];
		$this->assign("val",$vals);
		$id = $_SESSION['user']['id'];
		$ids = $f ->where("fansid=$id")->getField('followid',true);
		if(!$ids){
			$ids = $id;
		}
		$map['id'] = array('not in',$ids);
		$data = $m->where("id!=$id")->where($map)->order('rand()')->limit(4)->select();
		$this->assign("res",$data);
		
		//获取粉丝关注微博数
		$f = M("follow");
		$c = M("content");
		$uid = session('user')['id'];
		$follows = $f->where("fansid = $uid") ->count();
		$fans = $f ->where("followid = $uid") ->count();
		$counts = $c->where("uid = $uid AND replyid=0")->count();
		$this->assign("follows",$follows);
		$this->assign("fans",$fans);
		$this->assign("conts",$counts);
		$this->display();
	}
	//右侧推荐关注模块
	public function personRecommend(){
		$m = M('user');
		$f = M('follow');
		$id = $_SESSION['user']['id'];
		$ids = $f ->where("fansid=$id")->getField('followid',true);
		if(!$ids){
			$ids = $id;
		}
		$map['id'] = array('not in',$ids);
		$data = $m->where("id!=$id")->where($map)->order('rand()')->limit(4)->select();
		$this->assign("res",$data);
		$this->display();
	}
	
	public function searchBlog(){
		//仅用于判断自己的粉丝自己是否已经关注
		$f = M('follow');
        $uid = session('user')['id'];
		$resa = $f->where("fansid=$uid")->getField("followid",true);
		$this->assign("listen",$resa);
		//开始分页搜索遍历出相关微博
		$m = M('content c,t_user u');
		$keywords = trim($_POST['keywords']);
		// 查询满足要求的总记录数
		$count = $m->where("c.uid=u.id AND c.uid!=$uid AND c.content like '%{$keywords}%'")
				   ->count();
		// 实例化分页类
		$Page = new \Think\Sb($count,4);
		$list = $m->where("c.uid=u.id AND c.uid!=$uid AND c.content like '%{$keywords}%'")
				->limit($Page->firstRow.','.$Page->listRows)
				->getField('content,username,headpic,posttime,uid');
		$show = $Page->show();
		$this->assign("list",$list);
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}
	
	public function searchPerson(){
		$m = M('user');
		$f = M('follow');
		$keywords = trim($_POST['keywords']);
		$uid = session('user')['id'];
		//仅用于判断自己的粉丝自己是否已经关注
		$resa = $f->where("fansid=$uid")->getField("followid",true);
		$this->assign("listen",$resa);
		//开始分页搜索
		$map['id'] = array('NEQ',$uid);
		$map['username'] = array('like',"%{$keywords}%");
		$count = $m->where($map)->count();// 查询满足要求的总记录数
		// 实例化分页类
		$Page = new \Think\Sb($count,6);
		$list = $m->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
		$show = $Page->show();
		$this->assign('list',$list);//赋值数据库集
		$this->assign('page',$show);// 赋值分页输出
		//获取粉丝关注微博数
		$c = M("content");
		$follows = $f->where("fansid = $uid") ->count();
		$fans = $m ->where("followid = $uid") ->count();
		//$counts = $c->where("uid = $uid AND replyid=0")->count();
		$this->assign("follows",$follows);
		$this->assign("fans",$fans);
		//$this->assign("conts",$counts);
		$this->display();
	}
	
	public function follow(){
		$f = M("follow");
		$uid = $_GET['id'];
		$data['fansid'] = session('user')['id'];
		$data['followid'] = $uid;
		$fansid = session('user')['id'];
		$followid = $uid;
		$res = $f ->where("fansid = $fansid and followid = $followid")->select();

		//$this->display();
		if($res){
			echo 0;
		}else{
			$f ->add($data);
			echo 1;
		}
	}
	//遍历出的微博判断是否已经关注
	public function follows(){
		$f = M("follow");
		$uid = $_GET['uid'];
		$data['fansid'] = session('user')['id'];
		$data['followid'] = $uid;
		$fansid = session('user')['id'];
		$followid = $uid;
		$res = $f ->where("fansid = $fansid and followid = $followid")->select();
		//$this->display();
		if($res){
			echo 0;
		}else{
			$f ->add($data);
			echo 1;
		}
	}
	
	

}
?>