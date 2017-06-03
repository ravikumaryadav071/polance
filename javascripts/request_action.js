function grant_request(id){

	$('#request_'+id).attr('disabled','disabled');
	$('#delete_request'+id).attr('disabled','disabled');
	$.ajax({

		url: 'php_response_to_ajax/request_action.php?id='+id+'&action=GRANT',
		type: 'POST',
		data: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			//$('#message').html(data).show().fadeOut(2500);
			$('#message').html(data).show();
			$('#request_container_'+id).slideUp(600).remove();
		},
		error: function(){
			$('#message').html('Connection to server failed').show().fadeOut(2500);
			$('#request_'+id).removeAttr('disabled');
			$('#delete_request'+id).removeAttr('disabled');
		}

	});

}

function delete_request(id){

	$('#request_'+id).attr('disabled','disabled');
	$('#delete_request'+id).attr('disabled','disabled');
	$.ajax({

		url: 'php_response_to_ajax/request_action.php?id='+id+'&action=DELETE',
		type: 'POST',
		data: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			$('#message').html(data).show().fadeOut(3000);
			$('#request_container_'+id).slideUp(600).remove();
		},
		error: function(){
			$('#message').html('Connection to server failed').show().fadeOut(2500);
			$('#request_'+id).removeAttr('disabled');
			$('#delete_request'+id).removeAttr('disabled');
		}

	});

}