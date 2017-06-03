$(document).ready(function(){

	setInterval(function(){

		$.ajax({

			url: 'php_response_to_ajax/online.php',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				if(data == 'FAILED'){
					alert(data);
					$('body #message').html('Connection to server lost.');	
				}
			},
			error: function(){
				$('body #message').html('Connection to server lost.');
			}

		});

	}, 10000)

});