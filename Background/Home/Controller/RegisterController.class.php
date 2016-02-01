<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
require './ThinkPHP/Library/Vendor/autoload.php';
use Firebase\JWT\JWT;
class LoginController extends Controller {
    
    public function index(){
        //获取来自客户端的jwt
        $postjwt=$_POST;
        $key="access_token";
        
        //提取jwt中的json数据
        $decoded = JWT::decode($postjwt, $key, array('HS256'));
        $arr=json_decode($decoded);
        $id=$arr->username;//用户名为学号，也是数据库中的ID
        $name=$arr->name;
        $psw=$arr->password;
        $sex=$arr->sex;
        $authority=$arr->authority;
        $img=$arr->img;
        $grade=$arr->grade;
        $mailbox=$arr->mailbox;
                
        //对密码进行加密处理
        
        
        //初始化模型
        $Model=new Model();
        
        //从数据库中读取想要注册的用户ID，若未注册，则向数据库中插入数据
        //若已经注册，则返回权限为authority=0为游客；登陆状态log=3为已注册；
        $res=$Model->query("select * from __PREFIX__user where id=".username);
        if($res==null){
            $sql="insert into __PREFIX__user(id,name,sex,psw,authority,img,grade,mailbox) values (
                $id,'$name','$sex','$psw',$authority,'$img',$grade,'$mailbox'";
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
        
        $token = array(
            "username" => $id,
            "log"=>$log,
            "authority"=>$authority
        );
        
        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
        */
        
        //编码为jwt格式
        $jwt = JWT::encode($token, $key);
        
        echo $jwt;
        
        }
}