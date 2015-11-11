<?php
 // using get that return from loginProcess . 
 if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
 }
 ?>
<!DOCTYPE html>
<html>
 <head>
  <title>Login</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="css/reset.css" />
  <link rel="stylesheet" type="text/css" href="css/mainStyle.css"  media="screen"/>
  <link href='https://fonts.googleapis.com/css?family=Paytone+One|Candal' rel='stylesheet' type='text/css'>
  
 </head>
<body>
<div id="wrapper" >
	
	<div id="innerBox" class="innerBox" >
		<h1> B/A </h1>
		  <form action="php/loginProcess.php" method="POST" id="indexForm" />
				
				<p class="allP" >User Name : <input type="text" name="username" value=""  /></p>
				<p class="allP" >Password &nbsp&nbsp : <input type="password" name="password" value=""  /></p>
				<p class="allP" ><input class="inputButton" type="submit" name="submit" value="Submit"  /></p>
		        
		  </form> 
		      <p><?php if(isset($msg)){ echo $msg; } ?></p>
	</div> <!-- innerBox -->
	
</div> <!-- wrapper -->

</body> 
</html>