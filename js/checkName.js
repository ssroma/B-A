/* checkName.js */

$(document).ready(function(){
	$('input#name_input').on('blur', function(){
		var input = $(this),
			name =  input.attr('name'),
			nameInputValue = input.val();
			
		    $.ajax({
				url: 'php/testingName.php',
				type: 'POST',
				data: {
					name : nameInputValue
				},
				success: function(response){
				
					if(response === "Ok."){
						$('span#nameSpan').html(response); 
					   
						$('input#pass02_input').on('keyup', function(){
							 var $pass01 = $('input#pass01_input').val()
								if($(this).val() === $pass01 ){
									
									$('span#spanPass02').html('Ok.');
									
									    $('form#addUserForm').on('submit', function(){
			
											var that = $(this),
												//url = that.attr('action'),
												type = that.attr('method'),
												data = {};
												
											that.find('[name]').each(function(index, value){
												
												var that = $(this),
													name = that.attr('name'),
													value = that.val();
													
													data[name] = value;
											});	
											
												$.ajax({
													url: 'php/retrivingData.php',
													type: type,
													data: data,
													success: function(response){
														
														$('div#mensagem').html( response );
														
														$('form#addUserForm')[0].reset();
														$('form#addUserForm').find('span').html("");
														
														setTimeout(function(){ location.reload(); }, 3000);
														
														
													}
												 
												});
												
											return false;
										});	
								}else{
									$('span#spanPass02').html('Doesn\'t much. Try again.');
								}
						});
						
					}else{
						$('span#nameSpan').html('Please change your name.'); 
						$('form#addUserForm').on('submit', function(){
							 //$(this)[0].reset();
							 $('span#mensagem').html('Cheque the field\'s and try again.');
							 
							
							return false;
						});
					}
					
					
				}
			 
			});
	});
});