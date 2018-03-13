<?php
/* 
* @Author: Sunshie
* @Date:   2014-11-05 15:19:40
* @Last Modified by:   Sunshie
* @Last Modified time: 2014-11-13 23:14:16
*/
namespace Admin\Controller;
class IndexController extends PublicController{
    public function index(){
        $this->assign('os',php_uname('s'));
        $Model = M();
        $version = $Model->query("select version() as ver");
        $this->assign('mysql_ver',$version[0]['ver']);
        $this->display();
    }
    
}
?>
