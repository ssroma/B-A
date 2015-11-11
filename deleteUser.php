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
<!DOCTYPE html>
<html>
 <head>
  <title>Delete User</title> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="css/reset.css" />
  <link rel="stylesheet" type="text/css" href="css/mainStyle.css"  media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/addStuff.css"  media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/deleteUser.css"  media="screen"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Paytone+One|Candal' rel='stylesheet' type='text/css'>
 </head>
<body>

  <div id="wrapper">
	<div id="innnerBox">
		<h1> Delete User </h1>
		<?php
		 $query = "SELECT username FROM ";
		 $query .= "login ";
		 
		 $result = mysqli_query( $db, $query );
		echo "<form  id='radioForm'>";
		 if( mysqli_num_rows( $result ) > 0 ){
			 while($results = mysqli_fetch_array( $result, MYSQL_ASSOC)){
				
				echo "<p><input class='deleteUserRadios' type='radio' name='radioInput' value='". $results['username'] ."' />";
				echo   $results['username'] . "</p><br/>" ;
			 }
		 }
			
		echo "</form>";
		?>	
		<div id="deleteUserDiv"> </div>
		<div class="stuffLinks">
			
			<input class="toLeftBut" type="button" id="deleteUser" value="Delete User" />
			<input class="toLeftBut" type="button" id="deleteUserButton" value="Close" />
			   <div class="clear"> </div>
		</div> <!-- stuffLinks -->
	</div>
</div> <!-- wrapperUser -->
  
<script type="text/javascript" src="js/closeUser.js"></script>
</body> 
</html>
<?php 
 mysqli_close($db);
?>