$(document).ready(function(){

	$('#inbox').hide();

	$('#message_box').click(function(e){

		e.preventDefault();
		$('#inbox').fadeIn(1000);

	});

	$('#inbox').on('submit', function(e){

		e.preventDefault();
		$('#message').empty();
		$('#send_message').attr('disabled', 'disabled');
		$.ajax({

			url: "php_response_to_ajax/send_message.php",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data)
			{
				$('#send_message').removeAttr('disabled');
				$('#inbox').slideUp(500);
				$('#message').html(data).fadeOut(3000);
			}


		});

		$('#msg_text').empty();

	});

});