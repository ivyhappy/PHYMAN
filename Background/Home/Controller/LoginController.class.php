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
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $psw=$arr->password;
        
        //从数据库中读取用户的password和权限
        $Model=new Model();
        $res=$Model->query("select psw,authority from __PREFIX__user where id=".$username);
        $authority=$res[0]['authority'];

       
        //返回数据：
        //1：登录是否成功（0=成功，1=密码错误；2=该账号未注册;3=已注册）
        //2：权限（0=游客；1=管理员；2=编辑；3=用户）
        
        
        if($res==null)
            $log=2;
        if($psw==$res[0]['psw'])
            $log=0;
        else
            $log=1;
        $token = array(
            "username" => $username,
            "log"=>$log,
            "authority"=>$authority
        );
        
        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
        */
        
        
        $token=json_encode($token);
        $jwt = JWT::encode($token, $key);
        
        echo $jwt;
        
        }
}
          
          
          
          
          
      