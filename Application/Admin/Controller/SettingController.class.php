<?php
/* 
* @Author: Sunshie
* @Date:   2014-11-12 20:24:17
* @Last Modified by:   Sunshie
* @Last Modified time: 2014-11-24 09:21:37
*/
namespace Admin\Controller;
use Think\Controller;
class SettingController extends PublicController{

    public function siteset(){
        $model = M('webconfig');
        $res = $model->find();
        $this->assign('title',$res['title']);
        $this->assign('icpno',$res['icpno']);
        $this->assign('keywords',$res['keywords']);
        $this->assign('description',$res['description']);
        $this->assign('contact',$res['contact']);
        $this->assign('logo',$res['logo']);
        $this->display();
    }
    //修改网站信息
    public function sitesave(){
        $_POST['id'] = 1;
        $model = M('webconfig');
        if($model->create()){
            $res = $model->save();
            if($res){
                $this->success("修改网站信息成功!");
            }else{
                $this->error("修改网站信息失败!");
            }
        }else{
            $this->error("修改网站信息失败!");
        }
    }

    //更换网站logo
    public function replogo(){
        $config = array(
                'maxSize'    => 3145728,
                'rootPath'   => 'Public',
                'savePath'   =>    './home/uploads/static/',
                'saveName'   =>    array('uniqid',''),
                'autoSub'    => false,


            );
        $upload = new \Think\Upload($config);
        $info   =   $upload->upload();
        if(!$info){
            $this->error($upload->getError());
        }else{
            $model = M('webconfig');
            $data['logo'] = $info['logo']['savename'];
            $res = $model->where('id=1')->save($data);
            if($res){
                $webconfig = M('webconfig');
                $config = $webconfig->find();
                session('config',$config);
                $this->success('更换成功！');
            }
        }
        
    }
}
?>
