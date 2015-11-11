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
 
     // connecting to data base . 
	include "includes/connection.php";
 ?>
    
<?php	
  if(isset($_POST['stuffSubmit'])){
	  // fields para serem inserido no server. 
	  //passado por POST e house keeping com mysql_real_escape_string .
	$barcode = mysqli_real_escape_string( $db, trim( $_POST['barcode'] ) );
	$bikepass = mysqli_real_escape_string( $db, trim( $_POST['passNumber'] ) );
	$stuff_name = mysqli_real_escape_string( $db, trim( $_POST['stuff_name'] ) );	
	$company = mysqli_real_escape_string( $db, trim( $_POST['company'] ) );	
	$phone = mysqli_real_escape_string( $db, trim( $_POST['phone'] ) );	
	$email = mysqli_real_escape_string( $db, trim( $_POST['email'] ) );  
	 
	 // image details para ser inserida no server.
	 $image_tmp_name = $_FILES['fileUpload']['tmp_name'];
	 if($image_tmp_name === ""){
		$image_tmp_name = "images/default.jpg"; 
	//	$image_size = getimagesize($_FILES['fileUpload'] [$image_tmp_name] );  // if I want to check on picture.
	    $image = addslashes(file_get_contents($image_tmp_name));
	    $image_name = addslashes($_FILES['fileUpload']['name']);
	 }else{
		//$image_size = getimagesize($_FILES['fileUpload'] [$image_tmp_name] );  // if I want to check on picture.
	    $image = addslashes(file_get_contents($image_tmp_name));
	    $image_name = addslashes($_FILES['fileUpload']['name']); 	 
	 }
    
	//$image_size = getimagesize($_FILES['fileUpload'][$image_name]);  // if I want to check on picture.
	//   $image_width = $image_size[0];
    //   $image_height = $image_size[1];
	//if( $image_width > 172 && $image_height > 200 ){
	//	$picture = " Picture has to be less than 170 X 190. ";
	//	header("location: addStuff.php?picture={$picture}");
	//	die();	
	//}
	if( $stuff_name == "" && $stuff_name == null ){
		$staff_name = " Name can't be empty. ";
		  header("location: addStuff.php?staff_name={$staff_name}");
		  die();
		
	}
	
	if( $barcode == "" && $barcode == null ){
		$code = " Barcode can't be empty. ";
		header("location: addStuff.php?code={$code}");
		die();
	}else{
		
		$query = "SELECT barcode FROM ";
		$query .= "stuffdb ";
	    $result = mysqli_query( $db, $query );
		
		if(mysqli_num_rows( $result ) > 0 ){
			while($results = mysqli_fetch_array( $result, MYSQL_ASSOC )){
				if( $results['barcode'] == $barcode ){
					$code = "This Barcode already exist. ";
					  header("location: addStuff.php?code={$code}");
				}
			} 
		}	
	
	}
	
	if( $company == "" && $company == null ){
		$compania = " Company can't be empty. ";
		  header("location: addStuff.php?compania={$compania}");
	}else{	
	// insere no database se nao estiverem vazios 	
		$query = "INSERT INTO stuffdb ( barcode, pass_number, stuff_name, company, phone, email, image )" .
		         "VALUES ( '$barcode', '$bikepass', '$stuff_name', '$company', '$phone', '$email', '$image' )";
		$result = mysqli_query($db, $query);
	  
	  if( $result ){
	// caso os campos estiverem vazios envia esta menssagem	  
			$mensagem = "Recorde Created Successfully";
			
			$page = $_SERVER['PHP_SELF'];
             $sec = "02";
              header("Refresh: $sec; url=$page");
		}else{
			
			$mensagem = "Error: " . $query . "<br>" . mysqli_error($db);
		}
	}
  }
	
 
 ?>
 
<?php
if(isset($_GET['picture'])){
	$picture = $_GET['picture'];
}else if(isset($_GET['code'])){
  $code = $_GET['code'];
}else if(isset($_GET['staff_name'])){
  $staff_name = $_GET['staff_name'];	
}else if(isset($_GET['compania'])){
  $compania = $_GET['compania'];	
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Add Staff</title>
  <link rel="stylesheet" type="text/css" href="css/reset.css" />
  <link rel="stylesheet" type="text/css" href="css/mainStyle.css"  media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/addStuff.css"  media="screen"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Paytone+One|Candal' rel='stylesheet' type='text/css'>
 </head>
<body>
<div id="wrapper">
	<div id="innerBox">
		<div id="headingAddStuff">
			<h1> Add Staff </h1>
				<p>Hello <span class="spanUser"><?php if(isset($_SESSION['username'])){ 
										 echo "<strong> {$user}.</strong>";
									  }else{
											 echo "Dear.";
										   } ?>
							</span>
				</p>
		</div>	
		<div class="stuffForm">
			<form action="addStuff.php" method="POST" enctype="multipart/form-data" >
				<p>Image : <input type="file" name="fileUpload" value=""/> <br/> <span class="error"><?php if(isset($picture)){ echo $picture; }?></span> </p>
				<p>Name :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="stuff_name" value=""/> <br/> <span class="error"><?php if(isset($staff_name)){ echo $staff_name; }?></span> </p>
				<p>Barcode :&nbsp&nbsp&nbsp&nbsp <input type="text" name="barcode" value=""/> <br/> <span class="error"><?php if(isset($code)){ echo $code; }?></span> </p>
				<p>Bike Pass :&nbsp <input type="text" name="passNumber" value="" /></p>
				<p>Company : <input type="text" name="company" value=""/> <br/> <span class="error"><?php if(isset($compania)){ echo $compania; }?></span> </p>
				<p>Phone :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="tel" name="phone" value=""/></p>
				<p>Email :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="email" name="email" value=""/></p>
				<p><input class="toLeftBut" type="submit" name="stuffSubmit" id="stuffSubmit" value="Add Staff"/></p>
				
			</form> 
		</div> <!-- stuffForm -->
			<p id="msg"><?php if(isset($mensagem)){ echo $mensagem;} ?></p>
		<div class="usersLinks">
		
			<a href="interface.php">Back to Search</a>
			
		</div> <!-- stuffLinks -->
	</div>
</div> <!-- wrapperStuff -->


</body> 
</html>
<?php 
mysqli_close($db); 
?>