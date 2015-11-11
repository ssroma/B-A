<?php
include "../includes/connection.php";

 /** Error reporting */
/* error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser'); */

/** Include PHPExcel */ 

require_once "../PHPExcel/Classes/PHPExcel/IOFactory.php";

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("ssroma")
							 ->setLastModifiedBy("roma")
							 ->setTitle("Office 2007 - 2010 XLSX")
							 ->setSubject("Office 2007 - 2010 XLSX")
							 ->setDescription("Generated using PHP classes.")
							 ->setKeywords("Office openxml php")
							 ->setCategory("Reposts");
// header 
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Name')
            ->setCellValue('B1', 'Barcode')
            ->setCellValue('C1', 'Date')
            ->setCellValue('D1', 'Hours')
            ->setCellValue('E1', 'Status');							 

 $num = 1;
 
	   $upTo = '2015-10-26'; // $_POST['listallFrom'];
		
	    $query = "SELECT * ";
	    $query .= "FROM logs ";
	    $query .= "WHERE data < '$upTo'";
		$result = mysqli_query( $db, $query );
			if(mysqli_num_rows( $result ) > 0 ){
				while($results = mysqli_fetch_array( $result, MYSQL_ASSOC)){
					$client_tag = $results['client_tag'];
					$dataToBeExploded = $results['data'];
					$hora = $results['hora'];
					$status = $results['status'];
					
					$dateExplode = explode("-", $dataToBeExploded );
					$data = $dateExplode[2] . " - " . $dateExplode[1] . " - " . $dateExplode[0];
					
					$query = "SELECT stuff_name FROM ";
					$query .= "stuffdb ";
					$query .= "WHERE barcode = '$client_tag' ";
					 $result_name = mysqli_query( $db, $query );
					
					
						  $results_name = mysqli_fetch_row( $result_name);	
							$client_name = $results_name[0];
					if($num !=  1){			
						$objPHPExcel->setActiveSheetIndex(0)
									->setCellValue( "A{$num}", $client_name )
						            ->setCellValue( "B{$num}", $client_tag )
									->setCellValue( "C{$num}", $data )
									->setCellValue( "D{$num}", $hora )
									->setCellValue( "E{$num}", $status );
						
					}	
					$num++;
				}
			}
 // set a name to de sheet		
$objPHPExcel->getActiveSheet()->setTitle('Reports');	

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

 // Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');
/*// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0 */
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

?>