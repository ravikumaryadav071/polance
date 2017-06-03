$(document).ready(function(){

	$('body').on('click', '#leave_col', function(){
		
		var col_name = $(this).parent().find('#col_name').val();
		var user = $(this).parent().find('#user').val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/leave_collaboration.php?col='+col_name,
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				if(data == 'SUCCESS'){
					window.location = 'collaboration.php?col='+col_name;
				}else{
					$('body #message').html(data).show().fadeOut(1500);
				}
			},
			error: function(){
				$('body message').html('Connection to server failed').show().fadeOut(1500);
			}


		});

	});

});