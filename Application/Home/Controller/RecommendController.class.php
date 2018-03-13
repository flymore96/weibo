<?php
/* 
* @Author: Litao
* @Date:   2014-11-04 14:41:09
* @Last Modified by:  litao
*/
namespace Home\Controller;
use Think\Controller;
class RecommendController extends Controller{
    public function recommend(){
	$u = M('user');
	$f = M("follow");
	$uid = session('user')['id']; 
	$ids = $f->where("fansid=$uid")->getField('followid',true);
	// var_dump($ids);exit;
	if (!$ids) {
		$ids=$uid;
	} 
	// map表达式查询
	$map['id']  = array('not in',$ids);	
	$data = $u->where($map)->where("id!=$uid")->order('rand()')->limit(4)->select();
	
	$this -> assign('sign',$data);
	$this->display();
    }
}
