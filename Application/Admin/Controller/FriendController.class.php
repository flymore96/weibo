<?php
namespace Admin\Controller;
use Think\Controller;
class FriendController extends PublicController{
	public function lists(){
		$w = M('friendlink');
		$count = $w ->count();
		$Page = new \Think\Sb($count,6);
		$show = $Page->show();// 分页显示输出

		$w = M('friendlink');
		$data = $w -> limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this -> assign("lists",$data);
		$this -> assign("counts",$count);
		$this->assign('page',$show);// 赋值分页输出
		$this -> display();
	}

	public function add(){
		$this -> display();
	}

	public function edit(){
		$id = intval($_GET['id']);
		$w = M('friendlink');
		$data = $w -> where("id=$id")->find();
		$this -> assign("edits",$data);
		$this -> display();
	}

	public function update(){
		$w = M('friendlink');
		if(!empty($_FILES['linklogo']['name'])){
			$_POST['linklogo'] = $this->upload();
		}else{
			unset($_POST['linklogo']);

		}
		
		if($w -> create()){
            	$res = $w->save();
	            if($res){
	                $this->success("修改成功","lists");
	            }else{
	                $this->error("修改失败");
	            }
        	}else{
            	$this->error("修改失败");
        	}
	}

	public function del(){
		$id = intval($_GET['id']);
		$w = M('friendlink');
		$res = $w ->delete($id);
		if($res){
               echo 1;
            }else{
                echo 0;
            }
	}

	public function delall(){		
		$id = $_POST['name'];
		$id = join(',',$id);
		$w = M('friendlink');
		$res = $w ->where("id in($id)")->delete();
		if($res){
               echo 1;
            }else{
                echo 0;
            }
	}

	private function upload(){
		$config = array(
			'maxSize' =>3145728,// 设置附件上传大小
			'exts' => array('jpg', 'gif', 'png', 'jpeg'),// 设置附件上传类型
			'savePath' => './home/uploads/static/', // 设置附件上传目录
			'rootPath' => 'Public',
			'hash'=> true,
			'autoSub'=>false,
			);
		$upload = new \Think\Upload($config);// 实例化上传类
		// 上传文件
		
		$info   =   $upload->upload();
			if(!$info) {// 上传错误信息
				$this->error($upload->getError());
			}else{
				// 上传成功
				 return $info['linklogo']['savename'];
			}
	}
	//上传logo图
	public function insert(){
		
		$f = M('friendlink');
		 $_POST['linklogo'] = $this->upload();
		if($f -> create()){
            	$res = $f->add();
	            if($res){
	                $this->success("添加成功","lists");
	            }else{
	                $this->error("添加失败");
	            }
        	}else{
            	$this->error("添加失败");
        	}
	}

}