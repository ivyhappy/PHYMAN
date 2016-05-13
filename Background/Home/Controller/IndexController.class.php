<?php

namespace Home\Controller;

use Common\Controller\AjaxController;
use Think\Model;
use Firebase\JWT\JWT;
require './ThinkPHP/Library/Vendor/autoload.php';
require './ThinkPHP/Library/Vendor/mail.class.php';
class IndexController extends AjaxController {
    /* public function resetpassword(){
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $username=$json->username;
        $psw=$json->new_password;
        $Model=new Model();
        $sql="update ".__PREFIX__."user set psw=".$psw." where id=".$username;
        $res=$Model->query($sql);
        
    } */
    public function login(){
        //获取来自客户端的jwt
        //$json=json_decode($_POST);
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $username=$json->username;
        $psw=$json->password;
        
        /* $username="201522040999";
        $psw="1234567899"; */
        
        //从数据库中读取用户的password和权限
        $Model=new Model();
        $res=$Model->query("select name,psw,authority,grade from ".__PREFIX__."user where id=".$username);
        $authority=$res[0]['authority'];
        $name=$res[0]['name'];
        $grade=$res[0]['grade'];
        //返回数据：
        //1：log登录是否成功（0=成功，1=密码错误；2=该账号未注册）
        //2：权限（0=游客；1=管理员；2=编辑；3=用户）
        
        if($res[0]==null)
            $log=2;
        else if($psw==$res[0]['psw'])
            $log=0;
        else
            $log=1;
        
        
        //生成发送给客户端的jwt验证信息
        $datetime=date("YmdHis",strtotime('now'));
        $exptime=date("YmdHis",strtotime("$datetime+1hours"));
        $token=array(
            "iss"=>"phyman",
            "id"=>$username,
            "exp"=>$exptime,
            "iat"=>$datetime,
            "name" => $name,
            "uid" => $username,
            "viewlevel"=>"1",
            "permission"=>$authority
        );
        $key="accss_token";
        $token=json_encode($token);
        $jwt=JWT::encode($token, $key);
        
        //生成发送给客户端的json信息
        
        $jsonsend = array(
            "username" =>$username,
            "permission"=>$authority,
            "jwt"=>$jwt,
            'log'=>$log
        );
        
        $jsonsend=json_encode($jsonsend);
        
        echo $jsonsend;
        
        /* $jwt=JWT::decode($jwt,$key,HS256);
        
        print_r($jwt); */
    }
    public function register(){
         //获取客户端发送的json
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $key="access_token";
    
        $timenow=date("YmdHis",strtotime('now'));
        $arr=$json;
        $name=$arr->name;
        $psw=$arr->password;
        $sex=$arr->sex;
        $authority="学生";
        $grade=$arr->grade;
        
        //对密码进行加密处理
        $Model=new Model();
        $hasid=true;
        while($hasid){
           for($i=0;$i<12;$i++){
                if($i==0)
                    $b[]=rand(3,9);
                else
                    $b[]=rand(0,9);
                
            }
            $id=join("",$b);
            $sql="select * from ".__PREFIX__."user where id=".$id;
            $res=$Model->query($sql);
            if($res==null)
                $hasid=false;
        }
        //从数据库中读取想要注册的用户ID，若未注册，则向数据库中插入数据
        if($res==null){
            $sql="insert into ".__PREFIX__."user(id,name,sex,psw,authority,img,grade,mailbox) values (
            $id,'$name','$sex','$psw',$authority,$grade,'$mailbox'";
            $Model->query($sql);
            $log=0;
        }
        else{
            $log=3;
            $authority=0;
        }
        
        //返回数据：
        //1：登录是否成功（0=成功，1=密码错误；2=该账号未注册;3=已注册）
        //2：权限（0=游客；1=管理员；2=编辑；3=用户）
        if($log==3){
            $jsonsend = array(
                "username" => $id,
                "log"=>$log,
                "authority"=>$authority
            );
        }else{
            //生成发送给客户端的jwt验证信息
            $datetime=date("YmdHis",strtotime('now'));
            $exptime=date("YmdHis",strtotime("$datetime+1hours"));
            $token=array(
                "iss"=>"phyman",
                "aud"=>$id,
                "exp"=>$exptime,
                "iat"=>$datetime,
                "name" => $name,
                "uid" => $id,
                "viewlevel"=>$grade,
                "permission"=>$authority
            );
            $key="access_token";
            $jwt=JWT::encode($token, $key);
            
            $jsonsend = array(
               "name" => $name,
                "uid" => $id,
                "viewlevel"=>$grade,
                "permission"=>$authority,
                "jwt"=>$jwt
            );
        }
  
        $jsonsend=json_encode($jsonsend);
        //编码为jwt格式
                
        echo $jsonsend;
    }
    
