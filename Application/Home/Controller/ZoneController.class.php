<?php
/* 
* @Author: Sunshie
* @Date:   2014-11-06 15:51:37
* @Last Modified by:   Sunshie
* @Last Modified time: 2014-11-21 11:32:13
* 用户空间模块
*/
namespace Home\Controller;
use Think\Controller;
class ZoneController extends Controller{
    public function index(){
        $id = intval($_GET['id']);
        $model = M('user');
        $res = $model->where("id ='{$id}'")->find();
        $this->assign("user",$res);
        $this->display();
    }
    //我的主页页面
    public function home(){
        $id = intval($_GET['id']);
        $model = M('content');
        if($id == session('user')['id']){
            $this->assign('style','display:block;');
        }else{
            $this->assign('style','display:none;');
        }
        $res = $model->where("uid='{$id}' AND replyid=0 AND turnid=0")->select();
        //发表微博数量
        $contentnum = $model->where("uid='{$id}' AND replyid=0")->count();
        $follow = M('follow');
        //关注数
        $follownum = $follow->where("fansid ='{$id}'")->count();
        //粉丝数
        $fanswnum = $follow->where("followid ='{$id}'")->count();
        $this->assign('follownum',$follownum);
        $this->assign('fanswnum',$fanswnum);
        $this->assign('contentnum',$contentnum);
        $this->assign('content',$res);
        $this->display();
    }

    //获取回复列表
    public function getreply(){
        $id = intval($_GET['id']);
        $model = M('content');
        $res = $model->table('t_user u,t_content c')->field("c.*,u.username,u.id userid")->where("c.replyid='{$id}' AND c.uid=u.id")->order("c.id desc")->select();
        $this->assign('reply',$res);
        $this->display();
    }

    //发表回复
    public function replysend(){
        $data['replyid'] = intval($_GET['id']);
        $data['uid'] = session('user')['id'];
        $data['content'] = $_POST['content'];
        $data['posttime'] = time();
        $model = M('content');
        $res = $model->add($data);
        if($res){
            echo "success";
        }else{
            echo "error";
        }
    }
    
    //删除微博
    public function contentdel(){
        $id = intval($_GET['id']);
        $uid = session('user')['id'];
        $model = M('content');
        $res = $model ->where("id='{$id}'")->find();
        //权限判断
        if($res['uid'] == $uid){
            $del = $model->delete($id);
            if($del){
                echo 'success';
            }else{
                echo 'error';
            }
        }else{
            echo 'error';
        }
    }

    public function replydel(){
        $id = intval($_GET['id']);
        $replyid = intval($_GET['replyid']);
        $uid = intval($_GET['uid']);
        $isdel = false;
        $model = M('content');
        $res = $model ->where("id='{$replyid}'")->find();
        if($uid == session('user')['id']){
            $isdel = true;
        }elseif($res){
            $isdel = true;
        }else{
            $isdel = false;
        }
        if($isdel){
            $del = $model->delete($id);
            if($del){
                echo "success";
            }else{
                echo "error";
            }
        }else{
            echo "error";
        }

    }

    //相册首页
    public function photo(){
        $model = M('photo');
        $uid= session('user')['id'];
        $res = $model->where("uid = '{$uid}'")->select();
        $m = M('images');
        foreach ($res as &$value) {
            $a = $m->where("pid='{$value['id']}'")->find();
            $value['img'] = $a['img'];
        }
        $this->assign('photo',$res);
        $this->display();
    }

    //创建相册
    public function photo_create(){
        $this->display();
    }

    //保存相册
    public function photo_save(){
        $model = M('photo');
        if($model->create()){
            if($model->add()){
                $this->success("创建相册成功！");
            }else{
                $this->error("创建相册失败!");
            }
        }else{
            $this->error("创建相册失败!");
        }
    }

    //图片上传页面
    public function photo_upload(){
        $model = M('photo');
        $uid = session('user')['id'];
        $res  = $model->where("uid = '{$uid}'")->select();
        $this->assign('data',$res);
        $this->display();
    }

    //文件上传
    public function upload(){
     if (!empty($_FILES)) {
            //图片上传设置
            $config = array(   
                'maxSize'    =>    3145728, 
                'rootPath'   =>    'Public',
                'savePath'   =>    '/home/uploads/ablum/',  
                'saveName'   =>    array('uniqid',''), 
                'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),  
                'autoSub'    =>    false,   
                'subName'    =>    array('date','Ymd'),
            );
            $upload = new \Think\Upload($config);// 实例化上传类
            $images = $upload->upload();
            //判断是否有图
            if($images){
                $info=$images['Filedata']['savename'];
                //返回文件地址和名给JS作回调用
                echo $info;
                $data['pid'] = intval($_GET['pid']);
                $data['img'] = $info;
                $model = M('images');
                $model->add($data);
            }
            else{
                $this->error($upload->getError());//获取失败信息
            }
        }
    }

    //删除相册
    public function delphoto(){
        $id = intval($_GET['id']);
        $uid = session('user')['id'];
        $model = M('photo');
        $isphoto = $model->where("uid ='{$uid}' AND id = '{$id}'")->find();
        if(!$isphoto){
            //非法操作
            exit('110');
        }
        $res = $model ->delete($id);
        if($res){
            echo "success";
        }else{
            echo "error";
        }
    }

    //更新相册页面
    public function editphoto(){
        $id = intval($_GET['id']);
        $uid = session('user')['id'];
        $model = M('photo');
        $isphoto = $model->where("uid ='{$uid}' AND id = '{$id}'")->find();
        if(!$isphoto){
            //非法操作
            exit('110');
        }
        $this->assign('data',$isphoto);
        $this->display();
    }

    //更新相册
    public function photo_update(){
        $id = intval($_POST['id']);
        $uid = session('user')['id'];
        $model = M('photo');
        $isphoto = $model->where("uid ='{$uid}' AND id = '{$id}'")->find();
        if(!$isphoto){
            //非法操作
            exit('110');
        }
        if($model->create()){
            if($model->save()){
                $this->success('更新成功!');
            }else{
                $this->error("更新失败");
            }
        }else{
            $this->error("更新失败");
        }

    }

    public function showimg(){
        $id = intval($_GET['id']);
        $model = M('images');
        $res = $model->where("pid = '{$id}'")->select();
        $this->assign('data',$res);
        $this->assign('name',$_GET['name']);
        $this->assign('id',$id);
        $this->display();
    }

    public function delimg(){
        $id = intval($_GET['id']);
        $model = M('images');
        $res = $model->delete($id);
        if($res){
            echo "success";
        }else{
            echo "error";
        }
    }

    
}
?>
