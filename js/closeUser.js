						/*deleteUser.js*/
$('document').ready(function(){
	$('#deleteUser').on('click', function(){
		
		var name = $('input[name=radioInput]:checked').val();
		//alert(name);
		
		$.ajax({
			url: 'php/deleteUser.php',
			type: 'POST',
			data: {
				name : name 
			},
			success: function(response){
				$('div#deleteUserDiv').html( response );
				
				setTimeout(function(){ location.reload(); }, 2000);
			}
			
		});
	});
	
	
	$('input#deleteUserButton').on('click', function(){
		
	    window.close();
	}); 
	
});