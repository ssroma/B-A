<?php

include "../includes/connection.php";

if( isset($_POST['name']) ){
	
	$name = $_POST['name'];

	$query = "DELETE FROM ";
	$query .= "login ";
	$query .= "WHERE username = '$name'";
	
	if(mysqli_query( $db, $query )){
		echo $name . " Deleted from Database. ";
	}else{
		echo " Recorde not deleted. ";
	}

}

mysqli_close( $db );
?>