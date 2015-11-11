<?php 
	session_start();									  
?>
<?php
   // connecting to the database and seleting the table .
  include "../includes/connection.php";
?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$username = $_POST['username'];											  
    $password = $_POST['password']; 
	
		if($username == "" && $password == ""){	
			$msg = "Please Enter the Values !!!";
			header("location: ../index.php?msg={$msg}");
			die();	
		}else{
			 //performing database query and using the result .
			$query = " SELECT * FROM login ";
			$result = mysqli_query( $db, $query );
 
			if(mysqli_num_rows($result) > 0 ){
				while($results = mysqli_fetch_array( $result, MYSQL_ASSOC)){
		 
				$result_name = $results['username'];
				$result_password = $results['password'];
				
				// checa se usarname confere com a database 
				  // depois set session .
				  if( $result_name == $username  && $result_password == $password ){
						$_SESSION['username'] = $result_name;
						 header('location: ../interface.php');
						 die();
					}else{
						$msg = "UserName or Password Wrong !!! Please try again.";
						 header("location: ../index.php?msg={$msg}");  
					}
				}
			}else{
				echo "Number of Results : " . mysqli_num_rows($result);
			}	
			
			
		}
}
?>
								
<?php
// closing a connection.
 mysqli_close($db);
?>
													