    public function reset_password(){
        //获取客户端发送的json
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $id=$json->username;
        $psw=$json->new_password;
        
        $Model=new Model();
        $sql="update ".__PREFIX__."user set psw=".$psw." where id=".$id.";";
        $Model->query($sql);
           
       
        $jsonsend = array(
             "name" => $jwt->name,
            "uid" => $id,
        );
        $jsonsend=json_encode($jsonsend);
        echo $jsonsend;
    
    }
    
    
    
    public function forget_password(){
         //获取客户端发送的json
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);

        $arr=$json;
        $id=201522040840;$arr->username;//用户名为学号，也是数据库中的ID
        
        //对密码进行加密处理
        //初始化模型
        $Model=new Model();
        
        //从数据库中读取想要注册的用户ID
        $res=$Model->query("select id,mailbox from ".__PREFIX__."user where id=".$id);
        
        if($res[0]['id']==null)
            $log="没有该用户";
        else if($res[0]['mailbox']==null)
            $log="没有用户邮箱信息，请联系管理员";
        else{
            $log="重置密码成功";
            $psw=$this->createRandomStr(10);
            $sql="update ".__PREFIX__."user set psw='$psw' where id=".$id;
            //发送邮件
            $Model->query($sql);
            
            $log=$this->sendmail($res[0]['mailbox'], $psw);
        }
        
        $jsonsend= array(
            'log'=>$log,
        );
       
        $jsonsend=json_encode($jsonsend);
        echo $jsonsend;
        
        }
        public function createRandomStr($length){
            $str = array_merge(range(0,9),range('a','z'),range('A','Z'));
            shuffle($str);
            $str = implode('',array_slice($str,0,$length));
            return $str;
        }
        
        public function sendmail($mailbox,$mail){//
            //******************** 配置信息 ********************************
            $smtpserver = "smtp.163.com";//SMTP服务器
            $smtpserverport =25;//SMTP服务器端口
            $smtpusermail = "phymansisadmin@163.com";//SMTP服务器的用户邮箱
            $smtpemailto = $mailbox;//发送给谁
            $smtpuser = "phymansisadmin";//SMTP服务器的用户帐号
            $smtppass = "phymansis2016";//SMTP服务器的用户密码
        
            $mailtitle = "Change password";//邮件主题
            $mailconten="您的phyman账号密码已成功修改为".$mail."请及时修改密码";//邮件内容
            $mailtype = "TXT";//邮件格式（HTML/TXT）,TXT为文本邮件
            //************************ 配置信息 ****************************
            $smtp = new \smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
            $smtp->debug = false;//是否显示发送的调试信息
            $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailconten, $mailtype);
            
            if($state==""){
                $log="对不起，邮件发送失败！请联系管理员。";
        
            }else
                $log= "新的密码已发送到预留邮箱中，请查收，并尽快修改密码";
        
            return $log;
        
        }
        public function index(){
            // echo __ROOT__;
            $this->display("./Background/Home/phyman-1/index.html");
           // $this->display();
        
        
        }
}
?>