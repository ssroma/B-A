$(document).ready(function(){
	
	
	
	$('button#download').on('click', function(){
		
		$('#queriesResponse').table2excel({
			//exclude: ".excludeThisClass",
			name: "Reports",
			filename: "reports" //do not include extension
		});
		
		//alert($(this).attr('id'));
	});
	
	$('button#printing').on('click', function(){
		//var conteudo = $('div#queriiesPlace').html();
		var stylesheet1 = "css/mainStyle.css",
			stylesheet2 = "css/reports.css";
		var newWin = window.open("");
			newWin.document.write('<html><head><title>  Rsports  </title>' +
				'<link rel="stylesheet" href="' + stylesheet1 + '">' +
				'<link rel="stylesheet" href="' + stylesheet2 + '">' +
				'</head><body>' + $('div#queriiesPlace').html() + '</body></html>');
			newWin.document.close();	
			newWin.print();
			newWin.close();
		//window.print();
		return false;
	});

});