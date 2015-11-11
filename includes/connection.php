<?php

include 'define_variable.php';

$db = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );
  
  if(!$db){
	  die("Connection Failed " . mysqli_connect_error() );
	  
  }else{
	 // echo "Connected Sucessfully to " . DB_DATABASE ;
  }

?>