<?php

/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/6/7
 * Time: 11:10
 */
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController{
    public function index(){

        $user_list = D('Login')->get_UserList();
        $this->assign('user_list',$user_list);
        $this->display();
    }
    public function show(){
        $tip = request('get','int','tip',0);
        $u_id = request('get','int','u_id',0);
        if(($tip!=0)&&($u_id!=0)){
            //tip等于1应该是点击编辑，等于2应该是提交修改
            if ($tip==2){

            }
            $user = D('Login')->get_Info($u_id);
            $this->assign('user',$user);
        }
        $this->display();
    }
}