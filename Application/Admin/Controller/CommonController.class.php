<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/5/16
 * Time: 20:38
 */
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function get_session(){
        if(!$_SESSION['u_id']){
            $this->redirect('/index.php?c=login');
            exit();
        }
    }
}