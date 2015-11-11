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
 include "includes/connection.php";
?>
<?php
if( isset( $_GET['barcode'] ) ){
	
	$barcode = $_GET['barcode'];
	
	 $query = "SELECT * ";
	 $query .= "From stuffdb ";
	 $query .= "WHERE barcode = '$barcode' ";
	 
	 $result = mysqli_query( $db, $query );
	 
	 if(mysqli_num_rows( $result ) > 0 ){
		 while($results = mysqli_fetch_array( $result, MYSQL_ASSOC )){
			 
			 $staff_name = $results['stuff_name']; 
		 }
	 }else{
		 echo "Staff Not Selected .";
	 }
}	
?>	

<!DOCTYPE html>
<html>
 <head>
  <title>Delete Staff</title> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="css/reset.css" />
  <link rel="stylesheet" type="text/css" href="css/mainStyle.css"  media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/deleteStuff.css"  media="screen"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Paytone+One|Candal' rel='stylesheet' type='text/css'>
 </head>
<body>

  <div id="wrapper">
    <div id="innerBox" >
		<h1> Delete Staff </h1>
		<div id="deleteStaffDiv">
		  <h2>Would you like to Delete : </h2>
		  <span> <h3 name="stuff_name"><?php echo $staff_name;   ?></h3> </span>
		  
		  <span id="deleteStaffSpan"> </span>
		</div>
		
		<div class="stuffLinks">
			<a class="toLeftBut" id="deleteStaffYes" href="php/deleteStuff.php" />Yes</a>
			<a class="toLeftBut" id="deleteStaffNo" href="#"/>No</a>
		</div> <!-- stuffLinks -->
	</div>		
</div> <!-- wrapperUser -->
  
<script type="text/javascript" src="js/deleteStaff.js"></script>
</body> 
</html>
<?php 
 mysqli_close($db);
?>