<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
require './ThinkPHP/Library/Vendor/autoload.php';
use Firebase\JWT\JWT;
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
        $res=$Model->query("select id from __PREFIX__user where id=".$id);
        
        
        if($res[0]['id']==null)
            $log="没有该用户";
            else if($res[0]['mailbox']==null)
                $log="没有用户邮箱信息，请用邮箱发邮件给管理员";
                else{ 
                    $log="已发送新密码到邮箱，请及时修改密码";
                    $psw=$this->createRandomStr(10);
                    $sql="update __PREFIX__user set psw=".$psw." where id=".$id;
                    //发送邮件
                    $this->sendmail($res[0]['mailbox'], $psw);
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
            
            $mailconten="您的phyman账号密码已成功修改为".$mail."请及时修改密码";
            
            
            
            
            
        } 
}