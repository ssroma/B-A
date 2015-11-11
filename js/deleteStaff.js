											/* deleteStaff.js */
$(document).ready(function(){
	
	
	
	$('#deleteStaffLink').on('click', function(){
		
		var barcode = $("input[name=barcode]").val();
		var OpendWindow = window.open("deleteStaff.php?barcode="+barcode, "toolbar=yes", "top=200, left=300, width=400, height=300");
		
		var openedTime = window.setInterval(function(){
			if( OpendWindow.closed !== false){
					window.clearInterval( openedTime );
					window.location.replace('interface.php');
			}
			
		}, 500);
	
		return false;
	})
	
	$('a#deleteStaffYes').on('click', function(){
		
		var stuff_name = $('#deleteStaffDiv').find('h3').attr('name'),
			h3_value = $('#deleteStaffDiv').find('h3').text();
		var data = { stuff_name : h3_value }
			 
			$.ajax({
				
				url: 'php/deleteStuff.php',
				type: 'POST',
				data: data,
				success: function(response){
					$('#deleteStaffSpan').html(response);
					
					setTimeout(function(){ window.close(); }, 2000);
				}
				
			});
			
			
			
		 console.log( data );
		return false;
	});
	
	$('a#deleteStaffNo').on('click', function(){
		window.close();
	});
	
	/* $('input#closeStaff').on('click', function(){
		
		window.close();
	}); */
	
});											