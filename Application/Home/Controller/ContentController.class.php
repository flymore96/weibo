<?php
/* 
* @Author: xiechao
* @Date:   2014-11-12 09:58:52
* @Last Modified by:   xiechao
* @Last Modified time: 2014-11-24 03:07:39
*/
namespace Home\Controller;
use Think\Controller;
class ContentController extends Controller{

    //多表查询微博
    public function index(){
              
        $model = M();
        $count = $model -> table('t_content c,t_user u')
              -> where('c.uid=u.id AND c.replyid=0')
              -> field('c.*,u.username,u.headpic')
              -> order('c.id DESC')
              ->count();
        //table里的表必须写上表前缀
        //查询微博
        $Page       = new \Think\Sb($count,10);
        $data = $model -> table('t_content c,t_user u')
              -> where('c.uid=u.id AND c.replyid=0')
              -> field('c.*,u.username,u.headpic')
              -> order('c.id DESC')
              -> limit($Page->firstRow.','.$Page->listRows)
              -> select();

        //过滤词提交换
        $replace = M('replace');
        $re = $replace ->select();

        foreach($re as $v){
            for($i=0;isset($data[$i]);$i++){
              $data[$i]['content'] = str_replace($v['badwords'],$v['goodwords'],$data[$i]['content']); 
            }
        }
        
        $show       = $Page->show();// 分页显示输出

        //首次查询点赞数
        $m = M('praise');
        $k = M('keep');
        
        foreach($data as &$v){
          $id = $v['id'];
          $v['num']=$m ->where("cid={$id}")->count();
        }
        foreach($data as &$v){
            if($v['turnid']!=0){
                $res = $model -> table('t_content c,t_user u')->where("c.id = {$v['turnid']} AND c.uid=u.id")->field('c.*,u.username,u.headpic,u.id uid') ->
                find();
                $v['turn'] = $res;
            }
        }
        foreach($data as &$v){
            $id = $v['id'];
            $uid = session('user')['id'];
            $res = $k->where("cid = '{$id}' AND uid={$uid}")->find();
            if($res){
                $v['iskeep'] = 1;
            }else{
                $v['iskeep'] = 0;
            }
        }
        //dump($data);
        $this -> assign('page',$show);// 赋值分页输出

        $this -> assign('contents',$data);      
    }

    public function reply(){
         //查询评论
        $id = intval($_GET['id']);

        //多表查询第一个表必须不加t_前缀，第二个表必须加前缀t_
        $model = M('content c,t_user u');
        $res = $model->where("replyid = '{$id}' AND c.uid=u.id") -> order('id DESC')-> getField("c.*,u.username,u.id uid,u.headpic");
    
        $this->assign('cid',$id);
        $this->assign('replylist',$res);
        $this->display();

    }

    //发表微博
    public function add(){
        $content = M('content');
        $data['uid'] = session('user')['id'];

        //去除html标签
        // $data['content'] = strip_tags($_POST['content']);
        // htmlspecialchars()把html的字符转义了,最后显示出来的就是html源代码
        $data['content'] = htmlspecialchars($_POST['content']);

        $data['posttime'] = time();
         $res = $content -> add($data);
      // var_dump($data);
      if($res){
        $this -> success('发送微博成功');
        // echo 'success';
      }else{
        $this -> error('发送微博失败');
        // echo 'error';
      }

    }

    //发表评论
    public function add2(){
      $content = M('content');
      $data['uid'] = session('user')['id'];
      $data['content'] = htmlspecialchars($_POST['content']);
      $data['posttime'] = time();
      $data['replyid'] = $_POST['id'];
      $res = $content -> add($data);
      if($res){
        // $this -> success('评论微博成功');
        echo 'success';
      }else{
        // $this -> error('评论微博失败');
        echo 'error';
      }

    }

