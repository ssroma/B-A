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
   // connecting to the database and seleting the table .
   include "includes/connection.php";
?>
<?php

if(isset($_POST['entrances'])){
	
	$barcode = $_POST['barcode'];
	$staff_name = $_POST['stuff_name'];
	
	if($barcode === ""){
		$msg = "Barcode can not be empty! ";
		header("location: interface.php?msg={$msg}");	
		die();
	}else{
		
		$query = "SELECT * FROM logs WHERE client_tag = {$barcode}";
		$result = mysqli_query( $db, $query );
}

?>

<!DOCTYPE html>
<html lang="eng">
 <head>
  <title>Entrances</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="css/reset.css" />
  <link rel="stylesheet" type="text/css" href="css/mainStyle.css"  media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/entrances.css"  media="screen"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Paytone+One|Candal' rel='stylesheet' type='text/css'>
 </head>
<body>

<div id="wrapper">
  <h1> Latest <?php echo $staff_name; ?>'s Entrances</h1>
    <div class="tableWrapper" > 
		<table id="queriesResponse" >
			<tr>
				<!-- <th>Name</th> -->
				<th>Barcode</th>
				<th>Date</th>
				<th>Hours</th>
				<th>Status</th>
			</tr>
			
		<?php 
			if(mysqli_num_rows( $result ) > 0 ){
				while($results = mysqli_fetch_array( $result, MYSQL_ASSOC) ){
						
						$client_tag = $results['client_tag'];
						$dataTobeExploded = $results['data'];
						$hora = $results['hora'];
						$status = $results['status'];
						
						$dateExplod = explode("-", $dataTobeExploded );
						$data = $dateExplod[2] . " - " . $dateExplod[1] . " - " . $dateExplod[0]; 
						
							/* $query = "SELECT stuff_name FROM ";
							$query .= "stuffdb ";
							$query .= "WHERE barcode = '$client_tag' ";
							$result_name = mysqli_query( $db, $query );
							
								$results_name = mysqli_fetch_row( $result_name);	
								$client_name = $results_name[0]; */
							
						echo "<tr>";
							/* echo "<td> {$staff_name} </td>"; */
							echo "<td> {$client_tag} </td>";
							echo "<td> {$data} </td>";	
							echo "<td> {$hora} </td>";
							echo "<td> {$status} </td>";
								// echo " {$nome} - {$client_tag} -  {$data} - {$hora} - {$status}  <br /> ";
						echo "</tr>";	
					
					}
			}else{
						echo "Number of Results : " . mysqli_num_rows( $result );
					}
			}		
		?>	
			
			
		</table> 
	</div>  <!-- tableWrapper -->
	<div class="searchLinks">
		<a href="interface.php">Back to search</a>
		<button class="entrncasBotton" id="download">Download</button>
		<button class="entrncasBotton" id="printing">Print</button>

	</div>
	

</div> <!-- wrapper -->

<script src="js/js_library/jquery.table2excel.js" > </script>
<script src="js/printingButton.js"></script>
</body> 
</html>