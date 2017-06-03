$(document).ready(function(){

	var last_id = $('#last_id').val();
	
	$('#load_more').stop().click(function(){

		$.ajax({

			url: 'php_response_to_ajax/laod_more_groups.php?id='+last_id,
			type: 'POST',
			data: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){

				$('#last_id').remove();
				$(this).after(data);

			},
			error: function(){
				$('#message').html('Connection to server failed').show().fadeOut(2500);
			}

		});

	});

});