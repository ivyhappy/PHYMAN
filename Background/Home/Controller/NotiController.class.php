<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
use Firebase\JWT\JWT;

require './ThinkPHP/Library/Vendor/autoload.php';
require './ThinkPHP/Library/Vendor/Classes/PHPExcel.php';


import(Vendor.Classes.Writer.Excel5.php);
import(Vendor.Classes.IOFactory.php);

class NotiController extends Controller {
    
    
    public function getList(){
    
        //获取客户端发送的json
      /*   $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $key="access_token";
        $jwt=$json->jwt;
        if($json->jwt==null){
            $log="无access_token";
        }else{
            $jwt=JWT::decode($jwt,$key,array('HS256'));
            $timenow=date("YmdHis",strtotime('now'));
            if(!($timenow<$jwt->exp&&$timenow>$jwt->iat)){
                $log="超时或名称不对称";
            }
        }
         */
        $sqlplus="order by date desc";
        
        $sql="select id,title,date from ".__PREFIX__."article ".$sqlplus;
        $Model=new Model();
        $res= $Model->query($sql);
        $resjson=json_encode($res);
  
       /*  $jsonsend=array(
            "username" => $json->username,
            "list"=>$resjson,
            "log"=>$log,
            "jwt"=>$json->jwt
        ); */
         
        
        $json=json_encode($resjson);
        //echo $json;
        echo $json;
    }
   
    public function deleteOne(){
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $key="access_token";
        $jwt=$json->jwt;
        if($json->jwt==null){
            $log="无jwt";
        }else{
            $jwt=JWT::decode($jwt,$key,array('HS256'));
            $timenow=date("YmdHis",strtotime('now'));
            if(!($timenow<$jwt->exp&&$timenow>$jwt->iat)){
                $log="超时或名称不对称";
            }
        }
        $id=$json->id;
        $Model= new Model();
        $sql= "delete from ".__PREFIX__."article where id =".$id.";";
        $Model->query($sql);
        echo $sql;
        $sql= "drop table ".__PREFIX__."article_user".$id.";";
        $Model->query($sql);
    
        echo $sql;
    
        $jsonsend=array(
            "status"=>"ok"
        );
        $jsonsend=json_encode($jsonsend);
        echo $jsonsend;
    }
    
    //获取文章内容
    public function getNotiDetail(){
        //获取客户端发送的json
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $key="access_token";
        $jwt=$json->jwt;
        if($json->jwt==null){
            $log="无access_token";
        }else{
            $jwt=JWT::decode($jwt,$key,array('HS256'));
            $timenow=date("YmdHis",strtotime('now'));
            if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
                $log="超时或名称不对称";
            }
        }
        
        /* 
        $json=json_decode($_POST);
        $key="access_token";
        $jwt=JWT::decode($json->access_token, $key, array('HS256'));
        
        $timenow=date("YmdHis",strtotime('now'));
        if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
            return  "";
        } 
        $arr=$json;
        $username = $arr->username;//用户名为学号，也是数据库中的ID
        $art = $arr->noti;//文章的id号
        *
        */
        $arr=$json;
        $username = $arr->username;//用户名为学号，也是数据库中的ID
        $art = $arr->id;//文章的id号
        if($art==null){
            $res=array(
                "id"=>"",
                "body"=>"",
                "date"=>""
            );
            $article=json_encode($res);
            $jsonsend=array(
                'username'=>$username,
                'log'=>"未读取到文章id",
                'detail'=>$article
            );
        }else{
            //对提取的jwt数据进行进一次选取；
        
            $sql="select id,title,body,date,grade from ".__PREFIX__."article where id=".$art;
        
            //根据用户点击选取文章
            $Model=new Model();
            $res= $Model->query($sql);
            $article=json_encode($res);
           
        
            if($article!=null)
                $log=1;
            else $log=0;
        
            $jsonsend=array(
                'username'=>$username,
                'log'=>$log,
                'detail'=>$article
            );
        }
        $json=json_encode($jsonsend);
       // $this->assign($json);
      //  $this->display("./Background/Home/phyman-1/index.html");
        echo $json;
        
        $this::articlecheck($username,$art);
    
    }
    public function articlecheck($userid,$articleid){
        $Model=new Model();
        $check=1;
        $sql="update ".__PREFIX__."article_user".$articleid." set checken=".$check." where id=".$userid;
        $Model->query($sql);
    
    }
    
    
    public function checkeduser(){
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $key="access_token";
        
        $articleid=$json->id;
        
        if($json->jwt==null){
            $log="无access_token";
        }else{
            $jwt=JWT::decode($jwt,$key,array('HS256'));
            $timenow=date("YmdHis",strtotime('now'));
            if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
                $log="超时或名称不对称";}
        }

        $Model=new Model();
        $sql="select id,name,grade,class from ".__PREFIX__."article_user".$articleid;
        $res=$Model->query($sql);
        $list=$res[0];
        
        
        
    }
    public function  getExcel(){
        $json=json_decode($_POST);
        $key="access_token";
    
        $arr=$json;
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $art=$arr->article;//文章id号
        $table=__PREFIX__."article_user".$art;
        $this::expUser($table);
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
    
    
        //array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
    
    
        //  $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
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
    function expUser(){//导出Excel
        echo 'expUser';
        $art=1;
        $table=__PREFIX__."article_user".$art;
        $xlsName  = "User";
        $xlsCell  = array(
            array('id','学号'),
            array('name','姓名'),
            array('grade','年级'),
            array('checken','状态'),
        );
        
        $Model= new Model();
        $sql="select id,name,grade,checken from ".$table;
        $xlsData=$Model->query($sql);
        
        //$xlsData  = $xlsModel->Field('id,name,sex,grade')->select();
        /*  print_r($xlsData);
         echo "<br>"; */
        foreach ($xlsData as $k => $v)
        {
            $xlsData[$k]['checken']=$v['checken']==1?'已查看':'未查看';
        }
        $this->exportExcel($xlsName,$xlsCell,$xlsData);
         
    }
    
}
?>
