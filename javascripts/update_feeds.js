$(document).ready(function(){

	setInterval(function(){
		
		$.ajax({

			url: 'php_response_to_ajax/update_feeds.php',
			type: 'POST',
			data: false,
			cacahe: false,
			processData: false,
			contentType: false,
			success: function(data){
				$('body #message').html(data).show();
			},
			error: function(){
				//'Connection to server failed. Please refresh!';
			}

		});

	}, 10000);

});