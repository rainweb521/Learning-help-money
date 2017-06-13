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
        $result = D('Login')->get_Info($_SESSION['u_id']);
        $this->assign('photo',$result['photo']);
        if ($result['username']==''){
            $result['username'] = '快设置个用户名吧';
        }
        $this->assign('username',$result['username']);
        $this->assign('mobile',$result['mobile']);
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
        $message_list = D('Message')->get_MessageList();
        $this->assign('message_list',$message_list);
        $this->display();
    }
    public function show(){
        $m_id = request('get','int','m_id',0);
        $message = D('Message')->get_Info($m_id);
        $this->assign('message',$message);
        $this->display();
    }
    public function advice(){
        $flag = request('post','int','flag',0);
        if($flag!=0){
            $content = request('post','str','content','');
            D('Advice')->add_Info($content,$_SESSION['u_id']);
            $this->assign('state','感谢您的反馈');
        }
        $this->display();
    }
    public function share(){

        $this->display();
    }
    public function win_record(){

        $this->display();
    }
    public function update_self(){
        $flag = request('post','int','flag',0);
        $result = D('Login')->get_Info($_SESSION['u_id']);
        if($flag!=0){
            $result['username'] = request('post','str','username',$result['username']);
            $result['mobile'] = request('post','str','mobile',$result['mobile']);
            $result['email'] = request('post','str','email',$result['email']);
            D('Login')->update_Info($result,$result['u_id']);
        }
        $this->assign('user',$result);
        $this->display();
    }
    public function upfile(){
        $flag = request('post','int','flag',0);
        $result = D('Login')->get_Info($_SESSION['u_id']);
        if($flag!=0){
            $file = upload_photo($_FILES['upfile']);
            if($file!='') $result['photo'] = $file;
            D('Login')->update_Info($result,$_SESSION['u_id']);
        }
        $this->assign('photo',$result['photo']);
        $this->display();
    }
}