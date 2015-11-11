<?php

include "../includes/connection.php";

if( isset( $_POST['stuff_name'] ) ){
	
	$name = $_POST['stuff_name'];
	
	$query = "DELETE FROM ";
	$query .= "stuffdb ";
	$query .= "WHERE stuff_name = '$name'";
	
	$result = mysqli_query( $db, $query);
	
	if( $result ){
		echo " Staff Removed Successfully . ";
	}else{
		echo " An error occur " . mysqli_error( $db );
	}
}


mysqli_close( $db );
?>