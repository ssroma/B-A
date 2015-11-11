<?php 

// checar se tem session e permite somente que passo por login page.
 session_start();

 if(!isset($_SESSION['username'])){
	 header('location: login.php');
   }else{
	   $user = $_SESSION['username'];
   }
?>
<?php
   // connecting to the database and seleting the table .
  include "includes/connection.php"
?>
<?php

$default = "images/default.jpg";

?>
<?php
if(isset($_POST['searchSubmit'])){
	
	$search = $_POST['searchField'];
	
		if($search == ""){	
		   $msg = "Empty Field . ";
		   header("location: interface.php?msg={$msg}" );
			die();
		}else{
				if( is_numeric($search) ){
					
					$query = "SELECT * FROM stuffdb WHERE barcode = {$search}";
				}else{
					
					$query = "SELECT * FROM stuffdb WHERE stuff_name = '$search' ";
				}
				
				$result = mysqli_query( $db, $query );
				if(mysqli_num_rows( $result ) > 0 ){
					while($results = mysqli_fetch_array( $result, MYSQL_ASSOC)){
						
						$barcode = $results['barcode'];
						$stuff_name = $results['stuff_name'];
						$bikepass = $results['pass_number'];
						$company = $results['company'];
						$phone = $results['phone'];
						$email = $results['email'];
						$image = $results['image'];
					}
					
				}else{
						$msg = "Number of Results : " . mysqli_num_rows( $result );
						header("location: interface.php?msg={$msg}" );
					}
			}	
}	
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Users</title> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="css/reset.css" />
  <link rel="stylesheet" type="text/css" href="css/mainStyle.css"  media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/users.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Paytone+One|Candal' rel='stylesheet' type='text/css'>
 </head>
<body>
<div id="wrapper">
	<div id="innerBox">
		<div id="headerUser">
		<h1> Users Details </h1>
			<p>Hello <span class="spanUser"><?php if(isset($_SESSION['username'])){ 
									 echo "<strong> {$user}.</strong>";
								  }else{
										 echo "Dear.";
									   } ?>
						</span>
			</p>
		</div>	
		<div class="usersForm">
			<div class="usersFormImage"><img src="data:image/jpeg;base64,<?php echo base64_encode( $image ); ?>" width="170" height="200" /></div> <!-- image e alt serao atualisadas por php -->	
				<form id="formUsers" action="entrances.php" method="POST" enctype="multipart/form-data" >
				
					<p>Name : <input class="unableField" type="text" name="stuff_name" value="<?php if(isset($stuff_name)){ echo $stuff_name; } ?>"/></p>
					<p>Bar Code : <input class="unableField" type="text" name="barcode" value="<?php if(isset($barcode)){ echo $barcode; } ?>"/><?php if( isset($msn) ){ echo $msn; } ?></p>
					<p>Bike Pass : <input type="text" name="passNumber" value="<?php if(isset($bikepass)){ echo $bikepass; } ?>" /> </p>
					<p class="toLeft">Company : <input class="unableField" type="text" name="company" value="<?php if(isset($company)){ echo $company;} ?>"/></p>
					<p class="toLeft">Phone : <input class="unableField" type="tel" name="phone" value="<?php if(isset($phone)){ echo $phone; } ?>"/></p>
					<p class="toLeft">Email : <input class="unableField" type="email" name="email" value="<?php if(isset($email)){ echo $email; } ?>"/></p>
					<p><input class="toLeftBut" type="submit" name="entrances" value="Entrances"  /></p>
					
				</form> 
		</div> <!-- usersForm -->
			
		<div class="usersLinks">
			<a href="interface.php">Back to Search</a>
			<a id="" href="updateStaff.php?barcode=<?php echo urlencode( $barcode) ;?>">Update Staff Details</a>
			<a id="deleteStaffLink" href="deleteStaff.php">Delete Staff</a>
			
		</div> <!-- usersForm -->
	</div>
</div> <!-- wrapperUsers -->

<script type="text/javascript" src="js/usersUnableFields.js"></script> 
<script type="text/javascript" src="js/deleteStaff.js"></script> 
</body> 
</html>

<?php 
	mysqli_close($db);
 ?>