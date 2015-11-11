										/* updateStaff.js */
$(document).ready(function(){
	
	$('input#UpdateUser').on('click', function(){
		
		var formFields = $(this).closest('#updateUserForm'),
		    action =  formFields.attr('action');
			type = formFields.attr('method'),
			data = {};
			
		formFields.find('[name]').each(function( index, value ){
			
			var inputs = $(this),
			    name = inputs.attr('name'),
				value = inputs.val();
				
				data[name] = value;
		});	
		
		$.ajax({
			url: action,
			type: type,
			data: data,
			success: function(response){
				$('div#updateConfirmation').html( response );
			}
												 
		});	
		console.log( data );
		
		
		return false;
	});
	
	
});