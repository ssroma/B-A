<?php
                                   // grabbing the data and returnig to AJAX
include '../includes/connection.php';									   
								   
if(isset($_POST['name_input'], $_POST['pass01_input'], $_POST['pass02_input']) ){
	
	$name = trim( $_POST['name_input'] );
	$pass01 = trim( $_POST['pass01_input'] );
	$pass02 = trim(  $_POST['pass02_input'] );
	
	if( ( $name != "" && $name !== null ) && ( $pass01 != "" && $pass01 !== null ) && ( $pass02 != "" && $pass02 !== null ) ){
		
			$name = mysqli_real_escape_string( $db, $name );
			$pass01 = mysqli_real_escape_string( $db, $pass01 );
			$pass02 = mysqli_real_escape_string( $db, $pass02 );
			
			$query = "INSERT INTO login ( username, password, repPassword )" .
					 "VALUES ( '$name', '$pass01', '$pass02' )";
					 
			$result = mysqli_query($db, $query);
		
		if( $result ){
			echo $mensagem = "Recorde Created Successfully";
		}else{
			
			echo $mensagem = "Error: " . $query . "<br>" . mysqli_error($db);
		}
		
			
	}else{
		echo "can not be empty ";
	}	
}


mysqli_close($db);
?>