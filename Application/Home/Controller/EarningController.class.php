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
        $u_id = $_SESSION['u_id'];
        $result = D('Login')->get_Info($u_id);
        $this->assign('result',$result);
        $this->display();
    }
    public function record(){
        $tip = request('get','int','tip',0);
        if($tip==0){
            $this->assign('header','收益记录');
        }else{
            $this->assign('header','交易记录');
        }
        $this->display();
    }

}