    //回复评论
    public function add3(){
      $content = M('content');
      $data['uid'] = session('user')['id'];
      $data['content'] = $_POST['content'];
      $data['posttime'] = time();
      $data['replyid'] = $_POST['id'];
      $res = $content -> add($data);
      // var_dump($data);
      // echo $data['replyid'];
      // exit();
      if($res){
        $this -> success('回复评论成功');
      }else{
        $this -> error('回复评论失败');
      }

    }

    //转发微博
    public function turn(){
      $content = M('content');
      $data['uid'] = session('user')['id'];
      $data['content'] = htmlspecialchars($_POST['content']);
      $data['posttime'] = time();
      $data['turnid'] = $_POST['id'];
      $res = $content -> add($data);
      // dump($data);
      // exit;
      if($res){
        $this -> success('转发成功');
      }else{
        $this -> error('转发失败');
      }
    }

    //点赞
    public function praise(){
      $praise = M('praise');
      $data['uid'] = session('user')['id'];
      $cid = $data['cid'] = $_GET['id'];

      $iszan = $praise ->where("uid={$data['uid']} AND cid={$cid}")->find();
      if($iszan){
          $praise -> delete($iszan['id']);
      }else{
        $res = $praise -> add($data);
      } 
      $praisenum = $praise -> where("cid='{$cid}'") -> count('uid');
      echo $praisenum; 
    }

    //收藏
    public function keep(){
      $keep = M('keep');
      $data['uid'] = session('user')['id'];
      $cid = $data['cid'] = $_GET['id'];

      $iskeep = $keep -> where("uid={$data['uid']} AND cid={$cid}") -> find();
      if($iskeep){
        $keep -> delete($iskeep['id']);
        echo $text1 = '收藏';
      }else{
        $res = $keep -> add($data);
        echo $text2 = '取消收藏';
      }

    }

   public function keeplist(){
    $keep = M('keep');
    $uid = session('user')['id'];
    $count = $keep -> count('id');
    $cid = $keep -> where("uid={$uid}") -> getField('cid',true);
    // dump($cids);
    $cids = join(',',$cid);
     $model = M(); 
      
     //查询微博
        $Page       = new \Think\Sb($count,10);
        $data = $model -> table('t_content c,t_user u')
              -> where("c.uid=u.id AND c.replyid=0 AND c.turnid=0 AND c.id in ($cids)")
              -> field('c.*,u.username,u.headpic')
              -> order('c.id DESC')
              -> limit($Page->firstRow.','.$Page->listRows)
              -> select();
        $show       = $Page->show();// 分页显示输出
        $this -> assign('page',$show);// 赋值分页输出

        //首次查询点赞数
        $m = M('praise');
        $k = M('keep');
        foreach($data as &$v){
          $id = $v['id'];
          $v['num']=$m ->where("cid={$id}")->count();
        }

        foreach($data as &$v){
            $id = $v['id'];
            $uid = session('user')['id'];
            $res = $k->where("cid = '{$id}' AND uid={$uid}")->find();
            if($res){
                $v['iskeep'] = 1;
            }else{
                $v['iskeep'] = 0;
            }
        }

        $this -> assign('contents',$data);     
        $this -> display();
   }

   public function groupcontent(){
    // $f = M('follow');
    $gid = intval($_GET['id']);
    $uid = session('user')['id'];
    $model = M();
    $data = $model->table("t_follow f,t_content c,t_user u")
        ->where("f.gid={$gid} AND c.uid=u.id AND f.fansid={$uid} AND c.uid=f.followid")->field("c.*,u.headpic,u.id uid,u.username")->select();

     //首次查询点赞数
    $m = M('praise');
    $k = M('keep');
    foreach($data as &$v){
      $id = $v['id'];
      $v['num']=$m ->where("cid={$id}")->count();
    }
    //首次查询收藏
    foreach($data as &$v){
        $id = $v['id'];
        $uid = session('user')['id'];
        $res = $k->where("cid = '{$id}' AND uid={$uid}")->find();
        if($res){
            $v['iskeep'] = 1;
        }else{
            $v['iskeep'] = 0;
        }
    }
    $this->assign('contents',$data);
    $this->display();
   }

}
?>
