<?php
namespace Home\Controller;

use Think\Controller;
use Firebase\JWT\JWT;

require './ThinkPHP/Library/Vendor/autoload.php';
require './ThinkPHP/Library/Vendor/Classes/PHPExcel.php';
require './ThinkPHP/Library/Vendor/Classes/UploadFile.php';
import(Vendor.Classes.Writer.Excel5.php);
import(Vendor.Classes.IOFactory.php);

class  GetarticlexlsController extends Controller {
    function  index(){
        $postjwt=$_POST;
        $key="access_token";
        
        //提取jwt中的json数据
        $decoded = JWT::decode($postjwt, $key, array('HS256'));
        $arr=json_decode($decoded);
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $art=$arr->article;
        $table=__PREFIX__."article_user".$art;
        $this::expUser($table); 
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
    function expUser($table){//导出Excel
        echo 'expUser';
        $xlsName  = "User";
        $xlsCell  = array(
            array('id','学号'),
            array('name','姓名'),
            array('grade','年级'),
            array('checken','状态'),
        );
        $xlsModel = M($table);
        $xlsData  = $xlsModel->Field('id,name,grade,check')->select();
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

