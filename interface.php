<?php 
 session_start();

 if(!isset($_SESSION['username'])){
	 header('location: index.php');
   }else{
	   $user = $_SESSION['username'];
   }
?>
<?php
if(isset($_GET['msg'])){
  $msg = $_GET['msg'];
} 
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Bike Acess</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="css/mainStyle.css"  media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/interface.css"  media="screen"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Paytone+One|Candal' rel='stylesheet' type='text/css'>
 </head>
<body>
<div id="wrapper">
	<div id="innerBox" class="innerBox" >	
		<div id="headerInterface">
		
			<h1> Bike Access </h1>
				<p>Hello <span class="spanUser"><?php if(isset($_SESSION['username'])){ 
									 echo "<strong> {$user}.</strong>";
								  }else{
										 echo "Dear.";
									   } ?>
						</span> 
				</p>
		</div> <!-- headerInterface -->	
		<div class="searchForm">
			<form action="users.php" method="POST" >
				<p><input type="text" name="searchField" id="searchField" value="<?php if(isset($msg)){ echo $msg; } ?>" /></p>
				
				<p><input class="inputButton" type="submit" name="searchSubmit" value="Search" /></p>
			</form>
		</div> <!-- searchForm -->	
		<div class="searchLinks">
			<a href="addStuff.php">Add Staff</a> 
			<a href="addUser.php">Add User</a>
			<a href="reports.php">Reports</a>
			<a href="updateDataBase.php">Update Database</a>
			<a href="logout.php">logout</a> 
			
		</div>	
	</div>  <!-- innerBox -->
	  
</div> <!-- wrapperInterface -->	

<script src="js/interfaceInput.js"></script>		   
</body> 
</html>