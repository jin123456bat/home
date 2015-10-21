<?php
namespace application\classes;

class excel
{
	/**
	 *   导出数据为excel表格
	 *   @param $data    一个二维数组,结构如同从数据库查出来的数组
	 *   @param $title   excel的第一行标题,一个数组,如果为空则没有标题
	 *   @param $filename 下载的文件名
	 *   @example
	 *		exportexcel($arr,array('id','账户','密码','昵称'),'文件名');
	 */
	function xls($data=array(),$title=array(),$filename='report')
	{
		header("Content-type:application/octet-stream");
		header("Accept-Ranges:bytes");
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=".$filename.".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		//导出xls 开始
		if (!empty($title)){
			foreach ($title as $k => $v) {
				$title[$k]=iconv("UTF-8", "GB2312",$v);
			}
			$title= implode("\t", $title);
			echo "$title\n";
		}
		if (!empty($data)){
			foreach($data as $key=>$val){
				foreach ($val as $ck => $cv) {
					$data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
				}
				$data[$key]=implode("\t", $data[$key]);
			}
			echo implode("\n",$data);
		}
	}
	
	function orderexcel($data,$title)
	{
		$phpexcel_root = ROOT.'/extends/PHPExcel';
		include_once $phpexcel_root.'/PHPExcel.php';
		$objPHPExcel = new \PHPExcel();
		foreach ($title as $index => $string)
		{
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index).'1',$string);
		}
		
		foreach ($data as $line => $value)
		{
			$objPHPExcel->getActiveSheet()->getRowDimension($line+4)->setRowHeight(-3);
			
			$objPHPExcel->getActiveSheet()->getStyle('D'.($line+4))->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
			$objPHPExcel->getActiveSheet()->getStyle('Q'.($line+4))->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
			$objPHPExcel->getActiveSheet()->getStyle('R'.($line+4))->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($line+4))->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_TEXT);
			
			//$objPHPExcel->getActiveSheet()->getRowDimension($line+4)->setHeight(200);
			
			$index = 0;
			
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['orderno']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['paytype']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['paynumber']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['ordertotalamount']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['ordertaxamount']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['ordergoodsamount']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['feeamount']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['tradetime']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['totalamount']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['consigneetel']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['consignee']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['zipcode']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['consigneeprovince']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['consigneecity']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['consigneecounty']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['consigneeaddress']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['postmode']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['username']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['sku']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['productname']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['unitprice']);
			$objPHPExcel->getActiveSheet()->setCellValue(chr(ord('A')+$index++).($line+4),$value['num']);
		
			if(!empty($value['img']))
			{
				$objDrawing = new \PHPExcel_Worksheet_Drawing();
				$objDrawing->setName($value['productname']);
				$objDrawing->setPath($value['img'][0]['thumbnail_path']);
				$objDrawing->setCoordinates(chr(ord('A')+$index++).($line+4));
				$objDrawing->setResizeProportional(true);
				$objDrawing->setWidthAndHeight(100,100);
				$objDrawing->setOffsetX(100);
			
				$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
			
			}
		
		}
		
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$filename = time('Y-m-d H:i:s').'.xls';
		$objWriter->save($filename);
		return $filename;
	}
	
	function phpexcel($data)
	{
		$phpexcel_root = ROOT.'/extends/PHPExcel';
		$template = $phpexcel_root.'/template.xls';
		include_once $phpexcel_root.'/PHPExcel/IOFactory.php';
		
		$objPHPExcel = \PHPExcel_IOFactory::load($template);
		foreach ($data as $line => $value)
		{
			$objPHPExcel->getActiveSheet()->getRowDimension($line+4)->setRowHeight(-3);
			
			$objPHPExcel->getActiveSheet()->getStyle('D'.($line+4))->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
			$objPHPExcel->getActiveSheet()->getStyle('Q'.($line+4))->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
			$objPHPExcel->getActiveSheet()->getStyle('R'.($line+4))->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($line+4))->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_TEXT);
				
			$objPHPExcel->getActiveSheet()->setCellValue('A'.($line+4),$value['orderno']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.($line+4),$value['paytype']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.($line+4),$value['paynumber']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.($line+4),$value['ordertotalamount']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.($line+4),$value['tradetime']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.($line+4),$value['consigneetel']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.($line+4),$value['consignee']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.($line+4),$value['zipcode']);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.($line+4),$value['consigneeprovince']);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.($line+4),$value['consigneecity']);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.($line+4),$value['consigneecounty']);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.($line+4),$value['consigneeaddress']);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.($line+4),$value['postmode']);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.($line+4),$value['username']);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.($line+4),$value['sku']);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.($line+4),$value['productname']);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.($line+4),$value['unitprice']);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.($line+4),$value['num']);
		}
		
		
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$filename = time('Y-m-d H:i:s').'.xls';
		$objWriter->save($filename);
		return $filename;
	}
}