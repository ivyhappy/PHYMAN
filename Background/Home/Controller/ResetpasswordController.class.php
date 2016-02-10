<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
require './ThinkPHP/Library/Vendor/autoload.php';
use Firebase\JWT\JWT;
//require_once './ThinkPHP/Library/Vendor/smtp.php';
import('Vendor.mail');

class ResetpasswordController extends Controller {
    
    public function index(){
        //获取来自客户端的jwt
        $postjwt=$_POST;
        $key="access_token";
        
        //提取jwt中的json数据
        $decoded = JWT::decode($postjwt, $key, array('HS256'));
        $arr=json_decode($decoded);
        $id=$arr->username;//用户名为学号，也是数据库中的ID
        $mailbox=$arr->mailbox;
                
        //对密码进行加密处理
        
        
        //初始化模型
        $Model=new Model();
        
        //从数据库中读取想要注册的用户ID，若未注册，则向数据库中插入数据
        //若已经注册，则返回权限为authority=0为游客；登陆状态log=3为已注册；
        $res=$Model->query("select id from ".__PREFIX__."user where id=".$id);
        
        
        if($res[0]['id']==null)
            $log="没有该用户";
            else if($res[0]['mailbox']==null)
                $log="没有用户邮箱信息，请用邮箱发邮件给管理员";
                else{ 
                    $log="已发送新密码到邮箱，请及时修改密码";
                    $psw=$this->createRandomStr(10);
                    $sql="update ".__PREFIX__."user set psw=".$psw." where id=".$id;
                    //发送邮件
                    $log=$this->sendmail($res[0]['mailbox'], $psw);
                }
            
        
        //返回数据：
        //1：登录是否成功（0=成功，1=密码错误；2=该账号未注册;3=已注册）
        //2：权限（0=游客；1=管理员；2=编辑；3=用户）
        
        $token = array(
            
            
            
            "username" => $id,
            "log"=>$log,
        );
        
        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
        */
        $token=json_encode($token);
        //编码为jwt格式
        $jwt = JWT::encode($token, $key);
        
        echo $jwt;
        
        }
        public function createRandomStr($length){
            $str = array_merge(range(0,9),range('a','z'),range('A','Z'));
            shuffle($str);
            $str = implode('',array_slice($str,0,$length));
            return $str;
        }
        
        public function sendmail($mailbox,$mail){
            
            //******************** 配置信息 ********************************
            $smtpserver = "smtp.163.com";//SMTP服务器
            $smtpserverport =25;//SMTP服务器端口
            $smtpusermail = "linxiaoyi_j@163.com";//SMTP服务器的用户邮箱
            $smtpemailto = $mailbox;//发送给谁
            $smtpuser = "linxiaoyi_j";//SMTP服务器的用户帐号
            $smtppass = "密码";//SMTP服务器的用户密码

            $mailtitle = "Change password";//邮件主题
            $mailconten="您的phyman账号密码已成功修改为".$mail."请及时修改密码";//邮件内容
            $mailtype = "TXT";//邮件格式（HTML/TXT）,TXT为文本邮件
            //************************ 配置信息 ****************************
            $smtp = new \smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
            $smtp->debug = false;//是否显示发送的调试信息
            $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailconten, $mailtype);
            
            if($state==""){
                $log="对不起，邮件发送失败！您还可以发送学号，姓名到管理员邮箱。";
                
            }else
                $log= "邮件发送成功，请查收，并尽快修改密码";
            
            return $log;
            
        } 
}