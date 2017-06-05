<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/5/18
 * Time: 22:49
 */
namespace Home\Controller;
use Think\Controller;
class SettingController extends CommonController{
    public function index(){
        $this->get_session();
        $this->display();
    }
    public function set(){

        $this->display();
    }
    public function quit(){
        unset($_SESSION['u_id']);
        get_session();
//        start_session(0);
//        $url="index.php?c=login";
//        echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"5;url=$url\">";
    }
    public function notice(){

        $this->display();
    }
}