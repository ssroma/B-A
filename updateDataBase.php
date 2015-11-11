<?php 

// checar se tem session e permite somente que passo por login page.
 session_start();

 if(!isset($_SESSION['username'])){
	 header('location: index.php');
   }else{
	   $user = $_SESSION['username'];
   }
?>
<?php
     // connecting to data base . 
    include "includes/connection.php";
 ?>


<!DOCTYPE html>
<html>
<head>
	<title> Updating </title>
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
  <link rel="stylesheet" type="text/css" href="css/mainStyle.css"  media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/updateDataBase.css"  media="screen"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Paytone+One|Candal' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="wrapper" >
	<h1>  Import From spreadsheet  </h1>
	
<div id="innerBox">
<?php
if(isset( $_POST['importFile'] )){
	if(!empty( $_FILES["excelFile"]["tmp_name"] )){
		$file = $_FILES["excelFile"]["tmp_name"];
		$fileName = explode( ".", $_FILES["excelFile"]["name"]);
				
				
		if($fileName[1] == "xls"  || $fileName[1] == "xlsx"){

					require_once "PHPExcel/Classes/PHPExcel/IOFactory.php";
					$objPHPExcel = PHPExcel_IOFactory::load($file);
					
			    //  Get worksheet dimensions
					 $sheet = $objPHPExcel->getSheet(0);
					 $highestRow = $sheet->getHighestRow();
					 $highestColumn = $sheet->getHighestColumn();
			    // Loop through each row of the worksheet in turn
			for ($row = 1; $row <= $highestRow; $row++) {
						//  Read a row of data into an array
				if($row != 1){
							$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
							NULL, TRUE, FALSE);
						// getting each row .
							$barcode = $rowData[0][0];
							$dataHour = $rowData[0][1];
							//$status = $rowData[0][2];
						// separate data from hours . 
							$explode = explode(" ", $dataHour);
							$dataToChange = $explode[0];
							$hour = $explode[1];
						//	reorganize the data to yyy/mm/dd to be saved into the database.	
							$dataExploded = explode("/", $dataToChange);
							$data = $dataExploded[2] ."-". $dataExploded[1] ."-". $dataExploded[0];
						
				// exporting data from Database to generate de (status variable).					
							
				  $query = "SELECT * FROM logs ";
					$query .= "ORDER BY status ASC";
			
					$result = mysqli_query( $db, $query );
			
				    if(mysqli_num_rows( $result ) > 0 ){
					    while($results = mysqli_fetch_array( $result, MYSQL_ASSOC)){
						
						$clientTagDataBase = $results['client_tag'];
						$dateFromDataBase = $results['data'];
						$horaDataBase = $results['hora'];
						$statusDataBase = $results['status'];
			
					// creating variable to pass on test
						$dataBaseHora = strtotime($horaDataBase);
						$insertedHour = strtotime($hour);
						$tweelve12 = mktime ( 13, 00, 00 );
						$tweentyTwo22 = mktime ( 22, 50, 00 );
						
						//$status = null;
						
							
							if( $dateFromDataBase == $data && $statusDataBase == "in" && $insertedHour > $tweelve12 && $insertedHour < $tweentyTwo22 ){
								$status = "out";	
							}else if ( $dateFromDataBase != $data && $statusDataBase == "in" && $insertedHour < $tweelve12  ){
								$status = "in";	
							}else if ( $dateFromDataBase != $data && $statusDataBase == "in" && $insertedHour > $tweelve12 ){
								$status = "out";
							}else if ( $dateFromDataBase != $data && $statusDataBase == "out" && $insertedHour < $tweelve12  ){
								$status = "in"; 	
							}else if( $insertedHour > $tweentyTwo22 ){
								$status = "stayed overnight"; 
							}else if( $barcode == $clientTagDataBase && $statusDataBase == "stayed overnight" && $insertedHour < $tweelve12 ){
								$status = "in";
							}else if( $barcode == $clientTagDataBase && $statusDataBase == "stayed overnight" && $insertedHour > $tweelve12 ){
								$status = "out";
							}
	
						}					
					}else{
						//echo "Number of Results : " . mysqli_num_rows( $result );
						$status = null;
						 $insertedHour = strtotime($hour);
						  $tweelve12 = mktime ( 13, 00, 00 );
						if( $insertedHour > $tweelve12 && $insertedHour < $tweentyTwo22 ){
							$status = "out";	
						}else if ( $insertedHour < $tweelve12 ){
							$status = "in";	
						}else if( $insertedHour > $tweentyTwo22 ){
							$status = "stayed overnight";	
						}	
					}	
				
				     //  echo  $barcode . " &nbsp / &nbsp  " . $dataHour . "<br/>";
					 // echo  $barcode . " &nbsp / &nbsp  " . $data . " &nbsp / &nbsp  " .  $hour  . " &nbsp / &nbsp  " . $status . "<br />"; 				
							
						    $query = "INSERT INTO ";
							$query .= "logs ( client_tag, data, hora, status) ";
							$query .= "VALUES ('$barcode', '$data', '$hour', '$status' )";
							
							$result = mysqli_query($db, $query);
				}
			}
			
						$msg = $_FILES["excelFile"]["name"] . " Loading ... ";
					if($result){
						$msg = $_FILES["excelFile"]["name"] . " Sucessefully Add to Database. ";
					}else{
						$msg = " Error Trying to load ". $_FILES["excelFile"]["name"] ." <br/> Check the Database connection and Try again";
					} 
	
	        	
		}else{
			 $msg =  $_FILES["excelFile"]["name"] . " Is not an excel file.";
		}		
	}else{		
		 $msg =  "You must chosse a File . ";
	}		
}
?>
		
	<form id="importForm" action="" method="POST" enctype="multipart/form-data" />
	  <p><input type="file" name="excelFile" /> <br/>  
		  <span class="error"><?php if(isset($msg)){ echo $msg; } ?></span>	
	  </p>

		  
		  
	  <p><input class="toLeftBut" type="submit" name="importFile" value="Import File" /></p>
	</form>

	<div class="usersLinks">
	
		<a href="interface.php">Back to Search</a>
		
	</div> <!-- stuffLinks -->

	
	</div> <!-- innerBox -->
</div> <!-- wrapper -->

<?php mysqli_close($db);	 ?>
</body>
</html>