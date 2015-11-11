<?php
include "../includes/connection.php";

// including PHPExcel 
require_once "../PHPExcel/Classes/PHPExcel/IOFactory.php";

$excel = new PHPExcel();

// Set document properties
$excel->getProperties()->setCreator("ssroma")
							 ->setLastModifiedBy("roma")
							 ->setTitle("Office 2007 - 2010 XLSX")
							 ->setSubject("Office 2007 - 2010 XLSX")
							 ->setDescription("Generated using PHP classes.")
							 ->setKeywords("Office openxml php")
							 ->setCategory("Reposts");
// header 
$excel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Name')
            ->setCellValue('B1', 'Barcode')
            ->setCellValue('C1', 'Date')
            ->setCellValue('D1', 'Hours')
            ->setCellValue('E1', 'Status');	
 $num = 1;
 
	   $upTo = $_POST['listallFrom'];
		
	    $query = "SELECT * ";
	    $query .= "FROM logs ";
	    $query .= "WHERE data < '$upTo' ";
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
						$excel->setActiveSheetIndex(0)
									->setCellValue( "A{$num}", $client_name )
						            ->setCellValue( "B{$num}", $client_tag )
									->setCellValue( "C{$num}", $data )
									->setCellValue( "D{$num}", $hora )
									->setCellValue( "E{$num}", $status );
						
					}	
					$num++;
				}
			}


 // Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
?>