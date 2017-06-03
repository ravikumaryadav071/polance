$(document).ready(function(){

	var user = $('#chat_userid').val();
	
	setInterval(function(){
		
		$.ajax({
			url: 'php_response_to_ajax/online_chat_user.php?user='+user,
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				$('body #show_status').html(data);
			}

		});

	}, 5000);

});