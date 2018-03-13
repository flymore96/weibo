<?php
/* 
* @Author: Sunshie
* @Date:   2014-11-05 11:52:53
* @Last Modified by:   Sunshie
* @Last Modified time: 2014-11-05 12:08:44
*/
namespace Home\Widget;
use Think\Controller;
class PublicWidget extends Controller{
    public function header(){
        $this->display('Public:header');
    }
}
?>
