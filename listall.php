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
	
		$query = "SELECT * FROM logs";
		$result = mysqli_query( $db, $query );
?>

<DOCTYPE html>
<html lang="eng">
 <head>
  <title>Entrances</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href='css/entrances.css' rel='stylesheet' type='text/css'>
 </head>
<body>

<div id="wrapper">
  <h1> Latest Entrances </h1>
    <div class="tableWrapper" > 
		<table >
			<tr>
				<th>Name</th>
				<th>Barcode</th>
				<th>Date</th>
				<th>Hours</th>
				<th>Status</th>
			</tr>
		<?php 
			if(mysqli_num_rows( $result ) > 0 ){
				while($results = mysqli_fetch_array( $result, MYSQL_ASSOC)){
					$client_tag = $results['client_tag'];
					$data = $results['data'];
					$hora = $results['hora'];
					$status = $results['status'];
					
					$query = "SELECT stuff_name FROM ";
					$query .= "stuffdb ";
					$query .= "WHERE barcode = '$client_tag' ";
					 $result_name = mysqli_query( $db, $query );
					
					
					//if(mysqli_num_rows( $result_name ) > 0 ){
						//while($results_name = mysqli_fetch_row( $result_name)){
						  $results_name = mysqli_fetch_row( $result_name);	
							$client_name = $results_name[0];
								
								echo "<tr>";
									echo "<td> {$client_name} </td>";
									echo "<td> {$client_tag} </td>";
									echo "<td> {$data} </td>";	
									echo "<td> {$hora} </td>";
									echo "<td> {$status} </td>";
								echo "</tr>";
								
						//}
				//	}	
				}
			}else{
						echo "Number of Results : " . mysqli_num_rows( $result );
					}
					
		?>	
			

		</table> 
	</div>  <!-- tableWrapper -->
	<div class="searchLinks">
		<a href="interface.php">Back to search</a>
		<a href="">Print</a>

	</div>
	

</div> <!-- wrapper -->
<?php mysqli_close($db); ?>
</body> 
</html>