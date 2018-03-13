<?php
namespace Home\Controller;
use Think\Controller;
class FindController extends Controller{
	public function find(){
		$m = M('user');
		$data = $m->order('rand()')->limit(4)->select();
		$this -> assign('sign',$data);
		// $this->display('Index:index');
	}




















}