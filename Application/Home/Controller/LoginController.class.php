<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/5/16
 * Time: 20:38
 */
namespace Home\Controller;
use Think\Controller;
class LoginController extends CommonController {
    public function index(){
//        echo "4324";
        $this->display();
    }
    public function login(){
        $flag = request('post','int','flag',0);
        if($flag==0){
            $this->display();
        }else{
            $username = request('post','char','username');
            $password = request('post','char','password');
            $result = D('Login')->getAdminByUsername($username);
            if(!$result){
                $this->assign('state','用户名不存在');
                $this->display();
            }else if($result['password']!=$password){
                $this->assign('state','密码错误');
                $this->display();
            }else{
                session('u_id',$result['u_id']);
                start_session(6000);
                $this->redirect('/index.php?c=index');
            }
//            var_dump($result);
//            exit();
//            if($username=='root'){
//                session('u_id','1');
//                start_session(6000);
//                $this->redirect('/index.php?c=index');
//            }

        }
        exit();
    }
    public function register(){
        $flag = request('post','int','flag',0);
        if($flag==0){
            $this->display();
        }else{
            $username = request('post','char','mobile','');
            $email = request('post','char','email','');
            $password = request('post','char','password','');
            $c_password = request('post','char','c_password','');
            if($password!=$c_password){
                $this->assign('state','两次密码不一致');
                $this->display();
            }
            $insert_arr['username'] = $username;
            $insert_arr['email'] = $email;
            $insert_arr['password'] = $password;
            D('Login')->set_Info($insert_arr);
            $this->assign('state','注册成功请登录');
            $this->redirect('/index.php?c=login&a=login');
            exit();
        }
    }
    public function logout() {
        session('u_id', null);
        $this->redirect('/index.php?c=login');
        exit();
//        $this->get_session();
    }
}