<?php
namespace Home\Controller;
use Think\Controller;
class GroupController extends Controller{
	public function group(){
		$uid = session('user')['id'];
		$g = M("group");
		// 查询当前用户有多少关注分组
		$data = $g->where("uid=$uid")->select();
		$this -> assign("groupname",$data);
		$this -> display();
	}

	// 向主页左侧输出分组的信息
	public function groupIndex(){
		$uid = session('user')['id'];
		$g = M("group");
		// 查询当前用户有多少关注分组
		$data = $g->where("uid=$uid")->select();
		$this -> assign("group",$data);
		// $this -> display();这里必须不能输出，因为主页中会输出，这里只需分配变量
	}


	// 通过Ajax加载传过来的组下的成员们
	public function thisGroup(){
		$gid = $_GET['id'];
		$uid = session('user')['id'];  
		$g = M("group");
		// 查询当前用户有多少关注分组
		$gdata = $g->where("uid=$uid")->select();
		$this -> assign("groupnameg",$gdata);

		$model = M('follow f,t_user u');

		$data = $model->where("f.gid = $gid AND f.fansid=$uid AND f.followid=u.id")
						->field("u.*,f.followid")
						->select();
						
		$this -> assign("everygroup",$data);
		// $this -> assign("gid",$gid);
		$this -> display();
	}

	// 创建新的分组
	public function newGroup(){
		$uid = session('user')['id'];
		$data['groupname'] = $_POST['groupname'];
		$data['uid'] = $uid;
		$g = M('group');
		$res = $g -> add($data);
		if ($res) {
			echo 1;
		}else{
			echo 0;
		}
	}

	// 删除分组，并解除相应组下的成员
	public function del(){
		$g = M('group');
		$f = M('follow');
		$gid = $_GET['gid'];
		$delres = $g -> where("id=$gid")->delete();
		
		if ($delres) {
			// 判断该分组下是否有成员
			$ishas = $f -> where("gid=$gid")->select();
			if ($ishas) {
				$data['gid'] = 0;
				$res = $f->where("gid=$gid")->save($data);
				if ($res) {
					echo 2;
				}
			}else{
				echo 1;
			}
		}else{
			echo 0;
		}				
	}

	// 移动所关注的用户至新的分组下
	public function updateGroup(){	
		// isset判断变量是否存在
		if(isset($_GET['followid'])){
			$followid = $_GET['followid'];
			session('fid',$followid);
		}else{
			$f = M('follow');
			$uid = session('user')['id'];
			
			// 获取用户选中的组名
			$gid = $_GET['id'];
			$fid = session('fid');
			
			$data['gid'] = $gid;
			
			$res = $f->where("fansid='{$uid}' and followid='{$fid}'")->save($data);
			
			if ($res) {
				echo 1;
			}else{
				echo 0;
			}
		}		
	}

	public function cancel(){
		$uid = session('user')['id'];
		$followid = $_GET['followid'];
		$f = M("follow");
		$res = $f -> where("fansid=$uid AND followid=$followid") -> delete();
		if ($res) {
			echo 1;
		}else{
			echo 0;
		}
	}
	
}