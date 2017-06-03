$(document).ready(function(){

	$('body').on('click', '#accept_invite', function(){

		var col_name = $(this).parent().find('#col_name').val();
		var myThis = $(this);

		$.ajax({

			url:  'php_response_to_ajax/invitation_action.php?col='+col_name+'&action=ACCEPT',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				$('body #message').html(data).show().fadeOut(1500);
				myThis.parent().slideUp(500);
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);	
			}

		});

	});

	$('body').on('click', '#reject_invite', function(){

		var col_name = $(this).parent().find('#col_name').val();
		var myThis = $(this);

		$.ajax({

			url:  'php_response_to_ajax/invitation_action.php?col='+col_name+'&action=REJECT',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				$('body #message').html(data).show().fadeOut(1500);
				myThis.parent().slideUp(500);
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);	
			}

		});

	});

});