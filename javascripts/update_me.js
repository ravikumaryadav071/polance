$(document).ready(function(){

	setInterval(function(){
		
		$.ajax({

			url: 'php_response_to_ajax/update_me.php',
			type: 'POST',
			data: false,
			cacahe: false,
			processData: false,
			contentType: false,
			success: function(data){
				//alert(data);
			},
			error: function(){
				//'Connection to server failed. Please refresh!';
			}

		});

	}, 10000);

});