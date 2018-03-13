<?php
/* 
* @Author: Sunshie
* @Date:   2014-11-17 09:46:24
* @Last Modified by:   Sunshie
* @Last Modified time: 2014-11-24 01:56:28
*/
namespace Admin\Controller;
use Think\Controller;
class AdminController extends PublicController{
    //管理员列表页面
    public function admin(){
        $this->display();
    }

    //角色列表
    public function group(){
        $this->display();
    }

    //添加角色页面
    public function AddGroup(){
        $model = M('auth_rule');
        $res = $model ->Field('id,title')->select();
        $this->assign('data',$res);
        $this->display();
    }
    //保存添加角色
    public function GroupSave(){
        $_POST['rules'] = join(',',$_POST['rules']);
        $model = M('auth_group');
        if($model->create()){
            if($model->add()){
                $this->success('添加角色成功');
            }else{
                $this->error("添加角色失败");
            }
        }else{
            $this->error("添加角色失败");
        }
    }

    //角色列表
    public function GroupList(){
        $model = M('auth_group');
        $res = $model->select();
        $this->assign('data',$res);
        $this->display();
    }

    public function GroupDel(){
        $id = intval($_GET['id']);
        $model = M('auth_group');
        $res = $model->delete($id);
        if($res){
            $this->success("删除角色成功");
        }else{
            $this->error("删除角色失败");
        }
    }

    public function GroupEdit(){
        $id = intval($_GET['id']);
        $m = M('auth_group');
        $res = $m ->where("id = '{$id}'")->find();
        $model = M('auth_rule');
        $result = $model ->Field('id,title')->select();
        $this->assign('data',$res);
        $this->assign('d',$result);
        //dump($res);
        $this->display();
    }

    public function GroupUpdate(){
        $_POST['rules'] = join(',',$_POST['rules']);
        $model = M('auth_group');
        if($model->create()){
            if($model->save()){
                $this->success("修改成功",'GroupList');
            }else{
                $this->error("修改失败");
            }
        }else{
            $this->error("修改失败");
        }
    }

    //管理员列表
    public function AdminList(){
        $model = M('admin');
        $res = $model->select();
        $this->assign('data',$res);
        $this->display();
    }

    //添加管理员
    public function AddAdmin(){
        $model = M('auth_group');
        $res = $model->where("status=1")->select();
        $this->assign('data',$res);
        $this->display();
    }

    public function ajax_check(){
        $username = $_GET['username'];
        $m = M('admin');
        $res = $m->where("username = '{$username}'")->find();
        if($res){
            echo "error";
        }else{
            echo "success";
        }
    }

    public function AdminSave(){
        $model = M('admin');
        $m = M('auth_group_access');
        $data['username'] = trim($_POST['username']);
        $data['password'] = md5(trim($_POST['password']));
        $data['lasttime'] = time();
        $d['group_id'] = intval($_POST['gid']);
        $d['uid'] = $model->add($data);
        $res = $m ->add($d);
        if($res){
            $this->success('添加管理用户成功','AdminList');
        }else{
            $this->error('添加管理用户失败');
        }

    }

    public function AdminDel(){
        $userid = intval($_GET['id']);
        $m = M('admin');
        $res = $m->delete($userid);
        $model = M('auth_group_access');
        $model ->where("uid={$userid}")->delete();
        if($res){
            $this->success("删除用户成功");
        }else{
            $this->error("删除用户失败");
        }
   }

   public function AdminEdit(){
        $userid = intval($_GET['id']);
        $model = M('admin');
        $res = $model->where("userid='{$userid}'")->find();
        $m = M('auth_group');
        $result = $m->where("status=1")->select();
        $access = M('auth_group_access');
        $row = $access->where("uid='{$userid}'")->find();
        $this->assign('group',$row);
        $this->assign('d',$result);
        $this->assign('data',$res);
        $this->display();
   }

   public function AdminUpdate(){
        if(empty($_POST['password'])){
            unset($_POST['password']);
        }else{
            $_POST['password'] = md5(trim($_POST['password']));
        }
        $model = M('admin');
        if($model->create()){
            $uid = intval($_POST['userid']);
            $data['group_id'] = intval($_POST['gid']);
            $m = M('auth_group_access');
            $res = $m ->where("uid='{$uid}'")->save($data);
            if($model->save() or $res){
                
                $this->success('修改成功');
            }else{
                $this->success('修改失败');
            }
        }
   }
    
}
?>
