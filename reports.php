<?php 
// checar se tem session e permite somente que passo por login page.
 session_start();

 if(!isset($_SESSION['username'])){
	 header('location: index.php');
   }else{
	   $user = $_SESSION['username'];
   }
?>
<!DOCTYPE html>
<html>
 <head>
  <title> Reports </title> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="css/mainStyle.css"  media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/reports.css"  media="screen"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Paytone+One|Candal' rel='stylesheet' type='text/css'>
  <script src="js/inputMask.js"></script>
 </head>
<body>

<div id="wrapperReports" > 
  <h1> Reports </h1>
           <span class="closeButton"> x </span>
    <div id="reportsLinks">
	
		<a id="listall" href="#"> List All </a> 
			<div class="listall innerDivs">
				<div id="listallDiv" class="innerInnerDiv">
					<p> List all up to : <input type="date" name="listallFrom" id="listallFrom" value="<?php echo date("Y-m-d");  ?>" /> </p>
					<p><input class="toLeftBut" type="button" id="listallButton"  name="listallButton" value="Query"/></p>
				</div>
			</div>
			
		<a id="listXtoX" href="#"> List All Date to Date </a> 
			<div class="listXtoX innerDivs">
				<div id="listXtoXDiv" class="innerInnerDiv">
					<p>List From : <input type="date" name="listXtoXFrom" id="listXtoXFrom" placeholder="2015-10-01" /></p>
					<p>To : <input type="date" name="listXtoXTo" id="listXtoXTo" placeholder="2015-10-01"  /></p>
					<p><input class="toLeftBut" type="button" id="listXtoXButton" value="Query"/></p>
				</div>
			</div>
		
		<a id="listXtoXoverNight" href="#"> List All Overnights </a> 
			<div class="listXtoXoverNight innerDivs">
				<div id="listXtoXoverNightDiv" class="innerInnerDiv">
					<p> All Overnight's From : <input type="date" name="listXtoXoverNightFrom" id="listXtoXoverNightFrom" value="<?php //echo date("Y-m-d");  ?>" /></p>
					<p><input class="toLeftBut" type="button" name=" " id="listXtoXoverNightButton" value="Query"/></p>
				</div>
			</div>
		
		<a id="listXtoXall" href="#"> List All Overnights Date to Date </a> 
			<div class="listXtoXall innerDivs">
				<div id="listXtoXallDiv" class="innerInnerDiv">
					<p>Overnight's From : <input type="date" name="listXtoXallOverNightFrom" id="listXtoXallOverNightFrom" /></p>
					<p>Overnight's To : <input type="date" name="listXtoXallOverNightTo" id="listXtoXallOverNightTo"  /></p>
					<p><input class="toLeftBut" type="button"  name=" " id="listXtoXallButton" value="Query"/></p>
				</div>
			</div>	
		
		
	</div>	
	
	<div id="queriiesPlace" >
							
						<div id="dateHour"><span><?php echo "Printed on : " . date( "d / m / Y") ?></span><span><?php echo  " At  " . date("h : i : sa"); ?></span></div>
						
		<table id="queriesResponse">
			<thead>
				<tr>
					<th>Name</th>
					<th>Barcode</th>
					<th>Date</th>
					<th>Hours</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>	
		
		<div id="divPrinting">
			<button class="divPrinting" id="printing">Print</button>
			<button class="divPrinting" id="download">Download</button>
			   <div class="clear"></div>
		</div>
	
	</div> <!-- queriesResponse -->
	
	<div class="searchLinks">
		
		<a href="interface.php">Back to Search</a>
	    <span class="closeButton"> x </span>
		
	</div>	
</div> <!-- wrapperReports -->


<script src="js/reports.js"></script>
<script src="js/js_library/jquery.table2excel.js" > </script>
<script src="js/printingButton.js"></script>

</body> 
</html>