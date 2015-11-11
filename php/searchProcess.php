<?php
// tera que conectar com database e encontra os resultados 
// e postar na pagina 

if(isset($_POST['searchSubmit'])){
	
	$search = $_POST['searchField'];
if($search == ""){	
   $msg = "Search Field can\'t be empty .";
   header("location: ../interface.php?msg={$msg}" );
	die();
}else{

	echo "voce esta procurando !!!";
}	
}else{
	
}


?>