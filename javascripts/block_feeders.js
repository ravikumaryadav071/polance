$(document).ready(function(){

	$('body').on('submit', '#feeds_set_form', function(e){

		e.preventDefault();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/block_feeders.php',
			type: 'POST',
			data: new FormData(this),
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){
				$('body #blocked_feeder').each(function(){
					if($(this).prop('checked')){
						$(this).parent().slideUp(300);
					}
				});
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});

	});

});