											/* reports.js */
$(document).ready(function(){
	
	$('#reportsLinks').find('.innerDivs').hide(600);
	$('div#queriiesPlace').hide();
	
	$('#reportsLinks a').on('click', function(event){
	
		var links = $(this),
			linksDivs = links.attr('id');
			classForm = linksDivs + 'Div';
		$('div .' + linksDivs ).toggle(1000);
		$('div .' + linksDivs).prev().prev().hide(1000);		
		$('div .' + linksDivs).prev().prev().prev().prev().hide(1000);		
		$('div .' + linksDivs).prev().prev().prev().prev().prev().prev().hide(1000);		
		$('div .' + linksDivs).next().next().hide(1000);
		$('div .' + linksDivs).next().next().next().next().hide(1000);
		$('div .' + linksDivs).next().next().next().next().next().next().hide(1000);
			
		var button = '#' + linksDivs + 'Button';  // getting the batton id 
		
			$(button).on('click', function(){
			
				var button = $(this),
					buttonName = button.attr('id');
					//alert(buttonName);
					var innerInnerDiv = button.parent().parent().attr('id'),
						valueToVal = '#' + innerInnerDiv, 
						data = {};
						
					$(valueToVal).find('[name]').each(function(index, value){
						
						var inputs = $(this),
							name = inputs.attr('name');
							value = inputs.val();
							data[name] = value;
					});
				// give a class to the table to be able to recognise the printing sheet.
				  	
					
				
				$.ajax({
					
					url: 'php/reportsQueries.php',
					type: 'POST',
					data: data,
					success: function(response){
						
						$('#queriesResponse').append(response);
						$('#queriesResponse').addClass(classForm);
						$('div#reportsLinks').hide(1800);
						$('div#queriiesPlace').show(1000);	
						$('.closeButton').show(1000);
						$('div .' + linksDivs ).toggle(1000);
					}
				});		
				
			});
			
			$('.closeButton').on('click', function(){
				
				$('#queriesResponse tbody').remove();
				$('#queriesResponse').removeClass();
				$('div#reportsLinks').show(1800);
				$('div#queriiesPlace').hide(1000);
				$('.closeButton').hide(1800);
			});
			
			event.preventDefault();
		
		
		
		});	// $('#reportsLinks a')
	
});  // $(document).ready(function()