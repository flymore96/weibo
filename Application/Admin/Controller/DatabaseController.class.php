<?php
/* 
* @Author: Sunshie
* @Date:   2014-11-21 14:11:17
* @Last Modified by:   Sunshie
* @Last Modified time: 2014-11-24 02:05:17
*/
namespace Admin\Controller;
class DatabaseController extends PublicController{
   

    public function dump(){
        $tables = $this->tables();
        $filename = date('YmdHis',time());
        $this->assign('filename',$filename);
        $this->assign('data',$tables);
        $this->display();
    }

    public function dumpsave(){
        $time = date('Y-m-d H:i:s',time());
        $banner =   "############################################\n".
                    "#        Dump time:{$time}     #\n".
                    "#                <?php exit() ?>           #\n".
                    "############################################\n";
        if(preg_match("/(\.)(exe|jsp|asp|aspx|cgi|fcgi|pl)(\.|$)/i", $_POST['filename'])){
                $this->error("备份文件名错误");
        }           
        if($_POST['type'] == '1'){
            $file = $banner.$this->dumpall();
            $filename = $_POST['filename'].".sql";
            file_put_contents("./Public/backup/".$filename,$file);
            if(file_exists("./Public/backup/".$filename)){
                $this->success("备份成功!");
            }else{
                $this->error("备份失败");
            }
        }
        if($_POST['type'] == 2){
            foreach($_POST['table'] as $k =>$table){
                $sql .= $this->sqllist($table)."\r\n";
                $sql .= $this->sqlword($table)."\r\n";
            }
            $file = $banner.$sql;
            $filename = $_POST['filename'].".sql";
            file_put_contents("./Public/backup/".$filename,$file);
            if(file_exists("./Public/backup/".$filename)){
                $this->success("备份成功!");
            }else{
                $this->error("备份失败");
            }
        }
    }
    //备份全部
    private function dumpall(){
        $tables = $this->tables();
        foreach($tables as $k =>$table){
            $sql .= $this->sqllist($table)."\r\n";
            $sql .= $this->sqlword($table)."\r\n";
        }
        return $sql;
    }



    //show tables 返回一维数组
    private function tables(){
        $model = M();
        $res = $model->query("show tables");
        foreach($res as $v){
            $tables[] = $v['Tables_in_blog'];
        }
        return $tables;
    }

    //获取创建表的语句
    private function sqllist($table){
        $model = M();
        $res = $model->query("show create table {$table}");
        foreach($res as $v){
            $sqllist = $v['Create Table'];
        }
        $drop = "DROP TABLE IF EXISTS `{$table}`;\r\n";
        return $drop.$sqllist.";\r\n";
    }

    //获取表内所有数据
    private function sqlword($table){
        $model = M();
        $res = $model->query("SELECT * FROM {$table}");
        for($i=0;isset($res[$i]);$i++){
            $arr = array_values($res[$i]);
            $crr = array_keys($res[$i]);
            foreach ($arr as &$v){
                $v = "'".$v."'";
            }
            foreach ($crr as &$v){
                $v = "`".$v."`";
            }
            $key = rtrim(join(",",$crr),",");
            $value = rtrim(join(",",$arr),",");
            $sql .= "INSERT INTO `{$table}`($key)VALUES($value);\r\n";
        }
        return $sql;
        
    }

    //数据库还原页面
    public function import(){
        $exp = array();
        $dir = dir("./Public/backup/");
        while($file = $dir->read()){
            $filename = './Public/backup/'.$file;
            if(is_file($filename)){
                $exp[] = $file;
            }
        }
        $dir->close();
        $this->assign('filename',$exp);
        $this->display();
    }

    //数据库导入
    public function importsql(){
        $filename = base64_decode($_GET['file']);
        $file ='./Public/backup/'.$filename;
        $word = file_get_contents($file);
        $word = preg_replace("/#.*#/is","",$word);
        $arr = explode(";\r\n", $word);
        $model = M();
        foreach($arr as $v){
            $model->query($v);
        }
        $this->success("数据库导入完成");

    }

    //删除文件
    public function delsql(){
        $filename = base64_decode($_GET['file']);
        $file ='./Public/backup/'.$filename;
        unlink($file);
        if (!file_exists($file)){
            $this->success('删除文件成功');
        }else{
            $this->error('删除文件失败');
        }

    }

    //下载文件
    public function downsql(){
        $filename = base64_decode($_GET['file']);
        $file ='./Public/backup/'.$filename;
        if (file_exists($file)){
            $filetype = trim(substr(strrchr($filename, '.'), 1));
            $filesize = filesize($file);
            header('Cache-control: max-age=31536000');
            header('Expires: '.gmdate('D, d M Y H:i:s', time() + 31536000).' GMT');
            header('Content-Encoding: none');
            header('Content-Length: '.$filesize);
            header('Content-Disposition: attachment; filename='.$filename);
            header('Content-Type: '.$filetype);
            readfile($file);
        } else {
            $this->error('该文件不存在！');
        }
    }
}
?>
