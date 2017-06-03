$(document).ready(function(){

	$('body').on('click', '#send_request', function(){

		$(this).stop();
		var col_name = $(this).parent().find('#col_name').val();
		var myThis = $(this);
		
		$.ajax({

			url: 'php_response_to_ajax/collaboration_request.php?col='+col_name+'&type=JOIN',
			type: 'POST',
			data: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){
				$('body #message').html(data).show().fadeOut(1500);
				myThis.parent().find('#delete_request').show();
				myThis.hide();
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});

	});

	$('body').on('click', '#delete_request', function(){

		$(this).stop();
		var col_name = $(this).parent().find('#col_name').val();
		var myThis = $(this);
		
		$.ajax({

			url: 'php_response_to_ajax/collaboration_request.php?col='+col_name+'&type=DELETE',
			type: 'POST',
			data: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){
				$('body #message').html(data).show().fadeOut(1500);
				myThis.parent().find('#send_request').show();
				myThis.hide();
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});

	});

});