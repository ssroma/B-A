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
if(isset($_GET['msg'])){
  $msg = $_GET['msg'];
} 
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Add User</title> 
  <link rel="stylesheet" type="text/css" href="css/reset.css" />
  <link rel="stylesheet" type="text/css" href="css/mainStyle.css"  media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/addStuff.css"  media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/addUser.css"  media="screen"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Paytone+One|Candal' rel='stylesheet' type='text/css'>
 </head>
<body>
<div id="wrapper">
    <div id="innerBox">
		<div id="headingAddUser">
			<h1> Add User </h1>
				<p>Hello <span class="spanUser"><?php if(isset($_SESSION['username'])){ 
										 echo "<strong> {$user}.</strong>";
									  }else{
											 echo "Dear.";
										   } ?>
							</span>
				</p>
		</div>
		<div class="adduser">
			<form id="addUserForm" action="" method="POST" enctype="multipart/form-data" >   	
				<p>Name : <input type="text" name="name_input" id="name_input" /> <br/> <span class="error" id="nameSpan"> </span> </p>
				<p>Password : <input type="password" name="pass01_input" id="pass01_input" /></p>
				<p>Repete Password : <input type="password" name="pass02_input" id="pass02_input" /> <br/> <span class="error" id="spanPass02"> </span></p>
				<p><div id="mensagem"></div></p>
				<p><input class="buttonAddUser" type="submit" name="submit" id="submit" value="Add User"/></p>
				<p><input class="buttonAddUser" type="button" name="submit" id="deleteBut" value="Delete User"/></p>
			</form>   
		</div> <!-- adduser -->
			
		<div class="stuffLinks">
			<a href="interface.php">Back to Search</a>
			
		</div> <!-- stuffLinks -->
	</div>
</div> <!-- wrapperUser -->

<script type="text/javascript" src="js/checkName.js"></script>
<script type="text/javascript" src="js/deleteUser.js"></script>
</body> 
</html>