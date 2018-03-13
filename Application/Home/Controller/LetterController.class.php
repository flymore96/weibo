<?php
/* 
* @Author: xiechao
* @Date:   2014-11-11 20:23:06
* @Last Modified by:   xiechao
* @Last Modified time: 2014-11-22 01:06:07
*/
namespace Home\Controller;
use Think\Controller;
class LetterController extends Controller{

    public function letter(){
        $model = M('user');
        $data = $model -> field('username,id') -> select();
        
        $m = M('letter l,t_user u');
        $uid = session('user')['id'];
        $num = $m -> where("isread=1 AND u.id=l.uid AND l.touid={$uid}") -> count();
        $this -> assign('num',$num);

        $this -> assign('userlist',$data);
        $this -> display();
    }

    public function sendletter(){
        $letter = M('letter');
        $data['uid'] = session('user')['id'];
        $tousername = $_POST['tousername'];
        $user = M('user');
       $data['touid'] = $touid = $user -> where("username='{$tousername}'") ->  getField('id');
        $data['content'] = $_POST['content'];
        $data['sendtime'] = time();
        $res = $letter -> add($data);
        if($res){
            echo 'success';
        }else{
            echo 'error';
        }
    }

    public function send(){
         $m = M('letter l,t_user u');
         $uid = session('user')['id'];
        $data = $m -> where("u.id=l.uid AND l.uid={$uid}") -> field('l.*,u.headpic,u.username,u.id userid') -> select();
        $this -> assign('send',$data);
        $this -> display();
    }
    public function noread(){
         $m = M('letter l,t_user u');
        $uid = session('user')['id'];
        $data = $m -> where("isread=1 AND u.id=l.uid AND l.touid={$uid}") -> field('l.*,u.headpic,u.username,u.id userid') -> select();
        // $num = $m -> where("isread=1 AND u.id=l.uid AND l.touid={$uid}") -> count();
        $this -> assign('noread',$data);
        $data['isread'] = 0;
        $m  -> where("touid={$uid}") -> save($data);
        $this -> display();
    }

    public function isread(){
        $m = M('letter l,t_user u');
        $uid = session('user')['id'];
        // $data['isread'] = 0;
        // $m  -> where("touid={$uid}") -> save($data);
        $data = $m -> where("l.isread=0 AND u.id=l.uid AND l.touid={$uid}") -> field('l.*,u.headpic,u.username,u.id userid') -> select();
        $this -> assign('isread',$data);
        $this -> display();
    }

    public function delletter(){
        $m = M('letter');
        $id = $_GET['id'];
        $res = $m -> where("id={$id}") -> delete($id);
        if($res){
            echo 'success';
        }else{
            echo 'error';
        }
    }

}
        
?>
