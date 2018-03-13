<?php
namespace Admin\Controller;
use Think\Controller;
class WordsController extends PublicController{
	public function words(){
		$w = M('replace');
		$count = $w ->count();
		$Page = new \Think\Sb($count,6);
		$show = $Page->show();// 分页显示输出

		$w = M('replace');
		$data = $w -> limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this -> assign("lists",$data);
		$this -> assign("counts",$count);
		$this->assign('page',$show);// 赋值分页输出
		$this -> display();
	}

	public function add(){
		$this -> display();
	}

	public function insert(){
		$w = M('replace');
		if($w -> create()){
            	$res = $w->add();
	            if($res){
	                $this->success("添加成功","Words/words");
	            }else{
	                $this->error("添加失败");
	            }
        	}else{
            	$this->error("添加失败");
        	}
	}

	
	public function edit(){
		$id = intval($_GET['id']);
		$w = M('replace');
		$data = $w -> where("id=$id")->find();
		$this -> assign("edits",$data);
		$this -> display();
	}

	public function update(){
		$w = M('replace');
		if($w -> create()){
            	$res = $w->save();
	            if($res){
	                $this->success("修改成功","Words/words");
	            }else{
	                $this->error("修改失败");
	            }
        	}else{
            	$this->error("修改失败");
        	}
	}

	public function del(){
		$id = intval($_GET['id']);
		$w = M('replace');
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
		$w = M('replace');
		$res = $w ->where("id in($id)")->delete();
		if($res){
               echo 1;
            }else{
                echo 0;
            }
	}

}