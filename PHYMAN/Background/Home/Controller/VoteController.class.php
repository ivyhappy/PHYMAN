<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
require './ThinkPHP/Library/Vendor/autoload.php';
use Firebase\JWT\JWT;
class VoteController extends Controller {
    
    public function getList(){//获取文章列表
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $key="access_token";
        $jwt=$json->access_token;
        if($json->access_token==null){
            $log="无access_token";
        }else{
            $jwt=JWT::decode($jwt,$key,array('HS256'));
            $timenow=date("YmdHis",strtotime('now'));
            if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
                $log="超时或名称不对称";
            }
        }/* 
        
        
        
        
          //获取客户端发送的json
        $json=json_decode($_POST);
        $key="access_token";
        $jwt=JWT::decode($json->jwt, $key, array('HS256'));
        $timenow=date("YmdHis",strtotime('now'));
        if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
            return  "";
        }
        $arr=$json;
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $page=$arr->page;//显示列表的第几页（为14位年月日时分秒）
        $pagesize=$arr->pagesize;//显示列表时每一页显示几条
        $title=$arr->title;//按照文章标题选取文章；
        $uid=$arr->writer;//按照作者选取文章；
        $time=date("Y-m-d H:i:s",strtotime($arr->time));
        
        $tid=$arr->tid;//按照文章的类型选取文章；
        $grade=$arr->grade;//按照查看该文章的年级选取文章 */
        
        
       // $start=($page-1)*$pagesize;
        $sqlplus="order by begtime desc";// LIMIT $start,$pagesize";
        //对提取的jwt数据进行进一次选取；
        /* $sqloftitle="select * from ".__PREFIX__."view_vote where title like \"%$title%\" ".$sqlplus;
        $sqlofdate="select * from ".__PREFIX__."view_vote where endtime > $time and begtime <$time".$sqlplus;//注意此处需要将时间设置Y-m-d        
        $sqlofuid="select * from  ".__PREFIX__."view_vote where name=\"$uid\"".$sqlplus;//此处的uid都是中文的utf-8(编辑和管理员的名字互相都不能一样)
        $sqloftid="select * from  ".__PREFIX__."view_vote where type=\"$tid\"".$sqlplus;//此处的tid都是中文的utf-8(种类的名字互相也都不能一样)
        $sqlofgrade="select * from ".__PREFIX__."view_vote where grade like \"$grade\"".$sqlplus;//此处的grade都是中文的utf-8(种类的名字互相也都不能一样)
         */
        $sql="select id,title,begtime from ".__PREFIX__."vote ".$sqlplus;
        //phyman_view_vote 是vote的视图，包含voteid，标题title，begtime,endtime,创建者名字，属于哪个种类（中文）信息
        
        //根据用户设置的条件筛选文章
        $Model=new Model();
        $res= $Model->query($sql);
        /* if($title!=null)
            $res= $Model->query($sqloftitle);
        else if($time!=null){
            $res=$Model->query($sqlofdate);
        }else if($uid!=null){
            $res= $Model->query($sqlofuid);
        }else if($tid!=null){
            $res= $Model->query($sqloftid);
        }else if($grade!=null){
            $res= $Model->query($sqlofgrade);
        }else{
            $res= $Model->query($sql);
        } */
        
        $resjson=json_encode($res);
        
