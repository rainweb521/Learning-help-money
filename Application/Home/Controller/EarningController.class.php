<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/5/18
 * Time: 22:19
 */

namespace Home\Controller;
use Think\Controller;
class EarningController extends CommonController{
    public function index(){
        $this->get_session();
        $this->display();
    }
}