<?php

include '../includes/connection.php';								   
								   
if( isset( $_POST['name'] ) ){ 
	 
		$name = trim( $_POST['name'] );
		$nameSize = strlen( $name ); 
		//echo $nameSize;
		
		if( $name == "" &&  $name == null ){
			echo "Field con\'t be Empty.";
		
		}else{
			if( $nameSize <= 3 ){
				echo "Name has to be bigger than 3.";
			}else{
				$query = "SELECT username FROM ";
				$query .= "login ";
				$query .= "WHERE username = '$name' ";
				
				$result = mysqli_query( $db, $query );
				
				if(mysqli_num_rows( $result ) > 0){
					while( $results = mysqli_fetch_row( $result )){
						echo $results[0] . " is already taken.";	
					}
				}else{
					echo "Ok.";
					
				}	
			}
		}

}else{
	echo "is not sete";
}


mysqli_close($db);

?>