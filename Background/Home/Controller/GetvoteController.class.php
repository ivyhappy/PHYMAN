<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
require './ThinkPHP/Library/Vendor/autoload.php';
use Firebase\JWT\JWT;
use Think\Template\Driver\Mobile;
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
        
        $Model=new Model();
        //判断用户是否已进行过投票
        $sql="select choose from ".__PREFIX__."vote_user".$vote." where uid=".$username;
        $res=$Model->query($sql);
        if($res[0]['choose']){
            $optofhtml=$this::getvotebody($vote);//返回投票页面
        }else{
            $optofhtml=$this::getvoteres($vote);//返回投票结果
        }        
        
        
        if($optofhtml!=null)
            $suc=1;
        else $suc=0;
     
        $token=array(
            
            
            'suc'=>$suc,
            'options'=>$optofhtml,
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

       /*  $decoded = JWT::decode($jwt, $key, array('HS256'));//json
        print_r($decoded); */

    }
    public function getvotebody($vote){
        $Model=new Model();
        //  $sql="select options from __PREFIX__view where id=".$vote;
        $sql="select options from __PREFIX__vote where id=".$vote;
        
        //根据用户点击选取投票
        $optofhtml=$Model->query($sql);
        
        return $optofhtml;
       
        
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
    }
    public function getvoteres($voteid){
        $Model=new Model();
        $choose=0;
        //共有多少人投票
        $sql="select count(*) from  ".__PREFIX__."vote_user".$voteid." where choose=1";
        $res=$Model->query($sql);
    
        $resultofvote=Array(
            'sum'=>$res[0]['count(*)'],
            'options'=>Array(
            ),
        );
    
        //有这么多种选项
        $sql="select count(*) from __PREFIX__vote_options where vid=".$voteid;
        $res=$Model->query($sql);
        $count=$res[0]['count(*)'];
    
        $sql="select id,content from __PREFIX__vote_options where vid=".$voteid;
        $res=$Model->query($sql);
    
    
        //每种选项有多少人选择
        for($i=1;$i<=$count;$i++){
            $id=$res[$i]['id'];
            $content=$res[$i]['content'];
    
            $sql="select count(*) from __PREFIX__vote_user".$voteid." where options like \"%$id%\"";
            $temp=$Model->query($sql);
            $num=$temp[0]['count(*)'];
            $s=array(
                'opt'=>$id,
                'conten'=>$content,
                'num'=>$num
            );
            array_push($resultofvote['options'],$s);
    
        }
        $result=json_encode($resultofvote);
        return $result;
    }
    
}
?>

