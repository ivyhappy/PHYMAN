<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
require './ThinkPHP/Library/Vendor/autoload.php';
use Firebase\JWT\JWT;
use Think\Template\Driver\Mobile;
class UservoteController extends Controller {
    public function index(){
        //获取来自客户端的jwt
        $postjwt=$_POST;
        $key="access_token";
        
        //提取jwt中的json数据
        $decoded = JWT::decode($postjwt, $key, array('HS256'));
        $arr=json_decode($decoded);
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $voteid=$arr->id;//投票ID号（为14位年月日时分秒）
        $choose=$arr->choose;

        $Model=new Model();
        $sql="update __PREFIX__uservote_user".$voteid."set choose=".$arr->choose."where uid=".$username;
        $Model->query($sql);
        
        $cho=explode(";",$choose);
        $count=count($cho)-1;
        for($i=0;$i<$count;$i++){
            $sql="select content from __PREFIX__vote_options where vid=".$voteid."and id=".$cho[$i];
            $res=$Model->query($sql);
            $contents=$contents.$res[0]['content'].";";
        }
        
        $sql="update  __PREFIX__vote_user".$voteid."set content=".$contents;
        $Model->query($sql);
     
        
        
       //投票结果
        $result=$this::getvoteres();
        
        $token = array(
            
            'result'=>$result,
        );
        
       // echo 'success';
        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
        */
        
        
        $token=json_encode($token);
        $jwt = JWT::encode($token, $key);
        echo $jwt;
        //向数据库中增加表
        $this::insertuser($id);
       /*  $decoded = JWT::decode($jwt, $key, array('HS256'));//json
        print_r($decoded); */
        
    }
    
    public function getvoteres($voteid){
        $Model=new Model();
        $choose=0;
        //共有多少人投票
        $sql="select count(*) from  __PREFIX__vote_user".$voteid." where choose!=".$choose;
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
        
            $sql="select count(*) from __PREFIX__vote_user".$voteid." where choose like \"%$id%\"";
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




