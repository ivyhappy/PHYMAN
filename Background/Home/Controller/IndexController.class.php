<?php
namespace Home\Controller;
//namespace Home\Controller\Article;
use Think\Controller;
use Think\Model;
use Firebase\JWT\JWT;
require './ThinkPHP/Library/Vendor/autoload.php';

class IndexController extends Controller {
    public function login(){
        //获取来自客户端的jwt
        //$json=json_decode($_POST);
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $username=$json->username;
        $psw=$json->password;
        
        
        //从数据库中读取用户的password和权限
        $Model=new Model();
        $res=$Model->query("select name,psw,authority from ".__PREFIX__."user where id=".$username);
        $authority=$res[0]['authority'];
        $name=$res[0]['name'];
        
        
        //返回数据：
        //1：log登录是否成功（0=成功，1=密码错误；2=该账号未注册;3=已注册）
        //2：权限（0=游客；1=管理员；2=编辑；3=用户）
        
        
        if($res==null)
            $log=2;
        if($psw==$res[0]['psw'])
            $log=0;
        else
            $log=1;
        
        /*    iss：Issuer，发行者
         sub：Subject，主题
         aud：Audience，观众
         exp：Expiration time，过期时间
         nbf：Not before
         iat：Issued at，发行时间
         jti：JWT ID */
        
        
        //生成发送给客户端的jwt验证信息
        $datetime=date("YmdHis",strtotime('now'));
        $exptime=date("YmdHis",strtotime("$datetime+1hours"));
        $token=array(
            "iss"=>"phyman",
            "aud"=>$username,
            "exp"=>$exptime,
            "iat"=>$datetime
        );
        $key="access_token";
        $jwt=JWT::encode($token, $key);
        
        //生成发送给客户端的json信息
        
        $jsonsend = array(
            "username" => $username,
            "log"=>$log,
            "authority"=>$authority,
            "access_token"=>$jwt
        );
        
        $jsonsend=json_encode($jsonsend);
        print_r($jsonsend);
      //  $this->display("./Background/Home/phyman-1/index.html");
        
    }
    public function register(){
         //获取客户端发送的json
        $json=json_decode($_POST);
        $key="access_token";
        $jwt=JWT::decode($json->jwt, $key, array('HS256'));
    
        $timenow=date("YmdHis",strtotime('now'));
        if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
            return  "";
        }
    
        $arr=$json;
        $id=$arr->username;//用户名为学号，也是数据库中的ID
        $name=$arr->name;
        $psw=$arr->password;
        $sex=$arr->sex;
        $authority=3;
        $img=$arr->img;
        $grade=$arr->grade;
        $mailbox=$arr->mailbox;
        
        //对密码进行加密处理
        
        
        //初始化模型
        $Model=new Model();
        
        //从数据库中读取想要注册的用户ID，若未注册，则向数据库中插入数据
        //若已经注册，则返回权限为authority=0为游客；登陆状态log=3为已注册；
        $res=$Model->query("select * from ".__PREFIX__."user where id=".username);
        if($res==null){
            $sql="insert into ".__PREFIX__."user(id,name,sex,psw,authority,img,grade,mailbox) values (
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
                "iat"=>$datetime
            );
            $key="access_token";
            $jwt=JWT::encode($token, $key);
            
            $jsonsend = array(
                "username" => $id,
                "log"=>$log,
                "authority"=>$authority,
                "access_token"=>$jwt
            );
        }
  
        $jsonsend=json_encode($jsonsend);
        //编码为jwt格式
                
        echo $jsonsend;
    }
    public function resetpassword(){
         //获取客户端发送的json
        $json=json_decode($_POST);
        $arr=$json;
        $id=$arr->username;//用户名为学号，也是数据库中的ID
        $mailbox=$arr->mailbox;
        //对密码进行加密处理
        //初始化模型
        $Model=new Model();
        
        //从数据库中读取想要注册的用户ID
        $res=$Model->query("select id,mailbox from ".__PREFIX__."user where id=".$id);
        
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
        $jsonsend= array(
            "username" => $id,
            "log"=>$log,
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
    
    
    
    public function index(){
      // echo __ROOT__;
        $this->display("./Background/Home/phyman-1/index.html");
        
        
    }
    public function test(){
        echo "111";
    }
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
}
?>