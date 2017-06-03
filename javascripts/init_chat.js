$(document).ready(function(){

	$('body').on('click', '#init_chat', function(){

		var chat_user = $(this).parent().find('#chat_user').val();
		var muThis = $(this);
		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;

		$('body #light').css({
			'display' : 'block', 
			'top' : light_top
		});
		$('body #fade').css({
			'display' : 'block',
			'top' : fade_top
		});

		$('body #popup_content').html('<form method="POST" action="" id="personal_inbox" enctype="multipart/form-data"><label for="personal_msg_text">Message: </label><textarea id="personal_msg_text" name="personal_msg_text" placeholder="Personal chat."></textarea><label for="file">Attach File</label><input type="file" id="file" name="file" value=""><input type="submit" value="SUBMIT" id="send_personal_message"><input type="hidden" name="userid" value="'+chat_user+'"></form>');

	});

	$('body').on('submit', '#personal_inbox', function(e){

		e.preventDefault();
		$('body #message').empty();
		$('body #send_personal_message').attr('disabled', 'disabled');
		$.ajax({

			url: "php_response_to_ajax/send_personal_messages.php",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data)
			{
				$('body #personal_msg_text').val('');
				$('body #file').val('');
				$('body #send_personal_message').removeAttr('disabled');
				$('body #message').html(data).fadeOut(33000);
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(33000);	
			}

		});

		$('#personal_msg_text').empty();
		$('#file').empty();
		
	});

});