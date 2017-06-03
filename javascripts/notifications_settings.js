$(document).ready(function(){

	$('body').on('submit', '#ntf_set_form', function(e){

		e.preventDefault();
		var myThis = $(this);
		
		$.ajax({

			url: 'php_response_to_ajax/notifications_settings.php',
			type: 'POST',
			data: new FormData(this),
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){
				$('body #message').html(data).show().fadeOut(1500);
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});

	});

});