        $jsonsend=array(
            'username'=>$arr->username,
            'list'=>$resjson,
            'access_token'=>$arr->access_token
        );
        $jsonsend=json_encode($jsonsend);
        echo $jsonsend;

    }
    public function getVoteResult(){
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $key="access_token";
        $jwt=$json->access_token;
        if($json->access_token==null){
            $log="无access_token";
        }else{
            $jwt=JWT::decode($jwt,$key,array('HS256'));
            $timenow=date("YmdHis",strtotime('now'));
            if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
                $log="超时或名称不对称";
            }
        }
        
        $arr=$json;
        $username = $arr->username;//用户名为学号，也是数据库中的ID
        $vote = $arr->id;//文章的id号
        
            $Model=new Model();
            //判断用户是否已进行过投票
            $optofhtml=$this::getvoteres($vote);//返回投票结果
        
            $sql="select title from ".__PREFIX__."vote where id=".$vote;
            $res=$Model->query($sql);
            $title=$res[0]['title'];
        
        
            $jsonsend=array(
                'username'=>$username,
                'title'=>$title,
                'result'=>$optofhtml,
                'jwt'=>$arr->jwt
            );
       
        $jsonsend=json_encode($jsonsend);
        echo $jsonsend;
    }
    public function getVoteDetail(){
        
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $key="access_token";
        $jwt=$json->access_token;
        if($json->access_token==null){
            $log="无access_token";
        }else{
            $jwt=JWT::decode($jwt,$key,array('HS256'));
            $timenow=date("YmdHis",strtotime('now'));
            if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
                $log="超时或名称不对称";
            }
        }
        
       //获取客户端发送的json
       /*  $json=json_decode($_POST);
        $key="access_token";
        $jwt=JWT::decode($json->jwt, $key, array('HS256'));
        
        $timenow=date("YmdHis",strtotime('now'));
        if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
            return  "";
        } */
        
        $arr=$json;
        $username = $arr->username;//用户名为学号，也是数据库中的ID
        $vote = $arr->id;//文章的id号
        
        
        if($vote==null){
            $res=array(
                "id"=>"",
                "options"=>"",
                "date"=>""
            );
            $options=json_encode($res);
            $jsonsend=array(
                'username'=>$username,
                'log'=>"未读取到文章id",
                'options'=>$options
            );
        }else{
            $Model=new Model();
            //判断用户是否已进行过投票
            $sql="select choose from ".__PREFIX__."vote_user".$vote." where uid=".$username;
            $res=$Model->query($sql);
            if($res[0]['choose']){
                $optofhtml=$this::getvoteres($vote);//返回投票结果
            }else{
                $optofhtml=$this::getvotebody($vote);//返回投票页面
            }
            
            if($optofhtml!=null){
                $suc=1;
            }
            else{
                $suc=0;
            }
            $sql="select title from ".__PREFIX__."vote where id=".$vote;
            $res=$Model->query($sql);
            $title=$res[0]['title']; 
            
            
            $jsonsend=array(
                'username'=>$username,
                'suc'=>$suc,
                'title'=>$title,
                'choose'=>$res[0]['choose'],
                'options'=>$optofhtml,
                'jwt'=>$arr->jwt
            );
        }
        $jsonsend=json_encode($jsonsend);
        echo $jsonsend;
        
    }
    public function userVote(){
    $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $key="access_token";
        $jwt=$json->access_token;
        if($json->access_token==null){
            $log="无access_token";
        }else{
            $jwt=JWT::decode($jwt,$key,array('HS256'));
            $timenow=date("YmdHis",strtotime('now'));
            if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
                $log="超时或名称不对称";
            }
        }
        $choose=$json->choose;
        $count=count($choose);
        $option='';
        for($i=0;$i<$count;$i++){
            $option=$option.$choose[$i]->id.";";
        }
        
       /*  //获取客户端发送的json
        $json=json_decode($_POST);
        $key="access_token";
        $jwt=JWT::decode($json->jwt, $key, array('HS256'));
        
        $timenow=date("YmdHis",strtotime('now'));
        if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
            return  "";
        }
         */
        $arr=$json;
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $voteid=$arr->id;//投票ID号（为14位年月日时分秒）
 //       $option=$arr->option;//那几个选项按照;划分
    
        $Model=new Model();
        $sql="update ".__PREFIX__."vote_user".$voteid." set option= ".$option." where id=".$username;
        $Model->query($sql);
    
        $sql="update  ".__PREFIX__."vote_user".$voteid." set choose=1 where id= ".$username;;
        $Model->query($sql);
         
        //投票结果
        $result=$this::getvoteres($voteid);
        if($result!=null){
            $suc=1;
        }else{
            $suc=0;
        }
        $jsonsend=array(
            'username'=>$username,
            'suc'=>$suc,
            'option'=>$option,
            'result'=>$result,
            'jwt'=>$arr->jwt
        );
        $jsonsend=json_encode($jsonsend);
        echo $jsonsend;
    }
    
    //获取投票具体页面
    public function getvotebody($vote){
        $Model=new Model();
        //  $sql="select options from __PREFIX__view where id=".$vote;
        //$sql="select options from __PREFIX__vote where id=".$vote;
    $sql="select id,content from ".__PREFIX__."vote_options where vid=".$vote;
        //根据用户点击选取投票
        $res=$Model->query($sql);
        //$optofhtml=$res[0]['options'];
        $optofhtml=json_encode($res);
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
         fclose($fp); 
         echo $opt;*/
    }
    
    //获取投票结果
    public function getvoteres($voteid){
       // $voteid=1;
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
        $sql="select count(*) from ".__PREFIX__."vote_options where vid=".$voteid;
        $res=$Model->query($sql);
        $count=$res[0]['count(*)'];
        
        $sql="select id,content from ".__PREFIX__."vote_options where vid=".$voteid;
        $res=$Model->query($sql);
        
        
        //每种选项有多少人选择
        for($i=0;$i<$count;$i++){
            $id=$res[$i]['id'];
            $content=$res[$i]['content'];
        
            $sql="select count(*) from ".__PREFIX__."vote_user".$voteid." where option like \"%$id%\"";
            $temp=$Model->query($sql);
            $num=$temp[0]['count(*)'];
            $s=array(
                'opt'=>$id,
                'content'=>$content,
                'num'=>$num
            );
            array_push($resultofvote['options'],$s);
        
        }
        $result=json_encode($resultofvote);
        return $result;
    }
    public function getExcel(){
        $json=json_decode($_POST);
        $key="access_token";
        
        $arr=$json;
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $vote=$arr->vote;
        $table=__PREFIX__."vote_user".$vote;
        $this::expUser($table,$vote); 
    }
    public function exportExcel($expTitle,$expCellName,$expTableData){
        echo 'exportExcel';
        //  $xlsTitle = iconv('utf-8', 'utf-8', $expTitle);//文件名称
        $fileName = date('YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
    
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E');
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'1', $expCellName[$i][1]);
        }
        // Miscellaneous glyphs, UTF-8
        for($i=0;$i<$dataNum;$i++){
            for($j=0;$j<$cellNum;$j++){
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+2), $expTableData[$i][$expCellName[$j][0]]);
            }
        }
        //die;
        ob_end_clean();
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name=1234565.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
    /**
     *
     * 导出Excel
     */
    function expUser($table,$voteid){//导出Excel
    
         $xlsName  = "vote";
        $Model= new Model();
        $sql="select id,content from ".__PREFIX__."vote_options where vid=".$voteid;
        
        $xlsCell  = array(
            array('id','学号'),
            array('name','姓名'),
            array('grade','年级'),
            array('choose','状态'),
            array('option','选项'),
        );
      
        $Model= new Model();
        $sql="select id,name,grade,choose,option from ".$table;
        $xlsData=$Model->query($sql);
        foreach ($xlsData as $k => $v)
        {
            $xlsData[$k]['choose']=$v['choose']==1?'已投票':'未投票';
            $op="";
            $options=explode(";",$v['option']);
            $count=count($options)-1;
            for($i=0;$i<$count;$i++){
                $sql="select content from ".__PREFIX__."vote_options where vid=".$voteid." and id=".$options[$i];
                $res=$Model->query($sql);
                $op=$op.$options[$i].":".$res[0]['content'].";";
                
            }
            $xlsData[$k]['option']=$op;
        }
       $this->exportExcel($xlsName,$xlsCell,$xlsData);
         
    }    
}
?>