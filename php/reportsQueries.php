<?php

include "../includes/connection.php";

if( isset( $_POST['listallFrom'] ) ){
	
		$upTo = $_POST['listallFrom'];
		
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
								
								echo "<tr>";
									echo "<td> {$client_name} </td>";
									echo "<td> {$client_tag} </td>";
									echo "<td> {$data} </td>";	
									echo "<td> {$hora} </td>";
									echo "<td> {$status} </td>";
								echo "</tr>";
						
				}
			}else{
				echo "<tr>";
					echo "<td> Number of Results :  </td>" ; 
					echo "<td>" . mysqli_num_rows( $result ) . " </td>" ;
				echo "</tr>";
			}

}else if(isset( $_POST['listXtoXFrom'], $_POST['listXtoXTo']) ){  
	
	$startDate = $_POST['listXtoXFrom'];
	$endDate =  $_POST['listXtoXTo'];
	
	
	$query = "SELECT * ";
	$query .= "FROM logs ";
	$query .= "WHERE data BETWEEN '$startDate' ";
	$query .= "AND '$endDate'";
	
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
								
								echo "<tr>";
									echo "<td> {$client_name} </td>";
									echo "<td> {$client_tag} </td>";
									echo "<td> {$data} </td>";	
									echo "<td> {$hora} </td>";
									echo "<td> {$status} </td>";
								echo "</tr>";
						
				}
			}else{
				echo "<tr>";
					echo "<td> Number of Results :  </td>" ; 
					echo "<td>" . mysqli_num_rows( $result ) . " </td>" ;
				echo "</tr>";
			}
	

}else if( isset( $_POST['listXtoXoverNightFrom'] ) ){
	
	$startDate = $_POST['listXtoXoverNightFrom'];
	
	$styed = "stayed overnight";
	
	$query = "SELECT * ";
	$query .= "FROM logs ";
	$query .= "WHERE data >= '$startDate' ";
	$query .= "AND status = '$styed'";
	
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
								
								echo "<tr>";
									echo "<td> {$client_name} </td>";
									echo "<td> {$client_tag} </td>";
									echo "<td> {$data} </td>";	
									echo "<td> {$hora} </td>";
									echo "<td> {$status} </td>";
								echo "</tr>";
						
				}
			}else{
				echo "<tr>";
					echo "<td> Number of Results :  </td>" ; 
					echo "<td>" . mysqli_num_rows( $result ) . " </td>" ;
				echo "</tr>";
			}
	

	
}else if( isset( $_POST['listXtoXallOverNightFrom'], $_POST['listXtoXallOverNightTo'] ) ){
	
	$startDate = $_POST['listXtoXallOverNightFrom'];
	$endDate =  $_POST['listXtoXallOverNightTo'];
	$styed = "stayed overnight";
	
	$query = "SELECT * ";
	$query .= "FROM logs ";
	$query .= "WHERE data BETWEEN '$startDate' ";
	$query .= "AND '$endDate'" ;
	$query .= "AND status = '$styed'";
	
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
								
								echo "<tr>";
									echo "<td> {$client_name} </td>";
									echo "<td> {$client_tag} </td>";
									echo "<td> {$data} </td>";	
									echo "<td> {$hora} </td>";
									echo "<td> {$status} </td>";
								echo "</tr>";
						
				}
			}else{
				echo "<tr>";
					echo "<td> Number of Results :  </td>" ; 
					echo "<td>" . mysqli_num_rows( $result ) . " </td>" ;
				echo "</tr>";
			}
	
}else{
	
	echo "Name feito";
}



mysqli_close( $db );
?>