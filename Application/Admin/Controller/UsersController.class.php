<?php
/* 
* @Author: Sunshie
* @Date:   2014-11-12 23:23:08
* @Last Modified by:   Sunshie
* @Last Modified time: 2014-11-14 09:25:50
*/
namespace Admin\Controller;
use Think\Controller;
class UsersController extends PublicController{
    public function search(){
        $this->display();
    }

    public function lists(){
        $keyword = trim($_GET['keyword']);
        $type = intval($_GET['type']);
        $model = M('user');
        //if($type == 0){
            $res = $model ->where("username like '%{$keyword}%'")->getField('id,username,email,lastip,money');
            $count = count($res);
            $Page = new \Think\Sb($count,10);
            foreach($keyword as $key=>$val) {
                $Page->parameter.= "$key=".urlencode($val).'&';
            }
            // $Page->setConfig('header','个会员');
            $Page->setConfig('prev','<i class="icon-double-angle-left"></i>');
            $Page->setConfig('next','<i class="icon-double-angle-right"></i>');
            // $Page->setConfig('first','首页');
            // $Page->setConfig('last','尾页');
            $Page->setConfig('theme','  %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $show = $Page->show();
            $result = $model ->where("username like '%{$keyword}%'")->limit($Page->firstRow.','.$Page->listRows)->getField('id,username,email,lastip,money');
            $pagenum = ceil($count/6);
            $this->assign('pagenum',$pagenum);
            $this->assign('page',$show);
            $this->assign('num',$count);
            $this->assign('data',$result);
        //}
        $this->display();
    }

    //删除用户
    public function del(){
        $id = intval($_GET['id']);
        $model = M('user');
        $res = $model->delete($id);
    }

    //查看用户
    public function show(){
        $id = intval($_GET['id']);
        $model = M('user');
        $res = $model->where("id={$id}")->find();
        $this->assign('row',$res);
        $this->display();
    }
    //修改用户
    public function edit(){
        $id = intval($_GET['id']);
        $model = M('user');
        $res = $model->where("id={$id}")->find();
        $this->assign('row',$res);
        $this->display();
    }
    //更新用户信息
    public function update(){
        if(empty($_POST['userpwd'])){
            unset($_POST['userpwd']);
        }else{
            $_POST['userpwd'] = trim(md5($_POST['userpwd']));
        }
        $model = M('user');
        if($model->create()){
            $res = $model->save();
            if($res){
                $this->success("修改成功");
            }else{
                $this->error("修改失败");
            }
        }else{
            $this->error("修改失败");
        }
    }
}
?>
