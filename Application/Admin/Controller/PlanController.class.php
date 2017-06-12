<?php

/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/6/7
 * Time: 11:10
 */
namespace Admin\Controller;
use Think\Controller;
class PlanController extends CommonController{
    public function index(){
        $plan_arr = D('Plan')->get_PlanList();
        $this->assign('plan_list',$plan_arr);
        $this->display();
    }
}