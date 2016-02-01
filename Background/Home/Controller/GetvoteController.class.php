<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
require './ThinkPHP/Library/Vendor/autoload.php';
use Firebase\JWT\JWT;
class  GetvoteController extends Controller {
    public function index(){//获取文章列表
        //获取来自客户端的jwt
        $postjwt=$_POST;
        $key="access_token";

        //提取jwt中的json数据
        $decoded = JWT::decode($postjwt, $key, array('HS256'));
        $arr = json_decode($decoded);
        $username = $arr->username;//用户名为学号，也是数据库中的ID
        $vote = $arr->vote;//文章的id号
        
        //对提取的jwt数据进行进一次选取；
        $sql="select content from __PREFIX__view_options where id=".$vote;
        
       // $sql="select options from __PREFIX__vote where id=".$vote;
        
        
        //根据用户点击选取文章
        $Model=new Model();

        if($res= $Model->query($sql))
            $suc=1;
        else $suc=0;
        
  /*       $file_path=__DIRART__.$res[0]['body'];
        //  echo $file_path;
        //判断是否有这个文件
        if(file_exists($file_path)){
            if($fp=fopen($file_path,"a+")){
                //读取文件
                $opt=fread($fp,filesize($file_path));
            }else{
                echo "文件打不开";
            }
        }else{
            echo "没有这个文件";
        }
        fclose($fp); */
        
        $opt=json_encode($res);
        $token=array(
            
            
            'suc'=>$suc,
            'options'=>$opt,
        );
       
        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        $jwt = JWT::encode($token, $key);
        echo $jwt;

       /*  $decoded = JWT::decode($jwt, $key, array('HS256'));//json
        print_r($decoded); */

    }
}
?>

