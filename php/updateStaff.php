<?php                                                      // updateStaff.php 
     // connecting to data base . 
	include "../includes/connection.php";
 ?>
<?php                                                

if( isset( $_POST['UpdateUser'] )){
	
	$barcode = mysqli_real_escape_string( $db, trim( $_POST['barcode'] ) );
	$bikepass = mysqli_real_escape_string( $db, trim( $_POST['passNumber'] ) );
	$stuff_name = mysqli_real_escape_string( $db, trim( $_POST['stuff_name'] ) );	
	$company = mysqli_real_escape_string( $db, trim( $_POST['company'] ) );	
	$phone = mysqli_real_escape_string( $db, trim( $_POST['phone'] ) );	
	$email = mysqli_real_escape_string( $db, trim( $_POST['email'] ) );
	
	$query = "UPDATE stuffdb ";
	$query .= "SET barcode='$barcode', pass_number='$bikepass', stuff_name='$stuff_name', company='$company', phone='$phone', email='$email' ";
	$query .= "WHERE barcode = '$barcode'";
	
	$result = mysqli_query( $db, $query );
	
	if( $result ){
		echo " Record Updated Successfully";
	}else{
		echo " An error occur " . mysqli_error( $db ); 
	}
}



?>