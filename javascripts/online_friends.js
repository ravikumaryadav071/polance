$(document).ready(function(){

	setInterval(function(){

		$.ajax({

			url: 'php_response_to_ajax/online_friends.php',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				$('body #online_friends').html(data);
			}

		});

	}, 5000)

});