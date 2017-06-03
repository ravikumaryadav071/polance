function load_more_followings(user, id){

	$.ajax({

		url: 'php_response_to_ajax/load_more_followings.php?user='+user+'&id='+id,
		type: 'POST',
		data: false,
		cache: false,
		processData: false,
		contentType: false,
		success: function(data){
			$('#load_more_followings').before(data).remove();
			$('a[hidden="hidden"]').hide();
			$('input[hidden="hidden"]').hide();
		},
		error: function(){
			$('#message').html('Connection to server failed').show.fadeOut(2500);
		}

	});

}