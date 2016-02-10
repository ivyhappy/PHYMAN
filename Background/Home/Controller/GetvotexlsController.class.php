<?php
namespace Home\Controller;

use Think\Controller;
use Firebase\JWT\JWT;
use Think\Model;

require './ThinkPHP/Library/Vendor/autoload.php';
require './ThinkPHP/Library/Vendor/Classes/PHPExcel.php';

import(Vendor.Classes.Writer.Excel5.php);
import(Vendor.Classes.IOFactory.php);

class  GetvotexlsController extends Controller {
    function  index(){
        $postjwt=$_POST;
        $key="access_token";
        
        //提取jwt中的json数据
        $decoded = JWT::decode($postjwt, $key, array('HS256'));
        $arr=json_decode($decoded);
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $vote=$arr->vote;
        
        $table=__PREFIX__."vote_user".$vote;
        $this::expUser($table,$vote); 
        //$this->display();
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
        $xlsModel = M($table);
        $xlsData  = $xlsModel->Field('id,name,choose,option')->select();
        //$xlsData  = $xlsModel->Field('id,name,sex,grade')->select();
       /*  print_r($xlsData);
        echo "<br>"; */
        foreach ($xlsData as $k => $v)
        {
            
            $options=explode(";",$v['option']);
            $count=count($options)-1;
            for($i=0;$i<$count;$i++){
                $sql="select content from ".__PREFIX__."vote_options where vid=".$voteid."and id=".$options[$i];
                $res=$Model->query($sql);
                $op=$op.$res[0]['content'].";";
            }
            
            $xlsData[$k]['option']=$op;
        }
        $this->exportExcel($xlsName,$xlsCell,$xlsData);
         
    }
    
}
?>

